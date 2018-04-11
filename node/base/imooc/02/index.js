var klass = require('./klass');

// 直接打印
// klass.add('Scott', ['小红', '小明'])

//模块化输出
exports.add = function(klasses) {
	klasses.forEach(function(item, index) {
		var _klass = item
		var teacherName = item.teacherName
		var students = item.students

		klass.add(teacherName, students)
	})
}