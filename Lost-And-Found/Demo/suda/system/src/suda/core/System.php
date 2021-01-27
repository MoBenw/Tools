<?php
/**
 * Suda FrameWork
 *
 * An open source application development framework for PHP 7.2.0 or newer
 *
 * Copyright (c)  2017-2018 DXkite
 *
 * @category   PHP FrameWork
 * @package    Suda
 * @copyright  Copyright (c) DXkite
 * @license    MIT
 * @link       https://github.com/DXkite/suda
 * @version    since 1.2.4
 */
namespace suda\core;

require_once __DIR__.'/functions.php';
require_once __DIR__.'/Debug.php';


use suda\archive\SQLQuery;
use suda\core\exception\ApplicationException;
use suda\core\Autoloader;

/**
 * 系统类，处理系统报错函数以及程序加载
 */
class System
{
    protected static $appInstance=null;
    protected static $applicationClass=null;
    const APP_CACHE='app.cache';

    public static function init()
    {
        class_alias(__CLASS__, 'System');
        // 错误处理
        register_shutdown_function([__CLASS__,'uncaughtFatalError']);
        set_error_handler([__CLASS__,'uncaughtError']);
        set_exception_handler([__CLASS__,'uncaughtException']);
        // 系统关闭
        register_shutdown_function([__CLASS__,'onShutdown']);
        if (!DEBUG) {
            ini_set('display_errors', 'Off');
        }

        defined('RUNTIME_DIR') or define('RUNTIME_DIR', Autoloader::parsePath(DATA_DIR.'/runtime'));
        defined('VIEWS_DIR') or define('VIEWS_DIR', Autoloader::parsePath(DATA_DIR.'/views'));
        defined('CACHE_DIR') or define('CACHE_DIR', Autoloader::parsePath(DATA_DIR.'/cache'));
        defined('TEMP_DIR') or define('TEMP_DIR', Autoloader::parsePath(DATA_DIR.'/temp'));

        Storage::mkdirs(RUNTIME_DIR);
        Storage::mkdirs(VIEWS_DIR);
        Storage::mkdirs(CACHE_DIR);
        Storage::mkdirs(TEMP_DIR);

        Debug::beforeSystemRun();
        Locale::path(SYSTEM_RESOURCE.'/locales');
        debug()->trace('system init');
        Hook::exec('suda:system:init');
    }
 
    public static function getAppInstance()
    {
        return self::$appInstance;
    }
    
    public static function getAppClassName()
    {
        if (is_null(self::$applicationClass)) {
            self::$applicationClass = class_name(Config::get('app.application', 'suda.core.Application'));
        }
        return self::$applicationClass;
    }

    public static function run()
    {
        debug()->time('init application');
        $router=Router::getInstance();
        static::initApplication();
        debug()->timeEnd('init application');
        debug()->time('init router');
        $router->loadModulesRouter();
        debug()->timeEnd('init router');
        debug()->time('run request');
        $router->dispatch();
        debug()->timeEnd('run request');
        debug()->time('before shutdown');
    }

    public static function initApplication()
    {
        // 定义常量
        defined('MODULES_DIR') or define('MODULES_DIR', Autoloader::parsePath(APP_DIR.'/modules'));
        defined('RESOURCE_DIR') or define('RESOURCE_DIR', Autoloader::parsePath(APP_DIR.'/resource'));
        defined('DATA_DIR') or define('DATA_DIR', Autoloader::parsePath(APP_DIR.'/data'));
        defined('SHRAE_DIR') or define('SHRAE_DIR', Autoloader::parsePath(APP_DIR.'/share'));
        defined('CONFIG_DIR') or define('CONFIG_DIR', Autoloader::parsePath(RESOURCE_DIR.'/config'));
        // 生成路径
        Storage::mkdirs(APP_DIR);
        Storage::mkdirs(MODULES_DIR);
        Storage::mkdirs(RESOURCE_DIR);
        Storage::mkdirs(SHRAE_DIR);
        Storage::mkdirs(CONFIG_DIR);

        // 检测 app vendor
        if (storage()->exist($vendor = APP_DIR.'/vendor/autoload.php')) {
            Autoloader::import($vendor);
        }

        self::readManifast();
        $name=Autoloader::realName(self::$applicationClass);
        // 加载共享库
        foreach (Config::get('app.import', [''=>SHRAE_DIR]) as $namespace=>$path) {
            if (Storage::isDir($srcPath=APP_DIR.DIRECTORY_SEPARATOR.$path)) {
                Autoloader::addIncludePath($srcPath, $namespace);
            } elseif (Storage::isFile($importPath=APP_DIR.DIRECTORY_SEPARATOR.$path)) {
                Autoloader::import($importPath);
            }
        }
        Config::set('app.application', $name);
        debug()->trace(__('loading application $0 from $1', $name, APP_DIR));
        self::$appInstance= $name::getInstance();
        self::$appInstance->init();
    }

    public static function createApplication(string $path)
    {
        Storage::copydir(SYSTEM_RESOURCE.'/app/', $path);
    }

    protected static function readManifast()
    {
        $path = APP_DIR.DIRECTORY_SEPARATOR.'manifast.json';
        debug()->trace(__('reading manifast file $0', $path));
        $manifast  = [];
        if (!Config::resolve($path)) {
            debug()->trace(__('create base app on $0', APP_DIR));
            static::createApplication(APP_DIR);
            Config::set('app.init', true);
        }

        try {
            $manifast = Config::loadConfig($path);
        } catch (\Exception $e) {
            $message =__('load application mainifast: parse mainifast error: $0', $e->getMessage());
            debug()->error($message);
            suda_panic('Kernal Panic', $message);
        }
        
        Autoloader::addIncludePath(APP_DIR.'/share');
        Config::set('app', $manifast);
        // 载入配置前设置配置
        Hook::exec('suda:system:load-manifast');
        // 默认应用控制器
        self::$applicationClass=self::getAppClassName();
    }

    public static function onShutdown()
    {
        // 忽略用户停止脚本
        ignore_user_abort(true);
        debug()->timeEnd('before shutdown');
        debug()->time('shutdown');
        // 发送Cookie
        if (connection_status() === CONNECTION_NORMAL) {
            Hook::exec('suda:system:shutdown::before');
        }
        // 停止响应输出
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }
        Hook::exec('suda:system:shutdown');
        debug()->trace('connection status '. ['normal','aborted','timeout'][connection_status()]);
        // debug()->trace('include paths '.json_encode(Autoloader::getIncludePath()));
        // debug()->trace('runinfo', self::getRunInfo());
        debug()->trace('system shutdown');
        debug()->timeEnd('shutdown');
        Debug::phpShutdown();
    }
    
    public static function uncaughtFatalError()
    {
        if ($e = error_get_last()) {
            $isFatalError = E_ERROR | E_PARSE | E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_COMPILE_WARNING;
            if ($e['type'] === ($e['type'] & $isFatalError)) {
                self::uncaughtError($e['type'], $e['message'], $e['file'], $e['line']);
            }
        }
    }

    public static function uncaughtException($exception)
    {
        Config::set('exception', true);
        if (!Hook::execIf('suda:system:exception::display', [$exception], true)) {
            if (!$exception instanceof Exception) {
                $exception=new Exception($exception);
            }
            Debug::displayException($exception);
        }
    }

    // 错误托管
    public static function uncaughtError($errno, $errstr, $errfile, $errline)
    {
        self::uncaughtException(new \ErrorException($errstr, 0, $errno, $errfile, $errline));
    }

    public static function error(int $status, string $type, string $message, ?int $code=null, array $params=[])
    {
        $render=new class($status, $type, $message, $code, $params) extends Response {
            protected $status;
            protected $type;
            protected $message;
            protected $code;
            protected $params;
            public function __construct(int $status, string $type, string $message, ?int $code=null, array $params=[])
            {
                $this->status =$status;
                $this->type =$type;
                $this->message = $message;
                $this->code = $code;
                $this->params = $params;
            }
            public function onRequest(Request $request)
            {
                $this->state($this->status);
                $page=$this->page('suda:error', ['error_type'=> $this->type ,'error_message'=> $this->message]);
                if (!is_null($this->code)) {
                    $page->set('error_code', $this->code);
                }
                if (is_array($this->params)) {
                    $page->assign($this->params);
                }
                $page->render();
            }
        };
        $render->onRequest(Request::getInstance());
    }
}
