<?php

namespace suda\lostandfound\response;

use suda\core\Request;
use suda\core\Response;
use suda\lostandfound\table\UserTable;

class SigninResponse extends Response
{
    public function onRequest(Request $request)
    {
        $view = $this->page('signin');
        $table = new UserTable;

        $yourTel = $request->post('tel');
        $yourPasswd = $request->post('passwd');

        if ($request->hasPost()){
            $where = [
                'tel' => $yourTel,
                'passwd' => $yourPasswd,
            ];
            $userinfo = $table->select(['id','role'],$where)->fetch();
            if ($userinfo){
                var_dump($userinfo);
                session()->set('id',$userinfo['id']);
                session()->set('role',$userinfo['role']);
                session()->set('tel',$yourTel);
                session()->set('status',1);
                $this->go(@u("index"));
            }
        }

        $view->render();
    }
}
