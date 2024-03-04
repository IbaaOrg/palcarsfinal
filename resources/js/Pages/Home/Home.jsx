import React from 'react'
import Nav from '../../Layout/Nav'
function Home({Toggle}) {
  return (
    <div className='Home'>

        <Nav Toggle = {Toggle}/>
        <div>
            <h1> Home</h1>
        </div>
    </div>
  )
}

export default Home