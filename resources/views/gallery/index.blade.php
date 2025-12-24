<x-landing-layout>
    @section('meta_title', 'Activity Gallery - Umroh Travel')
    @section('meta_description', 'Dokumentasi kegiatan jamaah Umroh Travel selama di Tanah Suci.')

    <!-- Hero Section -->
    <div class="relative bg-emerald-900 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Activity Gallery
            </h1>
            <p class="mt-4 text-xl text-emerald-100 max-w-3xl mx-auto">
                Momen-momen indah perjalanan ibadah para jamaah kami di Tanah Suci.
            </p>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="bg-white py-16" x-data="{ 
        modalOpen: false, 
        selectedImage: '', 
        selectedTitle: '', 
        selectedVideo: null,
        openModal(image, title, video) {
            this.selectedImage = image;
            this.selectedTitle = title;
            this.selectedVideo = video;
            this.modalOpen = true;
            document.body.style.overflow = 'hidden';
        },
        closeModal() {
            this.modalOpen = false;
            this.selectedVideo = null;
            document.body.style.overflow = 'auto';
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($activities as $activity)
                    <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden cursor-pointer transform hover:-translate-y-1"
                        @click="openModal('{{ Storage::url($activity->image) }}', '{{ $activity->title }}', '{{ $activity->video_url }}')">
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ Storage::url($activity->image) }}" alt="{{ $activity->title }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <div class="bg-white/20 backdrop-blur-sm p-3 rounded-full border border-white/50">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Type Badge (Photo/Video) -->
                            @if($activity->video_url)
                                <div class="absolute top-4 right-4 bg-red-600 text-white p-2 rounded-full shadow-lg">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            @endif
                        </div>
                        
                        <div class="p-6">
                            <div class="flex items-center text-sm text-emerald-600 font-medium mb-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $activity->activity_date->format('d F Y') }}
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">{{ $activity->title }}</h3>
                            <p class="text-gray-500 line-clamp-2 text-sm">{{ $activity->description }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="inline-block p-4 rounded-full bg-emerald-50 text-emerald-500 mb-4">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Belum ada galeri kegiatan</h3>
                        <p class="mt-1 text-gray-500">Nantikan update kegiatan kami selanjutnya.</p>
                    </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="mt-12">
                {{ $activities->links() }}
            </div>
        </div>

        <!-- Gallery Modal -->
        <div x-show="modalOpen" 
            class="fixed inset-0 z-50 overflow-y-auto" 
            style="display: none;"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="closeModal">
                    <div class="absolute inset-0 bg-gray-900 opacity-95"></div>
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-transparent rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    
                    <div class="relative">
                        <!-- Close Button -->
                        <button @click="closeModal" class="absolute -top-12 right-0 text-white hover:text-gray-300 focus:outline-none z-50">
                            <span class="sr-only">Close</span>
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="relative bg-black rounded-lg overflow-hidden flex items-center justify-center" style="min-height: 50vh; max-height: 80vh;">
                            <template x-if="selectedVideo">
                                <iframe :src="selectedVideo" class="w-full h-[60vh]" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </template>
                            <template x-if="!selectedVideo">
                                <img :src="selectedImage" :alt="selectedTitle" class="max-w-full max-h-[80vh] object-contain mx-auto">
                            </template>
                        </div>
                        
                        <div class="bg-white p-4 sm:p-6">
                            <h3 class="text-xl font-bold text-gray-900" x-text="selectedTitle"></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-landing-layout>
