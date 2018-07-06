import socket
import sys

serverSocket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

# 这里的 hostname 在 mac中 拿到的是 caotingdeMacBook-Pro.local , 需要在hosts中添加 127.0.0.1 caotingdeMacBook-Pro.local 
host = socket.gethostname()

port = 9999

serverSocket.bind(((host, port)))

serverSocket.listen(5)

while True:
    clientSocket,addr = serverSocket.accept()

    print("连接地址: %s" % str(addr))

    msg='欢迎来到英雄联盟' + "\r\n"
    clientSocket.send(msg.encode('utf-8'))
    clientSocket.close()
