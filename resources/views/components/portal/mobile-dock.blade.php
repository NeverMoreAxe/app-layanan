{{-- Mobile Bottom Dock — visible only on mobile/tablet --}}
<div class="lg:hidden fixed bottom-0 inset-x-0 z-40 bg-white border-t border-slate-200 shadow-dock safe-area-pb">
    <div class="flex items-center justify-around h-16 px-2">
        {{-- Ajukan Layanan --}}
        <a href="/layanan" wire:navigate class="flex flex-col items-center gap-1 px-3 py-1 group">
            <div class="p-1.5 rounded-lg bg-amber-50 group-hover:bg-amber-100 transition-colors">
                <svg class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <span class="text-[10px] font-semibold text-slate-600 group-hover:text-amber-700">Ajukan</span>
        </a>

        {{-- Pengaduan --}}
        <a href="/pengaduan" wire:navigate class="flex flex-col items-center gap-1 px-3 py-1 group">
            <div class="p-1.5 rounded-lg bg-red-50 group-hover:bg-red-100 transition-colors">
                <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
            </div>
            <span class="text-[10px] font-semibold text-slate-600 group-hover:text-red-700">Pengaduan</span>
        </a>

        {{-- Cek Status --}}
        <a href="/cek-status" wire:navigate class="flex flex-col items-center gap-1 px-3 py-1 group">
            <div class="p-1.5 rounded-lg bg-primary-50 group-hover:bg-primary-100 transition-colors">
                <svg class="w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <span class="text-[10px] font-semibold text-slate-600 group-hover:text-primary-700">Cek Status</span>
        </a>
    </div>
</div>
