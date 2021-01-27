<?php
namespace demo\attend\controller;

use demo\attend\table\AttendTable;

class AttendController
{
    protected $table;

    public function __construct()
    {
        $this->table = new AttendTable;
    }

    public function write(array $data)
    {
        //判断信息是否填写完整
        $tables = app()->getModuleConfig(app()->getFileModule(__FILE__), 'attend');
        $field=$tables['fields'];
        if (!array_key_exists('qq',$data)){
            if (!array_key_exists('weixin',$data)){
                throw new \Exception(__('数据未填写完整 请填写%s或者%s',$field['qq']['name'],$field['weixin']['name']));
            } 
        }
        unset($field['qq'],$field['weixin']);
        foreach ($field as $key => $value){
            if (!array_key_exists($key,$data)){
                throw new \Exception(__('数据未填写完整 %s 不存在',$value['name']));
            }
        }
        // 处理空格
        // array_filter($data,'trim');

        //处理学号数据类型及长度
        if (!preg_match('/^201\d{5}$/',trim($data['id_number']))) {
            throw new \Exception(__('请正确填写学号 您的填写情况：%s',trim($data['id_number'])));
        }

        //处理手机号数据类型及长度
        if (!preg_match('/^1\d{10}$/',trim($data['tel_number']))){
            throw new \Exception(__('请正确填写手机号 您的填写情况：%s',trim($data['tel_number'])));
        }


        

        //测试
        // if (strlen($data['tel_number']))
        // throw new \Exception('qwe');

        $where = [
            'id_number' => $data['id_number']
        ];
        if ($datas = $this->table->select(['id'],$where)->fetch() ) {
            //当学号存在时
            if ($this->table->updateByPrimaryKey($datas['id'],[
                'data' => $data,
            ])){
                return true;
            }
        }else {
            $id = $this->table-> insert([
                'id_number' => $data['id_number'],
                'data' => $data,
            ]);
            if ($id > 0) {
                return true; 
            }
        }
        return false;
    }
}