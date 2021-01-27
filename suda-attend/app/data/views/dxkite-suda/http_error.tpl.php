<?php if (!class_exists("Template_f9dcf282b66361766c460dc820a1e4f3", false)) { class Template_f9dcf282b66361766c460dc820a1e4f3 extends suda\template\compiler\suda\Template { protected $name="suda:http_error";protected $module="suda"; protected $source="D:\\GitHub\\suda-attend\\suda\\system\\resource\\modules\\dxkite-suda\\resource\\template\\default/http_error.tpl.html";protected function _render_template() {  ?><?php $this->extend('error_layout'); ?>

<?php $this->execHook('error-content',function () { ?>
<section class="message">
  <?php if($this->get("error_code")== 404): ?>
  <?php if($this->has("path")): ?> <?php echo htmlspecialchars(__(__('page "%s"  is not found',$this->get("path",'文档')))); ?> <?php else: ?> <?php echo htmlspecialchars(__("当前页面文档信息在服务器上找不到，请重试")); ?> <?php endif; ?>
  <?php endif; ?>
</section>
<?php });?><?php }} } return ["class"=>"Template_f9dcf282b66361766c460dc820a1e4f3","name"=>"suda:http_error","source"=>"D:\\GitHub\\suda-attend\\suda\\system\\resource\\modules\\dxkite-suda\\resource\\template\\default/http_error.tpl.html","module"=>"suda"]; 