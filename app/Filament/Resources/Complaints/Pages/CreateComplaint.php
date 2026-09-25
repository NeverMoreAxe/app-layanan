<?php

namespace App\Filament\Resources\Complaints\Pages;

use App\Enums\ComplaintStatus;
use App\Filament\Resources\Complaints\ComplaintResource;
use App\Models\NumberSequence;
use Filament\Resources\Pages\CreateRecord;

class CreateComplaint extends CreateRecord
{
    protected static string $resource = ComplaintResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['complaint_number'])) {
            $data['complaint_number'] = NumberSequence::nextNumber('ADU');
        }

        if (empty($data['reported_at'])) {
            $data['reported_at'] = now();
        }

        if (empty($data['reporter_id']) && auth()->check()) {
            $data['reporter_id'] = auth()->id();
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->record;
        $status = $record->status instanceof ComplaintStatus ? $record->status->value : (string) $record->status;
        $record->recordStatusChange($status, 'Laporan pengaduan baru masuk ke sistem.');
    }
}
