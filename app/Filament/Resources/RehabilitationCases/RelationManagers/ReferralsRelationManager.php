<?php

namespace App\Filament\Resources\RehabilitationCases\RelationManagers;

use App\Enums\ReferralStatus;
use App\Models\NumberSequence;
use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReferralsRelationManager extends RelationManager
{
    protected static string $relationship = 'referrals';

    protected static ?string $title = 'Data Rujukan ke Lembaga Luar';

    protected static ?string $modelLabel = 'Rujukan';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('referral_number')
                    ->label('Nomor Rujukan')
                    ->disabled()
                    ->dehydrated(false)
                    ->placeholder('Otomatis: RJK-YYYYMM-NNNNN'),
                Select::make('referral_institution_id')
                    ->label('Lembaga Tujuan Rujukan')
                    ->relationship('referralInstitution', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('officer_id')
                    ->label('Petugas Pendamping')
                    ->options(User::pluck('name', 'id'))
                    ->default(auth()->id())
                    ->required(),
                DatePicker::make('referral_date')
                    ->label('Tanggal Rujukan')
                    ->default(now())
                    ->required(),
                Select::make('status')
                    ->label('Status Rujukan')
                    ->options(collect(ReferralStatus::cases())->mapWithKeys(fn ($case) => [$case->value => $case->label()]))
                    ->default(ReferralStatus::Draft->value)
                    ->required(),
                Textarea::make('service_result')
                    ->label('Hasil Pelayanan Lembaga Rujukan')
                    ->placeholder('Catat laporan perkembangan dari panti/balai/RS')
                    ->columnSpanFull()
                    ->rows(3),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('referral_number')
            ->columns([
                TextColumn::make('referral_number')
                    ->label('No. Rujukan')
                    ->badge()
                    ->color('primary')
                    ->searchable(),
                TextColumn::make('referralInstitution.name')
                    ->label('Lembaga Tujuan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('referral_date')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof ReferralStatus ? $state->label() : (ReferralStatus::tryFrom($state)?->label() ?? $state))
                    ->color(fn ($state) => $state instanceof ReferralStatus ? $state->color() : (ReferralStatus::tryFrom($state)?->color() ?? 'gray')),
                TextColumn::make('officer.name')
                    ->label('Petugas Pendamping')
                    ->toggleable(),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Buat Rujukan Baru')
                    ->mutateFormDataUsing(function (array $data): array {
                        if (empty($data['referral_number'])) {
                            $data['referral_number'] = NumberSequence::nextNumber('RJK');
                        }

                        return $data;
                    }),
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
