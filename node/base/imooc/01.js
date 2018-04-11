//启动一个web服务器
const http = require('http');

const hostname = '127.0.0.1';
const port = 3000;

//服务器的回调函数, 
//req请求体, 来获取这次请求的相关信息, 
//res响应体, 服务端的响应内容, 不然服务器一直都是挂起的状态
const server = http.createServer((req, res) => {
	//这三项分别代表: 返回的状态码是200, 返回的头是xxx, 并向请求端发送hello world
    res.statusCode = 200;
	res.setHeader('Content-Type', 'text/plain');
	res.end('Hello World\n');
});

//从3000端口 监听请求
server.listen(port, hostname, () => {
    console.log(`Server running at http://${hostname}:${port}/`);
});