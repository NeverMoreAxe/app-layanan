<?php

namespace App\Livewire\Portal;

use App\Enums\PublishStatus;
use App\Models\Faq;
use App\Models\InformationPage;
use App\Models\ServiceType;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.portal')]
#[Title('SAPA SOSIAL — Satu Pintu Layanan Sosial Kabupaten Blitar')]
class Home extends Component
{
    public string $searchQuery = '';

    public string $ticketNumber = '';

    public string $ticketVerifier = '';

    public function searchServices(): void
    {
        $this->redirect('/layanan?q=' . urlencode($this->searchQuery), navigate: true);
    }

    public function checkTicket(): void
    {
        if ($this->ticketNumber && $this->ticketVerifier) {
            $this->redirect('/cek-status?ticket=' . urlencode($this->ticketNumber) . '&verifier=' . urlencode($this->ticketVerifier), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.portal.home', [
            'serviceTypes' => ServiceType::where('is_active', true)->limit(6)->get(),
            'faqs' => Faq::where('is_active', true)->whereNull('information_page_id')->orderBy('sort_order')->limit(5)->get(),
            'latestInfos' => InformationPage::where('publish_status', PublishStatus::Published)->latest('published_at')->limit(3)->get(),
        ]);
    }
}
