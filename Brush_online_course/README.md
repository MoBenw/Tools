# Brush_online_course
python selenium实现自动刷网课 名华在线

## 简述

看到身边的小伙伴还在刷网课，电脑挂在那，还是不是要去点一下，很是麻烦，为此，菜鸡的我尝试着写了一波。

名华在线 这个网课网还行，没有给你设置很大的困难，所以比较简单。

## 原理

通过 `Python` 的 `selenium`浏览器自动化而实现的

通过监听 标签class为 `icon-disabled` 以区分未刷完的网课

通过监听 滚动条 `width` 的长度来确定视频是否播放完毕

## 再说一句

既然是挂机，那么最好还是去电脑的电源设置那里设置一下，避免刷着刷着中途黑屏了

## 下载依赖

```
pip install -r requirements.txt
```
如果是选择免验证码版的记得去下载一下 `tesseract-ocr` 不然会翻车，使用不了


## TODO

TODO：我还有一些bug 没修复...
 - [x] 标准版
 - [x] 免验证版
 - [ ] 终极直刷版


## 实例

说明一下!
这里需要提供的网址是如下图样式

![刷网课.png](https://ae01.alicdn.com/kf/H87070e43d54e427088147fc32b2b7a98j.png)

-----

测试代码如下

test.py
```py
from BrushOnlineCourse import *

url = 'http://YOUR_SITE'  # 要刷的网课地址
xh = 'xxxxxx'  # 学号
pwd = 'xxxxxx'  # 密码

demo = BrushOnlineCourse(url, xh, pwd)
demo.run()
```
