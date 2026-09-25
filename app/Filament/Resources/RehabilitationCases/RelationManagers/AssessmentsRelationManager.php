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
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AssessmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'assessments';

    protected static ?string $title = 'Hasil Assessment Klien';

    protected static ?string $modelLabel = 'Assessment';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('assessment_date')
                    ->label('Tanggal Assessment')
                    ->default(now())
                    ->required(),
                Select::make('officer_id')
                    ->label('Petugas Assessor')
                    ->options(User::pluck('name', 'id'))
                    ->default(auth()->id())
                    ->required(),
                Toggle::make('needs_referral')
                    ->label('Rekomendasi Rujukan ke Lembaga Lain')
                    ->default(false)
                    ->helperText('Aktifkan bila klien memerlukan penanganan di Panti, Balai, RS, atau LKS'),
                Textarea::make('result')
                    ->label('Hasil Assessment Kondisi & Masalah Klien')
                    ->required()
                    ->columnSpanFull()
                    ->rows(3),
                Textarea::make('service_needs')
                    ->label('Kebutuhan Pelayanan yang Diperlukan')
                    ->required()
                    ->columnSpanFull()
                    ->rows(2),
                Textarea::make('recommendation')
                    ->label('Rekomendasi Penanganan Kasus')
                    ->required()
                    ->columnSpanFull()
                    ->rows(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('result')
            ->columns([
                TextColumn::make('assessment_date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('officer.name')
                    ->label('Petugas Assessor')
                    ->searchable(),
                TextColumn::make('result')
                    ->label('Hasil Assessment')
                    ->limit(60)
                    ->wrap(),
                TextColumn::make('service_needs')
                    ->label('Kebutuhan Layanan')
                    ->limit(40)
                    ->toggleable(),
                IconColumn::make('needs_referral')
                    ->label('Perlu Rujukan')
                    ->boolean(),
            ])
            ->headerActions([
                CreateAction::make()->label('Tambah Assessment Baru'),
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
