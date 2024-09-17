<x-mail::message>
    Dear {{ $rent->user->name }},

    Your Rental Status is {{ $rent->rental_status }} and Payment is {{ $rent->payment_method }}

    # Have a Safe and happy ride.

    Thanks,
    {{ $companyname }}
</x-mail::message>
