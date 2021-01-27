# Life798
生活798_实现php控制喝水，比起使用app进行控制，网页控制可操作性就更高了。

## 原理
通过抓包app，获取响应的接口。

## 实例
具体信息查看代码
```php
<?php

require_once 'Life798.php';

$pn = '';   // 手机号
$pwd = '';  // 密码

// 实例化对象
$demo = new Life798($pn, $pwd);

// code... 接下来的操作可以随意了

```

## 可能遇到的问题

调用时可能遇到报错提醒，在代码中加入这个消除。
```php
error_reporting(E_ERROR | E_PARSE);
```

# 注意
仅供学习交流，严禁用于商业用途，请于24小时内删除