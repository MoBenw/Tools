<?php
namespace dxkite\user\response\setting;

use dxkite\support\visitor\Context;
use dxkite\support\template\Manager;
use dxkite\user\table\UserTable;

class ListResponse extends \dxkite\support\setting\Response
{
    public function onAdminView($view, $context)
    {
        if (request()->get()->active>0) {
            table('user')->setStatus(request()->get()->active, UserTable::STATUS_ACTIVE);
            return $this->refresh();
        }

        if (request()->get()->freeze>0) {
            table('user')->setStatus(request()->get()->freeze, UserTable::STATUS_FREEZE);
            return $this->refresh();
        }

        if (request()->get()->delete>0) {
            if (request()->get()->delete != get_user_id()) {
                table('user')->deleteByPrimaryKey(request()->get()->delete, UserTable::STATUS_FREEZE);
            }
            return $this->refresh();
        }

        $page=request()->get()->page(1);
        if (isset(request()->get()->search)) {
            if (request()->get()->type=='name') {
                $list= table('user')->setFields(['id','name','email','signupTime','status'])->searchByName(request()->get()->search);
            } else {
                $list= table('user')->setFields(['id','name','email','signupTime','status'])->searchByEmail(request()->get()->search);
            }
            $view->set('page.next', count($list)>=10);
            $view->set('title', __('用户列表 - 搜索结果 第%d页', $page));
        } else {
            $list=table('user')->setFields(['id','name','email','signupTime','status'])->list($page, 10);
            $view->set('title', __('用户列表 第%d页', $page));
            $view->set('page.max', ceil(table('user')->count()/10));
        }
        $view->set('page.router', 'user:admin_list');
        $view->set('list', $list);
    }

    public function adminContent($template)
    {
        $page=request()->get()->page(1);
        $template->set('page.now', $page);
        \suda\template\Manager::include('user:setting/list', $template)->render();
    }
}
