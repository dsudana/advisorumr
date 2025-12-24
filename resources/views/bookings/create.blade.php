<x-landing-layout>
    <div class="bg-gray-50 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Booking Package: {{ $package->name }}</h1>

            <form action="{{ route('booking.store', $package->slug) }}" method="POST" x-data="bookingForm()">
                @csrf

                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">Passenger Details</h2>

                    <template x-for="(passenger, index) in passengers" :key="index">
                        <div class="border-b border-gray-200 pb-6 mb-6 last:border-0 last:pb-0 last:mb-0">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900" x-text="`Passenger ${index + 1}`"></h3>
                                <button type="button" class="text-red-600 text-sm hover:text-red-800"
                                    @click="removePassenger(index)" x-show="passengers.length > 1">
                                    Remove
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label :for="`passengers[${index}][name]`"
                                        class="block text-sm font-medium text-gray-700">Full Name (as per
                                        Passport)</label>
                                    <input type="text" :name="`passengers[${index}][name]`" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                                <div>
                                    <label :for="`passengers[${index}][passport]`"
                                        class="block text-sm font-medium text-gray-700">Passport Number</label>
                                    <input type="text" :name="`passengers[${index}][passport]`"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                </div>
                                <div>
                                    <label :for="`passengers[${index}][gender]`"
                                        class="block text-sm font-medium text-gray-700">Gender</label>
                                    <select :name="`passengers[${index}][gender]`" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </template>

                    <button type="button" @click="addPassenger()"
                        class="mt-4 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Add Passenger
                    </button>
                </div>

                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">Additional Notes</h2>
                    <textarea name="notes" rows="3"
                        class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 block w-full sm:text-sm border-gray-300 rounded-md"
                        placeholder="Any special requests?"></textarea>
                </div>

                <div class="bg-white shadow rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-600">Price per Pax</span>
                        <span class="font-medium">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-center mb-6 pt-4 border-t border-gray-200">
                        <span class="text-lg font-bold text-gray-900">Total Price</span>
                        <span class="text-2xl font-bold text-emerald-600"
                            x-text="formatCurrency(passengers.length * {{ $package->price }})">Rp
                            {{ number_format($package->price, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                        Proceed to Payment
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function bookingForm() {
            return {
                passengers: [{ name: '', passport: '', gender: 'male' }],
                addPassenger() {
                    this.passengers.push({ name: '', passport: '', gender: 'male' });
                },
                removePassenger(index) {
                    this.passengers.splice(index, 1);
                },
                formatCurrency(value) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
                }
            }
        }
    </script>
</x-landing-layout>