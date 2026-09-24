<?php

namespace App\Traits;

use App\Models\Approval;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasApprovals
{
    /**
     * Get all approval records for this model.
     */
    public function approvals(): MorphMany
    {
        return $this->morphMany(Approval::class, 'approvable')->orderBy('step');
    }
}
