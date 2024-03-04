import React from 'react'
import 'bootstrap-icons/font/bootstrap-icons.css';
import Logo from '../../../public/logo1.png'
function Sidebar() {
  return (
    <div className='bg-white sidebar p-2'>
        <div className='m-2'>
            
            <span className='brand-name fs-4'>
                  <img src={Logo}/>
            </span>
        </div>
        <hr className='text-dark'/>
        <div className='list-group list-group-flush'>

            <a className='list-group-item list-group-item-action py-2'>
                  <i class="bi bi-speedometer2 fs-4 me-2"></i>
                <span className='fs-5'>Dashbord</span>
            </a>
            <br/>
              <a className='list-group-item list-group-item-action py-2'>
                  <i className='bi bi-house fs-4 me-2'></i>
                  <span className='fs-5'>Home</span>
              </a>
              <a className='list-group-item list-group-item-action py-2'>
                  <i className="bi bi-car-front  fs-4 me-2"></i>
                  <span className='fs-5'>Vehicles</span>
              </a>
              <a className='list-group-item list-group-item-action py-2'>
                  <i className='bi bi-people fs-4 me-2'></i>
                  <span className='fs-5'>Employee</span>
              </a>
              <a className='list-group-item list-group-item-action py-2'>
                  <i class="bi bi-chat-left-text fs-4 me-2"></i>

                  <span className='fs-5'>Chats</span>
              </a>
              <a className='list-group-item list-group-item-action py-2'>
                  <i className='bi bi-universal-access-circle fs-4 me-2'></i>
                  <span className='fs-5'>Access Control</span>
              </a>
              <a className='list-group-item list-group-item-action py-2'>
                  <i className='bi bi-cash-coin fs-4 me-2'></i>
                  <span className='fs-5'>Expenses</span>
              </a>
        </div>
    </div>
  )
}

export default Sidebar