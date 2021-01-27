<?php if (!class_exists("Template_c0c2ca5c49c63a8d12aae60b2f2e428e", false)) { class Template_c0c2ca5c49c63a8d12aae60b2f2e428e extends suda\template\compiler\suda\Template { protected $name="user:home";protected $module="user"; protected $source="D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/home.tpl.html";protected function _render_template() {  ?><?php $this->execHook('home-content',function () { ?>
<form>
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label">
                <h4>注册信息</h4>
            </legend>
        </div>
        <div class="form-group row">
            <label for="staticName" class="col-sm-2 col-form-label">用户名</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticName" value="<?php echo htmlspecialchars(__($this->get("user.name"))); ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">邮箱 <?php if($this->get("user.validEmail",0) == 0): ?>
                <span class="badge badge-warning">未验证</span><?php else: ?>
                <span class="badge badge-success">已验证</span>
                <?php endif; ?>
            </label>
            <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo htmlspecialchars(__($this->get("user.email"))); ?>">
            </div>
            <div class="col-sm-2">
                <?php if($this->get("user.validEmail",0) == 0): ?>
                <a class="btn btn-primary" type="button" href="<?php echo suda\core\Router::getInstance()->buildUrl(suda\core\Response::$name,$_GET,false,(['checkEmail'=>1])); ?>">验证</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">邀请码
            </label>
            <div class="col-sm-8">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="<?php echo htmlspecialchars(__($this->get("inviteCode",'获取失败'))); ?>">
            </div>
            <div class="col-sm-2">
                <a class="btn btn-primary" href="<?php echo $this->url(['invite'=>'refresh']); ?>">重新生成</a>
            </div>
        </div>
    </fieldset>
</form>
<?php $this->execGlobalHook("user.home.info"); ?> <?php });?> <?php suda\template\Manager::include('user:home-base',$this)->echo(); ?><?php }} } return ["class"=>"Template_c0c2ca5c49c63a8d12aae60b2f2e428e","name"=>"user:home","source"=>"D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/home.tpl.html","module"=>"user"]; 