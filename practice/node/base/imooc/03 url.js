//Node 的URl解析, 
//参数1, 默认false 将query解析成字符串, 为true时将query解析成对象
//参数2, 默认false, 不能解析不是http或者https开头的url, 为true时可以解析
url.parse('http://baidu.com', '参数1', '参数2');

//合并参数
url.resolve('http://baidu.com/', '/baike');

//反解析 URL对象 (parse的反向操作)
url.format();
