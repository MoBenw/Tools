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
namespace suda\template\compiler\suda;

use suda\core\Hook;
use suda\core\Router;
use suda\tool\Command;
use suda\core\Response;
use suda\tool\ArrayHelper;
use suda\template\Template as TemplateInterface;
use suda\exception\KernelException;
use suda\exception\CommandException;

abstract class Template implements TemplateInterface
{
    /**
    * 模板的值
    */
    protected $value=[];
    /**
    * 模板所属于的响应
    */
    protected $response=null;
    protected $name=null;
    protected $parent=null;
    protected $hooks=[];
    // 所在模块
    protected $module=null;
    // 源文件
    protected $source=null;
    // 渲染堆栈
    protected static $render=[];
    // 安全Nonce
    protected static $scriptNonce = null;

    protected $extend=null;

    /**
    * 渲染页面
    */
    public function render()
    {
        $content=self::getRenderedString();
        hook()->exec('suda:template:render::before', [&$content]);
        debug()->trace('echo '.$this->name);
        if ($this->response) {
            $cspDefault = 'default-src \'self\';';
            if (self::$scriptNonce) {
                $cspDefault .= 'script-src \'self\' \'unsafe-eval\' \'nonce-$RANDOM\';';
                $cspDefault .= 'style-src \'self\' \'nonce-$RANDOM\' \'unsafe-inline\';';
            } else {
                $cspDefault .= 'script-src \'self\' \'unsafe-eval\' \'unsafe-inline\';';
                $cspDefault .= 'style-src \'self\' \'unsafe-inline\';';
            }
            $cspDefault .= 'img-src \'self\' data:;';
            $csp = conf('header.Content-Security-Policy', $cspDefault);
            $xfo = conf('header.X-Frame-Options', 'sameorigin');
            $csp = str_replace('\'nonce-$RANDOM\'', is_null(self::$scriptNonce)?'':'\'nonce-'.self::$scriptNonce.'\'', $csp);
            $this->response->addHeader('Content-Security-Policy', $csp);
            $this->response->addHeader('X-Frame-Options', $xfo);
            $this->response->type('html');
            if (conf('app.etag', !conf('debug'))  && $this->response->etag(md5($content))) {
            } else {
                $this->response->send($content);
            }
        } else {
            $this->response->send($content);
        }
        return $this;
    }
    
    /**
    * 渲染语句
    */
    abstract protected function _render_template();

    /**
    * 获取渲染后的字符串
    */
    public function getRenderedString()
    {
        self::_render_start();
        $this->echo();
        $content=self::_render_end();
        return $content;
    }
    
    protected function _render_start()
    {
        array_push(self::$render, $this->name);
        debug()->trace('start render', $this->name);
        ob_start();
    }

    protected function _render_end()
    {
        array_pop(self::$render);
        $content=trim(ob_get_clean());
        debug()->trace('free render ['.strlen($content).']', $this->name);
        return $content;
    }

    /**
    * 获取当前模板的字符串
    */
    public function __toString()
    {
        return self::getRenderedString();
    }

    /**
     * 输出当前模板
     *
     * @return void
     */
    public function echo()
    {
        debug()->time('render '.$this->name);
        $this->_render_template();
        if ($this->extend) {
            $this->include($this->extend);
        }
        debug()->timeEnd('render '.$this->name);
    }

    public function extend(string $name)
    {
        $this->extend = $name;
    }

    public function include(string $name)
    {
        $template = \suda\template\Manager::include($name, $this);
        for ($parent = $this->parent; $parent ; $parent = $parent->parent) {
            if ($parent->name === $template->name) {
                throw new KernelException(__('use parent template failed: $0', $template->name));
            }
        }
        $template->echo();
    }
    
    public function getRenderStack()
    {
        return self::$render;
    }

    protected function getScriptNonce()
    {
        if (is_null(self::$scriptNonce)) {
            self::$scriptNonce = base64_encode(md5($this->name.time(), true));
        }
        return self::$scriptNonce;
    }

    /**
    * 单个设置值
    */
    public function set(string $name, $value)
    {
        $this->value=ArrayHelper::set($this->value, $name, $value);
        return $this;
    }

    /**
    * 直接压入值
    */
    public function assign(array $values)
    {
        $this->value=array_merge($this->value, $values);
        return $this;
    }

    /**
    * 创建模板
    */
    public function parent(Template $template)
    {
        $this->parent=$template;
        $this->response=$this->parent->response;
        return $this;
    }

    /**
    * 创建响应
    */
    public function response(Response $response)
    {
        $this->response=$response;
        return $this;
    }

    /**
    * 创建模板获取值
    */
    public function get(string $name, $default=null)
    {
        $fmt= ArrayHelper::get($this->value, $name, $default ?? $name);
        if (func_num_args() > 2) {
            $args=array_slice(func_get_args(), 2);
            array_unshift($args, $fmt);
            return call_user_func_array('sprintf', $args);
        }
        return $fmt;
    }

    /**
    * 检测值
    */
    public function has(string $name)
    {
        return ArrayHelper::exist($this->value, $name);
    }

    public function data(string $name)
    {
        if (func_num_args()>1) {
            $args=func_get_args();
            $args[0]=$this;
            return (new Command($name))->exec($args);
        }
        return (new Command($name))->exec([$this]);
    }
    
    public function execHook(string $name, $callback)
    {
        // 存在父模板
        if ($this->parent) {
            return $this->parent->execHook($name, $callback);
        } else {
            $this->hooks[$name][]=(new Command($callback))->name($name);
        }
    }

    public function execGlobalHook(string $name)
    {
        try {
            Hook::exec($name, [$this]);
        } catch (CommandException $e) {
            echo '<div style="color:red" title="'.__('can\'t run global hook $0', $e->getCmd()).'">{:'.$name.'}</div>';
            return;
        }
        if (conf('app.show-page-global-hook', false)) {
            echo '<div style="color:green" title="'.__('global hook point').'">{:'.$name.'}</div>';
        }
    }

    public function url($name=null, $values=null)
    {
        if (is_string($name)) {
            if (!is_array($values)) {
                $args=func_get_args();
                array_shift($args);
                $values= Router::getInstance()->buildUrlArgs($name, $args, $this->module);
            }
            return Router::getInstance()->buildUrl($name, $values, true, [], $this->module);
        } elseif (is_array($name)) {
            return Router::getInstance()->buildUrl(Response::$name, array_merge($_GET, $name), true, [], $this->module);
        } else {
            return Router::getInstance()->buildUrl(Response::$name, $_GET, false, [], $this->module);
        }
    }

    public function exec(string $name)
    {
        try {
            // 存在父模板
            if ($this->parent) {
                $this->parent->exec($name);
            } elseif (isset($this->hooks[$name])) {
                foreach ($this->hooks[$name] as $hook) {
                    $hook->exec();
                }
            }
        } catch (CommandException $e) {
            echo '<div style="color:red" title="'.__('can\'t run page hook $0 $1', $e->getCmd(), $e->getMessage()).'">{:'.$e->getCmd().'}</div>';
            return;
        }
        if (is_null($this->parent) && conf('app.show-page-hook', false)) {
            echo '<div style="color:green" title="'.__('page hook point').'">{#'.$name.'}</div>';
        }
    }

    public function name()
    {
        return $this->name;
    }
    
    public function responseName()
    {
        return $this->response->getName();
    }

    public function isMe(string $name, ?array $param=null):bool
    {
        if ($this->response->getName()!=Router::getInstance()->getRouterFullName($name, $this->module)) {
            return false;
        }
        if (is_array($param)) {
            foreach ($param as $name=>$item) {
                if (request()->get($name)!=$item) {
                    return false;
                }
            }
        }
        return  true;
    }

    public function boolecho($values, string $true, string $false='')
    {
        return is_bool($values) && $values ?$true:$false;
    }

    public function getModule()
    {
        return $this->module;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
