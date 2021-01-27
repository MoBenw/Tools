<?php
namespace dxkite\support\api;

use suda\core\route\Mapping;

class Hook
{
    public static function setting($template)
    {
        /**
         * xxx:version
         */
        $template->addcommand('api', function ($exp) {
            if (preg_match('/\((.+)\)/', $exp, $v)) {
                $name=trim($v[1], '"\'');
                if (preg_match('/^:(.+)$/', $name, $match)) {
                    $prefix=app()->getModulePrefix(module(__FILE__))['api']??'/api';
                    $url=ltrim($prefix.'/'.$match[1]??'', '/');
                    return '<?php echo request()->baseUrl().\''.$url.'\'; ?>';
                }
                if (strpos($name, ':')) {
                    list($name, $version)=preg_split('/:/', $name, 2);
                }
                $routeName=module(__FILE__).':api_'.$name.'_'.$version;
                return '<?php echo u(\''.$routeName.'\'); ?>';
            } else {
                $prefix=app()->getModulePrefix(module(__FILE__))['api']??'/api';
                $prefix=ltrim($prefix, '/');
                return '<?php echo request()->baseUrl().\''.$prefix.'\'; ?>';
            }
        });
    }

    /**
     * 注册标准开放URL
     *
     * @param [type] $router
     * @return void
     */
    public static function registerOpenApiRoute($router)
    {
        $modules = app()->getReachableModules();
        $prefix=app()->getModulePrefix(module(__FILE__))['api']??'/api';
        $apiMenu=[];
        $apiVersionMenu=[];
        foreach ($modules as $module) {
            $mapper = app()->getModuleConfig($module, 'api/mapper');
            if (is_array($mapper)) {
                foreach ($mapper as $version => $classFields) {
                    foreach ($classFields as $name => $proxyClass) {
                        $mapping=new Mapping('api_'.$name.'_'.$version, $prefix.'/'.$version.'/'.$name.'[/{method}]', Response::class.'->onRequest', module(__FILE__));
                        $mapping->setAntiPrefix();
                        $mapping->setParam([
                            'proxyClass'=>$proxyClass,
                            'module' => $module,
                        ]);
                        $router->addMapping($mapping);
                        $apiMenu[$version][$name]=$mapping;
                    }
                }
            }
        }

        foreach ($apiMenu as $version => $apiSet) {
            $mapping=new Mapping('api_'.$version, $prefix.'/'.$version, MenuResponse::class.'->onRequest', module(__FILE__));
            $mapping->setAntiPrefix();
            $mapping->setParam(['mappingSets'=>$apiSet]);
            $router->addMapping($mapping);
            $apiVersionMenu[$version]=$mapping;
        }

        $mapping=new Mapping('api', $prefix, MenuResponse::class.'->onRequest', module(__FILE__));
        $mapping->setAntiPrefix();
        $mapping->setParam(['mappingSets'=>$apiVersionMenu]);
        $router->addMapping($mapping);
    }
}
