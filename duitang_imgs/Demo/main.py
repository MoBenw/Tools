import requests
import os
import urllib3


class Dutang:
    album_data_url = 'https://www.duitang.com/napi/blog/list/by_album/?limit=100&album_id='
    album_search_url = 'https://www.duitang.com/napi/album/list/by_search/?&limit=100&kw='

    def getAlbumList(self, kw):
        """
        获取专辑列表
        :param kw: 搜索关键字
        :return: 专辑列表
        """
        album_list = []
        start = '0'
        while True:
            # 请求数据
            url = self.album_search_url + kw + '&start=' + start
            r = requests.get(url).json()

            # 结束条件
            if r['data']['object_list'] == []:
                break

            # 整理数据
            for i in r['data']['object_list']:
                if i['count'] != 0:  # 保证里面有图片
                    # print(i['id'])
                    album_list.append(i['id'])

            # 下一个开始
            start = str(r['data']['next_start'])
        return album_list

    def getAlbumData(self, album_id):
        """
        获取专辑图片信息
        :param album_id: 专辑id
        :return: 图片数组
        """
        img_urls = []
        start = '0'
        while True:
            # 请求数据
            url = self.album_data_url + str(album_id) + '&start=' + start
            r = requests.get(url).json()

            # 结束条件
            if r['data']['object_list'] == []:
                break

            # 整理数据
            for i in r['data']['object_list']:
                # print(i['photo']['path'])
                img_urls.append(i['photo']['path'])

            # 下一个开始
            start = str(r['data']['next_start'])
        return img_urls


dutang = Dutang()
# album_list = dutang.getAlbumList('鹦鹉')  # 获取专辑数组
# print(album_list)

# 已经跑了的数据
album_list = ['92809105', '92305259', '90445539', '89496201', '84985547', '93226236', '90525519', '89693203',
              '89242521', ]

# 设置路径
path = './imgs/'

# 获取img URI
for album_id in album_list:
    img_list = dutang.getAlbumData(album_id)  # 获取图片url数组
    file_path = path + str(album_id)  # 文件路径
    if not os.path.exists(file_path):
        os.mkdir(file_path)  # 创建文件夹
    for img_url in img_list:
        url = img_url.split('_jpeg')[0]  # 真实的url
        filename = img_url.split('_jpeg')[0].split('/')[-1]  # 文件名
        with open(file_path + '/' + filename, 'wb') as f:
            print(album_id, url)
            urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)  # 取消因ssl的报错
            img = requests.get(url, verify=False).content
            f.write(img)
