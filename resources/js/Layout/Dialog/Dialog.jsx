import React, { useState } from 'react';
import '../../../css/DialogStyle/dialog.css'; // Import your CSS file
import Login from '../../Componants/Login/Login';
import SignUp from '../../Componants/Login/SignUp';

const Dialog = ({ onClose }) => {

    const handleOverlayClick = (e) => {
        // Close the dialog only if the click is on the overlay
        if (e.target.classList.contains('dialog-container')) {
            onClose();
        }
    };
    return (
        <div className="dialog-container" onClick={handleOverlayClick}>

            <SignUp className="dialog" />
        </div>
    );
};

export default Dialog;
