@extends('layouts.app')

@section('content')
    <div>
        <p class="font-bold text-xl">Add Variant</p>

        <form action="{{ route('variants.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col gap-4 p-3 shadow-lg rounded-lg border border-b-2 border-gray-600">
                <div>
                    <label for="name">Variant Name</label>
                    <input type="text" name="variant_name" id="name"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        value="{{ old('variant_name') }}">
                    <x-input-error :messages="$errors->get('variant_name')" class="mt-2" />
                </div>
                <div>
                    <label for="name">Variant Brand</label>
                    <select name="brand" id=""
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand['id'] }}">{{ $brand['brand_name'] }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                </div>
                <div>
                    <rental_price for="variant_rental_price">Rental Price</rental_price>
                    <input type="number" name="variant_rental_price" id="Rentprice"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <x-input-error :messages="$errors->get('variant_rental_price')" class="mt-2" />
                </div>
                <div>
                    <label for="variant_image">Upload Variant Image</label>
                    <input type="file"
                        class="bg-gray-200 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        name="variant_image" />
                    <x-input-error :messages="$errors->get('variant_image')" class="mt-2" />
                </div>
                <div>
                    <input class="bg-black text-white w-full rounded-lg py-2" type="submit" value="Add Variant">
                </div>
            </div>
        </form>
    </div>
@endsection
