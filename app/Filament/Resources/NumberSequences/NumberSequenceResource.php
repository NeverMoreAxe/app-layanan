<?php

namespace App\Filament\Resources\NumberSequences;

use App\Filament\Resources\NumberSequences\Pages\CreateNumberSequence;
use App\Filament\Resources\NumberSequences\Pages\EditNumberSequence;
use App\Filament\Resources\NumberSequences\Pages\ListNumberSequences;
use App\Models\NumberSequence;
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

class NumberSequenceResource extends Resource
{
    protected static ?string $model = NumberSequence::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHashtag;

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Sistem';

    protected static ?string $modelLabel = 'Penomoran Tiket';

    protected static ?string $pluralModelLabel = 'Penomoran Tiket';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('prefix')
                    ->label('Prefix Kode')
                    ->required()
                    ->maxLength(20)
                    ->placeholder('Misal: DTSEN, PBI, ADU, RHS, RJK'),
                TextInput::make('period')
                    ->label('Periode (YYYYMM)')
                    ->required()
                    ->maxLength(10)
                    ->placeholder('202610'),
                TextInput::make('last_number')
                    ->label('Nomor Urut Terakhir')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('prefix')
                    ->label('Prefix')
                    ->badge()
                    ->color('primary')
                    ->searchable(),
                TextColumn::make('period')
                    ->label('Periode')
                    ->searchable(),
                TextColumn::make('last_number')
                    ->label('Nomor Terakhir')
                    ->badge()
                    ->color('success'),
                TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d M Y H:i'),
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
            'index' => ListNumberSequences::route('/'),
            'create' => CreateNumberSequence::route('/create'),
            'edit' => EditNumberSequence::route('/{record}/edit'),
        ];
    }
}
