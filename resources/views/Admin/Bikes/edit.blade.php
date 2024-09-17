@extends('layouts.app')

@section('content')
    <div>
        <p class="font-bold text-xl">Edit Bikes</p>

        <form action="{{ route('bikes.update', $bike->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col gap-4 p-3 shadow-lg rounded-lg border border-b-2 border-gray-600">
                <div>
                    <label for="number_plate">Bike Plate Number</label>
                    <input type="text" name="number_plate" id="number_plate"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        value="{{ $bike['number_plate'] }}">
                    <x-input-error :messages="$errors->get('number_plate')" class="mt-2" />
                </div>
                <div>
                    <label for="cc">Bike cc</label>
                    <input type="text" name="cc" id="cc"
                        class="mt-1 block w-full border-gray-300 focus:border-
            indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        value="{{ $bike['cc'] }}">
                    <x-input-error :messages="$errors->get('cc')" class="mt-2" />
                </div>
                <div>
                    <label for="name">Bike Variant</label>
                    <select name="variant" id=""
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">

                        @foreach ($variants as $variant)
                            <option value="{{ $variant['id'] }}" @if ($bike->variants_id == $variant->id) selected @endif>
                                {{ $variant['variant_name'] }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                </div>
                <div>
                    <rental_price for="model_year">Model Year</rental_price>
                    <input type="number" name="model_year" id="date" min="2010" max="2023"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        value="{{ $bike['model_year'] }}">
                    <x-input-error :messages="$errors->get('model_year')" class="mt-2" />
                </div>

                <div class="flex flex-row gap-4 my-2">
                    <div>
                        <img src="{{ asset('storage/bike_images/' . $bike['billbook']) }}" alt="" width="250px"
                            style="object-fit: fill">
                    </div>
                    <div class="flex-1 flex flex-col gap-3">
                        <div>
                            {{ $bike['status'] }}
                            <label for="name">Status</label>
                            <select name="status" id=""
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                name="status">
                                <option value="{{ $bike['status'] }}">{{ $bike['status'] }}</option>
                                <option value="Available" @if ($bike->status == 'Available') selected @endif>Available
                                </option>
                                <option value="Unavaiable" @if ($bike->status == 'Unavaiable') selected @endif>Unavailable
                                </option>

                            </select>
                            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                        </div>
                        <label for="image">Upload Bill Book copy</label>
                        <input type="file"
                            class="bg-gray-200 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            name="billbook" />
                        <x-input-error :messages="$errors->get('Variantlogos')" class="mt-2" />

                    </div>
                </div>
                <div>
                    <input class="bg-black text-white w-full rounded-lg py-2" type="submit" value="Update Bike Details">
                </div>
            </div>
        </form>
    </div>
@endsection
