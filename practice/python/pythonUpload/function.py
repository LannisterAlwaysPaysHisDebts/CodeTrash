# -*- coding:utf8 -*-
#传递的参数也可以是函数
# def add(a, b, f):
#     return f(a) + f(b)
# res = add(-5, 9, abs)
# print res

#map()
# def format_name(s):
#     return s[0].upper() + s[1:].lower()
# print map(format_name, ['adam', 'LIAS', 'barT'])

#reduce()
# def prod(x, y):
#     return x * y;
# res = reduce(prod, [1, 2, 3, 4, 5, 6])
# print res

#请利用filter()过滤出1~100中平方根是整数的数
# import math
# def is_sqr(a):
#     x = int(math.sqrt(a))
#     return x * x == a
# res = filter(is_sqr, range(1,101))
# print res

#请利用sorted()高阶函数，实现忽略大小写排序的算法。
#输入：['bob', 'about', 'Zoo', 'Credit']
#输出：['about', 'bob', 'Credit', 'Zoo']
# def sortStr(x, y):
#     newX = x.lower()
#     newY = y.lower()
#     if newX < newY:
#         return -1
#     elif newX > newY:
#         return 1
#     return 0
# a = ['bob', 'about', 'Zoo', 'Credit']
# res = sorted(a, sortStr)
# print res

#返回函数
# def f():
#     print 'call f()...'
#     def g():
#         print 'call g()...'
#     return g
# x = f()
# x()

#返回函数2
# def myabs():
#     return abs
# def myabs2(x):
#     return abs(x)
# x = myabs()
# print x(-1)
# y = myabs2(-1)
# print y

#返回函数3
# def calc_sum(lst):
#     def lazy_sum():
#         return sum(lst)
#     return lazy_sum
# x = (1, 2, 3)
# y = calc_sum(x)
# print y()

#请编写一个函数calc_prod(lst)，它接收一个list，返回一个函数，返回函数可以计算参数的乘积。
# def calc_prod(lst):
#     def lazy_prod():
#         def f(x, y):
#             return x * y
#         return reduce(f, lst, 1)
#     return lazy_prod

# f = calc_prod([1, 2, 3, 4])
# print f()

#闭包
# def count():
#     fs = []
#     for i in range(1, 4):
#         def f():
#             return i*i
#         fs.append(f)
#     return fs
# f1 = count()
# print f1

#返回闭包不能引用循环变量，请改写count()函数，让它正确返回能计算1x1、2x2、3x3的函数。
# def count():
#     fs = []
#     for i in range(1, 4):
#         def g(l):
#             x = l
#             def f():
#                 return x * x
#             return f
#         fs.append(g(i))
#     return fs
# f1, f2, f3 = count()
# print f1()
# print f2()
# print f3()

#匿名函数
# def g(x):
#     return x * x

# print map(g, range(1, 11))
# print map(lambda x: x * x, range(1, 11))

#匿名函数简化代码
# def is_not_empty(s):
#     return s and len(s.strip()) > 0
# print filter(is_not_empty, ['test', None, '', 'str', '  ', 'END'])

# print filter(lambda x: x and len(x.strip()) > 0 , ['test', None, '', 'str', '  ', 'END'])


#装饰器
# def f1(x):
#     return x*2
# def new_fn(f):
#     def fn(x):
#         print "call " + f.__name__ + '()'
#         return f(x)
#     return fn

# f1 = new_fn(f1)
# print f1(5)

# def new_fn(f):
#     def fn(x):
#         print "call " + f.__name__ + '()'
#         return f(x)
#     return fn

# @new_fn
# def f1(x):
#     return x*2

# print f1(5)

#请编写一个@performance，它可以打印出函数调用的时间。
# import time
# def performace(f):
#     def fn(*args, **kw):
#         first_time = time.time()
#         r = f(*args, **kw)
#         second_time = time.time()
#         print 'call %s() in %fs' % (f.__name__, (second_time - first_time))
#         return r
#     return fn

# @performace
# def f1(x):
#     return x*2
# print f1(5)

#带参数的装饰器
# def log(prefix):
#     def log_decorator(f):
#         def wrapper(*args, **kw):
#             print '[%s]%s()...' % (prefix, f.__name__)
#             return f(*args, **kw)
#         return wrapper
#     return log_decorator

# @log('AAA')
# def l(x):
#     return x*2
# print l(5)

#上一节的@performance只能打印秒，请给 @performace 增加一个参数，允许传入's'或'ms'：
# import time
# import functools
# def performace(prefix):
#     def performace_decorator(f):
#         @functools.wraps(f)
#         def fn(*args, **kw):
#             first_time = time.time()
#             r = f(*args, **kw)
#             second_time = time.time()
#             if prefix == 's':
#                 print 'call %s() in %fs' % (f.__name__, (second_time - first_time))
#             elif prefix == 'ms':
#                 print 'call %s() in %fms' % (f.__name__, (second_time - first_time) * 1000)
#             else:
#                 print 'Invalid Argument!'
#             return r
#         return fn
#     return performace_decorator

# @performace('s')
# def f1(x):
#     return x*2
# print f1.__name__

#偏函数
# import functools
# sorted_ignore_case = functools.partial(sorted, cmp=lambda s1, s2: cmp(s1.upper(), s2.upper()))
# print sorted_ignore_case(['bob', 'about', 'Zoo', 'Credit'])


# import types
# def fn_get_grade(self):
#     if self.score >= 80:
#         return 'A'
#     if self.score >= 60:
#         return 'B'
#     return 'C'

# class Person(object):
#     def __init__(self, name, score):
#         self.name = name
#         self.score = score

# p1 = Person('Bob', 90)
# p1.get_grade = types.MethodType(fn_get_grade, p1)
# print(p1.get_grade())


#类方法
# class Person(object):
#     __count = 0
#     @classmethod
#     def how_many(cls):
#         return cls.__count
#     def __init__(self, name):
#         self.name = name
#         Person.count = Person.count + 1

# print(Person.how_many)
# p1 = Person('Bob')
# print(p1.how_many)

#
# class Person(object):
#     sex = 'female'
#     def getInfo(self):
#         return self.sex
#     @classmethod
#     def getDetail(cls):
#         return cls.sex

# p = Person()
# p.sex = 'ggg'
# a = p.getInfo()
# b = p.getDetail()

#类的继承
class Person(object):
    def __init__(self, name, gender):
        self.name = name
        self.gender = gender

class Student(Person):
    def __init__(self, name, gender, score):
        super(Student, self).__init__(name, gender)
        self.score = score

