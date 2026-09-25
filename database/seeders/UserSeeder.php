<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\User;
use App\Models\Village;
use App\Models\WorkUnit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $linjamsos = WorkUnit::where('name', 'like', '%Linjamsos%')->first();
        $rehsos = WorkUnit::where('name', 'like', '%Rehabilitasi Sosial%')->first();
        $dayasos = WorkUnit::where('name', 'like', '%Dayasos%')->first();
        $sekretariat = WorkUnit::where('name', 'like', '%Sekretariat%')->first();

        $kanigoro = District::where('name', 'Kanigoro')->first();
        $minggirsari = Village::where('name', 'Minggirsari')->first();

        $users = [
            [
                'name' => 'Administrator Dinas Sosial',
                'email' => 'admin@sapasosial.blitarkab.go.id',
                'password' => Hash::make('password'),
                'phone' => '081234567890',
                'nik' => '3505111001800001',
                'work_unit_id' => $sekretariat?->id,
                'is_active' => true,
            ],
            [
                'name' => 'Kepala Dinas Sosial',
                'email' => 'kadis@sapasosial.blitarkab.go.id',
                'password' => Hash::make('password'),
                'phone' => '081234567891',
                'nik' => '3505111001700002',
                'work_unit_id' => $sekretariat?->id,
                'is_active' => true,
            ],
            [
                'name' => 'Kepala Bidang Dayasos (Penandatangan SK DTSEN)',
                'email' => 'kabid.dayasos@sapasosial.blitarkab.go.id',
                'password' => Hash::make('password'),
                'phone' => '081234567892',
                'nik' => '3505111001750003',
                'work_unit_id' => $dayasos?->id,
                'is_active' => true,
            ],
            [
                'name' => 'Kepala Bidang Linjamsos (Penandatangan Rekomendasi PBI)',
                'email' => 'kabid.linjamsos@sapasosial.blitarkab.go.id',
                'password' => Hash::make('password'),
                'phone' => '081234567893',
                'nik' => '3505111001770004',
                'work_unit_id' => $linjamsos?->id,
                'is_active' => true,
            ],
            [
                'name' => 'Petugas Verifikator Pelayanan (DTSEN & PBI)',
                'email' => 'petugas.layanan@sapasosial.blitarkab.go.id',
                'password' => Hash::make('password'),
                'phone' => '081234567894',
                'nik' => '3505111001900005',
                'work_unit_id' => $dayasos?->id,
                'is_active' => true,
            ],
            [
                'name' => 'Petugas Pelayanan Rehabilitasi Sosial',
                'email' => 'petugas.rehsos@sapasosial.blitarkab.go.id',
                'password' => Hash::make('password'),
                'phone' => '081234567895',
                'nik' => '3505111001920006',
                'work_unit_id' => $rehsos?->id,
                'is_active' => true,
            ],
            [
                'name' => 'Operator Kecamatan Kanigoro',
                'email' => 'operator.kanigoro@sapasosial.blitarkab.go.id',
                'password' => Hash::make('password'),
                'phone' => '081234567896',
                'nik' => '3505111001930007',
                'district_id' => $kanigoro?->id,
                'is_active' => true,
            ],
            [
                'name' => 'Operator Desa Minggirsari',
                'email' => 'operator.minggirsari@sapasosial.blitarkab.go.id',
                'password' => Hash::make('password'),
                'phone' => '081234567897',
                'nik' => '3505111001940008',
                'district_id' => $kanigoro?->id,
                'village_id' => $minggirsari?->id,
                'is_active' => true,
            ],
            [
                'name' => 'Budi Santoso (Masyarakat)',
                'email' => 'budi.santoso@gmail.com',
                'password' => Hash::make('password'),
                'phone' => '081298765432',
                'nik' => '3505111203850001',
                'district_id' => $kanigoro?->id,
                'village_id' => $minggirsari?->id,
                'is_active' => true,
            ],
        ];

        foreach ($users as $userData) {
            User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
