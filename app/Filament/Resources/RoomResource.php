<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Models\Room;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\BadgeColumn;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
                ->required()
                ->label('Nama Kamar'),
            TextInput::make('type')
                ->required()
                ->label('Tipe Kamar'),
            TextInput::make('price')
                ->numeric()
                ->required()
                ->label('Harga')
                ->rules(['min:0']), // Harga minimal 0
            Select::make('status')
                ->options([
                    'available' => 'Tersedia',
                    'unavailable' => 'Tidak Tersedia',
                ])
                ->required()
                ->label('Status'),

        ]);

    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('name')->label('Nama Kamar')->searchable(),
            TextColumn::make('type')->label('Tipe'),
            TextColumn::make('price')->label('Harga'),
            BadgeColumn::make('status')
                ->enum([
                    'available' => 'Tersedia',
                    'unavailable' => 'Tidak Tersedia',
                ])->label('Status'),
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
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
