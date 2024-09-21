<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Models\Bike;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class VariantsChart extends Component
{
    /**
     * Create a new component instance.
     */
    public $idvalue;

    public $variant_counts;

    public $variant_names;

    public $month;

    public function __construct($idvalue, $month)
    {
        //
        $this->idvalue = $idvalue;
        $this->month = $month;

        $results = Bike::join('variants', 'bikes.variant_id', '=', 'variants.id')
            ->join('rents', 'bikes.id', '=', 'rents.bike_id')
            ->select('variants.variant_name', DB::raw('COUNT(variants.variant_name) AS variant_count'))
            ->where('bikes.created_at', 'LIKE', "{$month}%")
            ->groupBy('variants.variant_name')
            ->get();

        $this->variant_counts = $results->pluck('variant_count');
        $this->variant_names = $results->pluck('variant_name');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.variants-chart');
    }
}
