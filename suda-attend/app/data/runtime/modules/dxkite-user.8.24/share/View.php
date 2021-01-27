<?php
namespace dxkite\user;

use dxkite\user\manager\{UserManager};

class View
{
    public static function settingNav($template)
    {
        $user=UserManager::getInfo(get_user_id());
        $template->set('user', $user);
        \suda\template\Manager::include('user:setting-nav', $template)->render();
    }
    public static function initConfig()
    {
        config()->set('user_signin_route', 'user:signin');
        // 注册用户信息提供函数
        config()->set('support.getUserPublicInfo', 'dxkite\user\manager\UserManager::getPublicInfo');
        config()->set('support.getUserPublicInfoAray', 'dxkite\user\manager\UserManager::getPublicInfoArray');
    }
}
