<x-landing-layout>
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Our Umroh Packages
                </h2>
                <p class="mt-4 text-lg text-gray-500">
                    Find the perfect package for your spiritual journey.
                </p>
            </div>

            <div class="mt-12 lg:grid lg:grid-cols-4 lg:gap-8">
                <!-- Filters (Sidebar) -->
                <div class="hidden lg:block lg:col-span-1">
                    <form action="{{ route('packages.index') }}" method="GET"
                        class="space-y-6 bg-white p-6 rounded-lg shadow-sm">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Filters</h3>
                        </div>
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category" id="category"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                <option value="">All Categories</option>
                                <option value="reguler" {{ request('category') == 'reguler' ? 'selected' : '' }}>Reguler
                                </option>
                                <option value="plus" {{ request('category') == 'plus' ? 'selected' : '' }}>Plus</option>
                                <option value="vip" {{ request('category') == 'vip' ? 'selected' : '' }}>VIP</option>
                            </select>
                        </div>
                        <div>
                            <label for="month" class="block text-sm font-medium text-gray-700">Departure Month</label>
                            <input type="month" name="month" id="month" value="{{ request('month') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                        </div>
                        <button type="submit"
                            class="w-full bg-emerald-600 border border-transparent rounded-md shadow-sm py-2 px-4 flex items-center justify-center text-sm font-medium text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Apply Filters
                        </button>
                        <a href="{{ route('packages.index') }}"
                            class="w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 flex items-center justify-center text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Reset
                        </a>
                    </form>
                </div>

                <!-- Package Grid -->
                <div class="mt-6 lg:mt-0 lg:col-span-3">
                    <!-- Mobile Filter Toggle -->
                    <div class="lg:hidden mb-6">
                        <form action="{{ route('packages.index') }}" method="GET"
                            class="space-y-4 bg-white p-4 rounded-lg shadow-sm">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Search packages..."
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                </div>
                                <div>
                                    <select name="category"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        <option value="">All Categories</option>
                                        <option value="reguler" {{ request('category') == 'reguler' ? 'selected' : '' }}>
                                            Reguler</option>
                                        <option value="plus" {{ request('category') == 'plus' ? 'selected' : '' }}>Plus
                                        </option>
                                        <option value="vip" {{ request('category') == 'vip' ? 'selected' : '' }}>VIP
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit"
                                class="w-full bg-emerald-600 text-white py-2 rounded-md text-sm font-medium">Search</button>
                        </form>
                    </div>

                    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        @forelse($packages as $package)
                            <div
                                class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white hover:shadow-xl transition-shadow duration-300">
                                <div class="flex-shrink-0 relative">
                                    <img class="h-48 w-full object-cover"
                                        src="https://images.unsplash.com/photo-1591604129930-9877716fd5ee?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                                        alt="{{ $package->name }}">
                                    <div
                                        class="absolute top-4 right-4 bg-emerald-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ ucfirst($package->category) }}
                                    </div>
                                </div>
                                <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-emerald-600">
                                            {{ \Carbon\Carbon::parse($package->departure_date)->format('d M Y') }}
                                        </p>
                                        <a href="{{ route('packages.show', $package) }}" class="block mt-2">
                                            <p class="text-xl font-semibold text-gray-900">{{ $package->name }}</p>
                                            <div class="flex items-center space-x-2 mt-2 text-sm text-gray-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>{{ $package->duration_days }} Days</span>
                                            </div>
                                            <div class="flex items-center space-x-2 mt-1 text-sm text-gray-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                </svg>
                                                <span class="truncate">{{ $package->makkah_hotel_name }}</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="mt-6 flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-gray-500">Starting from</p>
                                            <p class="text-xl font-bold text-gray-900">Rp
                                                {{ number_format($package->price, 0, ',', '.') }}</p>
                                        </div>
                                        <a href="{{ route('packages.show', $package) }}"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-emerald-600 hover:bg-emerald-700">
                                            book
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-center py-12 bg-white rounded-lg shadow-sm">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No packages found</h3>
                                <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filters.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $packages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-landing-layout>