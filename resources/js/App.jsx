import React from "react";
import { createRoot } from "react-dom/client";
const App = () => {
    return (
        <div>
            
            <h1>Home page</h1>
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
