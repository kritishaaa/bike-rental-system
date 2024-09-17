@extends('layouts.app')

@section('content')

<div>
 <p class="font-bold text-xl">Edit Brand</p>

    <form action="{{ route('brands.update', ['id'=>$brand['id']]) }}" method="post" enctype="multipart/form-data">
        @csrf
       <div class="flex flex-col gap-4 p-3 shadow-lg rounded-lg border border-b-2 border-gray-600">
        <div>
            <label for="name">Brand Name</label>
            <input type="text" name="brand_name" id="name" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ $brand['brand_name']}} ">
            <x-input-error :messages="$errors->get('brand_name')" class="mt-2" />
        </div>
        <div  class="flex flex-row gap-4">
            <img src="{{ asset('storage/'.$brand['brand_logo'] )}}" alt="image" class="h-20" style="object-fit: cover" >
            <div class="flex-1">
                <label for="logo">Upload  Brand Logo</label>
                <input type="file" class="bg-gray-200 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="brand_logo"/>
                 <x-input-error :messages="$errors->get('brand_logo')" class="mt-2" />
             </div>
        </div>
        <div>
            <input class="bg-black text-white w-full rounded-lg py-2" type="submit" value="Edit Brand">
        </div>
       </div>
    </form>
</div>

@endsection