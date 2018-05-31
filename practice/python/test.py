class test:
    def a(self):
        return '111'
    def finda(self):
        return self.a()

obj = test()
res = obj.finda()
print res