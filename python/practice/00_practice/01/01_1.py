# -*- coding:UTF-8 -*-

### 1. 如何在列表, 字典, 集合中根据条件筛选数据
from random import randint

### 先随机生成列表
# 注意, py2.x 使用 xrange()  py3 使用range()
# range(stop) 或者 range(start, stop [, step])
# 这里的 _ 下划线 代表 我们不关心的变量, 相当于一个垃圾桶
data = [randint(-10, 10) for _ in range(10)]
print(data)

# 过滤数据, 方法1: filter
# filter在py2 和py3中有一点不同, 在py2中返回的是过滤后的列表, 
# 在py3中返回的是一个filter类,可以看成是一个迭代器,其中有__iter__ 和 __next__ 方法, 
data_filter = filter(lambda x: x>=0, data)
print(list(data_filter))

# 方法2: 列表解析
data_parse = [x for x in data if x >= 0]
print(data_parse)

# 可以使用timeit进行性能测试 (未实现)
# 测试下来列表解析比filter要快一倍, 列表解析和filter都远快于for迭代输出


###  字典中筛选
# 随机生成, 60到100分的学生1-21 要求过滤掉低于90分的
d = {x:randint(60, 100) for x in range(1, 21)}
print(d)

# 方法: 迭代
# py2 中使用iteritems() py3中使用items
d_iter = {k:v for k, v in d.items() if v > 90}
print(d_iter)

### 集合筛选
s = set(data)
print(s)

# 求出能整除3的
s_set = {x for x in s if x % 3 == 0}
print(s_set)
