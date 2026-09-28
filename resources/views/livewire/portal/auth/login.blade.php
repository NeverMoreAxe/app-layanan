<div>
    {{-- Ambient Header --}}
    <section class="bg-gradient-to-r from-primary-700 to-primary-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
            <div class="flex items-center gap-2 text-white/70 text-sm mb-3">
                <a href="/" wire:navigate class="hover:text-white">Beranda</a>
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white">{{ $activeTab === 'login' ? 'Masuk Akun' : 'Daftar Akun Baru' }}</span>
            </div>
            <div class="inline-flex items-center gap-1.5 bg-white/10 text-white/90 text-xs font-medium px-3 py-1 rounded-full mb-3">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                Akses Terpadu Layanan Sosial Kabupaten Blitar
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold mb-2">Portal Masuk & Registrasi Warga</h1>
            <p class="text-white/80 max-w-xl text-sm sm:text-base">
                Kelola pengajuan surat DTSEN, reaktivasi KIS/PBI-JK, serta pantau laporan aduan Anda dalam satu akun terpadu.
            </p>
        </div>
    </section>

    {{-- Main Auth Section --}}
    <section class="py-10 sm:py-12 bg-slate-50/60">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden grid grid-cols-1 lg:grid-cols-12">

                {{-- Left Column: Form (7 cols) --}}
                <div class="lg:col-span-7 p-6 sm:p-10 flex flex-col justify-between">
                    <div>
                        {{-- Tabs --}}
                        <div class="flex items-center p-1 bg-slate-100 rounded-2xl mb-8 max-w-sm">
                            <button
                                type="button"
                                wire:click="switchTab('login')"
                                @class([
                                    'flex-1 py-2.5 text-xs font-bold rounded-xl transition-all',
                                    'bg-white text-primary-700 shadow-xs' => $activeTab === 'login',
                                    'text-slate-600 hover:text-slate-900' => $activeTab !== 'login',
                                ])>
                                Masuk Akun
                            </button>
                            <button
                                type="button"
                                wire:click="switchTab('register')"
                                @class([
                                    'flex-1 py-2.5 text-xs font-bold rounded-xl transition-all',
                                    'bg-white text-primary-700 shadow-xs' => $activeTab === 'register',
                                    'text-slate-600 hover:text-slate-900' => $activeTab !== 'register',
                                ])>
                                Daftar Akun Baru
                            </button>
                        </div>

                        {{-- TAB 1: FORM LOGIN --}}
                        @if ($activeTab === 'login')
                            <div>
                                <div class="mb-6">
                                    <h2 class="text-xl sm:text-2xl font-bold text-slate-800">Selamat Datang Kembali</h2>
                                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                                        Gunakan NIK, Email, atau No. WhatsApp yang telah terdaftar untuk masuk.
                                    </p>
                                </div>

                                <form wire:submit="login" class="space-y-4">
                                    {{-- Identifier (NIK / Email / Phone) --}}
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">NIK, Email, atau No. WhatsApp <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                            </div>
                                            <input
                                                type="text"
                                                wire:model="loginIdentifier"
                                                placeholder="Contoh: 3505... atau email@domain.com"
                                                class="w-full pl-11 pr-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                        </div>
                                        @error('loginIdentifier') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- Password --}}
                                    <div>
                                        <div class="flex items-center justify-between mb-1.5">
                                            <label class="text-xs font-semibold text-slate-700">Kata Sandi <span class="text-red-500">*</span></label>
                                            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Dinsos,%20saya%20lupa%20kata%20sandi%20akun%20SAPA%20SOSIAL" target="_blank" class="text-xs text-primary-600 hover:underline">
                                                Lupa Sandi?
                                            </a>
                                        </div>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                            </div>
                                            <input
                                                type="password"
                                                wire:model="loginPassword"
                                                placeholder="Masukkan kata sandi akun Anda"
                                                class="w-full pl-11 pr-4 py-3 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                        </div>
                                        @error('loginPassword') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    {{-- Remember Me --}}
                                    <div class="flex items-center justify-between pt-1">
                                        <label class="flex items-center gap-2 cursor-pointer text-xs text-slate-600">
                                            <input
                                                type="checkbox"
                                                wire:model="remember"
                                                class="w-4 h-4 rounded text-primary-600 focus:ring-primary-500 border-slate-300">
                                            <span>Ingat sesi saya di perangkat ini</span>
                                        </label>
                                    </div>

                                    {{-- Submit Button --}}
                                    <div class="pt-2">
                                        <button
                                            type="submit"
                                            wire:loading.attr="disabled"
                                            class="w-full py-3.5 px-6 bg-amber-500 hover:bg-amber-400 active:bg-amber-600 text-slate-900 font-bold rounded-xl text-sm transition-all shadow-md flex items-center justify-center gap-2">
                                            <span wire:loading.remove wire:target="login">Masuk Sekarang</span>
                                            <span wire:loading wire:target="login" class="flex items-center gap-2">
                                                <svg class="w-4 h-4 animate-spin text-slate-900" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                                Memproses...
                                            </span>
                                            <svg wire:loading.remove wire:target="login" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                        </button>
                                    </div>
                                </form>

                                {{-- Switch to Register Prompt --}}
                                <div class="mt-6 text-center text-xs text-slate-500">
                                    Belum memiliki akun warga?
                                    <button type="button" wire:click="switchTab('register')" class="text-primary-600 font-bold hover:underline ml-1">
                                        Daftar Akun Baru
                                    </button>
                                </div>
                            </div>
                        @endif

                        {{-- TAB 2: FORM REGISTER --}}
                        @if ($activeTab === 'register')
                            <div>
                                <div class="mb-6">
                                    <h2 class="text-xl sm:text-2xl font-bold text-slate-800">Daftar Akun Warga</h2>
                                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                                        Daftar gratis untuk kemudahan pelacakan berkas sosial Anda secara terpusat.
                                    </p>
                                </div>

                                <form wire:submit="register" class="space-y-4">
                                    {{-- Nama Lengkap --}}
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap (Sesuai KTP) <span class="text-red-500">*</span></label>
                                        <input
                                            type="text"
                                            wire:model="name"
                                            placeholder="Contoh: Budi Santoso"
                                            class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                        @error('name') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        {{-- NIK --}}
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">NIK (16 Digit) <span class="text-red-500">*</span></label>
                                            <input
                                                type="text"
                                                maxlength="16"
                                                wire:model="nik"
                                                placeholder="3505xxxxxxxxxxxx"
                                                class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm font-mono input-focus">
                                            @error('nik') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>

                                        {{-- No. WhatsApp --}}
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor WhatsApp Aktif <span class="text-red-500">*</span></label>
                                            <input
                                                type="tel"
                                                wire:model="phone"
                                                placeholder="081234567890"
                                                class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                            @error('phone') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email (Opsional)</label>
                                        <input
                                            type="email"
                                            wire:model="email"
                                            placeholder="contoh@gmail.com"
                                            class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                        @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        {{-- Kecamatan --}}
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kecamatan Domisili</label>
                                            <select wire:model.live="districtId" class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                                <option value="">-- Pilih Kecamatan --</option>
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Desa / Kelurahan --}}
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Desa / Kelurahan</label>
                                            <select wire:model="villageId" class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm input-focus" {{ empty($districtId) ? 'disabled' : '' }}>
                                                <option value="">{{ empty($districtId) ? '-- Pilih Kecamatan Dahulu --' : '-- Pilih Desa / Kelurahan --' }}</option>
                                                @foreach ($villages as $village)
                                                    <option value="{{ $village->id }}">{{ $village->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        {{-- Password --}}
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi (Min. 6 Karakter) <span class="text-red-500">*</span></label>
                                            <input
                                                type="password"
                                                wire:model="password"
                                                placeholder="Minimal 6 karakter"
                                                class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                            @error('password') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>

                                        {{-- Password Confirmation --}}
                                        <div>
                                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Ulangi Kata Sandi <span class="text-red-500">*</span></label>
                                            <input
                                                type="password"
                                                wire:model="password_confirmation"
                                                placeholder="Ulangi kata sandi"
                                                class="w-full px-4 py-2.5 bg-white border border-slate-300 rounded-xl text-sm input-focus">
                                        </div>
                                    </div>

                                    {{-- Submit Button --}}
                                    <div class="pt-2">
                                        <button
                                            type="submit"
                                            wire:loading.attr="disabled"
                                            class="w-full py-3.5 px-6 bg-amber-500 hover:bg-amber-400 active:bg-amber-600 text-slate-900 font-bold rounded-xl text-sm transition-all shadow-md flex items-center justify-center gap-2">
                                            <span wire:loading.remove wire:target="register">Daftar Akun Sekarang</span>
                                            <span wire:loading wire:target="register" class="flex items-center gap-2">
                                                <svg class="w-4 h-4 animate-spin text-slate-900" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                                Mendaftarkan Akun...
                                            </span>
                                        </button>
                                    </div>
                                </form>

                                {{-- Switch to Login Prompt --}}
                                <div class="mt-6 text-center text-xs text-slate-500">
                                    Sudah memiliki akun warga?
                                    <button type="button" wire:click="switchTab('login')" class="text-primary-600 font-bold hover:underline ml-1">
                                        Masuk ke Akun
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Admin / Officer Login Quick Bar --}}
                    <div class="mt-8 pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs">
                        <span class="text-slate-500">Petugas / Administrator Dinas Sosial?</span>
                        <a href="/admin/login" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-primary-50 hover:bg-primary-100 text-primary-700 font-semibold rounded-xl transition-colors border border-primary-200">
                            <svg class="w-4 h-4 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Masuk ke Panel Admin Dinsos &rarr;
                        </a>
                    </div>
                </div>

                {{-- Right Column: Information & Guarantees (5 cols) --}}
                <div class="lg:col-span-5 bg-gradient-to-br from-primary-50 via-slate-50 to-primary-100/60 p-6 sm:p-8 flex flex-col justify-between border-t lg:border-t-0 lg:border-l border-slate-200">
                    <div class="space-y-6">
                        <div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-primary-100 text-primary-800 border border-primary-200 mb-3">
                                <svg class="w-3.5 h-3.5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                Keuntungan Akun Warga
                            </span>
                            <h3 class="text-lg font-bold text-slate-800">Kemudahan Layanan Satu Pintu</h3>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                Nikmati kemudahan mengurus berkas sosial tanpa harus berulang kali mengisi formulir identitas.
                            </p>
                        </div>

                        <div class="space-y-3.5 text-xs text-slate-700">
                            <div class="flex items-start gap-3 bg-white/80 backdrop-blur-xs p-3.5 rounded-2xl border border-slate-200/80 shadow-xs">
                                <div class="w-7 h-7 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <div>
                                    <strong class="text-slate-800 block mb-0.5">Histori Berkas & Surat Resmi TTE</strong>
                                    <span>Unduh kembali Surat DTSEN yang telah terbit kapan saja tanpa batas waktu kedaluwarsa dokumen digital.</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 bg-white/80 backdrop-blur-xs p-3.5 rounded-2xl border border-slate-200/80 shadow-xs">
                                <div class="w-7 h-7 rounded-xl bg-primary-100 text-primary-700 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                </div>
                                <div>
                                    <strong class="text-slate-800 block mb-0.5">Notifikasi Cepat Progres Verifikasi</strong>
                                    <span>Pemberitahuan berkas jika ada dokumen perbaikan secara langsung ke akun Anda.</span>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 bg-white/80 backdrop-blur-xs p-3.5 rounded-2xl border border-slate-200/80 shadow-xs">
                                <div class="w-7 h-7 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div>
                                    <strong class="text-slate-800 block mb-0.5">Pengajuan Lebih Singkat</strong>
                                    <span>Data NIK, nama, dan alamat otomatis terisi saat Anda mengajukan layanan berikutnya.</span>
                                </div>
                            </div>
                        </div>

                        {{-- Tracking reminder --}}
                        <div class="bg-amber-50 border border-amber-200/80 rounded-2xl p-4 text-xs text-amber-900">
                            <div class="flex items-center gap-1.5 font-bold mb-1">
                                <svg class="w-4 h-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Hanya Ingin Mengecek Status Tiket?
                            </div>
                            <p class="leading-relaxed">
                                Anda <strong>tidak wajib login</strong> untuk memantau status berkas Anda. Silakan langsung kunjungi menu
                                <a href="/cek-status" wire:navigate class="font-bold underline text-primary-700">Cek Status Tiket</a>.
                            </p>
                        </div>
                    </div>

                    {{-- Security Footer --}}
                    <div class="mt-8 pt-4 border-t border-slate-200/80 text-[11px] text-slate-500 flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        <span>Data dilindungi UU Perlindungan Data Pribadi (UU PDP No. 27/2022).</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="lg:hidden h-16"></div>
</div>
