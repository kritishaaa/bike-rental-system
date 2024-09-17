<?php

namespace App\Http\Controllers\Renter;

use App\Http\Controllers\Controller;
use App\Models\Bike;
use App\Models\Brand;
use App\Models\Rent;
use App\Models\User;
use App\Models\Variant;
use Illuminate\Http\Request;

class RenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $brands = Brand::all();

        $ccs = Bike::groupBy('cc')->pluck('cc');

        $prices = Variant::groupBy('variant_rental_price')->pluck('variant_rental_price');

        return view('frontend.bikes', compact('brands', 'prices', 'ccs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function bikedetails(Request $request)
    {
        //
        $rents = Rent::where('bike_id', '=', $request->bike_id);
        $rentcounts = $rents->count();
        $bike = Bike::find($request->bike_id);
        $recommendedbikes = Bike::where('id', '!=', $request->bike_id)->where('status', '=', 'Available')->orWhere('variant_id', '=', $bike->variant->id)->orWhere('cc', $bike->cc)->get();

        // dd(User::find(auth()->user()->id)->rent()->toArray());

        $rented_user = Rent::select('rents.*', 'bikes.*', 'users.*')
            ->join('users', 'users.id', '=', 'rents.user_id')
            ->join('bikes', 'bikes.id', '=', 'rents.bike_id')
            ->where('user_id', auth()->user()->id)
            ->where('status', 'On Rent')
            ->whereIn('rental_status', ['Pending', 'Approved']);
        // dd($rented_user->pluck('status'))

        if ($rented_user->get()->toArray()) {

            session()->flash('error', 'Already Rented a Bike');
            $brands = Brand::all();

            $ccs = Bike::groupBy('cc')->pluck('cc');

            $prices = Variant::groupBy('variant_rental_price')->pluck('variant_rental_price');

            return view('frontend.bikes', compact('brands', 'prices', 'ccs', 'rented_user'));
        } else {
            // code...
            return view('frontend.bikedetails', compact('bike', 'rentcounts', 'recommendedbikes'));
        }
    }

    public function rentdetails()
    {

        return view('frontend.rentdetails');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
