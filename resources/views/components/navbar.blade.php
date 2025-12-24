<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-40 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="font-bold text-2xl text-emerald-600">
                        UmrohTravel
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('home') ? 'border-emerald-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        Home
                    </a>
                    <a href="#"
                        class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        Packages
                    </a>
                    <a href="{{ route('gallery.index') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('gallery.*') ? 'border-emerald-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        Gallery
                    </a>
                    <a href="{{ route('articles.index') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('articles.*') ? 'border-emerald-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        Artikel
                    </a>
                    <a href="{{ route('about') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('about') ? 'border-emerald-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        About Us
                    </a>
                    <a href="{{ route('contact') }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('contact') ? 'border-emerald-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out">
                        Contact
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-emerald-600 mr-4">Log in</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-emerald-600 text-white rounded-md text-sm font-medium hover:bg-emerald-700 transition">Register</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-b border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}"
                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('home') ? 'border-emerald-500 text-emerald-700 bg-emerald-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">
                Home
            </a>
            <a href="#"
                class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 text-base font-medium transition duration-150 ease-in-out">
                Packages
            </a>
            <a href="{{ route('gallery.index') }}"
                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('gallery.*') ? 'border-emerald-500 text-emerald-700 bg-emerald-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">
                Gallery
            </a>
            <a href="{{ route('articles.index') }}"
                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('articles.*') ? 'border-emerald-500 text-emerald-700 bg-emerald-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">
                Artikel
            </a>
            <a href="{{ route('about') }}"
                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('about') ? 'border-emerald-500 text-emerald-700 bg-emerald-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">
                About Us
            </a>
            <a href="{{ route('contact') }}"
                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('contact') ? 'border-emerald-500 text-emerald-700 bg-emerald-50' : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300' }} text-base font-medium transition duration-150 ease-in-out">
                Contact
            </a>
        </div>
        <div class="pt-4 pb-4 border-t border-gray-200">
            @auth
                <div class="mt-3 space-y-1">
                    <a href="{{ url('/dashboard') }}"
                        class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 text-base font-medium transition duration-150 ease-in-out">
                        Dashboard
                    </a>
                </div>
            @else
                <div class="mt-3 space-y-1 px-4">
                    <a href="{{ route('login') }}"
                        class="block w-full text-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 mb-2">
                        Log in
                    </a>
                    <a href="{{ route('register') }}"
                        class="block w-full text-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>