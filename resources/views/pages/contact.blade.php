<x-landing-layout>
    @section('meta_title', 'Contact Us - ' . ($setting->site_name ?? 'Umroh Travel'))
    @section('meta_description', 'Hubungi kami untuk konsultasi dan pendaftaran paket umroh.')

    <!-- Hero Section -->
    <div class="relative bg-emerald-900 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Contact Us
            </h1>
            <p class="mt-4 text-xl text-emerald-100 max-w-3xl mx-auto">
                Kami siap membantu menjawab pertanyaan Anda seputar paket umroh dan pendaftaran.
            </p>
        </div>
    </div>

    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div>
                    <h2 class="text-2xl font-extrabold text-gray-900 sm:text-3xl mb-6">
                        Informasi Kontak
                    </h2>
                    <p class="text-lg text-gray-500 mb-8">
                        Silakan kunjungi kantor kami atau hubungi kami melalui telepon dan email di bawah ini.
                    </p>

                    <dl class="space-y-8">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex items-center justify-center h-12 w-12 rounded-md bg-emerald-100 text-emerald-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5">
                                <dt class="text-lg leading-6 font-medium text-gray-900">Alamat</dt>
                                <dd class="mt-2 text-base text-gray-500">
                                    {{ $setting->address ?? 'Jl. Jendral Sudirman No. 123, Jakarta Selatan' }}
                                </dd>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex items-center justify-center h-12 w-12 rounded-md bg-emerald-100 text-emerald-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5">
                                <dt class="text-lg leading-6 font-medium text-gray-900">Telepon</dt>
                                <dd class="mt-2 text-base text-gray-500">
                                    {{ $setting->contact_phone ?? '+62 812 3456 7890' }}
                                </dd>
                            </div>
                        </div>

                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div
                                    class="flex items-center justify-center h-12 w-12 rounded-md bg-emerald-100 text-emerald-600">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5">
                                <dt class="text-lg leading-6 font-medium text-gray-900">Email</dt>
                                <dd class="mt-2 text-base text-gray-500">
                                    {{ $setting->contact_email ?? 'info@umrohtravel.com' }}
                                </dd>
                            </div>
                        </div>
                    </dl>

                    <!-- Social Media -->
                    <div class="mt-10">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Ikuti Kami</h3>
                        <div class="flex space-x-6">
                            @if($setting->facebook_url)
                                <a href="{{ $setting->facebook_url }}"
                                    class="text-gray-400 hover:text-emerald-600 transition">
                                    <span class="sr-only">Facebook</span>
                                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif
                            @if($setting->instagram_url)
                                <a href="{{ $setting->instagram_url }}"
                                    class="text-gray-400 hover:text-emerald-600 transition">
                                    <span class="sr-only">Instagram</span>
                                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.488 2h-.173zM12.314 4.172c-2.38 0-2.673.003-3.606.052-.782.037-1.206.173-1.487.276a2.91 2.91 0 00-1.063.693 2.91 2.91 0 00-.693 1.063c-.103.281-.239.705-.276 1.487-.049.932-.052 1.225-.052 3.606V11.66c0 2.38.003 2.673.052 3.606.037.782.173 1.206.276 1.487.18.468.411.859.693 1.063.297.208.688.441 1.063.693.281.103.705.239 1.487.276.932.049 1.225.052 3.606.052 2.33 0 2.677-.003 3.606-.052.782-.037 1.206-.173 1.487-.276.468-.18.859-.411 1.063-.693.208-.297.441-.688.693-1.063.103-.281.239-.705.276-1.487.049-.932.052-1.225.052-3.606 0-2.327-.003-2.673-.052-3.606-.037-.782-.173-1.206-.276-1.487a2.91 2.91 0 00-.693-1.063 2.91 2.91 0 00-1.063-.693c-.281-.103-.705-.239-1.487-.276-.932-.049-1.225-.052-3.606-.052zm0 3.328a4.5 4.5 0 110 9 4.5 4.5 0 010-9zm0 1.666a2.834 2.834 0 100 5.668 2.834 2.834 0 000-5.668zm5.558-4.148a1.067 1.067 0 110 2.134 1.067 1.067 0 010-2.134z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endif
                            @if($setting->tiktok_url)
                                <a href="{{ $setting->tiktok_url }}"
                                    class="text-gray-400 hover:text-emerald-600 transition">
                                    <span class="sr-only">TikTok</span>
                                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" />
                                    </svg>
                                </a>
                            @endif
                            @if($setting->twitter_url)
                                <a href="{{ $setting->twitter_url }}"
                                    class="text-gray-400 hover:text-emerald-600 transition">
                                    <span class="sr-only">Twitter</span>
                                    <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="h-96 w-full bg-gray-100 rounded-3xl overflow-hidden shadow-lg">
                    @if($setting->google_maps_embed)
                        {!! $setting->google_maps_embed !!}
                    @else
                        <div class="flex items-center justify-center h-full text-gray-400">
                            Peta tidak tersedia
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-landing-layout>