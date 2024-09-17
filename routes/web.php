<?php

use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\BikesController;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\RentsController;
use App\Http\Controllers\Admin\VariantsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Renter\RenterController;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Mail\ObrsMail;
use App\Models\Brand;
use App\Models\Rent;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleMail;
use App\Mail\TicketMail;
use App\Mail\WelcomeMail;
use App\Models\Bike;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    $brands = Brand::all();
    return view('home', compact('brands'));
})->name('home');




Route::get('/noaccess', function () {

    return view('noaccess.noaccess');
})->name('no-access');



Route::middleware(['auth', 'isadmin', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');




    Route::get('/bikes', [BikesController::class, 'index'])->name('bikes.index');
    Route::get('/bikes/create', [BikesController::class, 'create'])->name('bikes.create');
    Route::post('/bikes', [BikesController::class, 'store'])->name('bikes.store');
    Route::get('/bikes/{id}/edit', [BikesController::class, 'edit'])->name('bikes.edit');
    Route::post('/bikes/{id}/update', [BikesController::class, 'update'])->name('bikes.update');
    Route::post('/bikes/destroy', [BikesController::class, 'destroy'])->name('bikes.destroy');


    Route::get('/variants', [VariantsController::class, 'index'])->name('variants.index');
    Route::get('/variants/create', [VariantsController::class, 'create'])->name('variants.create');
    Route::post('/variants', [VariantsController::class, 'store'])->name('variants.store');
    Route::get('/variants/{id}/edit', [VariantsController::class, 'edit'])->name('variants.edit');
    Route::post('/variants/{id}/update', [VariantsController::class, 'update'])->name('variants.update');


    Route::resource('/rents', RentsController::class);
    Route::post('/getVariant', [RentsController::class, 'getVariant']);
    Route::post('/getBike', [RentsController::class, 'getBike']);
    Route::post('/getRentalDates', [RentsController::class, 'getRentalDates']);

    Route::get('/brands', [BrandsController::class, 'index'])->name('brands.index');
    Route::get('/brands/create', [BrandsController::class, 'create'])->name('brands.create');
    Route::post('/brands', [BrandsController::class, 'store'])->name('brands.store');
    Route::get('/brands/{id}/edit', [BrandsController::class, 'edit'])->name('brands.edit');
    Route::post('/brands/{id}/update', [BrandsController::class, 'update'])->name('brands.update');
    Route::post('/brands/destroy', [BrandsController::class, 'destroy'])->name('brands.destroy');


    Route::resource('company', CompanyController::class);
    Route::resource('analytics', AnalyticsController::class);
    Route::post('/changemonth', [AnalyticsController::class, 'changemonth']);
});




Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/showbikes', [RenterController::class, 'index'])->name('renter.showbikes');
    Route::post('/bikedetails', [RenterController::class, 'bikedetails'])->name('renter.bikedetails');
    Route::get('/rentdetails', [RenterController::class, 'rentdetails'])->name('renter.rent.details');
    Route::post('/khaltirent', function (Request $request) {




        $rentbike = [
            "rent_from_date" => session()->get('from_date'),
            "rent_to_date" => session()->get('to_date'),
            "rental_status" => "Pending",
            "payment_method" => "Online",
            'total_rental_price' => $request['data']['amount'],
            "user_id" => auth()->user()->id
        ];







        $args = http_build_query(array(
            'token' => $request['data']['token'],
            'amount'  => $request['data']['amount']
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Authorization: Key test_secret_key_cd6a0ffde92e4966b416e168e73929d2'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);






        if ($status_code == 200) {

            $bike_id = Bike::where('number_plate', '=', $request['data']['product_identity'])->first();

            $rentbike['bike_id'] = $bike_id->id;

            Rent::create($rentbike);

            session()->flash('success', 'Rent Request is Succesfully Send and Online payment Successful');
            return response()->json(['success' => 1, 'redirectto' => route('renter.rent.details')]);
        } else {
            return response()->json(['error' => 1, 'message' => 'Payment Failed']);
        }
        // Rent::create($rentbike);
        // $bike['status'] = "On Rent";
        // Bike::find($this->bike->id)->update($bike);


        // return response()->json($request->toArray());
    })->name('khaltirent');
});


Route::get('/test', function () {


    $rent = Rent::find(5);
    $rent->id = 5;
    $rentalbike = Rent::find(5);



    // return view('frontend.partials.rentalticket',compact('rentalbike','rent'));
});

// Auth::routes(['verify' => true]);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
