<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\VariantsChart;
use App\Models\Bike;
use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsCharts extends Component
{
    public $month, $sn = 0, $bikecounts, $totalrents, $topbikes;


    public function mount()
    {
        $this->month = date('Y-m');
        $this->bikecounts = Bike::where('created_at', 'LIKE', "$this->month%")->count();
        $this->totalrents = Rent::where('created_at', 'LIKE', "$this->month%")->count();
    }







    public function render()
    {


        return view('livewire.analytics-charts');
    }
}
