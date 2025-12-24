<x-mail::message>
    # Booking Confirmation

    Dear {{ $booking->user->name }},

    Alhamdulillah, your booking for **{{ $booking->package->name }}** has been successfully created.

    **Booking Details:**
    - **Code:** {{ $booking->booking_code }}
    - **Date:** {{ $booking->booking_date->format('d M Y') }}
    - **Total Passengers:** {{ $booking->total_passengers }}
    - **Total Amount:** Rp {{ number_format($booking->total_price, 0, ',', '.') }}

    Please complete your payment to confirm your seat.

    <x-mail::button :url="route('bookings.show', $booking)">
        View Invoice & Pay
    </x-mail::button>

    Thank you for trusting us.

    Wassalamu'alaikum,
    **Umroh Travel**
</x-mail::message>