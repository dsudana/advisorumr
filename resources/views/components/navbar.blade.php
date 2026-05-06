<nav x-data="{ open: false, scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-lg' : 'bg-transparent'"
     class="fixed w-full top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center gap-2">
                <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                    <i class="fa-solid fa-kaaba text-3xl text-emerald-700 group-hover:text-emerald-600 transition"></i>
                    <span class="font-serif text-2xl font-bold text-emerald-700 tracking-tight">{{ $site_settings->site_name ?? 'Adviso Umroh' }}</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('home') }}" 
                   class="{{ request()->routeIs('home') ? 'text-emerald-700 font-semibold' : 'text-gray-700 hover:text-emerald-700' }} font-medium transition">
                    Beranda
                </a>
                <a href="{{ route('packages.index') }}" 
                   class="{{ request()->routeIs('packages.*') ? 'text-emerald-700 font-semibold' : 'text-gray-700 hover:text-emerald-700' }} font-medium transition">
                    Paket Umroh
                </a>
                <a href="{{ route('gallery.index') }}" 
                   class="{{ request()->routeIs('gallery.*') ? 'text-emerald-700 font-semibold' : 'text-gray-700 hover:text-emerald-700' }} font-medium transition">
                    Galeri
                </a>
                <a href="{{ route('articles.index') }}" 
                   class="{{ request()->routeIs('articles.*') ? 'text-emerald-700 font-semibold' : 'text-gray-700 hover:text-emerald-700' }} font-medium transition">
                    Artikel
                </a>
                <a href="{{ route('about') }}" 
                   class="{{ request()->routeIs('about') ? 'text-emerald-700 font-semibold' : 'text-gray-700 hover:text-emerald-700' }} font-medium transition">
                    Tentang Kami
                </a>
                <a href="{{ route('contact') }}" 
                   class="bg-emerald-700 text-white px-6 py-2.5 rounded-full font-medium hover:bg-emerald-800 transition shadow-lg shadow-emerald-900/20 transform hover:-translate-y-0.5">
                    Konsultasi Gratis
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="open = ! open" 
                        class="text-gray-700 hover:text-emerald-700 focus:outline-none p-2">
                    <i class="fa-solid fa-bars text-2xl" x-show="!open"></i>
                    <i class="fa-solid fa-xmark text-2xl" x-show="open" x-cloak></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-white border-t border-gray-100 shadow-xl"
         x-cloak>
        <div class="pt-2 pb-4 space-y-1 px-4">
            <a href="{{ route('home') }}" 
               class="block px-3 py-3 rounded-lg {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }} font-medium transition">
                Beranda
            </a>
            <a href="{{ route('packages.index') }}" 
               class="block px-3 py-3 rounded-lg {{ request()->routeIs('packages.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }} font-medium transition">
                Paket Umroh
            </a>
            <a href="{{ route('gallery.index') }}" 
               class="block px-3 py-3 rounded-lg {{ request()->routeIs('gallery.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }} font-medium transition">
                Galeri
            </a>
            <a href="{{ route('articles.index') }}" 
               class="block px-3 py-3 rounded-lg {{ request()->routeIs('articles.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }} font-medium transition">
                Artikel
            </a>
            <a href="{{ route('about') }}" 
               class="block px-3 py-3 rounded-lg {{ request()->routeIs('about') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }} font-medium transition">
                Tentang Kami
            </a>
            <a href="{{ route('contact') }}" 
               class="block mt-4 px-3 py-3 bg-emerald-700 text-white text-center rounded-lg font-medium hover:bg-emerald-800 transition">
                Konsultasi Gratis
            </a>
            
            @auth
                <div class="border-t border-gray-100 pt-3 mt-2">
                    <a href="{{ url('/dashboard') }}" 
                       class="block px-3 py-3 text-gray-700 font-medium hover:bg-gray-50 rounded-lg transition">
                        Dashboard
                    </a>
                </div>
            @else
                <div class="border-t border-gray-100 pt-3 mt-2 space-y-2">
                    <a href="{{ route('login') }}" 
                       class="block w-full text-center px-4 py-3 border border-gray-300 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" 
                       class="block w-full text-center px-4 py-3 bg-emerald-700 text-white rounded-lg font-medium hover:bg-emerald-800 transition">
                        Daftar Sekarang
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>