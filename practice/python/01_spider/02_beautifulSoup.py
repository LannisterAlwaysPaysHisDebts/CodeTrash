# -*- coding: UTF-8 -*-
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

soup = BeautifulSoup(
    html_doc,
    'html.parser',  #使用的解释器
    #from_encoding='utf-8'
)

links = soup.find_all('a')
for L in links:
    print(L)

findNode = soup.find('a', href="http://example.com/lacie")
print(findNode)

linkNode = soup.find('a', href=re.compile(r"ill"))
print(linkNode)

pNode = soup.find('p', class_="title")
print(pNode)

print('🐐🦍🦍🦍🦍')
sys.exit()