<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INXPLIT</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script
        src="https://www.paypal.com/sdk/js?client-id=AVfyUgSurCNV0md7yLddN8uUk2PNktWedJE2RAjiSercq66qzOORbJl5P0riBxugUlSwtc2WeN1jMGQQ&currency=MXN">
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">


    ``
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

        #cart-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            display: none;
            z-index: 1000;
            max-width: 280px;
            font-family: 'Inter', sans-serif;
        }

        /* 🛒 Encabezado del carrito */
        #cart-container h3 {
            color: #072BF2;
            font-size: 1.2rem;
            margin-bottom: 10px;
            text-align: center;
            font-weight: bold;
        }

        /* 📜 Lista de productos */
        #cart-items {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        /* 🔹 Estilo de cada producto en el carrito */
        .cart-item {
            background: #f0f4ff;
            color: black;
            padding: 8px;
            margin-bottom: 5px;
            border-radius: 5px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* 🖼 Imagen del producto */
        .cart-item img {
            width: 50px;
            height: 40px;
            border-radius: 5px;
            margin-right: 10px;
        }

        /* 📌 Nombre del producto */
        .cart-item-info {
            flex-grow: 1;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* 🛑 Botón para eliminar productos */
        .cart-item button {
            background: red;
            color: white;
            border: none;
            padding: 5px 7px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.8rem;
        }

        .cart-item button:hover {
            background: darkred;
        }

        /* 🔵 Botón de finalizar compra */
        #finalizar-compra {
            width: 100%;
            padding: 10px;
            background: #072BF2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 10px;
            font-weight: bold;
            transition: 0.3s;
        }

        #finalizar-compra:hover {
            background: #4B75F2;
            transform: scale(1.05);
        }

        /* Agrega esto en tu sección <style> o en tu archivo CSS */
        .form-group-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            /* Separación horizontal/vertical */
            margin-bottom: 10px;
            /* Espacio inferior */
        }


        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            width: 700px;
            /* Aumenta el ancho para evitar scroll horizontal */
            max-height: 85vh;
            /* Mantén la altura máxima */
            margin: 5% auto;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            overflow-y: auto;
            /* Si es muy alto, solo aparece scroll vertical */
            background-color: white;
            animation: fadeIn 0.3s ease-in-out;
            /* ... */
        }

        .modal-content h2 {
            color: #072BF2;
            margin-bottom: 15px;
        }

        #order-summary {
            text-align: left;
            margin-bottom: 15px;
        }

        .btn {
            padding: 10px;
            width: 100%;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-danger {
            background: red;
            color: white;
        }

        .btn-danger:hover {
            background: darkred;
        }



        /* 🛒 Estilos del Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background: white;
            width: 700px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            animation: fadeIn 0.3s ease-in-out;
        }

        /* ❌ Botón Cerrar */
        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
        }

        /* 📑 Estilos del Formulario */
        .form-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 10px;
        }

        .form-group input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        h2,
        h3 {
            color: #072BF2;
            margin-bottom: 10px;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }

        button {
            background: #072BF2;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 48%;
            transition: 0.3s;
        }

        button:hover {
            background: #4B75F2;
        }

        .cancel-btn {
            background: red;
        }

        .cancel-btn:hover {
            background: darkred;
        }

        /* 🔹 Ocultar Sección Técnico */
        .hidden {
            display: none;
        }

        /* 🎬 Animación de Aparición */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* 🛠 Corregir color de texto en inputs y select */
        .modal-content input,
        .modal-content select {
            color: black;
            /* Cambiar el color del texto a negro */
            background-color: #E8F0FE !important;
            /*            /* Asegurar que el fondo sea blanco */
            border: 1px solid #ccc;
            /* Bordes más visibles */
            padding: 8px;
            border-radius: 5px;
            font-size: 14px;
        }

        /* 🔽 Ajustar el color del texto dentro del select */
        .modal-content select option {
            color: black;
            /* Color del texto */
            background-color: white;
            /* Fondo blanco */
        }

        /* 🏷 Mejorar etiquetas para mejor legibilidad */
        .modal-content label {
            color: #072BF2;
            /* Azul principal */
            font-weight: bold;
            display: block;
            margin-bottom: 3px;
            text-align: left;
        }

        #modal-resumen {
            color: black !important;
        }

        #modal-resumen h2,
        #modal-resumen p,
        #modal-resumen span {
            color: black !important;
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

        /* Ajusta los valores a tu preferencia */
        .btn-big {
            font-size: 1.2rem !important;
            /* Tamaño de fuente más grande */
            padding: 0.75rem 8rem !important;
            /* Más espacio interno */
            background-color: #3085d6 !important;
            /* Fondo azul (o el que prefieras) */
            color: #fff !important;
            /* Texto blanco */
            border: none !important;
            /* Sin bordes */
            border-radius: 0.5rem !important;
            /* Bordes redondeados */
            cursor: pointer;
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

        #floating-button {
            position: fixed;
            bottom: 80px;
            /* Ajusta la altura donde quieras */
            right: 20px;
            z-index: 9999;
            background-color: #072BF2;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 15px 25px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s, transform 0.3s;
        }

        #floating-button:hover {
            background-color: #4B75F2;
            transform: scale(1.05);
        }

        /* Botón flotante */
        #comprar-ya {
            position: fixed;
            bottom: 80px;
            /* Ajusta la distancia desde abajo */
            right: 20px;
            /* Ajusta la distancia desde la derecha */
            background-color: #FFD700;
            /* Amarillo tipo “Gold” */
            color: #000;
            /* Texto en negro para contrastar */
            padding: 15px 20px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 18px;
            border: none;
            cursor: pointer;
            z-index: 9999;
            /* Que quede por encima de casi todo */

            /* Efecto de palpitación con la animación “pulse” */
            animation: pulse 1.5s infinite;
        }

        /* Animación “pulse” */
        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 rgba(255, 215, 0, 0.7);
            }

            70% {
                transform: scale(1.1);
                box-shadow: 0 0 20px rgba(255, 215, 0, 0.7);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 0 0 rgba(255, 215, 0, 0.7);
            }
        }

        /* Ajustar el modal y las columnas en pantallas pequeñas */
        @media (max-width: 768px) {

            /* Que la rejilla de 3 columnas sea 1 sola columna en móvil */
            .form-group-3 {
                grid-template-columns: 1fr !important;
            }

            /* Si tienes .form-group de 2 columnas, también se vuelve 1 */
            .form-group {
                grid-template-columns: 1fr !important;
            }

            /* Ajustar el ancho del modal en pantallas pequeñas */
            .modal-content {
                width: 90% !important;
                margin: 5% auto;
                /* Opcional: puedes ajustar la altura si quieres */
                max-height: 80vh;
            }
        }

        @media (max-width: 768px) {

            .form-group-3>div input,
            .form-group-3>div select,
            .form-group>div input,
            .form-group>div select {
                width: 100% !important;
            }
        }

        /* 🔹 Menú móvil */
        #mobile-menu {
            z-index: 9999;
            /* Asegura que esté por encima de todo */
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transform: scale(0.9);
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out, visibility 0s linear 0.3s;
        }

        /* 🔹 Muestra el menú con transición */
        #mobile-menu.show {
            pointer-events: auto;
            opacity: 1;
            transform: scale(1);
            visibility: visible;
            transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        /* 🔹 Ajusta el botón de cierre */
        #close-menu {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 2rem;
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }

        #close-menu:hover {
            transform: scale(1.1);
        }
    </style>
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

    <!-- AOS y GSAP -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    <!-- Splide.js para el carrusel -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@3/dist/css/splide.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3/dist/js/splide.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mobileMenu = document.getElementById("mobile-menu");
            const menuToggle = document.getElementById("menu-toggle");
            const closeMenu = document.getElementById("close-menu");
            const mobileLinks = document.querySelectorAll("#mobile-menu a");

            // 🔹 Alternar menú
            menuToggle.addEventListener("click", function() {
                const isMenuOpen = mobileMenu.classList.contains("show");

                if (isMenuOpen) {
                    closeNavMenu();
                } else {
                    openNavMenu();
                }
            });

            // 🔹 Cierra el menú al hacer clic en el botón ✖
            closeMenu.addEventListener("click", closeNavMenu);

            // 🔹 Cierra el menú al hacer clic en cualquier opción
            mobileLinks.forEach(link => {
                link.addEventListener("click", closeNavMenu);
            });

            function openNavMenu() {
                mobileMenu.classList.add("show");
            }

            function closeNavMenu() {
                mobileMenu.classList.remove("show");
            }
        });

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

            // Verifica la validez nativa de todos los <input required>
            if (!form.checkValidity()) {
                // Muestra los mensajes de error nativos del navegador
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

            // Agregar el total de la compra en la ventana
            let totalElement = document.createElement('p');
            totalElement.innerHTML = `<strong>Total: $${total} MXN</strong>`;
            totalElement.style.fontSize = "18px";
            totalElement.style.color = "black";
            resumen.appendChild(totalElement);

            // Mostrar la ventana del resumen
            document.getElementById('modal-resumen').style.display = 'block';

            // Limpiar el contenedor antes de renderizar nuevamente
            document.getElementById('paypal-button-container').innerHTML = '';

            // Renderizar el botón de PayPal
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: total
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        procesarCompra();
                        cerrarModalResumen();
                        cerrarModal(); // Cierra también el formulario de compra
                    });
                }
            }).render('#paypal-button-container');
            cerrarModal();
        }

        // ✅ Función para abrir el modal
        function abrirModal() {
            document.getElementById('checkoutModal').style.display = 'flex';
        }

        // ❌ Función para cerrar el modal
        function cerrarModal() {
            document.getElementById('checkoutModal').style.display = 'none';
        }

        // 👷‍♂️ Mostrar sección si el usuario es técnico
        function mostrarSeccionTecnico() {
            let isTechnician = document.getElementById('is_technician').value;
            let section = document.getElementById('technicianSection');
            section.style.display = (isTechnician === 'yes') ? 'block' : 'none';
        }

        document.getElementById('requires_invoice').addEventListener('change', function() {
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

            // Renderizar botón de PayPal
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: calcularTotal()
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        alert('Pago exitoso: ' + details.payer.name.given_name);
                        procesarCompra();
                    });
                }
            }).render('#paypal-button-container');

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

        // También cerramos el menú cuando se hace clic en cualquiera de los enlaces


        window.addEventListener('scroll', function() {
            document.getElementById('navbar').classList.toggle('nav-active', window.scrollY > 50);
        });

        let carrito = {};

        const productos = {
            "Minisplit 1": {
                nombre: "AUFIT CHI-R32-12K-110/220",
                imagen: "/img/aufit-minisplit-1ton.jpg" // Ruta correcta para Laravel
            },
            "Minisplit 2": {
                nombre: "AUFIT CHI-R32-24K-220",
                imagen: "/img/aufit-minisplit-2ton.jpg" // Agrega esta imagen a la carpeta "public/img/"
            }
        };


        function agregarAlCarrito(producto) {
            if (!carrito[producto]) {
                carrito[producto] = 0;
            }
            carrito[producto]++;
            actualizarCarrito();

            document.getElementById('comprar-ya').style.display = 'none';
        }

        function scrollToProductos() {
            const seccionProductos = document.getElementById('productos');
            if (seccionProductos) {
                seccionProductos.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }

        document.getElementById('comprar-ya').addEventListener('click', function() {
            // Opción 1: desplazamiento suave nativo
            document.getElementById('productos').scrollIntoView({
                behavior: 'smooth'
            });

            // Opción 2: si quisieras usar Anchor:
            // window.location.hash = '#productos';
        });


        function eliminarDelCarrito(producto) {
            if (carrito[producto]) {
                carrito[producto]--;
                if (carrito[producto] === 0) {
                    delete carrito[producto];
                }
            }
            actualizarCarrito();
            // Si el carrito queda vacío, volvemos a mostrar el botón
            if (Object.keys(carrito).length === 0) {
                document.getElementById('comprar-ya').style.display = 'block';
            }
        }

        function actualizarCarrito() {
            const cartContainer = document.getElementById('cart-container');
            const cartItems = document.getElementById('cart-items');
            cartItems.innerHTML = '';

            Object.keys(carrito).forEach(producto => {
                const li = document.createElement('li');
                li.classList.add('cart-item');

                li.innerHTML = `
    <div class="cart-item-info">
        <img src="${productos[producto].imagen}" alt="${productos[producto].nombre}">
        <span>${productos[producto].nombre} (x${carrito[producto]})</span>
    </div>
    <button onclick="eliminarDelCarrito('${producto}')">❌</button>
    `;

                cartItems.appendChild(li);
            });

            // Muestra el carrito solo si hay productos
            cartContainer.style.display = Object.keys(carrito).length > 0 ? 'block' : 'none';
        }
    </script>

</body>

</html>
