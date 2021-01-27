<?php if (!class_exists("Template_7cd61c6594b52d5aa9921256fc3dc180", false)) { class Template_7cd61c6594b52d5aa9921256fc3dc180 extends suda\template\compiler\suda\Template { protected $name="demo/attend:1.0.0-dev:table";protected $module="demo/attend:1.0.0-dev"; protected $source="D:\\GitHub\\suda-attend\\app\\modules\\attend\\resource\\template\\default/table.tpl.html";protected function _render_template() {  ?><html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ATD报名系统</title>
    <link rel="stylesheet" href="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/css/bui.css">
    <link rel="stylesheet" href="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/css/public.css">
    <style>
        body{
            overflow-y:scroll;
            }

    </style>
    <style>
        input{
            padding:0.05rem 0.04rem;
        }
    </style>
</head>
<body>
<header id="bar" class="bui-bar">
    <div class="bui-bar">
        <div class="bui-bar-left" style="opacity: 0.01">
            <a class="bui-btn" onclick="bui.back();"><i class="icon-back"></i></a>
        </div>
        <div class="bui-bar-main">ATD报名表格</div>
        <div class="bui-bar-right">
        </div>
    </div>
</header>
    <div class="form1" id="form1" style="">
        <div class="bui-panel" style="">
            <lable>姓名:</lable>
            <div class="bui-input">

                <input maxlength="6" type="text" value="" id="name" placeholder="">
            </div>
        </div>
        <div class="bui-panel" style="padding:0.15rem 0.3rem">
            <lable>年级信息:</lable>
                    <div class="bui-input">
                        <div class="demo">
                            <div id="age">点击选择年级</div>
                        </div>
                    </div>
        </div>
        <div class="bui-panel" style="padding:0.15rem 0.3rem">
            <div class="bui-input">
                <lable>性别:</lable>
                <lable>
                    <input type="radio" class="bui-radio" checked name="sex" value="1">男
                </lable>
                <lable>
                    <input type="radio" class="bui-radio" name="sex" value="2">女
                </lable>
                <lable>
                    <input type="radio" class="bui-radio" id="super" name="sex" value="3">不男不女
                </lable>
            </div>
        </div>
        <div class="bui-panel" style="padding:0.15rem 0.3rem">
            <lable>学号:</lable>
            <div class="bui-input">
                <input type="number" maxlength="8" onkeyup="value=value.replace(/[^1234567890-]+/g,'')" placeholder="201xxxxx" id="study">
            </div>
        </div>

        <div class="bui-panel">
            <div class="submit">
                <button class="btn-1" id="next1" style="">下一步</button>
            </div>
        </div>
    </div>
        <div class="form2" style="opacity: 0.01">
            <div class="bui-panel" style="">
                <lable>手机号:</lable>
                <div class="bui-input">

                    <input type="number" maxlength="11" onkeyup="value=value.replace(/[^1234567890-]+/g,'')" value="" id="phone" placeholder="phone">
                </div>
            </div>
            <div class="bui-panel" style="">
                <lable>qq号:</lable>
                <div class="bui-input">

                    <input type="number" onkeyup="value=value.replace(/[^1234567890-]+/g,'')" value="" maxlength="10" id="qq" placeholder="qq">
                </div>
            </div>
            <div class="bui-panel" style="">
                <lable>微信号:</lable>
                <div class="bui-input">
                    <input type="text" value="" maxlength="15" id="wechat" placeholder="wechat">
                </div>
            </div>
            <lable style="display:block;text-align: center">温馨提示:qq号微信可以2选1填</lable>
            <div class="bui-panel">
                <div class="submit">
                    <button class="btn" id="preview2" style="">上一步</button>
                    <button class="btn" id="next2" style="">下一步</button>
                </div>
            </div>
        </div>

        <div class="form3" style="opacity:0.01;">
            <div class="bui-panel" style="">
                <lable>入会申请书:</lable>
                <div class="bui-input">
                    <textarea name="" id="apply" cols="30" rows="20" maxlength="8000" style="border:1px solid #ccc;border-radius: 0.15rem;padding:0.05rem 0.06rem;height:1.5rem;"></textarea>
                </div>
            </div>
            <div class="bui-panel" style="">
                <lable>自我介绍:</lable>
                <div class="bui-input">
                    <textarea name="" id="pre" cols="30" rows="20" maxlength="8000" style="border:1px solid #ccc;border-radius: 0.15rem;padding:0.05rem 0.06rem;height:1.5rem;"></textarea>
                </div>
                    <div class="submit">
                        <button class="btn" id="preview3" style="">上一步</button>
                        <button class="btn" id="next3" style="">下一步</button>
                </div>
            </div>
        </div>

        <div class="result" style="opacity:0.01">
            <div class="content">
                <h3 class="section-title">个人信息</h3>
                <div class="bui-list">
                    <div class="bui-btn bui-box">
                        <div class="bui-label">姓名:</div>
                        <div class="span1">
                            <div class="bui-value" id="result-name">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="bui-list">
                    <div class="bui-btn bui-box">
                        <div class="bui-label">年级信息:</div>
                        <div class="span1">
                            <div class="bui-value" id="result-age">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="bui-list">
                    <div class="bui-btn bui-box">
                        <div class="bui-label">性别:</div>
                        <div class="span1">
                            <div class="bui-value" id="result-sex">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="bui-list">
                    <div class="bui-btn bui-box">
                        <div class="bui-label">学号:</div>
                        <div class="span1">
                            <div class="bui-value" id="result-study">

                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class="content">
                <h3 class="section-title">联系方式</h3>
                <div class="bui-list">
                    <div class="bui-btn bui-box">
                        <div class="bui-label">手机号:</div>
                        <div class="span1">
                            <div class="bui-value" id="result-phone">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="bui-list">
                    <div class="bui-btn bui-box">
                        <div class="bui-label">qq号:</div>
                        <div class="span1">
                            <div class="bui-value" id="result-qq">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="bui-list">
                    <div class="bui-btn bui-box">
                        <div class="bui-label">微信号:</div>
                        <div class="span1">
                            <div class="bui-value" id="result-wechat">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <h3 class="section-title">入会申请:</h3>
                <div class="bui-list">
                    <div class="bui-btn bui-box">
                        <div class="bui-label">入会申请书:</div>
                        <div class="span1">
                            <div class="bui-value" id="result-apply">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="bui-list">
                    <div class="bui-btn bui-box">
                        <div class="bui-label">自我介绍:</div>
                        <div class="span1">
                            <div class="bui-value" id="result-pre">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="submit">
                    <button class="btn" id="preview4" style="">上一步</button>
                    <button class="btn" id="last" style="background:#FF5722;">提交</button>
                </div>
        </div>
</body>
<script src="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/js/jquery.min.js"></script>
<script src="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/js/bui.js"></script>
<script src="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/js/index.js"></script>
<script src="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/js/new.js"></script>
<script src="<?php echo suda\template\Manager::assetServer('/static/dxkite-support');?>/call.js" data-api="<?php echo request()->baseUrl().'api/v1.0'; ?>"></script>

<script>
window.addEventListener('load',function(){
            var last=document.getElementById('last');
            last.addEventListener('click',function(){
                dx.call('attend','write',[{
                    name: name,
                    age: age,
                    sex: sex,
                    id_number: study,
                    tel_number: phone,
                    qq: qq,
                    weixin: wechat,
                    information: apply,
                    description: pre,
                }])
                .then(function (ret) {
                    console.log(ret);
                    window.location.href="./success";
                    });
                // .then(function(ret){
                //     console.log(ret);
                // });
            }); 
        });
</script>

<script>

    //调用jquery二级联动插件
            var mobileSelect1 = new MobileSelect({
                trigger: '#age',
                title: '年级选择-专业选择-班级选择',
                wheels: [
                    {
                        data: [
                            {
                                id: '1', value: '大一',
                                childs: [
                                    {
                                        id: '1',
                                        value: '电子信息工程',
                                        childs: [{id: '1', value: '电信1班'}, {id: '2', value: '电信2班'}]
                                    },
                                    {
                                        id: '2',
                                        value: '计算机科学与技术',
                                        childs: [{id: '1', value: '计科1班'}, {id: '2', value: '计科2班'}, {
                                            id: '3',
                                            value: '计科3班'
                                        }, {id: '4', value: '计科4班'}]
                                    },
                                    {
                                        id: '3',
                                        value: '软件工程',
                                        childs: [{id: '1', value: '软件1班'}, {id: '2', value: '软件2班'}]
                                    },
                                    {
                                        id: '4',
                                        value: '金融学',
                                        childs: [{id: '1', value: '金融1班'}, {id: '2', value: '金融2班'}, {
                                            id: '3',
                                            value: '金融3班'
                                        }, {id: '4', value: '金融4班'}, {id: '5', value: '金融5班'}, {
                                            id: '6',
                                            value: '金融6班'
                                        }, {id: '7', value: '金融7班'}, {id: '8', value: '金融8班'}]
                                    },
                                    {
                                        id: '5',
                                        value: '法学',
                                        childs: [{id: '1', value: '法学1班'}, {id: '2', value: '法学2班'}]
                                    },
                                    {
                                        id: '6',
                                        value: '会计学',
                                        childs: [{id: '1', value: '会计1班'}, {id: '2', value: '会计2班'}, {
                                            id: '3',
                                            value: '会计3班'
                                        }, {id: '4', value: '会计4班'}, {id: '5', value: '会计5班'}, {
                                            id: '6',
                                            value: '会计6班'
                                        }, {id: '7', value: '会计7班'}, {id: '8', value: '会计8班'}]
                                    },
                                    {
                                        id: '7',
                                        value: '国际金融与贸易',
                                        childs: [{id: '1', value: '国贸1班'}, {id: '2', value: '国贸2班'}, {
                                            id: '3',
                                            value: '国贸3班'
                                        }, {id: '4', value: '国贸4班'}]
                                    },
                                    {
                                        id: '8',
                                        value: '旅游管理',
                                        childs: [{id: '1', value: '旅馆1班'}, {id: '2', value: '旅馆2班'}]
                                    },
                                    {
                                        id: '9',
                                        value: '人力资源',
                                        childs: [{id: '1', value: '人资1班'}, {id: '2', value: '人资2班'}]
                                    },
                                    {
                                        id: '10',
                                        value: '风景园林',
                                        childs: [{id: '1', value: '风林1班'}, {id: '2', value: '风林2班'}, {
                                            id: '3',
                                            value: '风林3班'
                                        }, {id: '4', value: '风林4班'}]
                                    },
                                    {
                                        id: '11',
                                        value: '市场营销',
                                        childs: [{id: '1', value: '市营1班'}, {id: '2', value: '市营2班'}, {
                                            id: '3',
                                            value: '市营3班'
                                        }, {id: '4', value: '市营4班'}]
                                    },
                                    {
                                        id: '12',
                                        value: '视觉传达设计',
                                        childs: [{id: '1', value: '视传1班'}, {id: '2', value: '视传2班'}, {
                                            id: '3',
                                            value: '视传3班'
                                        }, {id: '4', value: '视传4班'}]
                                    },
                                    {
                                        id: '13',
                                        value: '广播电视编导',
                                        childs: [{id: '1', value: '广电1班'}, {id: '2', value: '广电2班'}, {
                                            id: '3',
                                            value: '广电3班'
                                        }, {id: '4', value: '广电4班'}, {id: '5', value: '广电5班'}, {id: '6', value: '广电6班'}]
                                    },
                                    {
                                        id: '14',
                                        value: '产品设计',
                                        childs: [{id: '1', value: '产设1班'}, {id: '2', value: '产设2班'}]
                                    },
                                    {
                                        id: '15', value: '摄影', childs: [{id: '1', value: '摄影1班'}]
                                    },
                                    {
                                        id: '16',
                                        value: '环境设计',
                                        childs: [{id: '1', value: '环设1班'}, {id: '2', value: '环设2班'}, {
                                            id: '3',
                                            value: '环设3班'
                                        }, {id: '4', value: '环设4班'}, {id: '5', value: '环设5班'}, {
                                            id: '6',
                                            value: '环设6班'
                                        }, {id: '7', value: '环设7班'}, {id: '8', value: '环设8班'}]
                                    },
                                    {
                                        id: '17',
                                        value: '播音主持',
                                        childs: [{id: '1', value: '播音1班'}, {id: '2', value: '播音2班'}]
                                    },
                                    {
                                        id: '18',
                                        value: '英语',
                                        childs: [{id: '1', value: '英语1班'}, {id: '2', value: '英语2班'}, {
                                            id: '3',
                                            value: '英语3班'
                                        }, {id: '4', value: '英语4班'}]
                                    }
                                ]
                            },
                            {
                                id: '2', value: '大二',
                                childs: [
                                    {
                                        id: '1',
                                        value: '电子信息工程',
                                        childs: [{id: '1', value: '电信1班'}, {id: '2', value: '电信2班'}]
                                    },
                                    {
                                        id: '2',
                                        value: '计算机科学与技术',
                                        childs: [{id: '1', value: '计科1班'}, {id: '2', value: '计科2班'}, {
                                            id: '3',
                                            value: '计科3班'
                                        }, {id: '4', value: '计科4班'}]
                                    },
                                    {
                                        id: '3',
                                        value: '软件工程',
                                        childs: [{id: '1', value: '软件1班'}, {id: '2', value: '软件2班'}]
                                    },
                                    {
                                        id: '4',
                                        value: '金融学',
                                        childs: [{id: '1', value: '金融1班'}, {id: '2', value: '金融2班'}, {
                                            id: '3',
                                            value: '金融3班'
                                        }, {id: '4', value: '金融4班'}, {id: '5', value: '金融5班'}, {
                                            id: '6',
                                            value: '金融6班'
                                        }, {id: '7', value: '金融7班'}, {id: '8', value: '金融8班'}]
                                    },
                                    {
                                        id: '5',
                                        value: '法学',
                                        childs: [{id: '1', value: '法学1班'}, {id: '2', value: '法学2班'}]
                                    },
                                    {
                                        id: '6',
                                        value: '会计学',
                                        childs: [{id: '1', value: '会计1班'}, {id: '2', value: '会计2班'}, {
                                            id: '3',
                                            value: '会计3班'
                                        }, {id: '4', value: '会计4班'}, {id: '5', value: '会计5班'}, {
                                            id: '6',
                                            value: '会计6班'
                                        }, {id: '7', value: '会计7班'}, {id: '8', value: '会计8班'}]
                                    },
                                    {
                                        id: '7',
                                        value: '国际金融与贸易',
                                        childs: [{id: '1', value: '国贸1班'}, {id: '2', value: '国贸2班'}, {
                                            id: '3',
                                            value: '国贸3班'
                                        }, {id: '4', value: '国贸4班'}, {id: '5', value: '国贸5班'}, {id: '6', value: '国贸6班'}]
                                    },
                                    {
                                        id: '8',
                                        value: '旅游管理',
                                        childs: [{id: '1', value: '旅馆1班'}, {id: '2', value: '旅馆2班'}]
                                    },
                                    {
                                        id: '9',
                                        value: '人力资源',
                                        childs: [{id: '1', value: '人资1班'}, {id: '2', value: '人资2班'}]
                                    },
                                    {
                                        id: '10',
                                        value: '风景园林',
                                        childs: [{id: '1', value: '风林1班'}, {id: '2', value: '风林2班'}, {
                                            id: '3',
                                            value: '风林3班'
                                        }, {id: '4', value: '风林4班'}]
                                    },
                                    {
                                        id: '11',
                                        value: '市场营销',
                                        childs: [{id: '1', value: '市营1班'}, {id: '2', value: '市营2班'}, {
                                            id: '3',
                                            value: '市营3班'
                                        }, {id: '4', value: '市营4班'}]
                                    },
                                    {
                                        id: '12',
                                        value: '视觉传达设计',
                                        childs: [{id: '1', value: '视传1班'}, {id: '2', value: '视传2班'}, {
                                            id: '3',
                                            value: '视传3班'
                                        }, {id: '4', value: '视传4班'}]
                                    },
                                    {
                                        id: '13',
                                        value: '土木工程',
                                        childs: [{id: '1', value: '土木1班'}, {id: '2', value: '土木2班'}, {
                                            id: '3',
                                            value: '土木3班'
                                        }, {id: '4', value: '土木4班'}]
                                    },
                                    {
                                        id: '14',
                                        value: '产品设计',
                                        childs: [{id: '1', value: '产设1班'}, {id: '2', value: '产设2班'}]
                                    },
                                    {
                                        id: '15',
                                        value: '工程管理',
                                        childs: [{id: '1', value: '工程1班'}, {id: '2', value: '工程2班'}]
                                    },
                                    {
                                        id: '16',
                                        value: '环境设计',
                                        childs: [{id: '1', value: '环设1班'}, {id: '2', value: '环设2班'}, {
                                            id: '3',
                                            value: '环设3班'
                                        }, {id: '4', value: '环设4班'}, {id: '5', value: '环设5班'}, {id: '6', value: '环设6班'}]
                                    },
                                    {
                                        id: '17',
                                        value: '物流',
                                        childs: [{id: '1', value: '物流1班'}, {id: '2', value: '物流2班'}]
                                    },
                                    {
                                        id: '18',
                                        value: '英语',
                                        childs: [{id: '1', value: '英语1班'}, {id: '2', value: '英语2班'}, {
                                            id: '3',
                                            value: '英语3班'
                                        }, {id: '4', value: '英语4班'}]
                                    },
                                    {
                                        id: '19',
                                        value: '日语',
                                        childs: [{id: '1', value: '日语1班'}, {id: '2', value: '日语2班'}]
                                    }
                                ]
                            },
                            {
                                id: '3', value: '大三',
                                childs:[
                                    {
                                        id:'1',value:'电子信息工程',childs:[{id:'1',value:'电信1班'},{id:'2',value:'电信2班'}]
                                    },
                                    {
                                        id:'2',value:'计算机科学与技术',childs:[{id:'1',value:'计科1班'},{id:'2',value:'计科2班'},{id:'3',value:'计科3班'},{id:'4',value:'计科4班'}]
                                    },
                                    {
                                        id:'3',value:'软件工程',childs:[{id:'1',value:'软件1班'},{id:'2',value:'软件2班'}]
                                    },
                                    {
                                        id:'4',value:'金融学',childs:[{id:'1',value:'金融1班'},{id:'2',value:'金融2班'},{id:'3',value:'金融3班'},{id:'4',value:'金融4班'},{id:'5',value:'金融5班'},{id:'6',value:'金融6班'},{id:'7',value:'金融7班'},{id:'8',value:'金融8班'}]
                                    },
                                    {
                                        id:'5',value:'法学',childs:[{id:'1',value:'法学1班'},{id:'2',value:'法学2班'}]
                                    },
                                    {
                                        id:'6',value:'会计学',childs:[{id:'1',value:'会计1班'},{id:'2',value:'会计2班'},{id:'3',value:'会计3班'},{id:'4',value:'会计4班'},{id:'5',value:'会计5班'},{id:'6',value:'会计6班'},{id:'7',value:'会计7班'},{id:'8',value:'会计8班'}]
                                    },
                                    {
                                        id:'7',value:'国际金融与贸易',childs:[{id:'1',value:'国贸1班'},{id:'2',value:'国贸2班'},{id:'3',value:'国贸3班'},{id:'4',value:'国贸4班'},{id:'5',value:'国贸5班'},{id:'6',value:'国贸6班'}]
                                    },
                                    {
                                        id:'8',value:'旅游管理',childs:[{id:'1',value:'旅馆1班'},{id:'2',value:'旅馆2班'}]
                                    },
                                    {
                                        id:'9',value:'人力资源',childs:[{id:'1',value:'人资1班'},{id:'2',value:'人资2班'}]
                                    },
                                    {
                                        id:'10',value:'风景园林',childs:[{id:'1',value:'风林1班'},{id:'2',value:'风林2班'},{id:'3',value:'风林3班'},{id:'4',value:'风林4班'}]
                                    },
                                    {
                                        id:'11',value:'市场营销',childs:[{id:'1',value:'市营1班'},{id:'2',value:'市营2班'},{id:'3',value:'市营3班'},{id:'4',value:'市营4班'}]
                                    },
                                    {
                                        id:'12',value:'视觉传达设计',childs:[{id:'1',value:'视传1班'},{id:'2',value:'视传2班'},{id:'3',value:'视传3班'},{id:'4',value:'视传4班'}]
                                    },
                                    {
                                        id:'13',value:'土木工程',childs:[{id:'1',value:'土木1班'},{id:'2',value:'土木2班'},{id:'3',value:'土木3班'},{id:'4',value:'土木4班'}]
                                    },
                                    {
                                        id:'14',value:'产品设计',childs:[{id:'1',value:'产设1班'},{id:'2',value:'产设2班'}]
                                    },
                                    {
                                        id:'15',value:'工程管理',childs:[{id:'1',value:'工程1班'},{id:'2',value:'工程2班'}]
                                    },
                                    {
                                        id:'16',value:'环境设计',childs:[{id:'1',value:'环设1班'},{id:'2',value:'环设2班'},{id:'3',value:'环设3班'},{id:'4',value:'环设4班'},{id:'5',value:'环设5班'},{id:'6',value:'环设6班'}]
                                    },
                                    {
                                        id:'17',value:'物流',childs:[{id:'1',value:'物流1班'},{id:'2',value:'物流2班'}]
                                    },
                                    {
                                        id:'18',value:'英语',childs:[{id:'1',value:'英语1班'},{id:'2',value:'英语2班'},{id:'3',value:'英语3班'},{id:'4',value:'英语4班'}]
                                    },
                                    {
                                        id:'19',value:'日语',childs:[{id:'1',value:'日语1班'},{id:'2',value:'日语2班'}]
                                    }
                                ]
                            },
                            {
                                id: '3', value: '大四',
                                childs:[
                                    {
                                        id:'1',value:'电子信息工程',childs:[{id:'1',value:'电信1班'},{id:'2',value:'电信2班'}]
                                    },
                                    {
                                        id:'2',value:'计算机科学与技术',childs:[{id:'1',value:'计科1班'},{id:'2',value:'计科2班'},{id:'3',value:'计科3班'},{id:'4',value:'计科4班'}]
                                    },
                                    {
                                        id:'3',value:'软件工程',childs:[{id:'1',value:'软件1班'},{id:'2',value:'软件2班'}]
                                    },
                                    {
                                        id:'4',value:'金融学',childs:[{id:'1',value:'金融1班'},{id:'2',value:'金融2班'},{id:'3',value:'金融3班'},{id:'4',value:'金融4班'},{id:'5',value:'金融5班'},{id:'6',value:'金融6班'},{id:'7',value:'金融7班'},{id:'8',value:'金融8班'}]
                                    },
                                    {
                                        id:'5',value:'法学',childs:[{id:'1',value:'法学1班'},{id:'2',value:'法学2班'}]
                                    },
                                    {
                                        id:'6',value:'会计学',childs:[{id:'1',value:'会计1班'},{id:'2',value:'会计2班'},{id:'3',value:'会计3班'},{id:'4',value:'会计4班'},{id:'5',value:'会计5班'},{id:'6',value:'会计6班'},{id:'7',value:'会计7班'},{id:'8',value:'会计8班'}]
                                    },
                                    {
                                        id:'7',value:'国际金融与贸易',childs:[{id:'1',value:'国贸1班'},{id:'2',value:'国贸2班'},{id:'3',value:'国贸3班'},{id:'4',value:'国贸4班'},{id:'5',value:'国贸5班'},{id:'6',value:'国贸6班'}]
                                    },
                                    {
                                        id:'8',value:'旅游管理',childs:[{id:'1',value:'旅馆1班'},{id:'2',value:'旅馆2班'}]
                                    },
                                    {
                                        id:'9',value:'人力资源',childs:[{id:'1',value:'人资1班'},{id:'2',value:'人资2班'}]
                                    },
                                    {
                                        id:'10',value:'风景园林',childs:[{id:'1',value:'风林1班'},{id:'2',value:'风林2班'},{id:'3',value:'风林3班'},{id:'4',value:'风林4班'}]
                                    },
                                    {
                                        id:'11',value:'市场营销',childs:[{id:'1',value:'市营1班'},{id:'2',value:'市营2班'},{id:'3',value:'市营3班'},{id:'4',value:'市营4班'}]
                                    },
                                    {
                                        id:'12',value:'视觉传达设计',childs:[{id:'1',value:'视传1班'},{id:'2',value:'视传2班'},{id:'3',value:'视传3班'},{id:'4',value:'视传4班'}]
                                    },
                                    {
                                        id:'13',value:'土木工程',childs:[{id:'1',value:'土木1班'},{id:'2',value:'土木2班'},{id:'3',value:'土木3班'},{id:'4',value:'土木4班'}]
                                    },
                                    {
                                        id:'14',value:'产品设计',childs:[{id:'1',value:'产设1班'},{id:'2',value:'产设2班'}]
                                    },
                                    {
                                        id:'15',value:'工程管理',childs:[{id:'1',value:'工程1班'},{id:'2',value:'工程2班'}]
                                    },
                                    {
                                        id:'16',value:'环境设计',childs:[{id:'1',value:'环设1班'},{id:'2',value:'环设2班'},{id:'3',value:'环设3班'},{id:'4',value:'环设4班'},{id:'5',value:'环设5班'},{id:'6',value:'环设6班'}]
                                    },
                                    {
                                        id:'17',value:'物流',childs:[{id:'1',value:'物流1班'},{id:'2',value:'物流2班'}]
                                    },
                                    {
                                        id:'18',value:'英语',childs:[{id:'1',value:'英语1班'},{id:'2',value:'英语2班'},{id:'3',value:'英语3班'},{id:'4',value:'英语4班'}]
                                    },
                                    {
                                        id:'19',value:'日语',childs:[{id:'1',value:'日语1班'},{id:'2',value:'日语2班'}]
                                    },
                                    {
                                        id:'20',value:'食品安全',childs:[{id:'1',value:'食品1班'},{id:'2',value:'食品2班'}]
                                    }
                                ]
                            }
                        ]
                    }],
                position:[0,0,0] //初始化定位 打开时默认选中的哪个  如果不填默认为0
            })
</script>
</html><?php }} } return ["class"=>"Template_7cd61c6594b52d5aa9921256fc3dc180","name"=>"demo/attend:1.0.0-dev:table","source"=>"D:\\GitHub\\suda-attend\\app\\modules\\attend\\resource\\template\\default/table.tpl.html","module"=>"demo/attend:1.0.0-dev"]; 