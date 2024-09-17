@extends('layouts.app')

@section('content')
    
<div class="flex flex-col space-y-2">
    <h2 class="text-2xl font-bold">Bikes</h2>

    <hr class="h-1 bg-black">
   </div>

   @php
       $sn=1
   @endphp

  <livewire:bikes />


   </div>






@endsection