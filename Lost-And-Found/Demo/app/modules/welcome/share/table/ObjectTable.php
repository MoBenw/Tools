<?php
namespace suda\lostandfound\table;

class ObjectTable extends \suda\archive\Table {
    
    public function  __construct(){
        // table name 
        parent::__construct('object');
    }

    protected function onBuildCreator($table){
        $table->fields(
            $table->field('id','bigint',20)->primary()->auto()->comment('自动增长ID'),
            $table->field('name','text'),
            $table->field('type','text'),
            $table->field('time','text'),
            $table->field('place','text'),
            $table->field('tel','text'),
            $table->field('status','text'),
            $table->field('desc','text')
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