<div>
    {{-- ==================== HERO SECTION ==================== --}}
    <section class="bg-gradient-to-br from-primary-700 via-primary-600 to-primary-800 text-white relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-amber-400 rounded-full -translate-y-1/2 translate-x-1/3 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-primary-300 rounded-full translate-y-1/3 -translate-x-1/4 blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16 relative">
            <div class="grid lg:grid-cols-5 gap-10 items-center">
                <div class="lg:col-span-3">
                    <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm text-white/90 text-xs font-medium px-3 py-1.5 rounded-full mb-4">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Portal Resmi Dinas Sosial Kabupaten Blitar
                    </div>

                    <h1 class="text-3xl lg:text-4xl font-bold leading-tight mb-4">
                        Layanan Sosial Kabupaten Blitar, <span class="text-amber-400">Satu Pintu</span>
                    </h1>
                    <p class="text-white/80 text-lg leading-relaxed mb-8 max-w-xl">
                        Akses pengajuan bantuan, penerbitan surat keterangan DTSEN, reaktivasi KIS/PBI-JK, serta pengaduan sosial secara transparan dan mudah dipantau dari rumah.
                    </p>

                    {{-- Search Bar --}}
                    <form wire:submit="searchServices" class="flex gap-2 mb-4">
                        <div class="flex-1 relative">
                            <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input wire:model="searchQuery" type="text" placeholder="Cari layanan, mis. surat DTSEN, KIS, bantuan disabilitas..." class="w-full pl-12 pr-4 py-3.5 rounded-xl text-slate-800 text-sm placeholder-slate-400 border-0 focus:ring-2 focus:ring-amber-400 shadow-lg">
                        </div>
                        <button type="submit" class="px-6 py-3.5 bg-amber-500 hover:bg-amber-400 text-slate-900 font-semibold rounded-xl transition-colors shadow-lg flex items-center gap-2 shrink-0">
                            Temukan
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                    </form>

                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach (['Surat DTSEN', 'BPJS/KIS', 'Bantuan Lansia', 'Bencana'] as $tag)
                            <button wire:click="$set('searchQuery', '{{ $tag }}')" class="px-3 py-1 bg-white/10 hover:bg-white/20 text-white/80 text-xs rounded-full transition-colors">{{ $tag }}</button>
                        @endforeach
                    </div>

                    <div class="flex gap-3">
                        <a href="/layanan" wire:navigate class="inline-flex items-center gap-2 px-5 py-3 bg-amber-500 hover:bg-amber-400 text-slate-900 font-semibold rounded-xl transition-colors shadow-md">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Ajukan Layanan
                        </a>
                        <a href="/pengaduan" wire:navigate class="inline-flex items-center gap-2 px-5 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl border border-white/20 transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            Sampaikan Pengaduan
                        </a>
                    </div>
                </div>

                {{-- Stats Panel --}}
                <div class="lg:col-span-2">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/10">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xs font-medium text-white/70 uppercase tracking-wider">Statistik Pelayanan Hari Ini</span>
                            <span class="flex items-center gap-1 text-emerald-300 text-xs"><span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>Server Aktif</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/10 rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-amber-400">1.428</div>
                                <div class="text-xs text-white/60 mt-1">Surat Terbit 2026</div>
                            </div>
                            <div class="bg-white/10 rounded-xl p-4 text-center">
                                <div class="text-2xl font-bold text-emerald-400">98.4%</div>
                                <div class="text-xs text-white/60 mt-1">Kepuasan Warga</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== CEK STATUS SECTION ==================== --}}
    <section class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-primary-50/50 rounded-2xl p-6 border border-primary-100">
                <div class="flex items-start gap-3 mb-4">
                    <div class="p-2 bg-primary-100 rounded-lg">
                        <svg class="w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Cek Status Pengajuan & Tiket Layanan</h2>
                        <p class="text-sm text-slate-500">Pantau proses verifikasi permohonan Anda secara langsung tanpa perlu datang ke kantor</p>
                    </div>
                </div>
                <form wire:submit="checkTicket" class="grid sm:grid-cols-12 gap-4 items-end">
                    <div class="sm:col-span-5">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nomor Tiket Permohonan *</label>
                        <input wire:model="ticketNumber" type="text" placeholder="Contoh: DTSEN-202610-00012" class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm input-focus">
                    </div>
                    <div class="sm:col-span-4">
                        <label class="block text-sm font-medium text-slate-700 mb-1">4 Digit Terakhir NIK / No. HP *</label>
                        <input wire:model="ticketVerifier" type="text" maxlength="4" placeholder="Contoh: 4092" class="w-full px-4 py-3 border border-slate-300 rounded-xl text-sm input-focus">
                    </div>
                    <div class="sm:col-span-3">
                        <button type="submit" class="w-full px-6 py-3 bg-primary-600 hover:bg-primary-500 text-white font-semibold rounded-xl transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            Cek Status Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- ==================== EMERGENCY ALERT ==================== --}}
    <section class="bg-red-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <a href="/pengajuan/pbi" wire:navigate class="flex items-center justify-between group">
                <div class="flex items-center gap-3">
                    <span class="px-2 py-0.5 bg-white/20 text-xs font-bold rounded uppercase">Prioritas Darurat 24 Jam</span>
                    <span class="text-sm font-medium">Pasien Gawat Darurat di Rumah Sakit?</span>
                    <span class="hidden sm:inline text-sm text-white/80">— Reaktivasi cepat KIS/PBI-JK difasilitasi melalui jalur sapa Rumah Sakit & Dinsos Blitar.</span>
                </div>
                <div class="flex items-center gap-2 text-sm font-semibold shrink-0 bg-white/10 px-3 py-1.5 rounded-lg group-hover:bg-white/20 transition-colors">
                    Prosedur Darurat Medis
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </div>
            </a>
        </div>
    </section>

    {{-- ==================== LAYANAN UTAMA ==================== --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <p class="text-xs font-semibold text-primary-600 uppercase tracking-wider mb-1">Katalog Resmi Layanan</p>
                    <h2 class="text-2xl lg:text-3xl font-bold text-slate-800">Layanan Utama Terpadu</h2>
                    <p class="text-slate-500 mt-1">Pilih jenis layanan sosial yang Anda butuhkan secara online tanpa perlu antri di kantor.</p>
                </div>
                <a href="/layanan" wire:navigate class="hidden sm:flex items-center gap-1 text-sm font-semibold text-primary-600 hover:text-primary-700 transition-colors">
                    Lihat Semua Daftar Layanan
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                {{-- Surat Keterangan DTSEN --}}
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden card-hover group">
                    <div class="h-44 bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                        <svg class="w-20 h-20 text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="badge-process text-xs font-semibold px-2.5 py-0.5 rounded-full">1-2 Hari Kerja</span>
                            <span class="badge-success text-xs font-semibold px-2.5 py-0.5 rounded-full">GRATIS (Rp 0)</span>
                        </div>
                        <h3 class="font-bold text-lg text-slate-800 mb-2">Surat Keterangan DTSEN</h3>
                        <p class="text-sm text-slate-500 mb-4 line-clamp-2">Penerbitan surat rekomendasi resmi kepesertaan basis data terpadu untuk keperluan seleksi SPMB afirmasi jenjang sekolah menengah, KIP...</p>
                        <div class="text-xs text-slate-400 mb-4 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                            Persyaratan: KTP & Kartu Keluarga Asli
                        </div>
                        <div class="flex gap-3">
                            <a href="/layanan/surat-keterangan-dtsen" wire:navigate class="flex-1 text-center py-2.5 text-sm font-medium border border-slate-200 rounded-xl text-slate-700 hover:bg-slate-50 transition-colors">Lihat Detail</a>
                            <a href="/pengajuan/dtsen" wire:navigate class="flex-1 text-center py-2.5 text-sm font-semibold bg-amber-500 hover:bg-amber-400 text-slate-900 rounded-xl transition-colors">Ajukan</a>
                        </div>
                    </div>
                </div>

                {{-- Reaktivasi KIS / PBI-JK --}}
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden card-hover group">
                    <div class="h-44 bg-gradient-to-br from-amber-50 to-amber-100 flex items-center justify-center">
                        <svg class="w-20 h-20 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="badge-warning text-xs font-semibold px-2.5 py-0.5 rounded-full">3-5 Hari Kerja</span>
                            <span class="badge-success text-xs font-semibold px-2.5 py-0.5 rounded-full">GRATIS (Rp 0)</span>
                        </div>
                        <h3 class="font-bold text-lg text-slate-800 mb-2">Reaktivasi KIS / PBI-JK</h3>
                        <p class="text-sm text-slate-500 mb-4 line-clamp-2">Pengaktifan kembali kepesertaan Jaminan Kesehatan Nasional bagi warga desil rentan yang nonaktif, dengan prioritas bagi kasus darurat medis...</p>
                        <div class="text-xs text-slate-400 mb-4 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                            Persyaratan: KTP, KK, Kartu KIS & Ket. Medis
                        </div>
                        <div class="flex gap-3">
                            <a href="/layanan/reaktivasi-kis-pbi-jk" wire:navigate class="flex-1 text-center py-2.5 text-sm font-medium border border-slate-200 rounded-xl text-slate-700 hover:bg-slate-50 transition-colors">Lihat Detail</a>
                            <a href="/pengajuan/pbi" wire:navigate class="flex-1 text-center py-2.5 text-sm font-semibold bg-amber-500 hover:bg-amber-400 text-slate-900 rounded-xl transition-colors">Ajukan</a>
                        </div>
                    </div>
                </div>

                {{-- Pelayanan Rehabilitasi Sosial --}}
                <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden card-hover group">
                    <div class="h-44 bg-gradient-to-br from-teal-50 to-teal-100 flex items-center justify-center">
                        <svg class="w-20 h-20 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="badge-process text-xs font-semibold px-2.5 py-0.5 rounded-full">2-4 Hari Kerja</span>
                            <span class="badge-success text-xs font-semibold px-2.5 py-0.5 rounded-full">GRATIS (Rp 0)</span>
                        </div>
                        <h3 class="font-bold text-lg text-slate-800 mb-2">Pelayanan Rehabilitasi Sosial</h3>
                        <p class="text-sm text-slate-500 mb-4 line-clamp-2">Bantuan dan rujukan pendampingan lansia terlantar, anak berhadapan hukum (ABH), penyandang disabilitas, serta penanganan warga terlantar...</p>
                        <div class="text-xs text-slate-400 mb-4 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                            Persyaratan: Identitas & Surat Pengantar Desa
                        </div>
                        <div class="flex gap-3">
                            <a href="/layanan/rehabilitasi-sosial" wire:navigate class="flex-1 text-center py-2.5 text-sm font-medium border border-slate-200 rounded-xl text-slate-700 hover:bg-slate-50 transition-colors">Lihat Detail</a>
                            <a href="/layanan" wire:navigate class="flex-1 text-center py-2.5 text-sm font-semibold bg-amber-500 hover:bg-amber-400 text-slate-900 rounded-xl transition-colors">Ajukan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ==================== ALUR PENGAJUAN ==================== --}}
    <section class="py-16 bg-[#F5F8FC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <p class="text-xs font-semibold text-primary-600 uppercase tracking-wider mb-1">Panduan Praktis</p>
                <h2 class="text-2xl lg:text-3xl font-bold text-slate-800">Alur Pengajuan Mudah & Cepat</h2>
                <p class="text-slate-500 mt-2 max-w-lg mx-auto">Empat tahapan sederhana dalam satu alur terpadu tanpa perlu mondar-mandir antar loket</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ([
                    ['num' => '1', 'title' => 'Pilih Layanan', 'desc' => 'Telusuri program sosial, verifikasi DTSEN, atau bantuan alat yang sesuai kebutuhan Anda.', 'icon' => 'M4 6h16M4 10h16M4 14h16M4 18h16'],
                    ['num' => '2', 'title' => 'Isi Formulir & Berkas', 'desc' => 'Input NIK sesuai KK dan unggah foto dokumen asli secara jelas, langsung lewat kamera HP.', 'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
                    ['num' => '3', 'title' => 'Dapatkan Nomor Tiket', 'desc' => 'Sistem mengirimkan kode tanda terima instan ke layar Anda dan notifikasi pesan WhatsApp.', 'icon' => 'M7 20l4-16m2 16l4-16M6 9h14M4 15h14'],
                    ['num' => '4', 'title' => 'Pantau Status Online', 'desc' => 'Lacak progres verifikasi petugas hingga surat resmi terbit atau jadwal penyaluran ditetapkan.', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                ] as $step)
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-card text-center">
                        <div class="w-12 h-12 bg-primary-600 text-white font-bold text-xl rounded-full flex items-center justify-center mx-auto mb-4">{{ $step['num'] }}</div>
                        <p class="text-xs font-semibold text-primary-500 uppercase tracking-wider mb-1">Langkah {{ $step['num'] }}</p>
                        <h3 class="font-bold text-slate-800 mb-2">{{ $step['title'] }}</h3>
                        <p class="text-sm text-slate-500 leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ==================== INFORMASI TERBARU ==================== --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-end justify-between mb-8">
                <div>
                    <p class="text-xs font-semibold text-primary-600 uppercase tracking-wider mb-1">Warta Sosial Terkini</p>
                    <h2 class="text-2xl lg:text-3xl font-bold text-slate-800">Informasi Terbaru & Pengumuman</h2>
                    <p class="text-slate-500 mt-1">Sosialisasi regulasi, jadwal pemutakhiran data terpadu, dan warta program bantuan sosial daerah.</p>
                </div>
                <a href="/layanan" wire:navigate class="hidden sm:flex items-center gap-1 text-sm font-semibold text-primary-600 hover:text-primary-700">
                    Area Berita Lengkap
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @forelse ($latestInfos as $info)
                    <article class="bg-white border border-slate-200 rounded-2xl overflow-hidden card-hover">
                        <div class="h-48 bg-gradient-to-br from-slate-100 to-slate-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center gap-2 text-xs text-slate-400 mb-2">
                                <span>{{ $info->published_at?->translatedFormat('d M Y') }}</span>
                                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                <span>{{ $info->category?->value ?? 'Informasi' }}</span>
                            </div>
                            <h3 class="font-bold text-slate-800 mb-2 line-clamp-2">{{ $info->title }}</h3>
                            <p class="text-sm text-slate-500 line-clamp-3 mb-4">{{ Str::limit(strip_tags($info->description), 120) }}</p>
                            <a href="/layanan/{{ $info->slug }}" wire:navigate class="text-sm font-semibold text-primary-600 hover:text-primary-700 flex items-center gap-1">
                                Baca Selengkapnya
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="md:col-span-3 text-center py-12 text-slate-400">
                        <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        <p>Belum ada informasi terbaru.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- ==================== FAQ + QUICK COMPLAINT ==================== --}}
    <section class="py-16 bg-[#F5F8FC]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-5 gap-10">
                {{-- FAQ Column --}}
                <div class="lg:col-span-3">
                    <p class="text-xs font-semibold text-primary-600 uppercase tracking-wider mb-1">Paling Sering Ditanyakan</p>
                    <h2 class="text-2xl font-bold text-slate-800 mb-2">Pertanyaan Umum (FAQ)</h2>
                    <p class="text-slate-500 text-sm mb-6">Temukan jawaban cepat seputar persyaratan, waktu penyelesaian, dan keabsahan surat resmi.</p>

                    <div class="space-y-3" x-data="{ openFaq: null }">
                        @forelse ($faqs as $index => $faq)
                            <div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
                                <button @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}" class="w-full text-left px-5 py-4 flex items-center justify-between gap-3 hover:bg-slate-50 transition-colors">
                                    <span class="font-semibold text-sm text-slate-700">{{ $faq->question }}</span>
                                    <svg :class="{ 'rotate-180': openFaq === {{ $index }} }" class="w-5 h-5 text-slate-400 shrink-0 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <div x-show="openFaq === {{ $index }}" x-cloak x-collapse class="px-5 pb-4">
                                    <p class="text-sm text-slate-500 leading-relaxed">{!! nl2br(e($faq->answer)) !!}</p>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white border border-slate-200 rounded-xl p-6 text-center text-slate-400 text-sm">
                                <p>Pertanyaan umum akan segera ditampilkan di sini.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Quick Complaint Sidebar --}}
                <div class="lg:col-span-2">
                    <div class="bg-primary-700 rounded-2xl p-6 text-white">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-white/10 rounded-lg">
                                <svg class="w-5 h-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">Kotak Aspirasi & Aduan Cepat</h3>
                                <p class="text-white/70 text-xs">Langsung diteruskan oleh Transparan Dinsos</p>
                            </div>
                        </div>
                        <p class="text-white/70 text-sm mb-5">Menyampaikan data bantuan yang tidak tepat sasaran, keluhan pelayanan staf, atau kendala aktivasi KIS? Sampaikan secara aman dan rahasia.</p>

                        <div class="space-y-3">
                            <a href="/pengaduan" wire:navigate class="block w-full py-3 text-center bg-amber-500 hover:bg-amber-400 text-slate-900 font-semibold rounded-xl transition-colors">
                                Kirimkan Aduan Anda
                            </a>
                            <a href="https://wa.me/6281234567890" target="_blank" class="block w-full py-3 text-center bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl border border-white/20 transition-colors">
                                <span class="flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                    WhatsApp Halo Dinsos
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Bottom padding for mobile dock --}}
    <div class="lg:hidden h-16"></div>
</div>
