package main

import (
	"fmt"
	"strings"
)

func main(){
	str := "abc"
	strArr := strings.SplitAfter(str, "")
	fmt.Println(strArr)
}


