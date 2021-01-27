<?php if (!class_exists("Template_af7771f0be55c6c429ebf08d040d7cdf", false)) { class Template_af7771f0be55c6c429ebf08d040d7cdf extends suda\template\compiler\suda\Template { protected $name="user:home-base";protected $module="user"; protected $source="D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/home-base.tpl.html";protected function _render_template() {  ?><?php $this->set('title',__('用户中心')); ?> <?php $this->set('lang','Zh-cn'); ?> <?php $this->execHook('bs-head',function () { ?>
<link rel="stylesheet" href="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/home.css"> <?php });?> <?php $this->execHook('bs-content',function () { ?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><?php echo htmlspecialchars(__("用户中心")); ?></a>
        <a class="btn btn-light btn-sm" href="<?php echo $this->url('user:signout'); ?>" role="button">退出登录</a>
    </div>
</nav>
<div class="container">
    <div class="row">

        <div class="col-sm-4">
            <img class="user-avatar rounded-circle" src="<?php echo $this->url('user:avatar',['id'=> $this->get("user.id",0)]); ?>" alt="User Avatar">
            <h4 class="user-name"><?php echo htmlspecialchars(__($this->get("user.name",'用户名'))); ?></h4>
            <?php $this->exec('home-sidebar'); ?> <?php $this->execGlobalHook("user.home.sidebar"); ?>
        </div>
        <div class="col-sm-8">
            <?php if($this->get("error",false)): ?>
            <div class="alert alert-<?php echo htmlspecialchars(__($this->get("error.type"))); ?>" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php if($this->get("error.title",false)): ?>
                <h5 class="alert-heading"><?php echo htmlspecialchars(__($this->get("error.title"))); ?></h5>
                <?php endif; ?> <?php echo htmlspecialchars(__($this->get("error.message"))); ?>
            </div>
            <?php endif; ?>
            <ul class="nav  nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?php if($this->isMe('user:index')): ?> active <?php endif; ?>" href="<?php echo $this->url('user:index'); ?>">个人信息</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($this->isMe('user:setting')): ?> active <?php endif; ?>" href="<?php echo $this->url('user:setting'); ?>">编辑信息</a>
                </li>
                <?php $this->exec('home-navtabs'); ?> <?php $this->execGlobalHook("user.home.navtabs"); ?>
            </ul>
            <main class="main">
                <?php $this->exec('home-content'); ?> <?php $this->execGlobalHook("user.home.content"); ?>
            </main>
        </div>
    </div>
</div>
<?php });?> <?php suda\template\Manager::include('support:bootstrap',$this)->echo(); ?><?php }} } return ["class"=>"Template_af7771f0be55c6c429ebf08d040d7cdf","name"=>"user:home-base","source"=>"D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/home-base.tpl.html","module"=>"user"]; 