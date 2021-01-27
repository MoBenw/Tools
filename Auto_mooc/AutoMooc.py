import requests
import execjs
from lxml import etree
import re
import json
from tqdm import tqdm
import time
import uuid


class AutoMooc:
    def __init__(self, loginName, password):
        self.loginName = loginName
        self.password = password
        self.urlCourseList = []
        self.session = requests.session()
        self.headers = {
            'User-Agent': "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36",
            'Content-Type': "application/x-www-form-urlencoded; charset=UTF-8",
            'Referer': "http://zswxy.minghuaetc.com/home/login.mooc",
            'Cookie': "moocvk=d4e017b327c44df881e52c9004fb3c98; sos=true; moocsk=cc2c0ddf620b43bf85cf2abe1e13d3c4",
        }

    def run_mooc(self):
        """
        入口命令
        :return:
        """
        print(self.loginName + '登陆状态: ' + self.login_mooc())
        if self.login_mooc() == 'success':
            for i, myCourseUrl in enumerate(self.get_my_course_url_list()):
                itemIds = self.my_course_detail_itemId(myCourseUrl)
                for index, itemId in enumerate(itemIds):
                    try:
                        duration = self.get_video_duration_time(itemId)
                        courseUnitid = self.courseUnitid[index]
                        courseOpenId = self.get_video_setting(courseUnitid)
                        self.rush_mooc(itemId, duration, courseUnitid, courseOpenId)  # 刷课主程序
                        print(self.courseDetailTitle[index], '课程完毕')
                    except Exception as e:
                        print(index, itemId + ' 遇到了一个问题【需要笔试/未开始】,报错情况为：', e, '行数为：', e.__traceback__.tb_lineno)
                        continue
                print('【' + self.courseTitle[i] + '】搞定！')
            print('***恭喜 ' + self.loginName + ' 您已全部刷完，请自行登陆查看***', '\nhttp://zswxy.minghuaetc.com/home/login.mooc')

    def getJsCode(self):
        """
        获取jscode
        :return: jscode string
        """
        f = open("main.js", 'r', encoding='UTF-8')
        line = f.readline()
        htmlstr = ''
        while line:
            htmlstr = htmlstr + line
            line = f.readline()
        return htmlstr

    def login_mooc(self):
        """
        登陆慕课
        :return:
        """
        js_content = self.getJsCode()
        Login_class = execjs.compile(js_content)
        strToken = Login_class.call('start', '010001',
                                    '0088d263588e5916662b39e30319cc92f995f8a5555458830cac272e8d9d12328ff3fa023a4c0bee12248264c1dc46165a37c617b217cfaf3d010f941bafd89dc035ac81b58c5ca7eb9027d7bca9ae33805ed77b9af79338b2c824ba1c5fde7d1010c6024ebaa1a1cf164323ce46fdf8d64ad6f207ca156c204b454c8a1bb8325b',
                                    'FmfAU8BKd3XzGsCR51A3KQg2XzkNzGJKUpYh', self.password)
        urlDoLogin = "http://zswxy.minghuaetc.com/home/doLogin.mooc"
        payload_doLogin = "loginName=" + self.loginName + "&strToken=" + strToken + "&loginType=0&isCheckCode=1&checkCode=75r9&historyUrl=null"
        response = self.session.post(urlDoLogin, data=payload_doLogin, headers=self.headers)
        return json.loads(response.text)['retMsg']

    def get_my_course_url_list(self):
        """
        获取全部网课url
        :return:
        """
        urlMyCourseIndex = 'http://zswxy.minghuaetc.com/portal/ajaxMyCourseIndex.mooc'
        payload_MyCourseIndex = 'keyWord=&tabIndex=1&searchType=0&schoolcourseType=0&pageIndex=1'
        response = self.session.post(urlMyCourseIndex, data=payload_MyCourseIndex, headers=self.headers)
        # xpath操作
        html = etree.HTML(response.text)
        result = html.xpath('//a[@class="view-shadow"]/@href')  # 获取已选课程
        self.courseTitle = html.xpath('//span[@class="cview-time"]/text()')  # 获取网课名称
        urlCourseList = ['http://zswxy.minghuaetc.com/portal/session/unitNavigation/' + course.split('/')[-1] for course
                         in result]
        return urlCourseList

    def my_course_detail_itemId(self, url):
        """
        获取课程id
        同时也顺便设置了课程名称、课unitID
        :param url:
        :return:
        """
        response = self.session.get(url, headers=self.headers)
        # xpath操作
        html = etree.HTML(response.text)
        """
        未完成 icon-disabled
        已经完成 icon-play-done
        """
        type = 'icon-disabled'
        itemId = html.xpath('//i[contains(@class,"{}")]/../@itemid'.format(type))  # 获取itemId
        self.courseDetailTitle = html.xpath('//i[contains(@class,"{}")]/../@title'.format(type))  # 获取课程名称
        self.courseUnitid = html.xpath('//i[contains(@class,"{}")]/../../../a/@unitid '.format(type))  # 获取网课unitid
        return itemId

    def get_video_duration_time(self, itemId):
        """
        获取视频时长
        :param itemId:
        :return:
        """
        urlVideoDeatil = 'http://zswxy.minghuaetc.com/study/play.mooc'
        payload_VideoDeatil = 'itemId=' + itemId + '&itemType=10&testPaperId='
        response = self.session.post(urlVideoDeatil, data=payload_VideoDeatil, headers=self.headers)
        return re.search(r'(?<="duration":)[^<]*?(?=,"width")', response.text).group()  # 正则取出视频长度

    def get_video_setting(self, unitid):
        """
        获取 courseOpenId
        :param unitid:
        :return:
        """
        urlMooc = 'http://zswxy.minghuaetc.com/study/unit/{}.mooc'.format(unitid)
        response = self.session.get(urlMooc, headers=self.headers)
        # xpath操作
        html = etree.HTML(response.text)
        courseOpenId = html.xpath('//input[@id="courseOpenId"]/@value')[0]  # 获取
        return courseOpenId

    def js_post_log(self, openCourseId, itemId, unitid):
        """
        用于制作 js log_post所需的url
        :param openCourseId:
        :param itemId:
        :param unitid:
        :return:
        """
        url = "http://zswxy.minghuaetc.com/log/study.mooc?si={openCourseId}&ii={itemId}&it=10&ut=&vk=&ds=1536x864&dc=24&cs=1&js=0&ln=zh-CN&ua=TW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzc4LjAuMzkwNC44NyBTYWZhcmkvNTM3LjM2&ru=http%3A%2F%2Fzswxy.minghuaetc.com%2Fstudy%2Funit%{unitid}.mooc&fv=".format(
            openCourseId=openCourseId, itemId=itemId, unitid=unitid)
        # 随便一个uuid试试
        uid = str(uuid.uuid1()).replace('-', '')
        url += '&vs=' + uid
        return url

    def js_study_tart(self, url):
        """
        发送开始log
        :param url:
        :return:
        """
        url += "&at=10&sp=0"
        self.session.get(url, headers=self.headers)

    def js_study_done(self, url, duration):
        """
        发送结束log
        :param url:
        :param duration:
        :return:
        """
        url += "&at=50&sp={duration}&prventcache={timestamp}".format(
            duration=duration, timestamp=str(time.time() * 1000).split('.')[0])
        self.session.get(url, headers=self.headers)

    def rush_mooc(self, itemId, duration, unitid, openCourseId):
        """
        模拟刷课
        :param itemId:
        :param duration:
        :return:
        """
        urlJsLog = self.js_post_log(openCourseId, itemId, unitid)
        payload_UpdateDuration = "itemId={itemId}&isOver={isOver}&currentPosition={position}&duration={duration}"
        # 提交开始log
        self.js_study_tart(urlJsLog)
        for position in tqdm(range(0, int(duration), 60300), desc=unitid + ' 章节进程'):
            urlUpdateDuration = "http://zswxy.minghuaetc.com/study/updateDurationVideo.mooc"
            payload_UpdateDuration = 'itemId=' + itemId + '&isOver=1&currentPosition=' + str(position) + '&duration=' + duration
            self.session.post(urlUpdateDuration, data=payload_UpdateDuration, headers=self.headers)
        # 双重保险
        urlUpdateDuration = "http://zswxy.minghuaetc.com/study/updateDurationVideo.mooc"
        payload_UpdateDuration = payload_UpdateDuration.format(
            itemId=itemId, isOver=1, position=duration, duration=duration)
        self.session.post(urlUpdateDuration, data=payload_UpdateDuration, headers=self.headers)
        # 三重保险
        urlUpdateDuration = "http://zswxy.minghuaetc.com/study/updateDurationVideo.mooc"
        payload_UpdateDuration = payload_UpdateDuration.format(
            itemId=itemId, isOver=2, position=duration, duration=duration)
        self.session.post(urlUpdateDuration, data=payload_UpdateDuration, headers=self.headers)
        # 提交结束log
        self.js_study_done(urlJsLog, duration)


if __name__ == '__main__':
    xh = input('请输入学号：')
    pwd = input('请输入密码：')
    autoMooc = AutoMooc(xh, pwd)
    autoMooc.run_mooc()
