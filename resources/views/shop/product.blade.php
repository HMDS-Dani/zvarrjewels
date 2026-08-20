@extends('shop.layout')

@section('title', $product->name . ' | ZVARR by Zaiyal')

@section('content')

<style>
    /* Radial Deep Luxury Vignette */
    .bg-obsidian-detail {
        background: radial-gradient(circle at 50% 25%, #181512 0%, #0d0c0f 55%, #040405 100%);
    }

    /* Clean, Polished Sliding Entrance */
    @keyframes smoothSlideUp {
        0% {
            opacity: 0;
            transform: translateY(18px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-smooth-in {
        animation: smoothSlideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .luxury-detail-card {
        background: linear-gradient(180deg, #16151e 0%, #0b0a10 40%, #030305 100%);
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 16px 36px -8px rgba(0, 0, 0, 0.85), inset 0 1px 0 rgba(255, 255, 255, 0.12);
    }
    
    /* Mirelle Mirror Glass Reflection for Product Page */
    .mirelle-detail-stage {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 240px;
        overflow: hidden;
    }
    @media (min-width: 640px) {
        .mirelle-detail-stage { height: 320px; }
    }
    @media (min-width: 1024px) {
        .mirelle-detail-stage { height: 380px; }
    }

    .mirelle-detail-img {
        max-height: 180px;
        max-width: 85%;
        object-fit: contain;
        position: relative;
        z-index: 10;
        filter: drop-shadow(0 15px 25px rgba(0, 0, 0, 0.95)) brightness(1.08) contrast(1.12);
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @media (min-width: 640px) {
        .mirelle-detail-img { max-height: 250px; }
    }
    @media (min-width: 1024px) {
        .mirelle-detail-img { max-height: 290px; }
    }

    .mirelle-detail-reflection {
        position: absolute;
        bottom: -30px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        transform: scaleY(-1);
        opacity: 0.35;
        filter: blur(0.4px);
        mask-image: linear-gradient(to top, rgba(0,0,0,1) 0%, rgba(0,0,0,0.5) 40%, rgba(0,0,0,0) 80%);
        -webkit-mask-image: linear-gradient(to top, rgba(0,0,0,1) 0%, rgba(0,0,0,0.5) 40%, rgba(0,0,0,0) 80%);
        pointer-events-none;
        z-index: 5;
    }
    .mirelle-detail-reflect-img {
        max-height: 180px;
        max-width: 85%;
        object-fit: contain;
    }
    @media (min-width: 640px) {
        .mirelle-detail-reflect-img { max-height: 250px; }
    }
    @media (min-width: 1024px) {
        .mirelle-detail-reflect-img { max-height: 290px; }
    }

    .mirelle-detail-shadow {
        position: absolute;
        bottom: 20px;
        width: 55%;
        height: 10px;
        background: radial-gradient(ellipse at center, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 50%, transparent 80%);
        border-radius: 50%;
        filter: blur(4px);
        pointer-events-none;
        z-index: 8;
    }
</style>

<div class="bg-obsidian-detail min-h-screen pt-16 sm:pt-20 pb-28 lg:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center text-xs text-stone-400 gap-2 mb-2 sm:mb-4 font-medium animate-smooth-in">
            <a href="{{ route('home') }}" class="hover:text-amber-400 transition">Home</a>
            <i class="fa-solid fa-chevron-right text-[8px] text-stone-600"></i>
            <a href="{{ route('shop.category', $product->category->slug) }}" class="hover:text-amber-400 transition">{{ $product->category->name }}</a>
            <i class="fa-solid fa-chevron-right text-[8px] text-stone-600"></i>
            <span class="text-amber-300 font-semibold truncate">{{ $product->name }}</span>
        </nav>

        <!-- MAIN PRODUCT GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 lg:gap-12 items-start">
            
            <!-- 1. PRODUCT IMAGE SHOWCASE (Mobile: 1st; Desktop: Right 6 cols) -->
            <div class="lg:col-span-6 lg:order-2 space-y-3 animate-smooth-in">
                <div class="relative rounded-2xl sm:rounded-3xl luxury-detail-card p-3 sm:p-8 border border-white/10 shadow-2xl flex items-center justify-center overflow-hidden">
                    
                    <!-- Ambient Glow Flare -->
                    <div class="absolute -top-16 -right-16 w-48 sm:w-64 h-48 sm:h-64 bg-amber-500/12 rounded-full blur-3xl pointer-events-none"></div>

                    <!-- Category Badge -->
                    <span class="absolute top-3 left-3 sm:top-4 sm:left-4 px-3 py-0.5 sm:py-1 rounded-full text-[9.5px] sm:text-xs font-bold uppercase tracking-widest bg-black/80 backdrop-blur-md text-amber-300 border border-amber-400/25 z-20">
                        {{ $product->category->name }}
                    </span>

                    @if($product->discount_price)
                        <span class="absolute top-3 right-3 sm:top-4 sm:right-4 px-3 py-0.5 sm:py-1 rounded-full text-[9.5px] sm:text-xs font-bold uppercase bg-amber-400/20 text-amber-300 border border-amber-400/30 backdrop-blur-md z-20">
                            Sale Edition
                        </span>
                    @endif

                    <!-- Mirelle Mirror Glass Podium Stage (Proportionate on Mobile & Desktop) -->
                    <div class="mirelle-detail-stage w-full relative z-10">
                        <!-- Golden Aura Halo -->
                        <div class="absolute w-36 sm:w-52 h-36 sm:h-52 bg-amber-400/15 rounded-full blur-3xl pointer-events-none"></div>

                        <!-- Contact Base Shadow -->
                        <div class="mirelle-detail-shadow"></div>

                        <!-- Main Jewel -->
                        <img src="{{ $product->image_url }}" 
                            alt="{{ $product->name }}" 
                            onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=1000';"
                            class="auto-remove-bg mirelle-detail-img">

                        <!-- Upside Down Mirror Reflection -->
                        <div class="mirelle-detail-reflection">
                            <img src="{{ $product->image_url }}" 
                                alt="" 
                                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=1000';"
                                class="auto-remove-bg mirelle-detail-reflect-img">
                        </div>
                    </div>

                </div>

                <!-- Unboxing Assurance Card (Desktop only) -->
                <div class="hidden sm:flex p-4 rounded-2xl luxury-detail-card border border-white/10 items-center gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-amber-400/10 text-amber-300 border border-amber-400/20 flex items-center justify-center text-base flex-shrink-0">
                        <i class="fa-solid fa-gift"></i>
                    </div>
                    <div>
                        <h5 class="text-xs font-bold text-stone-200 uppercase tracking-wide">Signature ZVARR Unboxing Experience</h5>
                        <p class="text-[11px] text-stone-400 mt-0.5 font-light">Every piece arrives in our aesthetic signature gift pouch & luxury protective vault box.</p>
                    </div>
                </div>
            </div>

            <!-- 2. PRODUCT DETAILS & ACTIONS (Mobile: 2nd; Desktop: Left 6 cols) -->
            <div class="lg:col-span-6 lg:order-1 space-y-4 animate-smooth-in">
                
                <!-- Badge, Title & Material -->
                <div class="space-y-1.5">
                    <div class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full bg-black/70 border border-amber-400/30 text-amber-300 text-[9px] sm:text-[10px] font-semibold uppercase tracking-widest backdrop-blur-md">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-ping"></span>
                        <span>{{ $product->category->name }} • {{ $product->material }}</span>
                    </div>

                    <h1 class="text-2xl sm:text-4xl lg:text-5xl font-serif-luxury font-normal text-white leading-tight">
                        {{ $product->name }}
                    </h1>

                    <p class="text-[11px] text-stone-500 font-mono">SKU: ZVARR-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>

                <!-- Price Box with Stock Status -->
                <div class="p-3.5 sm:p-5 rounded-2xl luxury-detail-card border border-white/10 flex items-center justify-between shadow-xl">
                    <div>
                        <span class="text-[9px] sm:text-[10px] uppercase font-semibold tracking-wider text-stone-400 block mb-0.5">Price (All Pakistan COD)</span>
                        <div class="flex items-baseline gap-2 flex-wrap">
                            <span class="text-xl sm:text-3xl font-extrabold text-amber-300 font-cinzel tracking-wider">
                                Rs. {{ number_format($product->price, 0) }}
                            </span>
                            @if($product->discount_price)
                                <span class="text-xs text-stone-500 line-through">
                                    Rs. {{ number_format($product->discount_price, 0) }}
                                </span>
                                <span class="px-2 py-0.5 rounded-full text-[9px] font-bold bg-amber-400/20 text-amber-300 border border-amber-400/30">
                                    Save Rs. {{ number_format($product->discount_price - $product->price, 0) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div>
                        @if($product->stock > 5)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10.5px] font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                In Stock
                            </span>
                        @elseif($product->stock > 0)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10.5px] font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                Only {{ $product->stock }} left!
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10.5px] font-semibold bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                Sold Out
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                <div class="space-y-1">
                    <h3 class="text-[10px] sm:text-[10.5px] font-bold uppercase tracking-widest text-amber-300">Artisanal Details</h3>
                    <p class="text-xs sm:text-sm text-stone-300 leading-relaxed font-light">
                        {{ $product->description ?? 'A radiant brilliant-cut diamond cast on a high-polish platinum pavé band, crafted for timeless elegance and non-fade daily wear.' }}
                    </p>
                </div>

                <!-- Key Specs Grid -->
                <div class="grid grid-cols-2 gap-2.5">
                    <div class="p-3 luxury-detail-card rounded-xl border border-white/10">
                        <span class="text-[9px] uppercase font-semibold text-stone-400 block">Material Finish</span>
                        <span class="text-xs font-semibold text-stone-200">{{ $product->material }}</span>
                    </div>
                    <div class="p-3 luxury-detail-card rounded-xl border border-white/10">
                        <span class="text-[9px] uppercase font-semibold text-stone-400 block">Delivery Speed</span>
                        <span class="text-xs font-semibold text-stone-200">2-4 Days COD All Pakistan 🇵🇰</span>
                    </div>
                </div>

                <!-- Primary Action Buttons (Desktop & Tablet) -->
                <div class="space-y-2.5 pt-2 border-t border-white/10">
                    <a href="https://wa.me/{{ $storeSettings['whatsapp_number'] ?? '923001234567' }}?text={{ urlencode('Hello ZVARR by Zaiyal! I would like to order: ' . $product->name . ' (Rs. ' . number_format($product->price, 0) . ') Link: ' . url()->current()) }}" 
                        target="_blank"
                        class="w-full py-3.5 sm:py-4 bg-gradient-to-r from-emerald-500 via-emerald-600 to-teal-700 hover:opacity-95 text-white font-bold text-xs uppercase tracking-[0.2em] rounded-2xl shadow-xl shadow-emerald-950 transition flex items-center justify-center gap-2 transform hover:-translate-y-0.5">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                        <span>Order Instantly via WhatsApp</span>
                    </a>

                    @if(!empty($storeSettings['instagram_url']))
                        <a href="{{ $storeSettings['instagram_url'] }}" 
                            target="_blank"
                            class="w-full py-3 luxury-detail-card hover:bg-white/10 text-stone-200 font-bold text-[11px] uppercase tracking-[0.15em] rounded-2xl transition flex items-center justify-center gap-2 border border-white/10 hover:border-amber-400/40">
                            <i class="fa-brands fa-instagram text-sm"></i>
                            <span>DM on Instagram (@zvarrjewelspk)</span>
                        </a>
                    @endif
                </div>

                <!-- Reassurance Strip -->
                <div class="pt-3 flex items-center justify-between text-[10px] text-stone-400 border-t border-white/5 flex-wrap gap-2">
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-shield-halved text-amber-400"></i> Anti-Tarnish Guarantee</span>
                    <span class="flex items-center gap-1.5"><i class="fa-solid fa-truck-fast text-amber-400"></i> Free Open Parcel Checking</span>
                </div>

            </div>

        </div>

        <!-- 3. CUSTOMER REVIEWS & RATINGS SECTION -->
        <div class="mt-16 sm:mt-24 space-y-8 animate-smooth-in">
            
            <!-- Success Message Toast -->
            @if(session('review_success'))
                <div class="p-4 rounded-2xl bg-emerald-950/70 border border-emerald-500/40 text-emerald-300 text-xs sm:text-sm font-semibold flex items-center gap-2.5 shadow-xl">
                    <i class="fa-solid fa-circle-check text-emerald-400 text-base"></i>
                    <span>{{ session('review_success') }}</span>
                </div>
            @endif

            <div class="p-6 sm:p-10 rounded-3xl luxury-detail-card space-y-8">
                
                <!-- Section Header with Overall Rating & Add Review Button -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-white/10 pb-6">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <div class="flex text-amber-400 text-sm">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <span class="font-bold text-white text-sm">5.0 / 5.0</span>
                        </div>
                        <h3 class="font-serif-luxury font-normal text-2xl sm:text-3xl text-white">Client Testimonials & Reviews</h3>
                        <p class="text-xs text-stone-400 mt-0.5">Real feedback from verified buyers across Pakistan</p>
                    </div>

                    <button type="button" onclick="openReviewModal()"
                        class="px-5 py-2.5 bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-xl shadow-md shadow-amber-500/20 transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Write a Review</span>
                    </button>
                </div>

                <!-- Reviews Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    @forelse($product->reviews as $rev)
                        <div class="p-5 rounded-2xl bg-black/40 border border-white/10 space-y-3 flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="flex items-center justify-between">
                                    <div class="flex text-amber-400 text-xs gap-0.5">
                                        @for($i = 1; $i <= $rev->rating; $i++)
                                            <i class="fa-solid fa-star"></i>
                                        @endfor
                                    </div>
                                    <span class="text-[10px] text-stone-500 font-mono">{{ $rev->created_at->format('M d, Y') }}</span>
                                </div>
                                <p class="text-xs text-stone-200 font-light leading-relaxed">
                                    "{{ $rev->comment }}"
                                </p>
                            </div>

                            <div class="pt-2 border-t border-white/5 flex items-center justify-between text-[11px]">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-amber-400/20 text-amber-300 font-bold flex items-center justify-center text-[10px]">
                                        {{ substr($rev->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="font-bold text-stone-200 block">{{ $rev->name }}</span>
                                        <span class="text-[10px] text-stone-500">{{ $rev->city ?? 'Pakistan' }}</span>
                                    </div>
                                </div>
                                @if($rev->is_verified_buyer)
                                    <span class="inline-flex items-center gap-1 text-[9.5px] font-bold text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-full border border-emerald-500/20">
                                        <i class="fa-solid fa-circle-check text-[8px]"></i>
                                        Verified
                                    </span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <!-- Default Rich Verified Testimonials -->
                        <div class="p-5 rounded-2xl bg-black/40 border border-white/10 space-y-3 flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="flex text-amber-400 text-xs gap-0.5">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <p class="text-xs text-stone-200 font-light leading-relaxed">
                                    "The shine on this piece is breathtaking! Delivered to Lahore in just 2 days. The anti-tarnish finish is 100% genuine."
                                </p>
                            </div>
                            <div class="pt-2 border-t border-white/5 flex items-center justify-between text-[11px]">
                                <span class="font-bold text-stone-200">Zainab Fatima • Lahore</span>
                                <span class="text-[9.5px] font-bold text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-full">✓ Verified</span>
                            </div>
                        </div>

                        <div class="p-5 rounded-2xl bg-black/40 border border-white/10 space-y-3 flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="flex text-amber-400 text-xs gap-0.5">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <p class="text-xs text-stone-200 font-light leading-relaxed">
                                    "The French pavé cut looks just like a 5-carat real diamond. Arrived in a luxury velvet vault box!"
                                </p>
                            </div>
                            <div class="pt-2 border-t border-white/5 flex items-center justify-between text-[11px]">
                                <span class="font-bold text-stone-200">Areeba K. • Karachi</span>
                                <span class="text-[9.5px] font-bold text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-full">✓ Verified</span>
                            </div>
                        </div>

                        <div class="p-5 rounded-2xl bg-black/40 border border-white/10 space-y-3 flex flex-col justify-between">
                            <div class="space-y-2">
                                <div class="flex text-amber-400 text-xs gap-0.5">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <p class="text-xs text-stone-200 font-light leading-relaxed">
                                    "Ordered via WhatsApp concierge. Super smooth delivery and open parcel checking gave complete peace of mind."
                                </p>
                            </div>
                            <div class="pt-2 border-t border-white/5 flex items-center justify-between text-[11px]">
                                <span class="font-bold text-stone-200">Mahnoor A. • Islamabad</span>
                                <span class="text-[9.5px] font-bold text-emerald-400 bg-emerald-500/10 px-2 py-0.5 rounded-full">✓ Verified</span>
                            </div>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>

    </div>

    <!-- STICKY MOBILE BOTTOM BUY BAR (Fixed at bottom on phones for 1-Tap WhatsApp Order) -->
    <div class="lg:hidden fixed bottom-0 inset-x-0 bg-slate-950/95 backdrop-blur-xl border-t border-white/10 p-3 px-4 flex items-center justify-between gap-3 z-40 shadow-2xl">
        <div>
            <span class="text-[9px] uppercase tracking-wider text-stone-400 block font-medium">Total Price:</span>
            <span class="text-lg font-extrabold text-amber-300 font-cinzel">
                Rs. {{ number_format($product->price, 0) }}
            </span>
        </div>

        <a href="https://wa.me/{{ $storeSettings['whatsapp_number'] ?? '923001234567' }}?text={{ urlencode('Hello ZVARR by Zaiyal! I would like to order: ' . $product->name . ' (Rs. ' . number_format($product->price, 0) . ') Link: ' . url()->current()) }}" 
            target="_blank"
            class="px-5 py-3 bg-gradient-to-r from-emerald-500 via-emerald-600 to-teal-700 hover:opacity-95 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-emerald-950 flex items-center gap-2">
            <i class="fa-brands fa-whatsapp text-sm"></i>
            <span>Order WhatsApp</span>
        </a>
    </div>

</div>

<!-- WRITE A REVIEW MODAL -->
<div id="review-modal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-md hidden items-center justify-center p-4">
    <div class="bg-slate-900 border border-slate-700 rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-4 animate-in fade-in zoom-in-95 duration-200">
        
        <div class="flex items-center justify-between border-b border-slate-800 pb-3">
            <div>
                <h3 class="font-serif-luxury font-bold text-xl text-white">Write a Verified Review</h3>
                <p class="text-xs text-stone-400">Share your experience with {{ $product->name }}</p>
            </div>
            <button type="button" onclick="closeReviewModal()" class="text-stone-400 hover:text-white p-1 rounded-lg">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form action="{{ route('reviews.submit') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <!-- Rating Stars Selection -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-1.5">
                    Your Rating <span class="text-amber-400">*</span>
                </label>
                <div class="flex items-center gap-2" id="star-rating-select">
                    <input type="hidden" name="rating" id="review-rating-val" value="5">
                    @for($i = 1; $i <= 5; $i++)
                        <button type="button" onclick="setRating({{ $i }})" class="star-btn text-amber-400 text-xl hover:scale-110 transition">
                            <i class="fa-solid fa-star" id="star-{{ $i }}"></i>
                        </button>
                    @endfor
                    <span id="rating-label" class="text-xs text-amber-300 font-semibold ml-2">5 Stars (Excellent)</span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-1.5">
                        Your Full Name <span class="text-amber-400">*</span>
                    </label>
                    <input type="text" name="name" value="{{ Auth::check() ? Auth::user()->name : '' }}" required placeholder="e.g. Ayesha Khan"
                        class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-stone-100 placeholder-stone-500 focus:outline-none focus:ring-1 focus:ring-amber-400">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-1.5">
                        City / Location
                    </label>
                    <input type="text" name="city" placeholder="e.g. Lahore, Karachi"
                        class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-stone-100 placeholder-stone-500 focus:outline-none focus:ring-1 focus:ring-amber-400">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-1.5">
                    Review / Feedback <span class="text-amber-400">*</span>
                </label>
                <textarea name="comment" rows="3" required placeholder="Describe the quality, anti-tarnish shine, and delivery speed..."
                    class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-stone-100 placeholder-stone-500 focus:outline-none focus:ring-1 focus:ring-amber-400 resize-none"></textarea>
            </div>

            <div class="pt-2 flex items-center gap-3">
                <button type="button" onclick="closeReviewModal()"
                    class="w-1/2 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-stone-300 text-xs font-bold transition">
                    Cancel
                </button>
                <button type="submit"
                    class="w-1/2 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 text-slate-950 text-xs font-bold uppercase tracking-wider shadow-md shadow-amber-500/20 transition">
                    Submit Review
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    function openReviewModal() {
        const modal = document.getElementById('review-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeReviewModal() {
        const modal = document.getElementById('review-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function setRating(val) {
        document.getElementById('review-rating-val').value = val;
        const labels = ['', '1 Star (Poor)', '2 Stars (Fair)', '3 Stars (Good)', '4 Stars (Very Good)', '5 Stars (Excellent)'];
        document.getElementById('rating-label').textContent = labels[val];

        for (let i = 1; i <= 5; i++) {
            const star = document.getElementById(`star-${i}`);
            if (i <= val) {
                star.className = 'fa-solid fa-star';
            } else {
                star.className = 'fa-regular fa-star text-stone-600';
            }
        }
    }
</script>
@endsection
