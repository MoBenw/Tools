<?php
namespace dxkite\user\response\setting;

use dxkite\support\visitor\Context;
use dxkite\support\template\Manager;
use dxkite\user\table\UserTable;
use dxkite\user\manager\UserManager;
use dxkite\support\file\{File};

class EditResponse extends \dxkite\support\setting\Response
{
    public function onAdminView($view, $context)
    {
        $userId=request()->get('id', 0);
        $file=request()->files('avatar');
        try {
            if ($file && $file['error'] == 0) {
                $file= File::createFromPost('avatar');
                UserManager::setAvatar($file, $userId);
            }
            
            $name =request()->post('name');
            $email =request()->post('email');
            $password =request()->post('password');
            if ($name && $email  ) {
                UserManager::editUser($userId, $name, $email);
            }
            if ($password){
                UserManager::editPassword($userId,$password);
            }
        } catch (UserException $e) {
            switch ($e->getCode()) {
            case UserException::NAME_FORMAT_ERROR:
                $view->set('error', [
                    'type'=>'danger',
                    'title'=>__('用户名修改失败'),
                    'message'=>__('用户名格式错误')
                ]);
            break;
            case UserException::NAME_EXISTS_ERROR:
                $view->set('error', [
                    'type'=>'danger',
                    'title'=>__('用户名修改失败'),
                    'message'=>__('用户名已被占用')
                ]);
            break;
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
                'title'=>__('修改用户信息失败'),
                'message'=>__($e->getMessage())
            ]);
        }
        }
   
        if ($user=UserManager::getInfo($userId)) {
            $view->set('user', $user);
            hook()->exec('dxkite.user.response.setting.Edit.response', [$userId,$this,$view]);
        }else{
            $view->set('invaildId', true);
        }
    }

    public function adminContent($template)
    {
        \suda\template\Manager::include('user:setting/edit', $template)->render();
    }
}
