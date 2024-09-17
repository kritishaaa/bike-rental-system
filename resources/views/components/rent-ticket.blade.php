<div
    style="position: fixed; top: 0; left: 0; min-height: 100vh; padding: 7px; width: 100vw; display: flex; justify-content: center; align-items: center; backdrop-filter: blur(4px);">
    <div
        style="background-color: white; font-size: medium; overflow: hidden; padding: 4px; border: 1px solid #778ca3; border-radius: 0.25rem; position: relative; transform-origin: center; transform: scale(1); transition: transform 0.3s ease-in-out;">

        <h1 style="font-weight: medium; font-size: 1.5rem;">View Rental Ticket</h1>
        <hr style="background-color: black; height: 0.5px;">

        <div style="font-size: small; text-align: center;">
            <p>{{ $companyname }}</p>
            <p>{{ $companyphonenumber }}</p>
            <p>{{ $companyaddress }}</p>
        </div>

        <hr style="height: 0.5px; background-color: #2d3748;">

        <div style="display: flex; flex-direction: row; justify-content: center; align-items: center;">


            <div>

                <p>Bike Number: {{ $rentalbike->bike->number_plate }}</p>
                <p>Bike Model: {{ $rentalbike->bike->model_year }}</p>
                <p>Rental Status: {{ $rentalbike->status }}</p>
                <p>From Day: {{ $rentalbike->rent_from_date }}</p>
                <p>To Day: {{ $rentalbike->rent_to_date }}</p>
                <p>Rental Price: {{ $rentalbike->bike->variant->variant_rental_price }}</p>
                <p>Rental Days: {{ $rentalbike->total_rental_price / $rentalbike->bike->variant->variant_rental_price }}
                </p>

                <p>Total Rental Price: {{ $rentalbike->total_rental_price }}</p>

            </div>

            <div
                style="display: flex; flex-direction: column; place-items: flex-end; justify-content: center; font-size: small;">
                <p>Renter Name: {{ $rentalbike->user->name }}</p>
                <p>Booked on: {{ $rentalbike->created_at->format('Y-m-d') }}</p>
                <p style="font-weight: bold; font-size: medium;">Rental Number: {{ $rentalbike->rental_number }}</p>

            </div>

        </div>

        <div>

        </div>

    </div>
</div>
