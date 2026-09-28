<?php

namespace App\Livewire\Portal\ServiceRequest;

use App\Enums\ServiceRequestStatus;
use App\Models\District;
use App\Models\DtsenPurpose;
use App\Models\NumberSequence;
use App\Models\ServiceRequest;
use App\Models\ServiceType;
use App\Models\Village;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.portal')]
#[Title('Pengajuan Surat Keterangan DTSEN — SAPA SOSIAL')]
class DtsenForm extends Component
{
    use WithFileUploads;

    public int $currentStep = 1;

    public int $totalSteps = 4;

    // Step 1: Tujuan Penggunaan
    public string $purposeId = '';

    public string $purposeDescription = '';

    // Step 2: Data Pemohon
    public string $applicantName = '';

    public string $applicantNik = '';

    public string $familyCardNumber = '';

    public string $districtId = '';

    public string $villageId = '';

    public string $address = '';

    public string $phone = '';

    // Step 3: Orang yang Diterangkan & Berkas
    public bool $sameAsApplicant = true;

    public string $subjectName = '';

    public string $subjectNik = '';

    public string $relationship = '';

    public $ktpFile = null;

    public $kkFile = null;

    // Result
    public bool $submitted = false;

    public string $requestNumber = '';

    public function updatedDistrictId(): void
    {
        $this->villageId = '';
    }

    public function updatedSameAsApplicant(): void
    {
        if ($this->sameAsApplicant) {
            $this->subjectName = $this->applicantName;
            $this->subjectNik = $this->applicantNik;
            $this->relationship = 'Diri Sendiri';
        } else {
            $this->subjectName = '';
            $this->subjectNik = '';
            $this->relationship = '';
        }
    }

    public function nextStep(): void
    {
        $this->validateCurrentStep();
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }

        if ($this->currentStep === 3 && $this->sameAsApplicant) {
            $this->subjectName = $this->applicantName;
            $this->subjectNik = $this->applicantNik;
            $this->relationship = 'Diri Sendiri';
        }
    }

    public function previousStep(): void
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function goToStep(int $step): void
    {
        if ($step < $this->currentStep) {
            $this->currentStep = $step;
        }
    }

    private function validateCurrentStep(): void
    {
        match ($this->currentStep) {
            1 => $this->validate([
                'purposeId' => 'required|exists:dtsen_purposes,id',
            ], [
                'purposeId.required' => 'Pilih tujuan penggunaan surat.',
            ]),
            2 => $this->validate([
                'applicantName' => 'required|string|min:3',
                'applicantNik' => 'required|string|size:16',
                'familyCardNumber' => 'required|string|size:16',
                'districtId' => 'required|exists:districts,id',
                'villageId' => 'required|exists:villages,id',
                'address' => 'required|string|min:10',
                'phone' => ['required', 'string', 'regex:/^08[0-9]{8,13}$/'],
            ], [
                'applicantName.required' => 'Nama lengkap wajib diisi.',
                'applicantNik.required' => 'NIK wajib diisi.',
                'applicantNik.size' => 'NIK harus 16 digit.',
                'familyCardNumber.required' => 'Nomor KK wajib diisi.',
                'familyCardNumber.size' => 'Nomor KK harus 16 digit.',
                'districtId.required' => 'Pilih kecamatan.',
                'villageId.required' => 'Pilih desa/kelurahan.',
                'address.required' => 'Alamat lengkap wajib diisi.',
                'phone.required' => 'Nomor WhatsApp wajib diisi.',
                'phone.regex' => 'Format nomor HP tidak valid.',
            ]),
            3 => $this->validate([
                'subjectName' => 'required|string|min:3',
                'subjectNik' => 'required|string|size:16',
                'relationship' => 'required|string',
                'ktpFile' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'kkFile' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ], [
                'subjectName.required' => 'Nama orang yang diterangkan wajib diisi.',
                'subjectNik.required' => 'NIK orang yang diterangkan wajib diisi.',
                'subjectNik.size' => 'NIK harus 16 digit.',
                'relationship.required' => 'Hubungan dengan pemohon wajib diisi.',
                'ktpFile.required' => 'Scan KTP wajib diunggah.',
                'ktpFile.max' => 'Ukuran file KTP maksimal 2MB.',
                'kkFile.required' => 'Scan KK wajib diunggah.',
                'kkFile.max' => 'Ukuran file KK maksimal 2MB.',
            ]),
            default => null,
        };
    }

    public function submit(): void
    {
        $this->validateCurrentStep();

        DB::transaction(function () {
            $serviceType = ServiceType::where('code', 'DTSEN')->first();
            $requestNumber = NumberSequence::generateNumber('DTSEN');

            $serviceRequest = ServiceRequest::create([
                'request_number' => $requestNumber,
                'service_type_id' => $serviceType?->id,
                'submitter_id' => auth()->id(),
                'applicant_name' => $this->applicantName,
                'applicant_nik' => $this->applicantNik,
                'family_card_number' => $this->familyCardNumber,
                'address' => $this->address,
                'village_id' => $this->villageId,
                'phone' => $this->phone,
                'submitted_at' => now(),
                'status' => ServiceRequestStatus::Submitted,
                'is_priority' => false,
            ]);

            // Create DTSEN certificate record
            $serviceRequest->dtsenCertificate()->create([
                'dtsen_purpose_id' => $this->purposeId,
                'purpose_description' => $this->purposeDescription,
                'subject_name' => $this->subjectName,
                'subject_nik' => $this->subjectNik,
                'relationship_to_applicant' => $this->relationship,
                'verification_code' => 'DTSEN-V' . date('y') . '-' . strtoupper(bin2hex(random_bytes(4))),
            ]);

            // Upload documents
            $requirements = $serviceType?->requirements ?? collect();

            if ($this->ktpFile) {
                $ktpPath = $this->ktpFile->store('service-requests/' . $serviceRequest->id, 'local');
                $ktpReq = $requirements->firstWhere('name', 'LIKE', '%KTP%');
                $serviceRequest->documents()->create([
                    'service_requirement_id' => $ktpReq?->id,
                    'file_path' => $ktpPath,
                    'original_name' => $this->ktpFile->getClientOriginalName(),
                    'verification_status' => 'pending',
                ]);
            }

            if ($this->kkFile) {
                $kkPath = $this->kkFile->store('service-requests/' . $serviceRequest->id, 'local');
                $kkReq = $requirements->firstWhere('name', 'LIKE', '%KK%');
                $serviceRequest->documents()->create([
                    'service_requirement_id' => $kkReq?->id,
                    'file_path' => $kkPath,
                    'original_name' => $this->kkFile->getClientOriginalName(),
                    'verification_status' => 'pending',
                ]);
            }

            $serviceRequest->statusHistories()->create([
                'from_status' => null,
                'to_status' => ServiceRequestStatus::Submitted->value,
                'notes' => 'Pengajuan Surat Keterangan DTSEN diterima melalui portal publik.',
                'user_id' => auth()->id(),
            ]);

            $this->requestNumber = $requestNumber;
        });

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.portal.service-request.dtsen-form', [
            'purposes' => DtsenPurpose::where('is_active', true)->get(),
            'districts' => District::orderBy('name')->get(),
            'villages' => $this->districtId
                ? Village::where('district_id', $this->districtId)->orderBy('name')->get()
                : collect(),
        ]);
    }
}
