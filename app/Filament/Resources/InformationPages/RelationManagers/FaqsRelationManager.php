<?php

namespace App\Filament\Resources\InformationPages\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FaqsRelationManager extends RelationManager
{
    protected static string $relationship = 'faqs';

    protected static ?string $title = 'Tanya Jawab (FAQ)';

    protected static ?string $modelLabel = 'FAQ';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('sort_order')
                    ->label('Urutan Tampilan')
                    ->numeric()
                    ->default(1)
                    ->required(),
                Toggle::make('is_active')
                    ->label('Tampilkan ke Publik')
                    ->default(true),
                Textarea::make('question')
                    ->label('Pertanyaan yang Sering Diajukan')
                    ->required()
                    ->columnSpanFull()
                    ->rows(2),
                Textarea::make('answer')
                    ->label('Jawaban')
                    ->required()
                    ->columnSpanFull()
                    ->rows(3),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question')
            ->columns([
                TextColumn::make('sort_order')
                    ->label('No')
                    ->sortable(),
                TextColumn::make('question')
                    ->label('Pertanyaan')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('answer')
                    ->label('Jawaban')
                    ->limit(50),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->headerActions([
                CreateAction::make()->label('Tambah FAQ'),
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
            ->defaultSort('sort_order');
    }
}
