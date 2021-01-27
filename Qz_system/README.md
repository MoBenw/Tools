# QzAcademicAffairs
基于强智教务api进行封装开发
借鉴了 [TLingC/QZAPI_Archive](https://github.com/TLingC/QZAPI_Archive) 提供的api，从而进行二次开发

## 简述

为方便个人进行教务操作，于是将其封装起来，常用的以及前置的函数提前放置。
由于水平有限，所以就只整理了 [PHP](https://github.com/MoBenw/QzAcademicAffairs/blob/master/php/Qzjw.php) 和 [Python](https://github.com/MoBenw/QzAcademicAffairs/blob/master/python/Qzjw.py) 的
## 原理

通过用户登入获取 `token` 从而进行其他操作，这里已经在构造中获取了token，所以只需要直接调用函数就行。

## 实例

这里实现一个课表查询

### PHP 实现

```php
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
```

### Python 实现

```py
from Qzjw import *

url = 'http://YOUR_SITE/app.do'  # 教务网地址
xh = 'xxxxxx'  # 学号
pwd = 'xxxxxx'  # 密码

demo = Qzjw(url, xh, pwd)
data = demo.getCurrentTime()  # 获取当前学年、周次
kb = demo.getKbcxAzc(xh, data['xnxqh'], data['zc'])
print(kb)
```