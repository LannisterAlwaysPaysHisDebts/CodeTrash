# -*- coding:UTF-8 -*-
### 2. 如何为元组中的元素命名来提高程序的可读性

student = ('Jim', 16, 'male', 'jim3215@gmail.com')

# 如果调用student 里的数据, 只能 student[0] 这样调用, 像0, 1, 2这样的数字没有意义可言
# 在c语言中, 可以 define Name 0 , 这样就能够 student[Name] 来拿到名字, 可读性要好很多
# 或者使用枚举类型 enum(Num, Age, Sex, Email)

# python来定义常量: 
# Name = 0
# Age = 1
# Sex = 2
# Mail = 3
# 或者
Name, Age, Sex, Mail = range(4)
print(student[Name])

# 或者使用namedtuple来替代内置的tuple
from collections import namedtuple

# 新建一个namedtuple
Student = namedtuple('Student', ['name', 'age', 'sex', 'mail'])
s_namedtuple = Student('Jim', 16, 'male', 'jim3215@gmail.com')

# 直接可以使用方法来访问变量, 
print(s_namedtuple)
print(s_namedtuple.name)

# 而且这个namedtuple 类型也是tuple
print(isinstance(s_namedtuple, tuple))