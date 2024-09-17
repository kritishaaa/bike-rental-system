<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bike;
use App\Models\Brand;
use App\Models\Rent;
use App\Models\User;
use App\Models\Variant;
use App\Rules\EmailNotFound;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return view('admin.rents.index');
    }

    /*
    Disable date return

    */

    public function rented_dates($from_date, $to_date)
    {
        $rented_dates = [];

        $current_date = Carbon::parse($from_date);
        $end_date = Carbon::parse($to_date);

        for ($i = $current_date; $i <= $end_date; $i->addDay()) {
            $rented_dates[] = $i->format('Y-m-d');
        }

        return $rented_dates;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $brands = Brand::all();

        return view('admin.rents.create', compact('brands'));
    }

    public function getVariant(Request $request)
    {

        $data = Variant::all()->where('brand_id', '=', $request->brand_id);
        $variants = $data->toArray();

        return response()->json($variants);
    }

    public function getRentalDates(Request $request)
    {
        $rental_dates = Rent::all()->where('bike_id', '=', $request->bike_id);
        $rental_dates = $rental_dates->toArray();

        return response()->json($rental_dates);
    }

    public function getBike(Request $request)
    {

        // $data=Bike::all()->where('variant_id','=',$request->variant_id);
        $data = Bike::join('variants', 'variants.id', '=', 'bikes.variant_id')
            ->select('bikes.*', 'variants.variant_rental_price')->where('variant_id', '=', $request->variant_id)->get();

        $bikes = $data->toArray();

        return response()->json($bikes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //total_rental_price
        //

        $request->validate([
            'email' => ['required', 'email', new EmailNotFound],
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $variants = Variant::find($request->variant);

        $from_date = Carbon::createFromDate($request->from_date);
        $to_date = Carbon::createFromDate($request->to_date);

        $rental_days = $to_date->diffInDays($from_date);
        $total_rental_price = $variants['variant_rental_price'] * $rental_days;

        $user = User::all()->where('email', '=', $request->email)[0];

        $data = [
            'rent_from_date' => $request->from_date,
            'rent_to_date' => $request->to_date,
            'rental_status' => 'Approved',
            'total_rental_price' => $total_rental_price,
            'rental_number' => uniqid(),
            'payment_method' => 'Cash on Hand',
            'bike_id' => $request->bike,
            'user_id' => $user->id,
        ];

        $bike['status'] = 'On Rent';
        Bike::find($request->bike)->update($bike);

        Rent::create($data);

        return redirect(route('rents.index'))->with('success', 'Bike Added on rent Successfully');
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
