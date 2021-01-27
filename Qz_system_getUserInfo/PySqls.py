import pymysql


class PySqls:
    def __init__(self, database_name, user, pwd):
        """ 校园助手之教务开发专属表操作

        :param database_name: 数据库名
        :param table_name: 数据表名
        :param user: 用户名
        :param pwd: 密码
        """
        self.database_name = database_name
        self.user = user
        self.pwd = pwd
        self.db = self.db_connect()

    def db_connect(self):
        """ 连接数据库

        :return: 连接对象
        """
        try:
            conn = pymysql.connect(
                host='localhost',
                port=3306,
                user=self.user,
                passwd=self.pwd,
                db=self.database_name,
                charset='utf8',
            )
            print('数据库连接成功！')
            # 返回连接
            return conn
        except pymysql.Error as e:
            print('数据库连接失败')
            print('mysql.Error: ', e.args[0], e.args[1])

    def db_create_table_for_userInfo(self, table_name):
        """ 创建数据表—用户基本信息表

        :param table_name: 数据表名
        :return: 空
        """

        # 获取操作游标
        cursor = self.db.cursor()

        # 使用 execute() 方法执行 SQL，如果表存在则删除
        cursor.execute("DROP TABLE IF EXISTS {}".format(table_name))

        # SQL 建表语句
        sql = """CREATE TABLE `{0}`.`{1}`  (
          `id` int(3) NOT NULL AUTO_INCREMENT,
          `xh` varchar(255) NULL,
          `nj` varchar(255) NULL,
          `xm` varchar(255) NULL,
          `sex` varchar(255) NULL,
          `bj` varchar(255) NULL,
          `yxmc` varchar(255) NULL,
          `zymc` varchar(255) NULL,
          PRIMARY KEY (`id`)
        );""".format(self.database_name, table_name)

        # 执行sql语句
        cursor.execute(sql)
        # 关闭指针对象
        cursor.close()
        print("创建 %s 表成功！" % table_name)

    def db_insert_batch_for_userInfo(self, table_name, data_list):
        """ 批量插入数据-用户基本信息

        :param table_name: 数据表名
        :param data_list: 批量数据
        :return:
        """
        # 获取操作游标
        cursor = self.db.cursor()

        # SQL 插入语句
        sql = """INSERT INTO {0}(xh,nj,xm,sex,bj,yxmc,zymc)
                 VALUES
                 (%s,%s,%s,%s,%s,%s,%s)""".format(table_name)
        try:
            # 执行sql语句
            result = cursor.executemany(sql, data_list)
            print('批量插入受影响的行数：', result)
            # 提交到数据库执行
            self.db.commit()
        except Exception as e:
            # 如果发生错误则回滚
            self.db.rollback()
            print('mysql.Error: ', e.args[0], e.args[1])

        # 关闭数据库连接
        # self.db.close()

    def db_select(self, sql):
        """ 查询信息

        :param sql: sql语句
        :return: 返回全部的结果
        """
        # 获取操作游标
        cursor = self.db.cursor()

        try:
            # 执行SQL语句
            cursor.execute(sql)
            # 获取所有记录列表
            result = cursor.fetchall()
            # 关闭数据库连接
            self.db.close()
            return result
        except Exception as e:
            print('mysql.Error: ', e.args[0], e.args[1])

    def db_close(self):
        """ 关闭数据库连接

        :return: 空
        """
        self.db.close()
        print("关闭连接成功！")
