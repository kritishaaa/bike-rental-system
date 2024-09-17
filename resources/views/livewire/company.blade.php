<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    @include('layouts.successmsg')
    
@if ($toggle=='show')
 
<div class="fixed w-screen h-screen top-0 left-0 justify-center flex flex-row items-center backdrop-blur-lg">


<form wire:submit.prevent="submit" method="POST" class="w-[50rem] relative bg-white rounded">
    <button wire:click="toggleeditcompany" type="button" class=" absolute top-2 right-2"> <i class="fa fa-times hover:bg-black hover:text-white rounded-full p-1" aria-hidden="true" ></i>
   </button>
    <legend class="p-3 m-auto text-center font-semibold text-lg">Company Details</legend>
@csrf

<div class="shadow border p-8 flex flex-col gap-4 rounded">

     <div class="flex flex-col gap-2">
      <label for="" class="text-md">Company name</label>
      <input type="text" class="rounded" placeholder="Enter Your company name" wire:model="name" value="{{ $name }}">
      @error('name')
          <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
     </div>
       <div class="flex flex-col gap-2">
      <label for="" class="text-md">Company Address</label>
      <input type="text" class="rounded" placeholder="Enter Your company Address" wire:model="address" value="{{ $address }}">
       @error('address')
          <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
     </div>
       <div class="flex flex-col gap-2">
      <label for="" class="text-md">Company Phone Number</label>
      <input type="number" class="rounded" placeholder="Enter Your company phone number" wire:model="phone_number" value="{{ $phone_number }}">
       @error('phone_number')
          <span class="text-red-500 text-sm">{{ $message }}</span>
      @enderror
     </div>

     <button class="bg-black text-white py-2 rounded-sm" type="submit">Setup Company</button>


</div>

</form>

</div>

@endif


    <div class="shadow border m-8 p-8 flex flex-col gap-4">
 <div class="flex justify-end">
   <button class="bg-black text-stone-100 px-3 py-0.5 rounded-sm" wire:click="toggleeditcompany">Edit Company Info</button>
 </div>
    <div class="flex flex-col gap-2">
      <label for="">Company Name: {{ $name }}</label>
      <label for=""> Company Address: {{ $address }}</label>
      <label for=""> Company Phone Number: {{ $phone_number }}</label>
    </div>
    

</div>



</div>
