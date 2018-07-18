import pymysql

# 连接mysql,分别为: 地址, 账号, 密码, 表
db = pymysql.connect('localhost', 'root', 'root', 'weiliu_wechat_app_link')

cursor = db.cursor()

cursor.execute("SELECT VERSION()")

data = cursor.fetchone()

print("Database version: %s" % data)

db.close()
