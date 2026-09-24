<?php

namespace App\Traits;

use App\Models\Disposition;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasDispositions
{
    /**
     * Get all disposition records for this model.
     */
    public function dispositions(): MorphMany
    {
        return $this->morphMany(Disposition::class, 'dispositionable')->latest('disposed_at');
    }
}
