package main

import "fmt"


// 给定一个整数数组 nums 和一个目标值 target，请你在该数组中找出和为目标值的那 两个 整数，并返回他们的数组下标。

func main() {
	nums := []int{2, 7, 11, 15}
	target := 9
	theAnswer := twoSum(nums, target)
	fmt.Println(theAnswer)
}

func twoSum(nums []int, target int) []int {
	var answer []int
	for k, num := range nums {
		if answer == nil {
			for _k, _num := range nums {
				if k != _k && num + _num == target {
					answer = []int{k, _k}
					break
				}
			}
		}
	}
	return answer
}
