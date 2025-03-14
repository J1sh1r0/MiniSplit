// window.addEventListener('scroll', function() {
//     const navbar = document.getElementById('navbar');
//     if (window.scrollY > 50) {
//         navbar.style.background = 'rgba(7, 43, 242, 0.95)';
//         navbar.style.boxShadow = '0px 4px 10px rgba(0, 0, 0, 0.3)';
//     } else {
//         navbar.style.background = 'rgba(7, 43, 242, 0.9)';
//         navbar.style.boxShadow = 'none';
//     }
// });

// document.getElementById("callButton").addEventListener("click", function() {
//     if (navigator.vibrate) {
//         navigator.vibrate([100, 50, 100]);
//     }
// });

document.addEventListener("DOMContentLoaded", function() {
    // Navbar: Cambio de color con scroll
    const navbar = document.getElementById("navbar");
    if (navbar) {
        window.addEventListener("scroll", function() {
            if (window.scrollY > 50) {
                navbar.style.background = "rgba(7, 43, 242, 0.95)";
                navbar.style.boxShadow = "0px 4px 10px rgba(0, 0, 0, 0.3)";
            } else {
                navbar.style.background = "rgba(7, 43, 242, 0.9)";
                navbar.style.boxShadow = "none";
            }
        });
    }

    // Vibración en botón de llamada
    const callButton = document.getElementById("callButton");
    if (callButton) {
        callButton.addEventListener("click", function() {
            if (navigator.vibrate) {
                navigator.vibrate([100, 50, 100]);
            }
        });
    }
});
