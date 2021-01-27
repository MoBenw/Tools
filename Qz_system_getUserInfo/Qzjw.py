import requests
import json
import time


class Qzjw:
    url = ''  # 教务链接
    headers = {}  # 头文件

    def __init__(self, url, xh, pwd):
        """ 基于强智教务api的Python实现
        学校教务链接查询通道-http://app.qzdatasoft.com:9876/qzkjapp//phone/provinceData

        :param url: 教务网链接
        """
        self.url = url
        self.headers = {
            'token': self.getToken(xh, pwd)
        }

    def curl(self, params):
        """ 简化requests请求

        :param params: 请求参数
        :return: 请求结果
        """
        return json.loads(requests.request("GET", self.url, headers=self.headers, params=params).text)

    def authUser(self, xh, pwd):
        """ 登入账号

        :param xh: 学号
        :param pwd: 密码
        :return: 登录信息
        """
        params = {
            "method": "authUser",
            "xh": xh,
            "pwd": pwd
        }

        return self.curl(params)

    def getToken(self, xh, pwd):
        """ 获取token

        :param xh: 学号
        :param pwd: 密码
        :return: token
        """
        return self.authUser(xh, pwd)['token']

    def getCjcx(self, xh, xnxqid):
        """ 获取成绩信息

        :param xh: 学号
        :param xnxqid: 学期学年id
        :return: 成绩
        """
        params = {
            "method": "getCjcx",
            "xh": xh,
            "xnxqid": xnxqid
        }

        return self.curl(params)

    def getKbcxAzc(self, xh, xnxqid, zc):
        """ 获取一周的课程信息

        :param xh: 学号
        :param xnxqid: 学年学期id
        :param zc: 周次
        :return: 课表
        """
        params = {
            "method": "getKbcxAzc",
            "xh": xh,
            "xnxqid": xnxqid,
            "zc": zc
        }

        return self.curl(params)

    def getUserInfo(self, xh):
        """ 获取账号信息

        :param xh: 学号
        :return: 账户信息
        """
        params = {
            "method": "getUserInfo",
            "xh": xh
        }

        return self.curl(params)

    def getXnxq(self, xh):
        """ 获取学年学期信息

        :param xh: 学号
        :return: 学年学期
        """
        params = {
            "method": "getXnxq",
            "xh": xh
        }

        return self.curl(params)

    def getXqcx(self):
        """ 获取校区信息

        :return: 校区信息
        """
        params = {
            "method": "getXqcx"
        }

        return self.curl(params)

    def getCurrentTime(self, time=time.strftime("%Y-%m-%d", time.localtime())):
        """ 获取所提交的日期的时间、周次、学年等信息

        :return: 校区信息
        """
        params = {
            "method": "getCurrentTime",
            "currDate": time
        }

        return self.curl(params)
