<?php if (!class_exists("Template_eaf630ea80b398e5a4c94466156e64a8", false)) { class Template_eaf630ea80b398e5a4c94466156e64a8 extends suda\template\compiler\suda\Template { protected $name="user:setting";protected $module="user"; protected $source="D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/setting.tpl.html";protected function _render_template() {  ?><?php $this->execHook('home-content',function () { ?>
<form action="<?php echo $this->url(['edit'=>'base']); ?>" method="POST" enctype="multipart/form-data">
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
            <label for="staticEmail" class="col-sm-2 col-form-label">用户名</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext"  value="<?php echo htmlspecialchars(__($this->get("user.name"))); ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">邮箱</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars(__($this->get("user.email"))); ?>">
            </div>
        </div>
        <div class="row">
            <button class="btn btn-primary">修改信息</button>
        </div>
    </fieldset>
</form>

<form action="<?php echo $this->url(['edit'=>'password']); ?>" method="POST">
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label">
                <h4>用户密码</h4>
            </legend>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">原始密码
            </label>
            <div class="col-sm-10">
                <input type="password" name="check" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">新密码
            </label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">重复输入
            </label>
            <div class="col-sm-10">
                <input type="password" name="repeat" class="form-control">
            </div>
        </div>
        <div class="row">
            <button class="btn btn-primary">修改密码</button>
        </div>
    </fieldset>
</form>
<?php $this->execGlobalHook("user.home.setting"); ?> <?php });?> <?php suda\template\Manager::include('user:home-base',$this)->echo(); ?><?php }} } return ["class"=>"Template_eaf630ea80b398e5a4c94466156e64a8","name"=>"user:setting","source"=>"D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/setting.tpl.html","module"=>"user"]; 