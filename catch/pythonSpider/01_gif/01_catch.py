# -*- coding: UTF-8 -*-
import urllib.request
from bs4 import BeautifulSoup

url = 'http://hnbang.com/view/26697.html'

response1 = urllib.request.urlopen(url)
html = response1.read()

soup = BeautifulSoup(
    html,
    'html.parser'
)

p = soup.select('.article-content p')

data = {}
title = []
href = []
for L in p:
    if L.string != None:
        title.append(L.string)
    else:
        print(L.contents.select('src'))

