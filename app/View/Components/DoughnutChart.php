<?php

namespace App\View\Components;

use App\Models\Rent;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DoughnutChart extends Component
{
    public $idvalue, $creditcount, $cashcount, $onlinecount, $totalcounts, $counts = [], $month;

    /**
     * Create a new component instance.
     */



    public function __construct($idvalue, $month)
    {
        //
        $this->month = $month;
        $revenve = Rent::where('rents.created_at', 'LIKE', "$month%")->get();
        $this->creditcount = $revenve->where('payment_method', '=', 'Credit')->sum('total_rental_price');
        $this->onlinecount = $revenve->where('payment_method', '=', 'Online')->sum('total_rental_price');
        $this->cashcount = $revenve->where('payment_method', '=', 'Cash on Hand')->sum('total_rental_price');

        $this->totalcounts = $revenve->sum('total_rental_price');
        $this->counts = [$this->creditcount, $this->cashcount, $this->onlinecount];
        $this->idvalue = $idvalue;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.doughnut-chart');
    }
}
