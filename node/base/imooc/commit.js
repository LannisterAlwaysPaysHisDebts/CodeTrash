var http = require('http')
var querystring = require('querystring')

//post数据
var postData = querystring.stringify({
	'content': '老师讲的挺不错的, 赞一个!',
	'mid': 8837
})

//request 头
var option = {
	hostname: 'www.imooc.com',
	path: '/course/docomment',
	method: 'POST',
	header: {
		'POST': '/course/docomment HTTP/1.1',
		'Host': 'www.imooc.com',
		'Connection': 'keep-alive',
		'Content-Length': postData.length,
		'Pragma': 'no-cache',
		'Cache-Control': 'no-cache',
		'Accept': 'application/json, text/javascript, */*; q=0.01',
		'Origin': 'https://www.imooc.com',
		'X-Requested-With': 'XMLHttpRequest',
		'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36 QQBrowser/4.3.4986.400',
		'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
		'Referer': 'https://www.imooc.com/video/8837',
		'Accept-Encoding': 'gzip, deflate, br',
		'Accept-Language': 'en-US,en;q=0.8',
		'Cookie': 'imooc_uuid=1da2634a-1e7b-4fd2-9d2c-629cf4896136; imooc_isnew_ct=1522302005; loginstate=1; apsid=YxODgxYWI0ZTcyZWNjNTYxY2UzYTE5OGMxNGY5YzcAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAANDgyNjkxMgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAzMDcyOTg5MDBAcXEuY29tAAAAAAAAAAAAAAAAAAAAADRjOGU3MjY2NDA2NzMwNzhkZTY0YjZlOWYwZjI1NDg5YHy8WmB8vFo%3DNz; PHPSESSID=ked6jnmaq7su0mm3buteml2fv3; channel=491b6f5ab9637e8f6dffbbdd8806db9b_phpkecheng; IMCDNS=0; Hm_lvt_f0cfcccd7b1393990c78efdeebff3968=1523328347,1523434107,1523440046,1523863132; Hm_lpvt_f0cfcccd7b1393990c78efdeebff3968=1523863781; imooc_isnew=2; cvde=5ad44e5ad38a3-11'
	}
}

//发送请求
var req = http.request(option, function(res) {
	console.log('Status: ' + res.statusCode)
	console.log('Header: ' + JSON.stringify(res.headers))

	res.on('data', function(chunk) {
		console.log(Buffer.isBuffer(chunk))
		console.log(typeof chunk)
	})

	res.on('end', function() {
		console.log('success')
	})
})
req.on('error', function(e) {
		console.log('Error: ' + e.message)
	})

req.write(postData)

req.end()