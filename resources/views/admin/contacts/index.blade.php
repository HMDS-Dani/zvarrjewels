@extends('admin.layout')

@section('title', 'Store Contacts & Social Media')
@section('header_title', 'Contacts & Social Links')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Header Banner -->
    <div class="p-5 sm:p-7 rounded-2xl sm:rounded-3xl bg-slate-900 border border-slate-800 shadow-xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                <h3 class="font-serif font-bold text-lg sm:text-xl text-slate-100">Live Store Contacts & Social Links</h3>
            </div>
            <p class="text-xs text-slate-400">
                Manage your live WhatsApp order number, Instagram, Facebook, and contact info in real-time.
            </p>
        </div>

        <a href="{{ route('home') }}" target="_blank"
            class="px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-amber-300 text-xs font-semibold flex items-center justify-center gap-2 border border-slate-700 transition">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span>View Live Store</span>
        </a>
    </div>

    <!-- Main Settings Form -->
    <form action="{{ route('admin.contacts.update') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        @csrf

        <!-- LEFT COLUMN: WhatsApp & Social Media (7 cols) -->
        <div class="lg:col-span-7 space-y-6">

            <!-- 1. WHATSAPP CONFIGURATION CARD -->
            <div class="p-5 sm:p-7 rounded-2xl sm:rounded-3xl bg-slate-900 border border-slate-800 shadow-xl space-y-4">
                <div class="flex items-center gap-3 border-b border-slate-800 pb-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 flex items-center justify-center text-lg">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <div>
                        <h4 class="font-serif font-bold text-base text-slate-100">WhatsApp Order System</h4>
                        <p class="text-xs text-slate-400">Primary channel for 1-click orders and customer inquiries</p>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                        WhatsApp Number <span class="text-amber-400">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-emerald-400 font-mono text-xs">
                            <i class="fa-brands fa-whatsapp text-sm mr-1"></i>
                        </span>
                        <input type="text" name="whatsapp_number" value="{{ $settings['whatsapp_number'] ?? '923001234567' }}" 
                            placeholder="e.g. 03001234567 or 923001234567" required
                            class="w-full pl-9 pr-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 font-mono placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <p class="text-[11px] text-slate-500 mt-1">Customers clicking "Order via WhatsApp" will be redirected to chat with this number.</p>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                        Default WhatsApp Greeting Message
                    </label>
                    <textarea name="whatsapp_greeting" rows="2" placeholder="Hi ZVARR! I want to inquire about..."
                        class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 resize-none">{{ $settings['whatsapp_greeting'] ?? 'Hi ZVARR by Zaiyal! I want to inquire about your jewellery collections.' }}</textarea>
                </div>

                @if(!empty($settings['whatsapp_number']))
                    <div class="pt-1">
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] }}" target="_blank"
                            class="inline-flex items-center gap-1.5 text-xs text-emerald-400 hover:text-emerald-300 transition">
                            <i class="fa-solid fa-paper-plane text-[10px]"></i>
                            <span>Test Live WhatsApp Chat (wa.me/{{ $settings['whatsapp_number'] }})</span>
                        </a>
                    </div>
                @endif
            </div>

            <!-- 2. SOCIAL MEDIA LINKS CARD -->
            <div class="p-5 sm:p-7 rounded-2xl sm:rounded-3xl bg-slate-900 border border-slate-800 shadow-xl space-y-4">
                <div class="flex items-center gap-3 border-b border-slate-800 pb-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 text-amber-400 border border-amber-500/20 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-share-nodes"></i>
                    </div>
                    <div>
                        <h4 class="font-serif font-bold text-base text-slate-100">Social Media Profiles</h4>
                        <p class="text-xs text-slate-400">Leave blank to hide any social icon from the storefront</p>
                    </div>
                </div>

                <!-- Instagram -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5 flex items-center justify-between">
                        <span>Instagram Profile URL</span>
                        @if(!empty($settings['instagram_url']))
                            <a href="{{ $settings['instagram_url'] }}" target="_blank" class="text-[10.5px] text-amber-400 hover:underline">Test Link <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i></a>
                        @endif
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-rose-400">
                            <i class="fa-brands fa-instagram text-sm"></i>
                        </span>
                        <input type="url" name="instagram_url" value="{{ $settings['instagram_url'] ?? '' }}"
                            placeholder="https://instagram.com/zvarrjewelspk"
                            class="w-full pl-9 pr-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>

                <!-- Facebook -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5 flex items-center justify-between">
                        <span>Facebook Page URL</span>
                        @if(!empty($settings['facebook_url']))
                            <a href="{{ $settings['facebook_url'] }}" target="_blank" class="text-[10.5px] text-amber-400 hover:underline">Test Link <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i></a>
                        @endif
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-blue-400">
                            <i class="fa-brands fa-facebook-f text-sm"></i>
                        </span>
                        <input type="url" name="facebook_url" value="{{ $settings['facebook_url'] ?? '' }}"
                            placeholder="https://facebook.com/zvarrjewelspk"
                            class="w-full pl-9 pr-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>

                <!-- TikTok -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5 flex items-center justify-between">
                        <span>TikTok Profile URL</span>
                        @if(!empty($settings['tiktok_url']))
                            <a href="{{ $settings['tiktok_url'] }}" target="_blank" class="text-[10.5px] text-amber-400 hover:underline">Test Link <i class="fa-solid fa-arrow-up-right-from-square text-[9px]"></i></a>
                        @endif
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-300">
                            <i class="fa-brands fa-tiktok text-sm"></i>
                        </span>
                        <input type="url" name="tiktok_url" value="{{ $settings['tiktok_url'] ?? '' }}"
                            placeholder="https://tiktok.com/@zvarrjewelspk"
                            class="w-full pl-9 pr-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>

            </div>

        </div>

        <!-- RIGHT COLUMN: Contact Info & Action (5 cols) -->
        <div class="lg:col-span-5 space-y-6">

            <!-- 3. STORE CONTACT & ADDRESS CARD -->
            <div class="p-5 sm:p-7 rounded-2xl sm:rounded-3xl bg-slate-900 border border-slate-800 shadow-xl space-y-4">
                <div class="flex items-center gap-3 border-b border-slate-800 pb-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 text-blue-400 border border-blue-500/20 flex items-center justify-center text-lg">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div>
                        <h4 class="font-serif font-bold text-base text-slate-100">Customer Concierge</h4>
                        <p class="text-xs text-slate-400">Direct phone & email support for customers</p>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                        Support Phone Number
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-phone text-xs"></i>
                        </span>
                        <input type="text" name="phone" value="{{ $settings['phone'] ?? '+92 300 1234567' }}"
                            placeholder="+92 300 1234567"
                            class="w-full pl-9 pr-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                        Support Email Address
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </span>
                        <input type="email" name="email" value="{{ $settings['email'] ?? 'contact@zvarr.com' }}"
                            placeholder="concierge@zvarr.com"
                            class="w-full pl-9 pr-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                        Physical Store / City Address
                    </label>
                    <input type="text" name="address" value="{{ $settings['address'] ?? 'Karachi, Pakistan' }}"
                        placeholder="e.g. Karachi, Pakistan"
                        class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            <!-- 4. LIVE PREVIEW BADGES & SAVE BUTTON -->
            <div class="p-5 sm:p-7 rounded-2xl sm:rounded-3xl bg-slate-900 border border-slate-800 shadow-xl space-y-4">
                <h4 class="font-serif font-bold text-base text-slate-100 mb-1">Active Channels Status</h4>
                <p class="text-xs text-slate-400 mb-3">Live channels currently visible on your storefront</p>

                <div class="flex flex-wrap gap-2 text-xs">
                    @if(!empty($settings['whatsapp_number']))
                        <span class="px-3 py-1 rounded-full bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 font-semibold flex items-center gap-1.5">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp Live
                        </span>
                    @endif
                    @if(!empty($settings['instagram_url']))
                        <span class="px-3 py-1 rounded-full bg-rose-500/15 text-rose-400 border border-rose-500/30 font-semibold flex items-center gap-1.5">
                            <i class="fa-brands fa-instagram"></i> Instagram Live
                        </span>
                    @endif
                    @if(!empty($settings['facebook_url']))
                        <span class="px-3 py-1 rounded-full bg-blue-500/15 text-blue-400 border border-blue-500/30 font-semibold flex items-center gap-1.5">
                            <i class="fa-brands fa-facebook-f"></i> Facebook Live
                        </span>
                    @endif
                    @if(!empty($settings['tiktok_url']))
                        <span class="px-3 py-1 rounded-full bg-stone-500/15 text-stone-300 border border-stone-500/30 font-semibold flex items-center gap-1.5">
                            <i class="fa-brands fa-tiktok"></i> TikTok Live
                        </span>
                    @endif
                </div>

                <button type="submit"
                    class="w-full py-3.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-bold text-xs uppercase tracking-wider shadow-lg shadow-amber-500/20 transition flex items-center justify-center gap-2 mt-4">
                    <i class="fa-solid fa-floppy-disk text-sm"></i>
                    Save All Settings (Real-Time)
                </button>
            </div>

        </div>

    </form>

</div>
@endsection
