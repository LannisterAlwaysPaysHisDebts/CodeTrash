# -*- coding:UTF-8 -*-

### 实现可迭代对象和迭代器对象

# 可迭代对象: 比如字符串或者list
# list有iter方法可以转换成迭代器对象, 进行迭代
# str有getitem 可以转换成迭代器对象

l = ['a', 'b', 'c', 'd']
t = iter(l)
print(t)
print(t.__next__())
print(t.__next__())
print(t.__next__())
print(t.__next__())

# 以上流程相当于for循环迭代

# 需求: 自动抓取城市气温, 如果
