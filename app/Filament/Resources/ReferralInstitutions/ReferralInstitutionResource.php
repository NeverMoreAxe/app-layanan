<?php

namespace App\Filament\Resources\ReferralInstitutions;

use App\Filament\Resources\ReferralInstitutions\Pages\CreateReferralInstitution;
use App\Filament\Resources\ReferralInstitutions\Pages\EditReferralInstitution;
use App\Filament\Resources\ReferralInstitutions\Pages\ListReferralInstitutions;
use App\Models\ReferralInstitution;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class ReferralInstitutionResource extends Resource
{
    protected static ?string $model = ReferralInstitution::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;

    protected static string|UnitEnum|null $navigationGroup = 'Data Master';

    protected static ?string $modelLabel = 'Lembaga Rujukan';

    protected static ?string $pluralModelLabel = 'Lembaga Rujukan';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lembaga Rujukan')
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->label('Tipe / Jenis Lembaga')
                    ->options([
                        'panti' => 'Panti Sosial',
                        'balai' => 'Balai Rehabilitasi',
                        'RS' => 'Rumah Sakit / RSJ',
                        'LKS' => 'Lembaga Kesejahteraan Sosial (LKS)',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required(),
                TextInput::make('contact')
                    ->label('Kontak / Telepon')
                    ->maxLength(100),
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
                Textarea::make('address')
                    ->label('Alamat Lembaga')
                    ->columnSpanFull()
                    ->rows(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Lembaga')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Jenis')
                    ->badge()
                    ->color('info')
                    ->searchable(),
                TextColumn::make('contact')
                    ->label('Kontak')
                    ->searchable(),
                TextColumn::make('referrals_count')
                    ->label('Jumlah Rujukan')
                    ->counts('referrals')
                    ->badge()
                    ->color('gray'),
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
            'index' => ListReferralInstitutions::route('/'),
            'create' => CreateReferralInstitution::route('/create'),
            'edit' => EditReferralInstitution::route('/{record}/edit'),
        ];
    }
}
