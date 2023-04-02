import tkinter as tk
from tkinter import ttk
from mysql.connector import connect

db = {
    "host":"localhost",
    "user":"root",
    "password":"",
    "database":"pythondb"
}

class App:
    def __init__(self, master):
        self.master = master
        self.master.title("Student Management")
        self.main_frame = None
        self.login_frame = None
        self.login()

    def login(self):
        self.login_frame = ttk.Frame(self.master, padding=(50, 40 , 50, 40))
        self.login_frame.grid()
        self.master.geometry("320x180")
        ttk.Label(self.login_frame, text="Username:").grid(column=0, row=0, sticky="E")
        ttk.Label(self.login_frame, text="Password:").grid(column=0, row=1, sticky="E")

        self.username = tk.StringVar()
        self.password = tk.StringVar()
        ttk.Entry(self.login_frame, textvariable=self.username).grid(column=1, row=0, sticky="W")
        ttk.Entry(self.login_frame, textvariable=self.password, show="*").grid(column=1, row=1,pady=5, sticky="W")

        ttk.Button(self.login_frame, text="Login", command=self.management).grid(column=1, row=2, pady=5)

    def management(self):
        if self.username.get() == "user" and self.password.get() == "admin":
            self.login_frame.destroy()

            self.main_frame = ttk.Frame(self.master, padding = (5, 20, 5,))
            self.main_frame.grid()
            self.master.geometry("1215x400")
            ttk.Label(self.main_frame, text="Students", font=("TkDefaultFont", 20)).grid(column=0, row=0)

            self.treeview = ttk.Treeview(self.main_frame, columns=("Student Id", "Idno", "Lastname", "Firstname", "Course", "Level"), show="headings")


            db_connectioin = connect(**db)
            cursor = db_connectioin.cursor()
            cursor.execute("select * from student")

            for i in range(len(self.treeview['columns'])):
                self.treeview.heading(self.treeview['columns'][i], text=self.treeview['columns'][i])

            for data in reversed(cursor.fetchall()):
                self.treeview.insert("", "0", values=(data[0],data[1],data[2],data[3],data[4],data[5]))
            self.treeview.grid(column=0, row=1)

        else:
            ttk.Label(self.login_frame, text="Invalid username or password", foreground="red").grid(column=1, row=3)

root = tk.Tk()
app = App(root)
root.mainloop()
