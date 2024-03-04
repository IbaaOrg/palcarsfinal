import React from "react";
import { createRoot } from "react-dom/client";
import Dashbord from "./Pages/Dashbord/Dashbord";
const App = () => {
    return (
        <div>
            
            <Dashbord/>
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
