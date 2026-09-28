<div>
    {{-- Header --}}
    <section class="bg-gradient-to-r from-primary-700 to-primary-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center gap-2 text-white/70 text-sm mb-3">
                <a href="/" wire:navigate class="hover:text-white">Beranda</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="/layanan" wire:navigate class="hover:text-white">Layanan</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white">Pengajuan DTSEN</span>
            </div>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-1.5 bg-white/10 text-white/90 text-xs font-medium px-3 py-1 rounded-full mb-3">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Layanan Resmi Dinas Sosial Kabupaten Blitar
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold mb-2">Formulir Pengajuan Surat Keterangan DTSEN</h1>
                    <p class="text-white/80 max-w-xl text-sm sm:text-base">
                        Lengkapi data dan unggah berkas asli. Seluruh proses tidak dipungut biaya (<span class="font-semibold text-amber-300">100% Gratis</span>).
                    </p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl px-5 py-4 flex items-center gap-4 shrink-0">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-xs text-white/70">Estimasi Penerbitan</div>
                        <div class="text-xl font-bold text-white">1 Hari Kerja</div>
                        <div class="text-xs text-emerald-300">TTE BSrE Terintegrasi</div>
                    </div>
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

                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 mb-3">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Permohonan Berhasil Dikirim
                    </span>

                    <h2 class="text-2xl font-bold text-slate-800 mb-2">Terima Kasih, Permohonan Anda Telah Kami Terima!</h2>
                    <p class="text-slate-600 text-sm mb-6 max-w-md mx-auto">
                        Petugas verifikator Dinas Sosial Kabupaten Blitar akan memeriksa kesesuaian berkas Anda. Pemberitahuan progres akan dikirim via WhatsApp.
                    </p>

                    {{-- Ticket Box --}}
                    <div class="bg-slate-50 border-2 border-dashed border-primary-300 rounded-2xl p-6 mb-8 text-left" x-data="{ copied: false }">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Nomor Tiket Permohonan</span>
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
                            <span>Gunakan nomor tiket ini dan 4 digit terakhir NIK Anda untuk melacak status verifikasi permohonan.</span>
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
                            1 => ['title' => 'Tujuan Surat', 'desc' => 'Peruntukan Dokumen'],
                            2 => ['title' => 'Data Pemohon', 'desc' => 'Identitas & Domisili'],
                            3 => ['title' => 'Orang & Berkas', 'desc' => 'Subjek & Upload'],
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

                        {{-- STEP 1: TUJUAN PENGGUNAAN SURAT --}}
                        @if ($currentStep === 1)
                            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center font-bold">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold text-slate-800">1. Pilih Tujuan Penggunaan Surat</h2>
                                            <p class="text-xs text-slate-500">Tentukan peruntukan administrasi agar format surat sesuai persyaratan instansi penerima</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-primary-50 text-primary-700 text-xs font-semibold rounded-full border border-primary-200">Wajib Dipilih</span>
                                </div>

                                {{-- Purpose Radio Cards Grid --}}
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                                    @foreach ($purposes as $purpose)
                                        <label
                                            @class([
                                                'relative flex flex-col p-4 rounded-xl border-2 cursor-pointer transition-all',
                                                'border-primary-600 bg-primary-50/40 shadow-xs' => $purposeId == $purpose->id,
                                                'border-slate-200 bg-white hover:border-slate-300 hover:bg-slate-50/50' => $purposeId != $purpose->id,
                                            ])>
                                            <input
                                                type="radio"
                                                name="purpose"
                                                value="{{ $purpose->id }}"
                                                wire:model.live="purposeId"
                                                class="sr-only">
                                            <div class="flex items-start justify-between mb-2">
                                                <div @class([
                                                    'w-9 h-9 rounded-lg flex items-center justify-center',
                                                    'bg-primary-600 text-white' => $purposeId == $purpose->id,
                                                    'bg-slate-100 text-slate-600' => $purposeId != $purpose->id,
                                                ])>
                                                    @if (str_contains(strtolower($purpose->code ?? $purpose->name), 'spmb') || str_contains(strtolower($purpose->name), 'sekolah'))
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 14l9-5-9-5-9 5 9 5z"/><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                                                    @elseif (str_contains(strtolower($purpose->code ?? $purpose->name), 'kip') || str_contains(strtolower($purpose->name), 'kuliah'))
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                                    @elseif (str_contains(strtolower($purpose->code ?? $purpose->name), 'kesehatan') || str_contains(strtolower($purpose->name), 'rs'))
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                                                    @else
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                    @endif
                                                </div>
                                                <div @class([
                                                    'w-5 h-5 rounded-full border flex items-center justify-center text-xs',
                                                    'border-primary-600 bg-primary-600 text-white' => $purposeId == $purpose->id,
                                                    'border-slate-300 bg-white' => $purposeId != $purpose->id,
                                                ])>
                                                    @if ($purposeId == $purpose->id)
                                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="font-bold text-sm text-slate-800 mb-1">{{ $purpose->name }}</div>
                                            <div class="text-xs text-slate-500">Maks. Desil: {{ $purpose->max_decile ?? 'Semua' }} · Berlaku {{ $purpose->validity_days ?? 30 }} hari</div>
                                        </label>
                                    @endforeach
                                </div>
                                @error('purposeId') <p class="text-red-600 text-xs mb-4">{{ $message }}</p> @enderror

                                {{-- Optional purpose note --}}
                                <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Keterangan Tambahan / Nama Sekolah / Instansi Tujuan (Opsional)</label>
                                    <input
                                        type="text"
                                        wire:model="purposeDescription"
                                        placeholder="Contoh: Pendaftaran PPDB SMAN 1 Talun Jalur Afirmasi 2026"
                                        class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                    <p class="text-[11px] text-slate-500 mt-1">Sebutkan nama instansi agar dicantumkan pada konsideran surat keterangan resmi.</p>
                                </div>
                            </div>
                        @endif

                        {{-- STEP 2: DATA PEMOHON --}}
                        @if ($currentStep === 2)
                            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center font-bold">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold text-slate-800">2. Identitas Lengkap Pemohon</h2>
                                            <p class="text-xs text-slate-500">Pastikan NIK dan nomor KK sesuai dengan KTP-el resmi Kabupaten Blitar</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-primary-50 text-primary-700 text-xs font-semibold rounded-full border border-primary-200">Langkah 2</span>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    {{-- Nama Lengkap --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap Pemohon (Sesuai KTP) <span class="text-red-500">*</span></label>
                                        <input
                                            type="text"
                                            wire:model="applicantName"
                                            placeholder="Contoh: Budi Santoso"
                                            class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                        @error('applicantName') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- NIK --}}
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor Induk Kependudukan (NIK 16 Digit) <span class="text-red-500">*</span></label>
                                        <input
                                            type="text"
                                            maxlength="16"
                                            wire:model="applicantNik"
                                            placeholder="3505xxxxxxxxxxxx"
                                            class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm font-mono input-focus">
                                        @error('applicantNik') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- Nomor Kartu Keluarga --}}
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor Kartu Keluarga (KK 16 Digit) <span class="text-red-500">*</span></label>
                                        <input
                                            type="text"
                                            maxlength="16"
                                            wire:model="familyCardNumber"
                                            placeholder="3505xxxxxxxxxxxx"
                                            class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm font-mono input-focus">
                                        @error('familyCardNumber') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- Kecamatan --}}
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kecamatan Domisili <span class="text-red-500">*</span></label>
                                        <select
                                            wire:model.live="districtId"
                                            class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                            <option value="">-- Pilih Kecamatan --</option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('districtId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- Desa / Kelurahan --}}
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Desa / Kelurahan <span class="text-red-500">*</span></label>
                                        <select
                                            wire:model="villageId"
                                            class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus"
                                            {{ empty($districtId) ? 'disabled' : '' }}>
                                            <option value="">{{ empty($districtId) ? '-- Pilih Kecamatan Terlebih Dahulu --' : '-- Pilih Desa / Kelurahan --' }}</option>
                                            @foreach ($villages as $village)
                                                <option value="{{ $village->id }}">{{ $village->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('villageId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- Alamat Lengkap --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Lengkap (RT/RW, Dusun/Jalan) <span class="text-red-500">*</span></label>
                                        <textarea
                                            wire:model="address"
                                            rows="2"
                                            placeholder="Contoh: RT 02 RW 03 Dusun Krajan"
                                            class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus"></textarea>
                                        @error('address') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- No WhatsApp --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor WhatsApp Aktif <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                                <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                                            </div>
                                            <input
                                                type="tel"
                                                wire:model="phone"
                                                placeholder="Contoh: 081234567890"
                                                class="w-full pl-12 pr-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-1">Nomor tiket dan link berkas surat TTE resmi akan dikirim otomatis ke nomor ini.</p>
                                        @error('phone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>
                        @endif

                        {{-- STEP 3: ORANG YANG DITERANGKAN & BERKAS --}}
                        @if ($currentStep === 3)
                            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center font-bold">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold text-slate-800">3. Orang yang Diterangkan & Unggah Berkas</h2>
                                            <p class="text-xs text-slate-500">Tentukan subjek surat keterangan dan lampirkan bukti dokumen KTP serta KK asli</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-primary-50 text-primary-700 text-xs font-semibold rounded-full border border-primary-200">Langkah 3</span>
                                </div>

                                {{-- Checkbox Same As Applicant --}}
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mb-6">
                                    <label class="flex items-start gap-3 cursor-pointer">
                                        <input
                                            type="checkbox"
                                            wire:model.live="sameAsApplicant"
                                            class="w-5 h-5 rounded text-primary-600 focus:ring-primary-500 border-slate-300 mt-0.5">
                                        <div>
                                            <div class="text-sm font-bold text-slate-800">Orang yang diterangkan sama dengan Pemohon</div>
                                            <p class="text-xs text-slate-500 mt-0.5">Hilangkan centang jika Anda menguruskan surat untuk anak, orang tua, atau anggota keluarga lain dalam 1 KK.</p>
                                        </div>
                                    </label>
                                </div>

                                {{-- Subject Details (if different) --}}
                                @if (!$sameAsApplicant)
                                    <div class="bg-amber-50/50 border border-amber-200/80 rounded-2xl p-5 mb-6 space-y-4">
                                        <h3 class="text-xs font-bold text-amber-800 uppercase tracking-wider flex items-center gap-1.5">
                                            <svg class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            Identitas Subjek (Orang yang Diterangkan)
                                        </h3>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Orang yang Diterangkan <span class="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    wire:model="subjectName"
                                                    placeholder="Nama lengkap anak / keluarga"
                                                    class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                                @error('subjectName') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                            </div>
                                            <div>
                                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">NIK Orang yang Diterangkan (16 Digit) <span class="text-red-500">*</span></label>
                                                <input
                                                    type="text"
                                                    maxlength="16"
                                                    wire:model="subjectNik"
                                                    placeholder="3505xxxxxxxxxxxx"
                                                    class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm font-mono input-focus">
                                                @error('subjectNik') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Hubungan dengan Pemohon <span class="text-red-500">*</span></label>
                                                <select
                                                    wire:model="relationship"
                                                    class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                                    <option value="">-- Pilih Hubungan Keluarga --</option>
                                                    <option value="Anak Kandung">Anak Kandung</option>
                                                    <option value="Orang Tua">Orang Tua (Ayah / Ibu)</option>
                                                    <option value="Suami / Istri">Suami / Istri</option>
                                                    <option value="Saudara Kandung">Saudara Kandung</option>
                                                    <option value="Keluarga Lainnya">Keluarga Lainnya</option>
                                                </select>
                                                @error('relationship') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- File Uploads Grid --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- KTP File Upload --}}
                                    <div class="border border-slate-200 rounded-2xl p-5 bg-slate-50/50">
                                        <div class="flex items-center justify-between mb-3">
                                            <label class="text-xs font-bold text-slate-800 uppercase tracking-wider">Foto/Scan KTP Asli <span class="text-red-500">*</span></label>
                                            <span class="text-[11px] text-slate-400">Maks. 2MB (JPG, PNG, PDF)</span>
                                        </div>
                                        <div class="relative border-2 border-dashed border-slate-300 hover:border-primary-400 rounded-xl p-4 text-center bg-white transition-colors">
                                            <input
                                                type="file"
                                                wire:model="ktpFile"
                                                accept=".jpg,.jpeg,.png,.pdf"
                                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                            <div class="flex flex-col items-center pointer-events-none">
                                                <div class="w-10 h-10 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center mb-2">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                </div>
                                                <span class="text-xs font-semibold text-slate-700">Pilih Berkas KTP</span>
                                                <span class="text-[11px] text-slate-400 mt-0.5">atau geser file ke area ini</span>
                                            </div>
                                        </div>
                                        <div wire:loading wire:target="ktpFile" class="text-xs text-primary-600 mt-2 flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                            Mengunggah file KTP...
                                        </div>
                                        @if ($ktpFile)
                                            <div class="mt-3 flex items-center justify-between p-2.5 bg-emerald-50 text-emerald-800 rounded-xl text-xs border border-emerald-200">
                                                <div class="flex items-center gap-2 truncate">
                                                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    <span class="font-medium truncate">{{ $ktpFile->getClientOriginalName() }}</span>
                                                </div>
                                                <button type="button" wire:click="$set('ktpFile', null)" class="text-red-500 hover:text-red-700 text-xs font-bold px-1.5">Hapus</button>
                                            </div>
                                        @endif
                                        @error('ktpFile') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- KK File Upload --}}
                                    <div class="border border-slate-200 rounded-2xl p-5 bg-slate-50/50">
                                        <div class="flex items-center justify-between mb-3">
                                            <label class="text-xs font-bold text-slate-800 uppercase tracking-wider">Foto/Scan KK Asli <span class="text-red-500">*</span></label>
                                            <span class="text-[11px] text-slate-400">Maks. 2MB (JPG, PNG, PDF)</span>
                                        </div>
                                        <div class="relative border-2 border-dashed border-slate-300 hover:border-primary-400 rounded-xl p-4 text-center bg-white transition-colors">
                                            <input
                                                type="file"
                                                wire:model="kkFile"
                                                accept=".jpg,.jpeg,.png,.pdf"
                                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                            <div class="flex flex-col items-center pointer-events-none">
                                                <div class="w-10 h-10 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center mb-2">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                                </div>
                                                <span class="text-xs font-semibold text-slate-700">Pilih Berkas KK</span>
                                                <span class="text-[11px] text-slate-400 mt-0.5">atau geser file ke area ini</span>
                                            </div>
                                        </div>
                                        <div wire:loading wire:target="kkFile" class="text-xs text-primary-600 mt-2 flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                            Mengunggah file KK...
                                        </div>
                                        @if ($kkFile)
                                            <div class="mt-3 flex items-center justify-between p-2.5 bg-emerald-50 text-emerald-800 rounded-xl text-xs border border-emerald-200">
                                                <div class="flex items-center gap-2 truncate">
                                                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                    <span class="font-medium truncate">{{ $kkFile->getClientOriginalName() }}</span>
                                                </div>
                                                <button type="button" wire:click="$set('kkFile', null)" class="text-red-500 hover:text-red-700 text-xs font-bold px-1.5">Hapus</button>
                                            </div>
                                        @endif
                                        @error('kkFile') <p class="text-red-600 text-xs mt-1.5">{{ $message }}</p> @enderror
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
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-bold text-slate-800">4. Tinjau Kembali Permohonan Anda</h2>
                                            <p class="text-xs text-slate-500">Periksa kebenaran data sebelum mengirimkan permohonan ke petugas Dinsos</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 bg-amber-100 text-amber-800 text-xs font-semibold rounded-full border border-amber-200">Langkah Terakhir</span>
                                </div>

                                <div class="space-y-6">
                                    {{-- Group 1: Tujuan --}}
                                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                                        <div class="flex items-center justify-between mb-2">
                                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Tujuan Surat Terpilih</span>
                                            <button type="button" wire:click="goToStep(1)" class="text-xs font-semibold text-primary-600 hover:underline">Ubah</button>
                                        </div>
                                        @php
                                            $selectedPurpose = $purposes->firstWhere('id', $purposeId);
                                        @endphp
                                        <div class="font-bold text-slate-800 text-sm">{{ $selectedPurpose?->name ?? 'Belum dipilih' }}</div>
                                        @if ($purposeDescription)
                                            <div class="text-xs text-slate-600 mt-1">Keterangan: {{ $purposeDescription }}</div>
                                        @endif
                                    </div>

                                    {{-- Group 2: Data Pemohon --}}
                                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Data Pemohon</span>
                                            <button type="button" wire:click="goToStep(2)" class="text-xs font-semibold text-primary-600 hover:underline">Ubah</button>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                                            <div>
                                                <span class="text-slate-400 block mb-0.5">Nama Pemohon:</span>
                                                <span class="font-semibold text-slate-800">{{ $applicantName }}</span>
                                            </div>
                                            <div>
                                                <span class="text-slate-400 block mb-0.5">NIK Pemohon:</span>
                                                <span class="font-mono font-semibold text-slate-800">{{ $applicantNik }}</span>
                                            </div>
                                            <div>
                                                <span class="text-slate-400 block mb-0.5">Nomor Kartu Keluarga:</span>
                                                <span class="font-mono font-semibold text-slate-800">{{ $familyCardNumber }}</span>
                                            </div>
                                            <div>
                                                <span class="text-slate-400 block mb-0.5">No. WhatsApp:</span>
                                                <span class="font-semibold text-slate-800">{{ $phone }}</span>
                                            </div>
                                            <div class="sm:col-span-2">
                                                <span class="text-slate-400 block mb-0.5">Alamat:</span>
                                                <span class="font-medium text-slate-700">{{ $address }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Group 3: Subjek & Dokumen --}}
                                    <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Subjek Surat & Berkas Unggahan</span>
                                            <button type="button" wire:click="goToStep(3)" class="text-xs font-semibold text-primary-600 hover:underline">Ubah</button>
                                        </div>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs mb-3">
                                            <div>
                                                <span class="text-slate-400 block mb-0.5">Orang yang Diterangkan:</span>
                                                <span class="font-semibold text-slate-800">{{ $subjectName }}</span>
                                            </div>
                                            <div>
                                                <span class="text-slate-400 block mb-0.5">Hubungan:</span>
                                                <span class="font-semibold text-slate-800">{{ $relationship }}</span>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap gap-2 pt-2 border-t border-slate-200">
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-xs font-medium">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                KTP: {{ $ktpFile ? $ktpFile->getClientOriginalName() : 'Belum diunggah' }}
                                            </span>
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg text-xs font-medium">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                KK: {{ $kkFile ? $kkFile->getClientOriginalName() : 'Belum diunggah' }}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Pernyataan Kebenaran Data --}}
                                    <div class="p-4 bg-amber-50/70 border border-amber-200 rounded-xl flex items-start gap-3">
                                        <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                                        <div class="text-xs text-amber-900 leading-relaxed">
                                            <strong>Pernyataan Kebenaran Data:</strong> Dengan menekan tombol kirim di bawah, saya menyatakan bahwa seluruh data dan dokumen yang saya lampirkan adalah benar dan sah. Apabila ditemukan pemalsuan, saya bersedia diproses sesuai ketentuan hukum yang berlaku.
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
                                    <span wire:loading.remove wire:target="submit">Kirim Permohonan Sekarang</span>
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
                        {{-- Ringkasan Permohonan Card --}}
                        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs">
                            <div class="flex items-center gap-2 pb-3 border-b border-slate-100 mb-4">
                                <svg class="w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                <h3 class="font-bold text-slate-800 text-sm">Ringkasan Pengajuan</h3>
                            </div>

                            <div class="space-y-3 text-xs">
                                <div class="bg-slate-50 p-3 rounded-xl">
                                    <span class="text-slate-400 block mb-0.5">Layanan:</span>
                                    <span class="font-bold text-slate-800">Surat Keterangan Terdaftar DTSEN</span>
                                </div>

                                <div class="bg-slate-50 p-3 rounded-xl">
                                    <span class="text-slate-400 block mb-0.5">Tujuan Dipilih:</span>
                                    <span class="font-bold text-primary-700">
                                        {{ $purposes->firstWhere('id', $purposeId)?->name ?? 'Belum Dipilih' }}
                                    </span>
                                </div>

                                <div class="bg-slate-50 p-3 rounded-xl">
                                    <span class="text-slate-400 block mb-0.5">Biaya Pelayanan:</span>
                                    <span class="font-bold text-emerald-600 text-sm">Rp 0,- (Gratis Tanpa Pungli)</span>
                                </div>

                                <div class="bg-slate-50 p-3 rounded-xl">
                                    <span class="text-slate-400 block mb-0.5">Target Verifikasi (SLA):</span>
                                    <span class="font-semibold text-slate-800">Maks. 1 Hari Kerja Dinsos</span>
                                </div>
                            </div>

                            {{-- Ticket preview illustration --}}
                            <div class="mt-4 pt-4 border-t border-slate-100">
                                <div class="text-[11px] text-slate-500 mb-1.5 font-medium">Contoh format tiket yang akan Anda dapatkan:</div>
                                <div class="bg-primary-50 text-primary-800 font-mono font-bold text-xs p-2.5 rounded-lg border border-primary-200 text-center tracking-wider">
                                    DTSEN-202610-00012
                                </div>
                            </div>
                        </div>

                        {{-- Privacy & Security Guarantee --}}
                        <div class="bg-emerald-50/60 border border-emerald-200 rounded-2xl p-5 flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <div class="text-xs">
                                <div class="font-bold text-emerald-900 mb-0.5">Jaminan Keamanan & Privasi Data</div>
                                <p class="text-emerald-700 leading-relaxed">Seluruh data NIK dan dokumen dilindungi sistem enkripsi sesuai amanat UU Perlindungan Data Pribadi (UU PDP No. 27/2022).</p>
                            </div>
                        </div>

                        {{-- Helpdesk --}}
                        <div class="bg-white rounded-2xl border border-slate-200 p-5 flex items-center gap-3 shadow-xs">
                            <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            </div>
                            <div class="text-xs">
                                <div class="font-bold text-slate-800">Butuh Bantuan Pengisian?</div>
                                <a href="https://wa.me/6281234567890" target="_blank" class="text-primary-600 font-semibold hover:underline">
                                    Hubungi Petugas Dinsos di WA &rarr;
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
