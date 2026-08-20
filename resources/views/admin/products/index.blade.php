@extends('admin.layout')

@section('title', 'Products')
@section('header_title', 'Products')

@section('content')
<div class="space-y-6">

    <!-- TOP FILTER BAR -->
    <div class="glass-card-luxury p-4 sm:p-6 rounded-3xl space-y-4">
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            
            <!-- Search Input -->
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-stone-400">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Search product name, gold karat, diamond, material..." 
                    class="w-full pl-10 pr-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs text-white placeholder-stone-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
            </div>

            <div class="flex items-center gap-2.5">
                <!-- Category Select -->
                <select name="category_id" class="flex-1 sm:flex-none py-3 px-4 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs text-stone-200 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    <option value="" class="bg-[#0d0d14] text-stone-300">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" class="bg-[#0d0d14] text-stone-200" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Filter Submit -->
                <button type="submit" class="px-5 py-3 bg-white/5 hover:bg-white/10 text-stone-200 text-xs font-bold rounded-2xl transition border border-white/10 flex items-center gap-2">
                    <i class="fa-solid fa-sliders text-amber-400 text-xs"></i>
                    <span>Filter</span>
                </button>

                @if(request()->hasAny(['search', 'category_id']))
                    <a href="{{ route('admin.products.index') }}" class="text-xs text-stone-400 hover:text-rose-400 underline px-2">
                        Clear
                    </a>
                @endif
            </div>
        </form>

        <div class="flex items-center justify-between pt-3 border-t border-white/5">
            <span class="text-xs text-stone-400">
                Total Products: <span class="font-bold text-amber-300">{{ $products->total() }}</span> items
            </span>
            <a href="{{ route('admin.products.create') }}" 
                class="px-4 sm:px-5 py-2.5 rounded-2xl bg-gradient-to-r from-amber-300 via-amber-400 to-amber-500 hover:from-amber-200 hover:to-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider shadow-lg shadow-amber-500/20 transition transform hover:-translate-y-0.5 active:scale-95 flex items-center gap-2">
                <i class="fa-solid fa-plus text-[11px]"></i>
                <span>Add Product</span>
            </a>
        </div>
    </div>

    <!-- 1. MOBILE VIP INVENTORY CARDS (MOBILE FIRST) -->
    <div class="block md:hidden space-y-3.5">
        @forelse($products as $product)
            <div class="glass-card-luxury p-4 rounded-3xl space-y-3.5 relative overflow-hidden">
                <div class="flex items-start gap-3.5">
                    
                    <!-- Fixed Dimensions Thumbnail -->
                    <div class="w-16 h-16 min-w-[64px] min-h-[64px] max-w-[64px] max-h-[64px] rounded-2xl bg-[#0e0e14] border border-amber-400/20 flex items-center justify-center p-1 flex-shrink-0 relative overflow-hidden shadow-md">
                        @if($product->image)
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=600';"
                                class="w-full h-full object-cover rounded-xl">
                        @else
                            <i class="fa-solid fa-gem text-stone-500 text-xl"></i>
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-1 mb-1">
                            <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-wider bg-amber-400/10 text-amber-300 border border-amber-400/30">
                                {{ $product->category->name }}
                            </span>

                            @if($product->stock > 5)
                                <span class="text-[10px] font-bold text-emerald-400 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> {{ $product->stock }} left
                                </span>
                            @elseif($product->stock > 0)
                                <span class="text-[10px] font-bold text-amber-400 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span> {{ $product->stock }} left
                                </span>
                            @else
                                <span class="text-[10px] font-bold text-rose-400">Out of stock</span>
                            @endif
                        </div>

                        <h4 class="font-serif-luxury font-normal text-base text-white truncate">
                            {{ $product->name }}
                        </h4>
                        <p class="text-[10.5px] text-stone-400 font-light truncate">{{ $product->material ?? 'Fine Gold' }}</p>
                    </div>

                </div>

                <!-- Price & Mobile Action Buttons -->
                <div class="pt-3 border-t border-white/5 flex items-center justify-between">
                    <div>
                        <span class="text-sm font-extrabold text-amber-300 font-cinzel">
                            Rs. {{ number_format($product->price, 0) }}
                        </span>
                        @if($product->discount_price)
                            <span class="text-[10px] text-stone-500 line-through ml-1.5">
                                Rs. {{ number_format($product->discount_price, 0) }}
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('shop.product', $product->slug) }}" target="_blank"
                            title="Preview on Live Boutique"
                            class="p-2 rounded-xl bg-white/5 hover:bg-white/10 text-stone-300 text-xs border border-white/10">
                            <i class="fa-solid fa-eye text-[11px]"></i>
                        </a>

                        <a href="{{ route('admin.products.edit', $product->id) }}" 
                            title="Edit Jewellery"
                            class="px-3 py-1.5 rounded-xl bg-amber-400/10 hover:bg-amber-400/20 text-amber-300 text-xs font-bold flex items-center gap-1.5 border border-amber-400/30">
                            <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                            <span>Edit</span>
                        </a>

                        <button type="button" 
                            onclick="triggerDeleteModal('{{ route('admin.products.destroy', $product->id) }}', '{{ addslashes($product->name) }}')"
                            title="Delete Jewellery"
                            class="w-8 h-8 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/30 flex items-center justify-center text-xs">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-8 text-center glass-card-luxury rounded-3xl text-stone-500 space-y-2">
                <i class="fa-solid fa-gem text-3xl mb-2 text-stone-600"></i>
                <p class="text-xs">No jewellery products found.</p>
            </div>
        @endforelse
    </div>

    <!-- 2. DESKTOP FULL TABLE (TABLET & DESKTOP) -->
    <div class="hidden md:block glass-card-luxury p-6 rounded-3xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-stone-300">
                <thead class="text-[10px] uppercase tracking-wider bg-white/[0.03] text-stone-400 border-b border-white/5">
                    <tr>
                        <th class="py-4 px-4 rounded-l-2xl">Jewellery Piece</th>
                        <th class="py-4 px-4">Collection</th>
                        <th class="py-4 px-4">Material / Purity</th>
                        <th class="py-4 px-4">Price</th>
                        <th class="py-4 px-4">Inventory</th>
                        <th class="py-4 px-4 text-center">Featured</th>
                        <th class="py-4 px-4 rounded-r-2xl text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($products as $product)
                        <tr class="hover:bg-white/[0.02] transition">
                            <!-- Image + Name -->
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3.5">
                                    <div class="w-12 h-12 min-w-[48px] min-h-[48px] max-w-[48px] max-h-[48px] rounded-xl bg-[#0e0e14] border border-amber-400/20 flex items-center justify-center p-1 flex-shrink-0 relative overflow-hidden shadow-md">
                                        @if($product->image)
                                            <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                                                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=600';"
                                                class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <i class="fa-solid fa-gem text-stone-500 text-sm"></i>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-bold text-white text-sm leading-snug truncate max-w-xs">{{ $product->name }}</p>
                                        <p class="text-[10px] text-stone-400 font-mono">slug: {{ $product->slug }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="py-3 px-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-amber-400/10 text-amber-300 border border-amber-400/30">
                                    {{ $product->category->name }}
                                </span>
                            </td>

                            <!-- Material -->
                            <td class="py-3 px-4 text-xs font-medium text-stone-300">
                                {{ $product->material ?? '24K Gold Plated' }}
                            </td>

                            <!-- Price -->
                            <td class="py-3 px-4">
                                <div class="font-bold text-amber-300 font-cinzel text-sm">
                                    Rs. {{ number_format($product->price, 0) }}
                                </div>
                                @if($product->discount_price)
                                    <div class="text-[10px] text-stone-500 line-through">
                                        Rs. {{ number_format($product->discount_price, 0) }}
                                    </div>
                                @endif
                            </td>

                            <!-- Stock Badge -->
                            <td class="py-3 px-4">
                                @if($product->stock > 5)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">
                                        {{ $product->stock }} in stock
                                    </span>
                                @elseif($product->stock > 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-500/10 text-amber-400 border border-amber-500/30">
                                        Low: {{ $product->stock }} left
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-500/10 text-rose-400 border border-rose-500/30">
                                        Out of stock
                                    </span>
                                @endif
                            </td>

                            <!-- Featured Star -->
                            <td class="py-3 px-4 text-center">
                                @if($product->is_featured)
                                    <span class="text-amber-400 text-sm drop-shadow-md" title="Featured Spotlight">
                                        <i class="fa-solid fa-star"></i>
                                    </span>
                                @else
                                    <span class="text-stone-600 text-xs">
                                        <i class="fa-regular fa-star"></i>
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-3 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('shop.product', $product->slug) }}" target="_blank"
                                        title="View Live Boutique"
                                        class="p-2 text-stone-400 hover:text-amber-300 hover:bg-white/5 rounded-xl transition">
                                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                    </a>

                                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                                        title="Edit Piece"
                                        class="p-2 text-stone-400 hover:text-amber-300 hover:bg-white/5 rounded-xl transition">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>

                                    <button type="button" 
                                        onclick="triggerDeleteModal('{{ route('admin.products.destroy', $product->id) }}', '{{ addslashes($product->name) }}')"
                                        title="Delete Piece"
                                        class="p-2 text-stone-400 hover:text-rose-400 hover:bg-rose-500/10 rounded-xl transition">
                                        <i class="fa-regular fa-trash-can text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-14 text-stone-500">
                                <i class="fa-solid fa-gem text-3xl mb-2 text-stone-600"></i>
                                <p class="text-xs">No jewellery pieces found matching current criteria.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->links() }}
    </div>

</div>
@endsection
