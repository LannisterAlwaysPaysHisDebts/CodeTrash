import pymysql

db = pymysql.connect('localhost', 'root', 'root', 'testdb')

cursor = db.cursor()

sql = "SELECT * FROM User"

try:
    cursor.execute(sql)
    results = cursor.fetchall()
    print(results)

except:
    print('Error')

db.close()