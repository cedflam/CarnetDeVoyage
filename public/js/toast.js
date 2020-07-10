//Affiche des messages flash
var toast =  (text, color) => {
    Toastify({
        text: text,
        duration: 3000,
        destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: 'right', // `left`, `center` or `right`
        backgroundColor: color,
        stopOnFocus: true, // Prevents dismissing of toast on hover
        onClick: function () {
        } // Callback after click
    }).showToast();
}