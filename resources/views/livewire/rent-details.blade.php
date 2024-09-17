<div class="flex flex-row gap-4 p-7 justify-center items-center min-h-[450px]">
    {{-- Be like water. --}}

    <div class="w-60 shadow border-black p-4">
        <p class=" text-2xl font-normal">Filters</p>
        <hr class="h-[2px] bg-black ">
        <div>
            <div>
                <p class="text-lg font-thin">Bikes</p>
                <hr>
                @foreach ($bikes as $bike)
                    <p><input type="checkbox" wire:model="bikesinputs" value="{{ $bike->id }}">
                        {{ $bike->number_plate }}</p>
                @endforeach
            </div>

            <div>
                <p class="text-lg font-thin">Rental Status</p>
                <hr>
                <select name="" id="" class=" rounded min-w-full" wire:model="rentalstatus">
                    <option value="">Show all</option>

                    <option value="Pending">Pending</option>
                    <option value="Approved">Approved</option>
                    <option value="Marked_as_return">Marked as Rent</option>
                    <option value="Reject">Reject</option>
                </select>
            </div>

            <div>
                <p class="text-md font-thin">Payment Method</p>
                <hr>

                <select name="" id="" class=" rounded min-w-full" wire:model="paymentmethod">
                    <option value="">Show all</option>
                    <option value="Credit">Credit</option>
                    <option value="Cash">Cash</option>
                    <option value="Online">Online</option>
                </select>
            </div>

        </div>


    </div>
    <div class="flex-1">



        <table class="divide-y divide-gray-500 min-w-full border-[1px] border-gray-500 p-2 ">
            <thead class="bg-slate-200 p-2 font-thin">
                <tr>
                    <th class="p-1 font-semibold border-separate ">SN</th>
                    <th class="p-1 font-semibold border-separate ">Rental Bike number</th>
                    <th class="p-3 font-semibold border-separate ">From date</th>
                    <th class="p-3 font-semibold border-separate ">To date</th>
                    <th class="p-3 font-semibold border-separate ">Booked on</th>
                    <th class="p-3 font-semibold border-separate ">Rental Days</th>
                    <th class="p-3 font-semibold border-separate ">Rent Price per day</th>
                    <th class="p-3 font-semibold border-separate ">Total Rental Price</th>
                    <th class="p-3 font-semibold border-separate ">Payment Method</th>
                    <th class="p-3 font-semibold border-separate ">Rent Status</th>
                    <th class="p-3 font-semibold border-separate ">View ticket</th>
                </tr>
            </thead>
            <tbody class="bg-gray-100">
                @forelse ($rents as $rent)
                    <tr class="divide-x divide-gray-500 text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $rent->bike->number_plate }}</td>
                        <td class="w-24">{{ $rent->rent_from_date }}</td>
                        <td class="w-24">{{ $rent->rent_to_date }}</td>
                        <td class="w-24">

                            {{ $rent->created_at->diffForHumans() }}
                        </td>
                        <td>{{ $rent->total_rental_price / $rent->bike->variant->variant_rental_price }}</td>
                        <td>{{ $rent->bike->variant->variant_rental_price }}</td>
                        <td>{{ $rent->total_rental_price }}</td>
                        <td>{{ $rent->payment_method }}</td>
                        <td class="text-center">

                            <span class="text-sm py-0.5 px-3 rounded-2xl "> {{ $rent->rental_status }}</span>

                        </td>
                        <td class="text-center p-3 flex gap-5"><Button
                                class="text-xs bg-slate-800 text-white rounded-lg  px-3 py-0.5"
                                wire:click="tickettoogle({{ $rent->id }})">Click Here </Button>
                            @if ($rent->rental_status == 'Pending')
                                <button class="text-xs bg-slate-800 text-white rounded-lg  px-3 py-0.5"
                                    wire:click="cancelrent({{ $rent->id }})">Cancel
                                    Rent</button>
                            @endif
                        </td>

                    </tr>
                @empty
                    No rent till now
                @endforelse
            </tbody>

        </table>
        <div class="text-center py-1">
            {{ $rents->links() }}
        </div>
    </div>


    @if ($tickettoogle == 'show')
        <div class="fixed top-0  left-0 min-h-full p-7 w-screen flex justify-center items-center backdrop-blur-sm ">
            <div
                class="bg-white  text-md overflow-hidden p-4 rounded relative hover:scale-110 border-slate-500 border-[1px]">
                <button wire:click="tickettoogle({{ $rent->id }})"><i
                        class="fa fa-times absolute top-2 right-2  p-1 rounded-full hover:bg-black hover:text-white"
                        aria-hidden="true"></i></button>
                <h2 class="font-medium text-xl">View Rental Ticket</h2>
                <hr class="bg-black h-0.5">
                <div class="text-sm text-center">
                    <p>{{ $companyname }}</p>
                    <p>{{ $companyphonenumber }}</p>
                    <p>{{ $companyaddress }}</p>
                </div>

                <hr class="h-0.5 bg-gray-800">

                <div class="flex flex-row justify-center items-center">


                    <div>

                        <p>Bike Number: {{ $rentalbike->bike->number_plate }}</p>
                        <p>Bike Model: {{ $rentalbike->bike->model_year }}</p>
                        <p>Rental Status: {{ $rentalbike->status }}</p>
                        <p>From Day: {{ $rentalbike->rent_from_date }}</p>
                        <p>To Day: {{ $rentalbike->rent_to_date }}</p>
                        <p>Rental Price: {{ $rentalbike->bike->variant->variant_rental_price }}</p>
                        <p>Rental Days:
                            {{ $rentalbike->total_rental_price / $rentalbike->bike->variant->variant_rental_price }}
                        </p>

                        <p>Total Rental Price: {{ $rentalbike->total_rental_price }}</p>

                    </div>

                    <div class="flex flex-col place-items-end justify-center text-sm">
                        <p>Renter Name: {{ $rentalbike->user->name }}</p>
                        <p>Booked on : {{ $rentalbike->created_at->format('Y-m-d') }}</p>
                        <p class="font-semibold text-md">Rental Number : {{ $rentalbike->rental_number }}</p>
                        <img src="{{ asset('storage/variant_images/' . $rentalbike->bike->variant->variant_image) }}"
                            alt="image" class="h-52 object-cover border-0.5 border-black rounded scale-75">
                    </div>

                </div>

                <div>

                </div>

            </div>


        </div>
    @endif


</div>
