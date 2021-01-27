<?php

namespace suda\lostandfound\response;

use suda\core\Request;
use suda\core\Response;
use suda\lostandfound\table\ObjectTable;

class IndexResponse extends Response
{
    public function onRequest(Request $request)
    {
        $view = $this->page('index');

        $table = new ObjectTable;
        $userinfo = $table->list();
        $view->set('fields',$userinfo);


        $view->render();
    }
}
