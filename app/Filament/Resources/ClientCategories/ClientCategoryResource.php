<?php

namespace App\Filament\Resources\ClientCategories;

use App\Filament\Resources\ClientCategories\Pages\CreateClientCategory;
use App\Filament\Resources\ClientCategories\Pages\EditClientCategory;
use App\Filament\Resources\ClientCategories\Pages\ListClientCategories;
use App\Models\ClientCategory;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class ClientCategoryResource extends Resource
{
    protected static ?string $model = ClientCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static string|UnitEnum|null $navigationGroup = 'Data Master';

    protected static ?string $modelLabel = 'Kategori Klien Rehsos';

    protected static ?string $pluralModelLabel = 'Kategori Klien';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Kategori Klien')
                    ->placeholder('Misal: Lansia Terlantar, Penyandang Disabilitas, ODGJ, Anak Terlantar')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Kategori')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('clients_count')
                    ->label('Jumlah Klien')
                    ->counts('clients')
                    ->badge()
                    ->color('info'),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListClientCategories::route('/'),
            'create' => CreateClientCategory::route('/create'),
            'edit' => EditClientCategory::route('/{record}/edit'),
        ];
    }
}
