@extends('shop.layout')

@section('title', 'ZVARR by Zaiyal | Eternal Spark of Grace')

@section('content')

<style>
    /* Radial Deep Luxury Vignette (Matte Black & Gold) */
    .bg-obsidian-gold {
        background: radial-gradient(circle at 50% 50%, #15120d 0%, #0a090b 50%, #040405 100%);
    }
    .watermark-text {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(4.5rem, 18vw, 20rem);
        line-height: 0.8;
        letter-spacing: 0.08em;
        color: rgba(225, 185, 75, 0.38);
        text-shadow: 0 0 25px rgba(225, 185, 75, 0.20);
        user-select: none;
        pointer-events: none;
        will-change: transform, opacity;
    }
    @keyframes watermarkZoomIn {
        0% {
            opacity: 0;
            transform: scale(0.35);
            letter-spacing: 0.2em;
        }
        40% {
            opacity: 0.7;
        }
        75% {
            opacity: 0.9;
            transform: scale(1.04);
            letter-spacing: 0.08em;
        }
        100% {
            opacity: 1;
            transform: scale(1.0);
            letter-spacing: 0.08em;
        }
    }
    .watermark-anim-zoom {
        animation: watermarkZoomIn 1.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .text-glow-gold {
        text-shadow: 0 0 30px rgba(212, 175, 55, 0.45);
    }
    /* VIP Royal Luxury Card Styling */
    .luxury-jewelry-card {
        background: linear-gradient(180deg, #17161f 0%, #0d0c12 40%, #050507 100%);
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 16px 36px -8px rgba(0, 0, 0, 0.85), inset 0 1px 0 rgba(255, 255, 255, 0.12);
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .luxury-jewelry-card:hover {
        border-color: rgba(212, 175, 55, 0.45);
        box-shadow: 0 24px 50px -6px rgba(0, 0, 0, 0.95), 0 0 28px rgba(212, 175, 55, 0.14), inset 0 1px 0 rgba(255, 255, 255, 0.2);
        transform: translateY(-4px);
    }
    .luxury-podium-stage {
        background: radial-gradient(ellipse at 50% 50%, rgba(40, 34, 26, 0.5) 0%, rgba(13, 12, 17, 0.2) 65%, transparent 100%);
    }
    /* Mirelle Mirror Glass Reflection */
    .mirelle-mirror-stage {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .mirelle-jewel-img {
        max-height: 180px;
        max-width: 90%;
        object-fit: contain;
        position: relative;
        z-index: 10;
        filter: drop-shadow(0 15px 25px rgba(0, 0, 0, 0.95)) brightness(1.08) contrast(1.12);
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .group:hover .mirelle-jewel-img {
        transform: translateY(-4px) scale(1.06);
    }
    .mirelle-reflection-layer {
        position: absolute;
        bottom: -32px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        transform: scaleY(-1);
        opacity: 0.38;
        filter: blur(0.4px);
        mask-image: linear-gradient(to top, rgba(0,0,0,1) 0%, rgba(0,0,0,0.5) 40%, rgba(0,0,0,0) 80%);
        -webkit-mask-image: linear-gradient(to top, rgba(0,0,0,1) 0%, rgba(0,0,0,0.5) 40%, rgba(0,0,0,0) 80%);
        pointer-events-none;
        z-index: 5;
    }
    .mirelle-reflection-img {
        max-height: 180px;
        max-width: 90%;
        object-fit: contain;
    }
    .mirelle-contact-shadow {
        position: absolute;
        bottom: 20px;
        width: 55%;
        height: 10px;
        background: radial-gradient(ellipse at center, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 50%, transparent 80%);
        border-radius: 50%;
        filter: blur(3px);
        pointer-events-none;
        z-index: 8;
    }
</style>

<!-- 1. FULL-VIEWPORT HERO -->
<section id="hero-cinematic" class="relative bg-obsidian-gold h-screen min-h-[100dvh] max-h-[100dvh] flex flex-col justify-between overflow-hidden pt-16 sm:pt-20 pb-4 lg:py-0">
    
    <!-- Ambient Golden Glow Auras -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[350px] sm:w-[650px] h-[350px] sm:h-[650px] bg-amber-500/5 rounded-full blur-[140px]"></div>
    </div>

    <!-- Giant Background Watermark "ZVARR" (Shifted slightly upwards on Mobile) -->
    <div class="absolute inset-0 flex items-center justify-center z-0 pointer-events-none -translate-y-8 sm:translate-y-0">
        <span id="hero-watermark-text" class="watermark-text watermark-anim-zoom font-serif-luxury font-bold">ZVARR</span>
    </div>

    <!-- Full-Screen 3D Interactive Canvas Stage -->
    <div id="three-stage-container" class="absolute inset-0 w-full h-full cursor-grab active:cursor-grabbing z-10"></div>

    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full h-full flex flex-col justify-between lg:justify-center pointer-events-none py-2 lg:py-0">
        
        <!-- DESKTOP GRID (>= 1024px) -->
        <div class="hidden lg:grid grid-cols-12 gap-8 items-center w-full">
            <!-- Left: Text & Actions -->
            <div id="hero-left-content" class="col-span-5 space-y-5 text-left transition-all duration-1000 opacity-0 translate-y-6 pointer-events-none">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-black/70 border border-amber-400/30 text-amber-300 text-[11px] font-semibold tracking-widest backdrop-blur-md">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-ping"></span>
                    <span>ZVARR SIGNATURE MASTERWORK</span>
                </div>

                <h1 class="text-6xl font-serif-luxury font-normal tracking-tight text-white leading-[1.05]">
                    Eternal <br>
                    <span class="text-amber-300 font-serif-luxury italic text-glow-gold">Spark</span> of <br>
                    Grace
                </h1>

                <p class="text-stone-300 text-sm leading-relaxed max-w-md font-light">
                    French Eternity Pavé diamond solitaire engagement ring cast in mirror-polished stainless steel &amp; platinum. Hand-set into an artisanal royal obsidian vault.
                </p>

                <div class="flex items-center gap-3 pt-1 pointer-events-auto">
                    <a href="#products-showcase" 
                        class="px-7 py-3 bg-gradient-to-r from-amber-400 via-amber-500 to-yellow-600 hover:opacity-95 text-black font-extrabold text-xs uppercase tracking-[0.2em] rounded-full shadow-2xl shadow-amber-500/20 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                        <span>Explore Vault</span>
                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                    </a>
                    
                    @if(!empty($storeSettings['whatsapp_number']))
                        <a href="https://wa.me/{{ $storeSettings['whatsapp_number'] }}?text={{ urlencode($storeSettings['whatsapp_greeting'] ?? 'Hi ZVARR by Zaiyal! I want to order jewelry.') }}" target="_blank"
                            class="px-6 py-3 glass-card-3d hover:bg-white/10 text-stone-200 font-bold text-xs uppercase tracking-[0.15em] rounded-full transition flex items-center gap-2 border border-white/10 hover:border-amber-400/40">
                            <i class="fa-brands fa-whatsapp text-emerald-400 text-sm"></i>
                            <span>WhatsApp</span>
                        </a>
                    @endif
                </div>

                <div class="pt-1 pointer-events-auto">
                    <button onclick="playCinematicIntro()" class="text-[11px] text-stone-400 hover:text-amber-300 transition inline-flex items-center gap-1.5">
                        <i class="fa-solid fa-rotate text-xs text-amber-400"></i>
                        <span>Replay 3D Reveal</span>
                    </button>
                </div>
            </div>

            <!-- Right: 3D Stage Space (Desktop) -->
            <div class="col-span-7 relative h-[520px] pointer-events-none"></div>
        </div>

        <!-- MOBILE LAYOUT (< 1024px) -->
        <div class="lg:hidden flex flex-col justify-between h-full w-full py-1">
            
            <!-- 1. Top Header Text -->
            <div id="hero-mobile-header" class="text-center space-y-1.5 transition-all duration-1000 opacity-0 translate-y-4 pointer-events-none">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-black/70 border border-amber-400/30 text-amber-300 text-[9px] font-semibold tracking-widest backdrop-blur-md">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-ping"></span>
                    <span>ZVARR SIGNATURE MASTERWORK</span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-serif-luxury font-normal tracking-tight text-white leading-tight">
                    Eternal <span class="text-amber-300 font-serif-luxury italic text-glow-gold">Spark</span> of Grace
                </h1>

                <p class="text-stone-300 text-[10.5px] leading-tight max-w-xs mx-auto font-light line-clamp-1">
                    French Eternity Pavé diamond solitaire engagement ring.
                </p>
            </div>

            <!-- 2. Spacer for Mobile 3D Model -->
            <div class="my-auto h-12 pointer-events-none"></div>

            <!-- 3. Bottom Action Buttons -->
            <div id="hero-mobile-actions" class="space-y-1.5 text-center transition-all duration-1000 opacity-0 translate-y-4 pointer-events-auto pb-1">
                <div class="flex items-center justify-center gap-2.5">
                    <a href="#products-showcase" 
                        class="px-5 py-2.5 bg-gradient-to-r from-amber-400 via-amber-500 to-yellow-600 hover:opacity-95 text-black font-extrabold text-[10.5px] uppercase tracking-[0.18em] rounded-full shadow-2xl shadow-amber-500/20 transition flex items-center gap-1.5">
                        <span>Explore Vault</span>
                        <i class="fa-solid fa-arrow-right text-[9px]"></i>
                    </a>
                    
                    @if(!empty($storeSettings['whatsapp_number']))
                        <a href="https://wa.me/{{ $storeSettings['whatsapp_number'] }}?text={{ urlencode($storeSettings['whatsapp_greeting'] ?? 'Hi ZVARR by Zaiyal! I want to order jewelry.') }}" target="_blank"
                            class="px-4 py-2.5 glass-card-3d hover:bg-white/10 text-stone-200 font-bold text-[10.5px] uppercase tracking-[0.15em] rounded-full transition flex items-center gap-1.5 border border-white/10 hover:border-amber-400/40">
                            <i class="fa-brands fa-whatsapp text-emerald-400 text-xs"></i>
                            <span>WhatsApp</span>
                        </a>
                    @endif
                </div>

                <div>
                    <button onclick="playCinematicIntro()" class="text-[9px] text-stone-400 hover:text-amber-300 transition inline-flex items-center gap-1">
                        <i class="fa-solid fa-rotate text-[9px] text-amber-400"></i>
                        <span>Replay 3D Reveal</span>
                    </button>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- 2. 4D TRANSPARENT LUXURY PRODUCT SHOWCASE (Mirelle Full-Bleed Dark Cards) -->
<section id="products-showcase" class="py-20 bg-[#060608] relative z-10 scroll-mt-12 border-b border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="text-center max-w-2xl mx-auto mb-14 space-y-3">
            <span class="text-[11px] font-bold uppercase tracking-[0.3em] text-amber-400">Haute Joaillerie Creations</span>
            <h2 class="text-3xl sm:text-5xl font-serif-luxury font-normal text-white">Signature Collection</h2>
            <p class="text-xs sm:text-sm text-stone-400 font-light">
                Handcrafted with high optical brilliance, mirror-finish vacuum plating, and anti-tarnish comfort.
            </p>
        </div>

        <!-- 3 CARDS PER ROW VIP LUXURY GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @forelse($featuredProducts as $index => $product)
                <div class="group relative rounded-3xl luxury-jewelry-card p-6 sm:p-7 flex flex-col justify-between overflow-hidden">
                    
                    <!-- Ambient Glow Behind Card -->
                    <div class="absolute -top-16 -right-16 w-44 h-44 bg-amber-500/10 rounded-full blur-3xl pointer-events-none group-hover:bg-amber-500/20 transition duration-700"></div>

                    <!-- Top Card Info (Title, Category & Price) -->
                    <div class="space-y-2.5 z-10">
                        <div class="flex items-center justify-between">
                            <span class="text-[9.5px] font-bold uppercase tracking-[0.25em] text-amber-400/90">
                                {{ $product->category->name }}
                            </span>
                            @if($product->discount_price)
                                <span class="px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase bg-amber-400/15 text-amber-300 border border-amber-400/30">
                                    Special Edition
                                </span>
                            @endif
                        </div>

                        <h3 class="text-xl sm:text-2xl font-serif-luxury font-normal text-white group-hover:text-amber-300 transition duration-300 line-clamp-1">
                            <a href="{{ route('shop.product', $product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </h3>

                        <p class="text-stone-400 text-xs font-light leading-relaxed line-clamp-2">
                            {{ $product->description ?? 'A radiant brilliant-cut diamond on a platinum pavé band, crafted for timeless elegance.' }}
                        </p>

                        <div class="pt-1 flex items-baseline gap-2">
                            <span class="text-xs font-light text-stone-400">Price:</span>
                            <span class="text-lg sm:text-xl font-bold text-amber-300 font-cinzel tracking-wider">
                                Rs. {{ number_format($product->price, 0) }}
                            </span>
                            @if($product->discount_price)
                                <span class="text-xs text-stone-600 line-through">
                                    Rs. {{ number_format($product->discount_price, 0) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Clean Transparent Product Image with Mirelle Luxury Glass Floor Reflection -->
                    <a href="{{ route('shop.product', $product->slug) }}" class="block w-full my-3">
                        <div class="mirelle-mirror-stage luxury-podium-stage rounded-2xl w-full h-56 sm:h-64 flex items-center justify-center relative overflow-hidden">
                            <!-- Ambient Gold Halo -->
                            <div class="absolute w-40 h-40 bg-amber-400/15 rounded-full blur-2xl pointer-events-none group-hover:bg-amber-400/25 transition-all duration-700"></div>

                            <!-- Contact Base Shadow -->
                            <div class="mirelle-contact-shadow"></div>

                            <!-- Main Floating Jewel -->
                            <img src="{{ $product->image_url }}" 
                                alt="{{ $product->name }}" 
                                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=800';"
                                class="auto-remove-bg mirelle-jewel-img">

                            <!-- Exact Glass Floor Reflection -->
                            <div class="mirelle-reflection-layer">
                                <img src="{{ $product->image_url }}" 
                                    alt="" 
                                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=800';"
                                    class="auto-remove-bg mirelle-reflection-img">
                            </div>
                        </div>
                    </a>

                    <!-- Bottom Action Bar -->
                    <div class="pt-5 mt-3 border-t border-white/10 flex items-center justify-between z-10">
                        <a href="{{ route('shop.product', $product->slug) }}" 
                            class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-widest text-amber-300 hover:text-white transition">
                            <span>Inspect Piece</span>
                            <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>

                        <button type="button" 
                            onclick="openDirectWhatsApp('{{ addslashes($product->name) }}', '{{ number_format($product->price, 0) }}', '{{ route('shop.product', $product->slug) }}')"
                            class="w-8 h-8 rounded-full bg-amber-400/10 hover:bg-amber-400/20 text-amber-300 border border-amber-400/30 flex items-center justify-center text-xs transition active:scale-95" 
                            title="Order via WhatsApp">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                        </button>
                    </div>

                </div>
            @empty
                <div class="col-span-3 text-center py-16 text-stone-500 font-light">
                    No jewelry found.
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- 3. EXPLORE BY CATEGORY -->
<section id="categories" class="py-20 sm:py-28 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-xl mx-auto mb-12 space-y-2">
            <span class="text-[11px] font-bold uppercase tracking-[0.25em] text-amber-400">Curated Aesthetics</span>
            <h2 class="text-3xl sm:text-5xl font-serif-luxury font-normal text-white">Shop By Category</h2>
            <p class="text-xs text-stone-400 font-light">Handcrafted everyday jewelry designed to complement every look.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('shop.category', $category->slug) }}" 
                    class="group relative h-64 rounded-2xl overflow-hidden glass-card-3d block border border-white/10 hover:border-amber-400/40">
                    <img src="{{ $category->image_url }}" 
                        alt="{{ $category->name }}" 
                        onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=600';"
                        class="w-full h-full object-cover object-center group-hover:scale-110 transition duration-700 opacity-60 group-hover:opacity-80">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/30 to-transparent"></div>

                    <div class="absolute bottom-0 inset-x-0 p-4 text-white space-y-0.5">
                        <h3 class="font-cinzel font-bold text-sm text-white group-hover:text-amber-300 transition tracking-wider">
                            {{ $category->name }}
                        </h3>
                        <p class="text-[11px] text-amber-200/80 font-light">
                            {{ $category->products_count }} Pieces
                        </p>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</section>

<!-- 4. VERIFIED CLIENT TESTIMONIALS -->
<section class="py-16 bg-[#040406] text-white relative z-10 border-b border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 gap-4">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 text-amber-400 text-xs font-bold uppercase tracking-[0.25em]">
                    <div class="flex text-amber-400 text-xs gap-0.5">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <span>5.0 Star Rated Across Pakistan</span>
                </div>
                <h2 class="text-3xl sm:text-5xl font-serif-luxury font-normal text-white">Loved by Modern Royals</h2>
                <p class="text-xs text-stone-400 font-light">Real unboxing reactions and verified customer stories.</p>
            </div>

            <a href="{{ route('shop.index') }}" 
                class="inline-flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-amber-300 hover:text-white transition">
                <span>Shop Vault Favorites</span>
                <i class="fa-solid fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($recentReviews as $review)
                <div class="p-6 rounded-3xl glass-card-3d bg-black/40 border border-white/10 space-y-4 flex flex-col justify-between hover:border-amber-400/30 transition">
                    <div class="space-y-3">
                        <div class="flex text-amber-400 text-xs gap-0.5">
                            @for($i = 1; $i <= $review->rating; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                        <p class="text-xs text-stone-200 font-light leading-relaxed">
                            "{{ $review->comment }}"
                        </p>
                    </div>

                    <div class="pt-3 border-t border-white/5 flex items-center justify-between text-xs">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-full bg-amber-400/20 text-amber-300 font-bold flex items-center justify-center text-xs font-serif">
                                {{ substr($review->name, 0, 1) }}
                            </div>
                            <div>
                                <span class="font-bold text-stone-200 block text-xs">{{ $review->name }}</span>
                                <span class="text-[10px] text-stone-500">{{ $review->city ?? 'Pakistan' }}</span>
                            </div>
                        </div>
                        <span class="text-[9.5px] font-bold text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-full border border-emerald-500/20">
                            ✓ Verified
                        </span>
                    </div>
                </div>
            @empty
                <div class="p-6 rounded-3xl glass-card-3d bg-black/40 border border-white/10 space-y-4">
                    <div class="flex text-amber-400 text-xs gap-0.5"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="text-xs text-stone-200 font-light">"The anti-tarnish finish is exceptional. Wore it daily for 3 months with zero color fading!"</p>
                    <div class="pt-2 border-t border-white/5 flex items-center justify-between text-xs">
                        <span class="font-bold text-stone-200">Areeba Khan • Karachi</span>
                        <span class="text-[9.5px] font-bold text-emerald-400">✓ Verified</span>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</section>

<!-- 5. INSTAGRAM COMMUNITY BANNER (Only if Instagram is configured) -->
@if(!empty($storeSettings['instagram_url']))
<section class="py-16 bg-[#060608] text-white relative overflow-hidden relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-7 space-y-5">
                <div class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-widest text-amber-400">
                    <i class="fa-brands fa-instagram text-base"></i>
                    <span>Official Instagram Community</span>
                </div>
                
                <h2 class="text-3xl sm:text-5xl font-serif-luxury font-normal text-white leading-tight">
                    Join Our Viral Aesthetic Community & Daily Dispatch Stories
                </h2>
                
                <p class="text-stone-400 text-sm leading-relaxed max-w-lg font-light">
                    Check client reviews, packaging videos, and newest viral drops. Every order is packed with love in our signature aesthetic ZVARR box.
                </p>

                <div class="pt-2 flex flex-wrap gap-4">
                    <a href="{{ $storeSettings['instagram_url'] }}" target="_blank"
                        class="px-8 py-3.5 bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-600 hover:opacity-90 text-black font-bold text-xs uppercase tracking-widest rounded-full transition shadow-xl flex items-center gap-2">
                        <i class="fa-brands fa-instagram text-sm"></i>
                        Follow Us on Instagram
                    </a>
                </div>
            </div>

            <!-- Instagram Grid Mockup -->
            <div class="lg:col-span-5 grid grid-cols-2 gap-4">
                <div class="rounded-2xl overflow-hidden glass-card-3d aspect-square p-1.5 border border-white/10">
                    <img src="https://images.unsplash.com/photo-1611591475152-478311394749?w=500" alt="Pink Tulip" class="w-full h-full object-cover rounded-xl">
                </div>
                <div class="rounded-2xl overflow-hidden glass-card-3d aspect-square p-1.5 border border-white/10">
                    <img src="https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=500" alt="Heart Pendant" class="w-full h-full object-cover rounded-xl">
                </div>
            </div>

        </div>
    </div>
</section>
@endif

<!-- FULL 3D INTERACTIVE LEAP & DOCK ENGINE WITH STUDIO REFLECTIONS & FAIL-SAFE FALLBACK -->
<script>
let playCinematicIntro = function() {};

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('three-stage-container');
    if (!container) return;

    function revealHeroFallback() {
        const navbar = document.getElementById('main-navbar');
        if (navbar) {
            navbar.classList.remove('opacity-0', '-translate-y-full');
            navbar.classList.add('opacity-100', 'translate-y-0');
        }
        const leftContent = document.getElementById('hero-left-content');
        if (leftContent) {
            leftContent.classList.remove('opacity-0', 'translate-y-6');
            leftContent.classList.add('opacity-100', 'translate-y-0');
        }
        const mobHeader = document.getElementById('hero-mobile-header');
        if (mobHeader) {
            mobHeader.classList.remove('opacity-0', 'translate-y-4');
            mobHeader.classList.add('opacity-100', 'translate-y-0');
        }
        const mobActions = document.getElementById('hero-mobile-actions');
        if (mobActions) {
            mobActions.classList.remove('opacity-0', 'translate-y-4');
            mobActions.classList.add('opacity-100', 'translate-y-0');
        }
    }

    function createFallbackStage(cnt) {
        if (!cnt) return;
        cnt.innerHTML = `
            <div class="w-full h-full flex items-center justify-center relative pointer-events-none p-4">
                <div class="absolute w-72 sm:w-96 h-72 sm:h-96 bg-amber-500/20 rounded-full blur-3xl animate-pulse"></div>
                <div class="mirelle-mirror-stage relative z-10 flex flex-col items-center justify-center">
                    <div class="mirelle-contact-shadow"></div>
                    <img src="https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=800&auto=format&fit=crop&q=80" 
                        alt="ZVARR Masterpiece Ring" 
                        class="mirelle-jewel-img max-h-52 sm:max-h-72 object-contain animate-bounce transition duration-1000"
                        style="animation-duration: 4s;">
                    <div class="mirelle-reflection-layer">
                        <img src="https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=800&auto=format&fit=crop&q=80" 
                            alt="" 
                            class="mirelle-reflection-img max-h-52 sm:max-h-72 object-contain">
                    </div>
                </div>
            </div>
        `;
    }

    let renderer;
    let scene;
    let camera;
    let config;

    function getResponsiveConfig() {
        const isMobile = window.innerWidth < 1024;
        return {
            isMobile: isMobile,
            cameraDistance: isMobile ? 8.2 : 7.6,
            cameraY: isMobile ? 0.0 : 0.08,
            targetX: isMobile ? 0.0 : 1.7,
            targetDockY: isMobile ? -0.48 : -0.38,
            ringDockY: isMobile ? -0.13 : 0.05,
            ringLeapScale: isMobile ? 0.92 : 1.18,
            ringDockScale: isMobile ? 0.62 : 0.84,
            boxScale: isMobile ? 0.62 : 0.84
        };
    }

    try {
        if (typeof THREE === 'undefined') {
            throw new Error('Three.js library failed to load');
        }

        scene = new THREE.Scene();
        config = getResponsiveConfig();
        camera = new THREE.PerspectiveCamera(38, container.clientWidth / container.clientHeight, 0.1, 1000);
        camera.position.set(0, config.cameraY, config.cameraDistance);

        renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true, powerPreference: "high-performance" });
        renderer.setSize(container.clientWidth, container.clientHeight);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        renderer.toneMapping = THREE.ACESFilmicToneMapping;
        renderer.toneMappingExposure = 1.05;
        renderer.outputEncoding = THREE.sRGBEncoding;
        container.appendChild(renderer.domElement);
    } catch (webglErr) {
        console.warn("WebGL is unavailable or failed to initialize, loading luxury 2D fallback stage:", webglErr);
        revealHeroFallback();
        createFallbackStage(container);
        playCinematicIntro = function() { revealHeroFallback(); };
        return;
    }

    // 2. Warm Luxury Studio Environment Reflections
    function createStudioCubeMap() {
        const createFace = (type) => {
            const c = document.createElement('canvas');
            c.width = 256; c.height = 256;
            const cx = c.getContext('2d');
            if (type === 'top') {
                const grad = cx.createRadialGradient(128, 128, 10, 128, 128, 120);
                grad.addColorStop(0, '#ffffff');
                grad.addColorStop(0.3, '#fbe39d');
                grad.addColorStop(1, '#15131b');
                cx.fillStyle = grad;
                cx.fillRect(0, 0, 256, 256);
            } else if (type === 'bottom') {
                cx.fillStyle = '#030305';
                cx.fillRect(0, 0, 256, 256);
            } else {
                const grad = cx.createLinearGradient(0, 0, 256, 256);
                grad.addColorStop(0, '#ffffff');
                grad.addColorStop(0.3, '#d4af37');
                grad.addColorStop(0.65, '#0d0c11');
                grad.addColorStop(1, '#ffffff');
                cx.fillStyle = grad;
                cx.fillRect(0, 0, 256, 256);
            }
            return c;
        };

        const cubeTex = new THREE.CubeTexture([
            createFace('side'), createFace('side'),
            createFace('top'), createFace('bottom'),
            createFace('side'), createFace('side')
        ]);
        cubeTex.needsUpdate = true;
        return cubeTex;
    }

    const studioEnvMap = createStudioCubeMap();

    // 3. Balanced Studio Lighting Rig (Keeps black deep and gold radiant)
    const ambientLight = new THREE.AmbientLight(0xfff8ee, 0.9);
    scene.add(ambientLight);

    const mainKeyLight = new THREE.DirectionalLight(0xffffff, 2.4);
    mainKeyLight.position.set(4, 7, 5);
    scene.add(mainKeyLight);

    const rimLightL = new THREE.DirectionalLight(0xd4af37, 2.0);
    rimLightL.position.set(-5, 3, -3);
    scene.add(rimLightL);

    const diamondFireLight = new THREE.PointLight(0xe0f7ff, 4.0, 5);
    diamondFireLight.position.set(0, 1.8, 1.0);
    scene.add(diamondFireLight);

    // 4. Authentic Theme-Matching Materials (Obsidian Black & 18K Champagne Gold)
    // 18K Yellow Gold Material for Ring Band & Box Rims
    const richGoldMaterial = new THREE.MeshStandardMaterial({
        color: 0xE5B84B,
        metalness: 0.96,
        roughness: 0.1,
        envMap: studioEnvMap,
        envMapIntensity: 3.2,
    });

    // Platinum / Stainless Steel Crown Material
    const platinumMaterial = new THREE.MeshStandardMaterial({
        color: 0xF2F2F8,
        metalness: 0.98,
        roughness: 0.04,
        envMap: studioEnvMap,
        envMapIntensity: 3.2,
    });

    // Deep Jet Black Obsidian Velvet Box (Pure Obsidian Black)
    const jetBlackVelvetMaterial = new THREE.MeshBasicMaterial({
        color: 0x060608,
    });

    // Dark Obsidian Cushion Pillow
    const cushionMaterial = new THREE.MeshBasicMaterial({
        color: 0x0b0a0e,
    });

    // Multi-Faceted Brilliant Cut Solitaire Diamond
    const diamondMaterial = new THREE.MeshStandardMaterial({
        color: 0xf4f9ff,
        emissive: 0x112233,
        emissiveIntensity: 0.4,
        metalness: 0.12,
        roughness: 0.02,
        flatShading: true,
        transparent: true,
        opacity: 0.94,
        envMap: studioEnvMap,
        envMapIntensity: 3.2,
    });

    // 5. Build High-Precision 3D Ring Model
    const ringMeshGroup = new THREE.Group();
    scene.add(ringMeshGroup);

    // D-shape 18K Gold band
    const bandGeom = new THREE.TorusGeometry(1.22, 0.115, 64, 160);
    const ringBand = new THREE.Mesh(bandGeom, richGoldMaterial);
    ringMeshGroup.add(ringBand);

    // Micro-Pavé Diamond Row along shoulders
    const totalPaveStones = 36;
    for (let i = 0; i < totalPaveStones; i++) {
        const angle = (i / totalPaveStones) * Math.PI * 2;
        if (Math.abs(angle - Math.PI / 2) < 0.28) continue; // Leave crown open

        const paveStone = new THREE.Mesh(new THREE.OctahedronGeometry(0.048, 0), diamondMaterial);
        paveStone.position.set(Math.cos(angle) * 1.25, Math.sin(angle) * 1.25, 0);
        paveStone.rotation.z = angle;
        ringMeshGroup.add(paveStone);
    }

    // Platinum Cathedral Arches
    const archGeomL = new THREE.CylinderGeometry(0.038, 0.055, 0.52, 16);
    const archL = new THREE.Mesh(archGeomL, platinumMaterial);
    archL.position.set(0.24, 1.22, 0);
    archL.rotation.z = -0.38;
    ringMeshGroup.add(archL);

    const archR = new THREE.Mesh(archGeomL, platinumMaterial);
    archR.position.set(-0.24, 1.22, 0);
    archR.rotation.z = 0.38;
    ringMeshGroup.add(archR);

    // Platinum under-bezel gallery ring
    const underBezel = new THREE.Mesh(new THREE.TorusGeometry(0.24, 0.038, 16, 48), platinumMaterial);
    underBezel.position.set(0, 1.28, 0);
    underBezel.rotation.x = Math.PI / 2;
    ringMeshGroup.add(underBezel);

    // 6 Solitaire Crown Prongs (Platinum)
    const prongAngles = [0, Math.PI / 3, (2 * Math.PI) / 3, Math.PI, (4 * Math.PI) / 3, (5 * Math.PI) / 3];
    prongAngles.forEach(ang => {
        const px = Math.cos(ang) * 0.28;
        const pz = Math.sin(ang) * 0.28;

        const prongArm = new THREE.Mesh(new THREE.CylinderGeometry(0.022, 0.034, 0.48, 16), platinumMaterial);
        prongArm.position.set(px, 1.48, pz);
        ringMeshGroup.add(prongArm);

        const beadTip = new THREE.Mesh(new THREE.SphereGeometry(0.034, 16, 16), platinumMaterial);
        beadTip.position.set(px * 0.92, 1.71, pz * 0.92);
        ringMeshGroup.add(beadTip);
    });

    // Brilliant Solitaire Diamond
    const diamondGroup = new THREE.Group();
    
    // Crown
    const crownMesh = new THREE.Mesh(new THREE.CylinderGeometry(0.42, 0.68, 0.3, 10), diamondMaterial);
    crownMesh.position.y = 0.15;
    diamondGroup.add(crownMesh);

    // Pavilion
    const pavGeom = new THREE.ConeGeometry(0.68, 0.68, 10);
    pavGeom.rotateX(Math.PI);
    const pavMesh = new THREE.Mesh(pavGeom, diamondMaterial);
    pavMesh.position.y = -0.34;
    diamondGroup.add(pavMesh);

    // Flat Table
    const tableGeom = new THREE.CircleGeometry(0.42, 10);
    tableGeom.rotateX(-Math.PI / 2);
    const tableMesh = new THREE.Mesh(tableGeom, diamondMaterial);
    tableMesh.position.y = 0.3;
    diamondGroup.add(tableMesh);

    // Diamond Fire Core
    const coreMesh = new THREE.Mesh(new THREE.OctahedronGeometry(0.35, 0), new THREE.MeshStandardMaterial({
        color: 0xffffff,
        emissive: 0x99eeff,
        emissiveIntensity: 0.8,
        roughness: 0.01,
        metalness: 0.1,
        flatShading: true
    }));
    diamondGroup.add(coreMesh);

    diamondGroup.position.y = 1.52;
    ringMeshGroup.add(diamondGroup);

    // 6. Build Royal Jet-Black Velvet & 18K Gold Trim Jewelry Box
    const boxGroup = new THREE.Group();
    scene.add(boxGroup);

    // Base Vault (Jet-Black Velvet)
    const boxBaseGeom = new THREE.CylinderGeometry(1.5, 1.62, 0.68, 36);
    const boxBase = new THREE.Mesh(boxBaseGeom, jetBlackVelvetMaterial);
    boxBase.position.y = -1.05;
    boxGroup.add(boxBase);

    // 18K Yellow Gold Double Rims
    const goldRimUpper = new THREE.Mesh(new THREE.TorusGeometry(1.53, 0.05, 16, 80), richGoldMaterial);
    goldRimUpper.rotation.x = Math.PI / 2;
    goldRimUpper.position.y = -0.71;
    boxGroup.add(goldRimUpper);

    const goldRimLower = new THREE.Mesh(new THREE.TorusGeometry(1.64, 0.05, 16, 80), richGoldMaterial);
    goldRimLower.rotation.x = Math.PI / 2;
    goldRimLower.position.y = -1.39;
    boxGroup.add(goldRimLower);

    // 18K Gold Side Latches & Corner Brackets
    for (let a = 0; a < Math.PI * 2; a += Math.PI / 2) {
        const bracketGeom = new THREE.BoxGeometry(0.08, 0.38, 0.14);
        const bracket = new THREE.Mesh(bracketGeom, richGoldMaterial);
        bracket.position.set(Math.cos(a) * 1.57, -1.05, Math.sin(a) * 1.57);
        bracket.rotation.y = -a;
        boxGroup.add(bracket);
    }

    // Black Velvet Cushion & Ring Slit
    const cushionGeom = new THREE.CylinderGeometry(1.44, 1.44, 0.26, 36);
    const cushion = new THREE.Mesh(cushionGeom, cushionMaterial);
    cushion.position.y = -0.68;
    boxGroup.add(cushion);

    const slotGeom = new THREE.BoxGeometry(1.05, 0.16, 0.26);
    const slotMesh = new THREE.Mesh(slotGeom, new THREE.MeshBasicMaterial({ color: 0x020204 }));
    slotMesh.position.y = -0.56;
    boxGroup.add(slotMesh);

    // Box Open Lid (Jet-Black Velvet + Gold Trim)
    const lidGroup = new THREE.Group();
    lidGroup.position.set(0, -0.71, -1.4);

    const lidMesh = new THREE.Mesh(new THREE.CylinderGeometry(1.52, 1.52, 0.38, 36), jetBlackVelvetMaterial);
    lidMesh.position.set(0, 0.19, 0);
    lidGroup.add(lidMesh);

    const lidGoldTrim = new THREE.Mesh(new THREE.TorusGeometry(1.54, 0.05, 16, 80), richGoldMaterial);
    lidGoldTrim.position.set(0, 0.02, 0);
    lidGoldTrim.rotation.x = Math.PI / 2;
    lidGroup.add(lidGoldTrim);

    const lidCrest = new THREE.Mesh(new THREE.TorusGeometry(0.88, 0.055, 16, 48), richGoldMaterial);
    lidCrest.position.set(0, 0.38, 0);
    lidCrest.rotation.x = Math.PI / 2;
    lidGroup.add(lidCrest);

    lidGroup.rotation.x = -Math.PI * 0.65;
    boxGroup.add(lidGroup);

    // Initial Coordinates
    boxGroup.visible = false;
    boxGroup.position.set(0, -5.0, 0);
    boxGroup.rotation.x = 0.28;
    boxGroup.rotation.y = 0.12;

    ringMeshGroup.visible = false;
    ringMeshGroup.position.set(0, -8.0, 0);

    // 7. Timeline & Leap-and-Dock Choreography
    let introStartTime = Date.now();
    let isCinematicRunning = true;
    let isDragging = false;
    let hasAutoScrolled = false;
    let previousMousePosition = { x: 0, y: 0 };
    let mouseTargetRotation = { x: 0.15, y: 0 };

    playCinematicIntro = function() {
        config = getResponsiveConfig();
        introStartTime = Date.now();
        isCinematicRunning = true;
        hasAutoScrolled = false;
        
        // Watermark Zoom Animation Reset
        const watermark = document.getElementById('hero-watermark-text');
        if (watermark) {
            watermark.classList.remove('watermark-anim-zoom');
            void watermark.offsetWidth;
            watermark.classList.add('watermark-anim-zoom');
        }

        boxGroup.visible = false;
        boxGroup.position.set(config.targetX, -5.0, 0);
        boxGroup.scale.set(config.boxScale, config.boxScale, config.boxScale);

        ringMeshGroup.visible = false;
        ringMeshGroup.position.set(0, -8.0, 0);
        ringMeshGroup.scale.set(config.ringLeapScale, config.ringLeapScale, config.ringLeapScale);

        const navbar = document.getElementById('main-navbar');
        if (navbar) {
            navbar.classList.remove('opacity-100', 'translate-y-0');
            navbar.classList.add('opacity-0', '-translate-y-full');
        }

        const leftContent = document.getElementById('hero-left-content');
        if (leftContent) {
            leftContent.classList.remove('opacity-100', 'translate-y-0');
            leftContent.classList.add('opacity-0', 'translate-y-6');
        }

        const mobHeader = document.getElementById('hero-mobile-header');
        if (mobHeader) {
            mobHeader.classList.remove('opacity-100', 'translate-y-0');
            mobHeader.classList.add('opacity-0', 'translate-y-4');
        }

        const mobActions = document.getElementById('hero-mobile-actions');
        if (mobActions) {
            mobActions.classList.remove('opacity-100', 'translate-y-0');
            mobActions.classList.add('opacity-0', 'translate-y-4');
        }
    };

    playCinematicIntro();

    // 8. 3D Mouse & Touch Orbit Controls
    container.addEventListener('mousedown', (e) => {
        if (isCinematicRunning) return;
        isDragging = true;
        previousMousePosition = { x: e.clientX, y: e.clientY };
    });

    window.addEventListener('mouseup', () => {
        isDragging = false;
    });

    window.addEventListener('mousemove', (e) => {
        if (isDragging) {
            const deltaX = e.clientX - previousMousePosition.x;
            const deltaY = e.clientY - previousMousePosition.y;

            boxGroup.rotation.y += deltaX * 0.008;
            ringMeshGroup.rotation.y += deltaX * 0.008;
            boxGroup.rotation.x += deltaY * 0.008;
            ringMeshGroup.rotation.x += deltaY * 0.008;

            previousMousePosition = { x: e.clientX, y: e.clientY };
        } else if (!isCinematicRunning) {
            const rect = container.getBoundingClientRect();
            const normalizedX = (e.clientX - rect.left) / rect.width - 0.5;
            const normalizedY = (e.clientY - rect.top) / rect.height - 0.5;
            mouseTargetRotation.y = normalizedX * 0.45;
            mouseTargetRotation.x = 0.18 + normalizedY * 0.35;
        }
    });

    // Touch support
    container.addEventListener('touchstart', (e) => {
        if (isCinematicRunning || e.touches.length !== 1) return;
        isDragging = true;
        previousMousePosition = { x: e.touches[0].clientX, y: e.touches[0].clientY };
    });

    window.addEventListener('touchmove', (e) => {
        if (isDragging && e.touches.length === 1) {
            const deltaX = e.touches[0].clientX - previousMousePosition.x;
            const deltaY = e.touches[0].clientY - previousMousePosition.y;

            boxGroup.rotation.y += deltaX * 0.01;
            ringMeshGroup.rotation.y += deltaX * 0.01;

            previousMousePosition = { x: e.touches[0].clientX, y: e.touches[0].clientY };
        }
    });

    window.addEventListener('touchend', () => {
        isDragging = false;
    });

    // Window Resize
    window.addEventListener('resize', () => {
        config = getResponsiveConfig();
        camera.position.z = config.cameraDistance;
        camera.position.y = config.cameraY;
        camera.aspect = container.clientWidth / container.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(container.clientWidth, container.clientHeight);

        if (!isCinematicRunning) {
            boxGroup.position.x = config.targetX;
            ringMeshGroup.position.x = config.targetX;
            boxGroup.position.y = config.targetDockY;
            ringMeshGroup.position.y = config.ringDockY;
            boxGroup.scale.set(config.boxScale, config.boxScale, config.boxScale);
            ringMeshGroup.scale.set(config.ringDockScale, config.ringDockScale, config.ringDockScale);
        }
    });

    // 9. Main Render Loop & Animation Timeline
    function animate() {
        requestAnimationFrame(animate);

        const elapsed = (Date.now() - introStartTime) / 1000;

        if (isCinematicRunning) {
            // STAGE 1 (0.0s - 1.2s): Watermark glow only
            if (elapsed < 1.2) {
                ringMeshGroup.visible = false;
                boxGroup.visible = false;
            }
            // STAGE 2 (1.2s - 3.2s): 3D Ring leaps up in center, spinning with diamond fire!
            else if (elapsed < 3.2) {
                ringMeshGroup.visible = true;
                boxGroup.visible = false;

                const progress = (elapsed - 1.2) / 2.0;
                const easeOut = 1 - Math.pow(1 - progress, 3);
                
                ringMeshGroup.position.x = 0;
                const peakY = config.isMobile ? -0.2 : 0.0;
                ringMeshGroup.position.y = -5.5 + (easeOut * (5.5 + peakY));
                ringMeshGroup.position.z = 0;
                ringMeshGroup.rotation.y = easeOut * Math.PI * 4;
                ringMeshGroup.rotation.x = 0.15;
                ringMeshGroup.scale.set(config.ringLeapScale, config.ringLeapScale, config.ringLeapScale);
            }
            // STAGE 3 (3.2s - 4.8s): Royal Box rises & 3D Ring docks gracefully!
            else if (elapsed < 4.8) {
                boxGroup.visible = true;

                const progress = (elapsed - 3.2) / 1.6;
                const easeInOut = progress < 0.5 ? 2 * progress * progress : 1 - Math.pow(-2 * progress + 2, 2) / 2;

                // Box rises to its resting spot
                boxGroup.position.x = config.targetX;
                boxGroup.position.y = -4.0 + (easeInOut * (4.0 + config.targetDockY));
                boxGroup.rotation.y = 0.12 + (easeInOut * 0.15);
                boxGroup.scale.set(config.boxScale, config.boxScale, config.boxScale);

                // Ring translates and docks into slot
                ringMeshGroup.position.x = easeInOut * config.targetX;
                const startRingY = config.isMobile ? -0.2 : 0.0;
                ringMeshGroup.position.y = startRingY + (easeInOut * (config.ringDockY - startRingY));
                ringMeshGroup.position.z = -0.1 * easeInOut;
                ringMeshGroup.rotation.y = (Math.PI * 4) + (easeInOut * 0.2);
                ringMeshGroup.rotation.x = 0.15 + (easeInOut * 0.05);

                const currentScale = config.ringLeapScale - (easeInOut * (config.ringLeapScale - config.ringDockScale));
                ringMeshGroup.scale.set(currentScale, currentScale, currentScale);

                if (progress > 0.4) {
                    const navbar = document.getElementById('main-navbar');
                    if (navbar) {
                        navbar.classList.remove('opacity-0', '-translate-y-full');
                        navbar.classList.add('opacity-100', 'translate-y-0');
                    }

                    const leftContent = document.getElementById('hero-left-content');
                    if (leftContent) {
                        leftContent.classList.remove('opacity-0', 'translate-y-6');
                        leftContent.classList.add('opacity-100', 'translate-y-0');
                    }

                    const mobHeader = document.getElementById('hero-mobile-header');
                    if (mobHeader) {
                        mobHeader.classList.remove('opacity-0', 'translate-y-4');
                        mobHeader.classList.add('opacity-100', 'translate-y-0');
                    }

                    const mobActions = document.getElementById('hero-mobile-actions');
                    if (mobActions) {
                        mobActions.classList.remove('opacity-0', 'translate-y-4');
                        mobActions.classList.add('opacity-100', 'translate-y-0');
                    }
                }
            }
            else {
                isCinematicRunning = false;

                // 2 SECONDS AFTER RING DOCKS: Smoothly auto-scroll to product cards!
                if (!hasAutoScrolled) {
                    hasAutoScrolled = true;
                    setTimeout(() => {
                        const productSection = document.getElementById('products-showcase');
                        if (productSection && window.scrollY < 80) {
                            productSection.scrollIntoView({ behavior: 'smooth' });
                        }
                    }, 2000);
                }
            }
        } 
        else {
            // Idle Floating & Mouse Gyro
            if (!isDragging) {
                const idleTime = Date.now() * 0.001;
                const floatOffset = Math.sin(idleTime * 1.5) * 0.03;

                ringMeshGroup.position.x = config.targetX;
                boxGroup.position.x = config.targetX;

                ringMeshGroup.position.y = config.ringDockY + floatOffset;
                boxGroup.position.y = config.targetDockY + floatOffset;

                const targetY = mouseTargetRotation.y;
                const targetX = mouseTargetRotation.x;
                
                boxGroup.rotation.y += (targetY - boxGroup.rotation.y) * 0.04;
                ringMeshGroup.rotation.y += (targetY - ringMeshGroup.rotation.y) * 0.04;
                boxGroup.rotation.x += (targetX - boxGroup.rotation.x) * 0.04;
                ringMeshGroup.rotation.x += (targetX - ringMeshGroup.rotation.x) * 0.04;
            }

            diamondGroup.rotation.y += 0.015;
        }

        renderer.render(scene, camera);
    }
    animate();
});
</script>

@endsection
