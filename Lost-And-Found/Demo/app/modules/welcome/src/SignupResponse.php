<?php

namespace suda\lostandfound\response;

use suda\core\Request;
use suda\core\Response;
use suda\lostandfound\table\UserTable;

class SignupResponse extends Response
{
    public function onRequest(Request $request)
    {
        $view = $this->page('signup');
        $table = new UserTable;

        $yourTel = $request->post('tel');
        $yourPasswd = $request->post('passwd');

        if ($request->hasPost()){
            $id = $table-> insert([
                'tel' => $yourTel,
                'passwd' => $yourPasswd,
                'role' => 1,
            ]);
            if ($id > 0) {
                session()->set('id',$id);
                session()->set('tel',$yourTel);
                session()->set('status',1);
                $this->go(@u("index"));
            }
        }
        $view->render();
    }
}
