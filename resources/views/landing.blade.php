<!DOCTYPE html>
<html lang="es">

<head>
    @include('components.cart')
    @include('components.modal')
    @include('components.products')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INXPLIT</title>

    <!-- Cargar librerías externas -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    <script
        src="https://www.paypal.com/sdk/js?client-id=AVfyUgSurCNV0md7yLddN8uUk2PNktWedJE2RAjiSercq66qzOORbJl5P0riBxugUlSwtc2WeN1jMGQQ&currency=MXN">
    </script>

    <!-- Cargar archivos de estilos correctamente -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">

    <!-- Cargar archivos JavaScript correctamente -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/landing.js') }}" defer></script>
    <script src="{{ asset('js/cart.js') }}" defer></script>
    <script src="{{ asset('js/modal.js') }}" defer></script>
    <script src="{{ asset('js/menu.js') }}" defer></script>

    <!-- Meta CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <button id="comprar-ya">Comprar ahora</button>

    <!-- 🛒 Carrito de Compras Mejorado con Imágenes -->
    <div id="cart-container">
        <h3>🛒 Carrito de Compras</h3>
        <ul id="cart-items"></ul>
        <button id="finalizar-compra" onclick="abrirModal()">Finalizar Compra</button>

    </div>
    <!-- Nueva Modal: Resumen del Pedido -->
    <div id="modal-resumen" class="modal">
        <div class="modal-content">
            <h2>Resumen de Compra</h2>
            <div id="order-summary"></div>
            <div id="paypal-button-container"></div> <!-- Aquí se cargará el botón de PayPal -->
            <button class="btn btn-danger" onclick="cerrarModalResumen()">Cancelar</button>
        </div>
    </div>


    <!-- 🛒 Modal de Finalizar Compra -->
    <div id="checkoutModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="cerrarModal()">&times;</span>
            <h2>Completa tu Información</h2>

            <form id="checkoutForm" enctype="multipart/form-data">
                <!-- Tres columnas: Nombre, Apellido, Teléfono -->
                <div class="form-group-3">
                    <div>
                        <label>Nombre:</label>
                        <input type="text" id="name" placeholder="Tu nombre" required>
                    </div>
                    <div>
                        <label>Apellido:</label>
                        <input type="text" id="last_name" placeholder="Tu apellido" required>
                    </div>
                    <div>
                        <label>Teléfono:</label>
                        <input type="text" id="phone" placeholder="Tu teléfono" required>
                    </div>
                </div>

                <!-- Tres columnas: Correo, ¿Técnico?, ¿Es departamento? -->
                <div class="form-group-3">
                    <div>
                        <label>Correo:</label>
                        <input type="email" id="email" placeholder="tucorreo@example.com" required>
                    </div>
                    <div>
                        <label>¿Técnico?</label>
                        <select id="is_technician" onchange="mostrarSeccionTecnico()">
                            <option value="no">No</option>
                            <option value="yes">Sí</option>
                        </select>
                    </div>
                    <div>
                        <label>¿Es departamento?</label>
                        <select id="is_apartment" onchange="toggleInterior()">
                            <option value="no">No</option>
                            <option value="yes">Sí</option>
                        </select>
                    </div>
                </div>

                <!-- Tres columnas: Calle, Número, Colonia -->
                <div class="form-group-3">
                    <div>
                        <label>Calle:</label>
                        <input type="text" id="address" placeholder="Calle" required>
                    </div>
                    <div>
                        <label>Núm. Calle:</label>
                        <input type="text" id="number" placeholder="123" required>
                    </div>
                    <div>
                        <label>Colonia:</label>
                        <input type="text" id="colonia" placeholder="Tu colonia" required>
                    </div>
                </div>

                <!-- Tres columnas: Ciudad, Estado, País -->
                <div class="form-group-3">
                    <div>
                        <label>Ciudad:</label>
                        <input type="text" id="city" placeholder="Ciudad" required>
                    </div>
                    <div>
                        <label>Estado:</label>
                        <input type="text" id="state" placeholder="Estado" required>
                    </div>
                    <div>
                        <label>País:</label>
                        <input type="text" id="country" placeholder="México" required>
                    </div>
                </div>

                <!-- Dos columnas: Código Postal y "¿Requiere factura?" -->
                <div class="form-group">
                    <div>
                        <label>Código Postal:</label>
                        <input type="text" id="zip" placeholder="00000" required>
                    </div>
                    <div>
                        <label>¿Requiere factura?</label>
                        <select id="requires_invoice">
                            <option value="no">No</option>
                            <option value="yes">Sí</option>
                        </select>
                    </div>
                </div>

                <!-- Sección que se mostrará sólo si requires_invoice = yes -->
                <div id="invoiceFields" style="display: none;">
                    <div class="form-group">
                        <label>RFC:</label>
                        <input type="text" id="invoice_rfc" placeholder="XAXX010101000">
                    </div>
                    <div class="form-group">
                        <label>Razón Social / Nombre Receptor:</label>
                        <input type="text" id="invoice_name" placeholder="Tu razón social o nombre">
                    </div>
                    <div class="form-group">
                        <label>Régimen Fiscal:</label>
                        <input type="text" id="invoice_regimen" placeholder="Régimen Fiscal">
                    </div>
                    <div class="form-group">
                        <label>Uso de CFDI:</label>
                        <input type="text" id="invoice_cfdi_use" placeholder="G01, D01, etc.">
                    </div>
                    <!-- Dirección de facturación -->
                    <h3>Dirección de Facturación</h3>
                    <div class="form-group">
                        <label>Calle (fact.):</label>
                        <input type="text" id="invoice_street" placeholder="Calle para factura">
                    </div>
                    <div class="form-group">
                        <label>Núm. (fact.):</label>
                        <input type="text" id="invoice_number" placeholder="123">
                    </div>
                    <div class="form-group">
                        <label>Interior (fact.):</label>
                        <input type="text" id="invoice_interior" placeholder="Ej. Dpto 2">
                    </div>
                    <div class="form-group">
                        <label>Colonia (fact.):</label>
                        <input type="text" id="invoice_colonia" placeholder="Tu colonia">
                    </div>
                    <div class="form-group">
                        <label>Ciudad (fact.):</label>
                        <input type="text" id="invoice_city" placeholder="Ciudad de facturación">
                    </div>
                    <div class="form-group">
                        <label>Estado (fact.):</label>
                        <input type="text" id="invoice_state" placeholder="Estado de facturación">
                    </div>
                    <div class="form-group">
                        <label>C.P. (fact.):</label>
                        <input type="text" id="invoice_zip" placeholder="00000">
                    </div>
                    <div class="form-group">
                        <label>País (fact.):</label>
                        <input type="text" id="invoice_country" placeholder="México">
                    </div>
                </div>

                <!-- Número Interior (se oculta cuando "¿Es departamento?" es "No") -->
                <div class="form-group" id="interiorDiv" style="display: none;">
                    <div>
                        <label>Número Interior:</label>
                        <input type="text" id="no_interior" placeholder="Ej. Dpto 201">
                    </div>
                </div>

                <!-- Sección para técnicos (oculta si "¿Técnico?" es "No") -->
                <div id="technicianSection" class="hidden">
                    <h3>Confirmación Técnica</h3>
                    <label>Sube un video mostrando tu herramienta de trabajo:</label>
                    <input type="file" id="verification_video" accept="video/*">
                </div>


                <!-- Botones -->
                <div class="form-actions">
                    <button type="button" onclick="abrirModalResumen()">Confirmar Compra</button>
                    <button type="button" class="cancel-btn" onclick="cerrarModal()">Cancelar</button>
                </div>
            </form>
        </div>
    </div>


    <!-- 🔹 Barra de Navegación Mejorada -->
    <header id="navbar"
        class="fixed top-0 w-full z-50 bg-gradient-to-r from-[#072BF2] to-[#4B75F2] shadow-lg backdrop-blur-lg transition-all duration-300">
        <div class="container mx-auto flex justify-between items-center py-3 px-8">

            <!-- 🔹 Logo -->
            <h1 class="text-2xl font-bold text-white cursor-pointer tracking-wide">INXPLIT</h1>

            <!-- 🔹 Menú de Navegación -->
            <nav class="hidden md:flex flex-col md:flex-row md:space-x-6 text-white">
                <a href="#bienvenida" class="nav-link">Inicio</a>
                <a href="#videos" class="nav-link">Videos Destacados</a>
                <a href="#beneficios-minisplit" class="nav-link">Beneficios</a>
                <a href="#caracteristicas" class="nav-link">Características</a>
                <a href="#productos" class="nav-link">Minisplits</a>
                <a href="#paquetes-tecnicos" class="nav-link">Paquetes Técnicos</a>
                <a href="#contacto" class="nav-link">Contacto</a>
                <!-- Icono del carrito -->
                <div id="cart-container" class="relative cursor-pointer">
                    <button id="cart-button" class="text-white text-2xl">
                        🛒 <span id="cart-count" class="bg-red-500 text-white text-sm px-2 py-1 rounded-full">0</span>
                    </button>
                </div>
            </nav>

            <!-- 🔹 Menú Hamburguesa para móviles -->
            <div class="md:hidden flex items-center">
                <button id="menu-toggle" class="text-3xl text-white focus:outline-none">☰</button>
            </div>
        </div>
    </header>

    <!-- 🔹 Menú móvil -->
    <div id="mobile-menu"
        class="hidden fixed inset-0 bg-black bg-opacity-90 flex flex-col justify-center items-center text-white space-y-6 text-2xl overflow-y-auto">
        <button id="close-menu" class="absolute top-5 right-5 text-3xl">✖</button>
        <a href="#bienvenida" class="nav-link">Inicio</a>
        <a href="#videos" class="nav-link">Videos Destacados</a>
        <a href="#beneficios-minisplit" class="nav-link">Beneficios</a>
        <a href="#caracteristicas" class="nav-link">Características</a>
        <a href="#productos" class="nav-link">Minisplits</a>
        <a href="#paquetes-tecnicos" class="nav-link">Paquetes Técnicos</a>
        <a href="#contacto" class="nav-link">Contacto</a>
    </div>

    <!-- 🔹 Secciones -->
    <main class="pt-24">
        <section id="bienvenida" data-aos="fade-up">
            <div class="content">
                <h2 class="text-6xl font-bold" data-aos="fade-up">Bienvenidos</h2>
                <p class="mt-4 text-lg" data-aos="fade-up" data-aos-delay="200">
                    Disfruta del clima ideal en todo momento con nuestros Minisplits.
                </p>
            </div>
        </section>

        <!-- ✅ Sección de Videos Destacados -->
        <section id="videos" class="py-16 bg-gray-100 text-black">
            <div class="container mx-auto text-center">
                <h2 class="text-4xl font-bold text-[#072BF2] mb-8" data-aos="fade-up">Videos Destacados</h2>
                <div class="relative w-full max-w-5xl mx-auto" data-aos="zoom-in">
                    <div id="videoCarousel" class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li class="splide__slide">
                                    <div class="video-container relative">
                                        <iframe width="100%" height="500"
                                            src="https://www.youtube.com/embed/6c_dtwRVQNo?start=199"
                                            allowfullscreen></iframe>
                                        <div class="video-overlay"></div>
                                    </div>
                                </li>
                                <li class="splide__slide">
                                    <div class="video-container relative">
                                        <iframe width="100%" height="500"
                                            src="https://www.youtube.com/embed/E2MXFU7SNAI" allowfullscreen></iframe>
                                        <div class="video-overlay"></div>
                                    </div>
                                </li>
                                <li class="splide__slide">
                                    <div class="video-container relative">
                                        <iframe width="100%" height="500"
                                            src="https://www.youtube.com/embed/YqutiGHpQpE?start=1"
                                            allowfullscreen></iframe>
                                        <div class="video-overlay"></div>
                                    </div>
                                </li>
                                <li class="splide__slide">
                                    <div class="video-container relative">
                                        <iframe width="100%" height="500"
                                            src="https://www.youtube.com/embed/PDR0STxMQ-Q" allowfullscreen></iframe>
                                        <div class="video-overlay"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ✅ Sección Beneficios de los Minisplits -->
        <section id="beneficios-minisplit" class="py-20 text-center bg-gray-900 text-white">
            <h2 class="text-4xl font-bold text-white mb-8" data-aos="fade-up">Beneficios de Nuestros Minisplits</h2>

            <div class="container mx-auto grid md:grid-cols-2 gap-10">
                <!-- Imagen de Auto-limpieza -->
                <div data-aos="fade-right">
                    <img src="{{ asset('img/auto-limpieza.png') }}" alt="Auto-limpieza del Minisplit"
                        class="w-full rounded-lg shadow-lg">
                </div>

                <!-- Imagen de Características Técnicas -->
                <div data-aos="fade-left">
                    <img src="{{ asset('img/caracteristicas-minisplit.png') }}" alt="Detalles Técnicos del Minisplit"
                        class="w-full rounded-lg shadow-lg">
                </div>
            </div>

            <div class="container mx-auto mt-10" data-aos="fade-up">
                <img src="{{ asset('img/compatibilidad-alexa-google.png') }}"
                    alt="Compatibilidad Alexa y Google Home" class="w-full rounded-lg shadow-lg">
            </div>
        </section>

        <!-- ✅ Sección de Características -->
        <section id="caracteristicas" class="py-20 text-center bg-white text-black">
            <h2 class="text-4xl font-bold text-[#072BF2]" data-aos="fade-up">Características Innovadoras de AUFIT
            </h2>
            <div class="container mx-auto grid md:grid-cols-3 gap-8 mt-8">
                <!-- Tarjeta 1: Tecnología Inverter -->
                <div
                    class="feature-card bg-gradient-to-b from-white to-gray-100 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-transform transform hover:-translate-y-2 flex flex-col items-center text-center">
                    <img src="{{ asset('img/icono-inverter.png') }}" alt="Inverter" class="w-20 h-20">
                    <h3 class="text-2xl font-bold mt-4 text-[#072BF2]">Tecnología Inverter</h3>
                    <p class="mt-2 text-gray-700">Ahorra hasta un 60% en consumo eléctrico y proporciona un
                        enfriamiento
                        más eficiente.</p>
                </div>

                <!-- Tarjeta 2: Auto Limpieza -->
                <div
                    class="feature-card bg-gradient-to-b from-white to-gray-100 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-transform transform hover:-translate-y-2 flex flex-col items-center text-center">
                    <img src="{{ asset('img/icono-autolimpieza.png') }}" alt="Auto Limpieza" class="w-20 h-20">
                    <h3 class="text-2xl font-bold mt-4 text-[#072BF2]">Auto Limpieza</h3>
                    <p class="mt-2 text-gray-700">Previene la acumulación de bacterias y moho, garantizando aire
                        limpio
                        y saludable.</p>
                </div>

                <!-- Tarjeta 3: Purificación de Aire -->
                <div
                    class="feature-card bg-gradient-to-b from-white to-gray-100 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-transform transform hover:-translate-y-2 flex flex-col items-center text-center">
                    <img src="{{ asset('img/icono-filtro.png') }}" alt="Purificación" class="w-20 h-20">
                    <h3 class="text-2xl font-bold mt-4 text-[#072BF2]">Filtro de Aire Antibacterial</h3>
                    <p class="mt-2 text-gray-700">Filtra partículas PM2.5, eliminando bacterias y virus para un
                        aire
                        más
                        saludable.</p>
                </div>
            </div>

            <div class="container mx-auto mt-12 p-8 bg-gradient-to-r from-[#B3BDF2] to-white rounded-lg shadow-lg"
                data-aos="fade-up">
                <h3 class="text-3xl font-bold text-center text-[#072BF2]">Características Destacadas</h3>
                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div class="flex items-start space-x-4">
                        <img src="{{ asset('img/icono-inteligente.png') }}" class="w-12 h-12">
                        <p><strong>Control Inteligente:</strong> Compatible con Alexa y Google Home.</p>
                    </div>
                    <div class="flex items-start space-x-4">
                        <img src="{{ asset('img/icono-eco.png') }}" class="w-12 h-12">
                        <p><strong>Modo Eco:</strong> Reduce el consumo de energía en 20%.</p>
                    </div>
                    <div class="flex items-start space-x-4">
                        <img src="{{ asset('img/icono-rapidez.png') }}" class="w-12 h-12">
                        <p><strong>Modo Turbo:</strong> Enfriamiento rápido en 30 segundos.</p>
                    </div>
                    <div class="flex items-start space-x-4">
                        <img src="{{ asset('img/icono-silencioso.png') }}" class="w-12 h-12">
                        <p><strong>Super Silencioso:</strong> Disfruta de un ambiente relajado con solo 23 dB.</p>
                    </div>
                    <div class="flex items-start space-x-4">
                        <img src="{{ asset('img/icono-compresor.png') }}" class="w-12 h-12">
                        <p><strong>Compresor de Alta Calidad:</strong> Bajo consumo y máxima eficiencia.</p>
                    </div>
                    <div class="flex items-start space-x-4">
                        <img src="{{ asset('img/icono-instalacion.png') }}" class="w-12 h-12">
                        <p><strong>Instalación Rápida:</strong> Sistema de conexión fácil y rápida.</p>
                    </div>
                </div>
            </div>

        </section>

        <!-- ✅ Sección de Minisplits -->
        <section id="productos" class="py-20 bg-white text-black">
            <div class="container mx-auto text-center">
                <h2 class="text-4xl font-bold text-[#072BF2]" data-aos="fade-up">Nuestros Minisplits</h2>
                <p class="mt-2 text-lg text-gray-700" data-aos="fade-up" data-aos-delay="100">
                    Encuentra el minisplit ideal para tu hogar o negocio con tecnología inverter, eficiencia
                    energética
                    y control inteligente.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 md:gap-12 mt-12">
                    <!-- ✅ Minisplit 1 Tonelada -->
                    <div class="bg-gray-100 p-6 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition duration-300 relative"
                        data-aos="fade-right">
                        <img src="{{ asset('img/aufit-minisplit-1ton.jpg') }}" alt="Minisplit 1 Tonelada"
                            class="w-full h-auto sm:h-60 object-cover rounded-lg">
                        <h3 class="text-2xl font-bold text-[#072BF2] mt-4 text-center sm:text-left">
                            AUFIT CHI-R32-12K-110/220
                        </h3>
                        <p class="text-gray-700 mt-2 text-lg text-center sm:text-left">
                            1 Tonelada | Frío/Calor | Inverter | 110V/220V
                        </p>

                        <ul class="mt-4 text-left text-gray-700 space-y-2 text-sm sm:text-base">
                            <li>✔️ Modulo WIFI</li>
                            <li>✔️ Auto Limpieza</li>
                            <li>✔️ Auto Diagnostico</li>
                            <li>✔️ Modo: Frío y Calor </li>
                            <li>✔️ App Movil Gratuita</li>
                            <li>✔️ Tecnología Inverter</li>
                            <li>✔️ Alta eficiencia energética</li>
                            <li>✔️ Filtro de aire antibacteriano</li>
                            <li>✔️ Eco friendly(Ahorro de Energia)</li>
                            <li>✔️ Integración: Alexa y Google Home</li>
                            <li>✔️ Control remoto vía App y compatible con Alexa/Google Home</li>
                            <li>✔️ Garantía de 3 años con SYSCOM</li>
                            <li>✔️ Garantía de unidad completa de 2 años</li>
                            <li>✔️ Garantía del Compresor de 5 años</li>
                            <li>✔️ Garantía de restos de Componentes de 2 años</li>
                        </ul>

                        <p class="text-xl font-bold text-[#072BF2] mt-4">Precio en oferta: <span
                                class="text-green-600">$7,599</span></p>

                        <button onclick="agregarAlCarrito('Minisplit 1')"
                            class="mt-4 w-full py-4 text-lg bg-[#072BF2] text-white font-semibold rounded-lg
                                shadow-md hover:bg-[#4B75F2] hover:scale-105 transition active:scale-95">
                            🛒 Comprar Ahora
                        </button>
                    </div>

                    <!-- ✅ Minisplit 2 Toneladas -->
                    <div class="bg-gray-100 p-6 rounded-xl shadow-lg hover:shadow-2xl transform hover:scale-105 transition duration-300 relative"
                        data-aos="fade-left">
                        <img src="{{ asset('img/aufit-minisplit-2ton.jpg') }}" alt="Minisplit 2 Tonelada"
                            class="w-full h-auto sm:h-60 object-cover rounded-lg">
                        <h3 class="text-2xl font-bold text-[#072BF2] mt-4 text-center sm:text-left">
                            AUFIT CHI-R32-24K-220
                        </h3>
                        <p class="text-gray-700 mt-2 text-lg text-center sm:text-left">
                            2 Toneladas | Frío/Calor | Inverter | 220V
                        </p>


                        <ul class="mt-4 text-left text-gray-700 space-y-2 text-sm sm:text-base">
                            <li>✔️ Modulo WIFI</li>
                            <li>✔️ Auto Limpieza</li>
                            <li>✔️ Auto Diagnostico</li>
                            <li>✔️ Modo: Frío y Calor </li>
                            <li>✔️ App Movil Gratuita</li>
                            <li>✔️ Tecnología Inverter</li>
                            <li>✔️ Alta eficiencia energética</li>
                            <li>✔️ Filtro de aire antibacteriano</li>
                            <li>✔️ Eco friendly(Ahorro de Energia)</li>
                            <li>✔️ Integración: Alexa y Google Home</li>
                            <li>✔️ Control remoto vía App y compatible con Alexa/Google Home</li>
                            <li>✔️ Garantía de 3 años con SYSCOM</li>
                            <li>✔️ Garantía de unidad completa de 2 años</li>
                            <li>✔️ Garantía del Compresor de 5 años</li>
                            <li>✔️ Garantía de restos de Componentes de 2 años</li>
                        </ul>

                        <p class="text-xl font-bold text-[#072BF2] mt-4">Precio en oferta: <span
                                class="text-green-600">$14,900</span></p>

                        <button onclick="agregarAlCarrito('Minisplit 2')"
                            class="mt-4 w-full py-4 text-lg bg-[#072BF2] text-white font-semibold rounded-lg
                                shadow-md hover:bg-[#4B75F2] hover:scale-105 transition active:scale-95">
                            🛒 Comprar Ahora
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- ✅ Sección Paquetes para Técnicos -->
        <section id="paquetes-tecnicos" class="py-20 text-center bg-gray-50">
            <h2 class="text-4xl font-bold text-[#072BF2]" data-aos="fade-up">Paquetes para Técnicos</h2>

            <!-- 🔹 Confirmación de Video -->
            <div
                class="container mx-auto mt-6 max-w-3xl bg-white p-6 rounded-xl shadow-lg transition hover:shadow-2xl">
                <h3 class="text-2xl font-semibold text-gray-800">Confirmación Requerida</h3>
                <p class="text-gray-600 mt-2">
                    Para acceder a los beneficios, debes subir un video al momento de la compra, mostrando tu equipo de
                    trabajo
                    (bombas de vacío, manómetros, herramientas, etc.).
                </p>
            </div>

            <div class="container mx-auto grid md:grid-cols-2 gap-10 mt-12">
                <!-- ✅ Paquete 2 Equipos -->
                <div class="benefit-card relative p-8 rounded-xl shadow-lg transition transform hover:-translate-y-2 hover:shadow-2xl bg-gradient-to-b from-white to-gray-100"
                    data-aos="fade-right">
                    <h3 class="text-3xl font-bold text-[#072BF2]">Paquete 2 Equipos</h3>
                    <p class="mt-4 text-lg text-gray-700">Obtienes los siguientes beneficios:</p>
                    <ul class="mt-4 text-left text-gray-600">
                        <li>✅ Gratis 1 sacabocado para pared ($500)</li>
                        <li>🎟 Entra en rifa de 1 recuperadora de refrigerante ($13,000)</li>
                    </ul>
                    <button
                        class="mt-4 w-full py-4 text-lg bg-[#072BF2] text-white font-semibold rounded-lg shadow-md hover:bg-[#4B75F2] hover:scale-105 transition active:scale-95">
                        🛒 Comprar Ahora
                    </button>
                </div>

                <!-- ✅ Paquete 3 Equipos -->
                <div class="benefit-card relative p-8 rounded-xl shadow-lg transition transform hover:-translate-y-2 hover:shadow-2xl bg-gradient-to-b from-white to-gray-100"
                    data-aos="fade-left">
                    <h3 class="text-3xl font-bold text-[#072BF2]">Paquete 3 Equipos</h3>
                    <p class="mt-4 text-lg text-gray-700">Obtienes los siguientes beneficios:</p>
                    <ul class="mt-4 text-left text-gray-600">
                        <li>✅ Gratis 2 sacabocados para pared ($1000)</li>
                        <li>🎟 Entra en rifa de 1 recuperadora de refrigerante ($9000)</li>
                        <li>🎟 Entra en rifa de 1 kit de manómetros especiales ($1900)</li>
                        <li>🎟 Entra en rifa de 1 kit de herramientas para tubería ($1500)</li>
                    </ul>
                    <button
                        class="mt-4 w-full py-4 text-lg bg-[#072BF2] text-white font-semibold rounded-lg shadow-md hover:bg-[#4B75F2] hover:scale-105 transition active:scale-95">
                        🛒 Comprar Ahora
                    </button>
                </div>
            </div>
        </section>

        <!-- ✅ Sección Mejorada de Contacto -->
        <section id="contacto" class="h-screen flex items-center justify-center relative overflow-hidden">
            <!-- Fondo Animado -->
            <div id="background-animation" class="absolute inset-0 z-0"></div>

            <!-- Contenedor Principal -->
            <div
                class="relative z-10 max-w-lg w-full bg-white bg-opacity-10 backdrop-blur-lg rounded-xl shadow-2xl p-8 animate-fade-in">
                <h2 class="text-3xl font-bold text-center text-white drop-shadow-lg">¿Tienes dudas o cotizaciones?
                </h2>
                <p class="text-center text-gray-200 mt-2">Déjanos tu información y te responderemos en breve.</p>

                <!-- Formulario FUNCIONAL -->
                <form action="{{ route('contacto.store') }}" method="POST" class="mt-6 space-y-4">
                    @csrf
                    <input type="text" name="nombre" placeholder="Tu Nombre" required
                        class="w-full p-3 rounded-lg bg-white bg-opacity-20 text-white placeholder-gray-300 outline-none focus:ring-2 focus:ring-blue-400">

                    <input type="email" name="correo" placeholder="Tu Correo" required
                        class="w-full p-3 rounded-lg bg-white bg-opacity-20 text-white placeholder-gray-300 outline-none focus:ring-2 focus:ring-blue-400">

                    <textarea name="mensaje" placeholder="Tu Mensaje" rows="4" required
                        class="w-full p-3 rounded-lg bg-white bg-opacity-20 text-white placeholder-gray-300 outline-none focus:ring-2 focus:ring-blue-400"></textarea>

                    <button type="submit"
                        class="w-full p-3 bg-blue-600 hover:bg-blue-700 transition-all duration-300 text-white font-bold rounded-lg shadow-lg transform hover:scale-105 active:scale-95">
                        ✉️ Enviar Mensaje
                    </button>
                </form>

                <!-- ✅ Mostrar mensaje de éxito -->
                @if (session('success'))
                    <p class="text-green-400 text-center mt-4">{{ session('success') }}</p>
                @endif

                <!-- Opción de Llamada Directa -->
                <div class="mt-6 text-center">
                    <p class="text-gray-300">Habla con un especialista ahora mismo</p>
                    <a href="https://eldeseo.a.gdms.cloud/click2call?from_user=webrtc_trunk_1&to_user=service"
                        id="callButton"
                        class="mt-2 inline-block w-full p-3 bg-green-500 hover:bg-green-600 transition-all duration-300 text-white font-bold rounded-lg shadow-lg transform hover:scale-105 active:scale-95">
                        📞 Llamar Ahora
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- ✅ Mover scripts al final para optimizar carga -->
    <script src="https://cdn.tailwindcss.com" defer></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js" defer></script>

    <!-- AOS y GSAP -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <!-- Splide.js para el carrusel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3/dist/css/splide.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3/dist/js/splide.min.js"></script>

</body>

</html>
