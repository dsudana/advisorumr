<x-landing-layout>
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Our <span class="text-emerald-600">Journal</span>
                </h2>
                <p class="mt-4 text-lg text-gray-500">
                    Insights, stories, and guidance for your spiritual journey.
                </p>
            </div>

            <div class="mt-12 lg:grid lg:grid-cols-4 lg:gap-8">
                <!-- Articles Grid (Left) -->
                <div class="lg:col-span-3">
                    <!-- Mobile Sidebar/Filters Toggle (Optional, can add if needed) -->

                    @if (request('search') || request('category') || request('tag'))
                        <div
                            class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-lg flex items-center justify-between">
                            <span class="text-emerald-800 text-sm">
                                Filter:
                                <strong>
                                    {{ request('search') ? '"' . request('search') . '"' : '' }}
                                    {{ request('category') ? 'Category: ' . request('category') : '' }}
                                    {{ request('tag') ? 'Tag: #' . request('tag') : '' }}
                                </strong>
                            </span>
                            <a href="{{ route('articles.index') }}"
                                class="text-xs font-bold text-emerald-600 hover:text-emerald-800 underline">Clear</a>
                        </div>
                    @endif

                    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse($articles as $article)
                            <div
                                class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white hover:shadow-xl transition-all duration-300 group border border-gray-100">
                                <a href="{{ route('articles.show', $article->slug) }}"
                                    class="flex-shrink-0 relative overflow-hidden h-48">
                                    <img class="h-full w-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                                        src="{{ $article->image ? asset('storage/' . $article->image) : 'https://placehold.co/600x400/e2e8f0/1e293b?text=' . urlencode($article->title) }}"
                                        alt="{{ $article->title }}"
                                        onerror="this.onerror=null; this.src='https://placehold.co/600x400/e2e8f0/1e293b?text=Article';">
                                    @if ($article->category)
                                        <div class="absolute top-4 right-4">
                                            <span
                                                class="px-2 py-1 bg-white/90 backdrop-blur text-emerald-800 text-xs font-bold uppercase tracking-wider rounded-lg shadow-sm">
                                                {{ $article->category->name }}
                                            </span>
                                        </div>
                                    @endif
                                </a>
                                <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center text-sm text-emerald-600 font-medium mb-2">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $article->published_at->format('M d, Y') }}
                                        </div>
                                        <a href="{{ route('articles.show', $article->slug) }}"
                                            class="block group/title">
                                            <h3
                                                class="text-xl font-bold text-gray-900 group-hover/title:text-emerald-600 transition-colors line-clamp-2 mb-3">
                                                {{ $article->title }}
                                            </h3>
                                            <p class="text-sm text-gray-500 line-clamp-3">
                                                {{ Str::limit(strip_tags($article->content), 100) }}
                                            </p>
                                        </a>
                                    </div>
                                    <div class="mt-6 flex items-center justify-between pt-4 border-t border-gray-100">
                                        <div class="flex items-center space-x-2">
                                            @foreach ($article->tags->take(1) as $tag)
                                                <span class="text-xs text-gray-400">#{{ $tag->name }}</span>
                                            @endforeach
                                        </div>
                                        <a href="{{ route('articles.show', $article->slug) }}"
                                            class="text-sm font-bold text-emerald-600 hover:text-emerald-700 flex items-center group/link">
                                            Read
                                            <svg class="ml-1 w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div
                                class="col-span-12 lg:col-span-3 text-center py-12 bg-white rounded-lg shadow-sm border border-dashed border-gray-300">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No articles found</h3>
                                <p class="mt-1 text-sm text-gray-500">Try adjusting your filters.</p>
                                <a href="{{ route('articles.index') }}"
                                    class="inline-block mt-3 text-emerald-600 text-sm font-bold">Clear Filters</a>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $articles->withQueryString()->links() }}
                    </div>
                </div>


                <!-- Sidebar -->
                <div class="lg:col-span-1 mt-8 lg:mt-0">
                    <x-blog-sidebar :categories="$categories" :tags="$tags" :recentArticles="$recentArticles" />
                </div>
            </div>
        </div>
    </div>
</x-landing-layout>
