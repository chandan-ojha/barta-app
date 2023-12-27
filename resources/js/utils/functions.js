import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

// define background colors for different message types
const backgroundColors = {
    success: "linear-gradient(to right, #00b09b, #96c93d)",
    error: "linear-gradient(to right, #ff5f6d, #ffc371)",
};

// show toast
const showToast = (message, style) => {
    Toastify({
        text: message,
        duration: 3000,
        close: true,
        gravity: "bottom", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style,
        onClick: function () {}, // Callback after click
    }).showToast();
};

// flash message
const flashMessage = ({ type, message }) => {
    const style = {
        background: backgroundColors[type],
    };

    showToast(message, style);
};

export { flashMessage };
