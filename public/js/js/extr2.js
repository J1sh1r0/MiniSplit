document.addEventListener("DOMContentLoaded", function () {
    console.log("✅ modal.js cargado correctamente");

    // Verificar si las variables globales existen antes de usarlas
    if (typeof carrito === "undefined") {
        console.error("❌ Error: La variable `carrito` no está definida.");
        return;
    }

    if (typeof productos === "undefined") {
        console.error("❌ Error: La variable `productos` no está definida.");
        return;
    }

    const checkoutModal = document.getElementById("checkoutModal");
    const modalResumen = document.getElementById("modal-resumen");
    const orderSummary = document.getElementById("order-summary");
    const paypalButtonContainer = document.getElementById("paypal-button-container");

    // ✅ Función para abrir el modal de compra
    function abrirModal() {
        if (checkoutModal) {
            checkoutModal.style.display = "flex";
        }
    }

    // ❌ Función para cerrar el modal
    function cerrarModal() {
        if (checkoutModal) {
            checkoutModal.style.display = "none";
        }
    }

    // ✅ Función para abrir el resumen de compra
    function abrirModalResumen() {
        if (!checkoutModal || !modalResumen || !orderSummary) return;

        const form = document.getElementById("checkoutForm");

        // Verifica la validez del formulario antes de mostrar el resumen
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        orderSummary.innerHTML = ""; // Limpiar contenido previo

        if (Object.keys(carrito).length === 0) {
            alert("Tu carrito está vacío. Agrega productos antes de continuar.");
            return;
        }

        let total = calcularTotal();

        Object.keys(carrito).forEach((producto) => {
            let item = document.createElement("div");
            item.innerHTML = `
                <p><strong>${productos[producto].nombre}</strong> (x${carrito[producto]})</p>
                <img src="${productos[producto].imagen}" width="80px" height="50px">
                <hr>
            `;
            orderSummary.appendChild(item);
        });

        // Mostrar el total
        let totalElement = document.createElement("p");
        totalElement.innerHTML = `<strong>Total: $${total} MXN</strong>`;
        totalElement.style.fontSize = "18px";
        totalElement.style.color = "black";
        orderSummary.appendChild(totalElement);

        modalResumen.style.display = "block";
        paypalButtonContainer.innerHTML = ""; // Limpiar botones previos

        // Renderizar botón de PayPal
        paypal.Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{ amount: { value: total } }],
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    procesarCompra();
                    cerrarModalResumen();
                    cerrarModal();
                });
            },
        }).render("#paypal-button-container");

        cerrarModal();
    }

    function cerrarModalResumen() {
        if (modalResumen) {
            modalResumen.style.display = "none";
        }
    }

    // 👷‍♂️ Mostrar sección si el usuario es técnico
    function mostrarSeccionTecnico() {
        const section = document.getElementById("technicianSection");
        const isTechnician = document.getElementById("is_technician")?.value;
        if (section) {
            section.style.display = isTechnician === "yes" ? "block" : "none";
        }
    }

    // ✅ Función para procesar la compra
    function procesarCompra() {
        let formData = new FormData();

        const requiredFields = [
            "name",
            "last_name",
            "colonia",
            "number",
            "no_interior",
            "email",
            "phone",
            "address",
            "city",
            "state",
            "zip",
            "is_apartment",
            "requires_invoice",
            "is_technician",
        ];

        requiredFields.forEach((field) => {
            const element = document.getElementById(field);
            if (element) {
                formData.append(field, element.value);
            }
        });

        formData.append("items", JSON.stringify(carrito));

        let verificationVideo = document.getElementById("verification_video")?.files[0];
        if (verificationVideo) {
            formData.append("verification_video", verificationVideo);
        }

        fetch("/compra", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Compra exitosa!",
                        text: "En breve recibirá un correo con los datos de su compra.",
                        confirmButtonText: "Aceptar",
                        customClass: {
                            confirmButton: "btn-big",
                        },
                        buttonsStyling: false,
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "Error al procesar la compra.",
                        icon: "error",
                        confirmButtonText: "Aceptar",
                    });
                }
            })
            .catch((error) => console.error("Error:", error));
    }

    function calcularTotal() {
        let total = 0;
        Object.keys(carrito).forEach((producto) => {
            total += carrito[producto] * obtenerPrecio(producto);
        });
        return total.toFixed(2);
    }

    function obtenerPrecio(producto) {
        const precios = {
            "Minisplit 1": 20,
            "Minisplit 2": 14900,
        };
        return precios[producto] || 0;
    }

    // ✅ Verificar eventos
    if (document.getElementById("requires_invoice")) {
        document.getElementById("requires_invoice").addEventListener("change", function () {
            const invoiceSection = document.getElementById("invoiceFields");
            if (this.value === "yes") {
                invoiceSection.style.display = "block";
            } else {
                invoiceSection.style.display = "none";
            }
        });
    }

    console.log("✅ modal.js configurado correctamente");
});
