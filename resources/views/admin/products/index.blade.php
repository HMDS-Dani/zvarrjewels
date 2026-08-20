@extends('admin.layout')

@section('title', 'Jewellery Inventory')
@section('header_title', 'Jewellery Inventory')

@section('content')
<div class="space-y-4 sm:space-y-6">

    <!-- TOP CONTROLS & FILTER BAR (Fully Responsive Mobile & Desktop) -->
    <div class="p-4 sm:p-6 rounded-2xl sm:rounded-3xl bg-slate-900 border border-slate-800 space-y-3">
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">
            
            <!-- Search Input -->
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Search name, gold, diamond..." 
                    class="w-full pl-9 pr-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs text-slate-100 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>

            <div class="flex items-center gap-2">
                <!-- Category Select -->
                <select name="category_id" class="flex-1 sm:flex-none py-2.5 px-3 bg-slate-800 border border-slate-700 rounded-xl text-xs text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Filter Submit -->
                <button type="submit" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-bold rounded-xl transition border border-slate-600">
                    Filter
                </button>

                @if(request()->hasAny(['search', 'category_id']))
                    <a href="{{ route('admin.products.index') }}" class="text-xs text-slate-400 hover:text-rose-400 underline px-1">
                        Clear
                    </a>
                @endif
            </div>
        </form>

        <div class="flex items-center justify-between pt-2 border-t border-slate-800/80">
            <span class="text-xs text-slate-400 font-light">
                Total: <span class="font-bold text-slate-200">{{ $products->total() }}</span> pieces
            </span>
            <a href="{{ route('admin.products.create') }}" 
                class="px-4 py-2 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 text-slate-950 font-bold text-xs shadow-md shadow-amber-500/20 transition flex items-center gap-1.5">
                <i class="fa-solid fa-plus text-[10px]"></i>
                <span>Add Jewellery</span>
            </a>
        </div>
    </div>

    <!-- 1. MOBILE VIP INVENTORY CARDS (Visible only on mobile screens) -->
    <div class="block md:hidden space-y-3">
        @forelse($products as $product)
            <div class="p-4 rounded-2xl bg-slate-900 border border-slate-800 shadow-xl space-y-3 relative">
                <div class="flex items-start gap-3">
                    
                    <!-- Thumbnail -->
                    <div class="w-16 h-16 rounded-xl bg-[#141218] border border-white/10 flex items-center justify-center p-1.5 flex-shrink-0 relative overflow-hidden">
                        <div class="absolute w-10 h-10 bg-amber-500/15 rounded-full blur-lg pointer-events-none"></div>
                        @if($product->image)
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain relative z-10 drop-shadow-md">
                        @else
                            <i class="fa-solid fa-gem text-slate-600 text-xl"></i>
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-1 mb-1">
                            <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-wider bg-slate-800 text-amber-300 border border-slate-700">
                                {{ $product->category->name }}
                            </span>

                            @if($product->stock > 5)
                                <span class="text-[10px] font-semibold text-emerald-400 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> {{ $product->stock }} left
                                </span>
                            @elseif($product->stock > 0)
                                <span class="text-[10px] font-semibold text-amber-400 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400 animate-pulse"></span> {{ $product->stock }} left
                                </span>
                            @else
                                <span class="text-[10px] font-semibold text-rose-400">Out of stock</span>
                            @endif
                        </div>

                        <h4 class="font-serif-luxury font-normal text-base text-slate-100 truncate">
                            {{ $product->name }}
                        </h4>
                        <p class="text-[10.5px] text-slate-400 font-light truncate">{{ $product->material }}</p>
                    </div>

                </div>

                <!-- Price & Mobile Action Buttons -->
                <div class="pt-2.5 border-t border-slate-800 flex items-center justify-between">
                    <div>
                        <span class="text-sm font-extrabold text-amber-300 font-cinzel">
                            Rs. {{ number_format($product->price, 0) }}
                        </span>
                        @if($product->discount_price)
                            <span class="text-[10px] text-slate-500 line-through ml-1">
                                Rs. {{ number_format($product->discount_price, 0) }}
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('shop.product', $product->slug) }}" target="_blank"
                            title="View on Live Storefront"
                            class="px-2.5 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold flex items-center gap-1 border border-slate-700">
                            <i class="fa-solid fa-eye text-[10px]"></i>
                            <span>View</span>
                        </a>

                        <a href="{{ route('admin.products.edit', $product->id) }}" 
                            title="Edit Jewellery"
                            class="px-3 py-1.5 rounded-xl bg-amber-500/10 hover:bg-amber-500/20 text-amber-300 text-xs font-bold flex items-center gap-1 border border-amber-500/30">
                            <i class="fa-solid fa-pen-to-square text-[10px]"></i>
                            <span>Edit</span>
                        </a>

                        <button type="button" 
                            onclick="triggerDeleteModal('{{ route('admin.products.destroy', $product->id) }}', '{{ addslashes($product->name) }}')"
                            title="Delete Jewellery"
                            class="w-8 h-8 rounded-xl bg-rose-950/30 hover:bg-rose-950/60 text-rose-400 border border-rose-500/30 flex items-center justify-center text-xs">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-8 text-center bg-slate-900 rounded-2xl border border-slate-800 text-slate-500">
                <i class="fa-solid fa-gem text-3xl mb-2 text-slate-600"></i>
                <p class="text-xs">No jewellery products found.</p>
            </div>
        @endforelse
    </div>

    <!-- 2. DESKTOP FULL TABLE (Visible on tablets and desktop) -->
    <div class="hidden md:block p-6 rounded-3xl bg-slate-900 border border-slate-800">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="text-xs uppercase bg-slate-800/60 text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="py-3.5 px-4 rounded-l-xl">Jewellery Item</th>
                        <th class="py-3.5 px-4">Category</th>
                        <th class="py-3.5 px-4">Material / Purity</th>
                        <th class="py-3.5 px-4">Price</th>
                        <th class="py-3.5 px-4">Stock</th>
                        <th class="py-3.5 px-4">Featured</th>
                        <th class="py-3.5 px-4 rounded-r-xl text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse($products as $product)
                        <tr class="hover:bg-slate-800/30 transition">
                            <!-- Image + Name -->
                            <td class="py-4 px-4 flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-[#141218] border border-white/10 flex items-center justify-center p-1 flex-shrink-0 relative overflow-hidden">
                                    @if($product->image)
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain">
                                    @else
                                        <i class="fa-solid fa-gem text-slate-500 text-xs"></i>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-bold text-slate-100 text-sm leading-snug">{{ $product->name }}</p>
                                    <p class="text-[11px] text-slate-400 font-mono">slug: {{ $product->slug }}</p>
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="py-4 px-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-800 text-amber-300 border border-slate-700">
                                    {{ $product->category->name }}
                                </span>
                            </td>

                            <!-- Material -->
                            <td class="py-4 px-4 text-xs font-medium text-slate-300">
                                {{ $product->material }}
                            </td>

                            <!-- Price -->
                            <td class="py-4 px-4">
                                <div class="font-bold text-amber-300 font-cinzel">
                                    Rs. {{ number_format($product->price, 0) }}
                                </div>
                                @if($product->discount_price)
                                    <div class="text-[11px] text-slate-400 line-through">
                                        Rs. {{ number_format($product->discount_price, 0) }}
                                    </div>
                                @endif
                            </td>

                            <!-- Stock Badge -->
                            <td class="py-4 px-4">
                                @if($product->stock > 5)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-950/60 text-emerald-400 border border-emerald-500/30">
                                        {{ $product->stock }} in stock
                                    </span>
                                @elseif($product->stock > 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-950/60 text-amber-400 border border-amber-500/30">
                                        Low: {{ $product->stock }} left
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-950/60 text-rose-400 border border-rose-500/30">
                                        Out of stock
                                    </span>
                                @endif
                            </td>

                            <!-- Featured -->
                            <td class="py-4 px-4">
                                @if($product->is_featured)
                                    <span class="text-amber-400 text-base" title="Featured on Homepage">
                                        <i class="fa-solid fa-star"></i>
                                    </span>
                                @else
                                    <span class="text-slate-600 text-sm">
                                        <i class="fa-regular fa-star"></i>
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('shop.product', $product->slug) }}" target="_blank"
                                        title="View Live"
                                        class="p-2 text-slate-400 hover:text-emerald-400 hover:bg-slate-800 rounded-lg transition">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                    </a>

                                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                                        title="Edit Product"
                                        class="p-2 text-slate-400 hover:text-amber-400 hover:bg-slate-800 rounded-lg transition">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <button type="button" 
                                        onclick="triggerDeleteModal('{{ route('admin.products.destroy', $product->id) }}', '{{ addslashes($product->name) }}')"
                                        title="Delete Product"
                                        class="p-2 text-slate-400 hover:text-rose-400 hover:bg-rose-950/40 rounded-lg transition">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-12 text-slate-500">
                                <i class="fa-solid fa-gem text-3xl mb-2 text-slate-600"></i>
                                <p class="text-sm">No jewellery products found.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4 sm:mt-6">
        {{ $products->links() }}
    </div>

</div>
@endsection
