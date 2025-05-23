<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intranet Laus - Sistema de Gestión</title>
    <!-- Agregar la fuente Poppins de Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Cargar scripts de manera asíncrona -->
    <script src="https://cdn.tailwindcss.com" defer></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="preload" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
    
    <!-- Agregar estilos personalizados para aplicar Poppins -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <!-- Preloader -->
    <!-- Simplificar el preloader -->
    <div id="preloader" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
        <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-indigo-600"></div>
    </div>

    <!-- Navbar Mejorado -->
    <nav class="fixed w-full bg-white/90 backdrop-blur-sm shadow-lg z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-2xl font-bold text-indigo-600">Intranet Laus</span>
                    </div>
                    <div class="hidden md:flex md-ml-6 md:items-center md:space-x-4">
                        <a href="#inicio"
                            class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">Inicio</a>
                        <a href="#quienes-somos"
                            class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">Quiénes
                            Somos</a>
                        <a href="#servicios"
                            class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">Servicios</a>
                        <a href="#tecnologias"
                            class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">Tecnologías</a>
                        <a href="#blog"
                            class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">Blogs</a>
                        <a href="#contacto"
                            class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">Contacto</a>
                    </div>
                </div>
                <div class="flex items-center">
                    <a href="{{ route('personal') }}"
                        class="ml-8 inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 transform hover:scale-105 transition-all duration-300">
                        Iniciar Sesión
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section Mejorado -->
    <!-- Modificar la sección del hero -->
    <div class="relative bg-white overflow-hidden" id="inicio">
        <div class="absolute inset-0 z-0">
            <div
                class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 opacity-10 transform skew-y-6 parallax-bg">
            </div>
        </div>
        <div class="max-w-7xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32 pt-24">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left" data-aos="fade-right">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block">Gestión Empresarial</span>
                            <span class="block text-indigo-600">Simplificada</span>
                        </h1>
                        <p
                            class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                            Optimiza tus procesos internos con nuestra plataforma integral de gestión empresarial.
                            Diseñada para mejorar la eficiencia y productividad de tu organización.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="#contacto"
                                    class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10 transform hover:scale-105 transition-all duration-300">
                                    Comenzar
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <!-- Reemplazar las imágenes con versiones optimizadas y lazy loading -->
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full transform hover:scale-105 transition-all duration-500"
                src="https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&q=80&w=1200" loading="lazy"
                alt="Espacio de trabajo">
        </div>
    </div>

    <!-- Quiénes Somos Section Mejorado -->
    <div class="py-16 bg-gray-50" id="quienes-somos">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center" data-aos="fade-up">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Quiénes Somos</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Expertos en Soluciones Empresariales
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Somos un equipo dedicado a transformar la gestión empresarial a través de soluciones tecnológicas
                    innovadoras.
                </p>
            </div>

            <div class="mt-10">
                <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-3 md:gap-x-8 md:gap-y-10">
                    <!-- Características existentes con animaciones -->
                    <!-- Característica 1 -->
                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Gestión Eficiente</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Optimiza todos tus procesos internos con nuestras herramientas especializadas.
                        </dd>
                    </div>

                    <!-- Característica 2 -->
                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Recursos Humanos</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Gestiona tu equipo de manera efectiva con nuestro sistema integral.
                        </dd>
                    </div>

                    <!-- Característica 3 -->
                    <div class="relative">
                        <dt>
                            <div
                                class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Alto Rendimiento</p>
                        </dt>
                        <dd class="mt-2 ml-16 text-base text-gray-500">
                            Mejora la productividad de tu empresa con nuestras soluciones.
                        </dd>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Nueva Sección de Servicios -->
    <div class="py-16 bg-white" id="servicios">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-12" data-aos="fade-up">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Nuestros Servicios</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Soluciones Integrales para tu Empresa
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Tarjeta de Servicio 1 -->
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="text-indigo-500 mb-4">
                        <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Análisis Empresarial</h3>
                    <p class="text-gray-600">Análisis detallado de procesos y optimización de recursos para maximizar la
                        eficiencia operativa.</p>
                </div>

                <!-- Tarjeta de Servicio 2 -->
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="text-indigo-500 mb-4">
                        <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Gestión de Proyectos</h3>
                    <p class="text-gray-600">Herramientas avanzadas para la planificación y seguimiento de proyectos
                        empresariales.</p>
                </div>

                <!-- Tarjeta de Servicio 3 -->
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300"
                    data-aos="fade-up" data-aos-delay="300">
                    <div class="text-indigo-500 mb-4">
                        <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Soporte Técnico 24/7</h3>
                    <p class="text-gray-600">Asistencia técnica especializada disponible en todo momento para tu
                        empresa.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Agregar después de la sección de servicios -->
    <div class="py-16 bg-gray-50" id="tecnologias">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-12" data-aos="fade-up">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Tecnologías</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Herramientas que Utilizamos
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center justify-items-center">
                <!-- Reducir los delays en las animaciones -->
                <div class="tech-icon group" data-aos="fade-up" data-aos-delay="50">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP"
                        class="h-32 w-32 transition-transform duration-300 group-hover:scale-110">
                    <p class="text-center mt-4 text-gray-600 font-medium text-lg">PHP</p>
                </div>
                <div class="tech-icon group" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{ asset('laravel.jpg') }}" alt="Laravel"
                        class="h-32 w-32 transition-transform duration-300 group-hover:scale-110">
                    <p class="text-center mt-4 text-gray-600 font-medium text-lg">Laravel</p>
                </div>
                <div class="tech-icon group" data-aos="zoom-in" data-aos-delay="300">
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" alt="MySQL"
                        class="h-32 w-32 transition-transform duration-300 group-hover:scale-110">
                    <p class="text-center mt-4 text-gray-600 font-medium text-lg">MySQL</p>
                </div>
                <div class="tech-icon group" data-aos="zoom-in" data-aos-delay="400">
                    <img src="{{ asset('tailwind.png') }}" alt="Tailwind CSS"
                        class="h-32 w-32 transition-transform duration-300 group-hover:scale-110">
                    <p class="text-center mt-4 text-gray-600 font-medium text-lg">Tailwind CSS</p>
                </div>
            </div>
        </div>
    </div>


    <!-- Nueva Sección de Contacto -->
    <!-- Agregar antes de la sección de contacto -->
    <div class="py-16 bg-white" id="blog">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-12" data-aos="fade-up">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Blog</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Últimas Noticias
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:scale-105 cursor-pointer group"
                        data-aos="fade-up">
                        @if($post->image)
                            <div class="relative overflow-hidden">
                                <img src="{{ Storage::url($post->image) }}" alt="{{ $post->title }}"
                                    class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
                                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2 group-hover:text-indigo-600 transition-colors duration-300">{{ $post->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($post->content, 100) }}</p>
                            <button onclick="openModal('{{ $post->title }}', '{{ $post->content }}', '{{ Storage::url($post->image) }}')"
                                class="text-indigo-600 hover:text-indigo-800 font-medium inline-flex items-center transition-all duration-300 group-hover:translate-x-2">
                                Leer más
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center text-gray-500">
                        No hay publicaciones disponibles en este momento.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="py-12 bg-gray-50" id="contacto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-8" data-aos="fade-up">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Contacto</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    ¿Listo para Comenzar?
                </p>
            </div>

            <div class="max-w-lg mx-auto bg-white rounded-xl shadow-lg p-6" data-aos="fade-up" data-aos-delay="100">
                @if(session('success'))
                <div class="mb-4 p-3 text-sm text-green-700 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
                @endif
                @if($errors->any())
                <div class="mb-4 p-3 text-sm text-red-700 bg-red-100 rounded-lg">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form class="grid grid-cols-1 md:grid-cols-2 gap-4" method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="md:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Tu nombre">
                    </div>

                    <div class="md:col-span-1">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="tu@email.com">
                    </div>

                    <div class="md:col-span-2">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Teléfono
                            (Opcional)</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                            class="w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Tu teléfono">
                    </div>

                    <div class="md:col-span-2">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Mensaje</label>
                        <textarea name="message" id="message" rows="3"
                            class="w-full px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="Tu mensaje">{{ old('message') }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <button type="submit"
                            class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300">
                            Enviar Mensaje
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="postModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white w-11/12 md:w-4/5 lg:w-3/4 xl:w-2/3 rounded-lg overflow-hidden relative">
            <!-- Botón de cerrar -->
            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <div class="flex flex-col md:flex-row h-full">
                <!-- Imagen del post (60%) -->
                <div class="md:w-3/5">
                    <img id="modalImage" src="" alt="Post Image" class="w-full h-full object-cover">
                </div>

                <!-- Contenido del post (40%) -->
                <div class="md:w-2/5 p-8 overflow-y-auto max-h-[80vh]">
                    <h2 id="modalTitle" class="text-3xl font-bold mb-4"></h2>
                    <div id="modalContent" class="prose max-w-none text-gray-600"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer Mejorado -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">Intranet Laus</h3>
                    <p class="text-gray-400">Soluciones empresariales innovadoras para el futuro de tu negocio.</p>
                </div>
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">Enlaces Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="#inicio"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Inicio</a></li>
                        <li><a href="#quienes-somos"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Quiénes Somos</a>
                        </li>
                        <li><a href="#servicios"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Servicios</a></li>
                        <li><a href="#contacto"
                                class="text-gray-400 hover:text-white transition-colors duration-300">Contacto</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">Contacto</h3>
                    <p class="text-gray-400">Email: info@intranetalaus.com</p>
                    <p class="text-gray-400">Tel: +34 900 123 456</p>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-700 pt-8 text-center">
                <p class="text-base text-gray-400">&copy; {{ date('Y') }} Intranet Laus. Todos los derechos reservados.
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Inicialización optimizada
        document.addEventListener('DOMContentLoaded', () => {
            // Inicializar AOS con menos animaciones
            AOS.init({
                once: true,
                disable: window.innerWidth < 768,
                duration: 750
            });
    
            // Ocultar preloader más rápido
            const preloader = document.getElementById('preloader');
            window.addEventListener('load', () => {
                preloader.style.display = 'none';
            });
        });
    </script>

    <!-- Scripts consolidados -->
    <script>
        // Función para esperar a que el DOM esté cargado
    document.addEventListener('DOMContentLoaded', () => {
        // Inicialización de AOS
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });

        // Referencias a elementos del DOM
        const elements = {
            parallaxBg: document.querySelector('.parallax-bg'),
            preloader: document.getElementById('preloader'),
            mobileMenuButton: document.getElementById('mobile-menu-button'),
            mobileMenu: document.getElementById('mobile-menu'),
            backToTop: document.getElementById('back-to-top'),
            cookieBanner: document.getElementById('cookie-banner'),
            acceptCookies: document.getElementById('accept-cookies'),
            chatToggle: document.getElementById('chat-toggle'),
            chatBox: document.getElementById('chat-box')
        };

        // Efecto Parallax
        window.addEventListener('scroll', () => {
            if (elements.parallaxBg) {
                const scrolled = window.pageYOffset;
                elements.parallaxBg.style.transform = `translate3d(0, ${scrolled * 0.5}px, 0) skew-y-6`;
            }
        });

        // Preloader
        window.addEventListener('load', () => {
            if (elements.preloader) {
                elements.preloader.style.display = 'none';
            }
        });

        // Menú móvil
        if (elements.mobileMenuButton && elements.mobileMenu) {
            elements.mobileMenuButton.addEventListener('click', () => {
                elements.mobileMenu.classList.toggle('hidden');
            });
        }

        // Botón Volver Arriba
        if (elements.backToTop) {
            window.addEventListener('scroll', () => {
                elements.backToTop.classList.toggle('hidden', window.pageYOffset <= 100);
            });

            elements.backToTop.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }

        // Banner de Cookies
        if (elements.cookieBanner && elements.acceptCookies && !localStorage.getItem('cookiesAccepted')) {
            setTimeout(() => {
                elements.cookieBanner.style.transform = 'translateY(0)';
            }, 1000);

            elements.acceptCookies.addEventListener('click', () => {
                localStorage.setItem('cookiesAccepted', 'true');
                elements.cookieBanner.style.transform = 'translateY(100%)';
            });
        }
    });

    function openModal(title, content, imageUrl) {
    const modal = document.getElementById('postModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalContent = document.getElementById('modalContent');
    const modalImage = document.getElementById('modalImage');

    modalTitle.textContent = title;
    modalContent.textContent = content;
    modalImage.src = imageUrl;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('postModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// Cerrar modal con la tecla Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

// Cerrar modal al hacer clic fuera del contenido
document.getElementById('postModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
    </script>

</body>

</html>