package main

import (
	"fmt"
	"strconv"
	"strings"
)

// https://leetcode-cn.com/problems/add-two-numbers/


//先实现链表
//再实现加法

type ListNode struct {
	Val int
	Next *ListNode
}

func buildList(list []int) *ListNode {
	l := ListNode{}
	for _, num := range list {
		if l.Val == 0 && l.Next == nil {
			l.Val = num
		} else {
			before := ListNode{Val:l.Val, Next:l.Next}
			l.Val = num
			l.Next = &before
		}
	}
	return &l
}

func getAnswer(list *ListNode) {
	fmt.Println(list)
}

func main() {
	list1 := buildList([]int{1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2})
	list2 := buildList([]int{4, 6, 5})
	answer := addTwoNumbers(list1, list2)
	getAnswer(answer)
}

func addTwoNumbers(l1 *ListNode, l2 *ListNode) *ListNode {
	var str1 string
	for l1.Next != nil {
		str1 = fmt.Sprintf("%d", l1.Val) + str1
		l1.Val = l1.Next.Val
		l1.Next = l1.Next.Next
	}
	str1 = fmt.Sprintf("%d", l1.Val) + str1

	var str2 string
	for l2.Next != nil {
		str2 = fmt.Sprintf("%d", l2.Val) + str2
		l2.Val = l2.Next.Val
		l2.Next = l2.Next.Next
	}
	str2 = fmt.Sprintf("%d", l2.Val) + str2
	
	num1, _ := strconv.Atoi(str1)
	num2, _ := strconv.Atoi(str2)

	sum := num1 + num2

	l := ListNode{}
	list := strings.SplitAfter(strconv.Itoa(sum), "")
	for _, num := range list {
		if l.Val == 0 && l.Next == nil {
			l.Val, _ = strconv.Atoi(num)
		} else {
			before := ListNode{Val:l.Val, Next:l.Next}
			l.Val, _ = strconv.Atoi(num)
			l.Next = &before
		}
	}

	return &l
}