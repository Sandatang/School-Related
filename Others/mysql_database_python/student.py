from StudentOOP import *
import os
from tabulate import tabulate

db = {
    "host":"localhost",
    "user":"root",
    "password":"",
    "database":"pythondb"
}

def attemptRequest(**kwargs):
    return Student(**kwargs)

def userInputs():
    validation = attemptRequest(
        idno = input("Enter idno        :").strip(),
        lastname = input("Enter lastname    :").strip().title(),
        firstname = input("Enter firstname   :").strip().title(),
        course = input("Enter course      :").strip().upper(),
        level = input("Enter level       :").strip(),
    )
    return validation

def screenPause(*mssg):
    return input(f"\n{mssg}. Press enter to continue...")

def addData():
    clearScreen()
    header("Add Student")
    validation = userInputs()

    if no_blank := validation.check_DATA():
        query = Query(db, "student", **validation.getStudentDATA())
        message = query.addQuery()
        screenPause(message)

    else: screenPause("Invalid data.")

def findStudent(*args):
    clearScreen()
    title = 'Update' if args else 'Find'
    header(f"{title} Student")
    idno = input("Enter idno:")
    query = Query(db, "student", idno=idno)
    data = query.findQuery()
    searched  = table(data)

    print(searched if searched != False else "No records")
    if args: return data
    else: screenPause("No further data available")

def deleteStudent():
    clearScreen()
    data = findStudent(True)

    if data != False:
        print(data)
        decision = input("\n Do you want to delete this student (y/n): ")

        if decision == 'y':
            query = Query(db, "student",idno=data[0][1])
            affected = query.deleteQuery() > 0
            print("Successfully deleted" if affected else "Something wrong was occured. Try again later")
        else:
            print("Action was cancelled.")
        input("Press enter to continue...")
    else:
        screenPause("No records")

def updateStudent():
    clearScreen()
    data = findStudent(True)
    if data:
        print("Update Details")
        print(f"Idno    : {data[0][1]}")
        validation = attemptRequest(
            idno = data[0][1].lower(),
            lastname = input(f"Enter lastname (default: {data[0][2]}): ").strip().title() or data[0][2],
            firstname = input(f"Enter firstname (default: {data[0][3]}): ").strip().title() or data[0][3],
            course = input(f"Enter course (default: {data[0][4]}): ").strip().upper() or data[0][4],
            level = input(f"Enter level (default: {data[0][5]}): ").strip() or data[0][5],
        )
        decision = input("Do you want to proceed (y/n)  :")
        if decision == 'y':
            query = Query(db, "student", **validation.getStudentDATA())
            affected = query.updateQuery()
            screenPause("Updated successfully")
        else:screenPause("Action was cancelled")
    else:screenPause("No records")


def displayAll():
    clearScreen()
    header("Display All")
    query = Query(db, "student")
    data = query.selectAllQuery()
    searched = table(data)
    print(searched if searched != False else "No records")

def table(data):
    header = ["Id","Idno","Lastname","Firstanme","Course","Level"]       
    return tabulate(data, headers=header,tablefmt="fancy_grid") if data != [] else False

def header(title):
    return print(f"-----{title}-----\n\n")

def terminate():
    clearScreen()
    print("Program Terminated.")
    

def getOptions(option):
    options:dict = {
        1:addData,
        2:findStudent,
        3:deleteStudent,
        4:updateStudent,
        5:displayAll,
        0:terminate,
    }
    return options.get(option)()

def menu():
    clearScreen()
    main_menu:tuple = (
        "1. Add Student",
        "2. Find Student",
        "3. Delete Student",
        "4. Update Student",
        "5. Display all Student",
        "0. Quit/End",
        "--------------------------",
    )

    [print(menu) for menu in main_menu]

def clearScreen():
    os.system("clear" if os.name == 'posix' else "cls")


def main():
    option = 999
    while option != 0:
        menu()
        option = int(input("Test:"))
        getOptions(option)

if __name__ == "__main__":
    main()