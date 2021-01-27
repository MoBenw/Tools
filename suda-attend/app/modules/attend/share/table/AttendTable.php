<?php
namespace demo\attend\table;

class AttendTable extends \suda\archive\Table {
    
    public function  __construct(){
        // table name 
        parent::__construct('attend');
    }

    protected function onBuildCreator($table){
        $table->fields(
            $table->field('id','bigint',20)->primary()->auto()->comment('自动增长ID'),
            $table->field('id_number','text')->comment('学号'),
            $table->field('data','text')
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