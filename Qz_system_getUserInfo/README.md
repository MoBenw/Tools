# Qz_system_getUserInfo
弱智教务 用户信息获取 使用Python3实现

## 简述

为了批量存储自己所需的数据，所以需要用到了 `pymysql` 和 `threating`

由于水平有限，有些硬核，就当做是这两个库的练习吧

api来源：[MoBenw/Qz_system](https://github.com/MoBenw/Qz_system)

## 安装依赖

安装依赖
```
pip install -r requirements.txt
```

## 运行

在 `Config.py` 文件中输入自己的相关信息

在 `main.py` 中 修改学号的起点与终点

```py
# 默认循环版
python3 main.py

# 菜鸡多线程版
python3 main_threating.py
```
> 这里创建数据表会删除当前该名的数据表，故需谨慎备份数据