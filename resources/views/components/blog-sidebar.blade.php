@props(['categories', 'tags', 'recentArticles'])

<div class="space-y-6 sticky top-24">
    <!-- Search Widget -->
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Search
        </h3>
        <form action="{{ route('articles.index') }}" method="GET">
            <div class="relative group">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search articles..."
                    class="w-full pl-4 pr-10 py-3 bg-gray-50 border-2 border-transparent focus:bg-white focus:border-emerald-500 focus:ring-0 rounded-xl text-gray-900 placeholder-gray-400 font-medium transition-all text-sm group-hover:bg-emerald-50/50">
                <button type="submit"
                    class="absolute right-2 top-2 p-1 text-gray-400 hover:text-emerald-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    <!-- Categories Widget -->
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
            </svg>
            Categories
        </h3>
        <ul class="space-y-3">
            @foreach($categories as $category)
                <li>
                    <a href="{{ route('articles.index', ['category' => $category->slug]) }}"
                        class="flex items-center justify-between group p-2 -mx-2 rounded-lg hover:bg-gray-50 transition-colors">
                        <span
                            class="text-gray-600 group-hover:text-emerald-700 font-medium transition-colors text-sm">{{ $category->name }}</span>
                        <span
                            class="px-2.5 py-1 bg-gray-100 text-gray-500 text-xs font-bold rounded-md group-hover:bg-emerald-100 group-hover:text-emerald-600 transition-colors">
                            {{ $category->articles_count }}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Tags Widget -->
    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
            <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
            </svg>
            Popular Tags
        </h3>
        <div class="block w-full">
            @foreach($tags as $tag)
                <a href="{{ route('articles.index', ['tag' => $tag->slug]) }}"
                    class="inline-block px-3 py-1 mb-2 mr-2 bg-white border border-gray-200 text-gray-600 text-xs font-medium rounded-full hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all shadow-sm">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Advertisement Widget -->
    <div class="bg-emerald-900 rounded-3xl overflow-hidden shadow-lg relative group h-80">
        <img src="https://images.unsplash.com/photo-1596525996965-c990dc040243?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
            alt="Advertisement"
            class="w-full h-full object-cover opacity-60 group-hover:opacity-40 transition-opacity duration-500">
        <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/90 to-transparent"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-end text-center p-8 pb-10">
            <span
                class="inline-block py-1 px-3 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-xs font-bold uppercase tracking-wider mb-3 backdrop-blur-sm">
                Limited Offer
            </span>
            <h4 class="text-2xl font-bold text-white mb-2 leading-tight">Umroh Ramadhan 2024</h4>
            <p class="text-emerald-100 text-sm mb-6">Book early and save up to 10%!</p>
            <a href="{{ route('packages.index') }}"
                class="w-full py-3 bg-white text-emerald-900 font-bold rounded-xl hover:bg-emerald-50 transition-colors shadow-lg">
                View Packages
            </a>
        </div>
    </div>
</div>