@extends('layouts.renter')

@section('content')
    @livewire('bike-details', ['bike' => $bike, 'rentcounts' => $rentcounts, 'recommendedbikes' => $recommendedbikes])
@endsection
