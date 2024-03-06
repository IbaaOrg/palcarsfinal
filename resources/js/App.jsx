import React from "react";
import { createRoot } from "react-dom/client";
import Dashbord from "./Pages/Dashbord/Dashbord";
import Dialog from "./Layout/Dialog/Dialog";
import Footer from "./Layout/Footer/Footer";
import Nav from "./Layout/Nav";
import Header from "./Layout/Header/Header";
import Home from "./Pages/Home/Home";
const App = () => {
    return (
        <div>
    
            <Header/>
            <Home/>
            <Footer/>
           
        </div>



    )
}

const contenter = document.getElementById("root");
const root = createRoot(contenter)

root.render(
    <React.StrictMode>
        <App />
    </React.StrictMode>
)
