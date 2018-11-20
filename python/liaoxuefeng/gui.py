from tkinter import *
# import tkinter.messagebox as messagebox

class Application(Frame):
    def __init__(self, master=None):
        Frame.__init__(self, master)
        self.pack()
        self.createWidgets()

    def createWidgets(self):
        self.helloLabe1 = Label(self, text='Hello, world!')
        self.helloLabe1.pack()
        self.quitButton = Button(self, text='Quit', command=self.quit)
        self.quitButton.pack()

    # def hello(self):
    #     name = self.nameInput.get() or 'world'
    #     messagebox.showinfo('Message', 'Hello, %s' % name)

app = Application()
app.master.title('Hi World')
app.mainloop