<?php

namespace suda\lostandfound\response;

use suda\core\Request;
use suda\core\Response;
use suda\lostandfound\table\UserTable;

class SettingResponse extends Response
{
    public function onRequest(Request $request)
    {
        $view = $this->page('setting');
        if (session()->get('role') == 1){
            $table = new UserTable;
            $userinfo = $table->list();
            $view->set('fields',$userinfo);
        }else{
            $this->go(@u('index'));
        }
        $view->render();
    }
}
