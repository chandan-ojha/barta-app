import Toastify from "toastify-js";
import "toastify-js/src/toastify.css";

// flash message
const flashMessage = ($type, $message) => {
    if ($type === "success") {
        Toastify({
            text: $message,
            duration: 3000,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
            onClick: function () {}, // Callback after click
        }).showToast();
    } else if ($type === "error") {
        Toastify({
            text: $message,
            duration: 3000,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #ff5f6d, #ffc371)",
            },
            onClick: function () {}, // Callback after click
        }).showToast();
    }
};

export { flashMessage };
