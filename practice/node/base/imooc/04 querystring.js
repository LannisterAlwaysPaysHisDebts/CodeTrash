//处理参数: 第二个参数 , 表示使用逗号分隔而不是用&, 第三个参数 : 表示用: 连接而不是用=
querystring.stringify({name:'Scott', course:['jade','node'],from:''},',', ':');
//返回字符串: 'name:Scott,course:jade,course:node,from:'


//解析参数: 第二个参数和第三个参数的作用同上面,
querystring.parse('name=Scott&course=jade&course=node&from=');
//返回参数对象: { name: 'Scott', course: [ 'jade', 'node' ], from: '' }

//转义和反转义
querystring.escape();
querystring.unescape();

