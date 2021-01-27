from selenium import webdriver
from selenium.webdriver.common.action_chains import ActionChains
import time


class BrushOnlineCourse:
    def __init__(self, url, account, password):
        """明华在线自动刷网课

        :param url: 网课url
        :param account: 学号
        :param password: 密码
        """
        self.url_login = 'http://zswxy.minghuaetc.com/portal/myCourseIndex/1.mooc'
        self.url_temp = ''
        self.url_wk_content = url
        self.account = account
        self.password = password

        # 浏览器操作区
        self.chromeOptions = webdriver.ChromeOptions()
        # self.chromeOptions.add_argument('--headless')
        self.chromeOptions.add_argument('log-level=3')
        self.browser = webdriver.Chrome(chrome_options=self.chromeOptions)  # 启动浏览器

    def run(self):
        """执行主函数！

        :return:
        """
        if self.login():
            while not self.checkIsEnd():
                self.videoStart()
                self.videoSetting()
                self.checkVideoIsEnd()
        self.browser.quit()

    def login(self):
        """用户登陆

        :return: boolean
        """
        the_login_url = 'http://zswxy.minghuaetc.com/home/login.mooc?historyUrl=L3BvcnRhbC9teUNvdXJzZUluZGV4LzEubW9vYw%3D%3D'
        self.browser.get(self.url_login)
        if self.browser.current_url == the_login_url:
            self.browser.find_element_by_id('loginName').send_keys(self.account)
            self.browser.find_element_by_id('password').send_keys(self.password)
            self.browser.find_element_by_id('checkCode').send_keys('')
            # self.browser.find_element_by_id('autoLogin').click() # 保持一周登陆
        else:
            self.browser.get(self.url_login)

        # 判断是否登陆成功
        while self.browser.current_url != self.url_login:
            time.sleep(1)
        print(self.account + '登陆成功')
        return True

    def checkIsEnd(self):
        """检查网课是否刷完，若刷完则返回True，否则则返回False

        :return: boolean
        """
        self.browser.get(self.url_wk_content)
        if self.browser.current_url == self.url_wk_content:
            self.browser.find_element_by_xpath(
                '/html/body/div[3]/div[1]/div[2]/div/div/ul/li[2]/ul/li[1]/a').click()  # 进入章节导航
            if len(self.browser.find_elements_by_class_name('icon-disabled')) == 0:
                print('**恭喜你全部刷完了**')
                return True
        else:
            self.browser.get(self.url_wk_content)
            return False

    def videoStart(self):
        """开始刷网课

        :return: None
        """
        self.browser.get(self.url_wk_content)
        if self.browser.current_url == self.url_wk_content:
            self.browser.find_element_by_xpath(
                '/html/body/div[3]/div[1]/div[2]/div/div/ul/li[2]/ul/li[1]/a').click()  # 进入章节导航
            self.browser.find_elements_by_class_name('icon-disabled')[0].click()  # 进入未完成的视频
            print('【进入网课页面】')
            self.url_temp = self.browser.current_url
        else:
            self.browser.get(self.url_wk_content)

    def videoSetting(self):
        """设置观看视频时的相关操作，如二倍观看速度

        :return: None
        """
        # 纯粹的冷静5s
        for i in range(5):
            time.sleep(1)
            print('\r' + str(i) + '秒', end='')
        print('\n5秒缓冲时间结束')
        print('网课url:' + self.url_temp)
        if self.browser.current_url == self.url_temp:
            ActionChains(self.browser).move_to_element(
                self.browser.find_element_by_id('mediaplayer_display')).perform()  # 鼠标移动到视频屏幕上
            temp = self.browser.find_element_by_xpath(
                '//*[@id="mediaplayer_controlbar"]/span[5]/span[3]/span[2]/button')  # 倍速按钮位置
            ActionChains(self.browser).move_to_element(temp).perform()  # 鼠标移动到倍速设置上
            self.browser.find_element_by_id('mediaplayer_controlbar_rate_option_6').click()  # 二倍速选择
            print('【倍速，静音设置成功】')
        else:
            self.browser.get(self.url_temp)

    def checkVideoIsEnd(self):
        """检查视频是否播放完毕，若刷完则返回True，否则则返回False

        :return: boolean
        """
        if self.browser.current_url == self.url_temp:
            while self.browser.find_element_by_xpath(
                    '//*[@id="mediaplayer_controlbar"]/span[4]/span[1]/span[2]/span[3]').get_attribute(
                'style').split(';')[0] != 'width: 0%':
                print('\r当前进度：' + self.browser.find_element_by_xpath(
                    '//*[@id="mediaplayer_controlbar"]/span[4]/span[1]/span[2]/span[3]').get_attribute(
                    'style').split(';')[0].split(':')[1], end='')
            print('\n【恭喜刷完本章:' + self.browser.find_element_by_xpath(
                '/html/body/div[3]/div[2]/div[2]/div/div[2]/div/div/div[1]/div/ul/li/a').get_attribute(
                'itemname') + '】')
            return True
        else:
            self.browser.get(self.url_temp)
            return True
