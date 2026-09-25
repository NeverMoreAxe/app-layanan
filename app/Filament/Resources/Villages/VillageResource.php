<?php

namespace App\Filament\Resources\Villages;

use App\Filament\Resources\Villages\Pages\CreateVillage;
use App\Filament\Resources\Villages\Pages\EditVillage;
use App\Filament\Resources\Villages\Pages\ListVillages;
use App\Models\Village;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class VillageResource extends Resource
{
    protected static ?string $model = Village::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHomeModern;

    protected static string|UnitEnum|null $navigationGroup = 'Data Master';

    protected static ?string $modelLabel = 'Desa / Kelurahan';

    protected static ?string $pluralModelLabel = 'Desa / Kelurahan';

    protected static ?int $navigationSort = 6;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('district_id')
                    ->label('Kecamatan')
                    ->relationship('district', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('code')
                    ->label('Kode Desa/Kelurahan')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(20),
                TextInput::make('name')
                    ->label('Nama Desa / Kelurahan')
                    ->required()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('district.name')
                    ->label('Kecamatan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('code')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama Desa / Kelurahan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('district_id')
                    ->label('Filter Kecamatan')
                    ->relationship('district', 'name')
                    ->searchable()
                    ->preload(),
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
            'index' => ListVillages::route('/'),
            'create' => CreateVillage::route('/create'),
            'edit' => EditVillage::route('/{record}/edit'),
        ];
    }
}
