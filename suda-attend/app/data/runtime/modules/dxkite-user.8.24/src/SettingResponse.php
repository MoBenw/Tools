<?php
namespace dxkite\user\response;

use dxkite\support\visitor\response\VisitorResponse;
use dxkite\support\visitor\Context;
use dxkite\user\manager\UserManager;
use dxkite\support\file\{File};
use dxkite\user\exception\UserException;

class SettingResponse extends VisitorResponse
{
    public function onGuestVisit(Context $context)
    {
        $this->go(u('user:signin'));
        cookie()->set('refer', u());
        echo __('正在跳转登陆');
    }
    
    public function onUserVisit(Context $context)
    {
        $view=$this->page('user:setting');
        if ($user=UserManager::getInfo(get_user_id())) {
            $view->set('user', $user);
        }
        if (request()->get('edit') == 'base') {
            $this->editBase($view);
        }
       
        if (request()->get('edit') == 'password') {
            $this->editPassword($view);
        }
        $view->render();
    }

    public function editPassword($view)
    {
        $check =request()->post('check');
        $password =request()->post('password');
        $repeat =request()->post('repeat');

        if ($check && $password == $repeat) {
            try {
                UserManager::setPassword($check, $password);
                $view->set('error', [
                    'type'=>'success',
                    'message'=>__('修改密码成功')
                ]);
                $this->go(u());
            } catch (UserException $e) {
                $view->set('error', [
                    'type'=>'danger',
                    'title'=>__('修改密码失败'),
                    'message'=>__('原密码错误')
                ]);
            }
        } elseif ($password != $repeat) {
            $view->set('error', [
                'type'=>'danger',
                'title'=>__('修改密码失败'),
                'message'=>__('两次密码不相同')
            ]);
        }
    }

    public function editBase($view)
    {
        $file=request()->files('avatar');
        if ($file && $file['error'] == 0) {
            $file= File::createFromPost('avatar');
            UserManager::setAvatar($file);
            $this->go(u());
        }
        $email =request()->post('email');
        if ($email) {
            try {
                UserManager::setEmail($email);
                $this->go(u());
            } catch (UserException $e) {
                switch ($e->getCode()) {
                    case UserException::EMAIL_FORMAT_ERROR:
                    $view->set('error', [
                        'type'=>'danger',
                        'title'=>__('邮箱修改失败'),
                        'message'=>__('邮箱格式错误')
                    ]);
                    break;
                    case UserException::EMAIL_EXISTS_ERROR:
                    $view->set('error', [
                        'type'=>'danger',
                        'title'=>__('邮箱修改失败'),
                        'message'=>__('邮箱已被占用')
                    ]);
                    break;
                    default:
                    $view->set('error', [
                        'type'=>'danger',
                        'title'=>__('邮箱修改失败'),
                        'message'=>__($e->getMessage())
                    ]);
                }
            }
        }
    }
}
