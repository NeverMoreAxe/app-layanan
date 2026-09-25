<?php

namespace App\Filament\Resources\RehabilitationCases\RelationManagers;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MonitoringRecordsRelationManager extends RelationManager
{
    protected static string $relationship = 'monitoringRecords';

    protected static ?string $title = 'Catatan Monitoring & Perkembangan';

    protected static ?string $modelLabel = 'Monitoring';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('monitoring_date')
                    ->label('Tanggal Monitoring')
                    ->default(now())
                    ->required(),
                Select::make('officer_id')
                    ->label('Petugas Monitoring')
                    ->options(User::pluck('name', 'id'))
                    ->default(auth()->id())
                    ->required(),
                Select::make('referral_id')
                    ->label('Terkait Rujukan Tertentu (Opsional)')
                    ->relationship('referral', 'referral_number')
                    ->searchable()
                    ->preload(),
                Textarea::make('progress')
                    ->label('Perkembangan Kondisi Fisik & Psikis Klien')
                    ->required()
                    ->columnSpanFull()
                    ->rows(3),
                Textarea::make('result_notes')
                    ->label('Catatan & Hasil Evaluasi Petugas')
                    ->required()
                    ->columnSpanFull()
                    ->rows(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('progress')
            ->columns([
                TextColumn::make('monitoring_date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('officer.name')
                    ->label('Petugas')
                    ->searchable(),
                TextColumn::make('progress')
                    ->label('Perkembangan')
                    ->limit(60)
                    ->wrap(),
                TextColumn::make('referral.referralInstitution.name')
                    ->label('Lembaga Rujukan')
                    ->placeholder('Penanganan Langsung')
                    ->toggleable(),
            ])
            ->headerActions([
                CreateAction::make()->label('Catat Monitoring Baru'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('monitoring_date', 'desc');
    }
}
