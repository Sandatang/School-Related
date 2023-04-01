import os

os.system("cls")

def menu():
    while True:
        os.system("cls")
        print("---MAIN MENU--")
        print("1. Addition")
        print("2. Subtraction")
        print("3. Multiplication")
        print("4. Division")
        print("0. Exit")
        print("------------------")
        option = int(input("Enter (0..4) : "))

        if option >= 1 and option <= 4:
            logicMath(option)
        else:
            exit()
def logicMath(option):
    firstVal = int(input("Enter first value :"))
    secondVal = int(input("Enter second value :"))
    checkFirstVal = firstVal <= 100
    checkSecondVal = secondVal <= 100

    if checkFirstVal&checkSecondVal:
        match option:
            case 1:
                print(f"The result of {firstVal} and {secondVal} is {firstVal+secondVal}")
                os.system("pause")
            case 2:
                print(f"The result of {firstVal} and {secondVal} is {firstVal-secondVal}")
                os.system("pause")
            case 3:
                print(f"The result of {firstVal} and {secondVal} is {firstVal*secondVal}")
                os.system("pause")
            case 4:
                print(f"The result of {firstVal} and {secondVal} is {firstVal/secondVal}")
                os.system("pause")
    else:
        print("Invalid Inputs")
        os.system("pause")
menu()