<?php
namespace dxkite\user\response;

use dxkite\support\visitor\response\VisitorResponse;
use dxkite\support\visitor\Context;
use dxkite\user\manager\UserManager;
use dxkite\user\manager\CodeManager;
use dxkite\user\exception\UserException;
use dxkite\user\manager\InviteManager;

class SignupResponse extends VisitorResponse
{
    public function onGuestVisit(Context $context)
    {
        $view=$this->page('user:signup');
        if (request()->hasPost()) {
            $name=request()->post('name');
            $email=request()->post('email');
            $password=request()->post('password');
            $repeat=request()->post('repeat');
            $code=request()->post('code');
            $invite=request()->post('invite');
            $view->set('name',$name);
            $view->set('email',$email);
            $view->set('invite',$invite);
            if ($name && $email && $password == $repeat && $code && $invite) {
                if (!CodeManager::check($code)) {
                    $view->set('invaildCode', true);
                    $view->set('checkField', true);
                }
                if (!InviteManager::check($invite)) {
                    $view->set('invaildInvite', true);
                    $view->set('checkField', true);
                }
                if ($view->get('checkField', false) != true) {
                    try {
                        $userId=UserManager::signup($name, $email, $password);
                        UserManager::signin($email, $password);
                        InviteManager::bind($userId,$invite);
                        $this->jump();
                    } catch (UserException $e) {
                        switch ($e->getCode()) {
                            case UserException::NAME_FORMAT_ERROR:
                            $view->set('invaildEmail', '用户名格式错误');
                            break;
                            case UserException::NAME_EXISTS_ERROR:
                            $view->set('invaildName', '用户名已存在');
                            break;
                            case UserException::EMAIL_FORMAT_ERROR:
                            $view->set('invaildEmail', '邮箱格式错误');
                            break;
                            case UserException::EMAIL_EXISTS_ERROR:
                            $view->set('invaildEmail', '邮箱已存在');
                            break;
                        }
                    }
                }
            } else {
                $view->set('passwordError', true);
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
