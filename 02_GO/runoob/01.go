package main

import (
	"fmt"
	"strings"
)

//值得注意的点： 3.4.6.7.
func main() {
	// 6.
	//result := strPlusInt("曹", 18)
	//fmt.Println(result)

	// 7. 闭包
	//nextNumber := getSequence()
	//fmt.Println(nextNumber())
	//fmt.Println(nextNumber())
	//fmt.Println(nextNumber())
	//nextNumber1 := getSequence()
	//fmt.Println(nextNumber1())
	//fmt.Println(nextNumber1())

	// 8. 方法
	//var c1 Circle
	//c1.radius = 10.00
	//fmt.Println("圆的面积 = ", c1.getArea())

	// 9. 初始化二维数组
	//a = [3][4]int{
	//	{0, 1, 2, 3},
	//	{4, 5, 6, 7},
	//	{8, 9, 10, 11}}

	// 10. Range
	//Range()

	// 11. Map
	//Map()

	// 12. interface
	//usePhone()
}

// 12. interface 接口
type Phone interface {
	call()
}

type Nokia struct {

}

func (nokia Nokia) call() {
	fmt.Println("My phone is nokia, I'm calling you!")
}

type IPhone struct {

}

func (iphone IPhone) call() {
	fmt.Println("My phone is iphone xr, I'm calling you!")
}

func usePhone() {
	var phone Phone
	phone = new(Nokia)
	phone.call()

	phone = new(IPhone)
	phone.call()
}

// 11. map 键值对
func Map() {
	// 两种初始化的方式， 先申明一个map 此时map是 nil(相当于对象类型的NULL),然后使用make初始化
	//var countryCapitalMap map[string]string
	//countryCapitalMap = make(map[string]string)

	// 或者直接make
	countryCapitalMap := make(map[string]string)

	countryCapitalMap["France"] = "巴黎"
	countryCapitalMap["Italy"] = "罗马"
	countryCapitalMap["Japan"] = "东京"
	countryCapitalMap["India"] = "新德里"

	// 使用delete删除
	//delete(countryCapitalMap, "India")

	// ps. 这里需要注意： 两个for循环的 country 值是不一样的， 第一个是value, 第二个是key
	for i, country := range countryCapitalMap {
		fmt.Println(i, "首都是", country)
	}
	//for country := range countryCapitalMap {
	//	fmt.Println(country, "首都是", countryCapitalMap[country])
	//}

	// 判断是否存在
	capital, ok := countryCapitalMap [ "American" ]
	if ok {
		fmt.Println("American首都是", capital)
	} else {
		fmt.Println("American首都不存在")
	}
}

// 10. Range
func Range() {
	// 迭代整型数组， 获得累加值
	nums := []int{2, 3, 4}
	sum := 0
	for _, num := range nums {
		sum += num
	}
	fmt.Println("sum:", sum)

	// 在数组上使用range将传入index和值两个变量。上面那个例子我们不需要使用该元素的序号，所以我们使用空白符"_"省略了。有时侯我们确实需要知道它的索引。
	for i, num := range nums {
		if num == 3 {
			fmt.Println("index:", i)
		}
	}

	//range也可以用在map的键值对上。
	kvs := map[string]string{"a": "apple", "b": "banana"}
	for k, v := range kvs {
		fmt.Printf("%s -> %s\n", k, v)
	}

	//range也可以用来枚举Unicode字符串。第一个参数是字符的索引，第二个是字符（Unicode的值）本身。
	for i, c := range "go" {
		fmt.Println(i, c)
	}
}

// 8. 方法, go里面方法是依赖于结构体的函数
type Circle struct {
	radius float64
}

func (c Circle) getArea() float64 {
	return 3.14 * c.radius * c.radius
}

// 7. 闭包
func getSequence() func() int {
	i := 0
	return func() int {
		i += 1
		return i
	}
}

// 6. 使用 stings.Join 拼接字符串数组， 注意这里的age 是int 类型的，需要强转类型
func strPlusInt(name string, age int) string {
	result := []string{"Name: ", name, " \nAge: ", string(age)}
	return strings.Join(result, "")
}

// 5. 函数定义
func max(num1, num2 int) int {
	if num1 > num2 {
		return num1
	}
	return num2
}

// 4. 熟悉这个<<的原理：
const (
	j = 1 << iota
	k = 3 << iota
	l
	n
)

func test02() {
	// 3. iota 在每次const 出现时重置为 0, const 中每增加一次声明, iota计数增一
	const (
		a = iota
		b
		c
		d = "ha"
		e
		f = 100
		g
		h = iota
		i
	)
	fmt.Println(a, b, c, d, e, f, g, h, i)

	fmt.Println(j, k, l, n)
}

func test01() {
	// 1. 定义变量
	var a string = "Runoob"
	fmt.Println(a)

	// 或者使用 :=
	b, c := 1, 2
	fmt.Println(b, c)

	// 2. 定义常量
	const LENGTH int = 10
	const WIDTH int = 20
}
