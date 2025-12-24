<x-landing-layout>
    <div class="bg-gray-50 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Booking Confirmation</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">Booking Code: <span
                                class="font-bold text-gray-900">{{ $booking->booking_code }}</span></p>
                    </div>
                    <div>
                        <span
                            class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $booking->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($booking->payment_status) }}
                        </span>
                    </div>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Package Name</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $booking->package->name }}
                            </dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Departure Date</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ \Carbon\Carbon::parse($booking->package->departure_date)->format('d M Y') }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Total Passengers</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                {{ $booking->total_passengers }} Pax</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Total Price</dt>
                            <dd class="mt-1 text-sm font-bold text-emerald-600 sm:mt-0 sm:col-span-2">Rp
                                {{ number_format($booking->total_price, 0, ',', '.') }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Passenger List</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                    @foreach($booking->passengers as $passenger)
                                        <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                            <div class="w-0 flex-1 flex items-center">
                                                <span class="ml-2 flex-1 w-0 truncate">{{ $passenger->name }}
                                                    ({{ ucfirst($passenger->gender) }})</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </dd>
                        </div>
                        @if($booking->notes)
                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Notes</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $booking->notes }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>

                @if($booking->payment_status === 'unpaid')
                    <div class="px-4 py-5 sm:px-6 flex justify-end bg-gray-50">
                        <button id="pay-button"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                            Pay Now
                        </button>
                    </div>
                    <!-- Midtrans Snap Script -->
                    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
                        data-client-key="{{ config('services.midtrans.client_key') }}"></script>
                    <script>
                        document.getElementById('pay-button').onclick = function () {
                            // Call backend to get Snap Token
                            fetch("{{ route('payment.pay', $booking) }}", {
                                method: "POST",
                                headers: {
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                    "Content-Type": "application/json",
                                    "Accept": "application/json"
                                }
                            })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.snap_token) {
                                        snap.pay(data.snap_token, {
                                            onSuccess: function (result) {
                                                window.location.reload();
                                            },
                                            onPending: function (result) {
                                                window.location.reload();
                                            },
                                            onError: function (result) {
                                                alert("Payment failed!");
                                                console.log(result);
                                            }
                                        });
                                    } else {
                                        alert("Failed to get payment token.");
                                    }
                                })
                                .catch(error => console.error(error));
                        };
                    </script>
                @endif
            </div>
        </div>
    </div>
</x-landing-layout>