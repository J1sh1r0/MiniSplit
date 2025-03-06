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
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #072BF2, #4B75F2);
            color: white;
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
            background: url('{{ asset('img/aufit-minisplit3.png') }}') no-repeat center top;
            background-size: cover;
            /* Ajusta el tamaño para que cubra toda la sección */
            background-attachment: fixed;
            /* Parallax */
            height: 90vh;
            /* Ajusta la altura para evitar cortar la imagen */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
            padding: 40px 20px;
        }

        #bienvenida::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.15);
            /* Reduce el oscurecimiento */
        }

        #bienvenida .content {
            position: relative;
            z-index: 2;
            max-width: 85%;
            text-align: center;
        }

        #bienvenida h2 {
            font-size: 5rem;
            font-weight: bold;
            text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.5);
        }

        #bienvenida p {
            font-size: 1.8rem;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
        }

        #navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 50;
            padding: 15px 30px;
            background: rgba(7, 43, 242, 0.9);
            /* Azul con transparencia */
            backdrop-filter: blur(10px);
            /* Efecto de vidrio */
            transition: background 0.3s ease-in-out;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        #navbar h1 {
            font-size: 1.8rem;
            font-weight: bold;
        }

        #navbar ul {
            display: flex;
            gap: 20px;
        }

        #navbar ul li a {
            text-decoration: none;
            font-size: 1.2rem;
            color: white;
            transition: color 0.3s ease-in-out;
        }

        #navbar ul li a:hover {
            color: #B3BDF2;
            /* Azul claro */
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
    <header id="navbar" class="fixed top-0 w-full z-50 p-4 bg-transparent text-white">
        <nav class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">LandingMinisplit</h1>
            <ul class="hidden md:flex space-x-6">
                <li><a href="#bienvenida" class="hover:text-[#B3BDF2]">Inicio</a></li>
                <li><a href="#caracteristicas" class="hover:text-[#B3BDF2]">Características</a></li>
                <li><a href="#productos" class="hover:text-[#B3BDF2]">Minisplits</a></li>
                <li><a href="#beneficios" class="hover:text-[#B3BDF2]">Beneficios Técnicos</a></li>
                <li><a href="#contacto" class="hover:text-[#B3BDF2]">Contacto</a></li>
            </ul>
        </nav>
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
        <section id="productos" class="py-20 text-center bg-white text-black">
            <h2 class="text-4xl font-bold" data-aos="fade-up">Nuestros Minisplits</h2>
            <div class="container mx-auto grid md:grid-cols-2 gap-8 mt-8">
                <div class="card relative w-72 h-40 mx-auto" data-aos="flip-left">
                    <div class="card-inner w-full h-full relative">
                        <div
                            class="card-front bg-gray-100 text-[#072BF2] flex justify-center items-center rounded-lg shadow-lg">
                            <h3 class="text-2xl font-bold">CHI-R32-12K-110</h3>
                        </div>
                        <div class="card-back">
                            <p>✅ 1 Tonelada | Frío/Calor | Inverter | 220V</p>
                            <p class="text-sm mt-1">Oferta: <strong>$7,599</strong></p>
                        </div>
                    </div>
                </div>
                <div class="card relative w-72 h-40 mx-auto" data-aos="flip-right">
                    <div class="card-inner w-full h-full relative">
                        <div
                            class="card-front bg-gray-100 text-[#072BF2] flex justify-center items-center rounded-lg shadow-lg">
                            <h3 class="text-2xl font-bold">CHI-R32-24K-220</h3>
                        </div>
                        <div class="card-back">
                            <p>✅ 2 Toneladas | Frío/Calor | Inverter | 220V</p>
                            <p class="text-sm mt-1">Oferta: <strong>$14,999</strong></p>
                        </div>
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
                        class="mt-6 w-full py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 hover:scale-105 transition">
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
                        class="mt-6 w-full py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 hover:scale-105 transition">
                        🛒 Comprar Ahora
                    </button>
                </div>
            </div>
        </section>

        <!-- ✅ Sección Contacto -->
        <section id="contacto" class="h-screen flex items-center justify-center">
            <div class="text-center">
                <h2 class="text-4xl font-bold" data-aos="fade-up">Contacto</h2>
                <p class="mt-4 text-lg">¡Envíanos tus dudas o cotizaciones!</p>
                <input type="email" placeholder="Tu correo..." class="p-2 mt-4 rounded bg-white text-black">
                <button class="px-6 py-2 bg-[#072BF2] text-white rounded-lg shadow-md hover:bg-[#4B75F2] transition">
                    Enviar
                </button>
            </div>
        </section>
    </main>

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
