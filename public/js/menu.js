// function toggleMenu() {
//     document.querySelector('#navbar ul').classList.toggle('active');
// }

// document.getElementById("callButton").addEventListener("click", function () {
//     if (navigator.vibrate) {
//         navigator.vibrate([100, 50, 100]); // 🔹 Vibración en móviles
//     }
// });

// function toggleMenu() {
//     document.querySelector('#navbar ul').classList.toggle('active');
// }

// window.addEventListener('scroll', function () {
//     const navbar = document.getElementById('navbar');
//     if (window.scrollY > 50) {
//         navbar.style.background = 'rgba(7, 43, 242, 0.95)';
//         navbar.style.boxShadow = '0px 4px 10px rgba(0, 0, 0, 0.3)';
//     } else {
//         navbar.style.background = 'rgba(7, 43, 242, 0.9)';
//         navbar.style.boxShadow = 'none';
//     }
// });

// document.addEventListener("DOMContentLoaded", function () {
//     const mobileMenu = document.getElementById("mobile-menu");
//     const menuToggle = document.getElementById("menu-toggle");
//     const closeMenu = document.getElementById("close-menu");
//     const mobileLinks = document.querySelectorAll("#mobile-menu a");

//     // 🔹 Alternar menú
//     menuToggle.addEventListener("click", function () {
//         const isMenuOpen = mobileMenu.classList.contains("show");

//         if (isMenuOpen) {
//             closeNavMenu();
//         } else {
//             openNavMenu();
//         }
//     });

//     // 🔹 Cierra el menú al hacer clic en el botón ✖
//     closeMenu.addEventListener("click", closeNavMenu);

//     // 🔹 Cierra el menú al hacer clic en cualquier opción
//     mobileLinks.forEach(link => {
//         link.addEventListener("click", closeNavMenu);
//     });

//     function openNavMenu() {
//         mobileMenu.classList.add("show");
//     }

//     function closeNavMenu() {
//         mobileMenu.classList.remove("show");
//     }
// });

// // <!--🔹Script para el menú-- >
// document.getElementById("close-menu").addEventListener("click", function () {
//     let menu = document.getElementById("mobile-menu");
//     menu.classList.remove("opacity-100", "scale-100");
//     menu.classList.add("opacity-0", "scale-95");
//     setTimeout(() => {
//         menu.classList.add("hidden");
//     }, 300);
// });

// document.querySelectorAll("#mobile-menu .nav-link").forEach(link => {
//     link.addEventListener("click", () => {
//         let menu = document.getElementById("mobile-menu");
//         menu.classList.remove("opacity-100", "scale-100");
//         menu.classList.add("opacity-0", "scale-95");
//         setTimeout(() => {
//             menu.classList.add("hidden");
//         }, 300);
//     });
// });

// window.addEventListener('scroll', function() {
//     document.getElementById('navbar').classList.toggle('nav-active', window.scrollY > 50);
// });

document.addEventListener("DOMContentLoaded", function () {
    console.log("✅ menu.js cargado correctamente");

    const navbar = document.getElementById("navbar");
    const mobileMenu = document.getElementById("mobile-menu");
    const menuToggle = document.getElementById("menu-toggle");
    const closeMenu = document.getElementById("close-menu");
    const mobileLinks = document.querySelectorAll("#mobile-menu a");
    const callButton = document.getElementById("callButton");

    // 🔹 Alternar menú móvil
    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener("click", function () {
            mobileMenu.classList.toggle("show");
        });
    }

    // 🔹 Cerrar el menú con el botón ✖
    if (closeMenu && mobileMenu) {
        closeMenu.addEventListener("click", function () {
            mobileMenu.classList.remove("show");
        });
    }

    // 🔹 Cerrar el menú al hacer clic en un enlace
    mobileLinks.forEach(link => {
        link.addEventListener("click", function () {
            mobileMenu.classList.remove("show");
        });
    });

    // 🔹 Efecto de vibración en botón de llamada
    if (callButton) {
        callButton.addEventListener("click", function () {
            if (navigator.vibrate) {
                navigator.vibrate([100, 50, 100]);
            }
        });
    }

    // 🔹 Cambiar la apariencia del navbar en el scroll
    if (navbar) {
        window.addEventListener("scroll", function () {
            if (window.scrollY > 50) {
                navbar.style.background = "rgba(7, 43, 242, 0.95)";
                navbar.style.boxShadow = "0px 4px 10px rgba(0, 0, 0, 0.3)";
            } else {
                navbar.style.background = "rgba(7, 43, 242, 0.9)";
                navbar.style.boxShadow = "none";
            }
        });
    }

    console.log("✅ Menú y navbar configurados correctamente");
});
