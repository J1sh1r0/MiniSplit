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

        .feature-card:hover {
            transform: scale(1.05);
            transition: 0.3s;
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

        #bienvenida {
            background: url('/img/aufit-minisplit.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
        }

        #bienvenida::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            /* Oscurece un poco la imagen para mejor legibilidad */
        }

        #bienvenida .content {
            position: relative;
            z-index: 2;
        }
    </style>
</head>

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
                <h2 class="text-6xl font-bold" data-aos="fade-up">AUFIT</h2>
                <p class="mt-4 text-lg" data-aos="fade-up" data-aos-delay="200">
                    Inteligente • Elegante • Eficiente • Seguro • Saludable • Confiable
                </p>
            </div>
        </section>        

        <!-- ✅ Sección de Características -->
        <section id="caracteristicas" class="py-20 text-center bg-white text-black">
            <h2 class="text-4xl font-bold" data-aos="fade-up">Características del Minisplit</h2>
            <div class="container mx-auto grid md:grid-cols-3 gap-8 mt-8">
                <div class="feature-card bg-gray-100 p-6 rounded-lg shadow-lg" data-aos="zoom-in">
                    <i class="fas fa-snowflake text-4xl text-[#072BF2]"></i>
                    <h3 class="text-2xl font-bold mt-4">Tecnología Inverter</h3>
                    <p class="mt-2">Ahorra energía y mejora la eficiencia del enfriamiento.</p>
                </div>
                <div class="feature-card bg-gray-100 p-6 rounded-lg shadow-lg" data-aos="zoom-in">
                    <i class="fas fa-bolt text-4xl text-[#072BF2]"></i>
                    <h3 class="text-2xl font-bold mt-4">Alto Voltaje</h3>
                    <p class="mt-2">Soporta 220V para mayor potencia y estabilidad.</p>
                </div>
                <div class="feature-card bg-gray-100 p-6 rounded-lg shadow-lg" data-aos="zoom-in">
                    <i class="fas fa-fan text-4xl text-[#072BF2]"></i>
                    <h3 class="text-2xl font-bold mt-4">Modo Silencioso</h3>
                    <p class="mt-2">Disfruta de un ambiente fresco sin ruido excesivo.</p>
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

        <!-- ✅ Sección Beneficios para Técnicos -->
        <section id="beneficios" class="py-20 text-center bg-[#4B75F2]">
            <h2 class="text-4xl font-bold" data-aos="fade-up">Beneficios para Técnicos</h2>
            <div class="container mx-auto grid md:grid-cols-2 gap-8 mt-8">
                <div class="benefit-card bg-white p-6 rounded-lg shadow-lg text-black" data-aos="fade-right">
                    <h3 class="text-2xl font-bold">Compra 2 Minisplits</h3>
                    <p class="mt-2">✅ 1 Sacabocado gratis</p>
                    <p class="mt-2">🎟 Entra en rifa de una recuperadora de refrigerante</p>
                </div>
                <div class="benefit-card bg-white p-6 rounded-lg shadow-lg text-black" data-aos="fade-left">
                    <h3 class="text-2xl font-bold">Compra 3 Minisplits</h3>
                    <p class="mt-2">✅ 2 Sacabocados gratis</p>
                    <p class="mt-2">🎟 Entra en rifa de un kit de herramientas especializadas</p>
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
