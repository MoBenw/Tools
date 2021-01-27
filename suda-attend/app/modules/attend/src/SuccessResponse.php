<?php
namespace demo\attend\response;

use suda\core\Request;

class SuccessResponse extends \suda\core\Response
{
    public function onRequest(Request $request)
    {
        $view=$this->page('success');
        $name=session()->get('name');
        $view->set('name',$name);
        $view->set('date',date("Y年m月d H:i:s"));
        $view->set('time',date("H点i分s秒"));
        $view->render();

    }
}