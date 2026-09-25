<?php

namespace App\Filament\Resources\ServiceRequests\Pages;

use App\Enums\ServiceRequestStatus;
use App\Filament\Resources\ServiceRequests\ServiceRequestResource;
use App\Models\NumberSequence;
use App\Models\ServiceType;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceRequest extends CreateRecord
{
    protected static string $resource = ServiceRequestResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['request_number'])) {
            $serviceType = ServiceType::find($data['service_type_id']);
            $prefix = $serviceType?->code ?? 'REQ';
            $data['request_number'] = NumberSequence::nextNumber($prefix);
        }

        if (empty($data['submitted_at'])) {
            $data['submitted_at'] = now();
        }

        if (empty($data['submitter_id']) && auth()->check()) {
            $data['submitter_id'] = auth()->id();
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->record;
        $status = $record->status instanceof ServiceRequestStatus ? $record->status->value : (string) $record->status;
        $record->recordStatusChange($status, 'Pengajuan layanan baru dibuat melalui sistem.');
    }
}
