<x-mail::message>
    # Welcome Home!

    Dear {{ $booking->user->name }},

    Alhamdulillah, welcome back to the homeland. We hope your Umroh journey was spiritually fulfilling and memorable.

    We would love to hear about your experience with **Umroh Travel**. Your feedback helps us improve our services for
    future pilgrims.

    <x-mail::button :url="route('dashboard')">
        Give Feedback
    </x-mail::button>

    May Allah accept your Umroh and prayers.

    Wassalamu'alaikum,
    **Umroh Travel**
</x-mail::message>