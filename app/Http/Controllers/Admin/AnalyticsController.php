<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Bikes;
use App\Models\Bike;
use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bikecounts = $this->bikes('2023-06');

        return view('Admin.Analytics.index', compact('bikecounts'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function bikes($month)
    {
        $bikes = Bike::where('created_at', 'LIKE', "$month%")->count();

        // dd($bikes);
    }



    public function create()
    {
        //
    }

    public function changemonth(Request $request)
    {
        $month = $request->month;
        $results = Bike::join('variants', 'bikes.variant_id', '=', 'variants.id')
            ->join('rents', 'bikes.id', '=', 'rents.bike_id')
            ->where('rents.created_at', 'LIKE', "$month%")
            ->select('variants.variant_name', DB::raw('COUNT(variants.variant_name) AS variant_count'))
            ->groupBy('variants.variant_name')
            ->get();


        $variant_counts = $results->pluck('variant_count');
        $variant_names = $results->pluck('variant_name');

        $rents = Rent::selectRaw('DATE(created_at) AS rental_date, SUM(total_rental_price) AS total_rental_price')
            ->where(DB::raw('DATE(created_at)'), 'LIKE', "$month%")
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();


        $total_rental_price = $rents->pluck('total_rental_price')->toArray();
        $dates = $rents->pluck('rental_date')->toArray();



        $revenve = Rent::where('rents.created_at', 'LIKE', "$month%")->get();
        $creditcount = $revenve->where('payment_method', '=', 'Credit')->sum('total_rental_price');
        $onlinecount = $revenve->where('payment_method', '=', 'Online')->sum('total_rental_price');
        $cashcount = $revenve->where('payment_method', '=', 'Cash on Hand')->sum('total_rental_price');

        $totalcounts = $revenve->sum('total_rental_price');


        $countsbike = Bike::where('created_at', 'LIKE', "$month%")->count();
        $countrent = Rent::where('created_at', 'LIKE', "$month%")->count();

        $monthcount = [$countrent, $countsbike];




        $variant_revenve = [$dates, $total_rental_price];
        $totalrevenve = [[$creditcount, $cashcount, $onlinecount], $totalcounts];
        $variants = [$variant_counts, $variant_names];
        $response = [$month, $variants, $variant_revenve, $totalrevenve, $monthcount];


        return response()->json($response);
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
