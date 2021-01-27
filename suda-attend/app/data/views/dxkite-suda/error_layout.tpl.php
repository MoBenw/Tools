<?php if (!class_exists("Template_2b1b7da01003d0f30b71a564186a1630", false)) { class Template_2b1b7da01003d0f30b71a564186a1630 extends suda\template\compiler\suda\Template { protected $name="suda:error_layout";protected $module="suda"; protected $source="D:\\GitHub\\suda-attend\\suda\\system\\resource\\modules\\dxkite-suda\\resource\\template\\default/error_layout.tpl.html";protected function _render_template() {  ?><!DOCTYPE html>
<html lang="<?php echo htmlspecialchars(__($this->get("lang",'en'))); ?>">
<?php $this->data('suda\core\Debug::assginDebugInfo'); ?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?php echo htmlspecialchars(__($this->get("error_type",'Error'))); ?> <?php if($this->has("error_code")): ?> - <?php echo htmlspecialchars(__($this->get("error_code",'500'))); ?> <?php endif; ?> | Powered By Suda System </title>
  <link rel="stylesheet" href="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/style.css"> <?php $this->exec('error-head'); ?>
</head>

<body>
  <div class="content-wrapper">
    <div class="error-panel">
      <div class="error-info">
        <div class="error-type"><?php echo htmlspecialchars(__($this->get("error_type",'Error'))); ?></div>
        <?php if($this->has("error_code")): ?>
        <div class="error-number"><?php echo htmlspecialchars(__($this->get("error_code",'500'))); ?></div> <?php endif; ?>
        <div class="error-items">
          <?php if(DEBUG && router()->getRouter('debug_json_download',$this->module) ): ?>
          <a class="error-item" href="<?php echo $this->url('debug_json_download',$this->get("request_id")); ?>" target="_black"><?php echo htmlspecialchars(__('Request Id:%s', $this->get("request_id"))); ?></a>
          <?php else: ?>
          <div class="error-item"><?php echo htmlspecialchars(__('Request Id:%s', $this->get("request_id"))); ?></div>
          <?php endif; ?>
          <div class="error-item"><?php echo htmlspecialchars(__(date('Y-m-d H:i:s e'))); ?></div>
        </div>
      </div>
      <div class="error-message"><?php echo htmlspecialchars(__($this->get("error_message"))); ?></div>
    </div>
    <?php $this->exec('error-content'); ?>
    <div class="footer">
      <div class="footer-item"><?php echo htmlspecialchars(__('Memory Cost: %s', $this->get("memory_usage"))); ?></div>
      <div class="footer-item"><?php echo htmlspecialchars(__('Memory Peak: %s', $this->get("memory_peak_usage"))); ?></div>
      <div class="footer-item"><?php echo htmlspecialchars(__('Time Cost：%s s', $this->get("time_spend"))); ?></div>
      <div class="footer-item"><?php echo htmlspecialchars(__('Requst Ip: %s', request()->ip() )); ?></div>
      <div class="footer-item">
        <a href="https://github.com/DXkite/suda" target="_black"> <?php echo htmlspecialchars(__('Performance By Suda v%s',SUDA_VERSION)); ?></a>
      </div>
    </div>
  </div>
  <?php $this->exec('error-footer'); ?>
</body>

</html><?php }} } return ["class"=>"Template_2b1b7da01003d0f30b71a564186a1630","name"=>"suda:error_layout","source"=>"D:\\GitHub\\suda-attend\\suda\\system\\resource\\modules\\dxkite-suda\\resource\\template\\default/error_layout.tpl.html","module"=>"suda"]; 