package main

import "fmt"

type DivideError struct {
	devidee int
	devider int
}

// 实现Error接口
func (de *DivideError) Error() string {
	strFormat := `
	Cannot proceed, the divider is zero.
    dividee: %d
    divider: 0
`
	return fmt.Sprintf(strFormat, de.devidee)
}

func Devide(varDevideE int, varDevideR int) (result int, errorMsg string) {
	if varDevideR == 0 {
		dData := DivideError{
			devidee: varDevideE,
			devider: varDevideR,
		}
		errorMsg = dData.Error()
		return 0, errorMsg
	} else {
		return varDevideE / varDevideR, ""
	}
}

func main() {
	if result, errorMsg := Devide(100, 10); errorMsg == "" {
		fmt.Println("100 / 10 = ", result)
	}
	if _, errorMsg := Devide(100, 0); errorMsg != "" {
		fmt.Println("error Msg is ", errorMsg)
	}
}
