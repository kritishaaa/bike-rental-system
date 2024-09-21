<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Bike;
use App\Models\Rent;
use Livewire\Component;

class AnalyticsCharts extends Component
{
    public $month;

    public $sn = 0;

    public $bikecounts;

    public $totalrents;

    public $topbikes;

    public function mount()
    {
        $this->month = date('Y-m');
        $this->bikecounts = Bike::where('created_at', 'LIKE', "{$this->month}%")->count();
        $this->totalrents = Rent::where('created_at', 'LIKE', "{$this->month}%")->count();
    }

    public function render()
    {

        return view('livewire.analytics-charts');
    }
}
