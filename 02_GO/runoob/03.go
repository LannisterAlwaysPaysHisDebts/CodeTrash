package main

import (
	"fmt"
	"time"
)

func main() {
	// 1. go
	//letGo()

	// 2. 通道chan
	//getSumByChan()

	// 3. 通道的缓存
	//chanCache()

	// 4. 遍历通道, 关闭通道
	controlChan()
}

// 4.
// range 函数遍历每个从通道接收到的数据，因为 c 在发送完 10 个
// 数据之后就关闭了通道，所以这里我们 range 函数在接收到 10 个数据
// 之后就结束了。如果上面的 c 通道不关闭，那么 range 函数就不
// 会结束，从而在接收第 11 个数据的时候就阻塞了。
func controlChan() {
	c := make(chan int, 10)
	go fibonacci(cap(c), c)
	for i := range c {
		fmt.Println(i)
	}
}

func fibonacci(n int, c chan int) {
	x, y := 0, 1
	for i := 0; i < n; i++ {
		c <- x
		x, y = y, x+y
	}
}

// 3.make初始化通道时，第二个值代表缓冲区大小
func chanCache() {
	ch := make(chan int, 100)

	ch <- 1
	ch <- 2

	fmt.Println(<-ch)
	fmt.Println(<-ch)
}

// 2. 通道可用于两个 goroutine 之间通过传递一个指定类型的值来同步运行和通讯。操作符 <- 用于指定通道的方向，发送或接收。如果未指定方向，则为双向通道。
func getSumByChan() {
	s := []int{7, 2, 8, -9, 4, 0}

	c := make(chan int)
	go sum(s[:len(s)/2], c)
	go sum(s[len(s)/2:], c)

	x, y := <-c, <-c
	fmt.Println(x, y, x+y)
}

func sum(s []int, c chan int) {
	sum := 0
	for _, v := range s {
		sum += v
	}
	c <- sum
}

// 1. 使用 go 来开启goroutine, goroutine 是轻量级线程
func letGo() {
	go say("world")
	say("hello")
}

func say(s string) {
	for i := 0; i < 5; i++ {
		time.Sleep(100 * time.Millisecond)
		fmt.Println(s)
	}
}
