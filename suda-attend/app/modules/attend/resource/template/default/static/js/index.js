bui.ready(function () {
    //初始化
    $("input[type='text']").css({"border":"1px solid #ccc"});
	$("input[type='number']").css({"border":"1px solid #ccc"});
    window.namechange = 0;
    window.studychange = 0;
    window.phonechange = 0;
    window.applychange = 0;
    window.prechange = 0;
    window.width1 = $(".form1").width();
    window.height1 = $(".form1").height();
    window.width2 = $(".form2").width();
    window.height2 = $(".form2").height();
    window.width3 = $(".form3").width();
    window.height3 = $(".form3").height();
    window.rheight = $(".result").height();
    window.rwidth = $(".result").width();
});

    $("input[type='text']").focus(function (e) {
        $(this).css("border","solid 1px lightskyblue");
        $(this).animate({"border-radius":".16rem"},600)
    });
    $("input[type='text']").blur(function () {
        $(this).css("border","solid 1px #ccc");
        $(this).animate({"border-radius":".3rem"},600)
    });
	    $("input[type='number']").focus(function (e) {
        $(this).css("border","solid 1px lightskyblue");
        $(this).animate({"border-radius":".16rem"},600)
    });
    $("input[type='number']").blur(function () {
        $(this).css("border","solid 1px #ccc");
        $(this).animate({"border-radius":".3rem"},600)
    });
    $("textarea").focus(function () {
        $(this).css("border","solid 1px lightskyblue");
        $(this).animate({"border-radius":"0.14rem","padding":"0.05rem 0.06rem"},500)
    });
    $("textarea").blur(function () {
        $(this).css("border","solid 1px #ccc");
        $(this).animate({"border-radius":"0.24rem","padding":"0.05rem 0.1rem"},500)
    });
    /*$("#phone").onkeyup(function () {
       alert("Test");
    });*/
    $("#next1").click(function () {
        window.name = $("#name").val();
        window.age = $("#age").text();
        window.sex = $("input[name='sex']:checked").val();
        window.study = $("#study").val();
        if(name == ""||name == "请输入您的姓名"){
            become_red("name","请输入您的姓名");
            window.namechange = 1;
        }else if(age=="点击选择年级"){
            alert("请选择年级");
        }
        else if(sex==null||sex==""){
            alert("大佬,请您不要搞事情");
        }else if(study==""||study=="请输入学号"){
            become_red("study","请输入学号");
            window.studychange = 1;
        }else if(document.getElementById("study").value.length !=8){
            alert("学号不是8位的请联系ATD管理提交报名表");
        }
        else{
            $(".form1").animate({opacity:0.01,height:0,width:0},800);
            $(".form2").animate({opacity:1,height:height2,width:width2},400);
        }
    });
    $("#next2").click(function () {
        window.phone = $("#phone").val();
        window.qq = $("#qq").val();
        window.wechat = $("#wechat").val();
        if(phone==""||phone=="请输入手机号"){
            become_red("phone","请输入手机号");
            window.phonechange =1;
        }else if(qq==""&&wechat==""){
            alert("qq与微信必须选填一项，谢谢合作！");
        }else if(document.getElementById("phone").value.length!=11){
            alert("请输入中国的11位手机号，谢谢");
        }else if(document.getElementById("qq").value.length<5){
            alert("您的qq号位数这么少，可以把qq卖了换一个再提交吗(这样就有更多资金赞助我们协会了)");
        }
        else{
            $(".form2").animate({opacity:0.01,height:0,width:0},800);
            $(".form3").animate({opacity:1,height:height3,width:width3},400);
        }
    });
    $("#next3").click(function(){
        window.apply = $("#apply").val();
        window.pre = $("#pre").val();
        if(apply==""||apply=="请写好您的申请书"){
            become_red("apply","请写好您的申请书");
            window.applychange = 1;
        }else if(pre==""||pre=="请写好您的自我介绍"){
            become_red("pre","请写好您的自我介绍");
            window.prechange = 1;
        }else if(document.getElementById("apply").value.length<=10){
            alert("申请书怎么也得有10个字吧？");
        }else if(document.getElementById("pre").value.length<=30) {
            alert("自我介绍30个字都没有真的好吗");
        }
        else{
            $(".form3").animate({opacity:0.01,height:0,width:0},500);
            $(".result").animate({opacity:1,height:rheight,width:rwidth},500);
            if(sex==1){
                sex="男";
            }else if(sex==2){
                sex="女";
            }else if(sex==3){
                sex="不男不女";
            }
            $("#result-age").html(age);
            $("#result-name").html(name);
            $("#result-sex").html(sex);
            $("#result-study").html(study);
            $("#result-phone").html(phone);
            $("#result-qq").html(qq);
            $("#result-wechat").html(wechat);
            $("#result-apply").html(apply);
            $("#result-pre").html(pre);
        }
    });
    //next 事件



    //change事件

    $("#name").click(function () {
        if(namechange==1){
            become_normal("name",namechange);
            window.namechange=0;
        }
    });
    $("#study").click(function () {
        if(studychange==1){
            become_normal("study",studychange);
            window.studychange=0;
        }
    });
    $("#phone").click(function () {
        if(phonechange==1){
            become_normal("phone",phonechange);
            window.phonechange=0;
        }
    });
    $("#pre").click(function () {
        if(prechange==1){
            become_normal("pre",prechange);
            window.prechange=0;
        }
    });
    $("#apply").click(function () {
        if(applychange==1){
            become_normal("apply",applychange);
            window.applychange=0;
        }
    });
    $("#preview2").click(function () {
        $(".form2").animate({opacity:0.01,height:0,width:0},800);
        $(".form1").animate({opacity:1,height:height1,width:width1},800);
    });
    $("#preview3").click(function () {
        $(".form3").animate({opacity:0.01,height:0,width:0},800);
        $(".form2").animate({opacity:1,height:height1,width:width1},800);
    });
    $("#preview4").click(function () {
        $(".result").animate({opacity:0.01,height:0,width:0},800);
        $(".form3").animate({opacity:1,height:height1,width:width1},800);
    });
    //封包函数,好处:改变效果可以直接在如下函数内部改

    function become_red(id,val){
        $("#"+id).val(val);
        $("#"+id).css("border","1px solid red");
        $("#"+id).css("color","orangered");
        $("#"+id).animate({"left":"10px"},500);
    }
    function become_normal(id,reason){
        if(reason==1){
            $("#"+id).animate({"border":"1px solid lightskyblue"},500);
            $("#"+id).css("color","black");
            $("#"+id).val("");
        }
    }
    $("#last").click(function () {
        if(qq==""){
            window.qq=null;
        }
        if(wechat==""){
            window.wechat=null;
        }
        bui.confirm("是否确定提交",function (argument) {
            //this 是指点击的按钮
            var text = $(this).text();
            if(text == "确定"){
                window.location.href="./success";
            }
        });
        //插入数据库时应该严格遵守数据库规定，否则可能会导致无法将null值插入数据库
        /*
        对应值说明:
            name:名字
            age:年级-专业-班级信息
            sex:性别
            study:学号
            phone:手机
            qq:qq号
            wechat:微信号
            apply:入会申请书
            pre:自我介绍书
        */

        console.log(name,age,sex,study,phone,qq,wechat,apply,pre);
    });

