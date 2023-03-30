import React, {useState} from 'react'
import axios from 'axios'

const Populate = () => {
    const [idno,setIdno] = useState(0)
    const [lastname,setLastname] = useState("")
    const [firstname, setFirstname] = useState("")
    const [course, setCourse] = useState("")
    const [level,setLevel] = useState(0)

    const [studentList, setStudenList] = useState([])
    //Sending data to backend
    const addStudent = () => {
        axios.post('http://localhost:4000/students', {
            idno: idno, 
            lastname: lastname, 
            firstname: firstname, 
            course: course, 
            level: level
        }).then(() => {
            alert("Succesfully Added")
        }).catch(() => {
            alert("Invalid")
        })
    }

    const getStudents = () => {
        axios.get('http://localhost:4000/get-students').then((response) => {
            setStudenList(response.data.results)
        })
    }
  return (
    <div className=' flex flex-row justify-center items-center h-[100vh]'>
        <div className='w-[500px]  rounded-md bg-green-400 flex flex-col justify-center items-center my-2 p-4 '>
            <div className='w-[300px] flex flex-col justify-center items-center text-[25px]'>
                <label>Idno</label>
                <input type="text" onChange={(e)=>{
                    setIdno(e.target.value)
                }} className='border w-full pl-2'/>
                
                <label>Lastname</label>
                <input type="text" 
                    onChange={(e) => {
                        setLastname(e.target.value)
                    }} className='border w-full pl-2'/>

                <label>Firstname</label>
                <input type="text" 
                    onChange={(e) => {
                        setFirstname(e.target.value)
                    }} className='border w-full pl-2'/>

                <label>Course</label>
                <input type="text" 
                    onChange={(e) => {
                        setCourse(e.target.value)
                    }} className='border w-full pl-2'/>

                <label>Level</label>
                <input type="text" 
                    onChange={(e) => {
                        setLevel(e.target.value)
                    }} className='border w-full pl-2'/>

                <button onClick={addStudent} className='bg-blue-400 my-4 p-2 rounded-md w-full hover:text-white hover:bg-blue-900'>+ Add</button>
            </div>
        </div>

        <div className='flex flex-col justify-end items-center'>
            <button className='bg-green-400 w-[30%] p-2 rounded-md hover:text-white hover:bg-blue-400' onClick={getStudents}>Show Students</button>
                <table className='border border-slate-200 m-10 w-[700px] '>
                    <thead>
                        <tr>
                            <td>IDNO</td>
                            <td>LASTNAME</td>
                            <td>FIRSTNAME</td>
                            <td>COURSE</td>
                            <td>LEVEL</td>
                        </tr>
                    </thead>
                    <tbody>
                        {studentList.map((student,index) => (
                            <tr className='text-center'>
                                <td>{student.idno}</td>
                                <td>{student.lastname}</td>
                                <td>{student.firstname}</td>
                                <td>{student.course}</td>
                                <td>{student.level}</td>
                            </tr>
                        ))}
                    </tbody>
                </table>
        </div>

    </div>
  )
}

export default Populate