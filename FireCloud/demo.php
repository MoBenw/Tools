<?php
/**
 * Created by PhpStorm.
 * User: mobenw
 * Date: 2019/4/18
 * Time: 15:18
 */

require_once 'FCloud.php';

$name = 'xxxx'; // 账号
$password ='xxxx';  // 密码
$sid = 'xx';    // 项目id

// 实例化对象
$fcloud = new FCloud($name,$password);
// 获取手机号
$phone = substr($fcloud->getPhone($sid),2);
// 获取验证码
$message = $fcloud->getMessage($phone);
// 获取六位数的数字验证码
preg_match('/(?<!\d)\d{6}(?!\d)/',$message,$message);

echo $message;