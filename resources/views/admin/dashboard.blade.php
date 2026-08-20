@extends('admin.layout')

@section('title', 'Dashboard Overview')
@section('header_title', 'Business Dashboard Overview')

@section('content')
<div class="space-y-8">

    <!-- WELCOME BANNER -->
    <div class="p-8 rounded-3xl bg-gradient-to-r from-amber-950/60 via-slate-900 to-slate-900 border border-amber-500/30 flex flex-col md:flex-row md:items-center md:justify-between gap-6 relative overflow-hidden">
        <div class="relative z-10">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-400">Store Management Console</span>
            <h2 class="text-2xl sm:text-3xl font-serif font-bold text-slate-100 mt-1">Welcome back, {{ Auth::user()->name }}!</h2>
            <p class="text-slate-400 text-sm mt-1 max-w-xl">Monitor your jewellery inventory, track product categories, and manage new listings in real time.</p>
        </div>
        <div class="flex items-center gap-3 relative z-10">
            <a href="{{ route('admin.products.create') }}" 
                class="px-5 py-3 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-bold text-sm shadow-lg shadow-amber-500/20 transition flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                Add New Jewellery
            </a>
        </div>
        <!-- Decorative Glow -->
        <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    <!-- METRICS CARDS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Total Products -->
        <div class="p-6 rounded-2xl bg-slate-900/90 border border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Jewellery Items</p>
                <h3 class="text-2xl font-bold text-slate-100 mt-1">{{ $totalProducts }}</h3>
                <p class="text-xs text-amber-400 font-medium mt-1">Across all collections</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center text-xl border border-amber-500/20">
                <i class="fa-solid fa-gem"></i>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="p-6 rounded-2xl bg-slate-900/90 border border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Active Categories</p>
                <h3 class="text-2xl font-bold text-slate-100 mt-1">{{ $totalCategories }}</h3>
                <p class="text-xs text-slate-400 font-medium mt-1">Rings, Necklaces, etc.</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center text-xl border border-indigo-500/20">
                <i class="fa-solid fa-tags"></i>
            </div>
        </div>

        <!-- Total Stock Units -->
        <div class="p-6 rounded-2xl bg-slate-900/90 border border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Inventory Units</p>
                <h3 class="text-2xl font-bold text-slate-100 mt-1">{{ $totalStock }}</h3>
                <p class="text-xs text-emerald-400 font-medium mt-1">In stock & ready to ship</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center text-xl border border-emerald-500/20">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="p-6 rounded-2xl bg-slate-900/90 border border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Customer Orders</p>
                <h3 class="text-2xl font-bold text-slate-100 mt-1">{{ $totalOrders }}</h3>
                <p class="text-xs text-slate-400 font-medium mt-1">Lifetime orders placed</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-sky-500/10 text-sky-400 flex items-center justify-center text-xl border border-sky-500/20">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
        </div>

    </div>

    <!-- 2 COLUMNS: RECENT PRODUCTS & LOW STOCK ALERTS -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Recent Jewellery Table (8 cols) -->
        <div class="lg:col-span-8 p-6 rounded-3xl bg-slate-900/90 border border-slate-800">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-serif font-bold text-lg text-slate-100">Recently Added Jewellery</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Latest items available on the storefront</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-amber-400 hover:underline">
                    View All &rarr;
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-300">
                    <thead class="text-xs uppercase bg-slate-800/60 text-slate-400 border-b border-slate-800">
                        <tr>
                            <th class="py-3 px-4 rounded-l-xl">Product</th>
                            <th class="py-3 px-4">Category</th>
                            <th class="py-3 px-4">Price</th>
                            <th class="py-3 px-4">Stock</th>
                            <th class="py-3 px-4 rounded-r-xl text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60">
                        @forelse($recentProducts as $product)
                            <tr class="hover:bg-slate-800/30 transition">
                                <td class="py-3.5 px-4 flex items-center gap-3">
                                    @if($product->image)
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-10 h-10 rounded-lg object-cover border border-slate-700">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-slate-800 flex items-center justify-center text-slate-500">
                                            <i class="fa-solid fa-gem text-xs"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="font-bold text-slate-100 text-sm">{{ $product->name }}</p>
                                        <p class="text-[11px] text-slate-400">{{ $product->material }}</p>
                                    </div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-800 text-slate-300 border border-slate-700">
                                        {{ $product->category->name }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 font-bold text-amber-300">
                                    Rs. {{ number_format($product->price, 0) }}
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="font-semibold {{ $product->stock <= 5 ? 'text-amber-400' : 'text-emerald-400' }}">
                                        {{ $product->stock }} units
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-right">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 text-slate-400 hover:text-amber-400 transition">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-slate-500">No products added yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Low Stock Alerts (4 cols) -->
        <div class="lg:col-span-4 p-6 rounded-3xl bg-slate-900/90 border border-slate-800">
            <div class="flex items-center gap-2 mb-5">
                <i class="fa-solid fa-triangle-exclamation text-amber-400 text-base"></i>
                <h3 class="font-serif font-bold text-lg text-slate-100">Low Stock Warnings</h3>
            </div>

            <div class="space-y-3">
                @forelse($lowStockProducts as $lowItem)
                    <div class="p-3.5 rounded-xl bg-amber-950/20 border border-amber-500/20 flex items-center justify-between">
                        <div class="flex-1 min-w-0 pr-3">
                            <p class="font-bold text-slate-200 text-xs truncate">{{ $lowItem->name }}</p>
                            <p class="text-[11px] text-amber-400/80 mt-0.5">Only {{ $lowItem->stock }} items remaining!</p>
                        </div>
                        <a href="{{ route('admin.products.edit', $lowItem->id) }}" 
                            class="px-2.5 py-1 text-xs font-bold rounded-lg bg-amber-500 text-slate-950 hover:bg-amber-400 transition">
                            Restock
                        </a>
                    </div>
                @empty
                    <div class="text-center py-10 text-slate-500">
                        <i class="fa-solid fa-circle-check text-2xl text-emerald-500/60 mb-2"></i>
                        <p class="text-xs">All inventory items are well-stocked!</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
