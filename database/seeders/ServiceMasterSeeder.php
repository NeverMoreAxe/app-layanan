<?php

namespace Database\Seeders;

use App\Enums\ServiceTypeHandler;
use App\Models\DtsenPurpose;
use App\Models\ServiceRequirement;
use App\Models\ServiceType;
use Illuminate\Database\Seeder;

class ServiceMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Jenis Layanan & Persyaratannya
        $services = [
            [
                'code' => 'DTSEN',
                'name' => 'Surat Keterangan DTSEN',
                'category' => 'Pemberdayaan Sosial',
                'description' => 'Penerbitan surat keterangan yang menerangkan status terdaftar dan peringkat desil seseorang/keluarga dalam Data Tunggal Sosial Ekonomi Nasional (DTSEN) untuk syarat SPMB, beasiswa, maupun bantuan sosial.',
                'handler' => ServiceTypeHandler::Dtsen,
                'needs_assessment' => false,
                'sla_days' => 2,
                'is_active' => true,
                'requirements' => [
                    ['name' => 'KTP Pemohon / Orang Tua', 'is_mandatory' => true, 'allowed_mimes' => 'pdf,jpg,png,jpeg', 'sort_order' => 1],
                    ['name' => 'Kartu Keluarga (KK)', 'is_mandatory' => true, 'allowed_mimes' => 'pdf,jpg,png,jpeg', 'sort_order' => 2],
                    ['name' => 'Surat Pengantar / Keterangan Desa (Opsional)', 'is_mandatory' => false, 'allowed_mimes' => 'pdf,jpg,png,jpeg', 'sort_order' => 3],
                ],
            ],
            [
                'code' => 'PBI',
                'name' => 'Reaktivasi KIS / PBI-JK',
                'category' => 'Perlindungan dan Jaminan Sosial',
                'description' => 'Fasilitasi pengaktifan kembali kepesertaan JKN-KIS Penerima Bantuan Iuran Jaminan Kesehatan (PBI-JK) yang dinonaktifkan oleh Kementerian Sosial RI.',
                'handler' => ServiceTypeHandler::Pbi,
                'needs_assessment' => false,
                'sla_days' => 5,
                'is_active' => true,
                'requirements' => [
                    ['name' => 'KTP Peserta', 'is_mandatory' => true, 'allowed_mimes' => 'pdf,jpg,png,jpeg', 'sort_order' => 1],
                    ['name' => 'Kartu Keluarga (KK)', 'is_mandatory' => true, 'allowed_mimes' => 'pdf,jpg,png,jpeg', 'sort_order' => 2],
                    ['name' => 'Kartu BPJS Kesehatan / KIS Nonaktif', 'is_mandatory' => true, 'allowed_mimes' => 'pdf,jpg,png,jpeg', 'sort_order' => 3],
                    ['name' => 'Surat Keterangan Rawat Inap / Medis Fasilitas Kesehatan', 'is_mandatory' => false, 'allowed_mimes' => 'pdf,jpg,png,jpeg', 'sort_order' => 4],
                ],
            ],
            [
                'code' => 'REHSOS',
                'name' => 'Pelayanan dan Rujukan Rehabilitasi Sosial',
                'category' => 'Rehabilitasi Sosial',
                'description' => 'Penanganan kasus klien yang membutuhkan rehabilitasi sosial (lansia terlantar, disabilitas, ODGJ terlantar, anak, korban kekerasan) baik pelayanan langsung maupun rujukan panti.',
                'handler' => ServiceTypeHandler::Generic,
                'needs_assessment' => true,
                'sla_days' => 7,
                'is_active' => true,
                'requirements' => [
                    ['name' => 'KTP / Identitas Klien (Bila Ada)', 'is_mandatory' => false, 'allowed_mimes' => 'pdf,jpg,png,jpeg', 'sort_order' => 1],
                    ['name' => 'Kartu Keluarga (Bila Ada)', 'is_mandatory' => false, 'allowed_mimes' => 'pdf,jpg,png,jpeg', 'sort_order' => 2],
                    ['name' => 'Laporan Kronologi Kejadian / Foto Kondisi Klien', 'is_mandatory' => true, 'allowed_mimes' => 'pdf,jpg,png,jpeg', 'sort_order' => 3],
                ],
            ],
            [
                'code' => 'BANSOS',
                'name' => 'Rekomendasi Bantuan Sosial Terencana',
                'category' => 'Perlindungan dan Jaminan Sosial',
                'description' => 'Permohonan surat rekomendasi pemberian bantuan sosial atau bantuan alat penunjang bagi warga rentan dan miskin.',
                'handler' => ServiceTypeHandler::Generic,
                'needs_assessment' => true,
                'sla_days' => 5,
                'is_active' => true,
                'requirements' => [
                    ['name' => 'KTP Pemohon', 'is_mandatory' => true, 'allowed_mimes' => 'pdf,jpg,png,jpeg', 'sort_order' => 1],
                    ['name' => 'Kartu Keluarga (KK)', 'is_mandatory' => true, 'allowed_mimes' => 'pdf,jpg,png,jpeg', 'sort_order' => 2],
                    ['name' => 'Surat Keterangan Tidak Mampu (SKTM) Desa', 'is_mandatory' => true, 'allowed_mimes' => 'pdf,jpg,png,jpeg', 'sort_order' => 3],
                    ['name' => 'Foto Kondisi Rumah / Tempat Tinggal', 'is_mandatory' => true, 'allowed_mimes' => 'pdf,jpg,png,jpeg', 'sort_order' => 4],
                ],
            ],
        ];

        foreach ($services as $srv) {
            $requirements = $srv['requirements'];
            unset($srv['requirements']);

            $serviceType = ServiceType::firstOrCreate(
                ['code' => $srv['code']],
                $srv
            );

            foreach ($requirements as $req) {
                ServiceRequirement::firstOrCreate(
                    [
                        'service_type_id' => $serviceType->id,
                        'name' => $req['name'],
                    ],
                    $req
                );
            }
        }

        // 2. Tujuan Penggunaan SK DTSEN & Batas Desil Maksimal
        $purposes = [
            [
                'code' => 'spmb',
                'name' => 'SPMB Jalur Afirmasi (SD, SMP, SMA/SMK)',
                'max_decile' => 5,
                'validity_days' => 90,
                'is_active' => true,
            ],
            [
                'code' => 'pip',
                'name' => 'Program Indonesia Pintar (PIP)',
                'max_decile' => 4,
                'validity_days' => 180,
                'is_active' => true,
            ],
            [
                'code' => 'kip_kuliah',
                'name' => 'Pendaftaran KIP Kuliah',
                'max_decile' => 4,
                'validity_days' => 180,
                'is_active' => true,
            ],
            [
                'code' => 'bansos',
                'name' => 'Pengajuan Bantuan Sosial / PKH / Sembako',
                'max_decile' => 4,
                'validity_days' => 90,
                'is_active' => true,
            ],
            [
                'code' => 'kesehatan',
                'name' => 'Layanan Kesehatan / Jamkesda / Keringanan Biaya RS',
                'max_decile' => 5,
                'validity_days' => 90,
                'is_active' => true,
            ],
            [
                'code' => 'lainnya',
                'name' => 'Keperluan Administrasi Lainnya',
                'max_decile' => 5,
                'validity_days' => 90,
                'is_active' => true,
            ],
        ];

        foreach ($purposes as $purp) {
            DtsenPurpose::firstOrCreate(['code' => $purp['code']], $purp);
        }
    }
}
