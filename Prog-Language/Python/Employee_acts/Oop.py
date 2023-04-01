class Person(object):
    def __init__(self,name:str)->None:
        self.name = name
    def __str__(self)->str:
            return f"{self.name}"

class Employee(Person):
    def __init__(self,idno:str,name:str,position:str,totalsalary:float)->None:
        super().__init__(name)
        self.idno=idno
        self.position=position
        self.totalsalary=totalsalary
    
    def __str__(self)->str:
        return f"{self.idno},{super().__str__()},{self.position},{self.totalsalary}"
