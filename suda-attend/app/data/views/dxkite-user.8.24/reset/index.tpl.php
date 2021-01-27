<?php if (!class_exists("Template_33dd9b21c4e2d89b23d046e0bccd1193", false)) { class Template_33dd9b21c4e2d89b23d046e0bccd1193 extends suda\template\compiler\suda\Template { protected $name="user:reset/index";protected $module="user"; protected $source="D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/reset/index.tpl.html";protected function _render_template() {  ?><?php $this->set('title',__('用户登陆页面')); ?> <?php $this->set('lang','Zh-cn'); ?> <?php $this->execHook('bs-head',function () { ?>
<link href="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/sign.css" rel="stylesheet"> <?php });?> <?php $this->execHook('bs-content',function () { ?>
<div class="container">
    <?php if($this->get("alter",false)): ?>
    <div class="alert alert-<?php echo htmlspecialchars(__($this->get("alter.type"))); ?>" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <?php if($this->get("alter.title",false)): ?>
        <h5 class="alert-heading"><?php echo htmlspecialchars(__($this->get("alter.title"))); ?></h5>
        <?php endif; ?> <?php echo htmlspecialchars(__($this->get("alter.message"))); ?>
    </div>
    <?php endif; ?>
    <form class="form-sign" id="form-signin" action="<?php echo suda\core\Router::getInstance()->buildUrl(suda\core\Response::$name,$_GET,false); ?>" method="POST">
        <h2 class="form-sign-heading"> <?php echo htmlspecialchars(__(__('重置密码'))); ?></h2>

        <div class="form-group">
            <label for="username" class="sr-only"><?php echo htmlspecialchars(__(__('账号或者邮箱'))); ?></label>
            <input type="text" name="account" id="username" class="form-control <?php if($this->get("invaildInput",false)): ?> is-invalid <?php endif; ?>" placeholder="<?php echo htmlspecialchars(__(__('账号或者邮箱'))); ?>"
                required autofocus value="<?php echo htmlspecialchars(__($this->get("user",''))); ?>"> <?php if($this->get("invaildInput",false)): ?>
            <div id="invaildCode" class="invalid-feedback"> <?php echo htmlspecialchars(__(__("账号或者邮箱不存在"))); ?></div>
            <?php endif; ?>
        </div>


        <div class="form-group" id="verify-image">
            <div class="input-group">
                <div class="input-group-prepend ">
                    <img id="verify_code_image" src="<?php echo $this->url('user:verify'); ?>" class="input-group-text verify-image" alt="verfiy">
                </div>
                <input type="text" name="code" class="form-control  <?php if($this->get("invaildCode",false)): ?> is-invalid <?php endif; ?>" id="verifycode" placeholder="<?php echo htmlspecialchars(__(__('验证码'))); ?>"> <?php if($this->get("invaildCode",false)): ?>
                <div id="invaildCode" class="invalid-feedback"> <?php echo htmlspecialchars(__(__("验证码错误"))); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <button id="sigin-button" class="btn btn-lg btn-primary btn-block" type="submit"> <?php echo htmlspecialchars(__(__('发送验证邮件'))); ?> </button>
    </form>
</div>

<?php });?> <?php $this->execHook('bs-footer',function () { ?>
<script>
    $(function () {
        var src = $('#verify_code_image').attr('src');
        $('#verify_code_image').on('click', function () {
            this.src = src + '?' + new Date().getTime();
        });
    });
</script>
<?php });?> <?php suda\template\Manager::include('support:bootstrap',$this)->echo(); ?><?php }} } return ["class"=>"Template_33dd9b21c4e2d89b23d046e0bccd1193","name"=>"user:reset/index","source"=>"D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/reset/index.tpl.html","module"=>"user"]; 