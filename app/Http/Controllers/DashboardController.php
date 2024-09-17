<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Bikes;
use App\Models\Brand;
use App\Models\Rent;
use App\Models\User;
use App\Models\Variant;
use App\Models\Variants;
use Carbon\Carbon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        //
        $brands = Brand::count();
        $variants = Variant::count();
        $bikes = Bike::count();
        $newrents = Rent::count();
        $registeredrents = Rent::count();
        $rents = Rent::count();
        $renters = User::where('role', 'renter')->count();


        // $first_row_rent=Rent::first()->value('rent_from_date');
        //   $last_row_rent=Rent::latest('id')->value('rent_to_date');

        $first_row_rent = Rent::min('rent_from_date');
        $last_row_rent = Rent::max('rent_to_date');
        $intial_date = Carbon::parse($first_row_rent);
        $final_Date = Carbon::parse($last_row_rent);

        $dateCounts = [];
        $j = 0;

        for ($i = clone $intial_date; $i <= $final_Date; $i->addDay()) {

            $date = $i->toDateString();
            $bikecount = Rent::where('rent_from_date', '<=', $date)->where('rent_to_date', '>=', $date)->count('bike_id');
            $dates[$j] = $date;
            $bikecounts[$j] = $bikecount;
            $j++;
        }


        // $dateCounts=collect($dateCounts)->paginate(5);

        $counts = compact('brands', 'variants', 'bikes', 'bikecounts', 'dates', 'newrents', 'registeredrents', 'rents', 'renters');



        return view('admin.dashboard')->with($counts);
    }
}
