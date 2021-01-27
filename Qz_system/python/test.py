from Qzjw import *

url = 'http://YOUR_SITE/app.do'  # 教务网地址
xh = 'xxxxxx'  # 学号
pwd = 'xxxxxx'  # 密码

demo = Qzjw(url, xh, pwd)
data = demo.getCurrentTime()  # 获取当前学年、周次
kb = demo.getKbcxAzc(xh, data['xnxqh'], data['zc'])
print(kb)