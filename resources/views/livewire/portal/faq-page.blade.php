<div>
    {{-- Header --}}
    <section class="bg-gradient-to-r from-primary-700 to-primary-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <h1 class="text-3xl font-bold mb-2">Pertanyaan Umum (FAQ)</h1>
            <p class="text-white/80 max-w-xl">Temukan jawaban cepat seputar persyaratan, waktu penyelesaian, biaya, dan prosedur layanan sosial di SAPA SOSIAL.</p>
        </div>
    </section>

    {{-- FAQ Content --}}
    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- General FAQs --}}
            @if ($generalFaqs->count())
                <div class="mb-10">
                    <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Pertanyaan Umum
                    </h2>
                    <div class="space-y-3">
                        @foreach ($generalFaqs as $faq)
                            <div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
                                <button wire:click="toggleFaq({{ $faq->id }})" class="w-full text-left px-5 py-4 flex items-center justify-between gap-3 hover:bg-slate-50 transition-colors">
                                    <span class="font-semibold text-sm text-slate-700">{{ $faq->question }}</span>
                                    <svg @class(['w-5 h-5 text-slate-400 shrink-0 transition-transform duration-200', 'rotate-180' => $openFaq === $faq->id]) fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                @if ($openFaq === $faq->id)
                                    <div class="px-5 pb-4 border-t border-slate-100">
                                        <p class="text-sm text-slate-500 leading-relaxed pt-3">{!! nl2br(e($faq->answer)) !!}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Service-specific FAQs --}}
            @foreach ($serviceFaqs as $page)
                <div class="mb-10">
                    <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        {{ $page->title }}
                    </h2>
                    <div class="space-y-3">
                        @foreach ($page->faqs as $faq)
                            <div class="bg-white border border-slate-200 rounded-xl overflow-hidden">
                                <button wire:click="toggleFaq({{ $faq->id }})" class="w-full text-left px-5 py-4 flex items-center justify-between gap-3 hover:bg-slate-50 transition-colors">
                                    <span class="font-semibold text-sm text-slate-700">{{ $faq->question }}</span>
                                    <svg @class(['w-5 h-5 text-slate-400 shrink-0 transition-transform duration-200', 'rotate-180' => $openFaq === $faq->id]) fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                @if ($openFaq === $faq->id)
                                    <div class="px-5 pb-4 border-t border-slate-100">
                                        <p class="text-sm text-slate-500 leading-relaxed pt-3">{!! nl2br(e($faq->answer)) !!}</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            @if ($generalFaqs->isEmpty() && $serviceFaqs->isEmpty())
                <div class="text-center py-16">
                    <svg class="w-16 h-16 mx-auto mb-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <h3 class="text-lg font-semibold text-slate-600 mb-1">Belum Ada FAQ</h3>
                    <p class="text-sm text-slate-400">Pertanyaan umum akan segera ditampilkan di sini.</p>
                </div>
            @endif

            {{-- Contact CTA --}}
            <div class="bg-primary-50 border border-primary-200 rounded-2xl p-6 text-center">
                <h3 class="font-bold text-slate-800 mb-2">Tidak menemukan jawaban Anda?</h3>
                <p class="text-sm text-slate-500 mb-4">Hubungi tim layanan kami untuk mendapatkan bantuan lebih lanjut.</p>
                <div class="flex justify-center gap-3">
                    <a href="/pengaduan" wire:navigate class="px-5 py-2.5 text-sm font-semibold border border-primary-200 text-primary-700 rounded-xl hover:bg-primary-100 transition-colors">Kirim Pertanyaan</a>
                    <a href="https://wa.me/6281234567890" target="_blank" class="px-5 py-2.5 text-sm font-semibold bg-primary-600 text-white rounded-xl hover:bg-primary-500 transition-colors">WhatsApp Halo Dinsos</a>
                </div>
            </div>
        </div>
    </section>

    <div class="lg:hidden h-16"></div>
</div>
