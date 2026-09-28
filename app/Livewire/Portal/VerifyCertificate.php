<?php

namespace App\Livewire\Portal;

use App\Models\DtsenCertificate;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.portal')]
#[Title('Verifikasi Keaslian Surat — SAPA SOSIAL')]
class VerifyCertificate extends Component
{
    public string $verificationCode = '';

    public bool $searched = false;

    public ?array $result = null;

    public function verify(): void
    {
        $this->validate([
            'verificationCode' => 'required|string|min:5',
        ], [
            'verificationCode.required' => 'Kode verifikasi wajib diisi.',
            'verificationCode.min' => 'Kode verifikasi minimal 5 karakter.',
        ]);

        $this->searched = true;
        $this->result = null;

        $certificate = DtsenCertificate::where('verification_code', $this->verificationCode)
            ->with(['serviceRequest.village.district', 'dtsenPurpose', 'signer'])
            ->first();

        if (! $certificate) {
            return;
        }

        $isExpired = $certificate->valid_until && $certificate->valid_until->isPast();

        $this->result = [
            'status' => $isExpired ? 'expired' : 'valid',
            'certificate_number' => $certificate->certificate_number,
            'verification_code' => $certificate->verification_code,
            'subject_name' => $certificate->subject_name,
            'subject_nik_masked' => substr($certificate->subject_nik, 0, 6) . str_repeat('•', 6) . substr($certificate->subject_nik, -4),
            'applicant_name' => $certificate->serviceRequest?->applicant_name,
            'applicant_nik_masked' => $certificate->serviceRequest ? substr($certificate->serviceRequest->applicant_nik, 0, 6) . str_repeat('•', 6) . substr($certificate->serviceRequest->applicant_nik, -4) : null,
            'purpose' => $certificate->dtsenPurpose?->name,
            'purpose_description' => $certificate->purpose_description,
            'is_registered' => $certificate->is_registered,
            'decile' => $certificate->decile,
            'issued_at' => $certificate->issued_at?->translatedFormat('d F Y'),
            'valid_until' => $certificate->valid_until?->translatedFormat('d F Y'),
            'signer_name' => $certificate->signer?->name,
            'village' => $certificate->serviceRequest?->village?->name,
            'district' => $certificate->serviceRequest?->village?->district?->name,
        ];
    }

    public function render()
    {
        return view('livewire.portal.verify-certificate');
    }
}
