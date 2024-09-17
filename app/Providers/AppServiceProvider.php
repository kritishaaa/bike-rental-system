<?php

namespace App\Providers;

use App\Models\Company;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        // $company = Company::first();
        view()->share('companyname', 'Bike Rental');
        view()->share('companyaddress', 'Pokhara');
        view()->share('companyphonenumber', '9840839292');

        // if (isset($company)) {
        //     view()->share('companyname', $company['name']);
        //     view()->share('companyaddress', $company['address']);
        //     view()->share('companyphonenumber', $company['phonenumber']);
        // } else {
        //     view()->share('companyname', 'Bike Rental');
        //     view()->share('companyaddress', 'Pokhara');
        //     view()->share('companyphonenumber', '9840839292');
        // }
    }
}
