package main

import (
	"errors"
	"fmt"
	"time"
)

// 链表
// 这里Append的时间复杂度为 O(n) 例子05.go 将其优化到 O(1)

type Post struct {
	body        string
	publishDate int64
	next        *Post
}

type Feed struct {
	length int
	start  *Post
}

func (f *Feed) Append(newPost *Post) {
	if f.length == 0 {
		f.start = newPost
	} else {
		currentPost := f.start
		for currentPost.next != nil {
			currentPost = currentPost.next
		}
		currentPost.next = newPost
	}
	f.length++
}

// bug: 删除表头
func (f *Feed) Remove(publishDate int64) () {
	if f.length == 0 {
		panic(errors.New("Feed Is Empty."))
	}

	var previousPost *Post
	currentPost := f.start

	for currentPost.publishDate != publishDate {
		if currentPost.next == nil {
			panic(errors.New("No such Post found."))
		}

		previousPost = currentPost
		currentPost = currentPost.next
	}
	previousPost.next = currentPost.next

	f.length--
}

func (f *Feed) Insert(newPost *Post) {
	if f.length == 0 {
		f.start = newPost
	} else {
		var previousPost *Post
		currentPost := f.start

		for currentPost.publishDate < newPost.publishDate {
			previousPost = currentPost
			currentPost = previousPost.next
		}

		previousPost.next = newPost
		newPost.next = currentPost
	}
	f.length++
}

func main() {
	f := &Feed{}

	// 获取时间戳的方法： time.Now().Unix()
	// 获取当前日期 time.Unix(now, 0).Format("2006-01-02 15:04:05")
	now := time.Now().Unix()
	date := time.Unix(now, 0).Format("2006-01-02 15:04:05")
	fmt.Println(date)

	p1 := Post{
		body:        "It is a body",
		publishDate: time.Now().Unix(),
	}
	f.Append(&p1)

	fmt.Printf("Length： %v\n", f.length)
	fmt.Printf("First: %v\n", f.start)

	p2 := Post{
		body:        "Dolor sit amet",
		publishDate: time.Now().Unix(),
	}
	f.Append(&p2)

	fmt.Printf("Length： %v\n", f.length)
	fmt.Printf("First: %v\n", f.start)
	fmt.Printf("Second: %v\n", f.start.next)
}
