<?php

namespace App\Traits;

use App\Models\StatusHistory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;

trait HasStatusHistories
{
    /**
     * Get all status history records for this model.
     */
    public function statusHistories(): MorphMany
    {
        return $this->morphMany(StatusHistory::class, 'statusable')->latest();
    }

    /**
     * Record a status transition.
     */
    public function recordStatusChange(string $toStatus, ?string $notes = null, ?int $userId = null): StatusHistory
    {
        $fromStatus = $this->status instanceof \BackedEnum ? $this->status->value : (string) $this->status;

        return $this->statusHistories()->create([
            'from_status' => $fromStatus,
            'to_status' => $toStatus,
            'notes' => $notes,
            'user_id' => $userId ?? Auth::id(),
        ]);
    }
}
