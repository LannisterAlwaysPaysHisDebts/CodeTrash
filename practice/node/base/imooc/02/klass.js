var student = require('./student');
var teacher = require('./teacher');

function add(teacherName, students) {
	teacher.addTeacher(teacherName);

	students.forEach(function(item, index) {
		student.addStudent(item)
	})
}

//如果你的模块想成为一个特殊的对象类型, 使用module.exports
//如果模块仅作为一个传统的对象实例, 使用 exports
exports.addMan = add
//module.exports = add