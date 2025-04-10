
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
    const comprarYaBtn = document.getElementById("comprar-ya");

    if (!cartContainer || !cartItems || !comprarYaBtn) return;

    cartItems.innerHTML = "";

    Object.keys(carrito).forEach((producto) => {
        const cantidad = carrito[producto];

        const li = document.createElement("li");
        li.classList.add("cart-item");

        li.innerHTML = `
        <div class="cart-item-info">
          <img src="${productos[producto].imagen}" alt="${productos[producto].nombre}">
          <div>
            <div>${productos[producto].nombre}</div>
            <div class="cart-quantity">
              <button title="Disminuir cantidad" onclick="cambiarCantidad('${producto}', -1)">➖</button>
              <input type="number" min="1" value="${cantidad}" onchange="setCantidadManual('${producto}', this.value)">
              <button title="Aumentar cantidad" onclick="cambiarCantidad('${producto}', 1)">➕</button>
            </div>
          </div>
        </div>
      `;

        cartItems.appendChild(li);
    });

    cartContainer.style.display = Object.keys(carrito).length > 0 ? "block" : "none";
    comprarYaBtn.style.display = Object.keys(carrito).length > 0 ? "none" : "block";
}

function cambiarCantidad(producto, cambio) {
    if (carrito[producto]) {
        carrito[producto] += cambio;
        if (carrito[producto] < 1) {
            delete carrito[producto];
        }
        actualizarCarrito();
    }
}

function setCantidadManual(producto, nuevaCantidad) {
    const cantidad = parseInt(nuevaCantidad);
    if (!isNaN(cantidad) && cantidad >= 1) {
        carrito[producto] = cantidad;
        actualizarCarrito();
    }
}

function eliminarProducto(producto) {
    delete carrito[producto];
    actualizarCarrito();
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
