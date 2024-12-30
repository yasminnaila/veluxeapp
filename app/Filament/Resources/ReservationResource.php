<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservationResource\Pages;
use App\Filament\Resources\ReservationResource\RelationManagers;
use App\Models\Reservation;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Columns\TextColumn;

class ReservationResource extends Resource
{
    protected static ?string $model = Reservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Select::make('guests_id')
                ->relationship('guests', 'name')
                ->required()
                ->label('Penyewa'),
            Select::make('room_id')
                ->relationship('room', 'name')
                ->required()
                ->label('Kamar'),
            DatePicker::make('check_in')
                ->required()
                ->label('Check-In'),
            DatePicker::make('check_out')
                ->required()
                ->label('Check-Out'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('guests.name')->label('Penyewa'),
            TextColumn::make('room.name')->label('Kamar'),
            TextColumn::make('check_in')->label('Check-In'),
            TextColumn::make('check_out')->label('Check-Out'),
        ])
        ->filters([]);

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
            'index' => Pages\ListReservations::route('/'),
            'create' => Pages\CreateReservation::route('/create'),
            'edit' => Pages\EditReservation::route('/{record}/edit'),
        ];
    }
}
