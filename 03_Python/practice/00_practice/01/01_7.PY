# -*- coding:UTF-8 -*-

### 实现历史记录(最多N条)
# 使用collection 的 deque
from collections import deque

# 建立一个长度为5的队列
q = deque([], 3)

# 入队
q.append(1)
q.append(2)
q.append(3)
q.append(4)

print(q)

# 如果程序退出了, 需要将历史记录写入到文件中, 这里使用 pickle
import pickle

# 写入文件 这里打开的方式一定要用wb+ 因为对象存储的方式是bytes类型
pickle.dump(q, open('01_7', 'wb+'))

# 提取文件, 打开的方式一定要用rb , 原因同上
q_load = pickle.load(open('01_7', 'rb+'))
print(q_load)
