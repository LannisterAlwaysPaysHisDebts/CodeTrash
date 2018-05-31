# -*- coding: utf8 -*-
# 题目: 编写一个方法,参数为year,month,day 输出这是第几天
class PythonExam_201805:
    day_list_1 = [31,28,31,30,31,30,31,31,30,31,30,31]
    day_list_2 = [31,29,31,30,31,30,31,31,30,31,30,31]

    def p2_countDate(self,year,month,day):
        try:
            if not(self.isNum(year) and self.isNum(month) and self.isNum(day)):
                return -1
            if self.checkYear(year):
                day_list = self.day_list_2
            else:
                day_list = self.day_list_1
            
            check_day = day_list[month-1]
            if day > check_day:
                return -1

            days = day
            for i in range(0, month-1):
                days+=day_list[i]
            return days
        except:
            return -1
        
    def isNum(self,v):
        try:
            a = int(v)
            if a<=0:
                return False
            return True
        except:
            return False
    
    def checkYear(self,year):
        if (year % 4 == 0 and year % 100 != 0) or (year % 400 == 0):
            return True
        return False
            
obj = PythonExam_201805()
res = obj.p2_countDate(2020,2,29)
print res
