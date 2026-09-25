<?php

namespace App\Filament\Resources\InformationPages\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DownloadableFormsRelationManager extends RelationManager
{
    protected static string $relationship = 'downloadableForms';

    protected static ?string $title = 'Formulir Unduhan Publik';

    protected static ?string $modelLabel = 'Formulir Unduhan';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Formulir Unduhan')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('file_path')
                    ->label('Berkas Formulir (PDF/Word/Excel)')
                    ->directory('downloadable_forms')
                    ->required()
                    ->openable()
                    ->downloadable(),
                TextInput::make('version')
                    ->label('Versi Dokumen')
                    ->default('1.0')
                    ->maxLength(50),
                Toggle::make('is_current')
                    ->label('Versi yang Sedang Berlaku')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Formulir')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('version')
                    ->label('Versi')
                    ->badge()
                    ->color('info'),
                IconColumn::make('is_current')
                    ->label('Berlaku')
                    ->boolean(),
                TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime('d M Y'),
            ])
            ->headerActions([
                CreateAction::make()->label('Tambah Formulir Unduhan'),
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
