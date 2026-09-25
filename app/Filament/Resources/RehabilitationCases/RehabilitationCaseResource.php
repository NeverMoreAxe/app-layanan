<?php

namespace App\Filament\Resources\RehabilitationCases;

use App\Enums\HandlingType;
use App\Enums\RehabilitationCaseStatus;
use App\Filament\Resources\RehabilitationCases\Pages\CreateRehabilitationCase;
use App\Filament\Resources\RehabilitationCases\Pages\EditRehabilitationCase;
use App\Filament\Resources\RehabilitationCases\Pages\ListRehabilitationCases;
use App\Filament\Resources\RehabilitationCases\Pages\ViewRehabilitationCase;
use App\Filament\Resources\RehabilitationCases\RelationManagers\AssessmentsRelationManager;
use App\Filament\Resources\RehabilitationCases\RelationManagers\MonitoringRecordsRelationManager;
use App\Filament\Resources\RehabilitationCases\RelationManagers\ReferralsRelationManager;
use App\Filament\Resources\ServiceRequests\RelationManagers\StatusHistoriesRelationManager;
use App\Models\RehabilitationCase;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class RehabilitationCaseResource extends Resource
{
    protected static ?string $model = RehabilitationCase::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHeart;

    protected static string|UnitEnum|null $navigationGroup = 'Rehabilitasi Sosial';

    protected static ?string $modelLabel = 'Kasus Rehabilitasi Sosial';

    protected static ?string $pluralModelLabel = 'Kasus Rehabilitasi Sosial';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pokok Kasus')
                    ->description('Data nomor kasus, klien sasaran, dan alur penanganan')
                    ->schema([
                        TextInput::make('case_number')
                            ->label('Nomor Kasus')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Otomatis dibuat sistem (RHS-YYYYMM-NNNNN)'),
                        Select::make('client_id')
                            ->label('Klien Penerima Manfaat')
                            ->relationship('client', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('handling_type')
                            ->label('Model Penanganan')
                            ->options([
                                'direct' => 'Pelayanan Langsung oleh Dinsos',
                                'referral' => 'Rujukan ke Lembaga Luar (Panti/Balai/RS)',
                                'both' => 'Kombinasi (Langsung & Rujukan)',
                            ])
                            ->default('direct')
                            ->required(),
                        Select::make('status')
                            ->label('Status Kasus')
                            ->options(collect(RehabilitationCaseStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()]))
                            ->default(RehabilitationCaseStatus::Received->value)
                            ->required(),
                        Select::make('officer_id')
                            ->label('Petugas Pekerja Sosial / Penanggung Jawab')
                            ->relationship('officer', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        DateTimePicker::make('received_at')
                            ->label('Waktu Kasus Diterima')
                            ->default(now()),
                        DateTimePicker::make('closed_at')
                            ->label('Waktu Kasus Ditutup / Selesai'),
                    ])
                    ->columns(2),

                Section::make('Sumber Kasus (Opsional)')
                    ->description('Tautkan jika kasus berasal dari tiket pengajuan atau laporan pengaduan')
                    ->schema([
                        Select::make('service_request_id')
                            ->label('Berasal dari Pengajuan Layanan')
                            ->relationship('serviceRequest', 'request_number')
                            ->searchable()
                            ->preload(),
                        Select::make('complaint_id')
                            ->label('Berasal dari Pengaduan Masyarakat')
                            ->relationship('complaint', 'complaint_number')
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(2),

                Section::make('Hasil Akhir Penanganan Kasus')
                    ->schema([
                        Textarea::make('handling_result')
                            ->label('Laporan & Kesimpulan Akhir Penanganan')
                            ->helperText('Wajib diisi sebelum status kasus diubah menjadi Kasus Ditutup (Closed)')
                            ->columnSpanFull()
                            ->rows(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('case_number')
                    ->label('No. Kasus')
                    ->badge()
                    ->color('primary')
                    ->copyable()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('client.name')
                    ->label('Nama Klien')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('client.clientCategory.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->toggleable(),
                TextColumn::make('handling_type')
                    ->label('Penanganan')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state instanceof HandlingType ? $state->value : (string) $state) {
                        'direct' => 'Langsung',
                        'referral' => 'Rujukan',
                        'both' => 'Kombinasi',
                        default => $state,
                    })
                    ->color('gray'),
                TextColumn::make('status')
                    ->label('Status Kasus')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof RehabilitationCaseStatus ? $state->label() : (RehabilitationCaseStatus::tryFrom($state)?->label() ?? $state))
                    ->color(fn ($state) => $state instanceof RehabilitationCaseStatus ? $state->color() : (RehabilitationCaseStatus::tryFrom($state)?->color() ?? 'gray')),
                TextColumn::make('officer.name')
                    ->label('Pekerja Sosial')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('received_at')
                    ->label('Diterima')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options(collect(RehabilitationCaseStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()])),
                SelectFilter::make('client.client_category_id')
                    ->label('Filter Kategori Klien')
                    ->relationship('client.clientCategory', 'name'),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('updateCaseStatus')
                    ->label('Tindak Lanjut Kasus')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->form([
                        Select::make('new_status')
                            ->label('Status Baru Kasus')
                            ->options(collect(RehabilitationCaseStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()]))
                            ->required(),
                        Textarea::make('notes')
                            ->label('Catatan Perkembangan Kasus')
                            ->required(),
                        Textarea::make('handling_result')
                            ->label('Hasil Akhir Penanganan (Wajib bila menutup kasus)')
                            ->visible(fn ($get) => $get('new_status') === RehabilitationCaseStatus::Closed->value),
                    ])
                    ->action(function (RehabilitationCase $record, array $data) {
                        $newStatus = RehabilitationCaseStatus::from($data['new_status']);
                        $updates = ['status' => $newStatus];

                        if ($newStatus === RehabilitationCaseStatus::Closed) {
                            $updates['closed_at'] = now();
                            if (! empty($data['handling_result'])) {
                                $updates['handling_result'] = $data['handling_result'];
                            }
                        }

                        $record->update($updates);
                        $record->recordStatusChange($newStatus->value, $data['notes']);

                        Notification::make()
                            ->title('Status Kasus Diperbarui')
                            ->body("Kasus {$record->case_number} kini berstatus {$newStatus->label()}")
                            ->success()
                            ->send();
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('received_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            AssessmentsRelationManager::class,
            ReferralsRelationManager::class,
            MonitoringRecordsRelationManager::class,
            StatusHistoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRehabilitationCases::route('/'),
            'create' => CreateRehabilitationCase::route('/create'),
            'view' => ViewRehabilitationCase::route('/{record}'),
            'edit' => EditRehabilitationCase::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
