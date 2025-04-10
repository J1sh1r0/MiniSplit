// Inicializa Stripe con tu clave pública (desde .env)
const stripe = Stripe('{{ env("STRIPE_KEY") }}');

document.getElementById('pagarStripe').addEventListener('click', async function () {
    const form = document.getElementById('checkoutForm');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    const data = {
        name: document.getElementById('name').value,
        last_name: document.getElementById('last_name').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        address: document.getElementById('address').value,
        number: document.getElementById('number').value,
        colonia: document.getElementById('colonia').value,
        no_interior: document.getElementById('no_interior').value,
        city: document.getElementById('city').value,
        state: document.getElementById('state').value,
        zip: document.getElementById('zip').value,
        is_apartment: document.getElementById('is_apartment').value === 'yes' ? 1 : 0,
        is_technician: document.getElementById('is_technician').value === 'yes' ? 1 : 0,
        requires_invoice: document.getElementById('requires_invoice').value === 'yes' ? 1 : 0,
        items: JSON.stringify(carrito),
        total: calcularTotal()
    };

    if (data.requires_invoice) {
        data.invoice_rfc = document.getElementById('invoice_rfc').value;
        data.invoice_name = document.getElementById('invoice_name').value;
        data.invoice_regimen = document.getElementById('invoice_regimen').value;
        data.invoice_cfdi_use = document.getElementById('invoice_cfdi_use').value;
        data.invoice_street = document.getElementById('invoice_street').value;
        data.invoice_number = document.getElementById('invoice_number').value;
        data.invoice_interior = document.getElementById('invoice_interior').value;
        data.invoice_colonia = document.getElementById('invoice_colonia').value;
        data.invoice_city = document.getElementById('invoice_city').value;
        data.invoice_state = document.getElementById('invoice_state').value;
        data.invoice_zip = document.getElementById('invoice_zip').value;
        data.invoice_country = document.getElementById('invoice_country').value;
    }

    // Verifica si es técnico y si se subió el video
    if (data.is_technician && document.getElementById('verification_video').files.length === 0) {
        alert('Por favor, sube un video mostrando tu herramienta de trabajo para continuar.');
        return; // Detiene el proceso si no hay video
    }

    // Subir el video si es necesario
    if (data.is_technician && document.getElementById('verification_video').files.length > 0) {
        const tempFormData = new FormData();
        tempFormData.append('verification_video', document.getElementById('verification_video').files[0]);

        await fetch('/guardar-video-temp', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: tempFormData
        });
    }

    // Después de la validación, proceder con la solicitud de pago
    fetch('/checkout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(data => {
            if (data.url) {
                window.location.href = data.url; // Redirige al checkout de Stripe
            }
        })
        .catch(error => console.error('❌ Error al procesar el pago con Stripe:', error));
});



// document.getElementById('pagarStripe').addEventListener('click', function() {
//     fetch('/checkout', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//         },
//         body: JSON.stringify({
//             total: calcularTotal() // Obtiene el total desde el carrito
//         })
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.error) {
//             console.error('Error:', data.error);
//             alert('Error al procesar el pago: ' + data.error);
//         } else if (data.sessionId) {
//             // Redirige al checkout de Stripe usando el sessionId
//             return stripe.redirectToCheckout({ sessionId: data.sessionId });
//         }
//     })
//     .catch(error => {
//         console.error('❌ Error al procesar el pago con Stripe:', error);
//         alert('Error al conectar con Stripe. Por favor, intenta nuevamente.');
//     });
// });

function toggleInterior() {
    let isApartment = document.getElementById('is_apartment').value;
    let interiorDiv = document.getElementById('interiorDiv');
    if (isApartment === 'yes') {
        interiorDiv.style.display = 'block'; // Muestra
    } else {
        interiorDiv.style.display = 'none'; // Oculta
    }
}

function cerrarModalResumen() {
    document.getElementById('modal-resumen').style.display = 'none';
}

function abrirModalResumen() {
    const form = document.getElementById('checkoutForm');

    // Verifica la validez de los inputs requeridos
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    let resumen = document.getElementById('order-summary');
    resumen.innerHTML = ''; // Limpiar contenido previo

    if (Object.keys(carrito).length === 0) {
        alert('Tu carrito está vacío. Agrega productos antes de continuar.');
        return;
    }

    let total = calcularTotal(); // Calculamos el total antes de mostrarlo

    Object.keys(carrito).forEach(producto => {
        let item = document.createElement('div');
        item.innerHTML = `
            <p><strong>${productos[producto].nombre}</strong> (x${carrito[producto]})</p>
            <img src="${productos[producto].imagen}" width="80px" height="50px">
            <hr>
        `;
        resumen.appendChild(item);
    });

    // Agregar el total de la compra
    let totalElement = document.createElement('p');
    totalElement.innerHTML = `<strong>Total: $${total} MXN</strong>`;
    totalElement.style.fontSize = "18px";
    totalElement.style.color = "black";
    resumen.appendChild(totalElement);

    // 🔹 Cerrar el modal de información antes de abrir el de resumen
    document.getElementById('checkoutModal').style.display = 'none';

    // 🔹 Verificar que el modal de resumen existe antes de mostrarlo
    const modalResumen = document.getElementById('modal-resumen');
    if (!modalResumen) {
        console.error("❌ Error: No se encontró el modal de resumen.");
        return;
    }
    modalResumen.style.display = 'block';

    // // 🔹 Verificar que el contenedor de PayPal existe antes de renderizar el botón
    // const paypalContainer = document.getElementById('paypal-button-container');
    // if (!paypalContainer) {
    //     console.error("❌ Error: No se encontró el contenedor de PayPal.");
    //     return;
    // }

    // // Limpiar antes de renderizar solo si no hay un botón ya cargado
    // if (!paypalContainer.hasChildNodes()) {
    //     paypalContainer.innerHTML = '';

    //     paypal.Buttons({
    //         createOrder: function (data, actions) {
    //             return actions.order.create({
    //                 purchase_units: [{ amount: { value: total } }],
    //             });
    //         },
    //         onApprove: function (data, actions) {
    //             return actions.order.capture().then(function (details) {
    //                 console.log("✅ Pago aprobado:", details);
    //                 procesarCompra();
    //                 cerrarModalResumen();
    //                 cerrarModal();
    //             });
    //         },
    //         onError: function (err) {
    //             console.error("❌ Error en PayPal:", err);
    //         }
    //     }).render('#paypal-button-container');
    // }
}

// ✅ Función para abrir el modal
function abrirModal() {
    document.getElementById('checkoutModal').style.display = 'flex';
}

// ❌ Función para cerrar el modal
function cerrarModal() {
    const modalResumen = document.getElementById('modal-resumen');
    if (modalResumen) {
        modalResumen.style.display = 'none';
    }
    document.getElementById('checkoutModal').style.display = 'none';
}

// 👷‍♂️ Mostrar sección si el usuario es técnico
function mostrarSeccionTecnico() {
    let isTechnician = document.getElementById('is_technician').value;
    let section = document.getElementById('technicianSection');
    section.style.display = (isTechnician === 'yes') ? 'block' : 'none';
}

document.getElementById('requires_invoice').addEventListener('change', function () {
    const invoiceSection = document.getElementById('invoiceFields');
    if (this.value === 'yes') {
        invoiceSection.style.display = 'block';
        document.getElementById('invoice_rfc').required = true;
        document.getElementById('invoice_name').required = true;
        document.getElementById('invoice_regimen').required = true;
        document.getElementById('invoice_cfdi_use').required = true;
        document.getElementById('invoice_street').required = true;
        document.getElementById('invoice_number').required = true;
        document.getElementById('invoice_colonia').required = true;
        document.getElementById('invoice_city').required = true;
        document.getElementById('invoice_state').required = true;
        document.getElementById('invoice_zip').required = true;
        document.getElementById('invoice_country').required = true;
    } else {
        invoiceSection.style.display = 'none';
        // Quitar required
        document.getElementById('invoice_rfc').required = false;
        document.getElementById('invoice_name').required = false;
        document.getElementById('invoice_regimen').required = false;
        document.getElementById('invoice_cfdi_use').required = false;
        document.getElementById('invoice_street').required = false;
        document.getElementById('invoice_number').required = false;
        document.getElementById('invoice_colonia').required = false;
        document.getElementById('invoice_city').required = false;
        document.getElementById('invoice_state').required = false;
        document.getElementById('invoice_zip').required = false;
        document.getElementById('invoice_country').required = false;
    }
});



function procesarCompra() {
    let formData = new FormData();
    formData.append('name', document.getElementById('name').value);
    formData.append('last_name', document.getElementById('last_name').value); // NUEVO
    formData.append('colonia', document.getElementById('colonia').value); // NUEVO
    formData.append('number', document.getElementById('number').value); // NUEVO
    formData.append('no_interior', document.getElementById('no_interior').value); // NUEVO

    formData.append('is_apartment', document.getElementById('is_apartment').value === 'yes' ? 1 : 0);
    formData.append('requires_invoice', document.getElementById('requires_invoice').value === 'yes' ? 1 : 0);

    formData.append('email', document.getElementById('email').value);
    formData.append('phone', document.getElementById('phone').value);
    formData.append('address', document.getElementById('address').value);
    formData.append('city', document.getElementById('city').value);
    formData.append('state', document.getElementById('state').value);
    formData.append('zip', document.getElementById('zip').value);
    formData.append('is_technician', document.getElementById('is_technician').value === 'yes' ? 1 : 0);
    formData.append('items', JSON.stringify(carrito));
    formData.append('requires_invoice', document.getElementById('requires_invoice').value === 'yes' ? 1 : 0);


    // formData.append('price', total);              // number
    // formData.append('paypal_order_id', paypalOrderId); // string

    let verificationVideo = document.getElementById('verification_video').files[0];
    if (verificationVideo) {
        formData.append('verification_video', verificationVideo);
    }

    // Si el usuario requiere factura, tomamos los campos
    if (document.getElementById('requires_invoice').value === 'yes') {
        formData.append('invoice_rfc', document.getElementById('invoice_rfc').value);
        formData.append('invoice_name', document.getElementById('invoice_name').value);
        formData.append('invoice_regimen', document.getElementById('invoice_regimen').value);
        formData.append('invoice_cfdi_use', document.getElementById('invoice_cfdi_use').value);
    }


    fetch('/compra', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Compra exitosa!',
                    text: 'En breve recibirá un correo con los datos de su compra.',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        confirmButton: 'btn-big' // 1) Clase personalizada para el botón
                    },
                    buttonsStyling: false // 2) Desactiva el estilo por defecto
                });

            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Error al procesar la compra.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        })
        .catch(error => console.error('Error:', error));

}


document.getElementById('checkoutModal').style.display = 'none';

function calcularTotal() {
    let total = 0;
    Object.keys(carrito).forEach(producto => {
        total += carrito[producto] * obtenerPrecio(producto);
    });
    return total.toFixed(2);
}

function confirmarCompra() {
    let resumen = document.getElementById('order-summary');
    resumen.innerHTML = ''; // Limpiar contenido previo

    Object.keys(carrito).forEach(producto => {
        let item = document.createElement('div');
        item.innerHTML = `
    <p><strong>${productos[producto].nombre}</strong> (x${carrito[producto]})</p>
    <img src="${productos[producto].imagen}" width="80px" height="50px">
    <hr>
`;
        resumen.appendChild(item);
    });

    // Agregar total de la compra
    let totalElement = document.createElement('p');
    totalElement.innerHTML = `<strong>Total: $${calcularTotal()} MXN</strong>`;
    totalElement.style.fontSize = "18px";
    totalElement.style.color = "black";
    resumen.appendChild(totalElement);

    // Mostrar modal
    document.getElementById('modal-resumen').style.display = 'block';

    // // Renderizar botón de PayPal
    // paypal.Buttons({
    //     createOrder: function (data, actions) {
    //         return actions.order.create({
    //             purchase_units: [{
    //                 amount: {
    //                     value: calcularTotal()
    //                 }
    //             }]
    //         });
    //     },
    //     onApprove: function (data, actions) {
    //         return actions.order.capture().then(function (details) {
    //             alert('Pago exitoso: ' + details.payer.name.given_name);
    //             procesarCompra();
    //         });
    //     }
    // }).render('#paypal-button-container');

}

function cerrarModalResumen() {
    document.getElementById('modal-resumen').style.display = 'none';
}

function calcularTotal() {
    let total = 0;
    Object.keys(carrito).forEach(producto => {
        total += carrito[producto] * obtenerPrecio(producto);
    });
    return total.toFixed(2);
}

function obtenerPrecio(producto) {
    const precios = {
        "Minisplit 1": 7599,
        "Minisplit 2": 14900
    };
    return precios[producto] || 0;
}
