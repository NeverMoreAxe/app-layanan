<?php

namespace App\Models;

use App\Enums\ServiceTypeHandler;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'category',
        'description',
        'handler',
        'needs_assessment',
        'sla_days',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'handler' => ServiceTypeHandler::class,
            'needs_assessment' => 'boolean',
            'is_active' => 'boolean',
            'sla_days' => 'integer',
        ];
    }

    public function requirements(): HasMany
    {
        return $this->hasMany(ServiceRequirement::class)->orderBy('sort_order');
    }

    public function serviceRequests(): HasMany
    {
        return $this->hasMany(ServiceRequest::class);
    }

    public function informationPages(): HasMany
    {
        return $this->hasMany(InformationPage::class);
    }
}
