<?php

namespace App\Livewire\Portal;

use App\Enums\ComplaintStatus;
use App\Models\Complaint;
use App\Models\ComplaintCategory;
use App\Models\District;
use App\Models\NumberSequence;
use App\Models\Village;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.portal')]
#[Title('Pengaduan Sosial — SAPA SOSIAL')]
class ComplaintForm extends Component
{
    use WithFileUploads;

    #[Validate('required|exists:complaint_categories,id')]
    public string $categoryId = '';

    #[Validate('required|exists:districts,id')]
    public string $districtId = '';

    #[Validate('required|exists:villages,id')]
    public string $villageId = '';

    #[Validate('required|string|min:10|max:1000')]
    public string $description = '';

    #[Validate('required|string|min:10')]
    public string $locationDetail = '';

    #[Validate('required|string|min:3')]
    public string $reporterName = '';

    #[Validate('required|string|regex:/^08[0-9]{8,13}$/')]
    public string $reporterPhone = '';

    /** @var array<\Livewire\Features\SupportFileUploads\TemporaryUploadedFile> */
    #[Validate(['attachments.*' => 'file|mimes:jpg,jpeg,png,pdf|max:5120'])]
    public array $attachments = [];

    public bool $submitted = false;

    public string $complaintNumber = '';

    public function updatedDistrictId(): void
    {
        $this->villageId = '';
    }

    public function removeAttachment(int $index): void
    {
        unset($this->attachments[$index]);
        $this->attachments = array_values($this->attachments);
    }

    public function submit(): void
    {
        $this->validate([
            'categoryId' => 'required|exists:complaint_categories,id',
            'districtId' => 'required|exists:districts,id',
            'villageId' => 'required|exists:villages,id',
            'description' => 'required|string|min:10|max:1000',
            'locationDetail' => 'required|string|min:10',
            'reporterName' => 'required|string|min:3',
            'reporterPhone' => ['required', 'string', 'regex:/^08[0-9]{8,13}$/'],
            'attachments.*' => 'file|mimes:jpg,jpeg,png,pdf|max:5120',
        ], [
            'categoryId.required' => 'Pilih kategori permasalahan.',
            'districtId.required' => 'Pilih kecamatan.',
            'villageId.required' => 'Pilih desa/kelurahan.',
            'description.required' => 'Deskripsi permasalahan wajib diisi.',
            'description.min' => 'Deskripsi minimal 10 karakter.',
            'locationDetail.required' => 'Alamat lokasi wajib diisi.',
            'locationDetail.min' => 'Alamat lokasi minimal 10 karakter.',
            'reporterName.required' => 'Nama pelapor wajib diisi.',
            'reporterPhone.required' => 'Nomor WhatsApp wajib diisi.',
            'reporterPhone.regex' => 'Format nomor HP tidak valid (contoh: 081234567890).',
        ]);

        DB::transaction(function () {
            $complaintNumber = NumberSequence::generateNumber('ADU');

            $complaint = Complaint::create([
                'complaint_number' => $complaintNumber,
                'complaint_category_id' => $this->categoryId,
                'reporter_id' => auth()->id(),
                'reporter_name' => $this->reporterName,
                'reporter_phone' => $this->reporterPhone,
                'location_detail' => $this->locationDetail,
                'village_id' => $this->villageId,
                'description' => $this->description,
                'reported_at' => now(),
                'status' => ComplaintStatus::Received,
            ]);

            foreach ($this->attachments as $file) {
                $path = $file->store('complaints/' . $complaint->id, 'local');
                $complaint->attachments()->create([
                    'file_path' => $path,
                    'type' => str_starts_with($file->getMimeType(), 'image/') ? 'photo' : 'document',
                ]);
            }

            $complaint->statusHistories()->create([
                'from_status' => null,
                'to_status' => ComplaintStatus::Received->value,
                'notes' => 'Pengaduan diterima melalui portal publik.',
                'user_id' => auth()->id(),
            ]);

            $this->complaintNumber = $complaintNumber;
        });

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.portal.complaint-form', [
            'categories' => ComplaintCategory::where('is_active', true)->get(),
            'districts' => District::orderBy('name')->get(),
            'villages' => $this->districtId
                ? Village::where('district_id', $this->districtId)->orderBy('name')->get()
                : collect(),
        ]);
    }
}
