<?php if (!class_exists("Template_6200b0c2f05dbb51ba3779414bf1cc50", false)) { class Template_6200b0c2f05dbb51ba3779414bf1cc50 extends suda\template\compiler\suda\Template { protected $name="demo/attend:1.0.0-dev:index";protected $module="demo/attend:1.0.0-dev"; protected $source="D:\\GitHub\\suda-attend\\app\\modules\\attend\\resource\\template\\default/index.tpl.html";protected function _render_template() {  ?><html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
    <title>ATD计算机协会招新啦～</title>
    <link rel="stylesheet" href="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/css/bui.css">
    <link rel="stylesheet" href="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/css/public.css">
    <style>

        /* 快捷入口导航 */
        .shortcut-nav .bui-btn{
            padding: 0.1rem 0;
            border-right: 1px solid #eee;
        }
        .shortcut-nav .bui-btn .icon{
            color: #ffffff;
            height: 1rem;
            width: 1rem;
            border-radius: 50%;
            line-height: 1rem;
            margin: 0.3rem 0;
            font-size: 0.6rem;
        }
        .short1{
            background-color: #6cc96c;
        }
        .short3{
            background-color: #ffb33e;
        }
        .short4{
            background-color: #00a5e2;
        }

        /* 顶部圆环 */
        .header-img{
            height: 4rem;
            background-color: #eec33e;/*背景色*/
        }
        /* 快捷入口 */
        .shortcut-nav .bui-box-vertical>[class*=span]{
            font-size: 0.2rem;
            color: #666666;
            padding-bottom: 0.15rem;
        }


        /*圆圈旋转动画*/
        .round-animate {
            width: 3rem;
            height: 3rem;
            overflow: hidden;
            margin: 0 auto;
            position: relative;
        }
        .round-animate img{
            max-width: 100%;
            max-height: 100%;
            vertical-align: top;
        }
        .round-animate .round-scan-light ,
        .round-animate .round-scan ,
        .round-animate .round-light ,
        .round-animate .round-inner ,
        .round-animate .round-outer {
            width: 100%;
            height: 100%;
            background: url("<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/images/round/round-outer.png") center no-repeat;
            background-size: auto 100%;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 10;
        }
        .ciwei{
            background: url("<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/images/logo.svg") center no-repeat;
            background-size:auto 18%;
            z-index:1;
            position:absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
        .round-animate .round-light {
            background-image: url("<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/images/round/round-light.png");
        }
        .round-animate .round-inner {
            background-image: url("<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/images/round/round-inner.png");
        }
        .round-animate .round-scan {
            background-image: url("<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/images/round/round-scan.png");
        }
        .round-animate .round-scan-light {
            background-image: url("<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/images/round/round-scan-light.png");
        }
        /*动画CSS3*/
        .animate-rotation{
            -webkit-animation:rotate 30s infinite linear;
            animation:rotate 30s infinite linear;
        }

        .animate-rotation-reverse{
            -webkit-animation:rotateReverse 4s infinite ease-out;
            animation:rotateReverse 4s infinite  ease-out;
        }
        .animate-rotation-inner{
            -webkit-animation:rotateReverse 8s infinite linear;
            animation:rotateReverse 8s infinite linear;
        }
        .animate-zoom{
            -webkit-animation:zoom 1s infinite ease-out;
            animation:zoom 1s infinite  ease-out ;
        }
        .animate-translateY{
            -webkit-animation:translateY 4s infinite ease-out;
            animation:translateY 4s infinite  ease-out ;
        }

        @-webkit-keyframes rotate{
            0%{ -webkit-transform:rotate(0deg);}
            100%{-webkit-transform:rotate(-360deg);}
        }
        @keyframes  rotate{
            0%{ -webkit-transform:rotate(0deg);}
            100%{-webkit-transform:rotate(-360deg);}
        }
        @-webkit-keyframes rotateReverse{
            0%{ -webkit-transform:rotate(0deg);}
            100%{-webkit-transform:rotate(360deg);}
        }
        @keyframes  rotateReverse{
            0%{ -webkit-transform:rotate(0deg);}
            100%{-webkit-transform:rotate(360deg);}
        }
        @-webkit-keyframes zoom{
            0%{ -webkit-transform:scale(0.9);}
            70%{ -webkit-transform:scale(1);}
            100%{-webkit-transform:scale(0.9);}
        }
        @keyframes  zoom{
            0%{ -webkit-transform:scale(0.9);}
            70%{ -webkit-transform:scale(1);}
            100%{-webkit-transform:scale(0.9);}
        }
        @-webkit-keyframes translateY{
            0%{ -webkit-transform:translateY(0);}
            30%{ -webkit-transform:translateY(30px);}
            80%{-webkit-transform:translateY(-20px);}
            100%{-webkit-transform:translateY(0);}
        }
        @keyframes  translateY{
            0%{ -webkit-transform:translateY(0);}
            30%{ -webkit-transform:translateY(30px);}
            80%{-webkit-transform:translateY(-20px);}
            100%{-webkit-transform:translateY(0);}
        }
    </style>
    <div id="bui-router"></div>
    <div id="page" class="bui-page">
        <header id="bar" class="bui-bar">
            <div class="bui-bar">
                <div class="bui-bar-left" style="opacity: 0.01">
                    <a class="bui-btn" onclick="bui.back();"><i class="icon-back"></i></a>
                </div>
                <div class="bui-bar-main">ATD协会报名中心</div>
                <div class="bui-bar-right">
                </div>
            </div>
        </header>

        <main>
            <!-- 圆 -->
            <div class="header-img bui-box-center">
                <div class="round-animate">
                    <div class="round-outer animate-rotation"></div>
                    <div class="round-inner animate-rotation-inner"></div>
                    <div class="round-light animate-rotation-reverse"></div>
                    <div class="round-main">
                        <div class="round-scan animate-zoom"></div>
                        <div class="round-scan-light animate-translateY"></div>
                        <div class="ciwei"></div>
                    </div>
                </div>
            </div>
            <!-- 快捷入口 -->
            <ul class="bui-nav shortcut-nav bui-fluid">
            <li class="bui-btn bui-box-vertical span4" id="about"><i class="icon short1">&#xe624;</i><div class="span1">关于协会</div></li>
            <li class="bui-btn bui-box-vertical span4" id="action"><i class="icon short3">&#xe62d;</i><div class="span1">报名入口</div></li>
            <li class="bui-btn bui-box-vertical span4" id="connect"><i class="icon short4">&#xe632;</i><div class="span1">联系我们</div></li>
            </ul>
        </main>
    </div>
<div class="footer" style="position:fixed;width:95%;margin-left:2.5%;background:#eee;border-radius: 8px;">
    <span style="display:block;font-size:.18rem;line-height:.42rem;text-align:center;color:#111;">制作者:谭俊伟、王成浩designed by <a href="https://github.com/dxkite/" style="color:skyblue;text-decoration: none;" target="_blank">suda</a></span>
</div>
</body>
    <script src="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/js/jquery.min.js"></script>
    <script src="<?php echo suda\template\Manager::assetServer(suda\template\Manager::getStaticAssetPath($this->getModule())); ?>/js/bui.js"></script>
<script>

    /*$("#about").click(function () {
        url_target("leader.php",null,"body",null);
    })*/

    $("#about").click(function () {
        bui.alert("林科大涉外学院ATD协会是学院计算机协会，ATD代表Academic Technology Dream，协会追求：学识为先，技术为上，梦想为引。在这里你可以学到很多关于计算机的知识，同时还能认识爱好相同的的人哦～让程序员不再孤单，让ps爱好者不再只为自己p图，等等···");
    });
    $("#action").click(function () {
        window.location.href="<?php echo $this->url('table'); ?>";
    });
    $("#connect").click(function () {
        window.location.href = "http://qm.qq.com/cgi-bin/qm/qr?k=dEq8-yspSdhYz2K69xUKyYpz7iNO7zqk";
    })
</script>
</html><?php }} } return ["class"=>"Template_6200b0c2f05dbb51ba3779414bf1cc50","name"=>"demo/attend:1.0.0-dev:index","source"=>"D:\\GitHub\\suda-attend\\app\\modules\\attend\\resource\\template\\default/index.tpl.html","module"=>"demo/attend:1.0.0-dev"]; 