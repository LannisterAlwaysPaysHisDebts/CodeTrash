import pymysql

db = pymysql.connect('localhost', 'root', 'root', 'testdb')

cursor = db.cursor()

sql = "INSERT INTO User(Name, Age, Gender) \
VALUES('%s', %d, '%s')" % \
('Mac', 20, 'Female')
 
try:
    cursor.execute(sql)
    db.commit()
except:
    db.rollback()

db.close()