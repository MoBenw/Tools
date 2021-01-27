<?php if (!class_exists("Template_7cfae97afa0b4e772bbb2e5c1b4d3088", false)) { class Template_7cfae97afa0b4e772bbb2e5c1b4d3088 extends suda\template\compiler\suda\Template { protected $name="suda:error";protected $module="suda"; protected $source="D:\\GitHub\\suda-attend\\suda\\system\\resource\\modules\\dxkite-suda\\resource\\template\\default/error.tpl.html";protected function _render_template() {  ?><?php $this->extend('error_layout'); ?>

<?php $this->execHook('error-head',function () { ?>
<link rel="stylesheet" href="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/google-code-prettify/prettify.css">
<?php });?>

<?php $this->execHook('error-content',function () { ?>
    <?php if($this->has("message")): ?>
    <section class="message">
        <?php echo htmlspecialchars(__($this->get("message"))); ?>
    </section>
    <?php endif; ?>

    <?php if(DEBUG): ?>
    <div class="error-code">
        <div class="error-position"><?php echo htmlspecialchars(__($this->get("file"))); ?>#<?php echo htmlspecialchars(__($this->get("line",0))); ?></div>
        <pre class="prettyprint lang-php"><ol start="<?php echo htmlspecialchars(__(key($this->get("lines")))); ?>"><?php foreach( $this->get("lines")as $num =>$line_code ): ?><li class="line-<?php echo htmlspecialchars(__($num)); ?> <?php if($num==$this->get("pos_num")): ?> error-line <?php endif; ?> "><code><?php echo htmlspecialchars(__($line_code)); ?></code></li><?php endforeach; ?></ol></pre>
    </div>
        <?php if(count($this->get("traces"))): ?>
        <ul class="trace-list">
            <?php foreach($this->get("traces")as $trace_info): ?>
            <li class="trace-item"><?php echo $trace_info; ?></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    <?php endif; ?>
<?php });?>

<?php $this->execHook('error-footer',function () { ?>
<script src="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/google-code-prettify/prettify.js"></script>
<script>
    window.addEventListener('load', function () {
        prettyPrint();
    });
</script>
<?php });?><?php }} } return ["class"=>"Template_7cfae97afa0b4e772bbb2e5c1b4d3088","name"=>"suda:error","source"=>"D:\\GitHub\\suda-attend\\suda\\system\\resource\\modules\\dxkite-suda\\resource\\template\\default/error.tpl.html","module"=>"suda"]; 