# -*- coding: UTF-8 -*-
# 正则表达式的练习

import re

res = re.match(r'^\d{3}\-\d{3,8}$', '010-12345')
print(res)