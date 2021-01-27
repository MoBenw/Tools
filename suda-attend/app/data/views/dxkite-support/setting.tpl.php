<?php if (!class_exists("Template_788fbb75b5b645c9c1100dc548dafdc9", false)) { class Template_788fbb75b5b645c9c1100dc548dafdc9 extends suda\template\compiler\suda\Template { protected $name="support:setting";protected $module="support"; protected $source="D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-support\\resource\\template\\default/setting.tpl.html";protected function _render_template() {  ?><h4><?php echo __('常规设置'); ?></h4>
<table class="table">
    <tbody>
        <tr>
            <th><?php echo __('网站名称'); ?></th>
            <td>
                <div class="input-group">
                    <input class="form-control" type="text" id="website_name" name="website_name" value="<?php echo htmlspecialchars(setting('website_name'));?>">
                    <span class="input-group-append">
                        <button type="button" class=" btn btn-primary" data-input="website_name"><?php echo __('修改'); ?></button>
                    </span>
                </div>
            </td>
        </tr>
        <tr>
            <th><?php echo __('时区设置'); ?></th>
            <td>
                <div class="input-group">
                    <select class="form-control" id="timezone" name="timezone" aria-describedby="timezone-description">
                        <?php echo $this->response->getTimezoneOptions(); ?>
                    </select>
                    <span class="input-group-append">
                        <button type="button" class=" btn btn-primary" data-input="timezone"><?php echo __('修改'); ?></button>
                    </span>
                </div>
            </td>
        </tr>
        <?php $this->execGlobalHook("setting-item:after"); ?>
    </tbody>
</table>
<?php $this->execGlobalHook("setting-panel:after"); ?> <?php $this->execHook('bs-footer',function () { ?>
<div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo __('修改设置'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo __('修改成功'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo __('确认'); ?></button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo suda\template\Manager::assetServer('/static/dxkite-support');?>/call.js" data-api="<?php echo $this->url('support:admin_ajax'); ?>"></script>
<script>
    $(function () {
        $('[data-input]').on('click', function () {
            var input = document.getElementById(this.dataset.input);
            dx.xcall('setting', {
                args: [this.dataset.input, $(input).val()],
                success: () => {
                    $('#info').modal('show');
                },
                error: (error) => {
                    var modal = $('#info');
                    modal.find('.modal-body').text(error.message + ":" + error.data);
                    modal.modal('show');
                }
            });
        });
    });
</script>
<?php });?><?php }} } return ["class"=>"Template_788fbb75b5b645c9c1100dc548dafdc9","name"=>"support:setting","source"=>"D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-support\\resource\\template\\default/setting.tpl.html","module"=>"support"]; 