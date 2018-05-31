// Pet作为对象, 内置方法speak, 此时this指向的是Pet这个对象
var Pet = {
	Words:'...',
	speak: function() {
		console.log(this.Words)
		console.log(this === Pet)
	}
};

Pet.speak();


// Petfunc作为函数, 此时this指向的是全局global
function Petfunc(words) {
	this.words = words;
	console.log(this.words)
	console.log(this === global)
}

Petfunc('...');

//使用call让对象Dog继承了Pet的speak方法
var PetBase = {
	words: '...',
	speak: function(words) {
		console.log('Speak ' + words);
	}
};

var Dog = {
	words: 'wangwang',
};

PetBase.speak(PetBase.words);
PetBase.speak.call(Dog, Dog.words);

