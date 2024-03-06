import React, { useState, useEffect } from 'react';
import imghome from '../../../../public/image/homeimage.jpeg'

import '../../../css/HomeStyle/Home.css';
/* import Card from '../../ui/card';
import Cars from '../../pages/cars/Cars';
import Header from '../../componants/header/Header';
import Footer from '../../componants/footer/Footer';

import DashboardManager from '../../pages/companypages/dashbordmaneger'; */
import ScrollToTopButton from '../../Layout/ScrollToTopButton';
function Home() {

  const [image, setImage] = useState('');
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [phone, setPhone] = useState('');

  const [location, setLocation] = useState('');

  const [iscompany, setIscompany] = useState(false);


  return (
    <div>
      <ScrollToTopButton />
      <div className=' ' path="/normal-user">
        <div className='maindiv'>
          <img src={imghome} className='img' />
        </div>
        <div class="container  d-flex justify-content-around">

        </div>
      </div>
    </div>





  );
}
export default Home; 