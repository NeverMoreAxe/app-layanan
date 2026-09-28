{{-- Portal Navbar --}}
<header class="bg-white border-b border-slate-200 sticky top-0 z-50" x-data="{ mobileOpen: false }">
    {{-- Government Info Bar --}}
    <div class="bg-primary-700 text-white/90 text-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-1.5 flex items-center justify-between">
            <div class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <span>Portal Resmi Dinas Sosial Kabupaten Blitar</span>
            </div>
            <span class="hidden sm:inline">Layanan Cepat & Bebas Pungli</span>
        </div>
    </div>

    {{-- Main Navbar --}}
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="/" class="flex items-center gap-3 shrink-0" wire:navigate>
                <img src="{{ asset('images/logo-sapa-sosial.png') }}" alt="Logo SAPA SOSIAL" class="h-10 w-10 rounded-full object-cover">
                <div>
                    <div class="text-primary-700 font-bold text-lg leading-tight tracking-tight">SAPA SOSIAL</div>
                    <div class="text-slate-500 text-[11px] leading-tight">Dinas Sosial Kab. Blitar</div>
                </div>
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center gap-0.5">
                @php
                    $navLinks = [
                        ['url' => '/', 'label' => 'Beranda'],
                        ['url' => '/layanan', 'label' => 'Informasi Layanan'],
                        ['url' => '/pengaduan', 'label' => 'Pengaduan'],
                        ['url' => '/cek-status', 'label' => 'Cek Status'],
                        ['url' => '/verifikasi', 'label' => 'Verifikasi Surat'],
                        ['url' => '/faq', 'label' => 'FAQ'],
                    ];
                @endphp
                @foreach ($navLinks as $link)
                    <a href="{{ $link['url'] }}"
                       wire:navigate
                       @class([
                           'px-3 py-2 text-sm font-medium rounded-lg transition-colors duration-150',
                           'text-primary-700 bg-primary-50' => request()->is(ltrim($link['url'], '/') ?: '/'),
                           'text-slate-600 hover:text-primary-600 hover:bg-primary-50/60' => !request()->is(ltrim($link['url'], '/') ?: '/'),
                       ])>
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Auth Buttons (Desktop) --}}
            <div class="hidden lg:flex items-center gap-3">
                @auth
                    @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin', 'Kepala Dinas', 'Kabid', 'Verifikator', 'Petugas', 'Operator Kecamatan', 'Operator Desa']))
                        <a href="/admin" class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-primary-50 text-primary-700 hover:bg-primary-100 transition-colors border border-primary-200">
                            Panel Admin
                        </a>
                    @endif
                    <div class="flex items-center gap-2 text-xs font-medium text-slate-700 bg-slate-50 px-3 py-1.5 rounded-xl border border-slate-200">
                        <div class="w-6 h-6 rounded-full bg-primary-600 text-white flex items-center justify-center font-bold text-[10px]">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="max-w-[120px] truncate">{{ auth()->user()->name }}</span>
                    </div>
                    <a href="/logout" class="text-xs font-semibold text-red-600 hover:text-red-700 hover:underline">Keluar</a>
                @else
                    <a href="/login" wire:navigate class="text-sm font-semibold text-primary-600 hover:text-primary-700 transition-colors">Masuk</a>
                    <a href="/register" wire:navigate class="inline-flex items-center px-4 py-2 bg-amber-500 text-slate-900 text-sm font-semibold rounded-lg hover:bg-amber-400 active:bg-amber-600 transition-colors shadow-sm">
                        Daftar
                    </a>
                @endauth
            </div>

            {{-- Mobile Menu Button --}}
            <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 transition-colors" aria-label="Toggle menu">
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
    </nav>

    {{-- Mobile Menu --}}
    <div x-show="mobileOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="lg:hidden border-t border-slate-200 bg-white shadow-lg">
        <div class="px-4 py-3 space-y-1">
            @foreach ($navLinks as $link)
                <a href="{{ $link['url'] }}"
                   wire:navigate
                   @click="mobileOpen = false"
                   @class([
                       'block px-3 py-2.5 text-sm font-medium rounded-lg transition-colors',
                       'text-primary-700 bg-primary-50' => request()->is(ltrim($link['url'], '/') ?: '/'),
                       'text-slate-600 hover:text-primary-600 hover:bg-slate-50' => !request()->is(ltrim($link['url'], '/') ?: '/'),
                   ])>
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
        <div class="px-4 py-3 border-t border-slate-100">
            @auth
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-primary-600 text-white flex items-center justify-center font-bold text-xs">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-bold text-xs text-slate-800">{{ auth()->user()->name }}</div>
                            <div class="text-[10px] text-slate-400">{{ auth()->user()->email ?: auth()->user()->phone }}</div>
                        </div>
                    </div>
                    <a href="/logout" class="text-xs font-semibold text-red-600">Keluar</a>
                </div>
                @if (auth()->user()->hasAnyRole(['Super Admin', 'Admin', 'Kepala Dinas', 'Kabid', 'Verifikator', 'Petugas', 'Operator Kecamatan', 'Operator Desa']))
                    <a href="/admin" class="block w-full text-center py-2 text-xs font-semibold bg-primary-50 text-primary-700 rounded-lg mb-2">Buka Panel Admin</a>
                @endif
            @else
                <div class="flex gap-3">
                    <a href="/login" wire:navigate class="flex-1 text-center py-2.5 text-sm font-semibold text-primary-600 border border-primary-200 rounded-lg hover:bg-primary-50 transition-colors">Masuk</a>
                    <a href="/register" wire:navigate class="flex-1 text-center py-2.5 text-sm font-semibold bg-amber-500 text-slate-900 rounded-lg hover:bg-amber-400 transition-colors">Daftar</a>
                </div>
            @endauth
        </div>
    </div>
</header>
