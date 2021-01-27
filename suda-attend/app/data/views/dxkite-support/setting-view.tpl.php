<?php if (!class_exists("Template_839655981f7dc3ad465397c9c873eefa", false)) { class Template_839655981f7dc3ad465397c9c873eefa extends suda\template\compiler\suda\Template { protected $name="support:setting-view";protected $module="support"; protected $source="D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-support\\resource\\template\\default/setting-view.tpl.html";protected function _render_template() {  ?><?php $this->execHook('bs-head',function () { ?>
<link href="<?php echo suda\template\Manager::assetServer('/static/dxkite-support');?>/setting.css" rel="stylesheet">
<?php });?> <?php $this->execHook('bs-content',function () { ?> <?php suda\template\Manager::include('header',$this)->echo(); ?>
<div class="container-fluid">
    <div class="row">
        <?php suda\template\Manager::include('sidebar',$this)->echo(); ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            <?php echo $this->response->adminContent($this); ?>
            <?php $this->exec('admin-content'); ?>
        </main>
    </div>
</div>
<?php });?> <?php suda\template\Manager::include('bootstrap',$this)->echo(); ?><?php }} } return ["class"=>"Template_839655981f7dc3ad465397c9c873eefa","name"=>"support:setting-view","source"=>"D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-support\\resource\\template\\default/setting-view.tpl.html","module"=>"support"]; 