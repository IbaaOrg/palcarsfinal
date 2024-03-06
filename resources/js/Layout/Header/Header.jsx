import React, { useEffect } from 'react';
import { useState } from 'react';
import logo from '../../../../public/logo1.png';
import { BrowserRouter as Router, Route, Link } from "react-router-dom";
import 'bootstrap-icons/font/bootstrap-icons.css';

import '../../../css/HeaderStyle/Header.css';
import NaveBar from './Navbar';
import Dialog from '../Dialog/Dialog';

import Login from '../../Componants/Login/Login';
import SignUp from '../../Componants/Login/SignUp';


function Header() {

    const [isDialogOpen, setDialogOpen] = useState(false);

    const openDialog = () => {
        setDialogOpen(true);
    };

    const closeDialog = () => {
        setDialogOpen(false);
    };


    const [isSignOpen, setSignOpen] = useState(false);

    const openDialogSign = () => {
        setSignOpen(true);
    };

    const closeDialogSign = () => {
        setSignOpen(false);
    };


    const [openlogin, setOpenlogin] = useState(false);
    const [opensignup, setOpensignup] = useState(false);
    const [showprofile, setShowprofile] = useState(false);

    return (
        <div class="d-flex  justify-content-around" >
           


            <nav class="navbar bg-body-tertiary  ">

                <div class="container-fluid">

                    <div className={`nav-logo `}>
                        <a href='/'>
                            <img src={logo} alt="logo" className="nav-logo-img" />
                        </a>
                    </div>

                    {/* search */}
                    <NaveBar />
                    <div>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                                <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                    <div class="hstack gap-3">
                        <div class="p-2">
                            <i class="bi bi-bell-fill fs-4 me-2"></i>

                        </div>
                    
                           
                            <div class="p-2" >


                                <ul class="d-flex justify-content-around">



                                    <li>
                                        <button onClick={openDialog} class="btn btn-success"> Login</button>

                                        {isDialogOpen && <Dialog onClose={closeDialog} />}

                                    </li>
                                    <li>
                                        <button onClick={openDialogSign} class="btn btn-danger"> SignUp</button>

                                        {isSignOpen && <Dialog onClose={closeDialogSign} />}
                                    </li>

                                </ul>


                            </div>
                       
                       
                            <a href='/profile'>
                            <i class="bi bi-person-circle  fs-4 me-2"></i>
                            </a>
                      
                    </div>
                </div>




            </nav>

        </div>


    );
}

export default Header;