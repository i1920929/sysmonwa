<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYSMONWA - Sistema Inteligente de Monitoreo de Agua</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .hero-pattern {
            background-color: #0c4a6e;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cg fill='%230ea5e9' fill-opacity='0.1'%3E%3Cpath d='M0 0h40v40H0V0zm40 40h40v40H40V40zm0-40h2l-2 2V0zm0 4l4-4h2l-6 6V4zm0 4l8-8h2L40 10V8zm0 4L52 0h2L40 14v-2zm0 4L56 0h2L40 18v-2zm0 4L60 0h2L40 22v-2zm0 4L64 0h2L40 26v-2zm0 4L68 0h2L40 30v-2zm0 4L72 0h2L40 34v-2zm0 4L76 0h2L40 38v-2zm0 4L80 0v2L42 40h-2zm4 0L80 4v2L46 40h-2zm4 0L80 8v2L50 40h-2zm4 0l28-28v2L54 40h-2zm4 0l24-24v2L58 40h-2zm4 0l20-20v2L62 40h-2zm4 0l16-16v2L66 40h-2zm4 0l12-12v2L70 40h-2zm4 0l8-8v2l-6 6h-2zm4 0l4-4v2l-2 2h-2z'/%3E%3C/g%3E%3C/svg%3E");
        }
        .feature-card {
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .water-drop {
            animation: drop 2s infinite ease-in-out;
        }
        @keyframes drop {
            0% { transform: translateY(0); }
            50% { transform: translateY(10px); }
            100% { transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-md fixed w-full z-10">
        <nav class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <svg class="w-8 h-8 text-sky-600 water-drop" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 2h4v4"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 2l-5.5 5.5"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
                    </svg>
                    <span class="text-2xl font-bold text-sky-600 ml-2">SYSMONWA</span>
                </div>
                <div class="hidden md:flex space-x-6">
                    <a href="#caracteristicas" class="text-gray-800 hover:text-sky-600 transition-colors">Características</a>
                    <a href="#tecnologia" class="text-gray-800 hover:text-sky-600 transition-colors">Tecnología</a>
                    <a href="#beneficios" class="text-gray-800 hover:text-sky-600 transition-colors">Beneficios</a>
                    <a href="#contacto" class="text-gray-800 hover:text-sky-600 transition-colors">Contacto</a>
                </div>
                <div class="md:hidden">
                    <button class="text-gray-800 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero-pattern text-white py-32 mt-16">
            <div class="container mx-auto px-6 text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 animate-fade-in-down">
                    Monitoreo Inteligente del Agua
                </h1>
                <p class="text-xl md:text-2xl mb-12 animate-fade-in-up">
                    SYSMONWA: Control en tiempo real del nivel y calidad del agua para hogares e instituciones
                </p>
                <a href="#contacto" class="bg-white text-sky-600 px-8 py-3 rounded-full text-lg font-semibold hover:bg-sky-100 transition-colors animate-pulse">
                    Descubre SYSMONWA
                </a>
            </div>
        </section>

        <section id="caracteristicas" class="py-20">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center text-gray-800">Características Principales</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach([
                        ['icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z', 'title' => 'Monitoreo Preciso', 'description' => 'Medición exacta de pH, turbidez, temperatura y nivel del agua en tiempo real'],
                        ['icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'title' => 'Análisis Avanzado', 'description' => 'Procesamiento de datos con Machine Learning para insights valiosos'],
                        ['icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'title' => 'Visualización Intuitiva', 'description' => 'Dashboard responsivo para fácil interpretación de datos'],
                        ['icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9', 'title' => 'Alertas Instantáneas', 'description' => 'Notificaciones inmediatas ante anomalías en la calidad del agua'],
                        ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => 'Seguridad Garantizada', 'description' => 'Protección de datos y cumplimiento con normativas de privacidad'],
                        ['icon' => 'M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z', 'title' => 'Adaptabilidad Total', 'description' => 'Solución versátil para hogares, empresas e instituciones'],
                    ] as $feature)
                        <div class="feature-card bg-white rounded-lg shadow-md p-6">
                            <div class="flex items-center mb-4">
                                <svg class="w-8 h-8 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $feature['icon'] }}"></path>
                                </svg>
                                <h3 class="text-xl font-semibold ml-4">{{ $feature['title'] }}</h3>
                            </div>
                            <p class="text-gray-600">{{ $feature['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="tecnologia" class="py-20 bg-gray-100">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center text-gray-800">Tecnología de Vanguardia</h2>
                <div class="flex flex-col md:flex-row items-center justify-center gap-12">
                    <div class="md:w-1/2">
                        <img src="https://i.imgur.com/ZXWWwGs.jpg" alt="Sensores IoT de SYSMONWA" class="rounded-lg shadow-lg w-full h-auto">
                    </div>
                    <div class="md:w-1/2 space-y-6">
                        <h3 class="text-2xl font-semibold text-gray-800">IoT y Machine Learning Integrados</h3>
                        <p class="text-lg text-gray-600">
                            SYSMONWA fusiona sensores IoT de última generación con algoritmos avanzados de Machine Learning, ofreciendo una solución completa para el monitoreo y gestión del agua.
                        </p>
                        <ul class="list-disc list-inside space-y-2 text-gray-600">
                            <li>Sensores de alta precisión con conectividad inalámbrica</li>
                            <li>Análisis predictivo para prevención de problemas</li>
                            <li>Integración con sistemas domóticos y de gestión de edificios</li>
                            <li>Actualizaciones automáticas para mejora continua</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="beneficios" class="py-20 bg-sky-600 text-white">
            <div class="container mx-auto px-6">
                <h2  class="text-3xl md:text-4xl font-bold mb-12 text-center">Beneficios de SYSMONWA</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach([
                        ['title' => 'Ahorro Significativo', 'description' => 'Reduce el consumo de agua y los costos asociados'],
                        ['title' => 'Calidad Garantizada', 'description' => 'Asegura agua limpia y segura para todos los usuarios'],
                        ['title' => 'Gestión Sostenible', 'description' => 'Promueve un uso responsable de los recursos hídricos'],
                        ['title' => 'Mantenimiento Preventivo', 'description' => 'Anticipa y previene problemas en los sistemas de agua'],
                        ['title' => 'Cumplimiento Normativo', 'description' => 'Ayuda a cumplir con regulaciones de calidad del agua'],
                        ['title' => 'Tranquilidad Total', 'description' => 'Monitoreo constante para tu seguridad y comodidad'],
                    ] as $benefit)
                        <div class="bg-white bg-opacity-10 p-6 rounded-lg">
                            <h3 class="text-xl font-semibold mb-4">{{ $benefit['title'] }}</h3>
                            <p>{{ $benefit['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

         <!-- Contact section with form -->
         <section id="contacto" class="py-20">
            <div class="container mx-auto px-6 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-gray-800">¿Listo para Revolucionar tu Gestión del Agua?</h2>
                <p class="text-xl mb-10 text-gray-600">Contacta con nosotros hoy para una demostración personalizada de SYSMONWA</p>

                <form action="#" method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <input type="text" name="nombre" placeholder="Nombre completo" class="border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-sky-600">
                        <input type="email" name="email" placeholder="Correo electrónico" class="border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-sky-600">
                    </div>
                    <textarea name="mensaje" placeholder="Tu mensaje" class="border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-sky-600 w-full"></textarea>
                    <button type="submit" class="bg-primary text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-sky-700 transition-colors">
                        Enviar Mensaje
                    </button>
                </form>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-10">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-2xl font-bold">SYSMONWA</h3>
                    <p>Sistema Inteligente de Monitoreo de Agua</p>
                </div>
                <nav class="flex flex-wrap justify-center gap-4">
                    <a href="#caracteristicas" class="hover:text-sky-400 transition-colors">Características</a>
                    <a href="#tecnologia" class="hover:text-sky-400 transition-colors">Tecnología</a>
                    <a href="#beneficios" class="hover:text-sky-400 transition-colors">Beneficios</a>
                    <a href="#contacto" class="hover:text-sky-400 transition-colors">Contacto</a>
                </nav>
            </div>
            <div class="mt-8 text-center text-sm">
                © {{ date('Y') }} SYSMONWA. Todos los derechos reservados.
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Mobile menu toggle
        const mobileMenuButton = document.querySelector('.md\\:hidden button');
        const mobileMenu = document.querySelector('.md\\:flex');
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>