import React, {useState, useEffect} from 'react'


const Login = () => {

  return (
    <div className=' flex justify-center items-center h-[100vh]'>
        
        <div className='flex flex-col justify-start items-center w-[300px] bg-gray-200 p-4 rounded-lg'>
            <div className='bg-blue-400 w-full p-4 rounded-md my-2'>
                <h2 className='font-bold text-[25px] text-center text-white'>Login</h2>
            </div>
            <div className='w-full'>
                <form className=' flex flex-col justify-center items-center'>
                    <input placeholder="Username" className='w-full border p-2 rounded-sm my-2 focus:outline-none focus:border-blue-300'/>
                    <input placeholder="Password" className='w-full border p-2 rounded-sm focus:outline-none focus:border-blue-300'/>
                    <button className='bg-green-600 w-full my-4 p-4 rounded-md text-white font-bold tracking-wide text-[15px]
                    hover:text-[black]'>Authenticate</button>
                </form>

            </div>
        </div>
    </div>
  )
}

export default Login