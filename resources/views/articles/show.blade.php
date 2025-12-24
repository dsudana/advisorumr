<x-landing-layout>
    @section('meta_title', $article->title . ' - Umroh Travel Blog')
    @section('meta_description', Str::limit(strip_tags($article->content), 160))

    <!-- Breadcrumb & Header -->
    <!-- Breadcrumb & Header -->
    <div class="bg-emerald-900 pt-24 pb-12 lg:pt-32 lg:pb-16 relative overflow-hidden" x-data="{
        currentSlide: 0,
        images: [
            '{{ $article->image ? asset('storage/' . $article->image) : 'https://images.unsplash.com/photo-1565552629477-ff9a43a02499?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80' }}',
            'https://images.unsplash.com/photo-1519817650394-63020a6d1c93?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80',
            'https://images.unsplash.com/photo-1542385151-ef275392b239?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80'
        ],
        init() {
            setInterval(() => {
                this.currentSlide = (this.currentSlide + 1) % this.images.length;
            }, 5000);
        }
    }">
        <!-- Slider Backgrounds -->
        <template x-for="(image, index) in images" :key="index">
            <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out"
                :style="`background-image: url('${image}')`" x-show="currentSlide === index"
                x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            </div>
        </template>

        <!-- Color Overlay -->
        <div class="absolute inset-0 bg-emerald-900/85"></div>

        <!-- Pattern Overlay -->
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]">
        </div>

        <!-- Animated Blobs (Optional - Reduced Opacity) -->
        <div
            class="absolute top-0 right-0 -mr-24 -mt-24 w-96 h-96 rounded-full bg-emerald-500 opacity-10 blur-3xl mix-blend-screen">
        </div>
        <div
            class="absolute bottom-0 left-0 -ml-24 -mb-24 w-80 h-80 rounded-full bg-teal-400 opacity-10 blur-3xl mix-blend-screen">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-wrap items-center gap-2 text-sm text-emerald-100 mb-6">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span>/</span>
                <a href="{{ route('articles.index') }}" class="hover:text-white transition-colors">Artikel</a>
                <span>/</span>
                <span class="text-white truncate max-w-xs">{{ $article->title }}</span>
            </div>

            @if ($article->category)
                <a href="{{ route('articles.index', ['category' => $article->category->slug]) }}"
                    class="inline-block px-3 py-1 rounded-full bg-emerald-800/50 border border-emerald-700 text-emerald-300 text-xs font-bold uppercase tracking-wider mb-4 backdrop-blur-sm hover:bg-emerald-800 transition-colors">
                    {{ $article->category->name }}
                </a>
            @endif

            <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-6 max-w-4xl">
                {{ $article->title }}
            </h1>

            <div class="flex items-center space-x-6 text-emerald-100/90 text-sm font-medium">
                <div class="flex items-center">
                    <div
                        class="w-8 h-8 rounded-full bg-emerald-700 flex items-center justify-center mr-3 text-white font-bold text-xs ring-2 ring-emerald-600">
                        {{ substr($article->user->name ?? 'A', 0, 1) }}
                    </div>
                    <span>{{ $article->user->name ?? 'Admin' }}</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>{{ $article->published_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->

    <div class="bg-gray-50 py-12 lg:py-20 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:grid lg:grid-cols-4 lg:gap-8">
                <!-- Article Content -->
                <div class="lg:col-span-3">
                    <article class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
                        <!-- Featured Image -->
                        <div class="w-full relative aspect-video">
                            <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://placehold.co/1200x600/e2e8f0/1e293b?text=' . urlencode($article->title) }}"
                                alt="{{ $article->title }}" class="w-full h-full object-cover"
                                onerror="this.onerror=null; this.src='https://placehold.co/1200x600/e2e8f0/1e293b?text=Article';">
                        </div>

                        <div class="p-8 md:p-12">
                            <!-- Content Body -->
                            <div class="prose prose-lg prose-emerald max-w-none text-gray-600">
                                {!! nl2br(e($article->content)) !!}
                            </div>

                            <!-- Tags -->
                            @if ($article->tags->count() > 0)
                                <div class="mt-12 pt-8 border-t border-gray-100">
                                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-4">Tags
                                    </h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($article->tags as $tag)
                                            <a href="{{ route('articles.index', ['tag' => $tag->slug]) }}"
                                                class="px-4 py-2 bg-gray-50 text-emerald-700 rounded-lg hover:bg-emerald-600 hover:text-white transition-all font-medium text-sm">
                                                #{{ $tag->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Share (Visual only for now) -->
                            <div class="mt-8 flex items-center justify-between">
                                <span class="text-sm font-bold text-gray-500">Share this article:</span>
                                <div class="flex space-x-3">
                                    <button
                                        class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                        </svg>
                                    </button>
                                    <button
                                        class="w-10 h-10 rounded-full bg-blue-800 text-white flex items-center justify-center hover:bg-blue-900 transition-colors">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1 mt-8 lg:mt-0">
                    <x-blog-sidebar :categories="$categories" :tags="$tags" :recentArticles="$recentArticles" />
                </div>
            </div>
        </div>
    </div>



</x-landing-layout>