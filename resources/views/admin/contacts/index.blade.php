@extends('admin.layout')

@section('title', 'Store Contacts & Social Media')
@section('header_title', 'Maison Identity & Social Concierge')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Header Banner -->
    <div class="glass-card-luxury p-5 sm:p-7 rounded-3xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5 mb-1">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                <h3 class="font-cinzel font-bold text-lg sm:text-xl text-white">Live Store Contacts & Social Links</h3>
            </div>
            <p class="text-xs text-stone-400">
                Configure real-time WhatsApp order numbers, social media handles, and customer care lines.
            </p>
        </div>

        <a href="{{ route('home') }}" target="_blank"
            class="px-4 py-2.5 rounded-2xl bg-white/5 hover:bg-white/10 text-amber-300 text-xs font-bold flex items-center justify-center gap-2 border border-white/10 transition">
            <i class="fa-solid fa-store text-amber-400 text-xs"></i>
            <span>Preview Storefront</span>
        </a>
    </div>

    <!-- Main Settings Form -->
    <form action="{{ route('admin.contacts.update') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        @csrf

        <!-- LEFT COLUMN: WhatsApp & Social Media (7 cols) -->
        <div class="lg:col-span-7 space-y-6">

            <!-- 1. WHATSAPP CONFIGURATION CARD -->
            <div class="glass-card-luxury p-5 sm:p-7 rounded-3xl space-y-4">
                <div class="flex items-center gap-3.5 border-b border-white/5 pb-4">
                    <div class="w-11 h-11 rounded-2xl bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 flex items-center justify-center text-lg shadow-md">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div>
                        <h4 class="font-cinzel font-bold text-base text-white">WhatsApp 1-Click Ordering</h4>
                        <p class="text-xs text-stone-400">Direct concierge checkout and instant bridal assistance</p>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        WhatsApp Number <span class="text-amber-400">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-emerald-400 font-mono text-xs">
                            <i class="fa-brands fa-whatsapp text-sm mr-1"></i>
                        </span>
                        <input type="text" name="whatsapp_number" value="{{ $settings['whatsapp_number'] ?? '923001234567' }}" 
                            placeholder="e.g. 03001234567 or 923001234567" required
                            class="w-full pl-11 pr-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white font-mono placeholder-stone-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>
                    <p class="text-[11px] text-stone-500 mt-1">Customers clicking "Buy on WhatsApp" will automatically open chats with this direct number.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        Default WhatsApp Greeting Message
                    </label>
                    <textarea name="whatsapp_greeting" rows="2" placeholder="Hi ZVARR! I want to inquire about..."
                        class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition resize-none">{{ $settings['whatsapp_greeting'] ?? 'Hi ZVARR by Zaiyal! I want to inquire about your jewellery collections.' }}</textarea>
                </div>

                @if(!empty($settings['whatsapp_number']))
                    <div class="pt-1">
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] }}" target="_blank"
                            class="inline-flex items-center gap-2 text-xs text-emerald-400 hover:text-emerald-300 font-semibold transition">
                            <i class="fa-solid fa-paper-plane text-[10px]"></i>
                            <span>Test Live WhatsApp Chat (wa.me/{{ $settings['whatsapp_number'] }})</span>
                        </a>
                    </div>
                @endif
            </div>

            <!-- 2. SOCIAL MEDIA LINKS CARD -->
            <div class="glass-card-luxury p-5 sm:p-7 rounded-3xl space-y-4">
                <div class="flex items-center gap-3.5 border-b border-white/5 pb-4">
                    <div class="w-11 h-11 rounded-2xl bg-amber-400/10 text-amber-300 border border-amber-400/20 flex items-center justify-center text-lg shadow-md">
                        <i class="fa-solid fa-share-nodes"></i>
                    </div>
                    <div>
                        <h4 class="font-cinzel font-bold text-base text-white">Social Media Showcase</h4>
                        <p class="text-xs text-stone-400">Leave blank to automatically hide any link from the footer</p>
                    </div>
                </div>

                <!-- Instagram -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2 flex items-center justify-between">
                        <span>Instagram Profile URL</span>
                        @if(!empty($settings['instagram_url']))
                            <a href="{{ $settings['instagram_url'] }}" target="_blank" class="text-[10.5px] text-amber-300 hover:underline">Test Link <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i></a>
                        @endif
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-rose-400">
                            <i class="fa-brands fa-instagram text-sm"></i>
                        </span>
                        <input type="url" name="instagram_url" value="{{ $settings['instagram_url'] ?? '' }}"
                            placeholder="https://instagram.com/zvarrjewelspk"
                            class="w-full pl-11 pr-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>
                </div>

                <!-- Facebook -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2 flex items-center justify-between">
                        <span>Facebook Page URL</span>
                        @if(!empty($settings['facebook_url']))
                            <a href="{{ $settings['facebook_url'] }}" target="_blank" class="text-[10.5px] text-amber-300 hover:underline">Test Link <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i></a>
                        @endif
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-blue-400">
                            <i class="fa-brands fa-facebook-f text-sm"></i>
                        </span>
                        <input type="url" name="facebook_url" value="{{ $settings['facebook_url'] ?? '' }}"
                            placeholder="https://facebook.com/zvarrjewelspk"
                            class="w-full pl-11 pr-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>
                </div>

                <!-- TikTok -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2 flex items-center justify-between">
                        <span>TikTok Showcase URL</span>
                        @if(!empty($settings['tiktok_url']))
                            <a href="{{ $settings['tiktok_url'] }}" target="_blank" class="text-[10.5px] text-amber-300 hover:underline">Test Link <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i></a>
                        @endif
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-stone-300">
                            <i class="fa-brands fa-tiktok text-sm"></i>
                        </span>
                        <input type="url" name="tiktok_url" value="{{ $settings['tiktok_url'] ?? '' }}"
                            placeholder="https://tiktok.com/@zvarrjewelspk"
                            class="w-full pl-11 pr-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>
                </div>

            </div>

        </div>

        <!-- RIGHT COLUMN: Contact Info & Action (5 cols) -->
        <div class="lg:col-span-5 space-y-6">

            <!-- 3. STORE CONTACT & ADDRESS CARD -->
            <div class="glass-card-luxury p-5 sm:p-7 rounded-3xl space-y-4">
                <div class="flex items-center gap-3.5 border-b border-white/5 pb-4">
                    <div class="w-11 h-11 rounded-2xl bg-blue-500/10 text-blue-400 border border-blue-500/20 flex items-center justify-center text-lg shadow-md">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div>
                        <h4 class="font-cinzel font-bold text-base text-white">Maison Concierge Care</h4>
                        <p class="text-xs text-stone-400">Direct phone line & support inbox</p>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        Direct Phone Line
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-amber-400">
                            <i class="fa-solid fa-phone text-xs"></i>
                        </span>
                        <input type="text" name="phone" value="{{ $settings['phone'] ?? '+92 300 1234567' }}"
                            placeholder="+92 300 1234567"
                            class="w-full pl-11 pr-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        Official Concierge Email
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-amber-400">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </span>
                        <input type="email" name="email" value="{{ $settings['email'] ?? 'concierge@zvarrjewels.pk' }}"
                            placeholder="concierge@zvarrjewels.pk"
                            class="w-full pl-11 pr-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        Physical Boutique Address
                    </label>
                    <input type="text" name="address" value="{{ $settings['address'] ?? 'Karachi, Pakistan' }}"
                        placeholder="e.g. Karachi, Pakistan"
                        class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                </div>
            </div>

            <!-- 4. LIVE PREVIEW BADGES & SAVE BUTTON -->
            <div class="glass-card-luxury p-5 sm:p-7 rounded-3xl space-y-4">
                <h4 class="font-cinzel font-bold text-base text-white mb-1">Active Channels Radar</h4>
                <p class="text-xs text-stone-400 mb-3">Live channels currently visible on your boutique</p>

                <div class="flex flex-wrap gap-2 text-xs">
                    @if(!empty($settings['whatsapp_number']))
                        <span class="px-3.5 py-1.5 rounded-full bg-emerald-500/15 text-emerald-300 border border-emerald-500/30 font-bold flex items-center gap-1.5 shadow-sm">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp Live
                        </span>
                    @endif
                    @if(!empty($settings['instagram_url']))
                        <span class="px-3.5 py-1.5 rounded-full bg-rose-500/15 text-rose-300 border border-rose-500/30 font-bold flex items-center gap-1.5 shadow-sm">
                            <i class="fa-brands fa-instagram"></i> Instagram Live
                        </span>
                    @endif
                    @if(!empty($settings['facebook_url']))
                        <span class="px-3.5 py-1.5 rounded-full bg-blue-500/15 text-blue-300 border border-blue-500/30 font-bold flex items-center gap-1.5 shadow-sm">
                            <i class="fa-brands fa-facebook-f"></i> Facebook Live
                        </span>
                    @endif
                    @if(!empty($settings['tiktok_url']))
                        <span class="px-3.5 py-1.5 rounded-full bg-stone-500/15 text-stone-300 border border-stone-500/30 font-bold flex items-center gap-1.5 shadow-sm">
                            <i class="fa-brands fa-tiktok"></i> TikTok Live
                        </span>
                    @endif
                </div>

                <button type="submit"
                    class="w-full py-4 rounded-2xl bg-gradient-to-r from-amber-300 via-amber-400 to-amber-500 hover:from-amber-200 hover:to-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider shadow-xl shadow-amber-500/25 transition transform hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2 mt-4">
                    <i class="fa-solid fa-floppy-disk text-sm"></i>
                    <span>Save All Maison Settings</span>
                </button>
            </div>

        </div>

    </form>

</div>
@endsection
