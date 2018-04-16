var http = require('http')
var cheerid = require('cheerio')

var url = 'http://www.w3school.com.cn/h.asp'

http.get(url, function(res) {
	var html = ''

	res.on('data', function(data) {
		html += data
	})

	res.on('end', function(argument) {
		console.log(html)
	})
}).on('error', function(argument) {
	console.log('error')
})