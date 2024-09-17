<div style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <p>Dear {{ $rentalbike->user->name }},</p>

    <p>Your Rental Ticket Information is below:</p>

    <div
        style="background-color: rgba(121, 121, 126, 0.315); display: grid; grid-template-columns: 1fr 1fr; gap: 10px;width: 50%;align-items: center;justify-items: center">
        <div>
            <p>Bike Number: {{ $rentalbike->bike->number_plate }}</p>
            <p>Bike Model: {{ $rentalbike->bike->model_year }}</p>
            <p>Rental Status: {{ $rentalbike->rental_status }}</p>
            <p>From Day: {{ $rentalbike->rent_from_date }}</p>
            <p>To Day: {{ $rentalbike->rent_to_date }}</p>
            <p>Rental Price: {{ $rentalbike->bike->variant->variant_rental_price }}</p>
            <p>Rental Days: {{ $rentalbike->total_rental_price / $rentalbike->bike->variant->variant_rental_price }}</p>
            <p>Total Rental Price: {{ $rentalbike->total_rental_price }}</p>
        </div>

        <div>
            <p>Renter Name: {{ $rentalbike->user->name }}</p>
            <p>Booked on: {{ $rentalbike->created_at->format('Y-m-d') }}</p>
            <p>Payment method: {{ $rentalbike->payment_method }}</p>
            <p>Rental Number: {{ $rentalbike->rental_number }}</p>
        </div>
    </div>
    <br>

    <p>Thank you for choosing Bike on Rent from us.</p>

    <p>Best regards,</p>
    <p>{{ $companyname }}</p>
    <p>{{ $companyaddress }}</p>
</div>
