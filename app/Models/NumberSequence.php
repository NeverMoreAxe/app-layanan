<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NumberSequence extends Model
{
    use HasFactory;

    protected $fillable = [
        'prefix',
        'period',
        'last_number',
    ];

    protected function casts(): array
    {
        return [
            'last_number' => 'integer',
        ];
    }

    /**
     * Generate the next formatted ticket/case number atomically using row-level locking.
     * Format: PREFIX-YYYYMM-NNNNN
     */
    public static function nextNumber(string $prefix, ?Carbon $date = null, int $digits = 5): string
    {
        $period = ($date ?? now())->format('Ym');

        return DB::transaction(function () use ($prefix, $period, $digits) {
            $sequence = static::where('prefix', $prefix)
                ->where('period', $period)
                ->lockForUpdate()
                ->first();

            if (! $sequence) {
                $sequence = static::create([
                    'prefix' => $prefix,
                    'period' => $period,
                    'last_number' => 0,
                ]);

                // Re-lock the newly created row
                $sequence = static::where('id', $sequence->id)->lockForUpdate()->first();
            }

            $sequence->increment('last_number');
            $sequence->refresh();

            return sprintf('%s-%s-%0' . $digits . 'd', $prefix, $period, $sequence->last_number);
        });
    }
}
