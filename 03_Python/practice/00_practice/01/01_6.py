# -*- coding:UTF-8 -*-

### 让字典保持有序

# 需求: 比如考试系统, 要按照学生提交答案的时间来进行排序, 一般就是 d['Jim'] = (1, 23) 代表jim是第1个提交的, 耗时23秒
# 在获取这个字典的时候, 需要有序排列出来
# 使用collection 下的OrderedDict
# from collections import OrderedDict

b = {}
b['Jim'] = (1, 23)
b['Tom'] = (2, 33)
b['Bob'] = (3, 43)
for x in b:print(x)

d = OrderedDict()
d['Jim'] = (1, 23)
d['Tom'] = (1, 33)
d['Bob'] = (1, 43)
for x in d:
    print(x)



