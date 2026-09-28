<?php

namespace App\Livewire\Portal;

use App\Models\Complaint;
use App\Models\ServiceRequest;
use App\Models\StatusHistory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('layouts.portal')]
#[Title('Cek Status Tiket — SAPA SOSIAL')]
class TrackTicket extends Component
{
    #[Url]
    public string $ticket = '';

    #[Url]
    public string $verifier = '';

    public bool $searched = false;

    public ?array $result = null;

    public function checkStatus(): void
    {
        $this->validate([
            'ticket' => 'required|string|min:5',
            'verifier' => 'required|string|size:4',
        ], [
            'ticket.required' => 'Nomor tiket wajib diisi.',
            'ticket.min' => 'Nomor tiket minimal 5 karakter.',
            'verifier.required' => '4 digit terakhir wajib diisi.',
            'verifier.size' => 'Harus tepat 4 digit.',
        ]);

        $this->searched = true;
        $this->result = null;

        // Try service_requests first
        $serviceRequest = ServiceRequest::where('request_number', $this->ticket)
            ->where(function ($q) {
                $q->where('applicant_nik', 'LIKE', '%' . $this->verifier)
                    ->orWhere('phone', 'LIKE', '%' . $this->verifier);
            })
            ->first();

        if ($serviceRequest) {
            $histories = StatusHistory::where('statusable_type', ServiceRequest::class)
                ->where('statusable_id', $serviceRequest->id)
                ->orderBy('created_at')
                ->get();

            $this->result = [
                'type' => 'service_request',
                'number' => $serviceRequest->request_number,
                'service_name' => $serviceRequest->serviceType?->name ?? '-',
                'applicant' => $serviceRequest->applicant_name,
                'nik_masked' => substr($serviceRequest->applicant_nik, 0, 4) . str_repeat('•', 8) . substr($serviceRequest->applicant_nik, -4),
                'submitted_at' => $serviceRequest->submitted_at?->translatedFormat('d F Y, H:i') . ' WIB',
                'village' => $serviceRequest->village?->name . ', Kec. ' . $serviceRequest->village?->district?->name,
                'status' => $serviceRequest->status->value,
                'status_label' => $serviceRequest->status->label(),
                'status_color' => $serviceRequest->status->color(),
                'officer' => $serviceRequest->officer?->name,
                'histories' => $histories->map(fn ($h) => [
                    'from' => $h->from_status,
                    'to' => $h->to_status,
                    'notes' => $h->notes,
                    'date' => $h->created_at->translatedFormat('d M Y, H:i') . ' WIB',
                    'user' => $h->user?->name,
                ])->toArray(),
            ];

            return;
        }

        // Try complaints
        $complaint = Complaint::where('complaint_number', $this->ticket)
            ->where(function ($q) {
                $q->where('reporter_phone', 'LIKE', '%' . $this->verifier);
            })
            ->first();

        if ($complaint) {
            $histories = StatusHistory::where('statusable_type', Complaint::class)
                ->where('statusable_id', $complaint->id)
                ->orderBy('created_at')
                ->get();

            $this->result = [
                'type' => 'complaint',
                'number' => $complaint->complaint_number,
                'service_name' => 'Pengaduan Sosial — ' . ($complaint->complaintCategory?->name ?? '-'),
                'applicant' => $complaint->reporter_name,
                'nik_masked' => null,
                'submitted_at' => $complaint->reported_at?->translatedFormat('d F Y, H:i') . ' WIB',
                'village' => $complaint->village?->name . ', Kec. ' . $complaint->village?->district?->name,
                'status' => $complaint->status->value,
                'status_label' => $complaint->status->label(),
                'status_color' => $complaint->status->color(),
                'officer' => $complaint->officer?->name,
                'histories' => $histories->map(fn ($h) => [
                    'from' => $h->from_status,
                    'to' => $h->to_status,
                    'notes' => $h->notes,
                    'date' => $h->created_at->translatedFormat('d M Y, H:i') . ' WIB',
                    'user' => $h->user?->name,
                ])->toArray(),
            ];
        }
    }

    public function render()
    {
        return view('livewire.portal.track-ticket');
    }
}
