<?php

declare(strict_types=1);

namespace App\Filament\Resources\RentResource\Pages;

use App\Filament\Resources\RentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRent extends CreateRecord
{
    protected static string $resource = RentResource::class;
}
