import pymongo

myclient = pymongo.MongoClient('mongodb://localhost:27017/')

# 创建数据库testdb
# mydb = myclient["testdb"]

# 判断数据库是否存在
# dblist = myclient.database_names()
# print(dblist)

