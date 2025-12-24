<x-landing-layout>
    @section('meta_title', 'About Us - ' . ($setting->site_name ?? 'Umroh Travel'))
    @section('meta_description', 'Tentang kami, biro perjalanan umroh terpercaya dengan pengalaman bertahun-tahun melayani jamaah.')

    <!-- Hero Section -->
    <div class="relative bg-emerald-900 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                About Us
            </h1>
            <p class="mt-4 text-xl text-emerald-100 max-w-3xl mx-auto">
                Melayani tamu Allah dengan sepenuh hati, amanah, dan profesional.
            </p>
        </div>
    </div>

    <!-- Company History & Vision -->
    <div class="py-16 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
                <div class="relative">
                    <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight sm:text-3xl">
                        Perjalanan Kami
                    </h3>
                    <p class="mt-3 text-lg text-gray-500">
                        Didirikan dengan niat suci untuk memfasilitasi umat Islam dalam menunaikan ibadah ke Tanah Suci,
                        {{ $setting->site_name ?? 'Umroh Travel' }} telah tumbuh menjadi partner terpercaya bagi ribuan
                        jamaah.
                    </p>
                    <p class="mt-3 text-lg text-gray-500">
                        Kami berkomitmen untuk memberikan pelayanan terbaik mulai dari pendaftaran, manasik,
                        keberangkatan,
                        selama di Tanah Suci, hingga kembali ke Tanah Air.
                    </p>

                    <dl class="mt-10 space-y-10">
                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-emerald-500 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Visi Kami</p>
                            </dt>
                            <dd class="ml-16 mt-2 text-base text-gray-500">
                                Menjadi penyelenggara perjalanan ibadah umroh dan haji yang amanah, profesional, dan
                                berstandar internasional.
                            </dd>
                        </div>

                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-emerald-500 text-white">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Misi Kami</p>
                            </dt>
                            <dd class="ml-16 mt-2 text-base text-gray-500">
                                Memberikan pelayanan prima, bimbingan ibadah sesuai sunnah, dan fasilitas yang nyaman
                                demi kekhusyukan ibadah jamaah.
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="mt-10 -mx-4 relative lg:mt-0" aria-hidden="true">
                    <img class="relative mx-auto rounded-3xl shadow-lg" width="490"
                        src="https://images.unsplash.com/photo-1564769662533-4f00a87b4056?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1414&q=80"
                        alt="Mekkah Ka'bah">
                </div>
            </div>
        </div>
    </div>
</x-landing-layout>