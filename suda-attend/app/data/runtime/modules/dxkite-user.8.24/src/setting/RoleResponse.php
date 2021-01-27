<?php
namespace dxkite\user\response\setting;

use dxkite\support\visitor\Context;
use dxkite\support\visitor\GrantManager;
use dxkite\support\template\Manager;
use dxkite\user\table\UserTable;
use dxkite\user\manager\UserManager;
use dxkite\support\file\{File};

class RoleResponse extends \dxkite\support\setting\Response
{
    public function onAdminView($view, $context)
    {
        $userId=request()->get('id', 0);
        if ($user=UserManager::getInfo($userId)) {
            $view->set('user', $user);
            $role=table('role')->list();
            $view->set('roles', $role??[]);
            if ($grant=request()->get()->grant) {
                (new GrantManager)->grant($grant, $userId);
                $this->refresh();
            }
            if ($grant=request()->get()->revoke) {
                (new GrantManager)->revoke($grant, $userId);
                $this->refresh();
            }
            $grants= table('grant')->select(['grant'], ['grantee'=>$userId])->fetchAll();
            if (is_array($grants)) {
                foreach ($grants as $item) {
                    $grantIds[]=$item['grant'];
                }
                $list=  table('role')->select(['id','name','permission'], ['id'=>$grantIds])->fetchAll();
                $view->set('list', $list?:[]);
            }
        } else {
            $this->go(u('user:admin_list'));
        }
    }

    public function adminContent($template)
    {
        \suda\template\Manager::include('user:setting/role', $template)->render();
    }
}
