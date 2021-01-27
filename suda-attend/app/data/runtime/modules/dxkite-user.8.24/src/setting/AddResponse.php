<?php
namespace dxkite\user\response\setting;

use dxkite\support\visitor\Context;
use dxkite\support\template\Manager;
use dxkite\user\table\UserTable;
use dxkite\user\manager\UserManager;
use dxkite\user\exception\UserException;
use dxkite\support\file\{File};
class AddResponse extends \dxkite\support\setting\Response
{
    public function onAdminView($view, $context)
    {
        if (request()->hasPost()) {
            $name =request()->post('name');
            $email =request()->post('email');
            $password =request()->post('password');
            if ($name && $email && $password) {
                try {
                    $userId=table('user')->add($name, $email, $password);
                    hook()->exec('dxkite.user.response.setting.Add.response', [$userId,$this,$view]);
                    $file=request()->files('avatar');
                    if ($file && $file['error'] == 0) {
                        $file= File::createFromPost('avatar');
                        UserManager::setAvatar($file, $userId);
                    }
                    $view->set('error', [
                        'type'=>'success',
                        'message'=>__('添加用户成功')
                    ]);
                } catch (UserException $e) {
                    switch ($e->getCode()) {
                        case UserException::NAME_FORMAT_ERROR:
                        $view->set('error', [
                            'type'=>'danger',
                            'message'=>__('用户名格式错误')
                        ]);
                    break;
                    case UserException::NAME_EXISTS_ERROR:
                        $view->set('error', [
                            'type'=>'danger',
                            'message'=>__('用户名已被占用')
                        ]);
                    break;
                    case UserException::EMAIL_FORMAT_ERROR:
                        $view->set('error', [
                            'type'=>'danger',
                            'message'=>__('邮箱格式错误')
                        ]);
                    break;
                    case UserException::EMAIL_EXISTS_ERROR:
                        $view->set('error', [
                            'type'=>'danger',
                            'message'=>__('邮箱已被占用')
                        ]);
                    break;
                    default:
                    $view->set('error', [
                        'type'=>'danger',
                        'title'=>__('添加用户失败'),
                        'message'=>__($e->getMessage())
                    ]);
                    }
                }
            }
        }
    }

    public function adminContent($template)
    {
        \suda\template\Manager::include('user:setting/add', $template)->render();
    }
}
