<?php

namespace App\Enums;

enum ServiceTypeHandler: string
{
    case Generic = 'generic';
    case Dtsen = 'dtsen';
    case Pbi = 'pbi';

    public function label(): string
    {
        return match ($this) {
            self::Generic => 'Pengajuan Umum',
            self::Dtsen => 'Surat Keterangan DTSEN',
            self::Pbi => 'Reaktivasi KIS/PBI-JK',
        };
    }
}
