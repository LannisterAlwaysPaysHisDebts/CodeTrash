var http = require('http')
var cheerio = require('cheerio')

//拉取页面
var url = 'http://www.runoob.com/nodejs/nodejs-event-loop.html';

function filterChapters(html) {
	var $ = cheerio.load(html)
	var chapters = $('.article-intro')

	var returnData = []

	chapters.each(function(item) {
		var chapters = $(this)
		var chaptersTitle = chapters.find('h1').text()
		var chaptersContent = chapters.find('p').text()

		var data = {
			chaptersTitle: chaptersTitle,
			chaptersContent:chaptersContent
		}

		returnData.push(data)
	})
	return returnData
}

// function printData(data) {
	
// }

http.get(url, function(res) {
	var html = ''

	res.on('data', function(data) {
		html += data
	})

	res.on('end', function() {
		var data = filterChapters(html)

		console.log(data)
	})
}).on('error', function() {
	console.log('error')
})