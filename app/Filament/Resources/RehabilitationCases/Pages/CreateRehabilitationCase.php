<?php

namespace App\Filament\Resources\RehabilitationCases\Pages;

use App\Enums\RehabilitationCaseStatus;
use App\Filament\Resources\RehabilitationCases\RehabilitationCaseResource;
use App\Models\NumberSequence;
use Filament\Resources\Pages\CreateRecord;

class CreateRehabilitationCase extends CreateRecord
{
    protected static string $resource = RehabilitationCaseResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['case_number'])) {
            $data['case_number'] = NumberSequence::nextNumber('RHS');
        }

        if (empty($data['received_at'])) {
            $data['received_at'] = now();
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->record;
        $status = $record->status instanceof RehabilitationCaseStatus ? $record->status->value : (string) $record->status;
        $record->recordStatusChange($status, 'Kasus rehabilitasi sosial baru dicatat ke dalam sistem.');
    }
}
