<?php
declare(strict_types=1);
namespace App\Filament\Resources;

use App\Filament\Resources\RentResource\Pages;
use App\Filament\Resources\RentResource\RelationManagers;
use App\Models\Rent;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RentResource extends Resource
{
    protected static ?string $model = Rent::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Rental name')
                    ->sortable(),
                TextColumn::make('bike.number_plate')
                    ->label('Bike')
                    ->sortable(),
                TextColumn::make('rental_number')->sortable(),
                TextColumn::make('rent_from_date')->label('from')->sortable(),
                TextColumn::make('rent_to_date')
                ->label('to')->sortable(),
                TextColumn::make('rental_status')->sortable(),
                TextColumn::make('created_at') 
                    ->label('Booked At')
                    ->date() 
                    ->sortable(),
               
                TextColumn::make('total_rental_price')
                    ->label('Rental Price')
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRents::route('/'),
            'create' => Pages\CreateRent::route('/create'),
            'edit' => Pages\EditRent::route('/{record}/edit'),
        ];
    }    
}
