<?php

namespace suda\lostandfound\response;

use suda\core\Request;
use suda\core\Response;
use suda\lostandfound\table\ObjectTable;

class ShowResponse extends Response
{
    public function onRequest(Request $request)
    {
        $view = $this->page('show');
        $table = new ObjectTable;
        $id = request()->get('id');

        $userinfo = $table->list();
        $view->set('fields',$userinfo[$id]);

        $view->render();
    }
}
