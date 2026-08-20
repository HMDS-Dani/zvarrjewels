@extends('shop.layout')

@section('title', 'About Our Heritage | ZVARR by Zaiyal')

@section('content')

<style>
    /* Radial Deep Luxury Vignette */
    .bg-obsidian-about {
        background: radial-gradient(circle at 50% 20%, #17151b 0%, #0d0c11 50%, #040405 100%);
    }
    .luxury-story-card {
        background: linear-gradient(180deg, #16151e 0%, #0b0a10 40%, #030305 100%);
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 16px 36px -8px rgba(0, 0, 0, 0.85), inset 0 1px 0 rgba(255, 255, 255, 0.12);
    }
</style>

<div class="bg-obsidian-about min-h-screen pt-20 sm:pt-28 pb-20 text-white relative overflow-hidden">
    
    <!-- Ambient Golden Glow -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[500px] h-[500px] bg-amber-500/5 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-16 sm:space-y-24">
        
        <!-- 1. HERO SECTION -->
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-black/70 border border-amber-400/30 text-amber-300 text-[10px] font-bold uppercase tracking-[0.25em] backdrop-blur-md">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-ping"></span>
                <span>The Story of ZVARR</span>
            </div>

            <h1 class="text-3xl sm:text-6xl font-serif-luxury font-normal text-white leading-tight">
                Crafting Timeless <span class="text-amber-300 font-serif-luxury italic">Grace</span> & Everyday Radiance
            </h1>

            <p class="text-xs sm:text-sm text-stone-300 font-light leading-relaxed max-w-2xl mx-auto">
                Born out of passion for bespoke luxury, <strong>ZVARR by Zaiyal</strong> creates aesthetic anti-tarnish jewelry designed to be lived in, loved, and worn every single day across Pakistan.
            </p>
        </div>

        <!-- 2. BRAND STORY & PHILOSOPHY GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <div class="lg:col-span-6 space-y-6">
                <div class="space-y-3">
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-400">Our Philosophy</span>
                    <h2 class="text-2xl sm:text-4xl font-serif-luxury text-stone-100">
                        Luxury That Never Fades, Affordable For Everyone.
                    </h2>
                </div>

                <p class="text-xs sm:text-sm text-stone-300 leading-relaxed font-light">
                    We believe fine jewelry should never be locked away in a safe waiting for special occasions. Traditional gold jewelry is delicate and expensive, while cheap fashion jewelry tarnishes within days.
                </p>

                <p class="text-xs sm:text-sm text-stone-300 leading-relaxed font-light">
                    ZVARR bridges this divide by combining <strong>marine-grade waterproof stainless steel</strong> with <strong>18K / 22K vacuum-plated real gold & platinum finishes</strong> and hand-set AAA cubic zirconia. Shower, swim, sweat, or apply perfumes—your ZVARR masterworks retain their pristine mirror shine forever.
                </p>

                <div class="pt-2 flex items-center gap-4">
                    <a href="{{ route('shop.index') }}" 
                        class="px-7 py-3 bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-amber-500/20 transition">
                        Explore Vault Collections
                    </a>
                </div>
            </div>

            <div class="lg:col-span-6 grid grid-cols-2 gap-4">
                <div class="rounded-3xl luxury-story-card overflow-hidden aspect-[4/5] p-2 border border-white/10">
                    <img src="https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=800" alt="Ring Crafting" class="w-full h-full object-cover rounded-2xl">
                </div>
                <div class="rounded-3xl luxury-story-card overflow-hidden aspect-[4/5] p-2 border border-white/10 mt-6 sm:mt-10">
                    <img src="https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=800" alt="Pendant Crafting" class="w-full h-full object-cover rounded-2xl">
                </div>
            </div>

        </div>

        <!-- 3. THE 4 PILLARS OF EXCELLENCE -->
        <div class="space-y-8">
            <div class="text-center max-w-xl mx-auto space-y-2">
                <span class="text-[10.5px] font-bold uppercase tracking-[0.25em] text-amber-400">The ZVARR Standard</span>
                <h3 class="text-2xl sm:text-4xl font-serif-luxury text-white">4 Pillars of Unrivaled Excellence</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                
                <!-- Pillar 1 -->
                <div class="p-6 rounded-3xl luxury-story-card space-y-3 relative group hover:border-amber-400/40 transition">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/10 text-amber-400 border border-amber-400/20 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h4 class="font-serif font-bold text-base text-stone-100">100% Anti-Tarnish</h4>
                    <p class="text-xs text-stone-400 font-light leading-relaxed">
                        Engineered with triple-vacuum PVD plating. Resistant to water, perfume, lotion, and daily wear without green skin or fading.
                    </p>
                </div>

                <!-- Pillar 2 -->
                <div class="p-6 rounded-3xl luxury-story-card space-y-3 relative group hover:border-amber-400/40 transition">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/10 text-amber-400 border border-amber-400/20 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-gem"></i>
                    </div>
                    <h4 class="font-serif font-bold text-base text-stone-100">Hand-Set Crystals</h4>
                    <p class="text-xs text-stone-400 font-light leading-relaxed">
                        Every stone is precisely cut with 58 optical facets matching genuine mined diamonds for maximum fire and sparkle.
                    </p>
                </div>

                <!-- Pillar 3 -->
                <div class="p-6 rounded-3xl luxury-story-card space-y-3 relative group hover:border-amber-400/40 transition">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/10 text-amber-400 border border-amber-400/20 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-gift"></i>
                    </div>
                    <h4 class="font-serif font-bold text-base text-stone-100">Signature Vault Box</h4>
                    <p class="text-xs text-stone-400 font-light leading-relaxed">
                        Every delivery arrives in our signature aesthetic velvet gift pouch and protective vault unboxing presentation.
                    </p>
                </div>

                <!-- Pillar 4 -->
                <div class="p-6 rounded-3xl luxury-story-card space-y-3 relative group hover:border-amber-400/40 transition">
                    <div class="w-12 h-12 rounded-2xl bg-amber-400/10 text-amber-400 border border-amber-400/20 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <h4 class="font-serif font-bold text-base text-stone-100">Open Parcel Checking</h4>
                    <p class="text-xs text-stone-400 font-light leading-relaxed">
                        100% confidence. Inspect your parcel with rider before making payment anywhere across Pakistan with fast COD.
                    </p>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
