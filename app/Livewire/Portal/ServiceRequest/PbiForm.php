<?php

namespace App\Livewire\Portal\ServiceRequest;

use App\Enums\PbiReason;
use App\Enums\ServiceRequestStatus;
use App\Models\District;
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
#[Title('Reaktivasi KIS / PBI-JK — SAPA SOSIAL')]
class PbiForm extends Component
{
    use WithFileUploads;

    public int $currentStep = 1;

    public int $totalSteps = 4;

    // Step 1: Alasan Reaktivasi
    public string $reason = '';

    // Step 2: Data Peserta
    public string $applicantName = '';

    public string $applicantNik = '';

    public string $familyCardNumber = '';

    public string $districtId = '';

    public string $villageId = '';

    public string $address = '';

    public string $phone = '';

    public string $participantName = '';

    public string $participantNik = '';

    public string $bpjsCardNumber = '';

    public string $deactivatedDate = '';

    // Step 3: Faskes & Berkas
    public string $healthFacilityName = '';

    public string $healthLetterNumber = '';

    public $ktpFile = null;

    public $kkFile = null;

    public $bpjsCardFile = null;

    public $healthLetterFile = null;

    // Result
    public bool $submitted = false;

    public string $requestNumber = '';

    public function updatedDistrictId(): void
    {
        $this->villageId = '';
    }

    public function nextStep(): void
    {
        $this->validateCurrentStep();
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
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
                'reason' => 'required|string|in:' . implode(',', array_column(PbiReason::cases(), 'value')),
            ], [
                'reason.required' => 'Pilih alasan reaktivasi.',
            ]),
            2 => $this->validate([
                'applicantName' => 'required|string|min:3',
                'applicantNik' => 'required|string|size:16',
                'familyCardNumber' => 'required|string|size:16',
                'districtId' => 'required|exists:districts,id',
                'villageId' => 'required|exists:villages,id',
                'address' => 'required|string|min:10',
                'phone' => ['required', 'string', 'regex:/^08[0-9]{8,13}$/'],
                'participantName' => 'required|string|min:3',
                'participantNik' => 'required|string|size:16',
                'bpjsCardNumber' => 'required|string|min:10',
                'deactivatedDate' => 'required|date|before_or_equal:today',
            ], [
                'applicantName.required' => 'Nama pemohon wajib diisi.',
                'applicantNik.required' => 'NIK wajib diisi.',
                'applicantNik.size' => 'NIK harus 16 digit.',
                'familyCardNumber.required' => 'Nomor KK wajib diisi.',
                'familyCardNumber.size' => 'Nomor KK harus 16 digit.',
                'districtId.required' => 'Pilih kecamatan.',
                'villageId.required' => 'Pilih desa/kelurahan.',
                'address.required' => 'Alamat wajib diisi.',
                'phone.required' => 'Nomor WhatsApp wajib diisi.',
                'phone.regex' => 'Format nomor HP tidak valid.',
                'participantName.required' => 'Nama peserta BPJS wajib diisi.',
                'participantNik.required' => 'NIK peserta wajib diisi.',
                'bpjsCardNumber.required' => 'Nomor kartu BPJS/KIS wajib diisi.',
                'deactivatedDate.required' => 'Perkiraan tanggal nonaktif wajib diisi.',
            ]),
            3 => $this->validate(array_filter([
                'ktpFile' => 'required|file|mimes:jpg,jpeg,png,pdf|max:3072',
                'kkFile' => 'required|file|mimes:jpg,jpeg,png,pdf|max:3072',
                'bpjsCardFile' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:3072',
                'healthLetterFile' => in_array($this->reason, ['chronic', 'catastrophic', 'emergency'])
                    ? 'required|file|mimes:jpg,jpeg,png,pdf|max:3072'
                    : 'nullable|file|mimes:jpg,jpeg,png,pdf|max:3072',
            ]), [
                'ktpFile.required' => 'Scan KTP wajib diunggah.',
                'kkFile.required' => 'Scan KK wajib diunggah.',
                'healthLetterFile.required' => 'Surat keterangan faskes wajib diunggah untuk alasan medis.',
            ]),
            default => null,
        };
    }

    public function submit(): void
    {
        DB::transaction(function () {
            $serviceType = ServiceType::where('code', 'PBI')->first();
            $requestNumber = NumberSequence::generateNumber('PBI');
            $isEmergency = $this->reason === PbiReason::Emergency->value;

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
                'is_priority' => $isEmergency,
            ]);

            $serviceRequest->pbiReactivation()->create([
                'participant_name' => $this->participantName,
                'participant_nik' => $this->participantNik,
                'bpjs_card_number' => $this->bpjsCardNumber,
                'deactivated_date' => $this->deactivatedDate,
                'reason' => $this->reason,
                'health_facility_name' => $this->healthFacilityName ?: null,
                'health_letter_number' => $this->healthLetterNumber ?: null,
                'ministry_decision' => 'pending',
            ]);

            // Upload documents
            $fileMap = [
                'ktpFile' => $this->ktpFile,
                'kkFile' => $this->kkFile,
                'bpjsCardFile' => $this->bpjsCardFile,
                'healthLetterFile' => $this->healthLetterFile,
            ];

            foreach ($fileMap as $key => $file) {
                if ($file) {
                    $path = $file->store('service-requests/' . $serviceRequest->id, 'local');
                    $serviceRequest->documents()->create([
                        'file_path' => $path,
                        'original_name' => $file->getClientOriginalName(),
                        'verification_status' => 'pending',
                    ]);
                }
            }

            $serviceRequest->statusHistories()->create([
                'from_status' => null,
                'to_status' => ServiceRequestStatus::Submitted->value,
                'notes' => 'Pengajuan Reaktivasi KIS/PBI-JK diterima melalui portal publik.'
                    . ($isEmergency ? ' PRIORITAS DARURAT MEDIS.' : ''),
                'user_id' => auth()->id(),
            ]);

            $this->requestNumber = $requestNumber;
        });

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.portal.service-request.pbi-form', [
            'reasons' => PbiReason::cases(),
            'districts' => District::orderBy('name')->get(),
            'villages' => $this->districtId
                ? Village::where('district_id', $this->districtId)->orderBy('name')->get()
                : collect(),
        ]);
    }
}
