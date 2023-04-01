
col:list=["IDNO","NAME","Salary per.day"]
lenc = max(len(i) for i in col)
def outputHandler(title,a,b,c,d):
    print(f"Student {title}!\n------------------------")
    print("{:<{}}".format("IDNO", lenc+5)+ " : " + "{:<{}}".format(a,lenc+3))
    print("{:<{}}".format("Name", lenc+5)+ " : " + "{:<{}}".format(b,lenc+3))
    print("{:<{}}".format("Position", lenc+5)+ " : " + "{:<{}}".format(c,lenc+3))
    print("{:<{}}".format("Salary per.day", lenc+5)+ " : " + "{:<{}}".format(d,lenc+3))
    # print("{:<{}}".format("Level", lenc+3)+ " : " + "{:<{}}".format(e,lenc+3))
                    