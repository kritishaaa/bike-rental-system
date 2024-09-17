@extends('layouts.renter')

@section('content')
    @include('frontend.partials.cover')


    <div class="p-10">
        <div class=" text-center flex flex-col pb-10">
            <p class="text-2xl font-semibold text-center">Top Bike Rental Brands</p>
            <small class=" text-center">Choose your Brand</small>
        </div>
        <div class="flex flex-row justify-around px-4 pb-6 ">


            @foreach ($brands->toArray() as $brand)
                <div
                    class=" flex-row w-1/5 justify-around  mx-auto bg-white rounded-lg overflow-hidden shadow-lg border-2 border-gray-300">
                    <img src="{{ asset('storage/' . $brand['brand_logo']) }}" alt="{{ $brand['brand_name'] }}"
                        class="object-contain max-w-full h-full mx-auto mt-0 py-4">
                    <hr class="h-0.5 bg-black">
                    <h2 class="text-2xl text-center my-2  font-semibold text-gray-800">{{ $brand['brand_name'] }}</h2>


                </div>

                @php
                    if ($loop->iteration == 4) {
                        break;
                    }
                @endphp
            @endforeach

        </div>
    </div>


    <div class="p-10">
        <div class=" text-center flex flex-col pb-10">
            <p class="text-2xl font-semibold text-center">Best Renting Bikes</p>
            <small class=" text-center">Hire Bike on rent</small>
        </div>

        <x-bike-card />
    </div>
@endsection
