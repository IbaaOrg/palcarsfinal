import React, { useState } from 'react';
import logo from '../../../../public/logo1.png'
import '../../../css/FooterStyle/Footer.css'



function Footer() {
    return (

        <div>
            <div class="card mt-3">
                <div class="card-header">

                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">

                            <div class="">
                                <img src={logo} class="navbar-brand" width="200px" />
                                <p>Our vision is to facilitate the movement<br></br>
                                    of tourists and citizens throughout the<br></br>
                                    State of palestine via PalCars</p>
                            </div>
                        </div>

                        <div class="col">
                            <div class="d-flex justify-content-around subdiv2">
                                <div>
                                    <h4>About</h4>
                                    <h6>How it works</h6>
                                    <h6>Featured</h6>
                                    <h6>Partenership</h6>
                                    <h6>Bussiness Relation</h6>
                                </div>
                                <div>
                                    <h4>Community</h4>
                                    <h6>Events</h6>
                                    <h6>Blog</h6>
                                    <h6>Podcast</h6>
                                    <h6>Invite a frind</h6>
                                </div>
                                <div>
                                    <h4>Socials</h4>
                                    <h6>Linked In</h6>
                                    <h6>Facebook</h6>
                                    <h6>Instagram</h6>
                                    <h6>X</h6>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <hr class="custom-line"></hr>
                <div class="d-flex justify-content-around subdiv2">
                    <p>&copy; 2024 PALCARS. جميع الحقوق محفوظة.</p>
                    <div class="d-flex justify-content-around">
                        <p>Privacy & Policy   </p>
                        <p>Terms & Condition</p>

                    </div>


                </div>
            </div>

        </div>
    );
}
export default Footer;