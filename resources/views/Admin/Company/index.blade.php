@extends('layouts.app')

@section('content')
    
<div class="flex flex-col space-y-2">
    <h2 class="text-2xl font-bold">Company Setup</h2>

    <hr class="h-1 bg-black">
   </div>


<livewire:company/>



<script>
   let table=new DataTable('#mytable')
</script>

@endsection