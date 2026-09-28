<div>
    {{-- Header --}}
    <section class="bg-gradient-to-r from-primary-700 to-primary-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center gap-2 text-white/70 text-sm mb-3">
                <a href="/" wire:navigate class="hover:text-white">Beranda</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white">Verifikasi Surat</span>
            </div>
            <div class="inline-flex items-center gap-1.5 bg-white/10 text-white/90 text-xs font-medium px-3 py-1 rounded-full mb-3">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Layanan Keabsahan Dokumen TTE BSrE BSSN
            </div>
            <h1 class="text-3xl font-bold mb-2">Verifikasi Keaslian Surat Digital</h1>
            <p class="text-white/80 max-w-xl">Cek keabsahan dan keaslian dokumen resmi yang diterbitkan oleh Dinas Sosial Kabupaten Blitar melalui sistem TTE terintegrasi secara cepat, transparan, dan terpercaya.</p>
        </div>
    </section>

    {{-- Verification Form --}}
    <section class="bg-white border-b border-slate-200">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 text-center">
                <div class="flex items-center justify-center gap-2 mb-3">
                    <svg class="w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <h2 class="font-bold text-slate-800">Pemeriksaan Kode Unik Dokumen</h2>
                </div>
                <p class="text-sm text-slate-500 mb-6">Masukkan token identifikasi 16 karakter alfanumerik yang tertera pada lembar dokumen atau hasil pindaian kamera.</p>

                <form wire:submit="verify" class="max-w-lg mx-auto">
                    <label class="block text-sm font-medium text-slate-700 text-left mb-1.5">Kode Unik Verifikasi Surat (dari QR Code atau tercantum di bawah lembar dokumen)</label>
                    <div class="flex gap-3">
                        <input wire:model="verificationCode" type="text" placeholder="Contoh: DTSEN-V26-9812-7401" class="flex-1 px-4 py-3 border border-slate-300 rounded-xl text-sm font-mono input-focus">
                        <button type="submit" class="px-6 py-3 bg-amber-500 hover:bg-amber-400 text-slate-900 font-semibold rounded-xl transition-colors shrink-0">
                            Periksa Keaslian Dokumen
                        </button>
                    </div>
                    @error('verificationCode') <p class="text-red-600 text-xs mt-1 text-left">{{ $message }}</p> @enderror
                </form>
            </div>
        </div>
    </section>

    {{-- Results --}}
    @if ($searched)
        <section class="py-10">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                @if ($result)
                    @if ($result['status'] === 'valid')
                        {{-- Valid --}}
                        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6 mb-8 flex items-start gap-4">
                            <div class="p-3 bg-emerald-100 rounded-full shrink-0">
                                <svg class="w-8 h-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                            <div>
                                <div class="flex items-center gap-2 text-xs text-emerald-600 font-medium uppercase tracking-wider mb-1">
                                    <span>Status: Valid & Aktif</span>
                                    <span>·</span>
                                    <span>Kriptografi Sertifikat Sah</span>
                                </div>
                                <h2 class="text-xl font-bold text-emerald-800 mb-1">SURAT ASLI & TERVERIFIKASI SAH</h2>
                                <p class="text-sm text-emerald-700">Dokumen ini resmi dikeluarkan oleh Dinas Sosial Kabupaten Blitar dan masih berlaku dalam masa aktif legalitasnya.</p>
                            </div>
                        </div>
                    @else
                        {{-- Expired --}}
                        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 mb-8 flex items-start gap-4">
                            <div class="p-3 bg-amber-100 rounded-full shrink-0">
                                <svg class="w-8 h-8 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <div class="text-xs text-amber-600 font-medium uppercase tracking-wider mb-1">Status: Kedaluwarsa</div>
                                <h2 class="text-xl font-bold text-amber-800 mb-1">Surat Asli tetapi Sudah Tidak Berlaku</h2>
                                <p class="text-sm text-amber-700">Masa berlaku surat telah habis pada {{ $result['valid_until'] }}. Dokumen tidak lagi memiliki kekuatan hukum.</p>
                            </div>
                        </div>
                    @endif

                    {{-- Certificate Details --}}
                    <div class="bg-white rounded-2xl border border-slate-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-bold text-lg text-slate-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Rincian Dokumen Resmi
                            </h3>
                            <span class="font-mono text-xs text-slate-400">REF: {{ $result['verification_code'] }}</span>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-0.5">Jenis Dokumen Surat</div>
                                    <div class="font-semibold text-slate-800">Surat Keterangan Data Terpadu Kesejahteraan Sosial (DTSEN)</div>
                                </div>
                                <div>
                                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-0.5">Nomor Registrasi Surat</div>
                                    <div class="font-mono font-semibold text-slate-800">{{ $result['certificate_number'] ?? '-' }}</div>
                                </div>
                                <div>
                                    <div class="text-xs text-slate-400 uppercase tracking-wider mb-0.5">Peruntukan / Keperluan</div>
                                    <div class="font-semibold text-slate-800">{{ $result['purpose'] }} {{ $result['purpose_description'] ? '— ' . $result['purpose_description'] : '' }}</div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <div class="text-xs text-slate-400 uppercase tracking-wider mb-0.5">Nama Lengkap Pemohon</div>
                                        <div class="font-semibold text-slate-800">{{ $result['applicant_name'] }}</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-slate-400 uppercase tracking-wider mb-0.5">NIK Pemohon</div>
                                        <div class="font-mono text-slate-700">{{ $result['applicant_nik_masked'] }}</div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <div class="text-xs text-slate-400 uppercase tracking-wider mb-0.5">Orang yang Diterangkan</div>
                                        <div class="font-semibold text-slate-800">{{ $result['subject_name'] }}</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-slate-400 uppercase tracking-wider mb-0.5">NIK</div>
                                        <div class="font-mono text-slate-700">{{ $result['subject_nik_masked'] }}</div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <div class="text-xs text-slate-400 uppercase tracking-wider mb-0.5">Tanggal Diterbitkan</div>
                                        <div class="font-semibold text-slate-800">{{ $result['issued_at'] ?? '-' }}</div>
                                    </div>
                                    <div>
                                        <div class="text-xs text-slate-400 uppercase tracking-wider mb-0.5">Masa Berlaku Sampai</div>
                                        <div class="font-semibold text-slate-800">{{ $result['valid_until'] ?? 'Tidak ditentukan' }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                @if ($result['is_registered'])
                                    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4">
                                        <div class="text-xs text-emerald-600 font-medium mb-1">Status Terdaftar di DTKS</div>
                                        <div class="font-bold text-emerald-800 text-lg">Terdaftar — Desil {{ $result['decile'] }}</div>
                                    </div>
                                @endif
                                @if ($result['signer_name'])
                                    <div class="border border-slate-200 rounded-xl p-4">
                                        <div class="text-xs text-slate-400 uppercase tracking-wider mb-2">Otoritas Penandatangan Resmi</div>
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 font-bold text-sm">{{ strtoupper(substr($result['signer_name'], 0, 1)) }}</div>
                                            <div>
                                                <div class="font-semibold text-sm text-slate-800">{{ $result['signer_name'] }}</div>
                                                <div class="text-xs text-slate-400">Kepala Dinas Sosial Kabupaten Blitar</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Not Found --}}
                    <div class="bg-red-50 border border-red-200 rounded-2xl p-8 text-center max-w-lg mx-auto">
                        <div class="p-3 bg-red-100 rounded-full w-fit mx-auto mb-4">
                            <svg class="w-10 h-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                        </div>
                        <div class="text-xs text-red-600 font-medium uppercase tracking-wider mb-1">Status: Tidak Valid</div>
                        <h3 class="text-xl font-bold text-red-800 mb-2">Dokumen Tidak Terdaftar / Ilegal</h3>
                        <p class="text-sm text-red-700 mb-4">Kode Verifikasi Tidak Terdaftar di Basis Data SAPA SOSIAL. Waspadai indikasi pemalsuan dokumen surat sosial.</p>
                        <a href="/pengaduan" wire:navigate class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-500 transition-colors text-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                            Laporkan Indikasi Pemalsuan
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif

    <div class="lg:hidden h-16"></div>
</div>
