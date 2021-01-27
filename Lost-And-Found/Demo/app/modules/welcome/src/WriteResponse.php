<?php

namespace suda\lostandfound\response;

use suda\core\Request;
use suda\core\Response;
use suda\lostandfound\table\ObjectTable;

class WriteResponse extends Response
{
    public function onRequest(Request $request)
    {
        $view = $this->page('write');
        $userStatus=session()->get('status');
        $table = new ObjectTable;

        $yourType = $request->post('type');
        $yourName = $request->post('name');
        $yourTime = $request->post('time');
        $yourPlace = $request->post('place');
        $yourTel = $request->post('tel');
        $yourDesc = $request->post('desc');

        if ($request->hasPost()){
            if ($userStatus==1){
                $id = $table-> insert([
                    'name' => $yourName,
                    'type' => $yourType,
                    'time' => $yourTime,
                    'place' => $yourPlace,
                    'tel' => $yourTel,
                    'status' => 1,
                    'desc' => $yourDesc,
                ]);
                if ($id > 0) {
                    $this->go(@u("index"));
                }
            }else{
                $this->go(@u("signin"));
            }
        }
        $view->render();
    }
}
