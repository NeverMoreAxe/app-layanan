<div>
    {{-- Header --}}
    <section class="bg-gradient-to-r from-primary-700 to-primary-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex items-center gap-2 text-white/70 text-sm mb-3">
                <a href="/" wire:navigate class="hover:text-white">Beranda</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white">Pengaduan Sosial</span>
            </div>
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <div class="inline-flex items-center gap-1.5 bg-white/10 text-white/90 text-xs font-medium px-3 py-1 rounded-full mb-3">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                        Kanal Resmi Respons Cepat Masalah Sosial (TRC Dinsos)
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold mb-2">Formulir Pengaduan & Aspirasi Masalah Sosial</h1>
                    <p class="text-white/80 max-w-xl text-sm sm:text-base">
                        Laporkan permasalahan sosial di sekitar Anda secara aman dan transparan. Bersama kita wujudkan perlindungan sosial yang tepat sasaran bagi warga Kabupaten Blitar.
                    </p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl px-5 py-4 flex items-center gap-4 shrink-0">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="text-xs text-white/70">Target Respons</div>
                        <div class="text-xl font-bold text-white">&le; 24 Jam Kerja</div>
                        <div class="text-xs text-emerald-300">Tim Penjangkauan TRC</div>
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
                        Laporan Pengaduan Berhasil Diterima
                    </span>

                    <h2 class="text-2xl font-bold text-slate-800 mb-2">Terima Kasih atas Kepedulian Anda!</h2>
                    <p class="text-slate-600 text-sm mb-6 max-w-md mx-auto">
                        Pengaduan Anda telah masuk ke sistem monitoring Tim Reaksi Cepat Dinas Sosial Kabupaten Blitar untuk diverifikasi dan ditindaklanjuti di lapangan.
                    </p>

                    {{-- Ticket Box --}}
                    <div class="bg-slate-50 border-2 border-dashed border-primary-300 rounded-2xl p-6 mb-8 text-left" x-data="{ copied: false }">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-medium text-slate-500 uppercase tracking-wider">Nomor Registrasi Pengaduan</span>
                            <span class="text-xs font-semibold text-primary-600 bg-primary-50 px-2.5 py-0.5 rounded-full">Simpan Nomor Tiket</span>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-2xl sm:text-3xl font-mono font-bold text-primary-700 tracking-wider">{{ $complaintNumber }}</span>
                            <button
                                @click="navigator.clipboard.writeText('{{ $complaintNumber }}'); copied = true; setTimeout(() => copied = false, 2500)"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-white border border-slate-200 hover:border-primary-400 text-slate-700 text-xs font-semibold rounded-xl transition-colors shadow-sm">
                                <svg x-show="!copied" class="w-4 h-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/></svg>
                                <svg x-show="copied" x-cloak class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span x-text="copied ? 'Tersalin!' : 'Salin Tiket'"></span>
                            </button>
                        </div>
                        <div class="text-xs text-slate-500 mt-3 pt-3 border-t border-slate-200 flex items-center gap-2">
                            <svg class="w-4 h-4 text-primary-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Gunakan nomor tiket ini dan 4 digit terakhir nomor HP Anda untuk memantau proses tindak lanjut tim lapangan.</span>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="/cek-status?ticket={{ $complaintNumber }}" wire:navigate class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-500 text-white font-semibold rounded-xl transition-colors shadow-sm text-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            Pantau Tindak Lanjut Aduan
                        </a>
                        <a href="/" wire:navigate class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-xl transition-colors text-sm">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @else
        {{-- ==================== FORM WORKSPACE ==================== --}}
        <section class="py-8 bg-slate-50/60">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form wire:submit="submit" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    {{-- Left Column: Form Sections --}}
                    <div class="lg:col-span-8 space-y-6">

                        {{-- Section 1: Kategori Permasalahan --}}
                        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center font-bold">
                                        1
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-bold text-slate-800">Kategori Permasalahan Sosial</h2>
                                        <p class="text-xs text-slate-500">Pilih jenis kendala sosial yang paling sesuai dengan kejadian di lapangan</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-primary-50 text-primary-700 text-xs font-semibold rounded-full border border-primary-200">Wajib Dipilih</span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3.5 mb-2">
                                @foreach ($categories as $category)
                                    <label
                                        @class([
                                            'relative flex flex-col p-4 rounded-xl border-2 cursor-pointer transition-all',
                                            'border-primary-600 bg-primary-50/40 shadow-xs' => $categoryId == $category->id,
                                            'border-slate-200 bg-white hover:border-slate-300 hover:bg-slate-50/60' => $categoryId != $category->id,
                                        ])>
                                        <input
                                            type="radio"
                                            name="category"
                                            value="{{ $category->id }}"
                                            wire:model.live="categoryId"
                                            class="sr-only">
                                        <div class="flex items-center justify-between mb-2">
                                            <div @class([
                                                'w-9 h-9 rounded-lg flex items-center justify-center',
                                                'bg-primary-600 text-white' => $categoryId == $category->id,
                                                'bg-slate-100 text-slate-600' => $categoryId != $category->id,
                                            ])>
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            </div>
                                            <div @class([
                                                'w-5 h-5 rounded-full border flex items-center justify-center text-xs',
                                                'border-primary-600 bg-primary-600 text-white' => $categoryId == $category->id,
                                                'border-slate-300 bg-white' => $categoryId != $category->id,
                                            ])>
                                                @if ($categoryId == $category->id)
                                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                @endif
                                            </div>
                                        </div>
                                        <span class="font-bold text-xs text-slate-800 leading-snug">{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('categoryId') <p class="text-red-600 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>

                        {{-- Section 2: Lokasi Kejadian --}}
                        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center font-bold">
                                        2
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-bold text-slate-800">Lokasi Kejadian</h2>
                                        <p class="text-xs text-slate-500">Tentukan wilayah administratif kejadian di Kabupaten Blitar</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-primary-50 text-primary-700 text-xs font-semibold rounded-full border border-primary-200">Wajib Diisi</span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kecamatan <span class="text-red-500">*</span></label>
                                    <select wire:model.live="districtId" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                        <option value="">-- Pilih Kecamatan (22 Kecamatan) --</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('districtId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Desa / Kelurahan <span class="text-red-500">*</span></label>
                                    <select wire:model="villageId" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus" {{ empty($districtId) ? 'disabled' : '' }}>
                                        <option value="">{{ empty($districtId) ? '-- Pilih Kecamatan Dahulu --' : '-- Pilih Desa / Kelurahan --' }}</option>
                                        @foreach ($villages as $village)
                                            <option value="{{ $village->id }}">{{ $village->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('villageId') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat / Patokan Lokasi Lengkap <span class="text-red-500">*</span></label>
                                    <textarea
                                        wire:model="locationDetail"
                                        rows="2"
                                        placeholder="Contoh: RT 03 / RW 01 Dusun Krajan, dekat Musholla Al-Ikhlas atau sebelah selatan pos kamling"
                                        class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus"></textarea>
                                    <p class="text-[11px] text-slate-400 mt-1">Sertakan patokan yang mudah ditemukan oleh petugas Tim Reaksi Cepat.</p>
                                    @error('locationDetail') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Section 3: Uraian Pengaduan & Bukti Foto --}}
                        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center font-bold">
                                        3
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-bold text-slate-800">Uraian Masalah & Lampiran Bukti</h2>
                                        <p class="text-xs text-slate-500">Jelaskan kondisi secara objektif dan sertakan foto kondisi di lapangan</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-primary-50 text-primary-700 text-xs font-semibold rounded-full border border-primary-200">Wajib Diisi</span>
                            </div>

                            <div class="space-y-5">
                                <div>
                                    <div class="flex items-center justify-between mb-1.5">
                                        <label class="text-xs font-semibold text-slate-700">Deskripsi Kejadian / Kronologi <span class="text-red-500">*</span></label>
                                        <span class="text-[11px] text-slate-400">Min. 10 karakter</span>
                                    </div>
                                    <textarea
                                        wire:model="description"
                                        rows="4"
                                        placeholder="Ceritakan permasalahan secara rinci: siapa warga yang membutuhkan bantuan, bagaimana kondisi tempat tinggal atau kondisi kesehatannya..."
                                        class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus"></textarea>
                                    @error('description') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                {{-- Multi File Upload Dropzone --}}
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="text-xs font-semibold text-slate-700">Lampiran Foto Lapangan / Dokumen Pendukung</label>
                                        <span class="text-[11px] text-slate-400">Maks. 5MB per file (JPG, PNG, PDF)</span>
                                    </div>

                                    <div class="relative border-2 border-dashed border-slate-300 hover:border-primary-400 rounded-2xl p-6 text-center bg-slate-50/50 transition-colors">
                                        <input
                                            type="file"
                                            wire:model="attachments"
                                            multiple
                                            accept=".jpg,.jpeg,.png,.pdf"
                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                        <div class="flex flex-col items-center pointer-events-none">
                                            <div class="w-12 h-12 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center mb-2">
                                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                            <span class="text-xs font-semibold text-slate-800">Klik untuk Pilih File Foto / Dokumen</span>
                                            <span class="text-[11px] text-slate-500 mt-0.5">Bisa pilih lebih dari satu foto sekaligus</span>
                                        </div>
                                    </div>

                                    <div wire:loading wire:target="attachments" class="text-xs text-primary-600 mt-2 flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                        Sedang mengunggah berkas lampiran...
                                    </div>

                                    @if (!empty($attachments))
                                        <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 gap-2">
                                            @foreach ($attachments as $idx => $file)
                                                <div class="flex items-center justify-between p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs">
                                                    <div class="flex items-center gap-2 truncate">
                                                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                        <span class="truncate font-medium text-slate-800">{{ $file->getClientOriginalName() }}</span>
                                                    </div>
                                                    <button type="button" wire:click="removeAttachment({{ $idx }})" class="text-red-500 hover:text-red-700 text-xs font-bold px-1.5">Hapus</button>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @error('attachments.*') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Section 4: Identitas Pelapor --}}
                        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-xs">
                            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center font-bold">
                                        4
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-bold text-slate-800">Identitas Pelapor</h2>
                                        <p class="text-xs text-slate-500">Data Anda dirahasiakan dan hanya digunakan untuk konfirmasi klarifikasi oleh petugas</p>
                                    </div>
                                </div>
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full border border-emerald-200">Kerahasiaan Terjamin</span>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap Pelapor <span class="text-red-500">*</span></label>
                                    <input type="text" wire:model="reporterName" placeholder="Contoh: Muhammad Ilham" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                    @error('reporterName') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor WhatsApp Aktif <span class="text-red-500">*</span></label>
                                    <input type="tel" wire:model="reporterPhone" placeholder="Contoh: 081234567890" class="w-full px-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                    @error('reporterPhone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="bg-white rounded-2xl border border-slate-200 p-5 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-xs">
                            <div class="text-xs text-slate-500 flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                <span>Laporan dilindungi UU Perlindungan Saksi dan Korban serta kerahasiaan identitas publik.</span>
                            </div>
                            <button
                                type="submit"
                                wire:loading.attr="disabled"
                                class="w-full sm:w-auto px-10 py-3.5 bg-amber-500 hover:bg-amber-400 active:bg-amber-600 text-slate-900 font-bold rounded-xl text-sm transition-all shadow-md flex items-center justify-center gap-2 shrink-0">
                                <span wire:loading.remove wire:target="submit">Kirim Laporan Pengaduan</span>
                                <span wire:loading wire:target="submit" class="flex items-center gap-2">
                                    <svg class="w-4 h-4 animate-spin text-slate-900" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    Mengirim Laporan...
                                </span>
                            </button>
                        </div>
                    </div>

                    {{-- Right Column: Information & Guarantees --}}
                    <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">
                        {{-- SLA Box --}}
                        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs">
                            <div class="flex items-center gap-2 pb-3 border-b border-slate-100 mb-4">
                                <svg class="w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                <h3 class="font-bold text-slate-800 text-sm">Alur Penanganan Laporan</h3>
                            </div>

                            <div class="space-y-4 text-xs">
                                <div class="flex items-start gap-3">
                                    <span class="w-6 h-6 rounded-full bg-primary-100 text-primary-700 font-bold flex items-center justify-center shrink-0">1</span>
                                    <div>
                                        <div class="font-bold text-slate-800">Verifikasi Tim Respon</div>
                                        <p class="text-slate-500 mt-0.5">Petugas memvalidasi laporan dan lokasi kejadian dalam waktu maks. 24 jam.</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <span class="w-6 h-6 rounded-full bg-primary-100 text-primary-700 font-bold flex items-center justify-center shrink-0">2</span>
                                    <div>
                                        <div class="font-bold text-slate-800">Penjangkauan Lapangan</div>
                                        <p class="text-slate-500 mt-0.5">Tim TRC Dinsos turun langsung ke lokasi bersama pilar-pilar sosial setempat (TKSK/PSM).</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <span class="w-6 h-6 rounded-full bg-primary-100 text-primary-700 font-bold flex items-center justify-center shrink-0">3</span>
                                    <div>
                                        <div class="font-bold text-slate-800">Tindak Lanjut & Intervensi</div>
                                        <p class="text-slate-500 mt-0.5">Pemberian bantuan darurat, rujukan panti, atau rekomendasi program jaring sosial.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Emergency Contact Hotline --}}
                        <div class="bg-red-50/80 border border-red-200 rounded-2xl p-5">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </div>
                                <div class="text-xs">
                                    <div class="font-bold text-red-900 mb-0.5">Kondisi Kedaruratan Tinggi?</div>
                                    <p class="text-red-700 leading-relaxed mb-3">Jika menemukan lansia terlantar kritis atau ODGJ mengamuk yang butuh evakuasi segera, hubungi Call Center TRC Dinsos:</p>
                                    <a href="tel:0342801123" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-600 text-white rounded-lg font-bold text-xs hover:bg-red-700 transition-colors">
                                        (0342) 801123
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    @endif

    <div class="lg:hidden h-16"></div>
</div>
