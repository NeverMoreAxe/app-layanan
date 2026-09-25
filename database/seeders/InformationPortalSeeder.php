<?php

namespace Database\Seeders;

use App\Enums\InformationCategory;
use App\Enums\PublishStatus;
use App\Models\DownloadableForm;
use App\Models\Faq;
use App\Models\InformationPage;
use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Database\Seeder;

class InformationPortalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::first();
        $dtsenType = ServiceType::where('code', 'DTSEN')->first();
        $pbiType = ServiceType::where('code', 'PBI')->first();
        $rehsosType = ServiceType::where('code', 'REHSOS')->first();

        $pages = [
            [
                'title' => 'Alur dan Persyaratan Penerbitan Surat Keterangan DTSEN',
                'slug' => 'alur-dan-persyaratan-sk-dtsen',
                'category' => InformationCategory::Program,
                'service_type_id' => $dtsenType?->id,
                'description' => 'Surat Keterangan DTSEN menerangkan posisi desil kesejahteraan keluarga dalam basis data Kementerian Sosial RI untuk keperluan SPMB afirmasi, KIP Kuliah, dan beasiswa.',
                'requirements' => "1. KTP Asli Pemohon / Orang Tua\n2. Kartu Keluarga (KK) Kabupaten Blitar\n3. Surat pengantar dari pihak sekolah/kampus atau desa (bila diperlukan)",
                'procedure' => "1. Pemohon mengajukan permohonan online melalui portal SAPA SOSIAL atau melalui operator desa/kecamatan.\n2. Petugas memverifikasi kelengkapan berkas.\n3. Petugas mengecek data pada sistem SIKS-NG.\n4. Persetujuan dan paraf oleh Kepala Bidang Dayasos serta tanda tangan Kepala Dinas.\n5. Surat terbit dalam format PDF dengan QR Code resmi dan dapat diunduh langsung.",
                'service_hours' => 'Senin - Kamis: 08.00 - 15.00 WIB | Jumat: 08.00 - 14.30 WIB',
                'location' => 'Kantor Dinas Sosial Kabupaten Blitar, Jl. Kusuma Bangsa No. 6, Kanigoro',
                'contact' => 'WhatsApp Layanan: 0812-3456-7890 | Email: dinsos@blitarkab.go.id',
                'publish_status' => PublishStatus::Published,
                'published_at' => now(),
                'manager_id' => $admin?->id,
                'forms' => [
                    ['name' => 'Formulir Permohonan SK DTSEN Offline', 'file_path' => 'forms/form-permohonan-sk-dtsen.pdf', 'version' => '1.2', 'is_current' => true],
                ],
                'faqs' => [
                    [
                        'question' => 'Apa yang dimaksud dengan Desil pada data DTSEN?',
                        'answer' => 'Desil adalah kelompok persepuluhan tingkat kesejahteraan. Desil 1 merupakan 10% rumah tangga termiskin, hingga Desil 10 merupakan kelompok paling mampu. Sebagian besar beasiswa afirmasi mensyaratkan Desil 1 sampai dengan Desil 4 atau 5.',
                    ],
                    [
                        'question' => 'Bagaimana jika nama saya tidak ditemukan di sistem SIKS-NG?',
                        'answer' => 'Jika tidak terdaftar, permohonan SK DTSEN tidak dapat diterbitkan. Anda disarankan melakukan pengusulan data baru (musdes) melalui operator desa/kelurahan setempat.',
                    ],
                ],
            ],
            [
                'title' => 'Panduan Reaktivasi Kepesertaan JKN-KIS PBI-JK Nonaktif',
                'slug' => 'panduan-reaktivasi-kis-pbi-jk',
                'category' => InformationCategory::Program,
                'service_type_id' => $pbiType?->id,
                'description' => 'Fasilitasi bantuan pengusulan pengaktifan kembali kartu BPJS Kesehatan Penerima Bantuan Iuran Jaminan Kesehatan (PBI-JK) APBN bagi masyarakat rentan.',
                'requirements' => "1. KTP dan Kartu Keluarga (KK)\n2. Kartu BPJS Kesehatan / KIS yang nonaktif\n3. Surat Keterangan Rawat Inap / Resume Medis dari Rumah Sakit atau Puskesmas (wajib bagi pasien rawat/darurat medis)",
                'procedure' => "1. Mendaftar online dengan memasukkan nomor BPJS dan NIK.\n2. Verifikasi status kepesertaan dan kelayakan desil oleh petugas Dinsos.\n3. Penerbitan Surat Rekomendasi Reaktivasi.\n4. Penginputan usulan reaktivasi ke SIKS-NG Kemensos RI.\n5. Pemantauan berkala hingga status kepesertaan aktif kembali di BPJS Kesehatan.",
                'service_hours' => 'Senin - Jumat (Pelayanan 24 Jam untuk Kasus Darurat Medis melalui Call Center)',
                'location' => 'Kantor Dinas Sosial Kabupaten Blitar (Ruang Layanan Terpadu Linjamsos)',
                'contact' => 'Hotline Darurat Medis: 0812-9988-7766',
                'publish_status' => PublishStatus::Published,
                'published_at' => now(),
                'manager_id' => $admin?->id,
                'forms' => [
                    ['name' => 'Formulir Usulan Reaktivasi KIS PBI-JK', 'file_path' => 'forms/form-reaktivasi-kis-pbi.pdf', 'version' => '2.0', 'is_current' => true],
                ],
                'faqs' => [
                    [
                        'question' => 'Mengapa kartu KIS PBI-JK saya bisa tiba-tiba dinonaktifkan?',
                        'answer' => 'Penonaktifan dapat disebabkan pemutakhiran data berkala dari Kemensos (verivali), perubahan desil, NIK tidak padan di Dukcapil, atau kuota kepesertaan nasional.',
                    ],
                    [
                        'question' => 'Berapa lama proses reaktivasi kartu PBI-JK sampai bisa digunakan kembali?',
                        'answer' => 'Untuk pasien kondisi darurat medis di rumah sakit, fasilitasi rekomendasi diterbitkan dalam 1x24 jam dan dikoordinasikan prioritas dengan BPJS Kesehatan.',
                    ],
                ],
            ],
            [
                'title' => 'Standar Pelayanan Rehabilitasi Sosial & Rujukan PPKS',
                'slug' => 'standar-pelayanan-rehabilitasi-sosial',
                'category' => InformationCategory::Rehabilitation,
                'service_type_id' => $rehsosType?->id,
                'description' => 'Mekanisme penanganan dan rujukan panti bagi lansia terlantar, penyandang disabilitas berat, serta ODGJ terlantar di wilayah Kabupaten Blitar.',
                'requirements' => "1. Laporan warga / aparat desa / Satpol PP\n2. KTP / Surat Keterangan Domisili (jika ada)\n3. Kronologi kejadian atau riwayat kondisi klien",
                'procedure' => "1. Laporan diterima tim TRC / Petugas Rehsos Dinsos.\n2. Assessment mendalam di lokasi kejadian / kantor Dinsos.\n3. Penyusunan rencana pelayanan (langsung / rujukan panti / rumah sakit jiwa).\n4. Pelaksanaan rujukan dan monitoring kondisi berkala.",
                'service_hours' => 'Setiap Hari Kerja (Siaga Tim Respon Cepat Dinsos 24 Jam)',
                'location' => 'Bidang Rehabilitasi Sosial, Dinas Sosial Kabupaten Blitar',
                'contact' => 'TRC Dinsos Blitar: 0811-3000-400',
                'publish_status' => PublishStatus::Published,
                'published_at' => now(),
                'manager_id' => $admin?->id,
                'forms' => [],
                'faqs' => [
                    [
                        'question' => 'Bagaimana jika menemukan ODGJ mengamuk atau lansia terlantar di jalan raya?',
                        'answer' => 'Segera laporkan melalui menu Pengaduan Sosial SAPA SOSIAL atau hubungi Hotline TRC Dinsos / Satpol PP terdekat untuk tindakan evakuasi dan assessment.',
                    ],
                ],
            ],
        ];

        foreach ($pages as $pData) {
            $forms = $pData['forms'] ?? [];
            $faqs = $pData['faqs'] ?? [];
            unset($pData['forms'], $pData['faqs']);

            $page = InformationPage::firstOrCreate(
                ['slug' => $pData['slug']],
                $pData
            );

            foreach ($forms as $formData) {
                DownloadableForm::firstOrCreate(
                    [
                        'information_page_id' => $page->id,
                        'name' => $formData['name'],
                    ],
                    $formData
                );
            }

            $sort = 1;
            foreach ($faqs as $faqData) {
                Faq::firstOrCreate(
                    [
                        'information_page_id' => $page->id,
                        'question' => $faqData['question'],
                    ],
                    array_merge($faqData, ['sort_order' => $sort++, 'is_active' => true])
                );
            }
        }
    }
}
