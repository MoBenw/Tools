import threading
from PySqls import *
from Qzjw import *
from Config import *
import datetime


def main(config, qzjw, num_start, num_end):
    # 构建一个数据集
    data_list = []

    # 使用while做循环
    i = num_start
    while i < num_end:
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


if __name__ == "__main__":
    start_time = datetime.datetime.now()

    config = Config()  # 实例化config
    qzjw = Qzjw(config.url, config.xh, config.pwd)  # 实例化qzjw

    my_pysql = PySqls(config.database_name, config.database_pwd, config.database_pwd)  # 实例化数据库操作

    # 创建数据表
    my_pysql.db_create_table_for_userInfo(config.table_name)

    # 创建线程？
    t1_1 = threading.Thread(target=main, args=(config, qzjw, 20155000, 20157500))
    t1_2 = threading.Thread(target=main, args=(config, qzjw, 20157500, 20160000))
    # 启动线程？
    t1_1.start()
    t1_2.start()
    # 保护子线程
    t1_1.join()
    t1_2.join()

    end_time = datetime.datetime.now()

    seconds = (end_time - start_time).seconds
    start = start_time.strftime('%Y-%m-%d %H:%M')
    # 100 秒
    # 分钟
    minutes = seconds // 60
    second = seconds % 60
    print((end_time - start_time))
    time_str = str(minutes) + '分钟' + str(second) + "秒"
    print("程序从 " + start + ' 开始运行,运行时间为：' + time_str)
