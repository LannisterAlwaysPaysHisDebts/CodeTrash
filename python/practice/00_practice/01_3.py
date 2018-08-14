# -*- coding:UTF-8 -*-
### 3. 统计序列中元素出现的频度

from random import randint
from collections import Counter

# 情况1, 30个随机0到20的数值, 从中筛选出出现频率最高的, 使用字典来展示, 比如 {2:5, 3:3, 1:1}
data = [randint(0, 20) for _ in range(30)]
print(data)

# 先生成字典, key使用data里的数据, value先默认填0
c = dict.fromkeys(data, 0)
for x in data:
    c[x] += 1

# 获取到出现频率的前3名
# 使用Counter 此时可以使用counter下的方法most_common
c2 = Counter(data)
print(c2.most_common(3))


# 情况2, 一个txt文件, 统计里面的词频:
import re

txt = open('./python/practice/00_practice/01_3.txt').read()

txt_counter = Counter(re.split('\W+', txt))
print(txt_counter.most_common(10))
