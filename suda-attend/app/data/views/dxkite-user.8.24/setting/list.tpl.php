<?php if (!class_exists("Template_f8dc94af955da62e9af8d50fedf79955", false)) { class Template_f8dc94af955da62e9af8d50fedf79955 extends suda\template\compiler\suda\Template { protected $name="user:setting/list";protected $module="user"; protected $source="D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/setting/list.tpl.html";protected function _render_template() {  ?><div class="row justify-content-between p-2">
    <div class="col">
        <a href="<?php echo $this->url('user:admin_add'); ?>" class="btn btn-success">添加用户</a>
    </div>
    <div class="col col-md-auto">
        <form class="form-inline input-group" method="get" action="<?php echo $this->url(); ?>">
            <select name="type" class="custom-select input-group-prepend">
                <option value="name" selected>用户名</option>
                <option value="email">邮箱</option>
            </select>
            <input type="text" name="search" class="form-control" id="searchbox" placeholder="搜索...">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">搜索</button>
            </div>
        </form>
    </div>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col"><?php echo htmlspecialchars(__("用户名")); ?></th>
            <th scope="col"><?php echo htmlspecialchars(__("邮箱")); ?></th>
            <th scope="col"><?php echo htmlspecialchars(__("注册时间")); ?></th>
            <th scope="col"><?php echo htmlspecialchars(__("操作")); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($this->get("list",[]) as $item): ?>
        <tr>
            <td><?php echo htmlspecialchars(__($item['id'])); ?></td>
            <td><?php echo htmlspecialchars(__($item['name'])); ?></td>
            <td><?php echo htmlspecialchars(__($item['email'])); ?> </td>
            <td><?php echo htmlspecialchars(__(date('Y-m-d H:i:s',$item['signupTime']))); ?> </td>
            <td>
                <div class="btn-group btn-group-toggle">
                    <a class="btn btn-outline-secondary btn-sm" href="<?php echo $this->url('user:admin_edit',['id'=>$item['id']]); ?>">编辑</a>
                    <?php if( $item['status'] == 1): ?>
                    <a class="btn btn-outline-success btn-sm" href="<?php echo $this->url('user:admin_list',['freeze'=>$item['id']]); ?>">封禁</a>
                    <?php else: ?>
                    <a class="btn btn-success btn-sm" href="<?php echo $this->url('user:admin_list',['active'=>$item['id']]); ?>">解封</a>
                    <?php endif; ?>
                    <a class="btn btn-outline-info btn-sm" href="<?php echo $this->url('user:admin_role',['id'=>$item['id']]); ?>">权限</a>
                    <a class="btn btn-danger btn-sm" href="<?php echo $this->url('user:admin_list',['delete'=>$item['id']]); ?>">删除</a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php $this->data('dxkite\support\Bootstrap::page'); ?><?php }} } return ["class"=>"Template_f8dc94af955da62e9af8d50fedf79955","name"=>"user:setting/list","source"=>"D:\\GitHub\\suda-attend\\app\\data\\runtime\\modules\\dxkite-user.8.24\\resource\\template\\default/setting/list.tpl.html","module"=>"user"]; 