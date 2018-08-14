# -*- coding:UTF-8 -*-

### 4. 根据字典中值的大小, 对字典中的项进行排序

# 需求: 字段: {'Jim': 80, 'Lily': 90, ....} 人名+ 分数
# 根据成绩高低, 计算学生排名

from random import randint

d = {x:randint(60, 100) for x in 'xyzabc'}
print(d)

# 使用内置函数sorted 但是sorted直接排列字典是按照key来排列的
# 使用zip 将value 和key反过来打包, 再用sorter排列
d_sorted = sorted(zip(d.values(), d.keys()))
print(d_sorted)

# 方法2
# 这里的key   d.items() 会将字典转换成元组, 而排列元组中每一项时会有索引值0, 1 等等, 可以使用匿名函数来返回其中的一项
d_sorted_2 = sorted(d.items(), key=lambda x: x[1])
print(d_sorted_2)


