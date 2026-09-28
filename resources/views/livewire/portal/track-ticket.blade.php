<div>
    {{-- Header --}}
    <section class="bg-gradient-to-r from-primary-700 to-primary-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center gap-2 text-white/70 text-sm mb-3">
                <a href="/" wire:navigate class="hover:text-white">Beranda</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white">Cek Status Tiket</span>
            </div>
            <div class="inline-flex items-center gap-1.5 bg-white/10 text-white/90 text-xs font-medium px-3 py-1 rounded-full mb-3">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Layanan Pelacakan Mandiri
            </div>
            <h1 class="text-3xl font-bold mb-2">Lacak Permohonan & Pengaduan Anda</h1>
            <p class="text-white/80 max-w-xl">Pantau proses verifikasi permohonan layanan atau tindak lanjut laporan sosial secara real-time dan transparan.</p>
        </div>
    </section>

    {{-- Search Form --}}
    <section class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-slate-50 rounded-2xl border border-slate-200 p-6">
                <div class="flex items-start gap-3 mb-5">
                    <div class="p-2 bg-white border border-slate-200 rounded-lg"><svg class="w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z"/></svg></div>
                    <div>
                        <h2 class="font-bold text-slate-800">Pencarian Cepat Riwayat Berkas</h2>
                        <p class="text-sm text-slate-500">Masukkan kode tiket unik yang diterbitkan loket digital atau petugas kelurahan</p>
                    </div>
                </div>
                <form wire:submit="checkStatus" class="grid sm:grid-cols-12 gap-4 items-end">
                    <div class="sm:col-span-5">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Nomor Tiket Permohonan <span class="text-red-500">*</span></label>
                        <input wire:model="ticket" type="text" placeholder="Contoh: DTSEN-202610-00012" class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm font-mono input-focus">
                        @error('ticket') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-4">
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">4 Digit Terakhir NIK / No. HP <span class="text-red-500">*</span></label>
                        <input wire:model="verifier" type="text" maxlength="4" placeholder="Contoh: 4092" class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm font-mono input-focus">
                        @error('verifier') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="sm:col-span-3">
                        <button type="submit" class="w-full px-6 py-3 bg-amber-500 hover:bg-amber-400 text-slate-900 font-semibold rounded-xl transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            Lacak Status Sekarang
                        </button>
                    </div>
                </form>
                <p class="text-xs text-slate-400 mt-3 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Nomor tiket telah dikirimkan secara otomatis melalui WhatsApp saat Anda selesai mengisi formulir pendaftaran.
                </p>
            </div>
        </div>
    </section>

    {{-- Results --}}
    @if ($searched)
        <section class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if ($result)
                    <div class="grid lg:grid-cols-5 gap-8">
                        {{-- Identity Card --}}
                        <div class="lg:col-span-2 space-y-6">
                            <div class="bg-white rounded-2xl border border-slate-200 p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Identitas Berkas</span>
                                    @if ($result['type'] === 'service_request')
                                        <span class="badge-process text-xs font-medium px-2.5 py-0.5 rounded-full">Pengajuan Layanan</span>
                                    @else
                                        <span class="badge-warning text-xs font-medium px-2.5 py-0.5 rounded-full">Pengaduan Sosial</span>
                                    @endif
                                </div>
                                <div class="bg-slate-50 rounded-xl p-3 mb-4">
                                    <div class="text-xs text-slate-400 mb-0.5">Nomor Tiket Registrasi</div>
                                    <div class="font-mono font-bold text-lg text-primary-700">{{ $result['number'] }}</div>
                                </div>
                                <div class="space-y-3 text-sm">
                                    <div class="flex justify-between"><span class="text-slate-500">Jenis Layanan</span><span class="font-medium text-slate-700 text-right">{{ $result['service_name'] }}</span></div>
                                    <div class="flex justify-between"><span class="text-slate-500">Nama Pemohon</span><span class="font-medium text-slate-700">{{ $result['applicant'] }}</span></div>
                                    @if ($result['nik_masked'])
                                        <div class="flex justify-between"><span class="text-slate-500">NIK Terdaftar</span><span class="font-mono text-slate-700">{{ $result['nik_masked'] }}</span></div>
                                    @endif
                                    <div class="flex justify-between"><span class="text-slate-500">Tanggal Masuk</span><span class="font-medium text-slate-700">{{ $result['submitted_at'] }}</span></div>
                                    <div class="flex justify-between"><span class="text-slate-500">Kecamatan Domisili</span><span class="font-medium text-slate-700">{{ $result['village'] }}</span></div>
                                </div>
                                <div class="mt-4 pt-4 border-t border-slate-100">
                                    <div class="text-xs text-slate-400 mb-1.5">Status Saat Ini</div>
                                    <span @class([
                                        'inline-flex items-center gap-1.5 text-sm font-semibold px-3 py-1.5 rounded-full',
                                        'badge-success' => $result['status_color'] === 'success',
                                        'badge-process' => in_array($result['status_color'], ['info', 'primary']),
                                        'badge-warning' => $result['status_color'] === 'warning',
                                        'badge-danger' => $result['status_color'] === 'danger',
                                        'badge-neutral' => $result['status_color'] === 'gray',
                                    ])>
                                        {{ $result['status_label'] }}
                                    </span>
                                </div>
                            </div>

                            @if ($result['officer'])
                                <div class="bg-white rounded-2xl border border-slate-200 p-6">
                                    <div class="text-xs text-slate-400 mb-2">Petugas Verifikator</div>
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center text-primary-600 font-bold text-sm">{{ strtoupper(substr($result['officer'], 0, 1)) }}</div>
                                        <div>
                                            <div class="font-semibold text-sm text-slate-800">{{ $result['officer'] }}</div>
                                            <div class="text-xs text-slate-400">Petugas Verifikator Dinsos Kab. Blitar</div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- Timeline --}}
                        <div class="lg:col-span-3">
                            <div class="bg-white rounded-2xl border border-slate-200 p-6">
                                <h2 class="font-bold text-lg text-slate-800 mb-6">Kronologi & Tahapan Layanan</h2>
                                <div class="relative">
                                    <div class="absolute top-2 left-4 bottom-2 w-0.5 bg-slate-200"></div>
                                    <div class="space-y-6">
                                        @foreach ($result['histories'] as $index => $history)
                                            @php $isLast = $loop->last; @endphp
                                            <div class="flex gap-4 relative">
                                                <div @class([
                                                    'w-8 h-8 rounded-full flex items-center justify-center shrink-0 relative z-10 text-xs font-bold',
                                                    'step-active' => $isLast,
                                                    'step-done' => !$isLast,
                                                ])>
                                                    @if ($isLast)
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                                    @else
                                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                    @endif
                                                </div>
                                                <div class="flex-1 pb-2">
                                                    <div class="flex items-start justify-between gap-2">
                                                        <h3 class="font-semibold text-sm text-slate-800">
                                                            {{ \App\Enums\ServiceRequestStatus::tryFrom($history['to'])?->label() ?? \App\Enums\ComplaintStatus::tryFrom($history['to'])?->label() ?? $history['to'] }}
                                                            @if ($isLast)
                                                                <span class="badge-process text-xs font-medium px-2 py-0.5 rounded-full ml-1">Berjalan</span>
                                                            @endif
                                                        </h3>
                                                        <span class="text-xs text-slate-400 shrink-0">{{ $history['date'] }}</span>
                                                    </div>
                                                    @if ($history['notes'])
                                                        <p class="text-sm text-slate-500 mt-1">{{ $history['notes'] }}</p>
                                                    @endif
                                                    @if ($history['user'])
                                                        <p class="text-xs text-slate-400 mt-1">Oleh: {{ $history['user'] }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Not Found --}}
                    <div class="text-center py-16 max-w-md mx-auto">
                        <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Tiket Tidak Ditemukan</h3>
                        <p class="text-sm text-slate-500 mb-6">Nomor tiket atau kode verifikasi yang Anda masukkan tidak cocok. Periksa kembali ejaan dan pastikan data yang dimasukkan benar.</p>
                        <div class="flex justify-center gap-3">
                            <a href="/pengaduan" wire:navigate class="px-5 py-2.5 text-sm font-semibold text-primary-600 border border-primary-200 rounded-xl hover:bg-primary-50 transition-colors">Buat Aduan</a>
                            <a href="https://wa.me/6281234567890" target="_blank" class="px-5 py-2.5 text-sm font-semibold text-white bg-primary-600 hover:bg-primary-500 rounded-xl transition-colors">Pusat Bantuan</a>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- Help Section --}}
    <section class="py-10 bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-slate-200 rounded-2xl p-6 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-primary-50 rounded-xl"><svg class="w-6 h-6 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div>
                    <div>
                        <h3 class="font-bold text-slate-800">Mengalami Kendala atau Pertanyaan Status?</h3>
                        <p class="text-sm text-slate-500">Tim Layanan Pengaduan Dinsos Kab. Blitar siap membantu Anda di hari kerja pukul 08.00-15.00 WIB</p>
                    </div>
                </div>
                <div class="flex gap-3 shrink-0">
                    <a href="/pengaduan" wire:navigate class="px-4 py-2.5 text-sm font-semibold border border-slate-200 rounded-xl text-slate-700 hover:bg-slate-50 transition-colors">Buat Aduan</a>
                    <a href="https://wa.me/6281234567890" target="_blank" class="px-4 py-2.5 text-sm font-semibold bg-primary-600 text-white rounded-xl hover:bg-primary-500 transition-colors">Pusat Bantuan</a>
                </div>
            </div>
        </div>
    </section>

    <div class="lg:hidden h-16"></div>
</div>
