<?php

namespace App\Filament\Resources\DtsenPurposes;

use App\Filament\Resources\DtsenPurposes\Pages\CreateDtsenPurpose;
use App\Filament\Resources\DtsenPurposes\Pages\EditDtsenPurpose;
use App\Filament\Resources\DtsenPurposes\Pages\ListDtsenPurposes;
use App\Models\DtsenPurpose;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class DtsenPurposeResource extends Resource
{
    protected static ?string $model = DtsenPurpose::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentCheck;

    protected static string|UnitEnum|null $navigationGroup = 'Data Master';

    protected static ?string $modelLabel = 'Tujuan SK DTSEN';

    protected static ?string $pluralModelLabel = 'Tujuan SK DTSEN';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label('Kode')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->placeholder('spmb, pip, kip_kuliah, bansos'),
                TextInput::make('name')
                    ->label('Nama Tujuan Penggunaan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('max_decile')
                    ->label('Batas Maksimal Desil')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(10)
                    ->required()
                    ->helperText('Hanya pemohon dengan desil SIKS-NG ≤ batas ini yang dapat diterbitkan suratnya'),
                TextInput::make('validity_days')
                    ->label('Masa Berlaku Surat (Hari)')
                    ->numeric()
                    ->minValue(1)
                    ->default(90)
                    ->suffix('Hari')
                    ->helperText('Kosongkan jika berlaku tanpa batas waktu'),
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Kode')
                    ->badge()
                    ->color('primary')
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Tujuan Penggunaan')
                    ->searchable(),
                TextColumn::make('max_decile')
                    ->label('Batas Desil')
                    ->badge()
                    ->color('warning')
                    ->prefix('Desil ≤ '),
                TextColumn::make('validity_days')
                    ->label('Masa Berlaku')
                    ->suffix(' hari')
                    ->placeholder('Permanen'),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
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
            'index' => ListDtsenPurposes::route('/'),
            'create' => CreateDtsenPurpose::route('/create'),
            'edit' => EditDtsenPurpose::route('/{record}/edit'),
        ];
    }
}
