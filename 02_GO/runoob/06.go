package main

import (
	"fmt"
	"math"
	"math/cmplx"
)

// 实现欧拉公式
func euler() {
	fmt.Println(
		cmplx.Pow(math.E, 1i*math.Pi) + 1,
		cmplx.Exp(1i*math.Pi) + 1,
	)
}

// 强制类型转换


func main() {
	euler()
}
