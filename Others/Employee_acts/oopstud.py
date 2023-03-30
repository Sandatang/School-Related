import os
from Oop import Employee
from outhandler import outputHandler
import filehandler
import pwinput
from tabulate import tabulate

total_sal:list=["IDNO","NAME","POSITION","TOTAL SALARY"]
per_day:list=["IDNO","NAME","POSITION","SALARY PER DAY"]
emp_payroll:list= []
isChanged = False

def finder(idno):

    isfound=False
    getData = filehandler.loadlist()
    if getData:
        for i in getData:
            if i[0] == idno:
                isfound=True
                os.system("clear" if os.name=="posix" else "cls")
                outputHandler("Found",i[0],i[1],i[2],i[3])
                return i
    
    if not(isfound):
        print("\nEmployee doesn't exist!")

def addNumWorked():

    os.system("clear" if os.name=="posix" else "cls")
    print("Add worked day(s)\n---------------------")
    idno=input("IDNO    : ")

    fee_emp:list=finder(idno)

    if fee_emp:
        days_work:int = int(input("\nEnter day(s) worked : "))
        name = fee_emp[1]
        position = fee_emp[2]
        salary = fee_emp[3]
        totalsalary = f'{float(salary) * days_work:.2f}'
        emp_payroll.append(Employee(idno,name,position,totalsalary))
        print("{:<{}}".format("Total salary",19)+ " : " +"{:<{}}".format(totalsalary,17))
        input("----------------------------------------\nPress enter to continue...")
    else: input("\nPress enter to continue...")

def findEmployee():
    os.system("clear" if os.name=="posix" else "cls")
    print("Find Student\n--------------------")
    idno=input("Idno: ")

    finder(idno)
    input("\nPress enter to continue...")

def generatePayroll():
    payroll_data = filehandler.generatepay()
    os.system("clear" if os.name=="posix" else "cls")
    data=[]

    if payroll_data:
        for i in payroll_data:
            data.append(i)

    if emp_payroll:
        for i in emp_payroll:
            k=[i.idno,i.name,i.position,i.totalsalary]
            data.append(k)
    print(tabulate(data, headers=total_sal))

    input("\nNo more data available. Press enter to continue..")
    
    

def displayallEmployee():
    getData = filehandler.loadlist()
    os.system("clear" if os.name=="posix" else "cls")
    print("Display Students\n--------------------------------")
    data = []
    if getData:
        print(tabulate(getData, headers=per_day))
    else: print("No records!\n")
    input("\nPress enter to continue...")

def exit():

    os.system("clear" if os.name=="posix" else "cls")
    filehandler.saveit(emp_payroll)
    print("Program Terminated")

def getOption(option:int)->str:

    options:dict={
        1:findEmployee,
        2:displayallEmployee,
        3:addNumWorked,
        4:generatePayroll,
        0:exit
    }
    return options.get(option)()

def menu():

    os.system("clear" if os.name == "posix" else "cls")
    menu:tuple=(
        "1. Find Employee",
        "2. Display All Employee",
        "3. Add numbers of days(s) worked",
        "4. Generate Payroll",
        "0. Quit/Exit",
        "-----------------------"
    )
    [print(i) for i in menu]

def login():

    okey:bool = False
    os.system("clear" if os.name == "posix" else "cls")
    print("Login")
    username:str = input("Username:")
    password:str = pwinput.pwinput(prompt="Password:",mask="*")

    if username == "user" and password == "admin":
        okey=True
    return okey

def main()->None:
    autheticated:bool = login()
    option:int = 999
    if autheticated:
        while option !=0:
            menu()
            try:
                option:int=int(input("Enter option (0..4):"))
                getOption(option)
            except:
                input("Invalid Input.")
    else: os.system("clear" if os.name=="posix" else "cls"),print("Invalid login. Please log in again")
if __name__ == "__main__":
    main()