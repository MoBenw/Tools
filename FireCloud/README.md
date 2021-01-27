# FireCloud
火云api php封装

## 简述
为了方便个人使用，于是将api封装整理了一下

## 原理
具体原理请参考 [火云官方api文档](http://download.huoyun888.cn/api.html)

## 实例
这里实例取一个验证码
```php
<?php
require_once 'FCloud.php';

$name = 'xxxx'; // 账号
$password ='xxxx';  // 密码
$sid = 'xx';    // 项目id

// 实例化对象
$fcloud = new FCloud($name,$password);
// 获取手机号
$phone = $fcloud->getPhone($sid);
// 获取验证码
$message = $fcloud->getMessage($phone);

echo $message;
```