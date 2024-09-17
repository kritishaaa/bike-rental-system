<div>
    <div class="p-5 flex flex-row items-center justify-around ">
        <p class="font-medium text-3xl">Bikes</p>
        @if (Session::has('from_date') && Session::has('to_date'))
            <div class="text-center">
                <p class="text-xl font-semibold">Available Bikes</p>
                <p> From {{ $from_date }} To {{ $to_date }}</p>
            </div>
        @endif
    </div>
    <hr class="bg-black h-[1.05px]">


    <div class="flex flex-row items-start px-4 ml-2">

        <div class="w-72 h-full border-gray-200 shadow border-2 hover:scale-105 hover:shadow-md ">
            <h6 class="text-xl  text-center py-2 font-semibold">Filters</h6>
            <hr class="h-0.5 bg-slate-700 opacity-75">

            <div class="grid grid-row-3 py-2 justify-center  hover:shadow-xl gap-8 ">

                <div>
                    <p class="font-medium">Prices</p>

                    <select name="" id="" class="w-full rounded-sm text-center py-2"
                        wire:model="priceorder" wire:onchange="orderprice('{{ $priceorder }}')">

                        <option value="asc">Low to High</option>
                        <option value="desc">High to Low</option>

                    </select>

                </div>

                <div>
                    <p class="font-medium">Brands</p>
                    <ul>
                        @foreach ($brands as $brand)
                            <li class="px-6"> <input type="checkbox" wire:model="brandInputs"
                                    value="{{ $brand->brand_name }}"> {{ $brand->brand_name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="w-60 flex flex-col pb-3">
                    <p class="font-medium">cc</p>

                    <input type="range" name="" id="cc" min="{{ $min_cc }}"
                        max="{{ $max_cc }}" onchange="showvalue()" wire:model="ccvalue">
                    @if ($ccvalue)
                        <p>Bike cc upto: {{ $ccvalue }} cc</p>
                    @endif
                </div>

            </div>

        </div>



        <div
            class=" grid grid-cols-3 justify-evenly gap-6  mx-14 p-10 flex-1 hover:max-md:m-1 border-s-gray-500 border-s-[1px]">
            @foreach ($bikes as $bike)
                <div
                    class="max-w-[20rem] mx-auto bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl hover:scale-110  ">
                    <img style="width: 250px; height: 200px;object-fit: contain"
                        src="{{ asset('storage/variant_images/' . $bike->variant->variant_image) }}"
                        alt="{{ asset('storage/variant_images/' . $bike->variant->variant_name) }}">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-800">{{ $bike->variant->variant_name }}</h2>
                        <p class="mt-1">
                            <span class="text-gray-700 font-semibold"> Brand:</span>
                            <span class=""text-gray-800 ml-2">{{ $bike->brand_name }}.</span>
                        </p>
                        <div class="mt-1">
                            <span class="text-gray-700 font-semibold">Rental Price:</span>
                            <span class="text-gray-800 ml-2">{{ $bike->variant->variant_rental_price }}</span>
                        </div>
                        <div class="mt-1">
                            <span class="text-gray-700 font-semibold">Bike cc:</span>
                            <span class="text-gray-800 ml-2">{{ $bike->cc }} cc</span>
                        </div>
                        <form action="{{ route('renter.bikedetails') }}" method="POST">
                            <div class="mt-2">
                                @csrf
                                <input type="hidden" name="bike_id" value="{{ $bike->bike_id }}">
                                <button
                                    class="inline-block  w-full  text-center bg-gray-600 hover:bg-black text-white font-semibold py-2 px-4 rounded"
                                    type="submit">
                                    Rent Bike
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>


    </div>

    <div class="px-20 pb-4">
        {{ $bikes->links() }}
    </div>



</div>
