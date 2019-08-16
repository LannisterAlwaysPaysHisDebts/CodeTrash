# -*- coding:UTF-8 -*-

### 如何快速找到多个字典中的公共键
from random import randint, sample
from functools import reduce

# 每一场球赛算一个字典, 字典组成是 key: 进球球员名字 value: 进球个数
# 求出每一场都进球的球员名单

# 产生随机进球的球员
s1 = {x:randint(1, 4) for x in sample('abcdefg', randint(3, 6))}
s2 = {x:randint(1, 4) for x in sample('abcdefg', randint(3, 6))}
s3 = {x:randint(1, 4) for x in sample('abcdefg', randint(3, 6))}
s4 = {x:randint(1, 4) for x in sample('abcdefg', randint(3, 6))}

print(s1, s2, s3, s4)

# 方法1: 直接使用交集
print(s1.keys() & s2.keys() & s3.keys())

# 方法2: map函数
print(reduce(lambda a, b: a & b, map(dict.keys, [s1, s2, s3])))