<?php

namespace App\Filament\Resources\Complaints;

use App\Enums\ComplaintStatus;
use App\Enums\RehabilitationCaseStatus;
use App\Filament\Resources\Complaints\Pages\CreateComplaint;
use App\Filament\Resources\Complaints\Pages\EditComplaint;
use App\Filament\Resources\Complaints\Pages\ListComplaints;
use App\Filament\Resources\Complaints\Pages\ViewComplaint;
use App\Filament\Resources\Complaints\RelationManagers\AttachmentsRelationManager;
use App\Filament\Resources\ServiceRequests\RelationManagers\StatusHistoriesRelationManager;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\Complaint;
use App\Models\NumberSequence;
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

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMegaphone;

    protected static string|UnitEnum|null $navigationGroup = 'Pengaduan Masyarakat';

    protected static ?string $modelLabel = 'Pengaduan Sosial';

    protected static ?string $pluralModelLabel = 'Pengaduan Sosial';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Pelapor')
                    ->description('Data kontak dan nama masyarakat yang melapor')
                    ->schema([
                        TextInput::make('reporter_name')
                            ->label('Nama Lengkap Pelapor')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('reporter_phone')
                            ->label('Nomor WhatsApp / HP Pelapor')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                        Select::make('reporter_id')
                            ->label('Akun Pengguna Terdaftar (Bila Ada)')
                            ->relationship('reporter', 'name')
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(3),

                Section::make('Detail Permasalahan & Lokasi')
                    ->description('Rincian laporan dan lokasi kejadian permasalahan sosial')
                    ->schema([
                        Select::make('complaint_category_id')
                            ->label('Kategori Masalah Sosial')
                            ->relationship('complaintCategory', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('village_id')
                            ->label('Desa / Kelurahan Lokasi')
                            ->relationship('village', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('location_detail')
                            ->label('Detail Alamat / Patokan Lokasi')
                            ->placeholder('RT/RW, Dusun, dekat jembatan / pos kamling')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('Uraian Permasalahan Sosial')
                            ->placeholder('Jelaskan kondisi permasalahan selengkap mungkin...')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Penanganan & Tindak Lanjut Petugas')
                    ->description('Status penanganan, disposisi, dan hasil tindak lanjut')
                    ->schema([
                        TextInput::make('complaint_number')
                            ->label('Nomor Laporan')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Otomatis dibuat sistem (ADU-YYYYMM-NNNNN)'),
                        Select::make('status')
                            ->label('Status Laporan')
                            ->options(collect(ComplaintStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()]))
                            ->default(ComplaintStatus::Received->value)
                            ->required(),
                        Select::make('officer_id')
                            ->label('Petugas Penangan')
                            ->relationship('officer', 'name')
                            ->searchable()
                            ->preload(),
                        DateTimePicker::make('reported_at')
                            ->label('Waktu Laporan Diterima')
                            ->default(now()),
                        DateTimePicker::make('resolved_at')
                            ->label('Waktu Laporan Selesai Ditangani'),
                        Select::make('duplicate_of_id')
                            ->label('Laporan Induk (Jika Laporan Ini Duplikat)')
                            ->relationship('duplicateOf', 'complaint_number')
                            ->searchable(),
                        Textarea::make('verification_result')
                            ->label('Hasil Verifikasi Awal Lapangan')
                            ->columnSpanFull()
                            ->rows(2),
                        Textarea::make('action_taken')
                            ->label('Tindakan & Solusi yang Dilakukan')
                            ->helperText('Wajib diisi sebelum laporan dinyatakan Selesai Ditangani (Resolved)')
                            ->columnSpanFull()
                            ->rows(3),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('complaint_number')
                    ->label('No. Laporan')
                    ->badge()
                    ->color('primary')
                    ->copyable()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('complaintCategory.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->searchable(),
                TextColumn::make('reporter_name')
                    ->label('Pelapor')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('village.name')
                    ->label('Desa/Kel')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof ComplaintStatus ? $state->label() : (ComplaintStatus::tryFrom($state)?->label() ?? $state))
                    ->color(fn ($state) => $state instanceof ComplaintStatus ? $state->color() : (ComplaintStatus::tryFrom($state)?->color() ?? 'gray')),
                TextColumn::make('officer.name')
                    ->label('Petugas')
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make('reported_at')
                    ->label('Waktu Lapor')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Filter Status')
                    ->options(collect(ComplaintStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()])),
                SelectFilter::make('complaint_category_id')
                    ->label('Filter Kategori Masalah')
                    ->relationship('complaintCategory', 'name'),
                SelectFilter::make('village_id')
                    ->label('Filter Wilayah')
                    ->relationship('village', 'name')
                    ->searchable(),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('updateComplaintStatus')
                    ->label('Tindak Lanjut')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->form([
                        Select::make('new_status')
                            ->label('Status Baru Laporan')
                            ->options(collect(ComplaintStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()]))
                            ->required(),
                        Textarea::make('notes')
                            ->label('Catatan Perkembangan Penanganan')
                            ->required(),
                        Textarea::make('action_taken')
                            ->label('Tindakan & Hasil Penanganan (Wajib bila selesai)')
                            ->visible(fn ($get) => $get('new_status') === ComplaintStatus::Resolved->value),
                    ])
                    ->action(function (Complaint $record, array $data) {
                        $newStatus = ComplaintStatus::from($data['new_status']);
                        $updates = ['status' => $newStatus];

                        if ($newStatus === ComplaintStatus::Resolved) {
                            $updates['resolved_at'] = now();
                            if (! empty($data['action_taken'])) {
                                $updates['action_taken'] = $data['action_taken'];
                            }
                        }

                        $record->update($updates);
                        $record->recordStatusChange($newStatus->value, $data['notes']);

                        Notification::make()
                            ->title('Status Laporan Diperbarui')
                            ->body("Pengaduan {$record->complaint_number} kini berstatus {$newStatus->label()}")
                            ->success()
                            ->send();
                    }),
                Action::make('convertToRehab')
                    ->label('Jadikan Kasus Rehsos')
                    ->icon('heroicon-o-heart')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Buat Kasus Rehabilitasi Sosial')
                    ->modalDescription('Laporan pengaduan ini akan diteruskan menjadi kasus rehabilitasi sosial baru.')
                    ->action(function (Complaint $record) {
                        $clientCategory = ClientCategory::first() ?? ClientCategory::create(['name' => 'Pemerlu Pelayanan Sosial']);

                        $client = Client::create([
                            'name' => $record->reporter_name,
                            'client_category_id' => $clientCategory->id,
                            'village_id' => $record->village_id,
                            'phone' => $record->reporter_phone,
                            'address' => $record->location_detail,
                        ]);

                        $case = RehabilitationCase::create([
                            'case_number' => NumberSequence::nextNumber('RHS'),
                            'client_id' => $client->id,
                            'complaint_id' => $record->id,
                            'officer_id' => auth()->id() ?? $record->officer_id,
                            'handling_type' => 'direct',
                            'status' => RehabilitationCaseStatus::Received,
                            'received_at' => now(),
                        ]);

                        $case->recordStatusChange(RehabilitationCaseStatus::Received->value, "Kasus dibuat dari laporan pengaduan {$record->complaint_number}");

                        $record->recordStatusChange(
                            $record->status->value,
                            "Diteruskan menjadi Kasus Rehabilitasi Sosial No. {$case->case_number}"
                        );

                        Notification::make()
                            ->title('Kasus Rehsos Berhasil Dibuat')
                            ->body("Telah dibuat Kasus No. {$case->case_number}")
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
            ->defaultSort('reported_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            AttachmentsRelationManager::class,
            StatusHistoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListComplaints::route('/'),
            'create' => CreateComplaint::route('/create'),
            'view' => ViewComplaint::route('/{record}'),
            'edit' => EditComplaint::route('/{record}/edit'),
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
