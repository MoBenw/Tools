from PySqls import *
from Qzjw import *
from Config import *
import datetime

if __name__ == "__main__":

    start_time = datetime.datetime.now()

    config = Config()  # 实例化config
    qzjw = Qzjw(config.url, config.xh, config.pwd)  # 实例化qzjw

    my_pysql = PySqls(config.database_name, config.database_user, config.database_pwd)  # 实例化数据库操作

    # 创建数据表
    my_pysql.db_create_table_for_userInfo(config.table_name)

    my_pysql.db_close()  # 关闭数据库连接

    # 构建一个数据集
    data_list = []

    # 使用while做循环
    i = 20156000
    while i <= 20159999 + 1:
        print(i)
        data = qzjw.getUserInfo(i)
        if data != {}:
            data_list.append([data['xh'], data['nj'], data['xm'], data['xb'], data['bj'], data['yxmc'], data['zymc']])
        if (len(data_list) == 100):
            my_pysql = PySqls(config.database_name, config.database_user, config.database_pwd)  # 实例化数据库操作
            my_pysql.db_insert_batch_for_userInfo('test', data_list)  # 数据批量插入
            data_list.clear()
            my_pysql.db_close()  # 关闭数据库连接
        i += 1

    my_pysql = PySqls(config.database_name, config.database_user, config.database_pwd)  # 实例化数据库操作
    my_pysql.db_insert_batch_for_userInfo('test', data_list)  # 数据批量插入
    my_pysql.db_close()  # 关闭数据库连接

    # 记录下时间
    end_time = datetime.datetime.now()

    seconds = (end_time - start_time).seconds
    start = start_time.strftime('%Y-%m-%d %H:%M')
    minutes = seconds // 60
    second = seconds % 60
    print((end_time - start_time))
    time_str = str(minutes) + '分钟' + str(second) + "秒"
    print("程序从 " + start + ' 开始运行,运行时间为：' + time_str)
