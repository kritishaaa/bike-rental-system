<?php

declare(strict_types=1);

namespace App\Filament\Resources\BikeResource\Pages;

use App\Filament\Resources\BikeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBikes extends ListRecords
{
    protected static string $resource = BikeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
