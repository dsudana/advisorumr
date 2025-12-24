<x-landing-layout>
    @section('meta_title', 'Umroh Travel - Trusted Umroh & Hajj Services')
    @section('meta_description',
        'Book your spiritual journey with Umroh Travel. Best facilities, experienced Muthawif,
        and affordable packages.')

    @push('seo')
        <!-- Organization Schema -->
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "name": "{{ $site_settings->site_name }}",
          "url": "{{ url('/') }}",
          "logo": "{{ $site_settings->logo_path ? Storage::url($site_settings->logo_path) : asset('images/logo.png') }}",
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "{{ $site_settings->contact_phone }}",
            "contactType": "customer service",
            "areaServed": "ID",
            "availableLanguage": "Indonesian"
          },
          "sameAs": [
            "{{ $site_settings->facebook_url }}",
            "{{ $site_settings->instagram_url }}",
            "{{ $site_settings->tiktok_url }}",
            "{{ $site_settings->twitter_url }}",
            "{{ $site_settings->youtube_url }}"
          ]
        }
        </script>
    @endpush
        <div class="relative bg-emerald-900 hero-pattern overflow-hidden h-[640px]" x-data="{
            currentSlide: 0,
            images: [
                @if (isset($heroImages) && $heroImages->count() > 0) @foreach ($heroImages as $image)
                    '{{ asset('storage/' . $image->image_path) }}',
                @endforeach
            @else
                'https://images.unsplash.com/photo-1565552629477-ff9a43a02499?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80',
                'https://images.unsplash.com/photo-1519817650394-63020a6d1c93?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80',
                'https://images.unsplash.com/photo-1542385151-ef275392b239?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80',
                'https://images.unsplash.com/photo-1596525996965-c990dc040243?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80' @endif
            ],
            init() {
                setInterval(() => {
                    this.currentSlide = (this.currentSlide + 1) % this.images.length;
                }, 5000);
            }
        }">
            <!-- Slider Backgrounds -->
            <template x-for="(image, index) in images" :key="index">
                <div class="absolute inset-0 bg-cover z-0 bg-center transition-opacity duration-1000 ease-in-out w-full"
                    :style="`background-image: url('${image}')`" x-show="currentSlide === index"
                    x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                </div>
            </template>

            <!-- Deep Color Overlay -->
            <div class="absolute inset-0 z-10 bg-emerald-900/90"></div>

            <!-- Pattern Overlay -->
            <div
                class="absolute inset-0 z-10 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]">
            </div>

            <!-- Background Decor (Blobs) -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-20 pointer-events-none">
                <div
                    class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-emerald-500 opacity-20 blur-3xl mix-blend-screen animate-pulse">
                </div>
                <div
                    class="absolute top-1/2 -right-24 w-72 h-72 rounded-full bg-teal-400 opacity-20 blur-3xl mix-blend-screen">
                </div>
            </div>

            <div
                class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-48 lg:pt-40 lg:pb-56 z-20 flex flex-col items-center text-center">
                <span
                    class="inline-block py-1 px-3 rounded-full bg-emerald-800/50 border border-emerald-700 text-emerald-300 text-sm font-medium mb-6 backdrop-blur-sm">
                    ✨ #1 Trusted Umroh Travel Agency
                </span>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white tracking-tight leading-tight mb-6">
                    Journey to the <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-200 to-teal-200">Heart of
                        Islam</span>
                </h1>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-emerald-100/90 leading-relaxed font-light">
                    Experience a spiritual pilgrimage like never before. Premium facilities, expert guidance, and a journey
                    focused on your worship.
                </p>

                <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center w-full max-w-lg">
                    <a href="{{ route('packages.index') }}"
                        class="inline-flex justify-center items-center px-8 py-4 border border-transparent text-base font-bold rounded-full text-emerald-900 bg-white hover:bg-emerald-50 md:text-lg shadow-lg hover:shadow-emerald-900/20 transform hover:-translate-y-1 transition-all duration-300">
                        Book Your Seat
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <a href="#featured"
                        class="inline-flex justify-center items-center px-8 py-4 border border-emerald-500/30 text-base font-bold rounded-full text-white bg-emerald-800/20 hover:bg-emerald-800/40 backdrop-blur-md md:text-lg transition-all duration-300">
                        Explore Packages
                    </a>
                </div>
            </div>
        </div>

        <!-- Modern Search Bar -->
        <div class="relative z-30 -mt-24 px-4 sm:px-6 lg:px-8 max-w-6xl mx-auto">
            <div class="glass-effect rounded-2xl shadow-2xl p-6 md:p-8 border border-white/20">
                <form action="{{ route('packages.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <div class="md:col-span-4 group">
                        <label for="search"
                            class="block text-xs font-bold uppercase text-emerald-800 tracking-wider mb-2">Destination /
                            Package</label>
                        <div class="relative flex items-center">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 group-focus-within:text-emerald-600 transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" name="search" id="search" placeholder="e.g. Umroh Ramadhan"
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-0 rounded-xl text-gray-900 placeholder-gray-400 font-medium transition-all">
                        </div>
                    </div>
                    <div class="md:col-span-3 group">
                        <label for="month"
                            class="block text-xs font-bold uppercase text-emerald-800 tracking-wider mb-2">Departure
                            Date</label>
                        <div class="relative flex items-center">
                            <input type="month" name="month" id="month"
                                class="w-full px-4 py-3 bg-gray-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-0 rounded-xl text-gray-900 font-medium transition-all cursor-pointer">
                        </div>
                    </div>
                    <div class="md:col-span-3 group">
                        <label for="category"
                            class="block text-xs font-bold uppercase text-emerald-800 tracking-wider mb-2">Package
                            Type</label>
                        <div class="relative flex items-center">
                            <select name="category" id="category"
                                class="w-full px-4 py-3 bg-gray-50 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-0 rounded-xl text-gray-900 font-medium transition-all cursor-pointer appearance-none">
                                <option value="">All Categories</option>
                                <option value="reguler">Reguler</option>
                                <option value="plus">Plus</option>
                                <option value="vip">VIP</option>
                            </select>
                            <svg class="w-5 h-5 text-gray-400 absolute right-3 pointer-events-none" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <div class="md:col-span-2 flex items-end">
                        <button type="submit"
                            class="w-full py-3 px-6 bg-gradient-to-r from-emerald-600 to-teal-500 hover:from-emerald-700 hover:to-teal-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Stats / Trusted By -->
        <div class="bg-white pt-24 pb-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-gray-100">
                    <div class="p-4">
                        <p class="text-4xl font-extrabold text-emerald-600 mb-1">5K+</p>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Happy Pilgrims</p>
                    </div>
                    <div class="p-4">
                        <p class="text-4xl font-extrabold text-emerald-600 mb-1">98%</p>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Satisfaction Rate</p>
                    </div>
                    <div class="p-4">
                        <p class="text-4xl font-extrabold text-emerald-600 mb-1">24/7</p>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Dedicated Support</p>
                    </div>
                    <div class="p-4">
                        <p class="text-4xl font-extrabold text-emerald-600 mb-1">10+</p>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Years Experience</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Packages -->
        <div id="featured" class="bg-gray-50 py-20 lg:py-28 relative overflow-hidden">
            <!-- Decorative blobs -->
            <div class="absolute top-0 right-0 -mr-24 -mt-24 w-96 h-96 rounded-full bg-emerald-100 opacity-50 blur-3xl">
            </div>
            <div class="absolute bottom-0 left-0 -ml-24 -mb-24 w-80 h-80 rounded-full bg-teal-100 opacity-50 blur-3xl">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-emerald-600 font-bold tracking-wide uppercase text-sm mb-3">Exclusive Offerings</h2>
                    <h3 class="text-4xl font-bold text-gray-900 mb-4 leading-tight">Popular Umroh Packages</h3>
                    <p class="text-gray-500 text-lg">Curated journeys designed for your comfort and spiritual focus.</p>
                </div>

                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse($featuredPackages as $package)
                        <div
                            class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col border border-gray-100 relative">
                            <!-- Image Container -->
                            <div class="relative h-64 overflow-hidden">
                                <div
                                    class="absolute inset-0 bg-gray-900/10 group-hover:bg-gray-900/0 transition-colors z-10">
                                </div>
                                <img src="{{ $package->image ? Storage::url($package->image) : 'https://images.unsplash.com/photo-1591604129930-9877716fd5ee?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80' }}"
                                    alt="{{ $package->name }}"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">

                                <!-- Category Badge -->
                                <div class="absolute top-4 left-4 z-20">
                                    <span
                                        class="px-3 py-1 bg-white/90 backdrop-blur text-emerald-800 text-xs font-bold uppercase tracking-wider rounded-lg shadow-sm">
                                        {{ $package->category }}
                                    </span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-8 flex-1 flex flex-col">
                                <div class="flex items-center space-x-2 mb-4">
                                    <span
                                        class="flex items-center text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-md">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $package->duration_days }} Days
                                    </span>
                                    <span
                                        class="flex items-center text-xs font-semibold text-amber-600 bg-amber-50 px-2.5 py-1 rounded-md">
                                        <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        {{ $package->makkah_hotel_stars }}★ Hotel
                                    </span>
                                </div>

                                <a href="{{ route('packages.show', $package) }}"
                                    class="block flex-1 group-hover:text-emerald-700 transition-colors">
                                    <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $package->name }}</h3>
                                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-6">
                                        {{ $package->short_description }}
                                    </p>
                                </a>

                                <div class="pt-6 border-t border-gray-100 flex items-center justify-between mt-auto">
                                    <div>
                                        <p class="text-xs text-gray-400 font-medium uppercase tracking-wide">Best Price</p>
                                        <div class="flex items-baseline">
                                            <span class="text-sm font-bold text-emerald-600">Rp</span>
                                            <span
                                                class="text-2xl font-extrabold text-gray-900 mx-1">{{ number_format($package->price / 1000000, 1, ',', '.') }}</span>
                                            <span class="text-sm font-bold text-gray-500">Jt</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('packages.show', $package) }}"
                                        class="inline-flex justify-center items-center w-12 h-12 rounded-full bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div
                            class="col-span-3 text-center py-24 bg-white rounded-3xl border border-dashed border-gray-300">
                            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-50 mb-4">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">No Packages Found</h3>
                            <p class="text-gray-500">We couldn't find any packages matching your criteria.</p>
                            <a href="{{ route('packages.index') }}"
                                class="inline-block mt-6 text-emerald-600 font-bold hover:underline">View All Packages</a>
                        </div>
                    @endforelse
                </div>

                <div class="mt-16 text-center">
                    <a href="{{ route('packages.index') }}"
                        class="inline-flex items-center px-8 py-4 border-2 border-emerald-600 text-emerald-600 font-bold rounded-full hover:bg-emerald-600 hover:text-white transition-all duration-300">
                        View Complete Catalog
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Latest Articles -->
        <div class="py-20 lg:py-28 bg-white relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                    <div class="max-w-2xl">
                        <h2 class="text-emerald-600 font-bold tracking-wide uppercase text-sm mb-3">From Our Blog</h2>
                        <h3 class="text-4xl font-bold text-gray-900 leading-tight">Latest News & Articles</h3>
                    </div>
                    <a href="{{ route('articles.index') }}"
                        class="hidden md:inline-flex items-center text-emerald-600 font-bold hover:text-emerald-700 transition-colors">
                        View All Articles
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>

                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse($articles as $article)
                        <article
                            class="flex flex-col bg-gray-50 rounded-3xl overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <a href="{{ route('articles.show', $article->slug) }}"
                                class="block relative h-64 overflow-hidden group">
                                <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://images.unsplash.com/photo-1565552629477-ff9a43a02499?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80' }}"
                                    alt="{{ $article->title }}"
                                    class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                @if ($article->category)
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="px-3 py-1 bg-white/90 backdrop-blur text-emerald-800 text-xs font-bold uppercase tracking-wider rounded-lg shadow-sm">
                                            {{ $article->category->name }}
                                        </span>
                                    </div>
                                @endif
                            </a>
                            <div class="p-8 flex-1 flex flex-col">
                                <div class="text-xs text-gray-500 font-medium mb-3 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-emerald-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $article->published_at->format('d M Y') }}
                                </div>
                                <a href="{{ route('articles.show', $article->slug) }}" class="block group">
                                    <h3
                                        class="text-xl font-bold text-gray-900 mb-3 group-hover:text-emerald-600 transition-colors line-clamp-2">
                                        {{ $article->title }}
                                    </h3>
                                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-6">
                                        {{ Str::limit(strip_tags($article->content), 100) }}
                                    </p>
                                </a>
                                <div class="mt-auto pt-6 border-t border-gray-200">
                                    <a href="{{ route('articles.show', $article->slug) }}"
                                        class="text-emerald-600 font-bold text-sm hover:text-emerald-700 transition-colors flex items-center">
                                        Read More
                                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <p class="text-gray-500">No articles found.</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-12 text-center md:hidden">
                    <a href="{{ route('articles.index') }}"
                        class="inline-flex items-center px-6 py-3 border border-emerald-600 text-emerald-600 font-bold rounded-full hover:bg-emerald-50 transition-colors">
                        View All Articles
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="py-24 bg-emerald-50 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div
                class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-emerald-200 opacity-20 blur-3xl mix-blend-multiply">
            </div>
            <div
                class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-teal-200 opacity-20 blur-3xl mix-blend-multiply">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-emerald-600 font-bold tracking-wide uppercase text-sm mb-3">Testimonials</h2>
                <h3 class="text-4xl font-bold text-gray-900 mb-4 leading-tight">What Our Pilgrims Say</h3>
                <p class="text-gray-500 text-lg">Hear from those who have journeyed with us to the Holy Land.</p>
            </div>

            <div x-data="{
                activeSlide: 0,
                slides: {{ $testimonials->count() }},
                autoplayInterval: null,
                next() {
                    this.activeSlide = (this.activeSlide + 1) % this.slides;
                },
                prev() {
                    this.activeSlide = (this.activeSlide - 1 + this.slides) % this.slides;
                },
                startAutoplay() {
                    this.autoplayInterval = setInterval(() => {
                        this.next();
                    }, 5000);
                },
                stopAutoplay() {
                    clearInterval(this.autoplayInterval);
                }
            }" x-init="startAutoplay()" @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()"
                class="relative max-w-4xl mx-auto">

                <!-- Slides -->
                <div class="relative overflow-hidden min-h-[500px] rounded-3xl bg-white shadow-xl p-8 md:p-12">
                    @forelse($testimonials as $index => $testimonial)
                        <div x-show="activeSlide === {{ $index }}"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 transform translate-x-10"
                            x-transition:enter-end="opacity-100 transform translate-x-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform translate-x-0"
                            x-transition:leave-end="opacity-0 transform -translate-x-10" class="absolute inset-0 p-8 md:p-12 flex flex-col justify-center items-center text-center">
                            
                            <div class="mb-6 relative">
                                <div class="absolute inset-0 bg-emerald-100 rounded-full transform rotate-6 scale-110"></div>
                                <img src="{{ $testimonial->photo ? asset('storage/' . $testimonial->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($testimonial->name) . '&background=10b981&color=fff' }}"
                                    alt="{{ $testimonial->name }}"
                                    class="relative w-20 h-20 rounded-full object-cover border-4 border-white shadow-md">
                            </div>

                            <div class="flex text-amber-400 mb-6 space-x-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-6 h-6 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>

                            <blockquote class="text-xl md:text-2xl text-gray-800 font-medium leading-relaxed mb-6">
                                "{{ $testimonial->content }}"
                            </blockquote>

                            <div>
                                <h4 class="text-lg font-bold text-gray-900">{{ $testimonial->name }}</h4>
                                @if($testimonial->position)
                                    <p class="text-emerald-600 font-medium text-sm">{{ $testimonial->position }}</p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="absolute inset-0 flex flex-col justify-center items-center text-center p-12">
                            <p class="text-gray-500 text-lg">No testimonials yet.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Navigation Buttons -->
                @if($testimonials->count() > 1)
                    <button @click="prev()"
                        class="absolute top-1/2 -left-4 md:-left-12 transform -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-emerald-600 hover:bg-emerald-50 hover:scale-110 transition-all z-20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button @click="next()"
                        class="absolute top-1/2 -right-4 md:-right-12 transform -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 bg-white rounded-full shadow-lg flex items-center justify-center text-emerald-600 hover:bg-emerald-50 hover:scale-110 transition-all z-20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Dots -->
                    <div class="flex justify-center space-x-2 mt-8">
                        @foreach($testimonials as $index => $testimonial)
                            <button @click="activeSlide = {{ $index }}"
                                :class="{'w-8 bg-emerald-600': activeSlide === {{ $index }}, 'w-2.5 bg-emerald-200': activeSlide !== {{ $index }}}"
                                class="h-2.5 rounded-full transition-all duration-300"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Latest Activities / Gallery Section -->
    <div class="py-20 lg:py-28 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                <div class="max-w-2xl">
                    <h2 class="text-emerald-600 font-bold tracking-wide uppercase text-sm mb-3">Activity Log</h2>
                    <h3 class="text-4xl font-bold text-gray-900 leading-tight">Recent Journey Moments</h3>
                </div>
                <a href="{{ route('gallery.index') }}"
                    class="hidden md:inline-flex items-center text-emerald-600 font-bold hover:text-emerald-700 transition-colors">
                    View Full Gallery
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>

            <!-- Gallery Carousel -->
            <div class="relative" x-data="{
                activeSlide: 0,
                slides: {{ count($activities) }},
                visibleSlides: window.innerWidth >= 768 ? 3 : 1,
                next() {
                    const maxStart = this.slides - this.visibleSlides;
                    if (this.activeSlide < maxStart) {
                        this.activeSlide++;
                    } else {
                        this.activeSlide = 0;
                    }
                },
                prev() {
                    if (this.activeSlide > 0) {
                        this.activeSlide--;
                    } else {
                        const maxStart = this.slides - this.visibleSlides;
                        this.activeSlide = maxStart;
                    }
                },
                init() {
                    window.addEventListener('resize', () => {
                        this.visibleSlides = window.innerWidth >= 768 ? 3 : 1;
                    });
                }
            }">
                
                <!-- Navigation Buttons -->
                <div class="flex justify-end space-x-2 mb-4 md:absolute md:-top-24 md:right-0">
                    <button @click="prev()" 
                        class="p-2 rounded-full border border-emerald-600 text-emerald-600 hover:bg-emerald-50 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                    <button @click="next()" 
                        class="p-2 rounded-full bg-emerald-600 text-white hover:bg-emerald-700 transition-colors shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>

                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-in-out gap-8"
                        :style="`transform: translateX(-${activeSlide * (100 / visibleSlides)}%)`">
                        @forelse($activities as $activity)
                            <div class="flex-shrink-0 w-full md:w-[calc(33.333%_-_1.33rem)] group relative overflow-hidden rounded-3xl cursor-pointer h-80 hover:shadow-xl transition-all duration-300">
                                <img src="{{ Storage::url($activity->image) }}" alt="{{ $activity->title }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-90 transition-opacity duration-300">
                                    <div class="absolute bottom-0 left-0 p-8 w-full">
                                        <span class="bg-emerald-600 text-white text-xs font-bold px-2 py-1 rounded mb-2 inline-block">
                                            {{ $activity->activity_date->format('d M Y') }}
                                        </span>
                                        <h3 class="text-xl font-bold text-white mb-2 leading-tight group-hover:text-emerald-300 transition-colors line-clamp-2">
                                            {{ $activity->title }}
                                        </h3>
                                        @if($activity->video_url)
                                            <div class="inline-flex items-center text-white/80 text-sm mt-1">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M8 5v14l11-7z"/>
                                                </svg>
                                                Watch Video
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                    <div class="bg-white/20 backdrop-blur-sm p-4 rounded-full border border-white/30">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="w-full text-center py-12 bg-gray-50 rounded-3xl">
                                <p class="text-gray-500">No recent activities available.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center md:hidden">
                <a href="{{ route('gallery.index') }}"
                    class="inline-flex items-center px-6 py-3 border border-emerald-600 text-emerald-600 font-bold rounded-full hover:bg-emerald-50 transition-colors">
                    View Gallery
                    <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Why Choose Us / Category -->
    <div class="py-24 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <span
                            class="inline-block py-1 px-3 rounded-md bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wide mb-4">
                            Why Choose Us
                        </span>
                        <h2 class="text-4xl font-extrabold text-gray-900 mb-6 leading-tight">
                            We Provide The Best <br>
                            <span class="text-emerald-600">Facilities For You</span>
                        </h2>
                        <p class="text-lg text-gray-500 mb-8 leading-relaxed">
                            We are dedicated to providing the best service for your pilgrimage. From comfortable hotels to
                            experienced guides, we ensure your journey is smooth and spiritually fulfilling.
                        </p>

                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex items-center justify-center h-12 w-12 rounded-xl bg-emerald-100 text-emerald-600">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-bold text-gray-900">Safety & Comfort First</h4>
                                    <p class="mt-1 text-gray-500">Your safety is our priority. We partner with top-rated
                                        airlines and hotels.</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex items-center justify-center h-12 w-12 rounded-xl bg-emerald-100 text-emerald-600">
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-bold text-gray-900">Experienced Muthawif</h4>
                                    <p class="mt-1 text-gray-500">Guided by certified and experienced Muthawif to guide
                                        your
                                        worship.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute inset-0 bg-emerald-200 rounded-3xl transform rotate-3 scale-100 opacity-20">
                        </div>
                        <img src="https://images.unsplash.com/photo-1596525996965-c990dc040243?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
                            alt="Facilities" class="relative rounded-3xl shadow-2xl object-cover h-[500px] w-full">

                        <!-- Floating Card -->
                        <div class="absolute bottom-8 left-8 bg-white p-6 rounded-2xl shadow-xl max-w-xs animate-bounce"
                            style="animation-duration: 3s;">
                            <div class="flex items-center space-x-4">
                                <div class="flex -space-x-3 overflow-hidden">
                                    <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
                                        src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="Pilgrim 1">
                                    <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
                                        src="https://images.unsplash.com/photo-1550525811-e5869dd03032?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="Pilgrim 2">
                                    <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white"
                                        src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80"
                                        alt="Pilgrim 3">
                                </div>
                                <div class="text-sm">
                                    <p class="font-bold text-gray-900">4.9/5 Rating</p>
                                    <p class="text-gray-500">From verified pilgrims</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-emerald-900 py-16 relative overflow-hidden">
            <div
                class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]">
            </div>
            <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Ready to Start Your Journey?</h2>
                <p class="text-emerald-100 text-lg mb-8 max-w-2xl mx-auto">
                    Book your seat now and secure the best dates for your spiritual journey. We are here to assist you every
                    step of the way.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="https://wa.me/6281234567890" target="_blank"
                        class="inline-flex justify-center items-center px-8 py-4 border border-transparent text-base font-bold rounded-full text-emerald-900 bg-white hover:bg-emerald-50 transition-all shadow-lg hover:shadow-xl">
                        Chat on WhatsApp
                    </a>
                    <a href="{{ route('packages.index') }}"
                        class="inline-flex justify-center items-center px-8 py-4 border-2 border-emerald-400 text-base font-bold rounded-full text-emerald-50 hover:bg-emerald-800 transition-all">
                        Browse Packages
                    </a>
                </div>
            </div>
        </div>
    </x-landing-layout>
