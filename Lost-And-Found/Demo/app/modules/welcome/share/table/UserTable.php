<?php
namespace suda\lostandfound\table;

class UserTable extends \suda\archive\Table {
    
    public function  __construct(){
        // table name 
        parent::__construct('user');
    }

    protected function onBuildCreator($table){
        $table->fields(
            $table->field('id','bigint',20)->primary()->auto()->comment('自动增长ID'),
            $table->field('tel','text')->comment('电话号码'),
            $table->field('passwd','text'),
            $table->field('role','text')
        );
        return $table;
    }

    protected function _inputDataField($data){
        return serialize($data);
    }

    protected function _outputDataField($data){
        return unserialize($data);
    }
}