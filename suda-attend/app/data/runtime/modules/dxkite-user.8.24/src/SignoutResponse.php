<?php
namespace dxkite\user\response;

use dxkite\support\visitor\response\Response;
use dxkite\support\visitor\Context;
use dxkite\user\manager\UserManager;

class SignoutResponse extends Response
{
    public function onVisit(Context $context)
    {
        UserManager::signout();
        $this->jump();
        echo __('退出登陆成功');
    }

    public function jump()
    {
        if (cookie()->has('refer')) {
            $this->go(cookie()->get('refer', u('user:index')));
            cookie()->delete('refer');
        } elseif (request()->get('refer')) {
            $this->go(request()->get('refer', u('user:index')));
        } elseif (request()->referer() && request()->get()->goback) {
            $this->go(request()->referer());
        } else {
            $this->go(u('user:index'));
            echo __('正在跳转到用户中心');
            return;
        }
        echo __('正在跳转');
        return;
    }
}
