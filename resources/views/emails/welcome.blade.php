<x-mail::message>
    # Welcome to Umroh Travel!

    Dear {{ $user->name }},

    Assalamu'alaikum Warahmatullahi Wabarakatuh.

    Thank you for registering with **Umroh Travel**. We are honored to accompany you on your spiritual journey to the
    Holy Land.

    You can now log in to your dashboard to:
    - Browse our available packages
    - Manage your bookings
    - View your payment history

    <x-mail::button :url="route('dashboard')">
        Go to Dashboard
    </x-mail::button>

    If you have any questions, feel free to reply to this email.

    Wassalamu'alaikum,
    **The Umroh Travel Team**
</x-mail::message>