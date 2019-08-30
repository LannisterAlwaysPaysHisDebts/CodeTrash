package main

import "fmt"

// 给定一个包含 n 个整数的数组 nums，判断 nums 中是否存在三个元素 a，b，c ，使得 a + b + c = 0 ？找出所有满足条件且不重复的三元组。

func main() {
	nums := []int{-1, 0, 1, 2, -1, -4}
	answer := threeSum(nums)
	fmt.Println(answer)
}

func threeSum(nums []int) [][]int {
	var answer [][]int
	for k1, num1 := range nums {
		for k2, num2 := range nums {
			for k3, num3 := range nums {
				if k1 != k2 && k1 != k3 && k2 != k3 && (num1 + num2 + num3) == 0  {
					for _, list := range answer {
						answer = append(answer, []int{num1, num2, num3})
					}
				}
			}
		}
	}
	return answer
}
