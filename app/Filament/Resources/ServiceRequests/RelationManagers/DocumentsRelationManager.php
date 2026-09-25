<?php

namespace App\Filament\Resources\ServiceRequests\RelationManagers;

use App\Enums\DocumentVerificationStatus;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    protected static ?string $title = 'Dokumen Persyaratan';

    protected static ?string $modelLabel = 'Dokumen Persyaratan';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('service_requirement_id')
                    ->label('Jenis Persyaratan')
                    ->relationship('serviceRequirement', 'name')
                    ->required(),
                FileUpload::make('file_path')
                    ->label('Berkas Dokumen')
                    ->directory('service_documents')
                    ->required()
                    ->openable()
                    ->downloadable(),
                TextInput::make('original_name')
                    ->label('Nama Berkas Asli')
                    ->maxLength(255),
                Select::make('verification_status')
                    ->label('Status Verifikasi Berkas')
                    ->options([
                        'pending' => 'Menunggu Verifikasi',
                        'valid' => 'Valid & Lengkap',
                        'revision_needed' => 'Perlu Perbaikan / Revisi',
                    ])
                    ->default('pending')
                    ->required(),
                Textarea::make('notes')
                    ->label('Catatan Pemeriksaan')
                    ->placeholder('Alasan perbaikan bila dokumen buram/tidak sesuai')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('original_name')
            ->columns([
                TextColumn::make('serviceRequirement.name')
                    ->label('Persyaratan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('original_name')
                    ->label('Nama Berkas')
                    ->searchable()
                    ->url(fn ($record) => $record->file_path ? asset('storage/'.$record->file_path) : null, shouldOpenInNewTab: true),
                TextColumn::make('verification_status')
                    ->label('Status Berkas')
                    ->badge()
                    ->color(fn (DocumentVerificationStatus|string|null $state): string => match ($state instanceof DocumentVerificationStatus ? $state->value : (string) $state) {
                        'valid' => 'success',
                        'revision_needed' => 'danger',
                        default => 'warning',
                    })
                    ->formatStateUsing(fn (DocumentVerificationStatus|string|null $state): string => match ($state instanceof DocumentVerificationStatus ? $state->value : (string) $state) {
                        'valid' => 'Valid',
                        'revision_needed' => 'Perlu Revisi',
                        default => 'Menunggu',
                    }),
                TextColumn::make('notes')
                    ->label('Catatan')
                    ->limit(40),
            ])
            ->headerActions([
                CreateAction::make()->label('Unggah Berkas Baru'),
            ])
            ->recordActions([
                Action::make('verifyValid')
                    ->label('Tandai Valid')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['verification_status' => 'valid']);
                    }),
                Action::make('requestRevision')
                    ->label('Minta Revisi')
                    ->icon('heroicon-o-arrow-path')
                    ->color('danger')
                    ->form([
                        Textarea::make('notes')
                            ->label('Alasan Perbaikan')
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'verification_status' => 'revision_needed',
                            'notes' => $data['notes'],
                        ]);
                    }),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
