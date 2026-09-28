<?php

namespace App\Livewire\Portal;

use App\Enums\PublishStatus;
use App\Models\InformationPage;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.portal')]
class ServiceDetail extends Component
{
    public InformationPage $page;

    public function mount(string $slug): void
    {
        $this->page = InformationPage::where('slug', $slug)
            ->where('publish_status', PublishStatus::Published)
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.portal.service-detail', [
            'page' => $this->page->load(['serviceType.requirements', 'forms' => fn ($q) => $q->where('is_current', true), 'faqs' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')]),
        ])->title($this->page->title . ' — SAPA SOSIAL');
    }
}
