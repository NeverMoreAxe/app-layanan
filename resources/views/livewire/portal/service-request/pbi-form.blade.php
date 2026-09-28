<div>
    {{-- Emergency Alert Top Strip --}}
    @if ($reason === 'emergency')
        <section class="bg-red-600 text-white py-2.5 px-4 text-xs font-medium">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-white animate-ping shrink-0"></span>
                    <span><strong>JALUR PRIORITAS GAWAT DARURAT:</strong> Berkas permohonan pasien opname/IGD akan segera diteruskan ke Tim Reaksi Cepat 24 Jam.</span>
                </div>
                <span class="hidden sm:inline-block bg-white/20 px-2.5 py-0.5 rounded-full font-bold uppercase tracking-wider text-[10px]">Prioritas 24 Jam</span>
            </div>
        </section>
    @endif

    {{-- Header --}}
    <section class="bg-gradient-to-r from-primary-700 to-primary-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center gap-2 text-white/70 text-sm mb-3">
                <a href="/" wire:navigate class="hover:text-white">Beranda</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="/layanan" wire:navigate class="hover:text-white">Layanan</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white">Reaktivasi KIS/PBI-JK</span>
            </div>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-1.5 bg-white/10 text-white/90 text-xs font-medium px-3 py-1 rounded-full mb-3">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Layanan Terpadu Dinsos & BPJS Kesehatan
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold mb-2">Formulir Reaktivasi KIS / PBI-JK Terpadu</h1>
                    <p class="text-white/80 max-w-xl text-sm sm:text-base">
                        Pengaktifan kembali kepesertaan Penerima Bantuan Iuran Jaminan Kesehatan bagi warga miskin dan rentan Kabupaten Blitar.
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center gap-1.5 bg-white/10 px-3.5 py-2 rounded-xl text-xs font-medium backdrop-blur-xs border border-white/20">
                        <svg class="w-4 h-4 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        SIKS-NG Aktif
                    </span>
                    <span class="inline-flex items-center gap-1.5 bg-white/10 px-3.5 py-2 rounded-xl text-xs font-medium backdrop-blur-xs border border-white/20">
                        <svg class="w-4 h-4 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        BPJS Cab. Kediri
                    </span>
                </div>
            </div>
        </div>
    </section>

    @if ($submitted)
        {{-- ==================== SUCCESS STATE ==================== --}}
        <section class="py-12 bg-slate-50">
            <div class="max-w-2xl mx-auto px-4 sm:px-6">
                <div class="bg-white rounded-3xl border border-slate-200 p-8 sm:p-10 shadow-sm text-center">
                    <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>

                    @if ($reason === 'emergency')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700 border border-red-200 mb-3">
                            <span class="w-2 h-2 rounded-full bg-red-600 animate-ping"></span>
                            Permohonan Prioritas Darurat Terkirim
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 mb-3">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Permohonan Berhasil Dikirim
                        </span>
                    @endif

                    <h2 class="text-2xl font-bold text-slate-800 mb-2">Permohonan Reaktivasi KIS Diterima</h2>
                    <p class="text-slate-600 text-sm mb-6 max-w-md mx-auto">
                        Petugas tim verifikasi sosial akan mencocokkan kepesertaan NIK Anda dengan database SIKS-NG Kementerian Sosial dan mengkoordinasikannya dengan BPJS Kesehatan.
                    </p>

                    {{-- Ticket Box --}}
                    <div class="bg-slate-50 border-2 border-dashed border-primary-300 rounded-2xl p-6 mb-8 text-left" x-data="{ copied: false }">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Nomor Tiket Reaktivasi</span>
                            <span class="text-xs font-semibold text-primary-600 bg-primary-50 px-2.5 py-0.5 rounded-full">Simpan Nomor Ini</span>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-2xl sm:text-3xl font-mono font-bold text-primary-700 tracking-wider">{{ $requestNumber }}</span>
                            <button
                                @click="navigator.clipboard.writeText('{{ $requestNumber }}'); copied = true; setTimeout(() => copied = false, 2500)"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-slate-200 hover:border-primary-400 text-slate-700 text-xs font-semibold rounded-xl transition-colors shadow-sm">
                                <svg x-show="!copied" class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                                <svg x-show="copied" x-cloak class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span x-text="copied ? 'Tersalin!' : 'Salin Tiket'"></span>
                            </button>
                        </div>
                        <div class="text-xs text-slate-500 mt-3 pt-3 border-t border-slate-200 flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Status usulan reaktivasi ke Kementerian Sosial RI dapat dipantau melalui fitur Cek Status.</span>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="/cek-status?ticket={{ $requestNumber }}" wire:navigate class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-500 text-white font-semibold rounded-xl transition-colors shadow-sm text-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            Lacak Status Permohonan
                        </a>
                        <a href="/" wire:navigate class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition-colors text-sm">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @else
        {{-- ==================== STEP PROGRESS ==================== --}}
        <section class="bg-white border-b border-slate-200 sticky top-16 z-30 shadow-xs">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
                    @php
                        $steps = [
                            1 => ['title' => 'Alasan Reaktivasi', 'desc' => 'Kondisi Medis'],
                            2 => ['title' => 'Data Pemohon & Peserta', 'desc' => 'Identitas Kartu'],
                            3 => ['title' => 'Faskes & Berkas', 'desc' => 'Surat Rawat & Dokumen'],
                            4 => ['title' => 'Tinjau & Kirim', 'desc' => 'Konfirmasi Akhir'],
                        ];
                    @endphp

                    @foreach ($steps as $stepNum => $step)
                        <button
                            type="button"
                            wire:click="goToStep({{ $stepNum }})"
                            @class([
                                'flex items-center gap-3 p-2.5 sm:p-3 rounded-xl text-left transition-all text-sm',
                                'cursor-pointer' => $stepNum < $currentStep,
                                'cursor-default' => $stepNum >= $currentStep,
                                'bg-primary-50 border border-primary-200' => $currentStep === $stepNum,
                                'bg-emerald-50/60 border border-emerald-100' => $currentStep > $stepNum,
                                'bg-slate-50 border border-slate-100 opacity-60' => $currentStep < $stepNum,
                            ])>
                            <div @class([
                                'w-8 h-8 rounded-full flex items-center justify-center font-bold text-xs shrink-0',
                                'bg-primary-600 text-white' => $currentStep === $stepNum,
                                'bg-emerald-600 text-white' => $currentStep > $stepNum,
                                'bg-slate-200 text-slate-600' => $currentStep < $stepNum,
                            ])>
                                @if ($currentStep > $stepNum)
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                @else
                                    {{ $stepNum }}
                                @endif
                            </div>
                            <div class="min-w-0">
                                <div @class([
                                    'text-xs font-bold truncate',
                                    'text-primary-700' => $currentStep === $stepNum,
                                    'text-emerald-700' => $currentStep > $stepNum,
                                    'text-slate-500' => $currentStep < $stepNum,
                                ])>
                                    Langkah {{ $stepNum }}
                                </div>
                                <div class="text-xs font-semibold text-slate-800 truncate hidden sm:block">{{ $step['title'] }}</div>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ==================== FORM BODY & SIDEBAR ==================== --}}
        <section class="py-8 bg-slate-50/60">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    {{-- Left: Form Step Body --}}
                    <div class="lg:col-span-8 space-y-6">

                        {{-- STEP 1: ALASAN REAKTIVASI --}}
                        @if ($currentStep === 1)
                            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center font-bold">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold text-slate-800">1. Alasan dan Kondisi Reaktivasi</h2>
                                            <p class="text-xs text-slate-500">Pilih kondisi medis pasien untuk penentuan prioritas penanganan oleh tim Dinsos</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-primary-50 text-primary-700 text-xs font-semibold rounded-full border border-primary-200">Wajib Dipilih</span>
                                </div>

                                {{-- Reasons Radio Cards --}}
                                <div class="space-y-3.5 mb-6">
                                    @php
                                        $reasonOptions = [
                                            [
                                                'val' => 'emergency',
                                                'title' => 'Kondisi Gawat Darurat Medis / Pasien Rawat Inap RS',
                                                'badge' => 'PRIORITAS 24 JAM',
                                                'badgeColor' => 'bg-red-100 text-red-800 border-red-200',
                                                'desc' => 'Diperuntukkan bagi pasien yang saat ini sedang menjalani opname rawat inap di IGD atau bangsal rumah sakit rujukan.',
                                            ],
                                            [
                                                'val' => 'chronic',
                                                'title' => 'Penyakit Kronis / Perlu Terapi Rutin',
                                                'badge' => 'Jalur Medis',
                                                'badgeColor' => 'bg-amber-100 text-amber-800 border-amber-200',
                                                'desc' => 'Untuk pasien dengan kebutuhan pengobatan rutin seperti hemodialisa (cuci darah), kemoterapi kanker, penyakit jantung, dll.',
                                            ],
                                            [
                                                'val' => 'catastrophic',
                                                'title' => 'Penyakit Katastropik Menahun',
                                                'badge' => 'Jalur Medis',
                                                'badgeColor' => 'bg-amber-100 text-amber-800 border-amber-200',
                                                'desc' => 'Pengobatan lanjutan untuk penyakit kritis berbiaya tinggi yang membutuhkan kepastian jaminan kesehatan PBI aktif.',
                                            ],
                                            [
                                                'val' => 'newborn',
                                                'title' => 'Bayi Baru Lahir dari Ibu Peserta PBI-JK Aktif',
                                                'badge' => 'Maks. 28 Hari Kelahiran',
                                                'badgeColor' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                'desc' => 'Pengusulan aktivasi otomatis jaminan kesehatan bayi baru lahir mengikuti keaktifan kepesertaan ibu kandung.',
                                            ],
                                            [
                                                'val' => 'other',
                                                'title' => 'Kebutuhan Pengobatan Berjalan Lainnya',
                                                'badge' => 'Reguler Non-Opname',
                                                'badgeColor' => 'bg-slate-100 text-slate-700 border-slate-200',
                                                'desc' => 'Pemeriksaan rawat jalan untuk warga rentan/miskin yang kartu KIS dinonaktifkan tanpa sengaja.',
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($reasonOptions as $opt)
                                        <label
                                            @class([
                                                'relative flex items-start gap-4 p-4 rounded-2xl border-2 cursor-pointer transition-all',
                                                'border-red-500 bg-red-50/50 shadow-xs' => $reason === $opt['val'] && $opt['val'] === 'emergency',
                                                'border-primary-600 bg-primary-50/40 shadow-xs' => $reason === $opt['val'] && $opt['val'] !== 'emergency',
                                                'border-slate-200 bg-white hover:border-slate-300 hover:bg-slate-50/60' => $reason !== $opt['val'],
                                            ])>
                                            <input
                                                type="radio"
                                                name="reason"
                                                value="{{ $opt['val'] }}"
                                                wire:model.live="reason"
                                                class="sr-only">
                                            <div class="pt-0.5">
                                                <div @class([
                                                    'w-5 h-5 rounded-full border flex items-center justify-center text-xs shrink-0',
                                                    'border-red-600 bg-red-600 text-white' => $reason === $opt['val'] && $opt['val'] === 'emergency',
                                                    'border-primary-600 bg-primary-600 text-white' => $reason === $opt['val'] && $opt['val'] !== 'emergency',
                                                    'border-slate-300 bg-white' => $reason !== $opt['val'],
                                                ])>
                                                    @if ($reason === $opt['val'])
                                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex flex-wrap items-center justify-between gap-2 mb-1">
                                                    <span class="font-bold text-sm text-slate-800">{{ $opt['title'] }}</span>
                                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full border {{ $opt['badgeColor'] }}">{{ $opt['badge'] }}</span>
                                                </div>
                                                <p class="text-xs text-slate-600 leading-relaxed">{{ $opt['desc'] }}</p>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                @error('reason') <p class="text-red-600 text-xs mb-4">{{ $message }}</p> @enderror

                                @if (in_array($reason, ['emergency', 'chronic', 'catastrophic']))
                                    <div class="p-4 bg-amber-50 rounded-xl border border-amber-200 flex items-start gap-3">
                                        <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <div class="text-xs text-amber-800">
                                            <strong>Perhatian Dokumen Medis:</strong> Anda akan diminta melampirkan Surat Keterangan Rawat Inap / Surat Keterangan Sakit dari Fasilitas Kesehatan (RS/Puskesmas) pada Langkah 3.
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif

                        {{-- STEP 2: DATA PESERTA & PEMOHON --}}
                        @if ($currentStep === 2)
                            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center font-bold">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold text-slate-800">2. Data Pemohon & Peserta KIS</h2>
                                            <p class="text-xs text-slate-500">Lengkapi data pemohon dan identitas kepesertaan kartu BPJS/KIS yang dinonaktifkan</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-primary-50 text-primary-700 text-xs font-semibold rounded-full border border-primary-200">Langkah 2</span>
                                </div>

                                {{-- Bagian A: Data Pemohon --}}
                                <div class="mb-8">
                                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4 flex items-center gap-2">
                                        <span>Bagian A: Identitas Pemohon</span>
                                        <div class="flex-1 h-px bg-slate-200"></div>
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap Pemohon <span class="text-red-500">*</span></label>
                                            <input type="text" wire:model="applicantName" placeholder="Nama lengkap sesuai KTP" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                            @error('applicantName') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">NIK Pemohon (16 Digit) <span class="text-red-500">*</span></label>
                                            <input type="text" maxlength="16" wire:model="applicantNik" placeholder="3505xxxxxxxxxxxx" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm font-mono input-focus">
                                            @error('applicantNik') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor Kartu Keluarga (16 Digit) <span class="text-red-500">*</span></label>
                                            <input type="text" maxlength="16" wire:model="familyCardNumber" placeholder="3505xxxxxxxxxxxx" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm font-mono input-focus">
                                            @error('familyCardNumber') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kecamatan Domisili <span class="text-red-500">*</span></label>
                                            <select wire:model.live="districtId" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                                <option value="">-- Pilih Kecamatan --</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('districtId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Desa / Kelurahan <span class="text-red-500">*</span></label>
                                            <select wire:model="villageId" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus" {{ empty($districtId) ? 'disabled' : '' }}>
                                                <option value="">{{ empty($districtId) ? '-- Pilih Kecamatan Terlebih Dahulu --' : '-- Pilih Desa / Kelurahan --' }}</option>
                                                @foreach ($villages as $village)
                                                    <option value="{{ $village->id }}">{{ $village->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('villageId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Lengkap <span class="text-red-500">*</span></label>
                                            <input type="text" wire:model="address" placeholder="RT/RW, Dusun / Jalan" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                            @error('address') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor WhatsApp Aktif <span class="text-red-500">*</span></label>
                                            <input type="tel" wire:model="phone" placeholder="Contoh: 081234567890" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                            @error('phone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Bagian B: Data Peserta yang Diusulkan Reaktivasi --}}
                                <div>
                                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-4 flex items-center gap-2">
                                        <span>Bagian B: Data Peserta KIS / PBI-JK</span>
                                        <div class="flex-1 h-px bg-slate-200"></div>
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Peserta KIS (Pasien) <span class="text-red-500">*</span></label>
                                            <input type="text" wire:model="participantName" placeholder="Nama peserta sesuai kartu BPJS/KIS" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                            @error('participantName') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">NIK Peserta (16 Digit) <span class="text-red-500">*</span></label>
                                            <input type="text" maxlength="16" wire:model="participantNik" placeholder="3505xxxxxxxxxxxx" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm font-mono input-focus">
                                            @error('participantNik') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor Kartu BPJS / KIS (13 Digit) <span class="text-red-500">*</span></label>
                                            <input type="text" wire:model="bpjsCardNumber" placeholder="Contoh: 0001234567890" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm font-mono input-focus">
                                            @error('bpjsCardNumber') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div class="md:col-span-2">
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Perkiraan Tanggal Kartu Nonaktif / Mengetahui Sakit <span class="text-red-500">*</span></label>
                                            <input type="date" wire:model="deactivatedDate" max="{{ date('Y-m-d') }}" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                            @error('deactivatedDate') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- STEP 3: FASKES & DOKUMEN BERKAS --}}
                        @if ($currentStep === 3)
                            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center font-bold">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold text-slate-800">3. Informasi Faskes & Unggah Berkas</h2>
                                            <p class="text-xs text-slate-500">Isi data rumah sakit/klinik dan unggah dokumen pendukung (maks. 3MB per file)</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-primary-50 text-primary-700 text-xs font-semibold rounded-full border border-primary-200">Langkah 3</span>
                                </div>

                                {{-- Faskes Inputs --}}
                                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200 mb-6 space-y-4">
                                    <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Fasilitas Kesehatan Penanganan (Opsional / Jika Ada)</h3>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Faskes / RS Rujukan</label>
                                            <input type="text" wire:model="healthFacilityName" placeholder="Contoh: RSUD Ngudi Waluyo Wlingi" class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor Surat Keterangan Rawat / Faskes</label>
                                            <input type="text" wire:model="healthLetterNumber" placeholder="Nomor surat dari dokter / faskes" class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                        </div>
                                    </div>
                                </div>

                                {{-- File Uploads --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    {{-- KTP --}}
                                    <div class="border border-slate-200 rounded-2xl p-4 bg-slate-50/50">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs font-bold text-slate-800">KTP Pemohon / Peserta <span class="text-red-500">*</span></span>
                                            <span class="text-[10px] text-slate-400">Maks. 3MB</span>
                                        </div>
                                        <input type="file" wire:model="ktpFile" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-xs">
                                        <div wire:loading wire:target="ktpFile" class="text-xs text-primary-600 mt-1">Mengunggah KTP...</div>
                                        @if ($ktpFile)
                                            <div class="mt-2 text-xs text-emerald-700 font-medium truncate flex items-center justify-between">
                                                <span>✓ {{ $ktpFile->getClientOriginalName() }}</span>
                                                <button type="button" wire:click="$set('ktpFile', null)" class="text-red-500">Hapus</button>
                                            </div>
                                        @endif
                                        @error('ktpFile') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- KK --}}
                                    <div class="border border-slate-200 rounded-2xl p-4 bg-slate-50/50">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs font-bold text-slate-800">Kartu Keluarga (KK) <span class="text-red-500">*</span></span>
                                            <span class="text-[10px] text-slate-400">Maks. 3MB</span>
                                        </div>
                                        <input type="file" wire:model="kkFile" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-xs">
                                        <div wire:loading wire:target="kkFile" class="text-xs text-primary-600 mt-1">Mengunggah KK...</div>
                                        @if ($kkFile)
                                            <div class="mt-2 text-xs text-emerald-700 font-medium truncate flex items-center justify-between">
                                                <span>✓ {{ $kkFile->getClientOriginalName() }}</span>
                                                <button type="button" wire:click="$set('kkFile', null)" class="text-red-500">Hapus</button>
                                            </div>
                                        @endif
                                        @error('kkFile') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- Kartu BPJS --}}
                                    <div class="border border-slate-200 rounded-2xl p-4 bg-slate-50/50">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs font-bold text-slate-800">Foto Kartu BPJS / KIS (Jika Ada)</span>
                                            <span class="text-[10px] text-slate-400">Opsional</span>
                                        </div>
                                        <input type="file" wire:model="bpjsCardFile" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-xs">
                                        <div wire:loading wire:target="bpjsCardFile" class="text-xs text-primary-600 mt-1">Mengunggah Kartu BPJS...</div>
                                        @if ($bpjsCardFile)
                                            <div class="mt-2 text-xs text-emerald-700 font-medium truncate flex items-center justify-between">
                                                <span>✓ {{ $bpjsCardFile->getClientOriginalName() }}</span>
                                                <button type="button" wire:click="$set('bpjsCardFile', null)" class="text-red-500">Hapus</button>
                                            </div>
                                        @endif
                                        @error('bpjsCardFile') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- Surat Medis / Opname --}}
                                    <div class="border border-slate-200 rounded-2xl p-4 bg-slate-50/50">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs font-bold text-slate-800">
                                                Surat Keterangan Rawat Inap / Medis
                                                @if (in_array($reason, ['emergency', 'chronic', 'catastrophic']))
                                                    <span class="text-red-500">*</span>
                                                @else
                                                    <span class="text-slate-400 font-normal">(Opsional)</span>
                                                @endif
                                            </span>
                                            <span class="text-[10px] text-slate-400">Maks. 3MB</span>
                                        </div>
                                        <input type="file" wire:model="healthLetterFile" accept=".jpg,.jpeg,.png,.pdf" class="w-full text-xs">
                                        <div wire:loading wire:target="healthLetterFile" class="text-xs text-primary-600 mt-1">Mengunggah Surat Medis...</div>
                                        @if ($healthLetterFile)
                                            <div class="mt-2 text-xs text-emerald-700 font-medium truncate flex items-center justify-between">
                                                <span>✓ {{ $healthLetterFile->getClientOriginalName() }}</span>
                                                <button type="button" wire:click="$set('healthLetterFile', null)" class="text-red-500">Hapus</button>
                                            </div>
                                        @endif
                                        @error('healthLetterFile') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- STEP 4: TINJAU & KIRIM --}}
                        @if ($currentStep === 4)
                            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center font-bold">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold text-slate-800">4. Tinjau Data Permohonan Reaktivasi</h2>
                                            <p class="text-xs text-slate-500">Pastikan seluruh data pasien dan kartu BPJS terisi akurat</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-amber-100 text-amber-800 text-xs font-semibold rounded-full border border-amber-200">Langkah Terakhir</span>
                                </div>

                                <div class="space-y-5 text-xs">
                                    {{-- Reason Card --}}
                                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Alasan Reaktivasi Terpilih</span>
                                            <button type="button" wire:click="goToStep(1)" class="text-primary-600 font-semibold hover:underline">Ubah</button>
                                        </div>
                                        <div class="font-bold text-slate-800 text-sm">
                                            @php
                                                $reasonEnum = \App\Enums\PbiReason::tryFrom($reason);
                                            @endphp
                                            {{ $reasonEnum?->label() ?? $reason }}
                                        </div>
                                        @if ($reason === 'emergency')
                                            <span class="inline-block mt-2 px-2.5 py-0.5 rounded-full bg-red-100 text-red-800 font-bold text-[10px]">JALUR PRIORITAS DARURAT MEDIS 24 JAM</span>
                                        @endif
                                    </div>

                                    {{-- Participant Card --}}
                                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Data Peserta & Kartu KIS</span>
                                            <button type="button" wire:click="goToStep(2)" class="text-primary-600 font-semibold hover:underline">Ubah</button>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <div>
                                                <span class="text-slate-400 block mb-0.5">Nama Peserta (Pasien):</span>
                                                <span class="font-semibold text-slate-800">{{ $participantName }}</span>
                                            </div>
                                            <div>
                                                <span class="text-slate-400 block mb-0.5">NIK Peserta:</span>
                                                <span class="font-mono font-semibold text-slate-800">{{ $participantNik }}</span>
                                            </div>
                                            <div>
                                                <span class="text-slate-400 block mb-0.5">Nomor Kartu BPJS / KIS:</span>
                                                <span class="font-mono font-bold text-primary-700">{{ $bpjsCardNumber }}</span>
                                            </div>
                                            <div>
                                                <span class="text-slate-400 block mb-0.5">Tanggal Nonaktif:</span>
                                                <span class="font-semibold text-slate-800">{{ $deactivatedDate }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Faskes and Docs --}}
                                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Faskes & Dokumen Terlampir</span>
                                            <button type="button" wire:click="goToStep(3)" class="text-primary-600 font-semibold hover:underline">Ubah</button>
                                        </div>
                                        <div class="text-slate-700 mb-2">
                                            <strong>Faskes:</strong> {{ $healthFacilityName ?: '-' }} · <strong>No. Surat:</strong> {{ $healthLetterNumber ?: '-' }}
                                        </div>
                                        <div class="flex flex-wrap gap-2 pt-2 border-t border-slate-200">
                                            <span class="px-2.5 py-1 bg-white border border-slate-200 rounded-lg text-slate-700">KTP: {{ $ktpFile ? '✓ Ada' : '✗ Belum' }}</span>
                                            <span class="px-2.5 py-1 bg-white border border-slate-200 rounded-lg text-slate-700">KK: {{ $kkFile ? '✓ Ada' : '✗ Belum' }}</span>
                                            <span class="px-2.5 py-1 bg-white border border-slate-200 rounded-lg text-slate-700">Kartu BPJS: {{ $bpjsCardFile ? '✓ Ada' : '-' }}</span>
                                            <span class="px-2.5 py-1 bg-white border border-slate-200 rounded-lg text-slate-700">Surat Faskes: {{ $healthLetterFile ? '✓ Ada' : '-' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- Action Buttons --}}
                        <div class="bg-white rounded-2xl border border-slate-200 p-4 sm:p-5 flex flex-col sm:flex-row items-center justify-between gap-3 shadow-xs">
                            @if ($currentStep > 1)
                                <button
                                    type="button"
                                    wire:click="previousStep"
                                    class="w-full sm:w-auto px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl text-sm transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                    Sebelumnya
                                </button>
                            @else
                                <div></div>
                            @endif

                            @if ($currentStep < $totalSteps)
                                <button
                                    type="button"
                                    wire:click="nextStep"
                                    class="w-full sm:w-auto px-8 py-3 bg-primary-600 hover:bg-primary-500 text-white font-semibold rounded-xl text-sm transition-colors shadow-sm flex items-center justify-center gap-2">
                                    Lanjutkan
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            @else
                                <button
                                    type="button"
                                    wire:click="submit"
                                    wire:loading.attr="disabled"
                                    class="w-full sm:w-auto px-10 py-3.5 bg-amber-500 hover:bg-amber-400 active:bg-amber-600 text-slate-900 font-bold rounded-xl text-sm transition-all shadow-md flex items-center justify-center gap-2">
                                    <span wire:loading.remove wire:target="submit">Ajukan Reaktivasi Sekarang</span>
                                    <span wire:loading wire:target="submit" class="flex items-center gap-2">
                                        <svg class="w-4 h-4 animate-spin text-slate-900" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        Sedang Memproses...
                                    </span>
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- Right: Sticky Summary Sidebar --}}
                    <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">
                        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs">
                            <div class="flex items-center gap-2 pb-3 border-b border-slate-100 mb-4">
                                <svg class="w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                <h3 class="font-bold text-slate-800 text-sm">Ringkasan Reaktivasi</h3>
                            </div>

                            <div class="space-y-3 text-xs">
                                <div class="bg-slate-50 p-3 rounded-xl">
                                    <span class="text-slate-400 block mb-0.5">Program:</span>
                                    <span class="font-bold text-slate-800">Reaktivasi KIS / PBI-JK Terpadu</span>
                                </div>

                                <div class="bg-slate-50 p-3 rounded-xl">
                                    <span class="text-slate-400 block mb-0.5">Prioritas:</span>
                                    <span class="font-bold {{ $reason === 'emergency' ? 'text-red-600' : 'text-primary-700' }}">
                                        {{ $reason === 'emergency' ? 'Darurat Medis (24 Jam)' : 'Reguler Terjadwal' }}
                                    </span>
                                </div>

                                <div class="bg-slate-50 p-3 rounded-xl">
                                    <span class="text-slate-400 block mb-0.5">Biaya Reaktivasi:</span>
                                    <span class="font-bold text-emerald-600 text-sm">Rp 0,- (Gratis Tanpa Biaya)</span>
                                </div>
                            </div>
                        </div>

                        {{-- Quick Helpdesk Contact --}}
                        <div class="bg-amber-50/70 border border-amber-200 rounded-2xl p-5 flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                            </div>
                            <div class="text-xs">
                                <div class="font-bold text-amber-900 mb-0.5">Pasien Kritis Butuh Surat Cepat?</div>
                                <p class="text-amber-800 leading-relaxed mb-2">Segera hubungi tim siaga Dinsos di hotline darurat atau dampingi keluarga pasien dengan nomor tiket yang didapat.</p>
                                <a href="https://wa.me/6281234567890?text=Halo%20Dinsos,%20saya%20butuh%20bantuan%20reaktivasi%20darurat" target="_blank" class="inline-flex items-center gap-1 font-bold text-primary-700 hover:underline">
                                    Chat Petugas Siaga &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <div class="lg:hidden h-16"></div>
</div>
