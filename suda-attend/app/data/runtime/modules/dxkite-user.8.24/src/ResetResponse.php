<?php
namespace dxkite\user\response;

use dxkite\support\visitor\response\Response;
use dxkite\support\visitor\Context;
use dxkite\user\manager\UserManager;
use dxkite\user\exception\UserException;
use dxkite\user\manager\CodeManager;
use dxkite\user\manager\EmailCheckManager;
use suda\mail\Factory;
use suda\mail\message\HTMLMessage;

class ResetResponse extends Response
{
    public function onVisit(Context $context)
    {
        if (context()->getSession('resetEmail')) {
            $this->reset();
        } elseif ($token=request()->get()->token) {
            if ($userId=EmailCheckManager::check($token)) {
                context()->setSession('resetEmail', $userId);
                $this->reset();
            } else {
                $this->index(false);
            }
        } else {
            $this->index();
        }
    }
    
    public function index($bool=true)
    {
        $view=$this->page('user:reset/index');
        if (request()->hasPost()) {
            $account=request()->post('account');
            $code=request()->post('code');
            if ($account && $code) {
                if (CodeManager::check($code)) {
                    $userId= UserManager::getAccountId($account);
                    if ($userId) {
                        if ($user=UserManager::getInfo($userId)) {
                            $sender=Factory::sender();
                            $message=new HTMLMessage(setting('website_name', 'DXkite').' - 密码重置', 'user:reset/password', [
                                'user'=>$user,
                                'token'=>EmailCheckManager::create($user['id'], $user['email']),
                            ]);
                            $message->setTo($user['email']);
                            // $message->setFrom('no_reply@'.($_SERVER['HTTP_HOST'] ?? 'atd3.cn'),setting('website_name', 'DXkite') .' - 邮件中心' );
                            if ($sender->send($message)) {
                                return $this->sended();
                            }
                        }
                    } else {
                        $view->set('invaildInput', true);
                    }
                } else {
                    $view->set('invaildCode', true);
                }
            }
        }
        if ($bool ==false) {
            $view->set('alter', ['type'=>'danger','message'=>__('你的验证邮件已经失效，请重新申请')]);
        }
        $view->render();
    }

    public function reset()
    {
        $view=$this->page('user:reset/reset');
        if (request()->hasPost()) {
            $userId=context()->getSession('resetEmail');
            $password=request()->post('password');
            $repeat=request()->post('repeat');
            if ($userId && $password && $repeat && $password == $repeat) {
                UserManager::setEmailChecked($userId);
                UserManager::editPassword($userId, $password);
                context()->delSession('resetEmail');
                $view=$this->page('user:reset/success');
            } else {
                $view->set('passwordError', true);
            }
        }
        $view->set('title', '重置密码');
        $view->render();
    }

    public function sended()
    {
        $view=$this->page('user:reset/sended');
        $view->set('title', '邮件已经发送');
        $view->render();
    }
}
