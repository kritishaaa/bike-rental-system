<?php

declare(strict_types=1);

namespace App\Filament\Resources\BikeResource\Pages;

use App\Filament\Resources\BikeResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateBike extends CreateRecord
{
    protected static string $resource = BikeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Bike created')
            ->body('Bike created successfully.');
    }
}
