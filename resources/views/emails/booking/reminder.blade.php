<x-mail::message>
    # Upcoming Departure Reminder

    Dear {{ $booking->user->name }},

    This is a friendly reminder that your Umroh journey with **{{ $booking->package->name }}** is coming up soon!

    **Departure Date:** {{ $booking->package->departure_date->format('d M Y') }}
    **Flight:** {{ $booking->package->airline }}

    Please ensure:
    1. Your passport and documents are ready.
    2. Your luggage is packed according to guidelines.
    3. You arrive at the meeting point on time.

    We pray for your safe journey and accepted worship.

    <x-mail::button :url="route('bookings.show', $booking)">
        View Itinerary
    </x-mail::button>

    Fi Amanillah,
    **Umroh Travel**
</x-mail::message>