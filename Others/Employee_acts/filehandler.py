from Oop import Employee
employee = 'employee.csv'
position = 'position.csv'
employee_payroll = 'payroll.csv'

def saveit(emp_payroll:list):
    with open(employee_payroll, 'a') as f:
        for i in emp_payroll:
            # k =i.idno,i.name,i.position,i.totalsalary
            f.write(i.__str__())
            f.write("\n")

def loadlist():
    emp_pos:list=[]
    with open(employee, 'r') as f:
        with open(position, 'r') as p:
                for i in f.readlines():
                    o = i.strip().split(',')
                    for j in p.readlines():
                        k = j.strip().split(',')
                        if k[0] == o[2]:
                            emp_pos.append(o[0:-1]+k[1:])
                            break
                    p.seek(0)
    return emp_pos

def generatepay():
    to_fee:list=[]
    with open(employee_payroll, 'r') as f:
        for i in f.readlines():
            o = i.strip().split(',')
            to_fee.append(o)

    return to_fee

# def delete(idno):
#     lines=[]
#     with open(employee, 'r') as f:
#         lines = f.readlines()
#     with open(employee,'w') as f:
#         for line in lines:
#             if idno not in line:
#                 f.write(line.__str__())
