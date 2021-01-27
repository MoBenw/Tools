# Auto_mooc
python 实现自动刷网课 究极post版 名华在线 中南林涉外

## 简述

正所谓究极版，就是比之前的selenium版的牛逼一点的,selenium版可查看 [MoBenw/Brush_online_course](https://github.com/MoBenw/Brush_online_course) 了解

## 原理

不再需要浏览器驱动，直接肝他的接口

## 提示！

似乎是被检测到了，这里的验证码饶过似乎遇到了问题。

如果自带的饶过不行的话，需要你手动饶过，正常登陆将验证码对应的cookie设置好

## 下载依赖

```
pip install -r requirements.txt
```

## 实例

test.py
```
from AutoMooc import *

xh = 'xxxxxx'
pwd = 'xxxxxx'
autoMooc = AutoMooc(xh, pwd)
autoMooc.run_mooc()
```

## 感谢

这里非常感谢 [superl大佬](http://www.gosql.cn/) 攻克登陆问题并指导菜鸡的我写代码