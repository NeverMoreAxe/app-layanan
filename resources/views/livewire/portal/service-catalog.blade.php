<div>
    {{-- Header --}}
    <section class="bg-gradient-to-r from-primary-700 to-primary-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center gap-2 text-white/70 text-sm mb-3">
                <a href="/" wire:navigate class="hover:text-white">Beranda</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white">Informasi Layanan</span>
            </div>
            <div class="flex items-start justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-1.5 bg-white/10 text-white/90 text-xs font-medium px-3 py-1 rounded-full mb-3">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Katalog Resmi & Terpadu · Versi 2026
                    </div>
                    <h1 class="text-3xl font-bold mb-2">Daftar Layanan Sosial Terpadu</h1>
                    <p class="text-white/80 max-w-xl">Pilih dan telusuri informasi persyaratan serta ajukan permohonan layanan publik Dinas Sosial Kabupaten Blitar secara daring, transparan, dan inklusif.</p>
                </div>
                <div class="hidden md:block bg-white/10 backdrop-blur-sm rounded-xl p-4 text-center min-w-[160px]">
                    <div class="text-xs text-white/60 mb-1">Layanan Daring Aktif</div>
                    <div class="text-3xl font-bold">{{ $serviceTypes->count() }}</div>
                    <div class="text-xs text-white/60 mt-1">Modul</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Search & Filters --}}
    <section class="bg-white border-b border-slate-200 sticky top-[105px] z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center gap-4 mb-3">
                <div class="flex-1 relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input wire:model.live.debounce.300ms="q" type="text" placeholder="Cari layanan, misalnya Surat DTSEN, KIS PBI, Kursi Roda, Bansos..." class="w-full pl-12 pr-4 py-3 border border-slate-300 rounded-xl text-sm input-focus">
                </div>
                @if ($q || $category)
                    <button wire:click="$set('q', ''); $set('category', '')" class="text-sm text-slate-500 hover:text-slate-700 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        Reset
                    </button>
                @endif
            </div>

            <div class="flex flex-wrap gap-2">
                <button wire:click="setCategory('')" @class([
                    'px-4 py-1.5 text-sm font-medium rounded-full transition-colors',
                    'bg-primary-600 text-white' => !$category,
                    'bg-slate-100 text-slate-600 hover:bg-slate-200' => $category,
                ])>
                    Semua Layanan ({{ $serviceTypes->count() }})
                </button>
                @foreach ($categories as $cat)
                    <button wire:click="setCategory('{{ $cat }}')" @class([
                        'px-4 py-1.5 text-sm font-medium rounded-full transition-colors',
                        'bg-primary-600 text-white' => $category === $cat,
                        'bg-slate-100 text-slate-600 hover:bg-slate-200' => $category !== $cat,
                    ])>
                        {{ $cat }}
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Service Cards Grid --}}
    <section class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <p class="text-sm text-slate-500">
                    <span class="inline-flex items-center gap-1.5"><span class="w-2 h-2 bg-primary-500 rounded-full"></span> Menampilkan {{ $serviceTypes->count() }} Layanan</span>
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($serviceTypes as $service)
                    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden card-hover">
                        <div class="h-40 bg-gradient-to-br from-primary-50 to-primary-100 flex items-center justify-center relative">
                            @if ($service->category)
                                <span class="absolute top-3 left-3 badge-process text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $service->category }}</span>
                            @endif
                            <svg class="w-16 h-16 text-primary-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-3">
                                @if ($service->sla_days)
                                    <span class="badge-process text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $service->sla_days }} Hari Kerja</span>
                                @endif
                                <span class="badge-success text-xs font-semibold px-2.5 py-0.5 rounded-full">GRATIS (Rp 0)</span>
                            </div>
                            <h3 class="font-bold text-lg text-slate-800 mb-2">{{ $service->name }}</h3>
                            <p class="text-sm text-slate-500 mb-4 line-clamp-2">{{ Str::limit($service->description, 100) }}</p>

                            @if ($service->requirements->count())
                                <div class="text-xs text-slate-400 mb-4 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                                    Syarat: {{ $service->requirements->take(3)->pluck('name')->join(', ') }}
                                </div>
                            @endif

                            <div class="flex gap-3">
                                @php
                                    $detailSlug = $service->informationPages()->where('publish_status', 'published')->value('slug');
                                @endphp
                                @if ($detailSlug)
                                    <a href="/layanan/{{ $detailSlug }}" wire:navigate class="flex-1 text-center py-2.5 text-sm font-medium border border-slate-200 rounded-xl text-slate-700 hover:bg-slate-50 transition-colors">Lihat Detail</a>
                                @endif
                                @if ($service->handler?->value === 'dtsen')
                                    <a href="/pengajuan/dtsen" wire:navigate class="flex-1 text-center py-2.5 text-sm font-semibold bg-amber-500 hover:bg-amber-400 text-slate-900 rounded-xl transition-colors">Ajukan</a>
                                @elseif ($service->handler?->value === 'pbi')
                                    <a href="/pengajuan/pbi" wire:navigate class="flex-1 text-center py-2.5 text-sm font-semibold bg-amber-500 hover:bg-amber-400 text-slate-900 rounded-xl transition-colors">Ajukan</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-3 text-center py-16">
                        <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <h3 class="text-lg font-semibold text-slate-600 mb-1">Layanan Tidak Ditemukan</h3>
                        <p class="text-sm text-slate-400">Coba kata kunci lain atau hapus filter pencarian.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Process Steps --}}
    <section class="py-16 bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-xs font-semibold text-primary-600 uppercase tracking-wider mb-1">Alur Permohonan Mandiri</p>
            <h2 class="text-2xl font-bold text-slate-800 mb-2">4 Langkah Cepat Mengurus Layanan Sosial</h2>
            <p class="text-slate-500 mb-10 max-w-lg mx-auto">Kemudahan pengurusan surat dan bantuan dari rumah tanpa perlu antre panjang di kantor dinas.</p>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ([
                    ['num' => '01', 'title' => 'Pilih Layanan', 'desc' => 'Telusuri katalog dan baca persyaratan administrasi surat/bantuan yang diperlukan.'],
                    ['num' => '02', 'title' => 'Unggah Berkas', 'desc' => 'Isi data identitas diri (NIK, KK) dan lampirkan foto/dokumen pengantar dari desa.'],
                    ['num' => '03', 'title' => 'Verifikasi Petugas', 'desc' => 'Tim verifikator Dinas Sosial memeriksa validitas data melalui SIKS-NG & kriteria lapangan.'],
                    ['num' => '04', 'title' => 'Selesai & Unduh', 'desc' => 'Surat terbit dengan TTE sah barcode digital, atau instruksi penyaluran bantuan langsung dijadwalkan.'],
                ] as $step)
                    <div>
                        <div class="text-4xl font-bold text-primary-100 mb-3">{{ $step['num'] }}</div>
                        <h3 class="font-bold text-slate-800 mb-2">{{ $step['title'] }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-12 bg-primary-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-white/10 rounded-xl">
                        <svg class="w-8 h-8 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">Tidak Menemukan Layanan yang Dicari?</h3>
                        <p class="text-white/70 text-sm mt-1">Hubungi layanan konsultasi pengaduan Halo Dinsos Blitar atau sampaikan permohonan khusus.</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <a href="/pengaduan" wire:navigate class="px-5 py-3 bg-amber-500 hover:bg-amber-400 text-slate-900 font-semibold rounded-xl transition-colors">Buka Loket Pengaduan</a>
                    <a href="https://wa.me/6281234567890" target="_blank" class="px-5 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl border border-white/20 transition-colors">WhatsApp Halo Dinsos</a>
                </div>
            </div>
        </div>
    </section>

    <div class="lg:hidden h-16"></div>
</div>
