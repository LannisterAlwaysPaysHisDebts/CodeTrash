# -*- coding: UTF-8 -*-
# bs的一些基本用法
from bs4 import BeautifulSoup
import re
import sys

html_doc = """
<html><head><title>The Dormouse's story</title></head>
<body>
<p class="title"><b>The Dormouse's story</b></p>

<p class="story">Once upon a time there were three little sisters; and their names were
<a href="http://example.com/elsie" class="sister" id="link1">Elsie</a>,
<a href="http://example.com/lacie" class="sister" id="link2">Lacie</a> and
<a href="http://example.com/tillie" class="sister" id="link3">Tillie</a>;
and they lived at the bottom of a well.</p>

<p class="story">...</p>
"""

# 创建bs对象
soup = BeautifulSoup(
    html_doc,
    'html.parser',  #使用的解释器
    #from_encoding='utf-8'
)

# 找到所有的a标签
links = soup.find_all('a')
for L in links:
    print(L)

# 找到 href为xx的a标签
findNode = soup.find('a', href="http://example.com/lacie")
print(findNode)

# 找到
linkNode = soup.find('a', href=re.compile(r"ill"))
print(linkNode)

# 找到class为 title 的p标签
pNode = soup.find('p', class_="title")
print(pNode)

