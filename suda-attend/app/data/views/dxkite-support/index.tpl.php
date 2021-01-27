<?php if (!class_exists("Template_ec5d9c12d9644e03fadb43e8017334aa", false)) { class Template_ec5d9c12d9644e03fadb43e8017334aa extends suda\template\compiler\suda\Template { protected $name="support:index";protected $module="support"; protected $source="D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-support\\resource\\template\\default/index.tpl.html";protected function _render_template() {  ?><?php $this->exec('setting-index-panel:before'); ?>
<h4><?php echo __('当前环境信息'); ?></h4>
<table class="table">
    <thead>
        <tr>
            <th><?php echo __('配置项'); ?></th>
            <th><?php echo __('信息'); ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo __('服务器'); ?></td>
            <td><?php echo htmlspecialchars(__($this->get("version.server"))); ?></td>
        </tr>
        <tr>
            <td>PHP </td>
            <td><?php echo htmlspecialchars(__($this->get("version.php"))); ?></td>
        </tr>
        <tr>
            <td>MySQL</td>
            <td><?php echo htmlspecialchars(__($this->get("version.mysql"))); ?></td>
        </tr>
        <tr>
            <td><?php echo __('框架'); ?></td>
            <td><?php echo htmlspecialchars(__($this->get("version.suda"))); ?></td>
        </tr>
        <tr>
            <td><?php echo __('GD库'); ?></td>
            <td><?php echo htmlspecialchars(__($this->get("version.gd"))); ?></td>
        </tr>
        <tr>
            <td><?php echo __('文件上传限制大小'); ?></td>
            <td><?php echo htmlspecialchars(__($this->get("upload"))); ?></td>
        </tr>
        <tr>
            <td><?php echo __('时区'); ?></td>
            <td><?php echo htmlspecialchars(__(setting('timezone', 'PRC'))); ?> - <?php echo htmlspecialchars(__(date('Y-m-d H:i:s'))); ?></td>
        </tr>
    </tbody>
</table>
<?php $this->execGlobalHook("setting-index-panel:after"); ?>
<?php $this->exec('setting-index-panel:after'); ?> 
 <?php }} } return ["class"=>"Template_ec5d9c12d9644e03fadb43e8017334aa","name"=>"support:index","source"=>"D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-support\\resource\\template\\default/index.tpl.html","module"=>"support"]; 