<?php
namespace dxkite\user\response;

use dxkite\support\visitor\response\VisitorResponse;
use dxkite\support\visitor\Context;
use dxkite\user\manager\UserManager;
use dxkite\user\manager\InviteManager;
use dxkite\user\exception\UserException;
use dxkite\user\manager\EmailCheckManager;
use suda\mail\Factory;
use suda\mail\message\HTMLMessage;

class IndexResponse extends VisitorResponse
{
    public function onGuestVisit(Context $context)
    {
        if ($userId=request()->get('id')) {
            $this->info($userId);
        } else {
            $this->go(u('user:signin'));
            cookie()->set('refer', u());
            echo __('正在跳转登陆');
        }
    }
    
    public function onUserVisit(Context $context)
    {
        if ($userId=request()->get('id')) {
            $this->info($userId);
        } else {
            $this->home();
        }
    }
    protected function info(int $userId)
    {
        $view=$this->page('user:index');
        if ($user=UserManager::getPublicInfo($userId)) {
            $view->set('user', $user);
        }
        $view->render();
    }

    protected function home()
    {
        $view=$this->page('user:home');
        if ($user=UserManager::getInfo(get_user_id())) {
            $view->set('user', $user);
            if (request()->get('checkEmail')) {
                $sender=Factory::sender();
                $message=new HTMLMessage(setting('website_name', 'DXkite').' - 邮箱验证', 'user:reset/email', [
                                    'user'=>$user,
                                    'token'=>EmailCheckManager::create($user['id'], $user['email']),
                                ]);
                $message->setTo($user['email']);
                // $message->setFrom('no_reply@'.($_SERVER['HTTP_HOST'] ?? 'atd3.cn'),setting('website_name', 'DXkite') .' - 邮件中心' );
                if ($sender->send($message)) {
                    $view->set('error', [
                        'type'=>'success',
                        'message'=>__('验证邮件发送成功')
                    ]);
                }
            }
            if ($token=request()->get('token')) {
                if (EmailCheckManager::check($token) == get_user_id()) {
                    $view->set('error', [
                        'type'=>'success',
                        'message'=>__('你的邮箱验证成功')
                    ]);
                    UserManager::setEmailChecked(get_user_id());
                    $view->set('user',UserManager::getInfo(get_user_id()));
                } else {
                    $view->set('error', [
                        'type'=>'danger',
                        'message'=>__('验证邮件已经过期')
                    ]);
                }
            }
        }
        if ($code=InviteManager::get()) {
            $view->set('inviteCode', $code);
        }
        if (request()->get('invite')) {
            InviteManager::create();
            $this->go(u());
        }

        

        $view->render();
    }
}
