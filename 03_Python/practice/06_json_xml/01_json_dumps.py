import json

data = {
    'no': 1,
    'name': 'Runoob',
    'url': 'http://www.runoob.com'
}

json_str = json.dumps(data)

print('Python原始数据: ', repr(data))
print('JSON对象: ', json_str)

data2 = json.loads(json_str)
print("data2['name']", data2['name'])
print("data2['url']", data2['url'])