<?php

namespace App\Filament\Resources\InformationPages;

use App\Filament\Resources\InformationPages\Pages\CreateInformationPage;
use App\Filament\Resources\InformationPages\Pages\EditInformationPage;
use App\Filament\Resources\InformationPages\Pages\ListInformationPages;
use App\Filament\Resources\InformationPages\Pages\ViewInformationPage;
use App\Filament\Resources\InformationPages\RelationManagers\DownloadableFormsRelationManager;
use App\Filament\Resources\InformationPages\RelationManagers\FaqsRelationManager;
use App\Models\InformationPage;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;

class InformationPageResource extends Resource
{
    protected static ?string $model = InformationPage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInformationCircle;

    protected static string|UnitEnum|null $navigationGroup = 'Portal Informasi';

    protected static ?string $modelLabel = 'Halaman Informasi';

    protected static ?string $pluralModelLabel = 'Halaman Informasi';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pokok & Publikasi')
                    ->description('Judul, kategori informasi, dan status publikasi di portal warga')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Halaman Informasi')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Select::make('category')
                            ->label('Kategori Konten')
                            ->options([
                                'program' => 'Program Bantuan Sosial',
                                'rehabilitation' => 'Rehabilitasi Sosial',
                                'disability' => 'Layanan Disabilitas',
                                'elderly' => 'Layanan Lanjut Usia',
                                'complaint' => 'Informasi Pengaduan',
                                'other' => 'Layanan Lainnya',
                            ])
                            ->default('program')
                            ->required(),
                        Select::make('service_type_id')
                            ->label('Terkait Jenis Layanan Tertentu')
                            ->relationship('serviceType', 'name')
                            ->searchable()
                            ->preload(),
                        Select::make('publish_status')
                            ->label('Status Publikasi')
                            ->options([
                                'draft' => 'Konsep (Draft)',
                                'published' => 'Tayang / Diterbitkan (Published)',
                                'archived' => 'Arsip (Archived)',
                            ])
                            ->default('published')
                            ->required(),
                        DateTimePicker::make('published_at')
                            ->label('Waktu Publikasi')
                            ->default(now()),
                        Select::make('manager_id')
                            ->label('Petugas Pengelola Konten')
                            ->relationship('manager', 'name')
                            ->default(auth()->id())
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(2),

                Section::make('Konten Panduan Layanan')
                    ->description('Informasi lengkap persyaratan dan tahapan pelayanan untuk masyarakat')
                    ->schema([
                        Textarea::make('description')
                            ->label('Ringkasan / Gambaran Umum Layanan')
                            ->rows(3)
                            ->columnSpanFull()
                            ->required(),
                        Textarea::make('requirements')
                            ->label('Daftar Persyaratan Berkas')
                            ->rows(4)
                            ->columnSpanFull()
                            ->placeholder('1. KTP elektronik asli/fotokopi&#10;2. Kartu Keluarga (KK)...'),
                        Textarea::make('procedure')
                            ->label('Alur / Prosedur Pelayanan')
                            ->rows(4)
                            ->columnSpanFull()
                            ->placeholder('Tahap 1: Mengajukan secara online melalui portal SAPA SOSIAL...'),
                    ]),

                Section::make('Lokasi, Jadwal & Kontak Layanan')
                    ->schema([
                        TextInput::make('service_hours')
                            ->label('Jam / Waktu Pelayanan')
                            ->placeholder('Senin - Kamis: 07.30 - 15.30 WIB, Jumat: 07.30 - 14.30 WIB')
                            ->columnSpanFull(),
                        TextInput::make('location')
                            ->label('Lokasi Kantor / Loket Pelayanan')
                            ->placeholder('Kantor Dinas Sosial Kab. Blitar, Jl. Raya Kanigoro')
                            ->columnSpanFull(),
                        TextInput::make('contact')
                            ->label('Kontak Informasi / WhatsApp')
                            ->placeholder('0812-xxxx-xxxx / (0342) xxxxxx')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Informasi')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'program' => 'Program Bansos',
                        'rehabilitation' => 'Rehsos',
                        'disability' => 'Disabilitas',
                        'elderly' => 'Lansia',
                        'complaint' => 'Pengaduan',
                        default => 'Lainnya',
                    }),
                TextColumn::make('serviceType.name')
                    ->label('Layanan Terkait')
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make('publish_status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'published' => 'Tayang',
                        'draft' => 'Konsep',
                        'archived' => 'Arsip',
                        default => $state,
                    })
                    ->color(fn ($state) => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        'archived' => 'gray',
                        default => 'primary',
                    }),
                TextColumn::make('downloadable_forms_count')
                    ->label('Formulir')
                    ->counts('downloadableForms')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('faqs_count')
                    ->label('FAQ')
                    ->counts('faqs')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('manager.name')
                    ->label('Pengelola')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('published_at')
                    ->label('Tanggal Tayang')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('publish_status')
                    ->label('Filter Status')
                    ->options([
                        'published' => 'Tayang (Published)',
                        'draft' => 'Konsep (Draft)',
                        'archived' => 'Arsip (Archived)',
                    ]),
                SelectFilter::make('category')
                    ->label('Filter Kategori')
                    ->options([
                        'program' => 'Program Bantuan Sosial',
                        'rehabilitation' => 'Rehabilitasi Sosial',
                        'disability' => 'Layanan Disabilitas',
                        'elderly' => 'Layanan Lanjut Usia',
                        'complaint' => 'Informasi Pengaduan',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            DownloadableFormsRelationManager::class,
            FaqsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInformationPages::route('/'),
            'create' => CreateInformationPage::route('/create'),
            'view' => ViewInformationPage::route('/{record}'),
            'edit' => EditInformationPage::route('/{record}/edit'),
        ];
    }
}
