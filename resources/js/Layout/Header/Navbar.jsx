import React, { useState } from 'react';
import logo from '../../../../public/logo1.png';
import '../../../css/HeaderStyle/Header.css';
import { BrowserRouter as Router, Routes, Route, Link } from "react-router-dom";


function NaveBar() {
    return (
        <div className='navbar-div menu-button'>
            <ul class="nav hstack gap-3 justify-content-end ">
                <Router>

                    <a class="p-2" aria-current="page" href="/">Home</a>
                    <a class="p-2" aria-current="page" href="/Cars">Cars</a>

                    <a class="p-2" aria-current="page" href="/About">About</a>
                    <a class="p-2" aria-current="page" href="/conuctus">Conuct Us</a>
                </Router>

            </ul>
        </div>


    );
}

export default NaveBar;