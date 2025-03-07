<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta de Minisplits</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <!-- PayPal SDK -->
    <script
        src="https://www.paypal.com/sdk/js?client-id=AdeBl0mAJLAh2VnMXcB6-71gKE5G_rvBj0C_WrrseoEAv7ph_0FSbTxrgfSMFgNxi3fC6LDfK5pqEksp&currency=MXN">
    </script>
</head>

<body class="bg-gray-100 flex justify-center items-center h-screen p-4">

    <div class="flex max-w-4xl w-full bg-white rounded-xl shadow-lg overflow-hidden">

        <!-- Sección de formulario de compra (33%) -->
        <div class="max-w-29 bg-[#a298fcd5] text-white flex flex-col items-center justify-center p-6">

            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold">Finalizar Compra</h2>
            </div>

            <form id="payment-form" action="{{ route('register.customer') }}" method="POST"
                enctype="multipart/form-data" class="w-full space-y-4">
                @csrf

                <div class="flex gap-2">
                    <input type="text" name="name" placeholder="Nombre" class="p-3 rounded text-gray-800 w-1/2"
                        required>
                    <input type="text" name="last_name" placeholder="Apellido"
                        class="p-3 rounded text-gray-800 w-1/2" required>
                </div>

                <input type="email" name="email" placeholder="Correo Electrónico"
                    class="p-3 rounded text-gray-800 w-full" required>
                <input type="text" name="phone" placeholder="Teléfono" class="p-3 rounded text-gray-800 w-full"
                    required>

                <input type="text" name="address" placeholder="Dirección" class="p-3 rounded text-gray-800 w-full"
                    required>

                <div class="flex gap-2">
                    <input type="text" name="city" placeholder="Ciudad" class="p-3 rounded text-gray-800 w-1/3"
                        required>
                    <input type="text" name="state" placeholder="Estado" class="p-3 rounded text-gray-800 w-1/3"
                        required>
                    <input type="text" name="zip" placeholder="Código Postal"
                        class="p-3 rounded text-gray-800 w-1/3" required>
                </div>

                <div id="technician-fields" class="hidden">
                    <label class="block mb-2 font-medium">Video de verificación:</label>
                    <input type="file" name="verification_video" accept="video/*"
                        class="w-full p-2 rounded bg-white text-gray-700">
                </div>

                <!-- Botón de PayPal -->
                <div id="paypal-button-container" class="w-full"></div>
            </form>



            <span class="mt-4 cursor-pointer underline" id="toggleTechnician">¿Eres técnico?</span>
        </div>

        <!-- Sección para productos (67%) -->
        <div class="w-2/3 p-8 overflow-y-auto">
            <h2 class="text-xl font-bold mb-4">Productos Seleccionados</h2>

            <!-- Aquí debes insertar tus productos dinámicamente con PHP o JS -->
            <div class="space-y-4">
                <div class="p-4 rounded shadow border">
                    <h3 class="font-bold">Minisplit CHI-R32-12K-110</h3>
                    <p>1 tonelada, 220V, Frío/Calor, Inverter</p>
                    <span class="font-bold">$10,000 MXN</span>
                </div>

                <div class="p-4 rounded shadow border">
                    <h3 class="font-bold">Minisplit CHI-R32-24K-220</h3>
                    <p>2 toneladas, 220V, Frío/Calor, Inverter</p>
                    <span class="font-bold">$18,500 MXN</span>
                </div>
            </div>
        </div>

    </div>

    <script>
        let isTechnician = false;
        const toggleTechnician = document.getElementById('toggleTechnician');
        const technicianFields = document.getElementById('technician-fields');

        toggleTechnician.addEventListener('click', () => {
            isTechnician = !isTechnician;
            technicianFields.classList.toggle('hidden');
            toggleTechnician.textContent = isTechnician ? 'Comprar como cliente' : '¿Eres técnico?';
        });

        paypal.Buttons({
            fundingSource: paypal.FUNDING.PAYPAL,

            createOrder(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '28500'
                        }
                    }]
                });
            },

            onApprove(data, actions) {
                return actions.order.capture().then(details => {
                    alert('Pago completado por: ' + details.payer.name.given_name);

                    const form = document.getElementById('payment-form');
                    const url = isTechnician ? "{{ route('register.technician') }}" :
                        "{{ route('register.customer') }}";

                    const formData = new FormData(form);

                    fetch(url, {
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData
                        })
                        .then(response => {
                            if (response.ok) {
                                window.location.href = "{{ route('payment.success') }}";
                            } else {
                                response.json().then(errors => {
                                    alert('Error en validación: ' + JSON.stringify(errors));
                                });
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            }
        }).render('#paypal-button-container');
    </script>
    <style>
        /* Ajuste para botones PayPal */
        #paypal-button-container .paypal-buttons {
            width: 100% !important;
        }
    </style>

</body>

</html>
