<?php if (!class_exists("Template_d34d10bbaa859665d9ebce958accfe2b", false)) { class Template_d34d10bbaa859665d9ebce958accfe2b extends suda\template\compiler\suda\Template { protected $name="user:signin";protected $module="user"; protected $source="D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/signin.tpl.html";protected function _render_template() {  ?><?php $this->set('title',__('用户登陆页面')); ?> <?php $this->set('lang','Zh-cn'); ?> <?php $this->execHook('bs-head',function () { ?>
<link href="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/sign.css" rel="stylesheet"> <?php });?> <?php $this->execHook('bs-content',function () { ?>

<div class="container">

    <form class="form-sign" id="form-signin" action="<?php echo suda\core\Router::getInstance()->buildUrl(suda\core\Response::$name,$_GET,false); ?>" method="POST">
        <h2 class="form-sign-heading"> <?php echo htmlspecialchars(__(__('用户登陆'))); ?></h2>
        <?php if($this->get("invaildInput",false)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars(__("账号或者密码错误！")); ?>
        </div><?php endif; ?>
        <div class="form-group">
            <label for="username" class="sr-only"><?php echo htmlspecialchars(__(__('用户名'))); ?></label>
            <input type="text" name="account" id="username" class="form-control <?php if($this->get("invaildInput",false)): ?> is-invalid <?php endif; ?>" placeholder="<?php echo htmlspecialchars(__(__('用户名'))); ?>" required autofocus value="<?php echo htmlspecialchars(__($this->get("user",''))); ?>">
        </div>
        <div class="form-group">
            <label for="passwd" class="sr-only"><?php echo htmlspecialchars(__(__('密码'))); ?></label>
            <input type="password" name="password" id="passwd" class="form-control <?php if($this->get("invaildInput",false)): ?> is-invalid <?php endif; ?>" placeholder="<?php echo htmlspecialchars(__(__('密码'))); ?>" required>
        </div>

        <div class="form-group" id="verify-image">
            <div class="input-group">
                <div class="input-group-prepend ">
                    <img id="verify_code_image" src="<?php echo $this->url('user:verify'); ?>" class="input-group-text verify-image" alt="verfiy">
                </div>
                <input type="text" name="code" class="form-control  <?php if($this->get("invaildCode",false)): ?> is-invalid <?php endif; ?>" id="verifycode" placeholder="<?php echo htmlspecialchars(__(__('验证码'))); ?>">
                <?php if($this->get("invaildCode",false)): ?>
                <div id="invaildCode" class="invalid-feedback"> <?php echo htmlspecialchars(__(__("验证码错误"))); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input id="remember" name="remember" type="checkbox" value="true"> <?php echo htmlspecialchars(__(__('记住登陆'))); ?>
            </label>
        </div>
        <button id="sigin-button" class="btn btn-lg btn-primary btn-block" type="submit"> <?php echo htmlspecialchars(__(__('登陆'))); ?> </button>
        <a href="<?php echo $this->url('user:signup'); ?>"> <?php echo htmlspecialchars(__(__('注册账号'))); ?></a>
        <a href="<?php echo $this->url('user:reset_password'); ?>"> <?php echo htmlspecialchars(__(__('忘记密码'))); ?></a>
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
<?php });?> <?php suda\template\Manager::include('support:bootstrap',$this)->echo(); ?><?php }} } return ["class"=>"Template_d34d10bbaa859665d9ebce958accfe2b","name"=>"user:signin","source"=>"D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/signin.tpl.html","module"=>"user"]; 