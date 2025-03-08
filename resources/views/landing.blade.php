<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LandingMinisplit</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
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

        .container {
            max-width: 100%;
            padding: 10px;
        }

        @media (max-width: 768px) {
            #navbar {
                padding: 15px 10px;
                /* 🔹 Reduce padding en móvil */
            }
        }

        /* General */
        body {
            font-family: 'Poppins', sans-serif;
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

        .nav-link {
            position: relative;
            transition: color 0.3s ease-in-out;
        }

        .nav-link::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: -4px;
            width: 0%;
            height: 3px;
            background: white;
            transition: width 0.3s ease-in-out, left 0.3s ease-in-out;
        }

        .nav-link:hover::after {
            width: 100%;
            left: 0;
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

        @media (max-width: 768px) {
            #navbar {
                flex-direction: column;
                padding: 10px 15px;
            }

            .nav-link {
                display: block;
                padding: 10px 0;
            }

            .feature-card {
                flex-direction: column;
                text-align: center;
            }
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
            width: 100%;
            z-index: 50;
            padding: 15px 40px;
            background: linear-gradient(to right, #072BF2, #4B75F2);
            /* ✅ MODIFICADO */
            backdrop-filter: blur(10px);
            /* ✅ Agrega este para el difuminado */
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
            /* ✅ Agrega este para la sombra */
            display: flex;
            justify-content: space-between;
            align-items: center;
            overflow: hidden;
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
            gap: 25px;
            /* ✅ MODIFICADO */
        }

        #navbar ul li a {
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
            transition: width 0.3s ease-in-out, left 0.3s ease-in-out;
        }

        #navbar ul li a:hover::after {
            width: 100%;
            left: 0;
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
            .menu-icon {
                display: block;
            }

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

        #videos,
        #beneficios-minisplit {
            display: block !important;
        }

        /*  Animación de entrada  */
        >@keyframes fade-in {
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

        /* Contenedor del modal */
        #cart-modal {
            backdrop-filter: blur(8px);
        }

        /* Estilos del formulario */
        #payment-form input {
            border: 2px solid #d1d5db;
            padding: 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        #payment-form input:focus {
            border-color: #4B75F2;
            box-shadow: 0px 0px 8px rgba(75, 117, 242, 0.4);
            outline: none;
        }

        /* Campo de verificación para técnicos */
        #technician-fields {
            background: rgba(75, 117, 242, 0.1);
            padding: 12px;
            border-radius: 8px;
            margin-top: 10px;
            border-left: 4px solid #4B75F2;
        }

        #technician-fields label {
            font-weight: bold;
            color: #4B75F2;
        }

        /* Botón "¿Eres técnico?" */
        #toggleTechnician {
            display: block;
            text-align: center;
            color: #4B75F2;
            cursor: pointer;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        #toggleTechnician:hover {
            color: #3451b6;
            text-decoration: underline;
        }

        /* Botón de compra */
        #cart-modal .btn-primary {
            background: #22c55e;
            color: white;
            font-weight: bold;
            padding: 14px;
            border-radius: 8px;
            text-align: center;
            transition: background 0.3s ease;
            width: 100%;
        }

        #cart-modal .btn-primary:hover {
            background: #16a34a;
        }

        /* Carrito de compras */
        .productos-seleccionados {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Productos en carrito */
        .product-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px;
            border-radius: 8px;
            background: #f9fafb;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 8px;
        }

        .product-item img {
            width: 60px;
            height: auto;
            border-radius: 6px;
            border: 2px solid #ddd;
        }

        /* Botones de cantidad */
        .quantity-controls button {
            border: none;
            background: transparent;
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .quantity-controls button:hover {
            color: #4B75F2;
        }

        /* Precio final */
        .total-container {
            text-align: right;
            font-weight: bold;
            font-size: 18px;
        }

        #cart-modal button.close-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            background-color: #dc2626;
            /* Rojo fuerte */
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease, background 0.3s ease;
        }

        #cart-modal button.close-btn:hover {
            background-color: #b91c1c;
            /* Rojo más oscuro */
            transform: scale(1.1);
        }
    </style>
</head>

<body>

    <!-- 🔹 Barra de Navegación Mejorada -->
    <header id="navbar"
        class="fixed top-0 w-full z-50 bg-gradient-to-r from-[#072BF2] to-[#4B75F2] shadow-lg backdrop-blur-lg transition-all duration-300">
        <div class="container mx-auto flex justify-between items-center py-3 px-8">

            <!-- 🔹 Logo -->
            <h1 class="text-2xl font-bold text-white cursor-pointer tracking-wide">LandingMinisplit</h1>

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
                                <!-- 🔹 Nuevo Video en Posición 2 -->
                                <li class="splide__slide">
                                    <div class="video-container relative">
                                        <iframe width="100%" height="500"
                                            src="https://www.youtube.com/embed/T1_iRhkI3kw" allowfullscreen></iframe>
                                        <div class="video-overlay"></div>
                                    </div>
                                </li>
                                <!-- 🔹 Nuevo Video en Posición 3 -->
                                <li class="splide__slide">
                                    <div class="video-container relative">
                                        <iframe width="100%" height="500"
                                            src="https://www.youtube.com/embed/BdzAUdm6IC8" allowfullscreen></iframe>
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
                <img src="{{ asset('img/compatibilidad-alexa-google.png') }}" alt="Compatibilidad Alexa y Google Home"
                    class="w-full rounded-lg shadow-lg">
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
                    <p class="mt-2 text-gray-700">Ahorra hasta un 40% en consumo eléctrico y proporciona un
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

                        <button
                            class="buy-button mt-4 w-full py-4 text-lg bg-[#072BF2] text-white font-semibold rounded-lg shadow-md hover:bg-[#4B75F2] hover:scale-105 transition active:scale-95"
                            data-product='{"name": "Minisplit 1 Ton", "price": 7599, "image": "img/aufit-minisplit-1ton.jpg"}'>
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
                            class="buy-button mt-4 w-full py-4 text-lg bg-[#072BF2] text-white font-semibold rounded-lg shadow-md hover:bg-[#4B75F2] hover:scale-105 transition active:scale-95"
                            data-product='{"name": "Minisplit 2 Ton", "price": 14900, "image": "img/aufit-minisplit-2ton.jpg"}'>
                            🛒 Comprar Ahora
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- ✅ Sección Paquetes para Técnicos -->
        <section id="paquetes-tecnicos" class="py-20 text-center bg-gray-50">
            <h2 class="text-4xl font-bold text-[#072BF2]" data-aos="fade-up">Beneficios para Técnicos</h2>

            <!-- 🔹 Confirmación de Video -->
            <div
                class="container mx-auto mt-6 max-w-3xl bg-white p-6 rounded-xl shadow-lg transition hover:shadow-2xl">
                <h3 class="text-2xl font-semibold text-gray-800">Confirmación Requerida</h3>
                <p class="text-gray-600 mt-2">
                    Para acceder a los beneficios, debes subir un video mostrando tu equipo de trabajo
                    (bandas de vacío, manómetros, herramientas, etc.).
                </p>
            </div>

            <div class="container mx-auto grid md:grid-cols-2 gap-10 mt-12">
                <!-- ✅ Paquete 2 Equipos -->
                <div class="benefit-card relative p-8 rounded-xl shadow-lg transition transform hover:-translate-y-2 hover:shadow-2xl bg-gradient-to-b from-white to-gray-100"
                    data-aos="fade-right">
                    <h3 class="text-3xl font-bold text-[#072BF2]">Comprando 2 Equipos</h3>
                    <p class="mt-4 text-lg text-gray-700">Obtienes los siguientes beneficios:</p>
                    <ul class="mt-4 text-left text-gray-600">
                        <li>✅ Gratis 1 sacabocado para pared ($500)</li>
                        <li>🎟 Entra en rifa de 1 recuperadora de refrigerante ($13000)</li>
                    </ul>
                    <button
                        class="buy-button mt-4 w-full py-4 text-lg bg-[#072BF2] text-white font-semibold rounded-lg shadow-md hover:bg-[#4B75F2] hover:scale-105 transition active:scale-95"
                        data-product='{"name": "Minisplit 1 Ton", "price": 7599, "image": "img/aufit-minisplit-1ton.jpg"}'>
                        🛒 Comprar Ahora
                    </button>
                </div>

                <!-- ✅ Paquete 3 Equipos -->
                <div class="benefit-card relative p-8 rounded-xl shadow-lg transition transform hover:-translate-y-2 hover:shadow-2xl bg-gradient-to-b from-white to-gray-100"
                    data-aos="fade-left">
                    <h3 class="text-3xl font-bold text-[#072BF2]">Comprando 3 Equiposo más</h3>
                    <p class="mt-4 text-lg text-gray-700">Obtienes los siguientes beneficios:</p>
                    <ul class="mt-4 text-left text-gray-600">
                        <li>✅ Gratis 2 sacabocados para pared ($1000)</li>
                        <li>🎟 Entra en rifa de 1 recuperadora de refrigerante ($13000)</li>
                        <li>🎟 Entra en rifa de 1 kit de manómetros especiales ($1900)</li>
                        <li>🎟 Entra en rifa de 1 kit de herramientas para tubería ($1500)</li>
                    </ul>
                    <button
                        class="buy-button mt-4 w-full py-4 text-lg bg-[#072BF2] text-white font-semibold rounded-lg shadow-md hover:bg-[#4B75F2] hover:scale-105 transition active:scale-95"
                        data-product='{"name": "Minisplit 2 Ton", "price": 14900, "image": "img/aufit-minisplit-2ton.jpg"}'>
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

    <!-- ✅ Mover scripts al final para optimizar carga -->
    <script src="https://cdn.tailwindcss.com" defer></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js" defer></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous" defer></script>


    <!-- AOS y GSAP -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <!-- Splide.js para el carrusel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3/dist/css/splide.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3/dist/js/splide.min.js"></script>

    <!-- Scrip 4-->
    <script>
        AOS.init();

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

        function toggleMenu() {
            document.querySelector('#navbar ul').classList.toggle('active');
        }

        document.getElementById("callButton").addEventListener("click", function() {
            if (navigator.vibrate) {
                navigator.vibrate([100, 50, 100]); // 🔹 Vibración en móviles
            }
        });

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

        //Script para Fondo Animado

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

        // <!--🔹Script para el menú-- >
        document.getElementById("menu-toggle").addEventListener("click", function() {
            let menu = document.getElementById("mobile-menu");
            menu.classList.remove("hidden");
            setTimeout(() => {
                menu.classList.remove("opacity-0", "scale-95");
                menu.classList.add("opacity-100", "scale-100");
            }, 10);
        });

        document.getElementById("close-menu").addEventListener("click", function() {
            let menu = document.getElementById("mobile-menu");
            menu.classList.remove("opacity-100", "scale-100");
            menu.classList.add("opacity-0", "scale-95");
            setTimeout(() => {
                menu.classList.add("hidden");
            }, 300);
        });

        document.querySelectorAll("#mobile-menu .nav-link").forEach(link => {
            link.addEventListener("click", () => {
                let menu = document.getElementById("mobile-menu");
                menu.classList.remove("opacity-100", "scale-100");
                menu.classList.add("opacity-0", "scale-95");
                setTimeout(() => {
                    menu.classList.add("hidden");
                }, 300);
            });
        });

        window.addEventListener('scroll', function() {
            document.getElementById('navbar').classList.toggle('nav-active', window.scrollY > 50);
        });
    </script>

    <!-- 🔹 Modal del carrito -->
    <div id="cart-modal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
        <div class="flex max-w-4xl w-full bg-white rounded-xl shadow-lg overflow-hidden">

            <!-- Sección de formulario de compra (33%) -->
            <div class="max-w-29 bg-[#a298fcd5] text-white flex flex-col items-center justify-center p-6">

                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold">Finalizar Compra</h2>
                </div>

                <form id="payment-form" enctype="multipart/form-data" class="w-full space-y-4">
                    @csrf

                    <div class="flex gap-2">
                        <input type="text" name="name" placeholder="Nombre"
                            class="p-3 rounded text-gray-800 w-1/2" required>
                        <input type="text" name="last_name" placeholder="Apellido"
                            class="p-3 rounded text-gray-800 w-1/2" required>
                    </div>

                    <input type="email" name="email" placeholder="Correo Electrónico"
                        class="p-3 rounded text-gray-800 w-full" required>
                    <input type="text" name="phone" placeholder="Teléfono"
                        class="p-3 rounded text-gray-800 w-full" required>

                    <input type="text" name="address" placeholder="Dirección"
                        class="p-3 rounded text-gray-800 w-full" required>

                    <div class="flex gap-2">
                        <input type="text" name="city" placeholder="Ciudad"
                            class="p-3 rounded text-gray-800 w-1/3" required>
                        <input type="text" name="state" placeholder="Estado"
                            class="p-3 rounded text-gray-800 w-1/3" required>
                        <input type="text" name="zip" placeholder="Código Postal"
                            class="p-3 rounded text-gray-800 w-1/3" required>
                    </div>

                    <div id="technician-fields"
                        class="hidden bg-[#e8eaf6] p-4 rounded-md border-l-4 border-[#4B75F2]">
                        <label class="block font-bold text-[#4B75F2]">📹 Sube un video de verificación:</label>
                        <p class="text-sm text-gray-700">
                            Para verificar que eres técnico, sube un video donde:
                        <ul class="list-disc list-inside mt-1 text-gray-600">
                            <li>📌 Digas tu <b>nombre completo</b>.</li>
                            <li>📌 Se vea claramente tu <b>rostro</b>.</li>
                            <li>📌 Muestres los <b>equipos con los que trabajas</b>.</li>
                        </ul>
                        </p>
                        <input type="file" name="verification_video" accept="video/*"
                            class="w-full p-2 rounded bg-white text-gray-700 border border-gray-300 mt-2">
                    </div>

                    <!-- Botón de PayPal -->
                    <div id="paypal-button-container" class="w-full"></div>
                </form>



                <span class="mt-4 cursor-pointer underline text-blue-600 hover:text-blue-800 transition"
                    id="toggleTechnician">¿Eres técnico?</span>
            </div>

            <!-- Sección para productos (67%) -->
            <div class="w-2/3 p-8 overflow-y-auto productos-seleccionados">

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
    </div>

    <!-- 🔹 Modal de Confirmación de Pago -->
    <div id="payment-modal" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
            <h2 class="text-xl font-bold text-gray-800">Selecciona un método de pago</h2>
            <p class="text-gray-600 mt-2">Puedes pagar con PayPal o Tarjeta de Débito/Crédito.</p>

            <div class="mt-4 space-y-2">
                <button id="pay-with-paypal"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    🅿️ Pagar con PayPal
                </button>
                <button id="pay-with-card"
                    class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                    💳 Pagar con Tarjeta
                </button>
                <button id="cancel-purchase"
                    class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                    ❌ Cancelar Compra
                </button>
            </div>
        </div>
    </div>

    <!-- Scrip 2-->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let cartModal = document.getElementById("cart-modal");
            let cartItemsContainer = document.querySelector(".productos-seleccionados .space-y-4");
            let cartTotalContainer = document.createElement("div");
            cartTotalContainer.classList.add("text-right", "mt-4", "font-bold", "text-lg");
            cartItemsContainer.parentElement.appendChild(cartTotalContainer);

            let cartTitle = document.createElement("h2");
            cartTitle.textContent = "Productos Agregados";
            cartTitle.classList.add("text-xl", "font-bold", "text-gray-800", "mb-4", "border-b", "pb-2");
            cartItemsContainer.parentElement.insertBefore(cartTitle, cartItemsContainer);

            let checkoutButton = document.createElement("button");
            checkoutButton.textContent = "Finalizar Compra";
            checkoutButton.classList.add("w-full", "mt-4", "py-3", "bg-green-500", "hover:bg-green-600",
                "text-white", "font-bold", "rounded-lg", "shadow-lg", "transition");
            cartTotalContainer.appendChild(checkoutButton);

            if (!localStorage.getItem("cart")) {
                localStorage.setItem("cart", JSON.stringify([]));
            }

            let cart = JSON.parse(localStorage.getItem("cart"));

            function updateCartUI() {
                cartItemsContainer.innerHTML = "";
                let totalAmount = 0;

                if (cart.length === 0) {
                    cartItemsContainer.innerHTML =
                        `<p class="text-gray-600 text-center">El carrito está vacío.</p>`;
                    cartTotalContainer.innerHTML = "";
                    cartTitle.classList.add("hidden");
                    checkoutButton.classList.add("hidden");
                } else {
                    cartTitle.classList.remove("hidden");
                    checkoutButton.classList.remove("hidden");
                    cart.forEach((item, index) => {
                        let totalItemPrice = item.quantity * item.price;
                        totalAmount += totalItemPrice;

                        cartItemsContainer.innerHTML += `
                <div class="p-4 rounded shadow border flex justify-between items-center bg-white">
                    <div class="flex items-center space-x-4">
                        <img src="${item.image}" alt="${item.name}" class="w-16 h-16 rounded-md border">
                        <div>
                            <h3 class="font-bold text-gray-800">${item.name}</h3>
                            <p class="text-gray-700 font-bold mt-1">Cantidad: ${item.quantity}</p>
                            <span class="font-bold text-[#4B75F2]">$${item.price} MXN c/u</span>
                            <p class="text-gray-700 font-bold mt-1">Subtotal: $${totalItemPrice} MXN</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <button class="text-blue-500 font-bold text-xl change-qty" data-index="${index}" data-action="decrease">➖</button>
                        <span class="mx-2 text-lg font-semibold">${item.quantity}</span>
                        <button class="text-green-500 font-bold text-xl change-qty" data-index="${index}" data-action="increase">➕</button>
                        <button class="text-red-500 font-bold text-xl remove-item ml-4" data-index="${index}">❌</button>
                    </div>
                </div>`;
                    });

                    cartTotalContainer.innerHTML =
                        `<p class="text-gray-900 font-bold text-lg">Total a pagar: $${totalAmount} MXN</p>`;
                    cartTotalContainer.appendChild(checkoutButton);
                }

                document.getElementById("cart-count").textContent = cart.reduce((sum, item) => sum + item.quantity,
                    0);
            }

            updateCartUI();

            document.querySelectorAll(".buy-button").forEach(button => {
                button.addEventListener("click", function() {
                    let product = JSON.parse(this.getAttribute("data-product"));

                    let existingProduct = cart.find(item => item.name === product.name);
                    if (existingProduct) {
                        existingProduct.quantity++;
                    } else {
                        product.quantity = 1;
                        cart.push(product);
                    }

                    localStorage.setItem("cart", JSON.stringify(cart));
                    updateCartUI();
                });
            });

            document.addEventListener("click", function(event) {
                if (event.target.classList.contains("change-qty")) {
                    let index = event.target.getAttribute("data-index");
                    let action = event.target.getAttribute("data-action");

                    if (action === "increase") {
                        cart[index].quantity++;
                    } else if (action === "decrease" && cart[index].quantity > 1) {
                        cart[index].quantity--;
                    } else if (action === "decrease" && cart[index].quantity === 1) {
                        cart.splice(index, 1);
                    }

                    localStorage.setItem("cart", JSON.stringify(cart));
                    updateCartUI();
                }
            });

            document.addEventListener("click", function(event) {
                if (event.target.classList.contains("remove-item")) {
                    let index = event.target.getAttribute("data-index");
                    cart.splice(index, 1);
                    localStorage.setItem("cart", JSON.stringify(cart));
                    updateCartUI();
                }
            });

            document.getElementById("cart-button").addEventListener("click", function() {
                cartModal.classList.toggle("hidden");
                updateCartUI();
            });

            cartModal.addEventListener("click", function(event) {
                if (event.target === this) {
                    cartModal.classList.add("hidden");
                }
            });

            checkoutButton.addEventListener("click", function() {
                document.getElementById("payment-modal").classList.remove(
                    "hidden"); // Muestra el modal de pago
                cartModal.classList.add("hidden"); // Cierra el carrito para evitar solapamiento
            });

            // Evento para pagar con PayPal
            document.getElementById("pay-with-paypal").addEventListener("click", function() {
                procesarPago("PayPal");
            });

            // Evento para pagar con Tarjeta de Crédito/Débito
            document.getElementById("pay-with-card").addEventListener("click", function() {
                procesarPago("Tarjeta");
            });

            // Evento para cancelar la compra y cerrar modal
            document.getElementById("cancel-purchase").addEventListener("click", function() {
                document.getElementById("payment-modal").classList.add("hidden"); // Cierra el modal de pago
                cartModal.classList.remove("hidden"); // Reabre el carrito para seguir comprando
            });

            // Función que procesa el pago según el método elegido
            function procesarPago(metodoPago) {
                let formData = new FormData(document.getElementById("payment-form"));
                let total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);

                formData.append("total", total);
                formData.append("products", JSON.stringify(cart));
                formData.append("payment_method", metodoPago); // Se añade el método de pago elegido

                fetch("{{ route('order.store') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(`✅ Compra realizada con éxito. Folio: ${data.folio}`);
                        localStorage.removeItem("cart");
                        updateCartUI();
                        document.getElementById("payment-modal").classList.add(
                            "hidden"); // Cierra el modal de pago
                        cartModal.classList.add("hidden"); // Cierra el carrito
                    })
                    .catch(error => console.error("Error:", error));
            }

            // 🔹 Cerrar la ventana de pago
            document.getElementById("close-payment-modal").addEventListener("click", function() {
                document.getElementById("payment-modal").classList.add("hidden");
            });

            // 🔹 Cancelar compra y vaciar carrito
            document.getElementById("cancel-purchase").addEventListener("click", function() {
                localStorage.removeItem("cart"); // Vacía el carrito
                updateCartUI(); // Actualiza la interfaz
                document.getElementById("payment-modal").classList.add("hidden"); // Cierra el modal de pago
                document.getElementById("cart-modal").classList.add("hidden"); // Cierra el carrito
            });

            // 🔹 Pagar con PayPal
            document.getElementById("pay-with-paypal").addEventListener("click", function() {
                alert("🔹 Redirigiendo a PayPal...");
                // Aquí puedes agregar la integración con la API de PayPal
            });

            // 🔹 Pagar con Tarjeta de Débito/Crédito
            document.getElementById("pay-with-card").addEventListener("click", function() {
                alert("🔹 Mostrando formulario de tarjeta...");
                // Aquí puedes agregar la integración con una pasarela de pago (Stripe, MercadoPago, etc.)
            });


            let closeButton = document.createElement("button");
            closeButton.innerHTML = "❌"; // Ícono en lugar de texto
            closeButton.classList.add(
                "absolute", "top-3", "right-3", "bg-red-600", "hover:bg-red-700",
                "text-white", "text-lg", "w-10", "h-10", "rounded-full", "shadow-lg",
                "flex", "items-center", "justify-center", "transition-all", "duration-300"
            );
            closeButton.addEventListener("click", function() {
                cartModal.classList.add("hidden");
            });
            document.querySelector("#cart-modal > div").appendChild(closeButton);

            // 🔹 Activar campo de video si es técnico
            let toggleTechnicianButton = document.getElementById("toggleTechnician");
            let technicianFields = document.getElementById("technician-fields");

            if (toggleTechnicianButton) {
                toggleTechnicianButton.addEventListener("click", function(event) {
                    event.preventDefault(); // Evita salto en la página

                    if (technicianFields.classList.contains("hidden")) {
                        technicianFields.classList.remove("hidden");
                        toggleTechnicianButton.classList.add("text-blue-800", "font-bold");
                        toggleTechnicianButton.innerHTML = "✔ Eres técnico (Click para ocultar)";
                    } else {
                        technicianFields.classList.add("hidden");
                        toggleTechnicianButton.classList.remove("text-blue-800", "font-bold");
                        toggleTechnicianButton.innerHTML = "¿Eres técnico?";
                    }
                });
            }
        });

        // Función que procesa el pago según el método elegido
        function procesarPago(metodoPago) {
            let formData = new FormData(document.getElementById("payment-form"));
            let total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);

            formData.append("total", total);
            formData.append("products", JSON.stringify(cart));
            formData.append("payment_method", metodoPago); // Se añade el método de pago elegido

            fetch("{{ route('order.store') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(`✅ Compra realizada con éxito. Folio: ${data.folio}`);
                    localStorage.removeItem("cart");
                    updateCartUI();
                    document.getElementById("payment-modal").classList.add("hidden"); // Cierra el modal de pago
                })
                .catch(error => console.error("Error:", error));
        }
    </script>
</body>

</html>
