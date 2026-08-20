@extends('shop.layout')

@section('title', ($selectedCategory ? $selectedCategory->name . ' - ' : '') . 'Shop Jewelry | ZVARR by Zaiyal')

@section('content')

<style>
    /* VIP Royal Luxury Card Styling */
    .luxury-jewelry-card {
        background: linear-gradient(180deg, #16151e 0%, #0b0a10 40%, #030305 100%);
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
        background: radial-gradient(ellipse at 50% 50%, rgba(35, 30, 24, 0.6) 0%, rgba(12, 11, 16, 0.2) 65%, transparent 100%);
    }
    /* Mirelle Mirror Glass Reflection */
    .mirelle-mirror-stage {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 200px;
        overflow: hidden;
    }
    .mirelle-jewel-img {
        max-height: 160px;
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
        max-height: 160px;
        max-width: 90%;
        object-fit: contain;
    }
    .mirelle-contact-shadow {
        position: absolute;
        bottom: 18px;
        width: 55%;
        height: 10px;
        background: radial-gradient(ellipse at center, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.4) 50%, transparent 80%);
        border-radius: 50%;
        filter: blur(3px);
        pointer-events-none;
        z-index: 8;
    }
    .scrollbar-none::-webkit-scrollbar { display: none; }
    .scrollbar-none { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<div class="bg-[#09090b] pt-20 sm:pt-24 pb-6 sm:pb-10 border-b border-white/5 relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center text-xs text-stone-400 gap-2 mb-2 font-medium">
            <a href="{{ route('home') }}" class="hover:text-amber-300">Home</a>
            <i class="fa-solid fa-chevron-right text-[9px] text-stone-600"></i>
            <span class="text-amber-300 font-semibold">
                {{ $selectedCategory ? $selectedCategory->name : 'All Jewelry' }}
            </span>
        </nav>
        <h1 class="text-2xl sm:text-5xl font-serif-luxury font-normal text-white">
            {{ $selectedCategory ? $selectedCategory->name : 'Jewelry Collection' }}
        </h1>
        <p class="text-xs text-stone-400 mt-1 max-w-2xl font-light">
            {{ $selectedCategory ? $selectedCategory->description : 'Browse our anti-tarnish everyday aesthetic pendants, watch display cuffs, stackable rings, and accessories.' }}
        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-12 relative z-10">
    
    <!-- MOBILE HORIZONTAL CATEGORY PILLS (Swipeable on Phone) -->
    <div class="lg:hidden mb-5">
        <div class="flex items-center gap-2 overflow-x-auto pb-2 -mx-4 px-4 scrollbar-none">
            <a href="{{ route('shop.index') }}" 
                class="flex-shrink-0 px-4 py-2 rounded-full text-xs font-bold transition {{ !request('category') ? 'bg-amber-400 text-slate-950 shadow-md shadow-amber-500/20' : 'bg-white/5 text-stone-300 border border-white/10 hover:border-amber-400/30' }}">
                <span>All Jewelry</span>
                <span class="ml-1 text-[10px] opacity-75">({{ \App\Models\Product::count() }})</span>
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('shop.category', $cat->slug) }}" 
                    class="flex-shrink-0 px-4 py-2 rounded-full text-xs font-bold transition {{ (request('category') == $cat->slug || (isset($selectedCategory) && $selectedCategory->slug == $cat->slug)) ? 'bg-amber-400 text-slate-950 shadow-md shadow-amber-500/20' : 'bg-white/5 text-stone-300 border border-white/10 hover:border-amber-400/30' }}">
                    <span>{{ $cat->name }}</span>
                    <span class="ml-1 text-[10px] opacity-75">({{ $cat->products_count }})</span>
                </a>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- DESKTOP SIDEBAR FILTERS (Hidden on Mobile) -->
        <div class="hidden lg:block lg:col-span-3 space-y-6">
            <div class="p-6 rounded-3xl luxury-jewelry-card space-y-6 sticky top-28">
                
                <!-- Category Filter List -->
                <div>
                    <h3 class="font-cinzel font-bold text-xs text-amber-300 uppercase tracking-widest mb-3">Categories</h3>
                    <ul class="space-y-1.5 text-xs">
                        <li>
                            <a href="{{ route('shop.index') }}" 
                                class="flex items-center justify-between py-2.5 px-3 rounded-xl transition {{ !request('category') ? 'bg-amber-400/10 text-amber-300 font-bold border border-amber-400/30' : 'text-stone-400 hover:bg-white/5 hover:text-stone-200' }}">
                                <span>All Jewelry</span>
                                <span class="text-[10px] text-stone-500">{{ \App\Models\Product::count() }}</span>
                            </a>
                        </li>
                        @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('shop.category', $cat->slug) }}" 
                                    class="flex items-center justify-between py-2.5 px-3 rounded-xl transition {{ (request('category') == $cat->slug || (isset($selectedCategory) && $selectedCategory->slug == $cat->slug)) ? 'bg-amber-400/10 text-amber-300 font-bold border border-amber-400/30' : 'text-stone-400 hover:bg-white/5 hover:text-stone-200' }}">
                                    <span>{{ $cat->name }}</span>
                                    <span class="text-[10px] text-stone-500">{{ $cat->products_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Reset Filters -->
                @if(request()->hasAny(['search', 'sort', 'category']))
                    <div class="pt-2 border-t border-white/5">
                        <a href="{{ route('shop.index') }}" class="block text-center text-xs text-amber-400 hover:underline">
                            Reset All Filters
                        </a>
                    </div>
                @endif

            </div>
        </div>

        <!-- PRODUCTS GRID (Full width on Mobile, 9 cols on Desktop) -->
        <div class="lg:col-span-9 space-y-5 sm:space-y-6">
            
            <!-- Top Bar with Unified Mobile & Desktop Search & Sorting -->
            <div class="p-3.5 sm:p-4 rounded-2xl luxury-jewelry-card space-y-3 text-xs">
                
                <!-- Search Input Row -->
                <form action="{{ url()->current() }}" method="GET" class="flex items-center gap-2">
                    @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                    @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif

                    <div class="relative flex-1">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-stone-400">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </span>
                        <input type="text" id="catalog-search-input" name="search" value="{{ request('search') }}"
                            placeholder="Search diamond, gold, rings..." 
                            class="w-full pl-9 pr-9 py-2.5 bg-[#121118] border border-white/10 rounded-xl text-xs text-stone-100 placeholder-stone-500 focus:outline-none focus:ring-1 focus:ring-amber-400">
                        
                        @if(request('search'))
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-stone-400 hover:text-rose-400 transition" title="Clear Search">
                                <i class="fa-solid fa-circle-xmark text-xs"></i>
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="px-4 py-2.5 bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 text-slate-950 font-bold rounded-xl text-xs shadow-sm transition flex-shrink-0">
                        Search
                    </button>
                </form>

                <!-- Count, Active Filter Tags & Sort Dropdown Row -->
                <div class="flex items-center justify-between gap-2 pt-2 border-t border-white/5 flex-wrap">
                    <div class="flex items-center gap-2 flex-wrap">
                        <p class="text-stone-400 font-light">
                            Showing <span class="font-bold text-amber-300">{{ $products->total() }}</span> pieces
                        </p>
                        @if(request('search'))
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-amber-400/10 text-amber-300 border border-amber-400/30">
                                <span>"{{ request('search') }}"</span>
                                <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="text-stone-400 hover:text-rose-400 transition" title="Clear Search">
                                    <i class="fa-solid fa-circle-xmark text-[9px]"></i>
                                </a>
                            </span>
                        @endif
                    </div>

                    <form action="{{ url()->current() }}" method="GET" class="flex items-center gap-1.5 ml-auto">
                        @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                        @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif

                        <label for="sort" class="text-stone-400 font-light hidden sm:inline">Sort:</label>
                        <select id="sort" name="sort" onchange="this.form.submit()" 
                            class="px-3 py-1.5 bg-[#121118] border border-white/10 rounded-xl text-xs text-stone-200 focus:outline-none focus:ring-1 focus:ring-amber-400">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest Arrivals</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Alphabetical</option>
                        </select>
                    </form>
                </div>

            </div>

            <!-- Products Grid with Mirelle Luxury Glass Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                @forelse($products as $product)
                    <div class="group luxury-jewelry-card rounded-3xl overflow-hidden flex flex-col justify-between p-5 sm:p-6 relative">
                        
                        <!-- 1. Top Section: Title & Badges -->
                        <div class="space-y-1.5 z-10">
                            <div class="flex items-center justify-between">
                                <span class="text-[9px] font-bold uppercase tracking-[0.25em] text-amber-400/90">
                                    {{ $product->category->name }}
                                </span>

                                @if($product->discount_price)
                                    <span class="px-2.5 py-0.5 rounded-full text-[8.5px] font-bold uppercase bg-amber-400/15 text-amber-300 border border-amber-400/30">
                                        Special Edition
                                    </span>
                                @endif
                            </div>

                            <h3 class="font-serif-luxury font-normal text-xl text-stone-100 group-hover:text-amber-300 transition duration-300 leading-snug line-clamp-1">
                                <a href="{{ route('shop.product', $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </h3>
                        </div>

                        <!-- 2. Middle Section: Floating Jewelry on Glossy Glass Floor with Inverted Reflection -->
                        <a href="{{ route('shop.product', $product->slug) }}" class="block w-full my-3 sm:my-4">
                            <div class="mirelle-mirror-stage luxury-podium-stage rounded-2xl w-full">
                                
                                <!-- Central Golden Halo -->
                                <div class="absolute w-36 h-36 bg-amber-400/15 rounded-full blur-2xl pointer-events-none group-hover:bg-amber-400/25 transition-all duration-700"></div>

                                <!-- Contact Base Shadow -->
                                <div class="mirelle-contact-shadow"></div>

                                <!-- Main Floating Jewel -->
                                <img src="{{ $product->image ?? 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=800' }}" 
                                    alt="{{ $product->name }}" 
                                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=800';"
                                    class="auto-remove-bg mirelle-jewel-img">

                                <!-- Exact Glass Floor Reflection -->
                                <div class="mirelle-reflection-layer">
                                    <img src="{{ $product->image ?? 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=800' }}" 
                                        alt="" 
                                        onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=800';"
                                        class="auto-remove-bg mirelle-reflection-img">
                                </div>

                            </div>
                        </a>

                        <!-- 3. Bottom Section: Material, Price & Actions -->
                        <div class="pt-2 z-10 space-y-3">
                            <span class="text-[9px] font-medium text-stone-400 uppercase tracking-widest block">
                                {{ $product->material }}
                            </span>

                            <div class="pt-3 border-t border-white/10 flex items-center justify-between">
                                <div>
                                    <span class="text-lg font-extrabold text-amber-300 block font-cinzel tracking-wide">
                                        Rs. {{ number_format($product->price, 0) }}
                                    </span>
                                    @if($product->discount_price)
                                        <span class="text-xs text-stone-500 line-through">
                                            Rs. {{ number_format($product->discount_price, 0) }}
                                        </span>
                                    @endif
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="https://wa.me/{{ $storeSettings['whatsapp_number'] ?? '923001234567' }}?text={{ urlencode('Hi ZVARR by Zaiyal! I want to order: ' . $product->name . ' (Rs. ' . number_format($product->price, 0) . ')') }}"
                                        target="_blank"
                                        title="Quick WhatsApp Order"
                                        class="px-3 py-1.5 rounded-xl bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 hover:bg-emerald-500/20 flex items-center gap-1.5 text-xs font-bold transition">
                                        <i class="fa-brands fa-whatsapp text-sm"></i>
                                    </a>

                                    <a href="{{ route('shop.product', $product->slug) }}" 
                                        class="w-8 h-8 rounded-xl bg-white/5 hover:bg-amber-400/20 text-stone-300 hover:text-amber-300 flex items-center justify-center text-xs transition border border-white/10 hover:border-amber-400/35"
                                        title="View Details">
                                        <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-3 text-center py-16 luxury-jewelry-card rounded-3xl">
                        <i class="fa-solid fa-gem text-4xl text-stone-600 mb-3"></i>
                        <h4 class="font-cinzel font-bold text-stone-200 text-base">No pieces found</h4>
                        <p class="text-xs text-stone-500 mt-1">Try selecting another category or resetting filters.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>

        </div>

    </div>
</div>
@endsection
