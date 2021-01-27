<?php if (!class_exists("Template_ae7aa1a147ee2d9a2ca1deec7e33bb10", false)) { class Template_ae7aa1a147ee2d9a2ca1deec7e33bb10 extends suda\template\compiler\suda\Template { protected $name="support:sidebar";protected $module="support"; protected $source="D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-support\\resource\\template\\default/sidebar.tpl.html";protected function _render_template() {  ?><?php $this->execGlobalHook("setting.sidebar"); ?>
<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <!-- 侧边栏 -->
        <?php foreach($this->get("admin.sidebar",[]) as $id=>$item): ?>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <a class="d-flex align-items-center text-muted" href="<?php echo htmlspecialchars(__($item['href'])); ?>"><?php echo htmlspecialchars(__($item['text'])); ?></a>
        </h6>
        <?php if(isset($item['child'])): ?>
        <ul class="nav flex-column mb-2">
            <?php foreach($item['child'] as $subitem): ?>
            <li class="nav-item">
                <a class="nav-link <?php echo $this->boolecho($this->isMe($subitem['id']),'active'); ?>" href="<?php echo htmlspecialchars(__($subitem['href'])); ?>">
                    <?php echo htmlspecialchars(__($subitem['text'])); ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?> <?php endforeach; ?>
    </div>
</nav><?php }} } return ["class"=>"Template_ae7aa1a147ee2d9a2ca1deec7e33bb10","name"=>"support:sidebar","source"=>"D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-support\\resource\\template\\default/sidebar.tpl.html","module"=>"support"]; 