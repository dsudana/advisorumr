<footer class="bg-gray-900 text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- Brand Column -->
            <div class="lg:col-span-1">
                <div class="flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-kaaba text-3xl text-emerald-500"></i>
                    <span class="font-serif text-2xl font-bold">{{ $site_settings->site_name ?? 'Adviso Umroh' }}</span>
                </div>
                <p class="text-gray-400 leading-relaxed mb-6">
                    Partner terpercaya perjalanan ibadah umroh dan haji Anda. Mengutamakan kenyamanan, kekhusyukan, dan kepuasan jamaah dengan layanan profesional.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-emerald-600 transition">
                        <i class="fa-brands fa-instagram text-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-emerald-600 transition">
                        <i class="fa-brands fa-facebook-f text-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-emerald-600 transition">
                        <i class="fa-brands fa-youtube text-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-emerald-600 transition">
                        <i class="fa-brands fa-tiktok text-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-bold text-lg mb-6 text-white">Tautan Cepat</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-emerald-400 transition flex items-center group"><i class="fa-solid fa-chevron-right text-xs mr-2 group-hover:text-emerald-400 transition"></i> Beranda</a></li>
                    <li><a href="{{ route('packages.index') }}" class="text-gray-400 hover:text-emerald-400 transition flex items-center group"><i class="fa-solid fa-chevron-right text-xs mr-2 group-hover:text-emerald-400 transition"></i> Paket Umroh</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="text-gray-400 hover:text-emerald-400 transition flex items-center group"><i class="fa-solid fa-chevron-right text-xs mr-2 group-hover:text-emerald-400 transition"></i> Galeri</a></li>
                    <li><a href="{{ route('articles.index') }}" class="text-gray-400 hover:text-emerald-400 transition flex items-center group"><i class="fa-solid fa-chevron-right text-xs mr-2 group-hover:text-emerald-400 transition"></i> Artikel & Blog</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-emerald-400 transition flex items-center group"><i class="fa-solid fa-chevron-right text-xs mr-2 group-hover:text-emerald-400 transition"></i> Tentang Kami</a></li>
                </ul>
            </div>

            <!-- Services -->
            <div>
                <h4 class="font-bold text-lg mb-6 text-white">Layanan</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition flex items-center group"><i class="fa-solid fa-chevron-right text-xs mr-2 group-hover:text-emerald-400 transition"></i> Umroh Reguler</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition flex items-center group"><i class="fa-solid fa-chevron-right text-xs mr-2 group-hover:text-emerald-400 transition"></i> Umroh VIP</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition flex items-center group"><i class="fa-solid fa-chevron-right text-xs mr-2 group-hover:text-emerald-400 transition"></i> Umroh Ramadan</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition flex items-center group"><i class="fa-solid fa-chevron-right text-xs mr-2 group-hover:text-emerald-400 transition"></i> Haji Furoda</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition flex items-center group"><i class="fa-solid fa-chevron-right text-xs mr-2 group-hover:text-emerald-400 transition"></i> Wisata Halal</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-bold text-lg mb-6 text-white">Hubungi Kami</h4>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <i class="fa-solid fa-location-dot mt-1 mr-3 text-emerald-500"></i>
                        <span class="text-gray-400">Jl. Sudirman No. 123, Jakarta Selatan, Indonesia</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fa-solid fa-phone mr-3 text-emerald-500"></i>
                        <span class="text-gray-400">+62 21 5555 8888</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fa-brands fa-whatsapp mr-3 text-emerald-500"></i>
                        <span class="text-gray-400">+62 812 3456 7890</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fa-solid fa-envelope mr-3 text-emerald-500"></i>
                        <span class="text-gray-400">info@advisoumroh.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} {{ $site_settings->site_name ?? 'Adviso Umroh' }}. All rights reserved.</p>
            <div class="flex space-x-6 text-sm">
                <a href="#" class="text-gray-500 hover:text-white transition">Privacy Policy</a>
                <a href="#" class="text-gray-500 hover:text-white transition">Terms of Service</a>
                <a href="#" class="text-gray-500 hover:text-white transition">Sitemap</a>
            </div>
        </div>
    </div>
</footer>