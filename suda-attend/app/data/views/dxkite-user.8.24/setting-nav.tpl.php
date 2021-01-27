<?php if (!class_exists("Template_eebb51b56c47e90219e0288068eb368c", false)) { class Template_eebb51b56c47e90219e0288068eb368c extends suda\template\compiler\suda\Template { protected $name="user:setting-nav";protected $module="user"; protected $source="D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/setting-nav.tpl.html";protected function _render_template() {  ?><li class="nav-item text-nowrap">
    <a class="nav-link" href="<?php echo $this->url('user:index'); ?>" target="_blank"><?php echo htmlspecialchars(__($this->get("user.name"))); ?></a>
</li>
<li class="nav-item text-nowrap">
    <a class="nav-link" href="<?php echo $this->url('user:signout'); ?>">退出登录</a>
</li><?php }} } return ["class"=>"Template_eebb51b56c47e90219e0288068eb368c","name"=>"user:setting-nav","source"=>"D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/setting-nav.tpl.html","module"=>"user"]; 