<?php

namespace App\Livewire\Portal;

use App\Models\ServiceType;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('layouts.portal')]
#[Title('Informasi Layanan — SAPA SOSIAL')]
class ServiceCatalog extends Component
{
    #[Url]
    public string $q = '';

    #[Url]
    public string $category = '';

    public function updatedQ(): void
    {
        $this->resetPage();
    }

    public function updatedCategory(): void
    {
        $this->resetPage();
    }

    public function setCategory(string $category): void
    {
        $this->category = $this->category === $category ? '' : $category;
    }

    private function resetPage(): void
    {
        // Placeholder for pagination reset if needed
    }

    public function render()
    {
        $query = ServiceType::where('is_active', true);

        if ($this->q) {
            $query->where(function ($q) {
                $q->where('name', 'ILIKE', "%{$this->q}%")
                    ->orWhere('description', 'ILIKE', "%{$this->q}%");
            });
        }

        if ($this->category) {
            $query->where('category', $this->category);
        }

        return view('livewire.portal.service-catalog', [
            'serviceTypes' => $query->get(),
            'categories' => ServiceType::where('is_active', true)
                ->select('category')
                ->distinct()
                ->pluck('category')
                ->filter(),
        ]);
    }
}
