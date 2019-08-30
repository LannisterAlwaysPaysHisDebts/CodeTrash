package main

// 带 尾节点指针的 链表

type BetterFeed struct {
	length int
	start  *Post
	end    *Post
}

func (f *BetterFeed) Append(newPost *Post) {
	if f.length == 0 {
		f.start = newPost
		f.end = newPost
	} else {
		lastPost := f.end
		lastPost.next = newPost
		f.end = newPost
	}
	f.length++
}


