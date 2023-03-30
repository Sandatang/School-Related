import os
import mysql.connector
import tabulate

header = ["Idno","Lastname","Firstname","Course","Level"]

db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="pythondb"
)

db_pointer = db.cursor()

#region modules necessary for vital modules
def does_it_exist(idno)->list:
    query = "select * from student where idno = %s"
    data = (idno,)
    db_pointer.execute(query,data)
    result = db_pointer.fetchall()
    if result != []:
        return result
    else: return False

def clearScreen()->None:
    os.system("clear" if os.name=="posix" else "cls")

def head_title(head)->None:
    print(f"----{head}----\n\n")
#endregion

#region vital modules
def insertData()->None:
    clearScreen()
    head_title("Add Student")
    idno:str = input("Enter idno        :")
    lastname:str = input("Enter lastname    :")
    firstname:str = input("Enter firstname   :")
    course:str = input("Enter course      :")
    level:str = input("Enter level       :")

    check_data_if_not_empty = [idno.strip(),lastname.strip(),firstname.strip(),course.strip(),level.strip()]
    # checked_data = validataion(check_data_if_not_empty)
    if "" not in check_data_if_not_empty:
        query = "insert into student values(%s,%s,%s,%s,%s)"
        data = (idno.lower(),lastname.strip().title(),firstname.strip().title(),course.strip().upper(),level.strip())
        result = does_it_exist(idno)
        if result == False:
            input("\n---Student added.\n\nPress enter to continue..."),db_pointer.execute(query, data),db.commit()
        else: 
            input(f"\n---Student with idno of {idno} already existed.\n\nPress enter to continue...")
    else:input("\n---Invalid input of data. Be mindful.")

def find_student()->None:
    clearScreen()
    head_title("Find Student")
    idno = input("Enter idno    :")

    result = does_it_exist(idno)
    if result != False:
        print("\n-----Student Found-----\n")
        index = 0
        for i in range(0,5):
            print("{:<{}}".format(f"{header[index]}", 19) + " : " +"{:<{}}".format(str(result[0][i]), 19))
            index+=1
        input("\n\n---No further data available.\n\nPress enter to continue...")
    else: 
        input(f"\n---Student not found.\n\nThere is no student with idno of {idno}\n\nPress enter to continue...")

def delete_student()->None:
    clearScreen()
    head_title("Delete Student")
    idno = input("Enter idno    :")

    result = does_it_exist(idno)
    if result != False:
        is_confirmed = input("\n\n---Student Found.\nAre you sure you want to delete this student (y/n): ")

        if is_confirmed == 'y':
            query = "delete from student where idno = %s"
            data = (idno,)
            db_pointer.execute(query,data)
            db.commit()
            input(f"\n---Student deleted with idno of {idno}.\n\nPress enter to continue...")
        else: input("\n---Program was cancelled by the User.\n\nPress enter to continue...")
    else: input(f"\n---Student not found.\n\nThere is no student with idno of {idno}\n\nPress enter to continue...")

def edit_student():
    clearScreen()
    head_title("Edit Student")
    idno = input("Enter idno  :")

    result = does_it_exist(idno)
    if result != False:
        clearScreen()
        head_title("\tUpdate\n\n---Student Found")
        idno = result[0][0]
        print(f"Idno    : {idno}")
        lastname = input(f"Enter firstname (default: {result[0][1]}): ").strip() or result[0][1]
        firstname = input(f"Enter lastname (default: {result[0][2]}): ").strip() or result[0][2]
        course = input(f"Enter course (default: {result[0][3]}): ").strip() or result[0][3]
        level = input(f"Enter level (default: {result[0][4]}): ").strip() or result[0][4]
        
        modified_student_data:tuple = (idno,lastname,firstname,course,level)
        if modified_student_data != result:
            proceed_changes:str = input("\n\nAre you sure you want to modify this student? (y/n):")
            if proceed_changes == 'y':
                query = "update student set lastname = %s,firstname=%s,course=%s,level=%s where idno = %s"
                data = (lastname.title(),firstname.title(),course.upper(),level,idno)
                db_pointer.execute(query,data)
                db.commit(),input("\nSuccesfully updated.\n\nPress enter to continue...")
            else:input("\nProgram was cancelled by the user.\n\nPress enter to continue...")
        else:input("\n\n---Data was skipped by user. No changes made.\n\nPress enter to continue....")


def displayAll()->None:
    clearScreen()
    head_title("Display All Student")
    db_pointer.execute("select * from student")
    result = db_pointer.fetchall()
    if result != []:
        print(tabulate.tabulate(result, headers=header,tablefmt="grid"))
    else:print(tabulate.tabulate(result, headers=header,tablefmt="grid")+"\n\n\t\tNo records!")
    input("\n\n---No further data available.\n\nPress enter to continue...")

def deleteAll_data():
    clearScreen()
    head_title("Delete All Data")
    is_confirmed = input("Are you sure you want to delete all data? (y/n): ")
    if is_confirmed == 'y':
        query = "delete from student"
        db_pointer.execute(query)
        input("\n\n---Data was deleted.\n\nPress enter to continue...")
    else:input("\n\nProgram was cancelled by the user.\n\nPress enter to continue...")
def terminate()->None:
    clearScreen()
    print("Program Terminated.")

def getOption(option)->str:
    options:dict = {
        1:insertData,
        2:find_student,
        3:delete_student,
        4:edit_student,
        5:displayAll,
        6:deleteAll_data,
        0:terminate
    }
    return options.get(option)()
#endregion

def menu()->None:
    clearScreen()
    print("-------Main Menu--------\n")
    menu:tuple=(
        "1. Add Student",
        "2. Find Student",
        "3. Delete Student",
        "4. Update Student",
        "5. Display All Student",
        "6. Delete all Data",
        "0. Quit/End",
        "------------------------"
    )
    [print(i) for i in menu]

def login()->bool:
    user = input("Username  : ")
    password = input("Password  : ")

    if user == 'user' and password == 'admin':
        return True
    return False

def main()->None:
    clearScreen()
    okey:bool = login()
    option = 999
    if okey:
        while option != 0:
            menu()
            # try:
            option:int = int(input("Choose option: "))
            getOption(option)
            # except:
                # input("Invalid data.\nPress enter to continue...")
    else: print("wrong")
if __name__=="__main__":
    main()