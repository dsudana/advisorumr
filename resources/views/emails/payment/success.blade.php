<x-mail::message>
    # Payment Received

    Dear {{ $booking->user->name }},

    We have received your payment for Booking **#{{ $booking->booking_code }}**.

    **Payment Summary:**
    - **Package:** {{ $booking->package->name }}
    - **Amount Paid:** Rp {{ number_format($booking->total_price, 0, ',', '.') }}
    - **Status:** Paid

    Your booking is now **CONFIRMED**. We will keep you updated regarding your visa and departure details.

    <x-mail::button :url="route('bookings.show', $booking)">
        View Details
    </x-mail::button>

    Barakallahu fiikum.

    Wassalamu'alaikum,
    **Umroh Travel**
</x-mail::message>