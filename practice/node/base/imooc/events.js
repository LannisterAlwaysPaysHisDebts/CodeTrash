var EventEmitter = require('events').EventEmitter

var life = new EventEmitter()

life.setMaxListeners(11)

function kill(who){
	console.log(who + ' kill mouse')
}

life.on('catch', function(who) {
	console.log(who + ' catch mouse')
})

life.on('catch', function(who) {
	console.log(who + ' beat mouse')
})

life.on('catch', function(who) {
	console.log(who + ' push mouse')
})

life.on('catch', kill)

//移除掉所有的监听事件: 不传递参数会移除所有的监听函数
life.removeAllListeners('catch')

//使用removeListener移除掉kill的监听
life.removeListener('catch', kill)

life.emit('catch', 'smlz')

//打印 catch有多少个监听事件
console.log(life.listeners('catch').length);

//有多少个监听事件的另外一种获取方法
console.log(EventEmitter.listenerCount(life,'catch'));

