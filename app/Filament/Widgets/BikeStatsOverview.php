<?php

namespace App\Filament\Widgets;

use App\Models\Bike;
use App\Models\Brand;
use App\Models\Rent;
use App\Models\Variant;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class BikeStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Bikes', Bike::count())
                ->description('Active Bikes: '.Bike::where('status', 'available')->count())
                ->color('success'),
            Card::make('Total Brands', Brand::count())
                ->color('success'),
            Card::make('Total Variants', Variant::count())
                ->color('success'),
            Card::make('Total Rents', Rent::count())
            
        ];
    }
}
