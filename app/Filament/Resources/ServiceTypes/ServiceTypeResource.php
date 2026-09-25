<?php

namespace App\Filament\Resources\ServiceTypes;

use App\Enums\ServiceTypeHandler;
use App\Filament\Resources\ServiceTypes\Pages\CreateServiceType;
use App\Filament\Resources\ServiceTypes\Pages\EditServiceType;
use App\Filament\Resources\ServiceTypes\Pages\ListServiceTypes;
use App\Models\ServiceType;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Repeater;
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

class ServiceTypeResource extends Resource
{
    protected static ?string $model = ServiceType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    protected static string|UnitEnum|null $navigationGroup = 'Data Master';

    protected static ?string $modelLabel = 'Jenis Layanan';

    protected static ?string $pluralModelLabel = 'Jenis Layanan';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label('Kode Layanan')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(50)
                    ->placeholder('Misal: DTSEN, PBI, REHSOS'),
                TextInput::make('name')
                    ->label('Nama Layanan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('category')
                    ->label('Kategori')
                    ->maxLength(100)
                    ->placeholder('Misal: Bantuan Sosial, Perlindungan Jaminan Sosial'),
                Select::make('handler')
                    ->label('Tipe Penangan (Handler)')
                    ->options([
                        'dtsen' => 'Surat Keterangan DTSEN',
                        'pbi' => 'Reaktivasi KIS / PBI-JK',
                        'generic' => 'Pengajuan Layanan Umum',
                    ])
                    ->default('generic')
                    ->required(),
                TextInput::make('sla_days')
                    ->label('SLA / Standar Waktu (Hari)')
                    ->numeric()
                    ->default(3)
                    ->minValue(1)
                    ->suffix('Hari Kerja'),
                Toggle::make('needs_assessment')
                    ->label('Memerlukan Assessment Petugas')
                    ->default(false),
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
                Textarea::make('description')
                    ->label('Deskripsi Layanan')
                    ->columnSpanFull()
                    ->rows(3),
                Repeater::make('requirements')
                    ->label('Persyaratan Dokumen')
                    ->relationship('requirements')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Dokumen Persyaratan')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('allowed_mimes')
                            ->label('Format Diizinkan')
                            ->default('pdf,jpg,jpeg,png')
                            ->required(),
                        Toggle::make('is_mandatory')
                            ->label('Wajib Diunggah')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(1),
                    ])
                    ->columns(4)
                    ->columnSpanFull()
                    ->defaultItems(0)
                    ->reorderable('sort_order'),
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
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama Layanan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('handler')
                    ->label('Handler')
                    ->badge()
                    ->color(fn (ServiceTypeHandler|string|null $state): string => match ($state instanceof ServiceTypeHandler ? $state->value : (string) $state) {
                        'dtsen' => 'success',
                        'pbi' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('sla_days')
                    ->label('SLA')
                    ->suffix(' hari')
                    ->sortable(),
                IconColumn::make('needs_assessment')
                    ->label('Assessment')
                    ->boolean(),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextColumn::make('requirements_count')
                    ->label('Syarat')
                    ->counts('requirements')
                    ->badge()
                    ->color('warning'),
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
            'index' => ListServiceTypes::route('/'),
            'create' => CreateServiceType::route('/create'),
            'edit' => EditServiceType::route('/{record}/edit'),
        ];
    }
}
