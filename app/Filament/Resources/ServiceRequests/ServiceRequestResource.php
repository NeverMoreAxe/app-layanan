<?php

namespace App\Filament\Resources\ServiceRequests;

use App\Enums\MinistryDecision;
use App\Enums\PbiReason;
use App\Enums\ServiceRequestStatus;
use App\Filament\Resources\ServiceRequests\Pages\CreateServiceRequest;
use App\Filament\Resources\ServiceRequests\Pages\EditServiceRequest;
use App\Filament\Resources\ServiceRequests\Pages\ListServiceRequests;
use App\Filament\Resources\ServiceRequests\Pages\ViewServiceRequest;
use App\Filament\Resources\ServiceRequests\RelationManagers\DocumentsRelationManager;
use App\Filament\Resources\ServiceRequests\RelationManagers\StatusHistoriesRelationManager;
use App\Models\DtsenPurpose;
use App\Models\ServiceRequest;
use App\Models\ServiceType;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class ServiceRequestResource extends Resource
{
    protected static ?string $model = ServiceRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInboxStack;

    protected static string|UnitEnum|null $navigationGroup = 'Layanan Sosial';

    protected static ?string $modelLabel = 'Pengajuan Layanan';

    protected static ?string $pluralModelLabel = 'Pengajuan Layanan';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Layanan & Tiket')
                    ->description('Data dasar jenis layanan dan status tiket')
                    ->schema([
                        TextInput::make('request_number')
                            ->label('Nomor Tiket')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Otomatis dibuat oleh sistem'),
                        Select::make('service_type_id')
                            ->label('Jenis Layanan')
                            ->relationship('serviceType', 'name')
                            ->required()
                            ->live()
                            ->searchable()
                            ->preload(),
                        Select::make('status')
                            ->label('Status Pengajuan')
                            ->options(collect(ServiceRequestStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()]))
                            ->default(ServiceRequestStatus::Submitted->value)
                            ->required(),
                        Toggle::make('is_priority')
                            ->label('Tandai Prioritas / Darurat Medis')
                            ->default(false)
                            ->helperText('Pengajuan prioritas akan diposisikan paling atas pada antrean kerja'),
                        Select::make('officer_id')
                            ->label('Petugas Penanggung Jawab')
                            ->relationship('officer', 'name')
                            ->searchable()
                            ->preload(),
                        Select::make('work_unit_id')
                            ->label('Unit Kerja / Bidang')
                            ->relationship('workUnit', 'name')
                            ->searchable()
                            ->preload(),
                        DateTimePicker::make('submitted_at')
                            ->label('Waktu Diajukan')
                            ->default(now()),
                    ])
                    ->columns(2),

                Section::make('Data Pemohon')
                    ->description('Identitas warga pemohon layanan')
                    ->schema([
                        TextInput::make('applicant_name')
                            ->label('Nama Lengkap Pemohon')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('applicant_nik')
                            ->label('NIK Pemohon')
                            ->required()
                            ->length(16)
                            ->numeric(),
                        TextInput::make('family_card_number')
                            ->label('Nomor Kartu Keluarga (KK)')
                            ->required()
                            ->length(16)
                            ->numeric(),
                        TextInput::make('phone')
                            ->label('Nomor WhatsApp / HP Aktif')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                        Select::make('village_id')
                            ->label('Desa / Kelurahan Domisili')
                            ->relationship('village', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Textarea::make('address')
                            ->label('Alamat Lengkap (RT/RW, Dusun/Jalan)')
                            ->required()
                            ->columnSpanFull()
                            ->rows(2),
                    ])
                    ->columns(2),

                Section::make('Detail Khusus Surat Keterangan DTSEN')
                    ->description('Data tambahan penerbitan SK DTSEN')
                    ->relationship('dtsenCertificate')
                    ->visible(function ($get, ?ServiceRequest $record) {
                        $serviceTypeId = $get('service_type_id');
                        $serviceType = $serviceTypeId ? ServiceType::find($serviceTypeId) : null;

                        return ($serviceType && ($serviceType->code === 'DTSEN' || $serviceType->handler?->value === 'dtsen')) || ($record && $record->dtsenCertificate()->exists());
                    })
                    ->schema([
                        Select::make('dtsen_purpose_id')
                            ->label('Tujuan Penggunaan SK')
                            ->relationship('dtsenPurpose', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        TextInput::make('purpose_description')
                            ->label('Keterangan Tujuan Tambahan')
                            ->placeholder('Nama universitas, sekolah, instansi tujuan')
                            ->maxLength(255),
                        TextInput::make('subject_name')
                            ->label('Nama Orang yang Diterangkan')
                            ->placeholder('Nama anak / anggota keluarga')
                            ->required(),
                        TextInput::make('subject_nik')
                            ->label('NIK Orang yang Diterangkan')
                            ->length(16)
                            ->numeric()
                            ->required(),
                        TextInput::make('relationship_to_applicant')
                            ->label('Hubungan dengan Pemohon')
                            ->placeholder('Misal: Anak Kandung, Suami, Istri')
                            ->required(),
                        Toggle::make('is_registered')
                            ->label('Terdaftar di SIKS-NG')
                            ->default(false),
                        TextInput::make('decile')
                            ->label('Peringkat Desil Hasil Cek')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(10)
                            ->helperText('Diisi setelah petugas mengecek ke sistem SIKS-NG Kemensos'),
                        DateTimePicker::make('checked_at')
                            ->label('Waktu Cek SIKS-NG'),
                        TextInput::make('certificate_number')
                            ->label('Nomor Surat Keterangan')
                            ->placeholder('Diterbitkan saat disetujui'),
                        DatePicker::make('valid_until')
                            ->label('Masa Berlaku Surat'),
                    ])
                    ->columns(2),

                Section::make('Detail Khusus Reaktivasi KIS / PBI-JK')
                    ->description('Data peserta dan verifikasi pengaktifan kembali BPJS PBI')
                    ->relationship('pbiReactivation')
                    ->visible(function ($get, ?ServiceRequest $record) {
                        $serviceTypeId = $get('service_type_id');
                        $serviceType = $serviceTypeId ? ServiceType::find($serviceTypeId) : null;

                        return ($serviceType && ($serviceType->code === 'PBI' || $serviceType->handler?->value === 'pbi')) || ($record && $record->pbiReactivation()->exists());
                    })
                    ->schema([
                        TextInput::make('participant_name')
                            ->label('Nama Peserta BPJS/KIS')
                            ->required(),
                        TextInput::make('participant_nik')
                            ->label('NIK Peserta')
                            ->length(16)
                            ->numeric()
                            ->required(),
                        TextInput::make('bpjs_card_number')
                            ->label('Nomor Kartu BPJS / KIS')
                            ->required(),
                        DatePicker::make('deactivated_date')
                            ->label('Perkiraan Tanggal Nonaktif'),
                        Select::make('reason')
                            ->label('Alasan Permohonan Reaktivasi')
                            ->options(collect(PbiReason::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()]))
                            ->required(),
                        TextInput::make('health_facility_name')
                            ->label('Nama Fasilitas Kesehatan (Faskes)')
                            ->placeholder('RSUD Ngudi Waluyo, Puskesmas, dll.'),
                        TextInput::make('health_letter_number')
                            ->label('Nomor Surat Keterangan Medis'),
                        TextInput::make('decile')
                            ->label('Desil SIKS-NG')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(10),
                        TextInput::make('recommendation_number')
                            ->label('Nomor Rekomendasi Dinsos'),
                        DateTimePicker::make('proposed_to_ministry_at')
                            ->label('Tanggal Usul ke Kemensos'),
                        Select::make('ministry_decision')
                            ->label('Keputusan Kemensos')
                            ->options(collect(MinistryDecision::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()])),
                        DatePicker::make('reactivated_date')
                            ->label('Tanggal Aktif Kembali di BPJS'),
                        Textarea::make('eligibility_notes')
                            ->label('Catatan Verifikasi Kelayakan')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Hasil Pelayanan & Catatan Petugas')
                    ->schema([
                        Textarea::make('verification_result')
                            ->label('Hasil Verifikasi Dokumen & Data')
                            ->rows(2),
                        Textarea::make('officer_notes')
                            ->label('Catatan Petugas Pelayanan')
                            ->rows(2),
                        Textarea::make('service_result')
                            ->label('Hasil Akhir Pelayanan')
                            ->helperText('Wajib diisi sebelum tiket dinyatakan Selesai (Completed)')
                            ->rows(2),
                        Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan (Bila Ditolak)')
                            ->rows(2),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('request_number')
                    ->label('No. Tiket')
                    ->badge()
                    ->color('primary')
                    ->copyable()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('serviceType.name')
                    ->label('Layanan')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('applicant_name')
                    ->label('Pemohon')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('applicant_nik')
                    ->label('NIK')
                    ->copyable()
                    ->toggleable(),
                TextColumn::make('village.name')
                    ->label('Desa/Kel')
                    ->searchable()
                    ->toggleable(),
                IconColumn::make('is_priority')
                    ->label('Prioritas')
                    ->boolean()
                    ->trueIcon('heroicon-o-fire')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('danger')
                    ->falseColor('gray'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof ServiceRequestStatus ? $state->label() : (ServiceRequestStatus::tryFrom($state)?->label() ?? $state))
                    ->color(fn ($state) => $state instanceof ServiceRequestStatus ? $state->color() : (ServiceRequestStatus::tryFrom($state)?->color() ?? 'gray')),
                TextColumn::make('officer.name')
                    ->label('Petugas')
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make('submitted_at')
                    ->label('Diajukan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options(collect(ServiceRequestStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()])),
                SelectFilter::make('service_type_id')
                    ->label('Filter Jenis Layanan')
                    ->relationship('serviceType', 'name'),
                SelectFilter::make('village_id')
                    ->label('Filter Wilayah Desa')
                    ->relationship('village', 'name')
                    ->searchable(),
                Filter::make('is_priority')
                    ->label('Hanya Prioritas / Darurat')
                    ->query(fn (Builder $query): Builder => $query->where('is_priority', true)),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('updateStatus')
                    ->label('Tindak Lanjut')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->form([
                        Select::make('new_status')
                            ->label('Pilih Status Baru')
                            ->options(collect(ServiceRequestStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()]))
                            ->required(),
                        Textarea::make('notes')
                            ->label('Catatan Perubahan Status')
                            ->placeholder('Jelaskan tahapan yang dilakukan atau alasan perubahan')
                            ->required(),
                    ])
                    ->action(function (ServiceRequest $record, array $data) {
                        $oldStatus = $record->status;
                        $newStatus = ServiceRequestStatus::from($data['new_status']);

                        $record->update(['status' => $newStatus]);
                        $record->recordStatusChange($newStatus->value, $data['notes']);

                        Notification::make()
                            ->title('Status Berhasil Diperbarui')
                            ->body("Tiket {$record->request_number} kini berstatus {$newStatus->label()}")
                            ->success()
                            ->send();
                    }),
                Action::make('checkSiksng')
                    ->label('Cek SIKS-NG')
                    ->icon('heroicon-o-check-badge')
                    ->color('info')
                    ->visible(fn (ServiceRequest $record) => $record->serviceType?->code === 'DTSEN' || $record->serviceType?->handler?->value === 'dtsen')
                    ->form([
                        Toggle::make('is_registered')
                            ->label('Terdaftar di SIKS-NG')
                            ->default(true)
                            ->required(),
                        TextInput::make('decile')
                            ->label('Peringkat Desil')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(10)
                            ->required(),
                        Textarea::make('notes')
                            ->label('Catatan Pengecekan SIKS-NG')
                            ->placeholder('Hasil cek sistem SIKS-NG Kementerian Sosial'),
                    ])
                    ->action(function (ServiceRequest $record, array $data) {
                        $cert = $record->dtsenCertificate ?? $record->dtsenCertificate()->create([
                            'subject_name' => $record->applicant_name,
                            'subject_nik' => $record->applicant_nik,
                            'relationship_to_applicant' => 'Diri Sendiri',
                            'dtsen_purpose_id' => DtsenPurpose::first()?->id ?? 1,
                        ]);

                        $cert->update([
                            'is_registered' => $data['is_registered'],
                            'decile' => $data['decile'],
                            'checked_at' => now(),
                            'checker_id' => auth()->id(),
                        ]);

                        $record->update([
                            'status' => ServiceRequestStatus::DataVerification,
                            'verification_result' => $data['notes'] ?? 'Pengecekan SIKS-NG selesai.',
                        ]);

                        $record->recordStatusChange(
                            ServiceRequestStatus::DataVerification->value,
                            'SIKS-NG: '.($data['is_registered'] ? 'Terdaftar' : 'Tidak Terdaftar').", Desil {$data['decile']}"
                        );

                        Notification::make()
                            ->title('Hasil SIKS-NG Berhasil Dicatat')
                            ->body("Desil {$data['decile']} dicatat untuk tiket {$record->request_number}")
                            ->success()
                            ->send();
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('is_priority', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            DocumentsRelationManager::class,
            StatusHistoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceRequests::route('/'),
            'create' => CreateServiceRequest::route('/create'),
            'view' => ViewServiceRequest::route('/{record}'),
            'edit' => EditServiceRequest::route('/{record}/edit'),
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
