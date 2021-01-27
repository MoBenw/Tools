<?php
namespace dxkite\user\response;

use dxkite\support\visitor\response\VisitorResponse;
use dxkite\support\visitor\Context;
use dxkite\user\manager\UserManager;
use dxkite\user\manager\CodeManager;
use dxkite\user\exception\UserException;

class SigninResponse extends VisitorResponse
{
    public function onGuestVisit(Context $context)
    {
        $view=$this->page('user:signin');
        if (request()->hasPost()) {
            $account=request()->post('account');
            $password=request()->post('password');
            $code=request()->post('code');
            $remember=request()->post('remember', false);
            if ($account && $password && $code) {
                if (CodeManager::check($code)) {
                    try {
                        $code=UserManager::signin($account, $password, $remember);
                        if ($code>0) {
                            $this->jump();
                        }
                    } catch (UserException $e) {
                        switch ($e->getCode()) {
                            case UserException::NAME_FORMAT_ERROR:
                            case UserException::EMAIL_FORMAT_ERROR:
                            case UserException::ACCOUNT_OR_PASSWORD_ERROR:
                                $view->set('invaildInput', true);
                        }
                    }
                } else {
                    $view->set('invaildCode', true);
                }
            } else {
                $view->set('invaildCode', true);
                $view->set('invaildInput', true);
            }
        }
        $view->render();
    }
    
    public function onUserVisit(Context $context)
    {
        $this->jump();
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
