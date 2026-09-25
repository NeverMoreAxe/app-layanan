<?php

namespace App\Filament\Resources\ServiceRequests\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StatusHistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'statusHistories';

    protected static ?string $title = 'Riwayat Perubahan Status (Audit)';

    protected static ?string $modelLabel = 'Riwayat Status';

    public function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y H:i:s')
                    ->sortable(),
                TextColumn::make('from_status')
                    ->label('Status Awal')
                    ->badge()
                    ->color('gray')
                    ->placeholder('Awal Diajukan'),
                TextColumn::make('to_status')
                    ->label('Status Baru')
                    ->badge()
                    ->color('primary'),
                TextColumn::make('user.name')
                    ->label('Petugas / Aktor')
                    ->placeholder('Sistem / Otomatis'),
                TextColumn::make('notes')
                    ->label('Catatan Transisi')
                    ->wrap(),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
