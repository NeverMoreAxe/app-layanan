<div>
    {{-- Header --}}
    <section class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center gap-2 text-sm text-slate-500">
                <a href="/" wire:navigate class="hover:text-primary-600">Beranda</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="/layanan" wire:navigate class="hover:text-primary-600">Informasi Layanan</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-slate-800 font-medium">{{ $page->title }}</span>
            </div>
        </div>
    </section>

    {{-- Main Content --}}
    <section class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                {{-- Main Column --}}
                <div class="lg:col-span-2 space-y-8">
                    {{-- Title & Badges --}}
                    <div>
                        <div class="flex flex-wrap items-center gap-2 mb-3">
                            <span class="badge-success text-xs font-medium px-2.5 py-0.5 rounded-full">Layanan Aktif / Online</span>
                            @if ($page->serviceType)
                                <span class="badge-process text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $page->serviceType->category ?? 'Resmi Dinsos Kab. Blitar' }}</span>
                            @endif
                        </div>
                        <h1 class="text-2xl lg:text-3xl font-bold text-slate-800 mb-3">{{ $page->title }}</h1>
                        <p class="text-slate-500 leading-relaxed">{{ Str::limit(strip_tags($page->description), 200) }}</p>

                        @if ($page->serviceType)
                            <div class="flex flex-wrap gap-4 mt-4">
                                @if ($page->serviceType->sla_days)
                                    <div class="flex items-center gap-2 text-sm text-slate-600">
                                        <svg class="w-4 h-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Waktu Pelayanan: {{ $page->serviceType->sla_days }} Hari Kerja
                                    </div>
                                @endif
                                <div class="flex items-center gap-2 text-sm text-emerald-600">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Biaya Layanan: <strong>GRATIS (Rp 0)</strong>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Description --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6">
                        <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Deskripsi & Fungsi Layanan
                        </h2>
                        <div class="prose prose-sm prose-slate max-w-none">
                            {!! nl2br(e($page->description)) !!}
                        </div>
                    </div>

                    {{-- Requirements --}}
                    @if ($page->serviceType && $page->serviceType->requirements->count())
                        <div class="bg-white rounded-2xl border border-slate-200 p-6">
                            <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                Persyaratan Berkas Pengajuan
                            </h2>
                            <div class="space-y-4">
                                @foreach ($page->serviceType->requirements as $req)
                                    <div class="flex items-start gap-3 p-4 bg-slate-50 rounded-xl">
                                        <div class="p-1.5 bg-white rounded-lg border border-slate-200 shrink-0 mt-0.5">
                                            <svg class="w-4 h-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-sm text-slate-700 flex items-center gap-2">
                                                {{ $req->name }}
                                                @if ($req->is_mandatory)
                                                    <span class="text-xs text-red-600 font-medium">Wajib</span>
                                                @else
                                                    <span class="text-xs text-slate-400 font-medium">Opsional</span>
                                                @endif
                                            </div>
                                            @if ($req->allowed_mimes)
                                                <p class="text-xs text-slate-400 mt-0.5">Format: {{ strtoupper($req->allowed_mimes) }} (Maks. 2MB/berkas)</p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Procedure --}}
                    @if ($page->procedure)
                        <div class="bg-white rounded-2xl border border-slate-200 p-6">
                            <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                Tahapan & Alur Pelayanan
                            </h2>
                            <div class="prose prose-sm prose-slate max-w-none">
                                {!! nl2br(e($page->procedure)) !!}
                            </div>
                        </div>
                    @endif

                    {{-- Downloadable Forms --}}
                    @if ($page->forms->count())
                        <div class="bg-white rounded-2xl border border-slate-200 p-6">
                            <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Unduh Formulir & Template Terkait
                            </h2>
                            @foreach ($page->forms as $form)
                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl mb-3 last:mb-0">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-red-50 rounded-lg"><svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg></div>
                                        <div>
                                            <div class="font-medium text-sm text-slate-700">{{ $form->name }}</div>
                                            <div class="text-xs text-slate-400">Versi {{ $form->version }}</div>
                                        </div>
                                    </div>
                                    <a href="{{ Storage::url($form->file_path) }}" target="_blank" class="px-4 py-2 text-sm font-semibold text-primary-600 bg-primary-50 hover:bg-primary-100 rounded-lg transition-colors">Unduh Berkas</a>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- FAQs --}}
                    @if ($page->faqs->count())
                        <div class="bg-white rounded-2xl border border-slate-200 p-6">
                            <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Pertanyaan Seputar Layanan (FAQ)
                            </h2>
                            <div class="space-y-3" x-data="{ openFaq: null }">
                                @foreach ($page->faqs as $index => $faq)
                                    <div class="border border-slate-200 rounded-xl overflow-hidden">
                                        <button @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}" class="w-full text-left px-5 py-4 flex items-center justify-between gap-3 hover:bg-slate-50 transition-colors">
                                            <span class="font-medium text-sm text-slate-700">{{ $faq->question }}</span>
                                            <svg :class="{ 'rotate-180': openFaq === {{ $index }} }" class="w-5 h-5 text-slate-400 shrink-0 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        </button>
                                        <div x-show="openFaq === {{ $index }}" x-cloak x-collapse class="px-5 pb-4">
                                            <p class="text-sm text-slate-500 leading-relaxed">{!! nl2br(e($faq->answer)) !!}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
                    {{-- CTA Card --}}
                    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 sticky top-[180px]">
                        <p class="text-xs font-semibold text-amber-700 uppercase tracking-wider mb-1">Pelayanan Bebas Biaya</p>
                        <h3 class="text-lg font-bold text-slate-800 mb-4">Ajukan Surat Keterangan</h3>
                        @if ($page->serviceType?->handler?->value === 'dtsen')
                            <a href="/pengajuan/dtsen" wire:navigate class="block w-full py-3 text-center bg-amber-500 hover:bg-amber-400 text-slate-900 font-semibold rounded-xl transition-colors mb-3">
                                Ajukan Layanan Ini Sekarang →
                            </a>
                        @elseif ($page->serviceType?->handler?->value === 'pbi')
                            <a href="/pengajuan/pbi" wire:navigate class="block w-full py-3 text-center bg-amber-500 hover:bg-amber-400 text-slate-900 font-semibold rounded-xl transition-colors mb-3">
                                Ajukan Layanan Ini Sekarang →
                            </a>
                        @endif
                        <div class="space-y-2 text-xs text-slate-500">
                            @if ($page->serviceType?->sla_days)
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Estimasi Selesai: {{ $page->serviceType->sla_days }} Hari Kerja
                                </div>
                            @endif
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                Notifikasi otomatis via WhatsApp
                            </div>
                        </div>
                    </div>

                    {{-- Help Card --}}
                    <div class="bg-white border border-slate-200 rounded-2xl p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="p-1.5 bg-primary-50 rounded-lg"><svg class="w-4 h-4 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div>
                            <h3 class="font-bold text-sm text-slate-800">Pusat Bantuan & Helpdesk</h3>
                        </div>
                        <p class="text-sm text-slate-500 mb-4">Ada kendala terkait status DTKS atau syarat dokumen? Konsultasikan langsung dengan petugas helpdesk resmi.</p>
                        <a href="https://wa.me/6281234567890" target="_blank" class="flex items-center gap-2 text-sm font-semibold text-emerald-600 hover:text-emerald-700 bg-emerald-50 px-4 py-2.5 rounded-xl transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                            WhatsApp Hotline 0812-3456-7890
                        </a>
                        @if ($page->service_hours)
                            <p class="text-xs text-slate-400 mt-2">Jam Operasional: {{ $page->service_hours }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="lg:hidden h-16"></div>
</div>
