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

