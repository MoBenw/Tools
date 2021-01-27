<?php

require_once 'Qzjw.php';

$url = 'http://YOUR_SITE/app.do'; // 教务网地址
$xh = 'xxxxxx'; // 学号
$pwd = 'xxxxxx'; // 密码

// 实例化对象
$demo = new Qzjw($url, $xh, $pwd);
$data = $demo->getCurrentTime();  //获取当前学年、周次
$kb = $demo->getKbcxAzc($data['xnxqh'],$data['zc']);

print_r($kb);