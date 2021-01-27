<?php if (!class_exists("Template_b1d579193e479d13aec73bc2b7c9d8f5", false)) { class Template_b1d579193e479d13aec73bc2b7c9d8f5 extends suda\template\compiler\suda\Template { protected $name="user:signup";protected $module="user"; protected $source="D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/signup.tpl.html";protected function _render_template() {  ?><?php $this->set('title',__('用户注册页面')); ?> <?php $this->set('lang','cn'); ?> 
<?php $this->execHook('bs-head',function () { ?>
<link href="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/sign.css" rel="stylesheet"> 
<?php });?> <?php $this->execHook('bs-content',function () { ?>
<div class="container">
    <form class="form-sign" id="form-signup" action="<?php echo suda\core\Router::getInstance()->buildUrl(suda\core\Response::$name,$_GET,false); ?>" method="POST">
        <h2 class="form-sign-heading"> <?php echo htmlspecialchars(__(__('用户注册'))); ?></h2>
        <div class="form-group">
            <label for="username" class="sr-only"><?php echo htmlspecialchars(__(__('用户名'))); ?></label>
            <input type="text" name="name" id="username" class="form-control  <?php if($this->get("invaildName",false)): ?> is-invalid <?php endif; ?>" placeholder="<?php echo htmlspecialchars(__(__('用户名'))); ?>" required autofocus value="<?php echo htmlspecialchars(__($this->get("name",''))); ?>">
            <?php if($this->get("invaildName",false)): ?>
            <div id="name_error" class="invalid-feedback"> <?php echo htmlspecialchars(__(__($this->get("invaildName")))); ?></div>
            <?php else: ?>
        <small id="nameHelpInline" class="form-text text-muted"> <?php echo htmlspecialchars(__(__('用户名可以为中文、英文、数字、下划线，长度在4~13个字符之间。'))); ?> </small>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="email" class="sr-only"><?php echo htmlspecialchars(__(__('邮箱'))); ?></label>
            <input type="email" name="email" id="email" class="form-control  <?php if($this->get("invaildEmail",false)): ?> is-invalid <?php endif; ?>" placeholder="<?php echo htmlspecialchars(__(__('邮箱'))); ?>" required value="<?php echo htmlspecialchars(__($this->get("email",''))); ?>">            
            <?php if($this->get("invaildEmail",false)): ?>
            <div id="email_error" class="invalid-feedback"> <?php echo htmlspecialchars(__(__($this->get("invaildEmail")))); ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="passworld" class="sr-only"><?php echo htmlspecialchars(__(__('密码'))); ?></label>
            <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo htmlspecialchars(__(__('密码'))); ?>" required>            
        </div>
        <div class="form-group">
            <label for="repeat" class="sr-only"><?php echo htmlspecialchars(__(__('重复输入'))); ?></label>
            <input type="password"  name="repeat" id="repeat" class="form-control  <?php if($this->get("passwordError",false)): ?> is-invalid <?php endif; ?>" placeholder="<?php echo htmlspecialchars(__(__('重复输入'))); ?>" required>            
            <?php if($this->get("passwordError",false)): ?>
            <div class="invalid-feedback"> <?php echo htmlspecialchars(__(__("两次输入的密码不相同"))); ?></div>
            <?php endif; ?>
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
        <div class="form-group <?php if($this->get("invaildInvite",false)): ?> is-invalid <?php endif; ?>">
                <label for="invite" class="sr-only"><?php echo htmlspecialchars(__(__('邀请码'))); ?></label>
                <input type="text"  name="invite" id="invite" class="form-control" placeholder="<?php echo htmlspecialchars(__(__('邀请码'))); ?>" required value="<?php echo htmlspecialchars(__($this->get("invite",''))); ?>">            
                <?php if($this->get("invaildInvite",false)): ?>
                <div class="invalid-feedback"> <?php echo htmlspecialchars(__(__("邀请码错误"))); ?></div>
                <?php endif; ?>
            </div>
        <button id="signup-button" class="btn btn-lg btn-primary btn-block" type="submit"> <?php echo htmlspecialchars(__(__('注册'))); ?> </button>
        <a href="<?php echo $this->url('user:signin'); ?>"> <?php echo htmlspecialchars(__(__('登陆账号'))); ?></a>
    </form>
</div>
<?php });?>
<?php $this->execHook('bs-footer',function () { ?>
<script>
    $(function () {
        var src = $('#verify_code_image').attr('src');
        $('#verify_code_image').on('click', function () {
            this.src = src + '?' + new Date().getTime();
        });
    });
</script>
<?php });?>
<?php suda\template\Manager::include('support:bootstrap',$this)->echo(); ?><?php }} } return ["class"=>"Template_b1d579193e479d13aec73bc2b7c9d8f5","name"=>"user:signup","source"=>"D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/signup.tpl.html","module"=>"user"]; 