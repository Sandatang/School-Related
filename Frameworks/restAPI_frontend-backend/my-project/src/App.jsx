import { useState } from 'react'
import { Populate } from './components'

function App() {
  const [count, setCount] = useState(0)

  return (
    <div className="overflow-hidden w-full">
      <div className='sm:px-16 px-6 flex justify-center items-center'>
        <div className='xl:w-[1200px] w-full'>
          <Populate/>
        </div>
      </div>
    </div>
  )
}

export default App
