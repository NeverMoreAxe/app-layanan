<?php

namespace App\Livewire\Portal;

use App\Models\Faq;
use App\Models\InformationPage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.portal')]
#[Title('Pertanyaan Umum (FAQ) — SAPA SOSIAL')]
class FaqPage extends Component
{
    public ?int $openFaq = null;

    public function toggleFaq(int $id): void
    {
        $this->openFaq = $this->openFaq === $id ? null : $id;
    }

    public function render()
    {
        return view('livewire.portal.faq-page', [
            'generalFaqs' => Faq::where('is_active', true)
                ->whereNull('information_page_id')
                ->orderBy('sort_order')
                ->get(),
            'serviceFaqs' => InformationPage::whereHas('faqs', fn ($q) => $q->where('is_active', true))
                ->with(['faqs' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
                ->get(),
        ]);
    }
}
