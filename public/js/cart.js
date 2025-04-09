// let carrito = {};

// const productos = {
//     "Minisplit 1": {
//         nombre: "AUFIT CHI-R32-12K-110/220",
//         imagen: "/img/aufit-minisplit-1ton.jpg" // Ruta correcta para Laravel
//     },
//     "Minisplit 2": {
//         nombre: "AUFIT CHI-R32-24K-220",
//         imagen: "/img/aufit-minisplit-2ton.jpg" // Agrega esta imagen a la carpeta "public/img/"
//     }
// };


// function agregarAlCarrito(producto) {
//     if (!carrito[producto]) {
//         carrito[producto] = 0;
//     }
//     carrito[producto]++;
//     actualizarCarrito();

//     document.getElementById('comprar-ya').style.display = 'none';
// }

// function scrollToProductos() {
//     const seccionProductos = document.getElementById('productos');
//     if (seccionProductos) {
//         seccionProductos.scrollIntoView({
//             behavior: 'smooth'
//         });
//     }
// }

// document.getElementById('comprar-ya').addEventListener('click', function() {
//     // Opción 1: desplazamiento suave nativo
//     document.getElementById('productos').scrollIntoView({
//         behavior: 'smooth'
//     });

//     // Opción 2: si quisieras usar Anchor:
//     // window.location.hash = '#productos';
// });


// function eliminarDelCarrito(producto) {
//     if (carrito[producto]) {
//         carrito[producto]--;
//         if (carrito[producto] === 0) {
//             delete carrito[producto];
//         }
//     }
//     actualizarCarrito();
//     // Si el carrito queda vacío, volvemos a mostrar el botón
//     if (Object.keys(carrito).length === 0) {
//         document.getElementById('comprar-ya').style.display = 'block';
//     }
// }

// function actualizarCarrito() {
//     const cartContainer = document.getElementById('cart-container');
//     const cartItems = document.getElementById('cart-items');
//     cartItems.innerHTML = '';

//     Object.keys(carrito).forEach(producto => {
//         const li = document.createElement('li');
//         li.classList.add('cart-item');

//         li.innerHTML = `
// <div class="cart-item-info">
// <img src="${productos[producto].imagen}" alt="${productos[producto].nombre}">
// <span>${productos[producto].nombre} (x${carrito[producto]})</span>
// </div>
// <button onclick="eliminarDelCarrito('${producto}')">❌</button>
// `;

//         cartItems.appendChild(li);
//     });

//     // Muestra el carrito solo si hay productos
//     cartContainer.style.display = Object.keys(carrito).length > 0 ? 'block' : 'none';
// }

// ✅ Asegurar que `carrito` es global
if (typeof carrito === "undefined") {
    var carrito = {};
}

const productos = {
    "Minisplit 1": {
        nombre: "AUFIT CHI-R32-12K-110/220",
        imagen: "/img/aufit-minisplit-1ton.jpg"
    },
    "Minisplit 2": {
        nombre: "AUFIT CHI-R32-24K-220",
        imagen: "/img/aufit-minisplit-2ton.jpg"
    }
};

// ✅ Hacer las funciones globales
function agregarAlCarrito(producto) {
    if (!carrito[producto]) {
        carrito[producto] = 0;
    }
    carrito[producto]++;
    actualizarCarrito();
    console.log(`🛒 ${producto} agregado al carrito.`, carrito);
}

function eliminarDelCarrito(producto) {
    if (carrito[producto]) {
        carrito[producto]--;
        if (carrito[producto] === 0) {
            delete carrito[producto];
        }
    }
    actualizarCarrito();
}

function actualizarCarrito() {
    const cartContainer = document.getElementById("cart-container");
    const cartItems = document.getElementById("cart-items");
    const comprarYaBtn = document.getElementById("comprar-ya"); // ✅ Referenciar el botón correctamente

    if (!cartContainer || !cartItems || !comprarYaBtn) {
        console.error("❌ Error: No se encontró un elemento necesario.");
        return;
    }

    cartItems.innerHTML = "";

    Object.keys(carrito).forEach((producto) => {
        const li = document.createElement("li");
        li.classList.add("cart-item");

        li.innerHTML = `
            <div class="cart-item-info">
                <img src="${productos[producto].imagen}" alt="${productos[producto].nombre}">
                <span>${productos[producto].nombre} (x${carrito[producto]})</span>
            </div>
            <button onclick="eliminarDelCarrito('${producto}')">❌</button>
        `;

        cartItems.appendChild(li);
    });

    // ✅ Mostrar el carrito si tiene productos
    cartContainer.style.display = Object.keys(carrito).length > 0 ? "block" : "none";

    // ✅ Ocultar el botón "Comprar Ahora" si hay productos en el carrito
    comprarYaBtn.style.display = Object.keys(carrito).length > 0 ? "none" : "block";

    console.log("✅ Carrito actualizado:", carrito);
}

// ✅ Ejecutar el código solo cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", function () {
    console.log("✅ cart.js cargado correctamente");

    // ✅ Asegurar que los botones "Agregar al carrito" funcionen
    document.querySelectorAll(".agregar-carrito").forEach((button) => {
        button.addEventListener("click", function () {
            let producto = this.getAttribute("data-producto");
            console.log(`🔹 Botón presionado: ${producto}`);
            agregarAlCarrito(producto);
        });
    });

    // ✅ Hacer scroll a los productos cuando se presione el botón "Comprar Ahora"
    const comprarYaBtn = document.getElementById("comprar-ya");
    if (comprarYaBtn) {
        comprarYaBtn.addEventListener("click", function () {
            const seccionProductos = document.getElementById("productos");
            if (seccionProductos) {
                seccionProductos.scrollIntoView({ behavior: "smooth" });
            }
        });
    }

    // ✅ Cargar el carrito si ya tiene productos almacenados
    actualizarCarrito();
});
