@extends('admin.layout')

@section('title', 'Dashboard Radar')
@section('header_title', 'Maison Dashboard Radar')

@section('content')
<div class="space-y-8">

    <!-- WELCOME BANNER (VIP MAISON EXPERIENCE) -->
    <div class="glass-card-luxury p-6 sm:p-8 rounded-3xl relative overflow-hidden flex flex-col md:flex-row md:items-center md:justify-between gap-6 border border-amber-400/25">
        <!-- Ambient Gold Glow inside Banner -->
        <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -left-12 -top-12 w-64 h-64 bg-amber-600/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 space-y-2 max-w-2xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-300 text-[10px] uppercase font-bold tracking-[0.2em]">
                <i class="fa-solid fa-crown text-[9px]"></i>
                Executive Control Deck
            </div>
            <h2 class="text-2xl sm:text-4xl font-cinzel font-bold text-white tracking-wide">
                Welcome, <span class="gold-text-shimmer">{{ Auth::user()->name ?? 'Store Director' }}</span>
            </h2>
            <p class="text-xs sm:text-sm text-stone-300 font-light leading-relaxed">
                Real-time inventory radar, bespoke category tracking, customer inquiries, and luxury catalogue management.
            </p>
        </div>

        <div class="flex items-center gap-3 relative z-10 flex-wrap">
            <a href="{{ route('admin.products.create') }}" 
                class="w-full sm:w-auto px-6 py-3.5 rounded-2xl bg-gradient-to-r from-amber-300 via-amber-400 to-amber-500 hover:from-amber-200 hover:to-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider shadow-xl shadow-amber-500/25 transition transform hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2.5">
                <i class="fa-solid fa-plus text-sm"></i>
                Add New Jewellery
            </a>
            <a href="{{ route('admin.inquiries.index') }}" 
                class="w-full sm:w-auto px-5 py-3.5 rounded-2xl bg-white/5 hover:bg-white/10 text-stone-200 font-bold text-xs uppercase tracking-wider border border-white/10 transition flex items-center justify-center gap-2">
                <i class="fa-solid fa-envelope-open-text text-amber-400"></i>
                Inquiries
            </a>
        </div>
    </div>

    <!-- METRICS STATS CARDS (4-GRID) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3.5 sm:gap-6">
        
        <!-- Total Products Card -->
        <div class="glass-card-luxury p-4 sm:p-6 rounded-3xl relative overflow-hidden group hover:border-amber-400/40 transition duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-stone-400">Jewellery Vault</p>
                    <h3 class="text-2xl sm:text-4xl font-cinzel font-bold text-white mt-1">{{ $totalProducts }}</h3>
                    <p class="text-[10px] sm:text-xs text-amber-300/80 font-medium mt-1">Active Listings</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-gradient-to-br from-amber-400/20 to-amber-600/30 border border-amber-400/30 text-amber-300 flex items-center justify-center text-base sm:text-xl shadow-lg shadow-amber-500/10 group-hover:scale-110 transition transform">
                    <i class="fa-solid fa-gem"></i>
                </div>
            </div>
        </div>

        <!-- Total Collections Card -->
        <div class="glass-card-luxury p-4 sm:p-6 rounded-3xl relative overflow-hidden group hover:border-amber-400/40 transition duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-stone-400">Collections</p>
                    <h3 class="text-2xl sm:text-4xl font-cinzel font-bold text-white mt-1">{{ $totalCategories }}</h3>
                    <p class="text-[10px] sm:text-xs text-stone-400 font-medium mt-1">Rings, Sets, etc.</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-indigo-500/15 border border-indigo-500/30 text-indigo-300 flex items-center justify-center text-base sm:text-xl shadow-lg group-hover:scale-110 transition transform">
                    <i class="fa-solid fa-tags"></i>
                </div>
            </div>
        </div>

        <!-- Inventory Stock Units Card -->
        <div class="glass-card-luxury p-4 sm:p-6 rounded-3xl relative overflow-hidden group hover:border-amber-400/40 transition duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-stone-400">Stock Inventory</p>
                    <h3 class="text-2xl sm:text-4xl font-cinzel font-bold text-white mt-1">{{ $totalStock }}</h3>
                    <p class="text-[10px] sm:text-xs text-emerald-400 font-medium mt-1">Units Available</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 flex items-center justify-center text-base sm:text-xl shadow-lg group-hover:scale-110 transition transform">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>
            </div>
        </div>

        <!-- Customer Orders Card -->
        <div class="glass-card-luxury p-4 sm:p-6 rounded-3xl relative overflow-hidden group hover:border-amber-400/40 transition duration-300">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[10px] sm:text-xs font-bold uppercase tracking-wider text-stone-400">Client Orders</p>
                    <h3 class="text-2xl sm:text-4xl font-cinzel font-bold text-white mt-1">{{ $totalOrders }}</h3>
                    <p class="text-[10px] sm:text-xs text-amber-400 font-medium mt-1">Processed</p>
                </div>
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-sky-500/15 border border-sky-500/30 text-sky-300 flex items-center justify-center text-base sm:text-xl shadow-lg group-hover:scale-110 transition transform">
                    <i class="fa-solid fa-bag-shopping"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- 2-COLUMNS: RECENT RELEASES & LOW STOCK RADAR -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- RECENT JEWELLERY (8 COLS) -->
        <div class="lg:col-span-8 glass-card-luxury p-5 sm:p-7 rounded-3xl space-y-6">
            <div class="flex items-center justify-between border-b border-white/5 pb-4">
                <div>
                    <h3 class="font-cinzel font-bold text-base sm:text-lg text-white">Recent Jewellery Acquisitions</h3>
                    <p class="text-[11px] text-stone-400 mt-0.5">Latest pieces crafted and added to the boutique</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-amber-400 hover:text-amber-300 transition flex items-center gap-1.5 group">
                    <span>View All</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition transform"></i>
                </a>
            </div>

            <!-- DESKTOP TABLE VIEW -->
            <div class="hidden sm:block overflow-x-auto">
                <table class="w-full text-left text-sm text-stone-300">
                    <thead class="text-[10px] uppercase tracking-wider bg-white/[0.03] text-stone-400 border-b border-white/5">
                        <tr>
                            <th class="py-3.5 px-4 rounded-l-2xl">Item</th>
                            <th class="py-3.5 px-4">Collection</th>
                            <th class="py-3.5 px-4">Price</th>
                            <th class="py-3.5 px-4">Stock</th>
                            <th class="py-3.5 px-4 rounded-r-2xl text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($recentProducts as $product)
                            <tr class="hover:bg-white/[0.02] transition">
                                <td class="py-3.5 px-4 flex items-center gap-3">
                                    @if($product->image)
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-11 h-11 rounded-xl object-cover border border-amber-400/20 shadow-md">
                                    @else
                                        <div class="w-11 h-11 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-amber-400">
                                            <i class="fa-solid fa-gem text-xs"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-white text-xs sm:text-sm">{{ $product->name }}</p>
                                        <p class="text-[10px] text-stone-400">{{ $product->material ?? 'Fine Jewellery' }}</p>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold tracking-wide uppercase bg-amber-400/10 text-amber-300 border border-amber-400/30">
                                        {{ $product->category->name ?? 'Vault' }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 font-bold text-amber-300 text-xs sm:text-sm">
                                    Rs. {{ number_format($product->price, 0) }}
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $product->stock <= 5 ? 'bg-rose-500/10 text-rose-400 border border-rose-500/30' : 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30' }}">
                                        {{ $product->stock }} in stock
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 text-stone-400 hover:text-amber-400 transition inline-block">
                                        <i class="fa-solid fa-pen-to-square text-sm"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-stone-500 text-xs">No jewellery pieces in vault yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- MOBILE CARDS VIEW (PRODUCTION RESPONSIVE) -->
            <div class="sm:hidden space-y-3">
                @forelse($recentProducts as $product)
                    <div class="p-3.5 rounded-2xl bg-white/[0.02] border border-white/5 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3 min-w-0">
                            @if($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-xl object-cover border border-amber-400/20 flex-shrink-0">
                            @else
                                <div class="w-12 h-12 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-amber-400 flex-shrink-0">
                                    <i class="fa-solid fa-gem text-xs"></i>
                                </div>
                            @endif
                            <div class="min-w-0">
                                <p class="font-bold text-white text-xs truncate">{{ $product->name }}</p>
                                <p class="text-[10px] text-amber-300 font-bold mt-0.5">Rs. {{ number_format($product->price, 0) }}</p>
                                <span class="text-[9px] text-stone-400">{{ $product->category->name ?? 'Vault' }} • {{ $product->stock }} left</span>
                            </div>
                        </div>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="w-9 h-9 rounded-xl bg-amber-400/10 border border-amber-400/30 text-amber-300 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                        </a>
                    </div>
                @empty
                    <p class="text-center text-xs text-stone-500 py-6">No jewellery items registered yet.</p>
                @endforelse
            </div>
        </div>

        <!-- LOW STOCK RADAR (4 COLS) -->
        <div class="lg:col-span-4 glass-card-luxury p-5 sm:p-7 rounded-3xl space-y-5">
            <div class="flex items-center justify-between border-b border-white/5 pb-4">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-xl bg-amber-500/15 border border-amber-500/30 text-amber-400 flex items-center justify-center text-xs">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <h3 class="font-cinzel font-bold text-base text-white">Stock Warnings</h3>
                </div>
                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-400/10 text-amber-300 border border-amber-400/30">
                    {{ count($lowStockProducts) }} Low
                </span>
            </div>

            <div class="space-y-3">
                @forelse($lowStockProducts as $lowItem)
                    <div class="p-3.5 rounded-2xl bg-gradient-to-r from-amber-950/30 via-transparent to-transparent border border-amber-500/25 flex items-center justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-white text-xs truncate">{{ $lowItem->name }}</p>
                            <p class="text-[10px] text-amber-400 font-semibold mt-0.5">Only {{ $lowItem->stock }} pieces left!</p>
                        </div>
                        <a href="{{ route('admin.products.edit', $lowItem->id) }}" 
                            class="px-3 py-1.5 text-[10px] font-bold rounded-xl bg-amber-400 text-slate-950 hover:bg-amber-300 transition uppercase tracking-wider flex-shrink-0">
                            Restock
                        </a>
                    </div>
                @empty
                    <div class="text-center py-10 text-stone-500 space-y-2">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 flex items-center justify-center mx-auto text-lg">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <p class="text-xs font-semibold text-stone-400">Vault fully stocked!</p>
                        <p class="text-[10px] text-stone-600">No items below critical inventory thresholds.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
