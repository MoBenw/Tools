<?php
namespace demo\attend\provider;

use demo\attend\controller\AttendController;

class AttendProvider
{
    protected $controller;

    public function __construct()
    {
        $this->controller = new AttendController;
    }

    public function write(array $data) 
    {
        $result=$this->controller ->write($data);
        if ($result){
            session()->set('name',$data['name']);
        }
        return $result;
    }

}
