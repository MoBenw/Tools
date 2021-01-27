<?php
namespace demo\attend\response\setting;

use dxkite\support\visitor\Context;
use dxkite\support\template\Manager;
use demo\attend\table\AttendTable;


class ListResponse extends \dxkite\support\setting\Response
{
    public function onAdminView($page, $context)
    {
        $tables = app()->getModuleConfig(app()->getFileModule(__FILE__), 'attend');

        $page=request()->get()->page(1);
        $view->set('list', table('attend')->list($page, 10));
        $max= table('attend')->count();
        $view->set('page.max', ceil($max/10));
        $view->set('page.router', 'attend:admin_role_list');
        $view->set('page.now', $page);
        // $auths=$context->getVisitor()->getPermission()->readPermissions();
        // $view->set('auths', $auths);
        
        //下载按钮
        if (request()->get('submit',null))
        {
            $this->download($tables['fields']);
        }
        
    }

    public function adminContent($template)
    {
        $tables = app()->getModuleConfig(app()->getFileModule(__FILE__), 'attend');
        $view = $this->page('attend:setting/list');
        $table = new AttendTable;
        
        //显示数据表中的数据
        $view->set('fields', $tables['fields']);

        $data=$table->list();




        $view->set('user',$table->list());
        
        // data 
        // key value 

        // newdata[attend.fields[key][name]]=data[key]

        $view->render();
    }



    public function download(array $fields)
    {
        $data = $this->exportData($fields);
        // 暂存文件
        $path = RUNTIME_DIR .'/'.'student-attend'.'.csv';
        storage()->put($path, $data);
        // 生成文件下载
        $this->file($path);
    }


    public function exportData(array $fields): string
    {
        $table = new AttendTable;
        // 列出同一个表格
        $datas =  $table->list();
        // 生成表头
        $csv = [];
        // 表头ID
        $header = [];
        foreach ($fields as $id  => $value) {
            $csv[0][$id] = $value['name'];
            $header[] = $id;
        }
        // 生成数据
        foreach ($datas as $data) {
            $id = count($csv);
            foreach ($data['data'] as $index => $value) {
                $csv[$id][$index]=$value;
            }
        }
        $text = '';
        foreach ($csv as $data) {
            $row = [];
            foreach ($header as $id) {
                $row[] = $data[$id];
            }
            $text .= implode(',', $row) . "\r\n";
        }
        return $text;
    }


    
}
