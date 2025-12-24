<x-landing-layout>
    @section('meta_title', $package->name . ' - Umroh Travel')
    @section('meta_description', Str::limit(strip_tags($package->description), 150))
    @section('meta_image', 'https://images.unsplash.com/photo-1591604129930-9877716fd5ee')

    @push('seo')
        <script type="application/ld+json">
                    {
                      "@context": "https://schema.org/",
                      "@type": "Product",
                      "name": "{{ $package->name }}",
                      "image": "https://images.unsplash.com/photo-1591604129930-9877716fd5ee",
                      "description": "{{ Str::limit(strip_tags($package->description), 150) }}",
                      "brand": {
                        "@type": "Brand",
                        "name": "Umroh Travel"
                      },
                      "offers": {
                        "@type": "Offer",
                        "url": "{{ route('packages.show', $package->slug) }}",
                        "priceCurrency": "IDR",
                        "price": "{{ $package->price }}",
                        "availability": "https://schema.org/InStock",
                        "validFrom": "{{ $package->departure_date }}"
                      }
                    }
                    </script>
    @endpush
    <div class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <x-breadcrumb :items="[
        ['label' => 'Packages', 'url' => route('packages.index')],
        ['label' => $package->name]
    ]" />

            <div class="lg:grid lg:grid-cols-3 lg:gap-8">
                <!-- Left Column (Images, Details) -->
                <div class="lg:col-span-2">
                    <!-- Image -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-8">
                        <img src="{{ $package->image ? Storage::url($package->image) : 'https://images.unsplash.com/photo-1591604129930-9877716fd5ee?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80' }}"
                            alt="{{ $package->name }}" class="w-full h-96 object-cover">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <span
                                    class="bg-emerald-100 text-emerald-800 text-xs font-semibold px-2.5 py-0.5 rounded capitalize">{{ $package->category }}</span>
                                <div class="flex items-center text-gray-500 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $package->duration_days }} Days
                                </div>
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $package->name }}</h1>
                            <div class="prose max-w-none text-gray-600">
                                {!! $package->description !!}
                            </div>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Facilities Included</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($package->facilities as $facility)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-emerald-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>{{ $facility->facility }}</span>
                                </div>
                            @endforeach
                            <!-- Hotels -->
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span>Makkah: {{ $package->makkah_hotel_name }}
                                    ({{ $package->makkah_hotel_stars }}★)</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span>Madinah: {{ $package->madinah_hotel_name }}
                                    ({{ $package->madinah_hotel_stars }}★)</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-500 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                <span>Airline: {{ $package->airline }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Itinerary -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Itinerary Journey</h2>
                        <div class="w-full">
                            @foreach($package->itineraries->sortBy('day') as $itinerary)
                                <div class="relative pl-8 pb-8 border-l border-gray-200 last:border-l-0 last:pb-0">
                                    <div
                                        class="absolute -left-3 top-0 bg-emerald-500 rounded-full w-6 h-6 flex items-center justify-center text-white text-xs font-bold">
                                        {{ $itinerary->day }}
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $itinerary->title }}</h3>
                                    <p class="text-gray-600">{{ $itinerary->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Column (Booking Card) -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg p-6 sticky top-24">
                        <div class="mb-4">
                            <span class="text-gray-500 block mb-1">Starting Price</span>
                            <span class="text-3xl font-bold text-emerald-600">Rp
                                {{ number_format($package->price, 0, ',', '.') }}</span>
                            <span class="text-gray-500 text-sm">/ pax</span>
                        </div>

                        <div class="border-t border-b border-gray-100 py-4 my-4 space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Departure</span>
                                <span
                                    class="font-medium">{{ \Carbon\Carbon::parse($package->departure_date)->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Return</span>
                                <span
                                    class="font-medium">{{ \Carbon\Carbon::parse($package->return_date)->format('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Available Seats</span>
                                <span class="font-medium text-emerald-600">{{ $package->available_seats }} seats</span>
                            </div>
                        </div>

                        <form action="{{ route('booking.store.public') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="package_id" value="{{ $package->id }}">

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                    placeholder="Your Name">
                            </div>

                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700">WhatsApp
                                    Number</label>
                                <input type="tel" name="phone_number" id="phone_number" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                    placeholder="0812...">
                            </div>

                            <div>
                                <label for="total_passengers" class="block text-sm font-medium text-gray-700">Total
                                    Passengers</label>
                                <input type="number" name="total_passengers" id="total_passengers" min="1" value="1"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                            </div>

                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition duration-150">
                                Book Now via WhatsApp
                            </button>
                        </form>

                        <div class="mt-4 text-center">
                            <p class="text-sm text-gray-500 mb-2">Have questions?</p>
                            <a href="https://wa.me/6281234567890?text=I%20am%20interested%20in%20package%20{{ $package->name }}"
                                target="_blank"
                                class="text-emerald-600 font-medium hover:underline flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1" full="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                </svg>
                                Chat on WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-landing-layout>