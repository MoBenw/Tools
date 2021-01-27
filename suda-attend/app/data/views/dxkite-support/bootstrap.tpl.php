<?php if (!class_exists("Template_fa3df8266a3ecdb774ca3013b492379c", false)) { class Template_fa3df8266a3ecdb774ca3013b492379c extends suda\template\compiler\suda\Template { protected $name="support:bootstrap";protected $module="support"; protected $source="D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-support\\resource\\template\\default/bootstrap.tpl.html";protected function _render_template() {  ?><!DOCTYPE html>
<html lang="<?php echo htmlspecialchars(__($this->get("lang",'en'))); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo htmlspecialchars(__($this->get("title"))); ?></title>
    <link rel="stylesheet" href="<?php echo suda\template\Manager::assetServer('/static/dxkite-support');?>/bootstrap/css/bootstrap.min.css">
    <?php $this->exec('bs-head'); ?>
</head>

<body>
    <?php $this->exec('bs-content'); ?>
    <script src="<?php echo suda\template\Manager::assetServer('/static/dxkite-support');?>/jquery-3.2.1.min.js"></script>
    <script src="<?php echo suda\template\Manager::assetServer('/static/dxkite-support');?>/popper.min.js"></script>
    <script src="<?php echo suda\template\Manager::assetServer('/static/dxkite-support');?>/bootstrap/js/bootstrap.min.js"></script>
    <?php $this->exec('bs-footer'); ?>
</body>

</html><?php }} } return ["class"=>"Template_fa3df8266a3ecdb774ca3013b492379c","name"=>"support:bootstrap","source"=>"D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-support\\resource\\template\\default/bootstrap.tpl.html","module"=>"support"]; 