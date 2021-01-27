<?php

namespace suda\lostandfound\response;

use suda\core\Request;
use suda\core\Response;

class UserResponse extends Response
{
    public function onRequest(Request $request)
    {
        $view = $this->page('user');
        $id = session()->get('id');
        $tel = session()->get('tel');
        $status = session()->get('status');
        if ($status==1){
            $view->set('id',$id);
            $view->set('tel',$tel);
            if ($request->hasPost()){
                session()->set('status',0);
                $this->go(@u('index'));
            }
        }else{
            $this->go(@u('index'));
        }
        
        $view->render();
    }
}
