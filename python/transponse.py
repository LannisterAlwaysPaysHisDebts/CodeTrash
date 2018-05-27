# -*- coding: utf-8 -*-
#题目: 输入一个矩阵, 输出它的转置矩阵, 否则输出impoosible
class PythonExam_201805:
    def p1_transpose(self,srcStr):
        if not(isinstance(srcStr, str)):
            return 'impossible'
        p2 = []
        p3 = []
        p1 = srcStr.split(';')
        for L in p1:
            l = L.split(',')
            p2.append(l) 
        p2 = zip(*p2)
        for L in p2:
            p3.append(','.join(L))
        return ';'.join(p3)  

a = 'a,b;c'
obj = PythonExam_201805()
res = obj.p1_transpose(a)
print res