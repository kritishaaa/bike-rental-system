<?php

namespace App\Http\Livewire;

use App\Models\Rent;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RevenveChart extends Component
{
    public $dates = [], $revenve = [], $rents, $total_rental_price = [], $month;


    public function mount()
    {

        //
        $this->month = date('Y-m');
        $this->rents = Rent::selectRaw('DATE(created_at) AS rental_date, SUM(total_rental_price) AS total_rental_price')
            ->where(DB::raw('DATE(created_at)'), 'LIKE', "$this->month%")
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();


        $this->total_rental_price = $this->rents->pluck('total_rental_price')->toArray();
        $this->dates = $this->rents->pluck('rental_date')->toArray();
    }
    public function render()
    {
        return view('livewire.revenve-chart');
    }
}
