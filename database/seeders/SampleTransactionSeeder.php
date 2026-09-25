<?php

namespace Database\Seeders;

use App\Enums\ApprovalDecision;
use App\Enums\ComplaintStatus;
use App\Enums\DocumentVerificationStatus;
use App\Enums\HandlingType;
use App\Enums\PbiReason;
use App\Enums\ReferralStatus;
use App\Enums\RehabilitationCaseStatus;
use App\Enums\ServiceRequestStatus;
use App\Models\Assessment;
use App\Models\Client;
use App\Models\ClientCategory;
use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\District;
use App\Models\DtsenCertificate;
use App\Models\DtsenPurpose;
use App\Models\MonitoringRecord;
use App\Models\NumberSequence;
use App\Models\PbiReactivation;
use App\Models\Referral;
use App\Models\ReferralInstitution;
use App\Models\RehabilitationCase;
use App\Models\ServiceRequest;
use App\Models\ServiceType;
use App\Models\User;
use App\Models\Village;
use App\Models\WorkUnit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SampleTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dtsenType = ServiceType::where('code', 'DTSEN')->first();
        $pbiType = ServiceType::where('code', 'PBI')->first();

        $kanigoro = District::where('name', 'Kanigoro')->first();
        $minggirsari = Village::where('name', 'Minggirsari')->first();
        $satreyan = Village::where('name', 'Satreyan')->first();

        $budi = User::where('email', 'budi.santoso@gmail.com')->first();
        $petugasLayanan = User::where('email', 'petugas.layanan@sapasosial.blitarkab.go.id')->first();
        $petugasRehsos = User::where('email', 'petugas.rehsos@sapasosial.blitarkab.go.id')->first();
        $kabidDayasos = User::where('email', 'kabid.dayasos@sapasosial.blitarkab.go.id')->first();
        $kabidLinjamsos = User::where('email', 'kabid.linjamsos@sapasosial.blitarkab.go.id')->first();
        $kadis = User::where('email', 'kadis@sapasosial.blitarkab.go.id')->first();

        $dayasosUnit = WorkUnit::where('name', 'like', '%Dayasos%')->first();
        $linjamsosUnit = WorkUnit::where('name', 'like', '%Linjamsos%')->first();
        $spmbPurpose = DtsenPurpose::where('code', 'spmb')->first();
        $kipPurpose = DtsenPurpose::where('code', 'kip_kuliah')->first();

        // ==========================================
        // 1. CONTOH TIKET 1: SK DTSEN SUDAH TERBIT (ISSUED)
        // ==========================================
        $reqNum1 = NumberSequence::nextNumber('DTSEN');
        $ticket1 = ServiceRequest::firstOrCreate(
            ['request_number' => $reqNum1],
            [
                'service_type_id' => $dtsenType->id,
                'submitter_id' => $budi?->id,
                'applicant_name' => 'Budi Santoso',
                'applicant_nik' => '3505111203850001',
                'family_card_number' => '3505112001050012',
                'address' => 'RT 02 RW 01 Desa Minggirsari',
                'village_id' => $minggirsari->id,
                'phone' => '081298765432',
                'submitted_at' => now()->subDays(2),
                'officer_id' => $petugasLayanan?->id,
                'work_unit_id' => $dayasosUnit?->id,
                'status' => ServiceRequestStatus::Issued,
                'is_priority' => false,
                'verification_result' => 'Berkas lengkap dan sesuai. Data terdaftar di SIKS-NG Desil 2.',
                'officer_notes' => 'Memenuhi persyaratan untuk SPMB jalur afirmasi.',
                'service_result' => 'Surat Keterangan DTSEN Nomor 400.9/105/409.105/2026 telah diterbitkan.',
                'completed_at' => now()->subHours(3),
            ]
        );

        // Upload Dokumen Tiket 1
        foreach ($dtsenType->requirements as $req) {
            $ticket1->documents()->firstOrCreate(
                ['service_requirement_id' => $req->id],
                [
                    'file_path' => 'documents/dtsen/'.Str::slug($req->name).'-sample.pdf',
                    'original_name' => $req->name.'.pdf',
                    'verification_status' => DocumentVerificationStatus::Valid,
                    'notes' => 'Sesuai dan jelas',
                ]
            );
        }

        // Sertifikat DTSEN Tiket 1
        $cert1 = DtsenCertificate::firstOrCreate(
            ['service_request_id' => $ticket1->id],
            [
                'dtsen_purpose_id' => $spmbPurpose->id,
                'purpose_description' => 'Pendaftaran SPMB Jalur Afirmasi SMAN 1 Talun',
                'subject_name' => 'Ahmad Fauzi Santoso',
                'subject_nik' => '3505111508080002',
                'relationship_to_applicant' => 'Anak Kandung',
                'is_registered' => true,
                'decile' => 2,
                'checked_at' => now()->subDay(),
                'checker_id' => $petugasLayanan?->id,
                'certificate_number' => '400.9/105/409.105/'.now()->format('Y'),
                'issued_at' => now()->subHours(3),
                'valid_until' => now()->addDays(90),
                'signer_id' => $kadis?->id,
                'file_path' => 'certificates/sk-dtsen-400-9-105.pdf',
                'verification_code' => 'DTSEN-'.strtoupper(Str::random(8)),
            ]
        );

        // Persetujuan Berjenjang (Kabid Dayasos & Kadis)
        $cert1->approvals()->create([
            'step' => 1,
            'approver_id' => $kabidDayasos?->id,
            'decision' => ApprovalDecision::Approved,
            'notes' => 'Data sesuai SIKS-NG desil 2, draf disetujui paraf.',
            'decided_at' => now()->subHours(5),
        ]);

        $cert1->approvals()->create([
            'step' => 2,
            'approver_id' => $kadis?->id,
            'decision' => ApprovalDecision::Approved,
            'notes' => 'Disetujui untuk diterbitkan tanda tangan elektronik/resmi.',
            'decided_at' => now()->subHours(3),
        ]);

        $ticket1->recordStatusChange(ServiceRequestStatus::Submitted->value, 'Pengajuan baru diajukan oleh pemohon.', $budi?->id);
        $ticket1->recordStatusChange(ServiceRequestStatus::DataVerification->value, 'Verifikasi berkas dan pengecekan SIKS-NG.', $petugasLayanan?->id);
        $ticket1->recordStatusChange(ServiceRequestStatus::Issued->value, 'Surat Keterangan diterbitkan dan siap diunduh.', $kadis?->id);

        // ==========================================
        // 2. CONTOH TIKET 2: SK DTSEN BARU MASUK (SUBMITTED)
        // ==========================================
        $reqNum2 = NumberSequence::nextNumber('DTSEN');
        $ticket2 = ServiceRequest::firstOrCreate(
            ['request_number' => $reqNum2],
            [
                'service_type_id' => $dtsenType->id,
                'submitter_id' => $budi?->id,
                'applicant_name' => 'Siti Aminah',
                'applicant_nik' => '3505115504900003',
                'family_card_number' => '3505112001050099',
                'address' => 'RT 01 RW 03 Kelurahan Satreyan',
                'village_id' => $satreyan->id,
                'phone' => '085712345678',
                'submitted_at' => now()->subHours(1),
                'work_unit_id' => $dayasosUnit?->id,
                'status' => ServiceRequestStatus::Submitted,
                'is_priority' => false,
            ]
        );

        DtsenCertificate::firstOrCreate(
            ['service_request_id' => $ticket2->id],
            [
                'dtsen_purpose_id' => $kipPurpose->id,
                'purpose_description' => 'Persyaratan Pendaftaran KIP Kuliah 2026',
                'subject_name' => 'Rian Pratama',
                'subject_nik' => '3505112209070005',
                'relationship_to_applicant' => 'Anak Kandung',
                'is_registered' => false,
                'verification_code' => 'DTSEN-'.strtoupper(Str::random(8)),
            ]
        );

        $ticket2->recordStatusChange(ServiceRequestStatus::Submitted->value, 'Tiket berhasil dibuat dan menunggu antrean verifikasi berkas.', $budi?->id);

        // ==========================================
        // 3. CONTOH TIKET 3: REAKTIVASI KIS/PBI-JK DARURAT MEDIS
        // ==========================================
        $reqNum3 = NumberSequence::nextNumber('PBI');
        $ticket3 = ServiceRequest::firstOrCreate(
            ['request_number' => $reqNum3],
            [
                'service_type_id' => $pbiType->id,
                'submitter_id' => $budi?->id,
                'applicant_name' => 'Sumarto',
                'applicant_nik' => '3505111005600007',
                'family_card_number' => '3505112001050012',
                'address' => 'Dusun Minggirsari RT 03 RW 02',
                'village_id' => $minggirsari->id,
                'phone' => '081298765432',
                'submitted_at' => now()->subHours(8),
                'officer_id' => $petugasLayanan?->id,
                'work_unit_id' => $linjamsosUnit?->id,
                'status' => ServiceRequestStatus::ProposedToMinistry,
                'is_priority' => true,
                'verification_result' => 'Pasien sedang rawat inap darurat di RSUD Ngudi Waluyo Wlingi. Desil 1 memenuhi syarat.',
                'officer_notes' => 'Rekomendasi selesai dibuat, usulan reaktivasi telah dikirim ke SIKS-NG Kemensos.',
            ]
        );

        $pbiRecord = PbiReactivation::firstOrCreate(
            ['service_request_id' => $ticket3->id],
            [
                'participant_name' => 'Sumarto',
                'participant_nik' => '3505111005600007',
                'bpjs_card_number' => '0001234567891',
                'deactivated_date' => now()->subMonths(2)->toDateString(),
                'reason' => PbiReason::Emergency,
                'health_facility_name' => 'RSUD Ngudi Waluyo Wlingi',
                'health_letter_number' => 'MED/NW/2026/09/042',
                'decile' => 1,
                'eligibility_notes' => 'Kondisi serangan jantung akut, dirawat di ICU. Masuk kriteria prioritas darurat medis.',
                'recommendation_number' => '400.9/088/409.105/'.now()->format('Y'),
                'recommendation_issued_at' => now()->subHours(4),
                'signer_id' => $kabidLinjamsos?->id,
                'proposed_to_ministry_at' => now()->subHours(2),
            ]
        );

        $pbiRecord->approvals()->create([
            'step' => 1,
            'approver_id' => $kabidLinjamsos?->id,
            'decision' => ApprovalDecision::Approved,
            'notes' => 'Rekomendasi disetujui untuk prioritas pengusulan ke Kemensos.',
            'decided_at' => now()->subHours(4),
        ]);

        $ticket3->recordStatusChange(ServiceRequestStatus::Submitted->value, 'Permohonan reaktivasi KIS darurat diajukan.', $budi?->id);
        $ticket3->recordStatusChange(ServiceRequestStatus::EligibilityVerification->value, 'Verifikasi kelayakan medis dan data DTKS/DTSEN selesai.', $petugasLayanan?->id);
        $ticket3->recordStatusChange(ServiceRequestStatus::ProposedToMinistry->value, 'Usulan telah diinputkan ke sistem SIKS-NG Kemensos RI.', $petugasLayanan?->id);

        // ==========================================
        // 4. CONTOH PENGADUAN SOSIAL (LAYANAN 5)
        // ==========================================
        $catPengaduan = ComplaintCategory::where('name', 'like', '%PPKS%')->first();
        $complaintNum = NumberSequence::nextNumber('ADU');

        $complaint = Complaint::firstOrCreate(
            ['complaint_number' => $complaintNum],
            [
                'complaint_category_id' => $catPengaduan->id,
                'reporter_id' => $budi?->id,
                'reporter_name' => 'Budi Santoso',
                'reporter_phone' => '081298765432',
                'location_detail' => 'Depan ruko Pasar Kanigoro, sebelah barat pos jaga',
                'village_id' => $minggirsari->id,
                'description' => 'Ditemukan seorang kakek lanjut usia dalam kondisi linglung, tidak membawa identitas, dan memerlukan pertolongan makan/pakaian.',
                'reported_at' => now()->subDay(),
                'officer_id' => $petugasRehsos?->id,
                'status' => ComplaintStatus::InHandling,
                'verification_result' => 'Laporan valid. Tim Respon Cepat Dinsos bersama aparat desa telah mengevakuasi lansia ke kantor Dinsos.',
                'action_taken' => 'Diberikan pembersihan, pakaian layak, pemeriksaan kesehatan dasar, dan dibuatkan register kasus rehabilitasi sosial.',
            ]
        );

        $complaint->recordStatusChange(ComplaintStatus::Received->value, 'Laporan aduan masyarakat diterima.', $budi?->id);
        $complaint->recordStatusChange(ComplaintStatus::InHandling->value, 'Tim TRC meluncur ke lokasi kejadian untuk penanganan.', $petugasRehsos?->id);

        // ==========================================
        // 5. CONTOH KASUS REHABILITASI SOSIAL (LAYANAN 3)
        // ==========================================
        $catClient = ClientCategory::where('name', 'like', '%Lansia Terlantar%')->first();
        $pstw = ReferralInstitution::where('name', 'like', '%PSTW%')->first();

        $client = Client::firstOrCreate(
            ['name' => 'Mbah Darmo (Tanpa NIK)'],
            [
                'client_category_id' => $catClient->id,
                'gender' => 'L',
                'address' => 'Ditemukan di Area Pasar Kanigoro',
                'village_id' => $minggirsari->id,
            ]
        );

        $caseNum = NumberSequence::nextNumber('RHS');
        $case = RehabilitationCase::firstOrCreate(
            ['case_number' => $caseNum],
            [
                'client_id' => $client->id,
                'complaint_id' => $complaint->id,
                'officer_id' => $petugasRehsos?->id,
                'handling_type' => HandlingType::Both,
                'status' => RehabilitationCaseStatus::InService,
                'received_at' => now()->subDay(),
            ]
        );

        // Assessment
        $assessment = Assessment::firstOrCreate(
            ['rehabilitation_case_id' => $case->id],
            [
                'officer_id' => $petugasRehsos?->id,
                'assessment_date' => now()->subHours(18)->toDateString(),
                'result' => 'Klien diperkirakan berusia 72 tahun, mengalami demensia ringan, tidak memiliki keluarga yang dapat dihubungi.',
                'service_needs' => 'Pemenuhan kebutuhan dasar, perawatan harian, tempat tinggal aman, dan terapi sosial.',
                'recommendation' => 'Disarankan untuk dirujuk ke Balai/UPT PSTW Blitar guna penanganan jangka panjang.',
                'needs_referral' => true,
            ]
        );

        // Rujukan ke PSTW Blitar
        $refNum = NumberSequence::nextNumber('RJK');
        $referral = Referral::firstOrCreate(
            ['referral_number' => $refNum],
            [
                'rehabilitation_case_id' => $case->id,
                'assessment_id' => $assessment->id,
                'referral_institution_id' => $pstw->id,
                'officer_id' => $petugasRehsos?->id,
                'referral_date' => now()->subHours(12)->toDateString(),
                'status' => ReferralStatus::Accepted,
                'service_result' => 'Klien telah diterima oleh petugas PSTW Blitar dan ditempatkan di wisma transit perawatan.',
            ]
        );

        // Catatan Monitoring
        MonitoringRecord::firstOrCreate(
            [
                'rehabilitation_case_id' => $case->id,
                'referral_id' => $referral->id,
            ],
            [
                'officer_id' => $petugasRehsos?->id,
                'monitoring_date' => now()->toDateString(),
                'progress' => 'Kondisi klien stabil, nafsu makan baik, dan mulai beradaptasi dengan lingkungan panti.',
                'result_notes' => 'Koordinasi lanjutan tetap dilakukan dengan pihak desa asal penemuan untuk penelusuran keluarga.',
            ]
        );

        $case->recordStatusChange(RehabilitationCaseStatus::Received->value, 'Klien diterima di Dinsos.', $petugasRehsos?->id);
        $case->recordStatusChange(RehabilitationCaseStatus::Assessment->value, 'Assessment kebutuhan selesai dilakukan.', $petugasRehsos?->id);
        $case->recordStatusChange(RehabilitationCaseStatus::InService->value, 'Klien dirujuk ke PSTW Blitar.', $petugasRehsos?->id);
    }
}
