package main

// http://c.biancheng.net/view/4359.html 示例2

import (
	"fmt"
	"sync"
	"time"
)

var wg sync.WaitGroup

func main() {
	baton := make(chan int)

	wg.Add(1)
	
	go Runner(baton)

	baton <- 1

	wg.Wait()
}

func Runner(baton chan int)  {
	var newRunner int

	runner := <- baton

	fmt.Printf("第%d位选手 拿到接力棒, 跑了起来\n", runner)

	if runner != 4 {
		newRunner = runner + 1
		fmt.Printf("第%d位选手在交接线这里等待\n", newRunner)
		go Runner(baton)
	}

	time.Sleep(5 * time.Second)

	if runner == 4 {
		fmt.Printf("第%d位选手跑过了终点!!!\n", runner)
		wg.Done()
		return
	}

	fmt.Printf("第%d位选手把接力棒交给了%d位选手\n", runner, newRunner)
	baton <- newRunner
}