<?php

namespace Database\Seeders;

use App\Models\ClientCategory;
use App\Models\ReferralInstitution;
use Illuminate\Database\Seeder;

class RehabilitationMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Lansia Terlantar',
            'Penyandang Disabilitas (Fisik / Mental / Sensorik / Intelektual)',
            'Orang Dengan Gangguan Jiwa (ODGJ) Terlantar',
            'Anak Terlantar / Anak Berhadapan dengan Hukum (ABH)',
            'Korban Tindak Kekerasan (KTK) dan Perdagangan Orang',
            'Gelandangan dan Pengemis (Gepeng)',
        ];

        foreach ($categories as $cat) {
            ClientCategory::firstOrCreate(['name' => $cat]);
        }

        $institutions = [
            [
                'name' => 'UPT Pelayanan Sosial Tresna Werdha (PSTW) Blitar',
                'type' => 'panti',
                'address' => 'Jl. Sudanco Supriyadi No. 12, Kota Blitar',
                'contact' => '(0342) 801234',
                'is_active' => true,
            ],
            [
                'name' => 'RSUD Ngudi Waluyo Wlingi (Instalasi Jiwa & Rawat Lanjutan)',
                'type' => 'RS',
                'address' => 'Jl. Dokter Suwandhi No. 5, Wlingi, Kabupaten Blitar',
                'contact' => '(0342) 691006',
                'is_active' => true,
            ],
            [
                'name' => 'Balai Rehabilitasi Sosial Bina Netra / Rungu Wicara Jawa Timur',
                'type' => 'balai',
                'address' => 'Surabaya, Jawa Timur',
                'contact' => '(031) 8290001',
                'is_active' => true,
            ],
            [
                'name' => 'Lembaga Kesejahteraan Sosial (LKS) Peduli Kasih Blitar',
                'type' => 'LKS',
                'address' => 'Jl. Kusuma Bangsa, Kanigoro, Kabupaten Blitar',
                'contact' => '0812-3456-7890',
                'is_active' => true,
            ],
        ];

        foreach ($institutions as $inst) {
            ReferralInstitution::firstOrCreate(['name' => $inst['name']], $inst);
        }
    }
}
