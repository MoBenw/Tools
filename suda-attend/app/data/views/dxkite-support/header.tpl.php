<?php if (!class_exists("Template_ab724a3c942f906cfd2e10fe48934729", false)) { class Template_ab724a3c942f906cfd2e10fe48934729 extends suda\template\compiler\suda\Template { protected $name="support:header";protected $module="support"; protected $source="D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-support\\resource\\template\\default/header.tpl.html";protected function _render_template() {  ?><nav class="navbar navbar-dark sticky-top bg-dark navbar-expand-lg flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"><?php echo htmlspecialchars(__($this->get("menuName",'管理主页'))); ?></a>
    <ul class="navbar-nav mr-auto">
    </ul>
    <ul class="navbar-nav px-3">
        <?php $this->execGlobalHook("view.setting.header.navlist.prepend"); ?>
        <li class="nav-item text-nowrap">
            <a id="upload-template" class="nav-link" href="#">上传模板</a>
        </li>
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="/">网站首页</a>
        </li>
        <?php $this->execGlobalHook("view.setting.header.navlist.append"); ?>
    </ul>
</nav>
<?php $this->execHook('bs-footer',function () { ?>
<div class="modal fade" id="info-upload" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title"><?php echo __('上传模板'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input id="upload-file-input" type="file" name="zip" accept="application/zip">
                <button id="upload-file" class="btn btn-primary"><?php echo htmlspecialchars(__("上传文件")); ?></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="ok" data-dismiss="modal"><?php echo __('确认'); ?></button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#upload-template').on('click', function () {
            $('#info-upload').modal('show');
            $('#upload-file').on('click', function () {
                var file = document.getElementById('upload-file-input').files[0];
                dx.xcall('uploadTheme', {
                    args: {
                        zip: file
                    },
                    success: (result) => {
                        $('#info-upload').modal('hide');
                    }
                });
            });
        });
    });
</script>
<?php });?><?php }} } return ["class"=>"Template_ab724a3c942f906cfd2e10fe48934729","name"=>"support:header","source"=>"D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-support\\resource\\template\\default/header.tpl.html","module"=>"support"]; 