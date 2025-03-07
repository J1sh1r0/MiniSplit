<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LandingMinisplit</title>

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- AOS Animaciones -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- GSAP para animaciones avanzadas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <!-- Iconos -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Fuente Moderna -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        #bienvenida {
            background: url("{{ asset('img/aufit-minisplit.jpg') }}") no-repeat center center/cover;
        }
    </style>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            /* 🔹 Evita desbordamiento horizontal */
        }

        @media (max-width: 768px) {
            #navbar {
                padding: 15px 10px;
                /* 🔹 Reduce padding en móvil */
            }
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #072BF2, #4B75F2);
            color: white;
            margin: 0;
            /* Elimina cualquier margen por defecto */
            padding: 0;
            /* Elimina rellenos adicionales */
            overflow-x: hidden;
            /* Evita desbordamiento horizontal */
        }

        .nav-active {
            backdrop-filter: blur(10px);
            background: rgba(7, 43, 242, 0.8);
            transition: background 0.3s ease-in-out;
        }

        .feature-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
        }

        .benefit-card:hover {
            background: #072BF2;
            color: white;
            transition: 0.3s;
        }

        .card {
            perspective: 1000px;
        }

        .card-inner {
            transform-style: preserve-3d;
            transition: transform 0.6s;
        }

        .card:hover .card-inner {
            transform: rotateY(180deg);
        }

        .card-front,
        .card-back {
            backface-visibility: hidden;
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }

        .card-back {
            background: #072BF2;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            transform: rotateY(180deg);
        }

        .bg-gradient-to-r {
            background: linear-gradient(to right, #B3BDF2, white);
        }

        .bg-gradient-to-b {
            background: linear-gradient(to bottom, white, #E5E7EB);
        }

        #bienvenida {
            background: url('{{ asset('img/aufit-minisplit4.jpg') }}') no-repeat center center;
            background-size: cover;
            background-position: center;
            width: 100vw;
            height: 80vh;
            display: flex;
            align-items: flex-start;
            /* 🔹 Mueve el contenido hacia arriba */
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
            padding: 100px 20px 40px;
            /* 🔹 Aumenta el padding superior para subir el contenido */
        }

        /* ✅ Mejora la legibilidad del texto */
        #bienvenida::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* 🔹 Aumenta opacidad para mayor contraste */
            z-index: 1;
        }

        #bienvenida .content {
            position: relative;
            z-index: 2;
            max-width: 90%;
            text-align: center;
            padding: 60px 20px;
            transform: translateY(-50px);
            /* 🔹 Mueve el texto más arriba */
        }

        /* ✅ Ajustes de fuente */
        #bienvenida h2 {
            font-size: 4rem;
            font-weight: bold;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.7);
            /* 🔹 Aumenta la sombra para mejorar la legibilidad */
        }

        #bienvenida p {
            font-size: 1.5rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
            max-width: 800px;
            margin: auto;
        }

        /* ✅ Optimización para móviles */
        @media (max-width: 768px) {
            #bienvenida {
                height: 60vh;
                padding: 60px 20px 20px;
                /* 🔹 Ajusta el padding superior */
            }

            #bienvenida .content {
                transform: translateY(-30px);
                /* 🔹 Sube menos el texto en móvil */
            }

            #bienvenida h2 {
                font-size: 2.5rem;
            }

            #bienvenida p {
                font-size: 1.2rem;
            }
        }

        #wrapper {
            max-width: 100vw;
            /* Evita que los elementos internos sobrepasen la pantalla */
            overflow-x: hidden;
        }

        #navbar {
            position: fixed;
            top: 0;
            left: 0;
            /* 🔹 Evita que sobresalga */
            width: 100%;
            z-index: 50;
            padding: 15px 30px;
            background: rgba(7, 43, 242, 0.9);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
            overflow: hidden;
            /* 🔹 Asegura que nada lo sobrepase */
        }

        #navbar h1 {
            font-size: 1.8rem;
            font-weight: bold;
            transition: transform 0.3s ease-in-out;
        }

        #navbar h1:hover {
            transform: scale(1.05);
        }

        #navbar ul {
            display: flex;
            gap: 20px;
        }

        #navbar ul li a {
            text-decoration: none;
            font-size: 1.2rem;
            color: white;
            position: relative;
            transition: color 0.3s ease-in-out;
        }

        #navbar ul li a::after {
            content: '';
            position: absolute;
            width: 0%;
            height: 3px;
            background: white;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            transition: width 0.3s ease-in-out;
        }

        #navbar ul li a:hover::after {
            width: 100%;
        }

        #navbar ul li a:hover {
            color: #B3BDF2;
        }

        /* 🔹 Menú Responsive */
        .menu-icon {
            display: none;
            font-size: 2rem;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .menu-icon:hover {
            transform: scale(1.1);
        }

        @media (max-width: 768px) {
            #navbar ul {
                display: none;
                flex-direction: column;
                background: rgba(7, 43, 242, 0.9);
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                padding: 20px;
                box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.2);
            }

            #navbar ul.active {
                display: flex;
            }

            .menu-icon {
                display: block;
            }
        }

        #caracteristicas {
            background: linear-gradient(to bottom, #f5f5f5, white);
            padding: 60px 20px;
        }

        #caracteristicas h2 {
            font-size: 3rem;
            text-align: center;
            font-weight: bold;
            color: #072BF2;
            margin-bottom: 30px;
        }

        #videos {
            padding: 70px 20px;
            background: linear-gradient(to bottom, white, #E5E7EB);
        }

        #videoCarousel .splide__track {
            border-radius: 15px;
            overflow: hidden;
        }

        .video-container {
            width: 100%;
            max-width: 900px;
            height: 500px;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            perspective: 1000px;
        }

        .video-container iframe {
            width: 100%;
            height: 100%;
            border-radius: 15px;
            transition: transform 0.4s ease-in-out, box-shadow 0.4s;
        }

        .splide__slide.is-active .video-container iframe {
            transform: scale(1.05) rotateX(5deg);
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
        }

        .splide__arrow {
            background-color: rgba(7, 43, 242, 0.8) !important;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            opacity: 0.6;
            transition: opacity 0.3s, transform 0.3s;
        }

        .splide__arrow:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .splide__pagination {
            bottom: -10px;
        }

        .splide__pagination__page {
            background-color: #072BF2 !important;
            width: 14px;
            height: 14px;
            margin: 6px;
            transition: transform 0.3s ease-in-out;
        }

        .splide__pagination__page.is-active {
            background-color: #4B75F2 !important;
            transform: scale(1.4);
        }

        .video-overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.4);
            opacity: 0;
            transition: opacity 0.3s;
            border-radius: 15px;
        }

        .video-container:hover .video-overlay {
            opacity: 1;
        }

        /* ✅ Sección completa */
        #paquetes-tecnicos {
            background: linear-gradient(to bottom, #f9fafb, white);
            padding-bottom: 80px;
        }

        /* 🔹 Tarjeta de Beneficios (Paquete) */
        .benefit-card {
            border: 2px solid #4B75F2;
            border-radius: 15px;
            background: linear-gradient(to bottom, #ffffff, #f5f5f5);
            transition: all 0.3s ease-in-out;
            position: relative;
            overflow: hidden;
            padding: 20px;
            text-align: center;
            color: black !important;
        }

        /* 🌟 Efecto de brillo en hover */
        .benefit-card::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(30deg);
            transition: all 0.5s ease-in-out;
        }

        .benefit-card:hover::before {
            top: -30%;
            left: -30%;
        }

        /* 🔹 Hover: Cambia el fondo sin perder visibilidad del texto */
        .benefit-card:hover {
            background: linear-gradient(to bottom, #dce3ff, #b3c0ff) !important;
            transform: scale(1.05);
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
        }

        /* 📌 Evita que el texto se vuelva invisible en hover */
        .benefit-card:hover h3,
        .benefit-card:hover p,
        .benefit-card:hover li {
            color: black !important;
        }

        /* ✅ Íconos de beneficios siempre visibles */
        .benefit-card:hover li::before {
            color: #072BF2 !important;
        }

        /* 📜 Estilo de la Lista de Beneficios */
        .benefit-card ul {
            text-align: left;
            margin-left: 15px;
            list-style: none;
            padding: 10px 0;
        }

        .benefit-card ul li {
            margin-bottom: 10px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
        }

        /* 📌 Iconos de Beneficios */
        .benefit-card ul li::before {
            content: "✔️";
            font-size: 1.4rem;
            color: #4B75F2;
            margin-right: 10px;
        }

        /* ✅ Botón "Comprar Ahora" */
        .benefit-card button {
            font-size: 1.2rem;
            border-radius: 50px;
            transition: all 0.3s ease-in-out;
            background-color: #4CAF50 !important;
            /* Verde */
            color: white !important;
            width: 100%;
            padding: 12px;
            margin-top: 15px;
        }

        /* 📌 Hover en botón */
        .benefit-card button:hover {
            background-color: #45a049 !important;
            transform: scale(1.05);
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
        }

        /* 📤 Estilo del Botón de "Subir Video" */
        #paquetes-tecnicos .container button {
            transition: all 0.3s ease-in-out;
            font-size: 1.1rem;
        }

        #paquetes-tecnicos .container button:hover {
            transform: scale(1.08);
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
        }

        /* ✅ Evita selección azul al hacer hover */
        .benefit-card:focus,
        .benefit-card:active {
            background: linear-gradient(to bottom, #ffffff, #f5f5f5) !important;
            color: black !important;
        }

        /* ✅ Evita selección de texto */
        .benefit-card * {
            user-select: none;
        }

        /* ✅ Mantiene los iconos visibles en hover */
        .benefit-card:hover li::before {
            color: #4B75F2 !important;
        }

        #productos .hover:scale-105 {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        #productos .shadow-lg:hover {
            box-shadow: 0px 12px 24px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<!-- Splide.js para el carrusel -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3/dist/css/splide.min.css">
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3/dist/js/splide.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
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
    });
</script>

<body>

    <!-- 🔹 Barra de Navegación -->
    <header id="navbar" class="fixed top-0 w-full z-50 text-white">
        <h1 class="cursor-pointer">LandingMinisplit</h1>
        <ul>
            <li><a href="#bienvenida">Inicio</a></li>
            <li><a href="#caracteristicas">Características</a></li>
            <li><a href="#productos">Minisplits</a></li>
            <li><a href="#beneficios">Paquetes de Técnicos</a></li>
            <li><a href="#contacto">Contacto</a></li>
        </ul>
        <div class="menu-icon" onclick="toggleMenu()">☰</div>
    </header>

    <!-- 🔹 Secciones -->
    <main class="pt-24">
        <section id="bienvenida">
            <div class="content">
                <h2 class="text-6xl font-bold" data-aos="fade-up">Bienvenidos</h2>
                <p class="mt-4 text-lg" data-aos="fade-up" data-aos-delay="200">
                    Disfruta del clima ideal en todo momento con nuestros Minisplits.
                </p>
            </div>
        </section>

        <!-- ✅ Sección de Videos -->
        <section id="videos" class="py-16">
            <div class="container mx-auto text-center">
                <h2 class="text-4xl font-bold text-[#072BF2] mb-8" data-aos="fade-up">Videos Destacados</h2>
                <div class="relative w-full max-w-5xl mx-auto" data-aos="zoom-in">
                    <div id="videoCarousel" class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li class="splide__slide">
                                    <div class="video-container relative">
                                        <iframe src="https://www.youtube.com/embed/6c_dtwRVQNo?start=199"
                                            allowfullscreen></iframe>
                                        <div class="video-overlay"></div>
                                    </div>
                                </li>
                                <li class="splide__slide">
                                    <div class="video-container relative">
                                        <iframe src="https://www.youtube.com/embed/E2MXFU7SNAI"
                                            allowfullscreen></iframe>
                                        <div class="video-overlay"></div>
                                    </div>
                                </li>
                                <li class="splide__slide">
                                    <div class="video-container relative">
                                        <iframe src="https://www.youtube.com/embed/YqutiGHpQpE?start=1"
                                            allowfullscreen></iframe>
                                        <div class="video-overlay"></div>
                                    </div>
                                </li>
                                <li class="splide__slide">
                                    <div class="video-container relative">
                                        <iframe src="https://www.youtube.com/embed/PDR0STxMQ-Q"
                                            allowfullscreen></iframe>
                                        <div class="video-overlay"></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ✅ Sección de Imagenes de las Caracteristicas -->
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
                <img src="{{ asset('img/compatibilidad-alexa-google.png') }}" alt="Compatibilidad Alexa y Google Home"
                    class="w-full rounded-lg shadow-lg">
            </div>
        </section>


        <!-- ✅ Sección de Características -->
        <section id="caracteristicas" class="py-20 text-center bg-white text-black">
            <h2 class="text-4xl font-bold text-[#072BF2]" data-aos="fade-up">Características Innovadoras de AUFIT</h2>
            <div class="container mx-auto grid md:grid-cols-3 gap-8 mt-8">
                <!-- Tarjeta 1: Tecnología Inverter -->
                <div
                    class="feature-card bg-gradient-to-b from-white to-gray-100 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-transform transform hover:-translate-y-2 flex flex-col items-center text-center">
                    <img src="{{ asset('img/icono-inverter.png') }}" alt="Inverter" class="w-20 h-20">
                    <h3 class="text-2xl font-bold mt-4 text-[#072BF2]">Tecnología Inverter</h3>
                    <p class="mt-2 text-gray-700">Ahorra hasta un 40% en consumo eléctrico y proporciona un enfriamiento
                        más eficiente.</p>
                </div>

                <!-- Tarjeta 2: Auto Limpieza -->
                <div
                    class="feature-card bg-gradient-to-b from-white to-gray-100 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-transform transform hover:-translate-y-2 flex flex-col items-center text-center">
                    <img src="{{ asset('img/icono-autolimpieza.png') }}" alt="Auto Limpieza" class="w-20 h-20">
                    <h3 class="text-2xl font-bold mt-4 text-[#072BF2]">Auto Limpieza</h3>
                    <p class="mt-2 text-gray-700">Previene la acumulación de bacterias y moho, garantizando aire limpio
                        y saludable.</p>
                </div>

                <!-- Tarjeta 3: Purificación de Aire -->
                <div
                    class="feature-card bg-gradient-to-b from-white to-gray-100 p-6 rounded-xl shadow-lg hover:shadow-2xl transition-transform transform hover:-translate-y-2 flex flex-col items-center text-center">
                    <img src="{{ asset('img/icono-filtro.png') }}" alt="Purificación" class="w-20 h-20">
                    <h3 class="text-2xl font-bold mt-4 text-[#072BF2]">Filtro de Aire Antibacterial</h3>
                    <p class="mt-2 text-gray-700">Filtra partículas PM2.5, eliminando bacterias y virus para un aire más
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
                    Encuentra el minisplit ideal para tu hogar o negocio con tecnología inverter, eficiencia energética
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

                        <button
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

                        <button
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
                    Para acceder a los beneficios, debes subir un video mostrando tu equipo de trabajo
                    (bandas de vacío, manómetros, herramientas, etc.).
                </p>
                <button
                    class="mt-4 px-6 py-3 bg-[#072BF2] text-white font-semibold rounded-lg shadow-md hover:bg-[#4B75F2] hover:scale-105 transition">
                    📤 Subir Video
                </button>
            </div>

            <div class="container mx-auto grid md:grid-cols-2 gap-10 mt-12">
                <!-- ✅ Paquete 2 Equipos -->
                <div class="benefit-card relative p-8 rounded-xl shadow-lg transition transform hover:-translate-y-2 hover:shadow-2xl bg-gradient-to-b from-white to-gray-100"
                    data-aos="fade-right">
                    <h3 class="text-3xl font-bold text-[#072BF2]">Paquete 2 Equipos</h3>
                    <p class="mt-4 text-lg text-gray-700">Obtienes los siguientes beneficios:</p>
                    <ul class="mt-4 text-left text-gray-600">
                        <li>✅ Gratis 1 sacabocado para pared ($500)</li>
                        <li>🎟 Entra en rifa de 1 recuperadora de refrigerante ($9000)</li>
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
                <h2 class="text-3xl font-bold text-center text-white drop-shadow-lg">¿Tienes dudas o cotizaciones?</h2>
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
                    <p class="text-gray-300">¿Prefieres hablar directamente?</p>
                    <a href="https://eldeseo.a.gdms.cloud/click2call?from_user=webrtc_trunk_1&to_user=service"
                        id="callButton"
                        class="mt-2 inline-block w-full p-3 bg-green-500 hover:bg-green-600 transition-all duration-300 text-white font-bold rounded-lg shadow-lg transform hover:scale-105 active:scale-95">
                        📞 Llamar Ahora
                    </a>
                </div>
            </div>
        </section>

    </main>

    <!-- Animación de entrada -->
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }

        @keyframes pulse {
            from {
                opacity: 0.6;
            }

            to {
                opacity: 1;
            }
        }
    </style>

    <script src="https://cdn.tailwindcss.com" defer></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js" defer></script>


    <script>
        document.getElementById("callButton").addEventListener("click", function() {
            if (navigator.vibrate) {
                navigator.vibrate([100, 50, 100]); // 🔹 Vibración en móviles
            }
        });
    </script>

    <script>
        function toggleMenu() {
            document.querySelector('#navbar ul').classList.toggle('active');
        }

        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(7, 43, 242, 0.95)';
                navbar.style.boxShadow = '0px 4px 10px rgba(0, 0, 0, 0.3)';
            } else {
                navbar.style.background = 'rgba(7, 43, 242, 0.9)';
                navbar.style.boxShadow = 'none';
            }
        });
    </script>

    <!-- Script para Fondo Animado -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const background = document.getElementById("background-animation");
            background.style.background = "radial-gradient(circle, rgba(7,43,242,0.4) 0%, rgba(0,0,0,0) 70%)";
            background.style.animation = "pulse 6s infinite alternate";
        });

        // Efecto de vibración en móvil para botón de llamada
        document.getElementById("callButton").addEventListener("click", function() {
            if (navigator.vibrate) {
                navigator.vibrate([100, 50, 100]);
            }
        });
    </script>

    <!-- AOS y GSAP -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
        window.addEventListener('scroll', function() {
            document.getElementById('navbar').classList.toggle('nav-active', window.scrollY > 50);
        });
    </script>

</body>

</html>
