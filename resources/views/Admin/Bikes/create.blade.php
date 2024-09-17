@extends('layouts.app')

@section('content')

<div>
 <p class="font-bold text-xl">Add Bikes</p>

    <form action="{{route('bikes.store')}}" method="post" enctype="multipart/form-data">
        @csrf
       <div class="flex flex-col gap-4 p-3 shadow-lg rounded-lg border border-b-2 border-gray-600">
        <div>
            <label for="number_plate">Bike Plate Number</label>
            <input type="text" name="number_plate" id="number_plate" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{old('number_plate')}}">
            <x-input-error :messages="$errors->get('number_plate')" class="mt-2" />
        </div>
        <div>
            <label for="cc">Bike cc</label>
            <input type="text" name="cc" id="cc" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{old('cc')}}">
            <x-input-error :messages="$errors->get('cc')" class="mt-2" />
        </div>
        <div>
            <label for="name">Bike Variant</label>
            <select name="variant" id="" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                @foreach ($variants as $variant)
                    <option  value="{{$variant['id']}}">{{$variant['variant_name']}}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
        </div>
        <div>
            <rental_price for="model_year">Model Year</rental_price>
            <input type="number"  name="model_year" id="date" min="2010" max="2023" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <x-input-error :messages="$errors->get('model_year')" class="mt-2" />
        </div>
        <div>
            <label for="name">Status</label>
            <select name="status" id="" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
               
                    <option  value="Available">Available</option>
                    <option value="Unavaiable">Unavailable</option>
              
            </select>
            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
        </div>
         <div>
           <label for="image">Upload  Bill Book copy</label>
           <input type="file" class="bg-gray-200 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="image"/>
            <x-input-error :messages="$errors->get('Variantlogos')" class="mt-2" />
        </div>
        <div>
            <input class="bg-black text-white w-full rounded-lg py-2" type="submit" value="Add Bike">
        </div>
       </div>
    </form>
</div>


@endsection