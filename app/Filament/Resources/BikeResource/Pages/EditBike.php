<?php

declare(strict_types=1);

namespace App\Filament\Resources\BikeResource\Pages;

use App\Filament\Resources\BikeResource;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBike extends EditRecord
{
    protected static string $resource = BikeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Bike Updated')
            ->body('Bike updated successfully.');
    }
}
