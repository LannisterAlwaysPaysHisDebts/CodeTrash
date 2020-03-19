package main

// http://c.biancheng.net/view/4359.html 示例1

import (
	"fmt"
	"math/rand"
	"sync"
	"time"
)

var wg sync.WaitGroup

func init() {
	rand.Seed(time.Now().Unix())
}

func main() {
	court := make(chan int)

	wg.Add(2)

	go Player("CaoTing", court)
	go Player("PiDan", court)

	court <- 1

	wg.Wait()
}

func Player(name string, court chan int) {
	defer wg.Done()
	for {
		ball, ok := <-court
		if !ok {
			fmt.Printf("Player %s Won \n", name)
			return
		}

		n := rand.Intn(100)
		if n%13 == 0 {
			fmt.Printf("Player %s Missed\n", name)

			close(court)
			return
		}

		fmt.Printf("Player %s Hit %d\n", name, ball)
		ball++
		time.Sleep(time.Second / 2)

		court <- ball
	}
}
