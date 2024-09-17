@extends('layouts.app')

@section('content')
    <div class="flex flex-col space-y-2">
        <h2 class="text-2xl font-bold">Analytics</h2>

        <hr class="h-1 bg-black">
    </div>





    <livewire:analytics-charts :bikecounts="$bikecounts" />
@endsection
