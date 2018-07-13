# -*- coding: UTF-8 -*-
# bs 创建对象, 以及bs 的四大对象用法

from bs4 import BeautifulSoup

# 爱丽丝梦游仙境
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

# 创建bs对象: 
soup = BeautifulSoup(html_doc, 'html.parser')

# 或者打开特定的html文件: soup = BeautifulSoup(open('index.html'))

# Tag
print(soup.a.attrs)


#