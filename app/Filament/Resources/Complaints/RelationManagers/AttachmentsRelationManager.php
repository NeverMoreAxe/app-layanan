<?php

namespace App\Filament\Resources\Complaints\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AttachmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'attachments';

    protected static ?string $title = 'Lampiran & Foto Bukti Pengaduan';

    protected static ?string $modelLabel = 'Lampiran';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('file_path')
                    ->label('File Foto / Dokumen')
                    ->directory('complaint_attachments')
                    ->image()
                    ->required()
                    ->openable()
                    ->downloadable(),
                Select::make('type')
                    ->label('Jenis Lampiran')
                    ->options([
                        'photo' => 'Foto Dokumentasi Kejadian',
                        'document' => 'Dokumen Pendukung',
                    ])
                    ->default('photo')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('file_path')
            ->columns([
                ImageColumn::make('file_path')
                    ->label('Foto Bukti')
                    ->square(),
                TextColumn::make('type')
                    ->label('Jenis Lampiran')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state === 'photo' ? 'Foto Lapangan' : 'Dokumen')
                    ->color(fn ($state) => $state === 'photo' ? 'info' : 'gray'),
                TextColumn::make('created_at')
                    ->label('Diunggah')
                    ->dateTime('d M Y H:i'),
            ])
            ->headerActions([
                CreateAction::make()->label('Unggah Foto/Lampiran'),
            ])
            ->recordActions([
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
