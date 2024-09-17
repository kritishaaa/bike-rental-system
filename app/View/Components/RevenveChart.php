<?php

namespace App\View\Components;

use App\Models\Rent;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class RevenveChart extends Component
{
    /**
     * Create a new component instance.
     */
    public $dates = [], $revenve = [], $rents, $total_rental_price = [], $month;
    public function __construct($month)
    {
        $this->month = $month;
        //
        $this->rents = Rent::selectRaw('DATE(created_at) AS rental_date, SUM(total_rental_price) AS total_rental_price')
            ->where(DB::raw('DATE(created_at)'), 'LIKE', "$month%")
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();


        $this->total_rental_price = $this->rents->pluck('total_rental_price')->toArray();
        $this->dates = $this->rents->pluck('rental_date')->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.revenve-chart');
    }
}
