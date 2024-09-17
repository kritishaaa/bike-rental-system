<?php

namespace App\View\Components;

use App\Models\Bike;
use App\Models\Rent;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class BikeCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $bikes, $trending_bikes;
    public function __construct()
    {

        //
        // dd(date('Y-m'));
        $this->trending_bikes = Rent::select('bike_id', DB::raw('COUNT(bike_id) AS bike_count'))
            ->where(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'), '=', date('Y-m'))
            ->groupBy('bike_id')
            ->orderBy('bike_count', 'DESC')
            ->pluck('bike_id');

        // dd($this->trending_bikes->toArray());

        $this->bikes = Bike::when($this->trending_bikes, function ($query) {
            $query->whereIn('id', $this->trending_bikes);
        })
            ->where('status', '=', 'Available')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bike-card');
    }
}
