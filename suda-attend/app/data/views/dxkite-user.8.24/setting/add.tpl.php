<?php if (!class_exists("Template_98368f8bf1a6b4bca1ec3f3eae9e4cc2", false)) { class Template_98368f8bf1a6b4bca1ec3f3eae9e4cc2 extends suda\template\compiler\suda\Template { protected $name="user:setting/add";protected $module="user"; protected $source="D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/setting/add.tpl.html";protected function _render_template() {  ?> <?php if($this->get("error",false)): ?>
<div class="alert alert-<?php echo htmlspecialchars(__($this->get("error.type"))); ?>" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <?php if($this->get("error.title",false)): ?>
    <h5 class="alert-heading"><?php echo htmlspecialchars(__($this->get("error.title"))); ?></h5>
    <?php endif; ?> <?php echo htmlspecialchars(__($this->get("error.message"))); ?>
</div>
<?php endif; ?>
<form  class="p-2" action="<?php echo suda\core\Router::getInstance()->buildUrl(suda\core\Response::$name,$_GET,false); ?>" method="POST" enctype="multipart/form-data">
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label">
                <h4>注册信息</h4>
            </legend>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">头像</label>
            <div class="col-sm-10">
                <input type="file" name="avatar">
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 col-form-label">用户名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name">
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 col-form-label">邮箱</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email">
            </div>
        </div>
        <div class="form-group row">
            <label  class="col-sm-2 col-form-label">密码</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="password">
            </div>
        </div>
        <?php $this->execGlobalHook("dxkite.user.response.setting.Add.view"); ?>
        <div class="row">
            <button class="btn btn-primary">添加用户</button>
        </div>
    </fieldset>
</form><?php }} } return ["class"=>"Template_98368f8bf1a6b4bca1ec3f3eae9e4cc2","name"=>"user:setting/add","source"=>"D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/setting/add.tpl.html","module"=>"user"]; 