<?php

declare(strict_types=1);

namespace App\Http\Livewire;

use App\Models\Bike;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VariantsChart extends Component
{
    public $idvalue;

    public $variant_counts;

    public $variant_names;

    public $demo;

    public $getmonth;

    public $month;

    public function mount()
    {

        $this->month = date('Y-m');

        $results = Bike::join('variants', 'bikes.variant_id', '=', 'variants.id')
            ->join('rents', 'bikes.id', '=', 'rents.bike_id')
            ->select('variants.variant_name', DB::raw('COUNT(variants.variant_name) AS variant_count'))
            ->groupBy('variants.variant_name')
            ->get();

        $this->variant_counts = $results->pluck('variant_count');
        $this->variant_names = $results->pluck('variant_name');
    }

    public function render()
    {

        return view('livewire.variants-chart');
    }
}
