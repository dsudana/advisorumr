<x-mail::message>
    # Booking Status Update

    Dear {{ $booking->user->name }},

    There is an update regarding your booking **#{{ $booking->booking_code }}**.

    **New Status:** {{ strtoupper($booking->status) }}

    @if($booking->status === 'cancelled')
        Your booking has been cancelled. If you believe this is a mistake, please contact us immediately.
    @elseif($booking->status === 'processing')
        We are currently processing your documents/visa.
    @elseif($booking->status === 'completed')
        Alhamdulillah, your journey has been completed.
    @endif

    <x-mail::button :url="route('bookings.show', $booking)">
        Check Status
    </x-mail::button>

    Wassalamu'alaikum,
    **Umroh Travel**
</x-mail::message>