// document.addEventListener("DOMContentLoaded", function () {

//     document.addEventListener("DOMContentLoaded", function () {
//         AOS.init();

//         new Splide("#videoCarousel", {
//             type: "loop",
//             perPage: 1,
//             autoplay: true,
//             interval: 5000,
//             pauseOnHover: false,
//             pauseOnFocus: false,
//             arrows: true,
//             pagination: true,
//             speed: 800,
//         }).mount();
//     });


//     document.addEventListener("DOMContentLoaded", function () {
//         const background = document.getElementById("background-animation");
//         background.style.background = "radial-gradient(circle, rgba(7,43,242,0.4) 0%, rgba(0,0,0,0) 70%)";
//         background.style.animation = "pulse 6s infinite alternate";
//     });

//     // Efecto de vibración en móvil para botón de llamada
//     document.getElementById("callButton").addEventListener("click", function () {
//         if (navigator.vibrate) {
//             navigator.vibrate([100, 50, 100]);
//         }
//     });
// });

document.addEventListener("DOMContentLoaded", function () {
    console.log("✅ landing.js cargado correctamente");

    // Inicializar AOS
    if (typeof AOS !== "undefined") {
        AOS.init({
            duration: 1000,
            easing: "ease-in-out",
            once: true
        });
        console.log("✅ AOS inicializado correctamente");
    } else {
        console.error("❌ Error: AOS no está definido");
    }

    // Inicializar Splide.js (carrusel de videos)
    const videoCarousel = document.getElementById("videoCarousel");
    if (videoCarousel) {
        new Splide("#videoCarousel", {
            type: "loop",
            perPage: 1,
            autoplay: true,
            interval: 5000,
            pauseOnHover: false,
            pauseOnFocus: false,
            arrows: true,
            pagination: true,
            speed: 800,
        }).mount();
        console.log("✅ Splide.js inicializado correctamente");
    } else {
        console.warn("⚠️ Advertencia: No se encontró el elemento #videoCarousel");
    }

    // Efecto de animación de fondo
    const background = document.getElementById("background-animation");
    if (background) {
        background.style.background = "radial-gradient(circle, rgba(7,43,242,0.4) 0%, rgba(0,0,0,0) 70%)";
        background.style.animation = "pulse 6s infinite alternate";
        console.log("✅ Fondo animado aplicado");
    } else {
        console.warn("⚠️ Advertencia: No se encontró el elemento #background-animation");
    }

    // Efecto de vibración en móvil para botón de llamada
    const callButton = document.getElementById("callButton");
    if (callButton) {
        callButton.addEventListener("click", function () {
            if (navigator.vibrate) {
                navigator.vibrate([100, 50, 100]);
            }
        });
        console.log("✅ Vibración en botón de llamada configurada");
    } else {
        console.warn("⚠️ Advertencia: No se encontró el botón #callButton");
    }
});
