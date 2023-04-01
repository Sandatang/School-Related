from mysql.connector import connect

class Person:
    def __init__(self,lastname,firstname):
        self.lastname = lastname
        self.firstname = firstname
    def getLastname(self):
        return self.lastname
    def getFirstname(self):
        return self.firstname

class Student(Person):
    def __init__(self, **kwargs):
        kwarg = list(kwargs.values())
        super().__init__(kwarg[1],kwarg[2])
        self.idno = kwarg[0]
        self.course = kwarg[3]
        self.level = kwarg[4]
        self.header_str = ','.join(kwargs.keys())

    def getHeader(self):
        return self.header_str

    def getStudentDATA(self):
        return dict(idno=self.idno,lastname=self.lastname,firstname=self.firstname,course=self.course,level=self.level)

    def check_DATA(self):
        data:list = [self.getStudentDATA()]
        return True if "" not in data else False

class Query(Student):
    def __init__(self, db_connection, table_name, **kwargs):
        self.db = connect(**db_connection)
        self.table_name = table_name
        self.header_str = ', '.join(kwargs.keys())
        self.values = tuple(kwargs.values())
        if kwargs:
            self.values_update_specific = tuple(kwargs.values())[1:] + (tuple(kwargs.values())[0],)
            self.header_update_specific = tuple(kwargs.keys())[1:]


    def addQuery(self):
        db = self.db
        cursor = db.cursor()
        query = f"insert into {self.table_name} ({self.header_str}) values({','.join(['%s'] * len(self.values))})"
        cursor.execute(query, self.values)
        db.commit()
        self.closeDatabaseConnection(cursor,db)
        return "Student added successfully."
    
    def selectAllQuery(self):
        db = self.db
        cursor = db.cursor()
        cursor.execute(f"select * from {self.table_name}")
        data = cursor.fetchall()
        self.closeDatabaseConnection(cursor,db)
        return data

    def findQuery(self):
        db = self.db
        cursor = db.cursor()
        cursor.execute(f"select * from {self.table_name} where {self.header_str} = %s", self.values)
        data = cursor.fetchall()
        return data
    
    def deleteQuery(self):
        db = self.db
        cursor = db.cursor()
        query = f"delete from {self.table_name} where {self.header_str} = %s"
        cursor.execute(query, self.values)
        db.commit()
        affected = cursor.rowcount
        self.closeDatabaseConnection(cursor,db)
        return affected

    def updateQuery(self):
        db = self.db
        cursor = db.cursor()
        # return self.values_update_specific
        query = f"update {self.table_name} set {', '.join([f'{head} = %s' for head in self.header_update_specific])} where idno = %s"
        cursor.execute(query,self.values_update_specific)
        db.commit()
        affected = cursor.rowcount
        self.closeDatabaseConnection(cursor,db)
        return affected

    def closeDatabaseConnection(self, *args):
        args[0].close()
        args[1].close()


