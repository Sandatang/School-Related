import os

os.system("cls")


def validate():
    try:
        while True:
            os.system("cls")
            num: int = int(input("Enter num (1..10) :"))

            if num > 0 and num <= 10:
                starter = 1
                while starter <= num:
                    displayOut(num, starter)
                    starter += 1
                os.system("pause")
            else:
                print("Invalid")
    except:
        input("Press any key to continue...")


def displayOut(num, starter):
    # print the main numbers
    for i in range(starter, num+2):
        if i <= num:
            print(i, end=' ')
        else:
            counter = 1
            while counter != starter:
                print(counter, end=' ')
                counter += 1
            print("\n")


validate()
