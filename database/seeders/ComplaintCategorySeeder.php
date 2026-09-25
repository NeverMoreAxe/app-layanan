<?php

namespace Database\Seeders;

use App\Models\ComplaintCategory;
use Illuminate\Database\Seeder;

class ComplaintCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Penanganan Pemerlu Pelayanan Kesejahteraan Sosial (PPKS) Terlantar',
            'Bantuan Sosial (PKH, BPNT, BLT) Tidak Tepat Sasaran',
            'Penonaktifan Kartu BPJS PBI-JK Sepihak',
            'Kekerasan Terhadap Perempuan dan Anak',
            'Bencana Alam dan Bencana Sosial',
            'Pelayanan Petugas dan Administrasi Lainnya',
        ];

        foreach ($categories as $cat) {
            ComplaintCategory::firstOrCreate(
                ['name' => $cat],
                ['is_active' => true]
            );
        }
    }
}
