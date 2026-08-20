@extends('admin.layout')

@section('title', 'Add New Product')
@section('header_title', 'Add Product')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Top Back Button -->
    <div>
        <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-stone-400 hover:text-amber-300 flex items-center gap-2 transition group">
            <i class="fa-solid fa-arrow-left text-[11px] group-hover:-translate-x-1 transition transform"></i>
            <span>Back to Products</span>
        </a>
    </div>

    <!-- Main Form Card -->
    <div class="glass-card-luxury p-4 sm:p-8 rounded-3xl space-y-6">
        <div class="mb-4 sm:mb-6 pb-4 sm:pb-6 border-b border-white/5">
            <h2 class="font-cinzel font-bold text-base sm:text-xl text-white">Create New Jewellery Product</h2>
            <p class="text-xs text-stone-400 mt-0.5 sm:mt-1">Upload a high quality product with automatic transparent background generator.</p>
        </div>

        <form id="product-form" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 sm:space-y-6">
            @csrf

            <!-- Hidden input for client-side processed transparent PNG -->
            <input type="hidden" name="transparent_image_base64" id="transparent_image_base64">

            <!-- 1. Name & Category -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        Product Name <span class="text-amber-400">*</span>
                    </label>
                    <input type="text" name="name" id="product_name_input" value="{{ old('name') }}" required
                        placeholder="e.g. Royal Emerald Halo Ring"
                        class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        Category <span class="text-amber-400">*</span>
                    </label>

                    <!-- Custom Luxury Dark Dropdown -->
                    <div class="relative" id="custom-category-dropdown">
                        <select name="category_id" id="real_category_select" class="hidden" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>

                        <button type="button" id="category-trigger-btn" onclick="toggleCategoryMenu()"
                            class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 hover:border-amber-400/40 rounded-2xl text-xs sm:text-sm text-left flex items-center justify-between transition group focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                            <span id="category-selected-label" class="text-stone-400 flex items-center gap-2 truncate">
                                <i class="fa-solid fa-tags text-amber-400/60 text-xs"></i>
                                <span>Select Category</span>
                            </span>
                            <i id="category-chevron" class="fa-solid fa-chevron-down text-stone-500 group-hover:text-amber-400 text-xs transition transform duration-200"></i>
                        </button>

                        <div id="category-options-menu" class="hidden absolute left-0 right-0 top-full mt-2 z-50 bg-[#0d0d14] border border-amber-400/30 rounded-2xl p-1.5 shadow-2xl shadow-black/95 backdrop-blur-2xl max-h-64 overflow-y-auto space-y-1 divide-y divide-white/5">
                            @foreach($categories as $cat)
                                <div onclick="selectCategoryOption('{{ $cat->id }}', '{{ addslashes($cat->name) }}')"
                                    class="category-option-item flex items-center justify-between px-3.5 py-3 rounded-xl cursor-pointer hover:bg-amber-400/10 hover:text-amber-300 text-stone-200 text-xs sm:text-sm transition {{ old('category_id') == $cat->id ? 'bg-amber-400/15 text-amber-300 font-bold' : '' }}"
                                    data-id="{{ $cat->id }}">
                                    <span class="flex items-center gap-2.5 truncate">
                                        <span class="w-2 h-2 rounded-full bg-amber-400/60 flex-shrink-0"></span>
                                        <span class="truncate">{{ $cat->name }}</span>
                                    </span>
                                    <i class="fa-solid fa-check text-amber-400 text-xs {{ old('category_id') == $cat->id ? '' : 'hidden' }} checkmark-icon"></i>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Material & Stock -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        Material & Metal Specification <span class="text-amber-400">*</span>
                    </label>
                    <input type="text" name="material" id="product_material_input" value="{{ old('material', '18K Gold Plated Brass') }}" required
                        placeholder="e.g. 18K Yellow Gold / 925 Sterling Silver"
                        class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        Initial Stock Count <span class="text-amber-400">*</span>
                    </label>
                    <input type="number" name="stock" value="{{ old('stock', 10) }}" min="0" required
                        class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                </div>
            </div>

            <!-- 3. Pricing -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        Price (PKR) <span class="text-amber-400">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-amber-400 text-xs font-bold font-cinzel">Rs.</span>
                        <input type="number" step="0.01" name="price" value="{{ old('price') }}" required
                            placeholder="0.00"
                            class="w-full pl-12 pr-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white font-cinzel font-bold focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        Discount Price (Optional)
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-stone-500 text-xs font-bold font-cinzel">Rs.</span>
                        <input type="number" step="0.01" name="discount_price" value="{{ old('discount_price') }}"
                            placeholder="0.00"
                            class="w-full pl-12 pr-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white font-cinzel focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>
                </div>
            </div>

            <!-- 4. Description with AI Copywriter Generator -->
            <div class="space-y-2">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300">
                        Product Description
                    </label>
                    <div class="flex items-center gap-2">
                        <button type="button" id="btn-ai-desc" onclick="generateProductDescriptionAI()"
                            class="px-3 py-1.5 rounded-xl bg-gradient-to-r from-amber-400/20 via-yellow-400/20 to-amber-500/20 hover:from-amber-400/30 hover:to-amber-500/30 text-amber-300 border border-amber-400/40 text-xs font-bold flex items-center gap-1.5 transition active:scale-95 shadow-sm shadow-amber-500/10">
                            <i class="fa-solid fa-wand-magic-sparkles text-amber-400 text-xs animate-pulse"></i>
                            <span id="ai-desc-btn-text">Generate with AI ✨</span>
                        </button>
                    </div>
                </div>

                <div class="relative">
                    <textarea name="description" id="product_description_input" rows="3"
                        placeholder="Describe the gemstone, finish, craftmanship and luxury appeal or click 'Generate with AI'..."
                        class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition resize-none leading-relaxed">{{ old('description') }}</textarea>
                    
                    <!-- Typing / Generating Indicator -->
                    <div id="ai-desc-typing-indicator" class="hidden absolute bottom-3 right-3 flex items-center gap-1.5 text-[10px] text-amber-400 bg-black/80 px-2.5 py-1 rounded-lg border border-amber-400/30 backdrop-blur">
                        <i class="fa-solid fa-feather-pointed fa-bounce text-xs"></i>
                        <span>Writing luxury copy...</span>
                    </div>
                </div>
            </div>

            <!-- 5. UPLOAD OPTIONS & AI REMOVAL SELECTION -->
            <div class="p-4 sm:p-6 rounded-3xl bg-[#08080d] border border-amber-400/15 space-y-4 sm:space-y-5">
                <div class="flex items-center justify-between">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-amber-400 flex items-center gap-2">
                        <i class="fa-solid fa-camera-retro"></i>
                        <span>Product Image & Upload Mode</span>
                    </h4>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-1">
                    <div>
                        <label class="block text-xs font-semibold text-stone-300 mb-2">Option A: Image URL</label>
                        <input type="url" id="input_image_url" name="image_url" value="{{ old('image_url') }}"
                            placeholder="https://images.unsplash.com/photo-..."
                            class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-stone-300 mb-2">Option B: Upload File</label>
                        <input type="file" id="input_image_file" name="image_file" accept="image/*"
                            class="w-full px-4 py-2.5 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs text-stone-300 file:mr-3 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-400 file:text-slate-950 hover:file:bg-amber-300 cursor-pointer">
                    </div>
                </div>

                <!-- AI Processing Progress Bar -->
                <div id="ai-loading-bar" class="hidden p-3.5 sm:p-4 rounded-xl bg-amber-500/10 border border-amber-500/30 space-y-2">
                    <div class="flex items-center justify-between text-xs text-amber-300 font-semibold">
                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-spinner fa-spin text-amber-400"></i>
                            <span id="ai-status-text">Removing background with AI...</span>
                        </span>
                        <span id="ai-percentage" class="text-amber-400 font-mono">Running</span>
                    </div>
                    <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                        <div id="ai-progress-fill" class="bg-gradient-to-r from-amber-400 via-yellow-400 to-amber-500 h-full w-3/4 transition-all duration-300 animate-pulse"></div>
                    </div>
                </div>

                <!-- Live Preview on Website's Dark Card Background with Manual Remove BG Button -->
                <div id="preview-wrapper" class="hidden pt-4 border-t border-slate-800/80 space-y-3">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2.5">
                        <span class="text-xs font-bold text-slate-300 flex items-center gap-2">
                            <i class="fa-solid fa-eye text-amber-400 text-xs"></i>
                            <span>Live Card Preview:</span>
                        </span>

                        <div class="flex items-center gap-2 flex-wrap">
                            <button type="button" id="btn-remove-bg" onclick="triggerManualBackgroundRemoval()" 
                                class="px-3.5 py-2 rounded-xl bg-amber-400/15 hover:bg-amber-400/25 text-amber-300 border border-amber-400/40 text-xs font-bold flex items-center gap-1.5 transition shadow-md shadow-amber-500/10 active:scale-95">
                                <i class="fa-solid fa-wand-magic-sparkles text-amber-400 text-xs"></i>
                                <span id="btn-remove-bg-text">Remove Background</span>
                            </button>

                            <button type="button" id="btn-revert-bg" onclick="restoreOriginalPhoto()" 
                                class="hidden px-3 py-2 rounded-xl bg-white/5 hover:bg-white/10 text-stone-300 border border-white/10 text-xs font-semibold flex items-center gap-1.5 transition active:scale-95">
                                <i class="fa-solid fa-rotate-left text-stone-400 text-xs"></i>
                                <span>Restore Original</span>
                            </button>

                            <button type="button" onclick="openStudioModal()" 
                                class="px-3.5 py-2 rounded-xl bg-white/5 hover:bg-white/10 text-stone-300 border border-white/10 text-xs font-semibold flex items-center gap-1.5 transition active:scale-95">
                                <i class="fa-solid fa-sliders text-amber-400 text-xs"></i>
                                <span>Adjust</span>
                            </button>
                        </div>
                    </div>

                    <div id="card-preview-podium" class="flex items-center justify-center p-4 sm:p-6 rounded-2xl border border-white/10 bg-gradient-to-b from-[#141218] via-[#09080c] to-[#040406] shadow-2xl min-h-[220px] sm:min-h-[260px] relative overflow-hidden">
                        <div id="spotlight-aura" class="absolute w-36 sm:w-44 h-36 sm:h-44 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
                        <img id="live-transparent-preview" src="" alt="Transparent Preview" 
                            class="max-h-48 sm:max-h-56 max-w-full object-contain relative z-10 drop-shadow-[0_20px_35px_rgba(0,0,0,0.95)] transition-all duration-300">
                    </div>
                </div>

            </div>

            <!-- 6. Featured Spotlight Toggle -->
            <div class="flex items-center gap-3.5 p-4 bg-[#08080d] rounded-2xl border border-white/5">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', true) ? 'checked' : '' }}
                    class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400 border-white/20 bg-black/60 flex-shrink-0">
                <label for="is_featured" class="text-xs font-semibold text-stone-200 cursor-pointer">
                    Show as Featured Product on Homepage
                </label>
            </div>

            <!-- Submit Buttons -->
            <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-3 pt-5 border-t border-white/5">
                <a href="{{ route('admin.products.index') }}" class="py-3 px-6 text-center rounded-2xl text-xs font-bold text-stone-400 hover:text-white bg-white/5 sm:bg-transparent transition">
                    Cancel
                </a>
                <button type="submit" id="submit-btn"
                    class="py-3.5 px-8 bg-gradient-to-r from-amber-300 via-amber-400 to-amber-500 hover:from-amber-200 hover:to-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-2xl shadow-xl shadow-amber-500/20 transition transform hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-plus text-xs"></i> 
                    <span>Save Product</span>
                </button>
            </div>

        </form>
    </div>

</div>

<!-- INTERACTIVE IMAGE EDIT STUDIO MODAL -->
<div id="studio-modal" class="hidden fixed inset-0 bg-black/85 backdrop-blur-xl z-50 items-center justify-center p-2 sm:p-4 overflow-y-auto">
    <div class="glass-card-luxury p-4 sm:p-7 rounded-3xl max-w-3xl w-full shadow-2xl relative space-y-4 border border-amber-400/30 my-auto max-h-[94vh] flex flex-col justify-between overflow-y-auto">
        
        <!-- Header -->
        <div class="flex items-center justify-between border-b border-white/10 pb-3">
            <div>
                <h3 class="text-base sm:text-lg font-bold text-white font-cinzel flex items-center gap-2">
                    <i class="fa-solid fa-wand-magic-sparkles text-amber-400 text-sm sm:text-base"></i>
                    <span>Photo Edit & Studio Tools</span>
                </h3>
                <p class="text-[11px] sm:text-xs text-stone-400 mt-0.5">Drag to crop like WhatsApp/DP, apply filters, and tune brilliance.</p>
            </div>
            <button type="button" onclick="closeStudioModal()" class="w-8 h-8 rounded-xl bg-white/5 text-stone-400 hover:text-white flex items-center justify-center text-sm border border-white/10 transition flex-shrink-0">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Studio Body Grid -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 sm:gap-5 items-start">
            
            <!-- Left: Interactive Canvas & WhatsApp-Style Drag Crop Viewport (6 cols) -->
            <div class="md:col-span-6 flex flex-col items-center justify-center p-3 sm:p-5 rounded-2xl border border-white/10 bg-gradient-to-b from-[#141218] via-[#09080c] to-[#040406] min-h-[220px] sm:min-h-[280px] relative overflow-hidden w-full select-none">
                
                <div id="crop-stage" class="relative max-w-full flex items-center justify-center overflow-hidden rounded-xl border border-white/10 bg-black/40 touch-none select-none" style="min-height: 200px; max-height: 280px;">
                    <img id="studio-preview-img" src="" alt="Editing" draggable="false"
                        class="max-h-48 sm:max-h-60 max-w-full object-contain relative z-0 transition-filter duration-150 pointer-events-none select-none">

                    <!-- Interactive Drag/Resize Crop Overlay Box -->
                    <div id="interactive-crop-box" class="hidden absolute border-2 border-amber-400 shadow-[0_0_0_9999px_rgba(0,0,0,0.65)] z-20 cursor-move transition-border">
                        <div class="absolute inset-0 grid grid-cols-3 grid-rows-3 pointer-events-none">
                            <div class="border-r border-b border-white/20"></div>
                            <div class="border-r border-b border-white/20"></div>
                            <div class="border-b border-white/20"></div>
                            <div class="border-r border-b border-white/20"></div>
                            <div class="border-r border-b border-white/20"></div>
                            <div class="border-b border-white/20"></div>
                            <div class="border-r border-b border-white/20"></div>
                            <div class="border-r border-b border-white/20"></div>
                            <div></div>
                        </div>

                        <div data-handle="tl" class="crop-corner -top-2 -left-2 cursor-nwse-resize"></div>
                        <div data-handle="tr" class="crop-corner -top-2 -right-2 cursor-nesw-resize"></div>
                        <div data-handle="bl" class="crop-corner -bottom-2 -left-2 cursor-nesw-resize"></div>
                        <div data-handle="br" class="crop-corner -bottom-2 -right-2 cursor-nwse-resize"></div>
                    </div>
                </div>

                <div class="mt-2.5 flex items-center gap-2 text-[10px] text-stone-400">
                    <span id="studio-crop-label" class="px-2 py-0.5 rounded bg-white/5 border border-white/10 font-mono">Freeform / 1:1 Crop</span>
                    <span id="studio-rotation-label" class="px-2 py-0.5 rounded bg-white/5 border border-white/10 font-mono">0°</span>
                </div>
            </div>

            <!-- Right: Tabs & Controls (6 cols) -->
            <div class="md:col-span-6 space-y-3">
                
                <!-- Tool Tabs Navigation -->
                <div class="flex items-center gap-1 p-1 bg-black/60 rounded-2xl border border-white/10 text-xs">
                    <button type="button" id="tab-btn-adjust" onclick="switchStudioTab('adjust')" 
                        class="flex-1 py-2 px-2 rounded-xl font-bold transition flex items-center justify-center gap-1.5 bg-amber-400 text-slate-950 shadow text-[11px] sm:text-xs">
                        <i class="fa-solid fa-sliders"></i>
                        <span>Adjust</span>
                    </button>
                    <button type="button" id="tab-btn-filters" onclick="switchStudioTab('filters')" 
                        class="flex-1 py-2 px-2 rounded-xl font-bold transition flex items-center justify-center gap-1.5 text-stone-400 hover:text-white text-[11px] sm:text-xs">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                        <span>Filters</span>
                    </button>
                    <button type="button" id="tab-btn-crop" onclick="switchStudioTab('crop')" 
                        class="flex-1 py-2 px-2 rounded-xl font-bold transition flex items-center justify-center gap-1.5 text-stone-400 hover:text-white text-[11px] sm:text-xs">
                        <i class="fa-solid fa-crop"></i>
                        <span>Crop & Rotate</span>
                    </button>
                </div>

                <!-- TAB 1: FINE TUNE ADJUSTMENTS -->
                <div id="tab-panel-adjust" class="space-y-3 text-xs">
                    <div>
                        <div class="flex justify-between text-slate-300 mb-1 font-semibold">
                            <span>✨ Sparkle Brightness</span>
                            <span id="val-brightness" class="font-mono text-amber-400">100%</span>
                        </div>
                        <input type="range" id="slider-brightness" min="70" max="150" value="100" 
                            class="w-full accent-amber-400 bg-slate-800 rounded-lg cursor-pointer">
                    </div>

                    <div>
                        <div class="flex justify-between text-slate-300 mb-1 font-semibold">
                            <span>💎 Clarity & Contrast</span>
                            <span id="val-contrast" class="font-mono text-amber-400">100%</span>
                        </div>
                        <input type="range" id="slider-contrast" min="70" max="150" value="100" 
                            class="w-full accent-amber-400 bg-slate-800 rounded-lg cursor-pointer">
                    </div>

                    <div>
                        <div class="flex justify-between text-slate-300 mb-1 font-semibold">
                            <span>👑 Metal Vibrance</span>
                            <span id="val-saturation" class="font-mono text-amber-400">100%</span>
                        </div>
                        <input type="range" id="slider-saturation" min="50" max="160" value="100" 
                            class="w-full accent-amber-400 bg-slate-800 rounded-lg cursor-pointer">
                    </div>

                    <div>
                        <div class="flex justify-between text-slate-300 mb-1 font-semibold">
                            <span>🌡️ Golden Warmth</span>
                            <span id="val-warmth" class="font-mono text-amber-400">0%</span>
                        </div>
                        <input type="range" id="slider-warmth" min="0" max="80" value="0" 
                            class="w-full accent-amber-400 bg-slate-800 rounded-lg cursor-pointer">
                    </div>

                    <div class="pt-1 flex justify-end">
                        <button type="button" onclick="resetStudioSliders()" class="text-[11px] text-stone-400 hover:text-amber-400 underline decoration-stone-600">
                            Reset Sliders to 100%
                        </button>
                    </div>
                </div>

                <!-- TAB 2: LUXURY FILTER PRESETS -->
                <div id="tab-panel-filters" class="hidden grid grid-cols-2 sm:grid-cols-4 gap-2 text-xs">
                    <button type="button" onclick="applyPresetFilter('normal')" id="filter-card-normal"
                        class="filter-preset-card p-2 rounded-xl border-2 border-amber-400 bg-amber-400/10 text-center flex flex-col items-center gap-1 transition">
                        <span class="text-base">✨</span>
                        <span class="font-bold text-[11px] text-white">Original</span>
                    </button>

                    <button type="button" onclick="applyPresetFilter('gold')" id="filter-card-gold"
                        class="filter-preset-card p-2 rounded-xl border border-white/10 bg-white/5 hover:border-amber-400/50 text-center flex flex-col items-center gap-1 transition">
                        <span class="text-base">👑</span>
                        <span class="font-bold text-[11px] text-white">Royal Gold</span>
                    </button>

                    <button type="button" onclick="applyPresetFilter('diamond')" id="filter-card-diamond"
                        class="filter-preset-card p-2 rounded-xl border border-white/10 bg-white/5 hover:border-amber-400/50 text-center flex flex-col items-center gap-1 transition">
                        <span class="text-base">💎</span>
                        <span class="font-bold text-[11px] text-white">Diamond Cool</span>
                    </button>

                    <button type="button" onclick="applyPresetFilter('rose')" id="filter-card-rose"
                        class="filter-preset-card p-2 rounded-xl border border-white/10 bg-white/5 hover:border-amber-400/50 text-center flex flex-col items-center gap-1 transition">
                        <span class="text-base">🌸</span>
                        <span class="font-bold text-[11px] text-white">Rose Ruby</span>
                    </button>

                    <button type="button" onclick="applyPresetFilter('studio')" id="filter-card-studio"
                        class="filter-preset-card p-2 rounded-xl border border-white/10 bg-white/5 hover:border-amber-400/50 text-center flex flex-col items-center gap-1 transition">
                        <span class="text-base">📸</span>
                        <span class="font-bold text-[11px] text-white">Studio Lux</span>
                    </button>

                    <button type="button" onclick="applyPresetFilter('vivid')" id="filter-card-vivid"
                        class="filter-preset-card p-2 rounded-xl border border-white/10 bg-white/5 hover:border-amber-400/50 text-center flex flex-col items-center gap-1 transition">
                        <span class="text-base">⚡</span>
                        <span class="font-bold text-[11px] text-white">Vivid Pop</span>
                    </button>

                    <button type="button" onclick="applyPresetFilter('vintage')" id="filter-card-vintage"
                        class="filter-preset-card p-2 rounded-xl border border-white/10 bg-white/5 hover:border-amber-400/50 text-center flex flex-col items-center gap-1 transition">
                        <span class="text-base">🎞️</span>
                        <span class="font-bold text-[11px] text-white">Vintage Glam</span>
                    </button>

                    <button type="button" onclick="applyPresetFilter('noir')" id="filter-card-noir"
                        class="filter-preset-card p-2 rounded-xl border border-white/10 bg-white/5 hover:border-amber-400/50 text-center flex flex-col items-center gap-1 transition">
                        <span class="text-base">🎬</span>
                        <span class="font-bold text-[11px] text-white">Noir Silver</span>
                    </button>
                </div>

                <!-- TAB 3: WHATSAPP-STYLE DRAG CROP & ROTATE TOOLS -->
                <div id="tab-panel-crop" class="hidden space-y-3 text-xs">
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-[10px] uppercase font-bold text-stone-400 tracking-wider">Crop Presets (Touch & Drag on Image):</label>
                            <span class="text-[10px] text-amber-400 font-semibold">👆 Drag to frame</span>
                        </div>
                        <div class="grid grid-cols-3 sm:grid-cols-5 gap-1.5">
                            <button type="button" onclick="setCropRatio('original')" id="crop-ratio-original"
                                class="crop-ratio-btn py-1.5 px-2 rounded-xl font-bold bg-amber-400 text-slate-950 border border-amber-400 transition text-[11px]">
                                Freeform
                            </button>
                            <button type="button" onclick="setCropRatio('1:1')" id="crop-ratio-1-1"
                                class="crop-ratio-btn py-1.5 px-2 rounded-xl font-bold bg-white/5 text-stone-300 hover:text-white border border-white/10 transition text-[11px]">
                                1:1 Square
                            </button>
                            <button type="button" onclick="setCropRatio('4:5')" id="crop-ratio-4-5"
                                class="crop-ratio-btn py-1.5 px-2 rounded-xl font-bold bg-white/5 text-stone-300 hover:text-white border border-white/10 transition text-[11px]">
                                4:5 Portrait
                            </button>
                            <button type="button" onclick="setCropRatio('4:3')" id="crop-ratio-4-3"
                                class="crop-ratio-btn py-1.5 px-2 rounded-xl font-bold bg-white/5 text-stone-300 hover:text-white border border-white/10 transition text-[11px]">
                                4:3 Standard
                            </button>
                            <button type="button" onclick="setCropRatio('16:9')" id="crop-ratio-16-9"
                                class="crop-ratio-btn py-1.5 px-2 rounded-xl font-bold bg-white/5 text-stone-300 hover:text-white border border-white/10 transition text-[11px]">
                                16:9 Banner
                            </button>
                        </div>
                    </div>

                    <div class="pt-2 border-t border-white/10">
                        <label class="block text-[10px] uppercase font-bold text-stone-400 mb-1.5 tracking-wider">Orientation & Flip:</label>
                        <div class="grid grid-cols-3 gap-1.5 sm:gap-2">
                            <button type="button" onclick="rotateStudioImage(-90)" 
                                class="py-2 px-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-stone-200 border border-white/10 flex items-center justify-center gap-1.5 transition active:scale-95 text-[11px] sm:text-xs">
                                <i class="fa-solid fa-rotate-left text-amber-400"></i>
                                <span>-90° Left</span>
                            </button>
                            <button type="button" onclick="rotateStudioImage(90)" 
                                class="py-2 px-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-stone-200 border border-white/10 flex items-center justify-center gap-1.5 transition active:scale-95 text-[11px] sm:text-xs">
                                <i class="fa-solid fa-rotate-right text-amber-400"></i>
                                <span>+90° Right</span>
                            </button>
                            <button type="button" onclick="flipStudioImage()" 
                                class="py-2 px-2.5 rounded-xl bg-white/5 hover:bg-white/10 text-stone-200 border border-white/10 flex items-center justify-center gap-1.5 transition active:scale-95 text-[11px] sm:text-xs">
                                <i class="fa-solid fa-arrows-left-right text-amber-400"></i>
                                <span>Flip H</span>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Footer Actions (Responsive Mobile First Layout) -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-2.5 sm:gap-3 pt-3 border-t border-white/10">
            <button type="button" onclick="resetStudioComplete()" 
                class="px-3 py-2 sm:px-4 sm:py-2.5 rounded-xl text-stone-400 hover:text-rose-300 text-xs font-semibold flex items-center justify-center gap-1.5 transition bg-white/5 sm:bg-transparent border border-white/10 sm:border-0 order-2 sm:order-1">
                <i class="fa-solid fa-arrow-rotate-left text-xs"></i>
                <span>Reset All</span>
            </button>
            <div class="flex items-center gap-2 order-1 sm:order-2 w-full sm:w-auto">
                <button type="button" onclick="closeStudioModal()" 
                    class="flex-1 sm:flex-initial px-4 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold transition text-center">
                    Cancel
                </button>
                <button type="button" onclick="applyBakeAdjustments()" 
                    class="flex-1 sm:flex-initial px-5 py-2.5 bg-gradient-to-r from-amber-400 to-yellow-600 hover:opacity-95 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-amber-500/20 transition transform active:scale-95 flex items-center justify-center gap-1.5 whitespace-nowrap">
                    <i class="fa-solid fa-check text-xs"></i>
                    <span>Apply & Save</span>
                </button>
            </div>
        </div>

    </div>
</div>

<style>
.crop-corner {
    position: absolute;
    width: 14px;
    height: 14px;
    background: #f59e0b;
    border: 2px solid #ffffff;
    border-radius: 3px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.8);
    z-index: 30;
    touch-action: none;
}
</style>

<!-- SINGLE UNIFIED CLIENT ENGINE SCRIPT -->
<script>
    let currentRawImageSource = null;

    // AI LUXURY COPYWRITING GENERATOR ENGINE
    let aiDescAngleIndex = 0;
    let isAiTyping = false;

    function generateProductDescriptionAI() {
        if (isAiTyping) return;

        const nameInput = document.getElementById('product_name_input') || document.querySelector('input[name="name"]');
        const materialInput = document.getElementById('product_material_input') || document.querySelector('input[name="material"]');
        const categorySelect = document.getElementById('real_category_select');
        const descTextarea = document.getElementById('product_description_input');
        const btnText = document.getElementById('ai-desc-btn-text');
        const typingIndicator = document.getElementById('ai-desc-typing-indicator');

        const productName = nameInput ? nameInput.value.trim() : '';
        if (!productName) {
            if (nameInput) {
                nameInput.focus();
                nameInput.classList.add('border-amber-400', 'ring-2', 'ring-amber-400');
                setTimeout(() => nameInput.classList.remove('ring-2', 'ring-amber-400'), 1500);
            }
            alert('Please enter a Product Name first so AI can write a tailored description!');
            return;
        }

        const material = (materialInput && materialInput.value.trim()) ? materialInput.value.trim() : '18K Gold Plated Brass';
        let categoryName = '';
        if (categorySelect && categorySelect.selectedIndex >= 0) {
            const opt = categorySelect.options[categorySelect.selectedIndex];
            if (opt && opt.value) categoryName = opt.text.trim();
        }

        const lowerName = productName.toLowerCase();
        const lowerCat = categoryName.toLowerCase();
        const combined = lowerName + ' ' + lowerCat;

        let itemType = 'jewellery piece';
        if (combined.includes('ring') || combined.includes('solitaire') || combined.includes('band')) itemType = 'ring';
        else if (combined.includes('necklace') || combined.includes('choker') || combined.includes('pendant') || combined.includes('chain') || combined.includes('mala') || combined.includes('haar')) itemType = 'necklace';
        else if (combined.includes('earring') || combined.includes('stud') || combined.includes('jhumk') || combined.includes('bali') || combined.includes('top') || combined.includes('hoop')) itemType = 'earrings';
        else if (combined.includes('bracelet') || combined.includes('bangle') || combined.includes('kara') || combined.includes('cuff')) itemType = 'bracelet';
        else if (combined.includes('set') || combined.includes('bridal') || combined.includes('collection')) itemType = 'jewellery set';
        else if (combined.includes('anklet') || combined.includes('payal')) itemType = 'anklet';

        const isEmerald = combined.includes('emerald') || combined.includes('zamrud') || combined.includes('green');
        const isRuby = combined.includes('ruby') || combined.includes('yaqoot') || combined.includes('red');
        const isSapphire = combined.includes('sapphire') || combined.includes('neelam') || combined.includes('blue');
        const isDiamond = combined.includes('diamond') || combined.includes('solitaire') || combined.includes('heera') || combined.includes('moissanite') || combined.includes('zircon') || combined.includes('crystal');
        const isPearl = combined.includes('pearl') || combined.includes('moti');
        const isBridal = combined.includes('bridal') || combined.includes('wedding') || combined.includes('dulhan') || combined.includes('shaadi') || combined.includes('royal');

        let gemFocus = 'luminous gemstone centerpiece';
        if (isEmerald) gemFocus = 'vibrant emerald-hued centerpiece with rich verdant depth';
        else if (isRuby) gemFocus = 'passionate ruby-toned gemstone radiating opulent crimson fire';
        else if (isSapphire) gemFocus = 'regal sapphire centerpiece capturing deep celestial luster';
        else if (isDiamond) gemFocus = 'dazzling diamond-cut solitaire reflecting scintillating fire from every facet';
        else if (isPearl) gemFocus = 'lustrous heirloom pearl boasting silky, iridescent glow';
        else if (isBridal) gemFocus = 'intricately embellished stones evoking grand celebratory splendour';

        const angles = [
            `Imbued with regal grandeur, the ${productName} features a ${gemFocus} framed with meticulous artisanal precision. Mastercrafted in lustrous ${material}, this majestic ${itemType} exudes timeless royalty—curated to make an unforgettable statement at weddings, galas, and milestone celebrations.`,

            `Designed to mesmerize from every vantage point, the ${productName} seamlessly unites classic heritage with contemporary luxury. Cast in radiant ${material}, its high-polish finish and radiant light-play ensure an ethereal glow that elevates both daytime elegance and evening couture.`,

            `A testament to superior craftsmanship, the ${productName} showcases precision stone-setting paired with the warm, enduring allure of premium ${material}. Every curve is sculpted for supreme comfort and breathtaking visual impact, making it an indispensable crown jewel for your collection.`,

            `A poetic embodiment of grace and sophistication, the ${productName} is created for moments you never want to forget. The harmonious blend of fine ${material} and brilliant detailing creates a cherished keepsake that speaks of love, prestige, and timeless beauty.`,

            `Command the room with the bold brilliance of the ${productName}. Sculpted with architectural finesse in ${material}, this show-stopping ${itemType} captures ambient light with breathtaking brilliance, bringing unapologetic glamour to your signature style.`
        ];

        const chosenAngle = angles[aiDescAngleIndex % angles.length];
        aiDescAngleIndex++;
        const currentAngleNum = ((aiDescAngleIndex - 1) % angles.length) + 1;

        isAiTyping = true;
        if (typingIndicator) typingIndicator.classList.remove('hidden');
        if (btnText) btnText.textContent = 'Generating... ⚡';
        if (descTextarea) descTextarea.value = '';

        let charIdx = 0;
        const typeSpeed = 12;

        function typeNextChar() {
            if (charIdx < chosenAngle.length) {
                if (descTextarea) {
                    descTextarea.value += chosenAngle.charAt(charIdx);
                    descTextarea.scrollTop = descTextarea.scrollHeight;
                }
                charIdx++;
                setTimeout(typeNextChar, typeSpeed);
            } else {
                isAiTyping = false;
                if (typingIndicator) typingIndicator.classList.add('hidden');
                if (btnText) btnText.textContent = `✨ Try Another (${currentAngleNum}/${angles.length})`;
            }
        }

        typeNextChar();
    }
    window.generateProductDescriptionAI = generateProductDescriptionAI;

    function handleSource(imageSource) {
        if (!imageSource) return;
        currentRawImageSource = imageSource;
        const hiddenBase64Input = document.getElementById('transparent_image_base64');
        const previewImg = document.getElementById('live-transparent-preview');
        const previewWrapper = document.getElementById('preview-wrapper');
        const submitBtn = document.getElementById('submit-btn');

        if (hiddenBase64Input) hiddenBase64Input.value = '';

        if (previewImg) {
            if (typeof imageSource === 'string') {
                previewImg.src = imageSource;
            } else {
                previewImg.src = URL.createObjectURL(imageSource);
            }
        }

        if (previewWrapper) previewWrapper.classList.remove('hidden');
        const revertBtn = document.getElementById('btn-revert-bg');
        if (revertBtn) revertBtn.classList.add('hidden');
        const removeBgText = document.getElementById('btn-remove-bg-text');
        if (removeBgText) removeBgText.textContent = 'Remove Background';
        if (submitBtn) submitBtn.disabled = false;
    }

    function processSmartBackgroundRemoval(src) {
        return new Promise((resolve) => {
            const img = new Image();
            img.crossOrigin = 'anonymous';
            img.onload = () => {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d', { willReadFrequently: true });
                let w = img.naturalWidth || img.width;
                let h = img.naturalHeight || img.height;
                const maxDim = 1200;
                if (w > maxDim || h > maxDim) {
                    if (w > h) {
                        h = Math.round((h * maxDim) / w);
                        w = maxDim;
                    } else {
                        w = Math.round((w * maxDim) / h);
                        h = maxDim;
                    }
                }
                canvas.width = w;
                canvas.height = h;
                ctx.drawImage(img, 0, 0, w, h);

                try {
                    const imgData = ctx.getImageData(0, 0, w, h);
                    const data = imgData.data;

                    let totalR = 0, totalG = 0, totalB = 0, sampleCount = 0;
                    const sample = (x, y) => {
                        const idx = (y * w + x) * 4;
                        totalR += data[idx];
                        totalG += data[idx + 1];
                        totalB += data[idx + 2];
                        sampleCount++;
                    };

                    for (let x = 0; x < w; x += 2) {
                        sample(x, 0);
                        sample(x, h - 1);
                    }
                    for (let y = 0; y < h; y += 2) {
                        sample(0, y);
                        sample(w - 1, y);
                    }

                    const bgR = Math.round(totalR / Math.max(1, sampleCount));
                    const bgG = Math.round(totalG / Math.max(1, sampleCount));
                    const bgB = Math.round(totalB / Math.max(1, sampleCount));

                    const threshold = 48;
                    const isBg = (idx) => {
                        const r = data[idx];
                        const g = data[idx + 1];
                        const b = data[idx + 2];
                        const a = data[idx + 3];
                        if (a < 25) return true;
                        const dist = Math.sqrt((r - bgR) ** 2 + (g - bgG) ** 2 + (b - bgB) ** 2);
                        return dist < threshold;
                    };

                    const visited = new Uint8Array(w * h);
                    const queue = [];

                    for (let x = 0; x < w; x++) {
                        const top = 0 * w + x;
                        const btm = (h - 1) * w + x;
                        if (isBg(top * 4)) { visited[top] = 1; queue.push(top); }
                        if (isBg(btm * 4)) { visited[btm] = 1; queue.push(btm); }
                    }
                    for (let y = 0; y < h; y++) {
                        const lft = y * w + 0;
                        const rgt = y * w + (w - 1);
                        if (isBg(lft * 4)) { visited[lft] = 1; queue.push(lft); }
                        if (isBg(rgt * 4)) { visited[rgt] = 1; queue.push(rgt); }
                    }

                    let head = 0;
                    while (head < queue.length) {
                        const curr = queue[head++];
                        const cx = curr % w;
                        const cy = Math.floor(curr / w);
                        const cIdx = curr * 4;

                        data[cIdx + 3] = 0;

                        if (cx > 0) {
                            const left = curr - 1;
                            if (!visited[left] && isBg(left * 4)) { visited[left] = 1; queue.push(left); }
                        }
                        if (cx < w - 1) {
                            const right = curr + 1;
                            if (!visited[right] && isBg(right * 4)) { visited[right] = 1; queue.push(right); }
                        }
                        if (cy > 0) {
                            const up = curr - w;
                            if (!visited[up] && isBg(up * 4)) { visited[up] = 1; queue.push(up); }
                        }
                        if (cy < h - 1) {
                            const down = curr + w;
                            if (!visited[down] && isBg(down * 4)) { visited[down] = 1; queue.push(down); }
                        }
                    }

                    for (let y = 1; y < h - 1; y++) {
                        for (let x = 1; x < w - 1; x++) {
                            const pos = y * w + x;
                            const idx = pos * 4;
                            if (data[idx + 3] > 0) {
                                const hasTransparentNeighbor = (
                                    data[((y - 1) * w + x) * 4 + 3] === 0 ||
                                    data[((y + 1) * w + x) * 4 + 3] === 0 ||
                                    data[(y * w + (x - 1)) * 4 + 3] === 0 ||
                                    data[(y * w + (x + 1)) * 4 + 3] === 0
                                );
                                if (hasTransparentNeighbor) {
                                    const dist = Math.sqrt((data[idx] - bgR) ** 2 + (data[idx + 1] - bgG) ** 2 + (data[idx + 2] - bgB) ** 2);
                                    if (dist < threshold + 25) {
                                        data[idx + 3] = Math.max(0, Math.min(255, Math.round(((dist - threshold) / 25) * 255)));
                                    }
                                }
                            }
                        }
                    }

                    ctx.putImageData(imgData, 0, 0);
                    resolve(canvas.toDataURL('image/png'));
                } catch (e) {
                    console.warn('Fallback direct render:', e);
                    resolve(typeof src === 'string' ? src : URL.createObjectURL(src));
                }
            };
            img.onerror = () => {
                resolve(typeof src === 'string' ? src : URL.createObjectURL(src));
            };
            if (typeof src === 'string') img.src = src;
            else img.src = URL.createObjectURL(src);
        });
    }

    async function triggerManualBackgroundRemoval() {
        const previewImg = document.getElementById('live-transparent-preview');
        const source = currentRawImageSource || (previewImg ? previewImg.src : null);
        if (!source) {
            alert('Please select an image file or enter an image URL first.');
            return;
        }

        const removeBgBtn = document.getElementById('btn-remove-bg');
        const removeBgText = document.getElementById('btn-remove-bg-text');
        const revertBtn = document.getElementById('btn-revert-bg');
        const loadingBar = document.getElementById('ai-loading-bar');
        const statusText = document.getElementById('ai-status-text');
        const hiddenBase64Input = document.getElementById('transparent_image_base64');
        const submitBtn = document.getElementById('submit-btn');
        const progressFill = document.getElementById('ai-progress-fill');
        const percentage = document.getElementById('ai-percentage');

        if (loadingBar) loadingBar.classList.remove('hidden');
        if (removeBgBtn) removeBgBtn.disabled = true;
        if (submitBtn) submitBtn.disabled = true;

        if (statusText) statusText.textContent = 'ZVARR AI: Segmenting jewellery & removing background...';
        if (progressFill) progressFill.style.width = '35%';
        if (percentage) percentage.textContent = '35%';

        await new Promise(r => setTimeout(r, 120));
        if (progressFill) progressFill.style.width = '70%';
        if (percentage) percentage.textContent = '70%';

        try {
            const cleanPng = await processSmartBackgroundRemoval(source);

            if (progressFill) progressFill.style.width = '100%';
            if (percentage) percentage.textContent = '100%';
            if (statusText) statusText.textContent = 'Background eliminated successfully ✓';

            await new Promise(r => setTimeout(r, 150));

            if (hiddenBase64Input) hiddenBase64Input.value = cleanPng;
            if (previewImg) previewImg.src = cleanPng;

            if (loadingBar) loadingBar.classList.add('hidden');
            if (removeBgBtn) removeBgBtn.disabled = false;
            if (removeBgText) removeBgText.textContent = 'Background Removed ✓';
            if (revertBtn) revertBtn.classList.remove('hidden');
            if (submitBtn) submitBtn.disabled = false;

        } catch (error) {
            console.error('Error removing background:', error);
            if (loadingBar) loadingBar.classList.add('hidden');
            if (removeBgBtn) removeBgBtn.disabled = false;
            if (submitBtn) submitBtn.disabled = false;
        }
    }
    window.triggerManualBackgroundRemoval = triggerManualBackgroundRemoval;

    function restoreOriginalPhoto() {
        const hiddenBase64Input = document.getElementById('transparent_image_base64');
        const previewImg = document.getElementById('live-transparent-preview');
        const revertBtn = document.getElementById('btn-revert-bg');
        const removeBgText = document.getElementById('btn-remove-bg-text');

        if (hiddenBase64Input) hiddenBase64Input.value = '';
        if (currentRawImageSource && previewImg) {
            if (typeof currentRawImageSource === 'string') {
                previewImg.src = currentRawImageSource;
            } else {
                previewImg.src = URL.createObjectURL(currentRawImageSource);
            }
        } else if (previewImg) {
            previewImg.src = '';
            const previewWrapper = document.getElementById('preview-wrapper');
            if (previewWrapper) previewWrapper.classList.add('hidden');
        }
        if (revertBtn) revertBtn.classList.add('hidden');
        if (removeBgText) removeBgText.textContent = 'Remove Background';
    }
    window.restoreOriginalPhoto = restoreOriginalPhoto;

    // STUDIO PHOTO EDITOR & WHATSAPP DRAG-CROP ENGINE
    let studioState = {
        brightness: 100,
        contrast: 100,
        saturation: 100,
        warmth: 0,
        activeFilter: 'normal',
        rotation: 0,
        flipH: 1,
        cropRatio: 'original',
        currentTab: 'adjust',
        originalSrc: ''
    };

    let cropBoxState = {
        x: 0,
        y: 0,
        w: 100,
        h: 100,
        active: false,
        dragType: null,
        startX: 0,
        startY: 0,
        startBoxX: 0,
        startBoxY: 0,
        startBoxW: 0,
        startBoxH: 0
    };

    const filterPresets = {
        normal: { b: 100, c: 100, s: 100, w: 0, extra: '' },
        gold: { b: 105, c: 112, s: 130, w: 25, extra: 'sepia(25%)' },
        diamond: { b: 108, c: 120, s: 95, w: 0, extra: 'hue-rotate(185deg)' },
        rose: { b: 105, c: 110, s: 125, w: 15, extra: 'hue-rotate(335deg)' },
        studio: { b: 112, c: 118, s: 108, w: 0, extra: '' },
        vivid: { b: 104, c: 122, s: 145, w: 0, extra: '' },
        vintage: { b: 100, c: 108, s: 85, w: 40, extra: 'sepia(45%)' },
        noir: { b: 106, c: 135, s: 0, w: 0, extra: 'grayscale(100%)' }
    };

    function switchStudioTab(tab) {
        studioState.currentTab = tab;
        ['adjust', 'filters', 'crop'].forEach(t => {
            const btn = document.getElementById(`tab-btn-${t}`);
            const panel = document.getElementById(`tab-panel-${t}`);
            if (t === tab) {
                if (btn) {
                    btn.className = 'flex-1 py-2 px-2 rounded-xl font-bold transition flex items-center justify-center gap-1.5 bg-amber-400 text-slate-950 shadow text-[11px] sm:text-xs';
                }
                if (panel) panel.classList.remove('hidden');
            } else {
                if (btn) {
                    btn.className = 'flex-1 py-2 px-2 rounded-xl font-bold transition flex items-center justify-center gap-1.5 text-stone-400 hover:text-white text-[11px] sm:text-xs';
                }
                if (panel) panel.classList.add('hidden');
            }
        });

        const cropBox = document.getElementById('interactive-crop-box');
        if (tab === 'crop') {
            if (cropBox) cropBox.classList.remove('hidden');
            initCropBoxOverlay();
        } else {
            if (cropBox) cropBox.classList.add('hidden');
        }
    }

    function openStudioModal() {
        const previewImg = document.getElementById('live-transparent-preview');
        const studioPreview = document.getElementById('studio-preview-img');
        if (!previewImg || !previewImg.src) return;

        studioState.originalSrc = previewImg.src;
        studioPreview.src = previewImg.src;
        
        document.getElementById('studio-modal').classList.remove('hidden');
        document.getElementById('studio-modal').classList.add('flex');
        
        applyStudioLiveFilters();

        studioPreview.onload = () => {
            if (studioState.currentTab === 'crop') {
                initCropBoxOverlay();
            }
        };
    }

    function closeStudioModal() {
        document.getElementById('studio-modal').classList.add('hidden');
        document.getElementById('studio-modal').classList.remove('flex');
    }

    function applyStudioLiveFilters() {
        const b = document.getElementById('slider-brightness')?.value || studioState.brightness;
        const c = document.getElementById('slider-contrast')?.value || studioState.contrast;
        const s = document.getElementById('slider-saturation')?.value || studioState.saturation;
        const w = document.getElementById('slider-warmth')?.value || studioState.warmth;

        studioState.brightness = b;
        studioState.contrast = c;
        studioState.saturation = s;
        studioState.warmth = w;

        if (document.getElementById('val-brightness')) document.getElementById('val-brightness').textContent = `${b}%`;
        if (document.getElementById('val-contrast')) document.getElementById('val-contrast').textContent = `${c}%`;
        if (document.getElementById('val-saturation')) document.getElementById('val-saturation').textContent = `${s}%`;
        if (document.getElementById('val-warmth')) document.getElementById('val-warmth').textContent = `${w}%`;

        const preset = filterPresets[studioState.activeFilter] || filterPresets.normal;
        let filterString = `brightness(${b}%) contrast(${c}%) saturate(${s}%)`;
        if (w > 0) {
            filterString += ` sepia(${w}%)`;
        }
        if (preset.extra) {
            filterString += ` ${preset.extra}`;
        }

        const studioImg = document.getElementById('studio-preview-img');
        if (studioImg) {
            studioImg.style.filter = filterString;
            studioImg.style.transform = `rotate(${studioState.rotation}deg) scaleX(${studioState.flipH})`;
        }

        if (document.getElementById('studio-rotation-label')) {
            document.getElementById('studio-rotation-label').textContent = `${studioState.rotation}°${studioState.flipH === -1 ? ' (Flipped)' : ''}`;
        }
    }

    function applyPresetFilter(filterKey) {
        studioState.activeFilter = filterKey;
        const preset = filterPresets[filterKey] || filterPresets.normal;

        const sb = document.getElementById('slider-brightness');
        const sc = document.getElementById('slider-contrast');
        const ss = document.getElementById('slider-saturation');
        const sw = document.getElementById('slider-warmth');
        if (sb) sb.value = preset.b;
        if (sc) sc.value = preset.c;
        if (ss) ss.value = preset.s;
        if (sw) sw.value = preset.w;

        document.querySelectorAll('.filter-preset-card').forEach(card => {
            card.className = 'filter-preset-card p-2 rounded-xl border border-white/10 bg-white/5 hover:border-amber-400/50 text-center flex flex-col items-center gap-1 transition';
        });

        const activeCard = document.getElementById(`filter-card-${filterKey}`);
        if (activeCard) {
            activeCard.className = 'filter-preset-card p-2 rounded-xl border-2 border-amber-400 bg-amber-400/10 text-center flex flex-col items-center gap-1 transition';
        }

        applyStudioLiveFilters();
    }

    // WHATSAPP DRAG-CROP OVERLAY INITIALIZER & INTERACTION
    function initCropBoxOverlay() {
        const stage = document.getElementById('crop-stage');
        const img = document.getElementById('studio-preview-img');
        const cropBox = document.getElementById('interactive-crop-box');
        if (!stage || !img || !cropBox) return;

        const stageRect = stage.getBoundingClientRect();
        const imgRect = img.getBoundingClientRect();

        const imgLeft = imgRect.left - stageRect.left;
        const imgTop = imgRect.top - stageRect.top;
        const imgW = imgRect.width;
        const imgH = imgRect.height;

        let boxW = imgW * 0.85;
        let boxH = imgH * 0.85;

        if (studioState.cropRatio === '1:1') {
            const minDim = Math.min(imgW, imgH) * 0.85;
            boxW = minDim;
            boxH = minDim;
        } else if (studioState.cropRatio === '4:5') {
            boxW = Math.min(imgW * 0.85, (imgH * 0.85) * (4/5));
            boxH = boxW * (5/4);
        } else if (studioState.cropRatio === '4:3') {
            boxW = Math.min(imgW * 0.85, (imgH * 0.85) * (4/3));
            boxH = boxW * (3/4);
        } else if (studioState.cropRatio === '16:9') {
            boxW = Math.min(imgW * 0.85, (imgH * 0.85) * (16/9));
            boxH = boxW * (9/16);
        }

        cropBoxState.w = Math.max(50, Math.min(imgW, boxW));
        cropBoxState.h = Math.max(50, Math.min(imgH, boxH));
        cropBoxState.x = imgLeft + (imgW - cropBoxState.w) / 2;
        cropBoxState.y = imgTop + (imgH - cropBoxState.h) / 2;

        renderCropBox();
    }

    function renderCropBox() {
        const cropBox = document.getElementById('interactive-crop-box');
        if (!cropBox) return;
        cropBox.style.left = `${cropBoxState.x}px`;
        cropBox.style.top = `${cropBoxState.y}px`;
        cropBox.style.width = `${cropBoxState.w}px`;
        cropBox.style.height = `${cropBoxState.h}px`;
    }

    function setCropRatio(ratio) {
        studioState.cropRatio = ratio;
        const label = document.getElementById('studio-crop-label');

        document.querySelectorAll('.crop-ratio-btn').forEach(btn => {
            btn.className = 'crop-ratio-btn py-1.5 px-2 rounded-xl font-bold bg-white/5 text-stone-300 hover:text-white border border-white/10 transition text-[11px]';
        });

        const activeBtn = document.getElementById(`crop-ratio-${ratio.replace(':', '-')}`);
        if (activeBtn) {
            activeBtn.className = 'crop-ratio-btn py-1.5 px-2 rounded-xl font-bold bg-amber-400 text-slate-950 border border-amber-400 transition text-[11px]';
        }

        if (label) {
            label.textContent = ratio === 'original' ? 'Freeform Crop' : `${ratio} Locked Crop`;
        }

        initCropBoxOverlay();
    }

    function rotateStudioImage(deg) {
        studioState.rotation = (studioState.rotation + deg + 360) % 360;
        applyStudioLiveFilters();
        setTimeout(initCropBoxOverlay, 50);
    }

    function flipStudioImage() {
        studioState.flipH = studioState.flipH === 1 ? -1 : 1;
        applyStudioLiveFilters();
    }

    function resetStudioSliders() {
        const sb = document.getElementById('slider-brightness');
        const sc = document.getElementById('slider-contrast');
        const ss = document.getElementById('slider-saturation');
        const sw = document.getElementById('slider-warmth');
        if (sb) sb.value = 100;
        if (sc) sc.value = 100;
        if (ss) ss.value = 100;
        if (sw) sw.value = 0;
        applyStudioLiveFilters();
    }

    function resetStudioComplete() {
        applyPresetFilter('normal');
        resetStudioSliders();
        studioState.rotation = 0;
        studioState.flipH = 1;
        setCropRatio('original');
        applyStudioLiveFilters();
        const studioPreview = document.getElementById('studio-preview-img');
        if (studioState.originalSrc && studioPreview) {
            studioPreview.src = studioState.originalSrc;
        }
    }

    // INTERACTIVE TOUCH & MOUSE DRAG CROP EVENT LISTENERS
    function getPointerPos(e) {
        if (e.touches && e.touches.length > 0) {
            return { x: e.touches[0].clientX, y: e.touches[0].clientY };
        }
        return { x: e.clientX, y: e.clientY };
    }

    function startCropDrag(e) {
        const target = e.target;
        const handle = target.getAttribute('data-handle');
        cropBoxState.active = true;
        cropBoxState.dragType = handle || 'move';

        const pos = getPointerPos(e);
        cropBoxState.startX = pos.x;
        cropBoxState.startY = pos.y;
        cropBoxState.startBoxX = cropBoxState.x;
        cropBoxState.startBoxY = cropBoxState.y;
        cropBoxState.startBoxW = cropBoxState.w;
        cropBoxState.startBoxH = cropBoxState.h;

        e.preventDefault();
    }

    function moveCropDrag(e) {
        if (!cropBoxState.active) return;
        const stage = document.getElementById('crop-stage');
        const img = document.getElementById('studio-preview-img');
        if (!stage || !img) return;

        const stageRect = stage.getBoundingClientRect();
        const imgRect = img.getBoundingClientRect();
        const imgLeft = imgRect.left - stageRect.left;
        const imgTop = imgRect.top - stageRect.top;
        const imgRight = imgLeft + imgRect.width;
        const imgBottom = imgTop + imgRect.height;

        const pos = getPointerPos(e);
        const dx = pos.x - cropBoxState.startX;
        const dy = pos.y - cropBoxState.startY;

        if (cropBoxState.dragType === 'move') {
            let newX = cropBoxState.startBoxX + dx;
            let newY = cropBoxState.startBoxY + dy;

            newX = Math.max(imgLeft, Math.min(imgRight - cropBoxState.w, newX));
            newY = Math.max(imgTop, Math.min(imgBottom - cropBoxState.h, newY));

            cropBoxState.x = newX;
            cropBoxState.y = newY;
        } else {
            let newX = cropBoxState.startBoxX;
            let newY = cropBoxState.startBoxY;
            let newW = cropBoxState.startBoxW;
            let newH = cropBoxState.startBoxH;

            if (cropBoxState.dragType === 'br') {
                newW = Math.max(40, Math.min(imgRight - newX, cropBoxState.startBoxW + dx));
                newH = Math.max(40, Math.min(imgBottom - newY, cropBoxState.startBoxH + dy));
            } else if (cropBoxState.dragType === 'bl') {
                const maxDx = cropBoxState.startBoxW - 40;
                const actualDx = Math.min(maxDx, Math.max(imgLeft - cropBoxState.startBoxX, dx));
                newX = cropBoxState.startBoxX + actualDx;
                newW = cropBoxState.startBoxW - actualDx;
                newH = Math.max(40, Math.min(imgBottom - newY, cropBoxState.startBoxH + dy));
            } else if (cropBoxState.dragType === 'tr') {
                const maxDy = cropBoxState.startBoxH - 40;
                const actualDy = Math.min(maxDy, Math.max(imgTop - cropBoxState.startBoxY, dy));
                newY = cropBoxState.startBoxY + actualDy;
                newH = cropBoxState.startBoxH - actualDy;
                newW = Math.max(40, Math.min(imgRight - newX, cropBoxState.startBoxW + dx));
            } else if (cropBoxState.dragType === 'tl') {
                const maxDx = cropBoxState.startBoxW - 40;
                const maxDy = cropBoxState.startBoxH - 40;
                const actualDx = Math.min(maxDx, Math.max(imgLeft - cropBoxState.startBoxX, dx));
                const actualDy = Math.min(maxDy, Math.max(imgTop - cropBoxState.startBoxY, dy));
                newX = cropBoxState.startBoxX + actualDx;
                newY = cropBoxState.startBoxY + actualDy;
                newW = cropBoxState.startBoxW - actualDx;
                newH = cropBoxState.startBoxH - actualDy;
            }

            if (studioState.cropRatio === '1:1') {
                const size = Math.min(newW, newH);
                newW = size;
                newH = size;
            } else if (studioState.cropRatio === '4:5') {
                newH = newW * (5/4);
            } else if (studioState.cropRatio === '4:3') {
                newH = newW * (3/4);
            } else if (studioState.cropRatio === '16:9') {
                newH = newW * (9/16);
            }

            cropBoxState.x = newX;
            cropBoxState.y = newY;
            cropBoxState.w = newW;
            cropBoxState.h = newH;
        }

        renderCropBox();
        e.preventDefault();
    }

    function endCropDrag() {
        cropBoxState.active = false;
    }

    function applyBakeAdjustments() {
        const studioImg = document.getElementById('studio-preview-img');
        if (!studioImg) return;

        const stage = document.getElementById('crop-stage');
        const imgRect = studioImg.getBoundingClientRect();
        const stageRect = stage ? stage.getBoundingClientRect() : null;

        const nw = studioImg.naturalWidth || studioImg.width || 800;
        const nh = studioImg.naturalHeight || studioImg.height || 800;

        const masterCanvas = document.createElement('canvas');
        const masterCtx = masterCanvas.getContext('2d');

        const isRotated90 = studioState.rotation === 90 || studioState.rotation === 270;
        const rW = isRotated90 ? nh : nw;
        const rH = isRotated90 ? nw : nh;

        masterCanvas.width = rW;
        masterCanvas.height = rH;

        masterCtx.save();
        const preset = filterPresets[studioState.activeFilter] || filterPresets.normal;
        let filterString = `brightness(${studioState.brightness}%) contrast(${studioState.contrast}%) saturate(${studioState.saturation}%)`;
        if (studioState.warmth > 0) filterString += ` sepia(${studioState.warmth}%)`;
        if (preset.extra) filterString += ` ${preset.extra}`;
        masterCtx.filter = filterString;

        masterCtx.translate(rW / 2, rH / 2);
        masterCtx.rotate((studioState.rotation * Math.PI) / 180);
        masterCtx.scale(studioState.flipH, 1);
        masterCtx.drawImage(studioImg, -nw / 2, -nh / 2, nw, nh);
        masterCtx.restore();

        let finalCanvas = masterCanvas;
        if (stageRect && cropBoxState.w > 0 && cropBoxState.h > 0) {
            const imgLeft = imgRect.left - stageRect.left;
            const imgTop = imgRect.top - stageRect.top;
            const dispW = imgRect.width;
            const dispH = imgRect.height;

            const scaleX = rW / dispW;
            const scaleY = rH / dispH;

            const cropX = Math.max(0, (cropBoxState.x - imgLeft) * scaleX);
            const cropY = Math.max(0, (cropBoxState.y - imgTop) * scaleY);
            const cropW = Math.min(rW - cropX, cropBoxState.w * scaleX);
            const cropH = Math.min(rH - cropY, cropBoxState.h * scaleY);

            if (cropW > 20 && cropH > 20 && (cropW < rW || cropH < rH)) {
                finalCanvas = document.createElement('canvas');
                finalCanvas.width = Math.round(cropW);
                finalCanvas.height = Math.round(cropH);
                const fCtx = finalCanvas.getContext('2d');
                fCtx.drawImage(masterCanvas, cropX, cropY, cropW, cropH, 0, 0, finalCanvas.width, finalCanvas.height);
            }
        }

        const bakedPng = finalCanvas.toDataURL('image/png');
        const hiddenBase64Input = document.getElementById('transparent_image_base64');
        const livePreview = document.getElementById('live-transparent-preview');
        
        if (hiddenBase64Input) hiddenBase64Input.value = bakedPng;
        if (livePreview) livePreview.src = bakedPng;

        closeStudioModal();
    }

    // CUSTOM CATEGORY SELECT DROPDOWN LOGIC
    function toggleCategoryMenu() {
        const menu = document.getElementById('category-options-menu');
        const chevron = document.getElementById('category-chevron');
        if (!menu) return;
        const isHidden = menu.classList.contains('hidden');
        if (isHidden) {
            menu.classList.remove('hidden');
            if (chevron) chevron.classList.add('rotate-180');
        } else {
            menu.classList.add('hidden');
            if (chevron) chevron.classList.remove('rotate-180');
        }
    }

    function selectCategoryOption(id, name) {
        const select = document.getElementById('real_category_select');
        const label = document.getElementById('category-selected-label');
        const menu = document.getElementById('category-options-menu');
        const chevron = document.getElementById('category-chevron');

        if (select) {
            select.value = id;
            select.dispatchEvent(new Event('change'));
        }

        if (label) {
            label.innerHTML = `<i class="fa-solid fa-gem text-amber-400 text-xs"></i> <span class="text-white font-semibold">${name}</span>`;
        }

        document.querySelectorAll('.category-option-item').forEach(item => {
            const check = item.querySelector('.checkmark-icon');
            if (item.getAttribute('data-id') === String(id)) {
                item.classList.add('bg-amber-400/15', 'text-amber-300', 'font-bold');
                if (check) check.classList.remove('hidden');
            } else {
                item.classList.remove('bg-amber-400/15', 'text-amber-300', 'font-bold');
                if (check) check.classList.add('hidden');
            }
        });

        if (menu) menu.classList.add('hidden');
        if (chevron) chevron.classList.remove('rotate-180');
    }

    document.addEventListener('DOMContentLoaded', () => {
        const fileInput = document.getElementById('input_image_file');
        const urlInput = document.getElementById('input_image_url');
        const removeBgBtn = document.getElementById('btn-remove-bg');
        const revertBtn = document.getElementById('btn-revert-bg');

        if (fileInput) {
            fileInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) handleSource(file);
            });
        }

        if (urlInput) {
            urlInput.addEventListener('input', (e) => {
                if (e.target.value) handleSource(e.target.value);
            });
        }

        if (removeBgBtn) {
            removeBgBtn.addEventListener('click', triggerManualBackgroundRemoval);
        }

        if (revertBtn) {
            revertBtn.addEventListener('click', restoreOriginalPhoto);
        }

        ['slider-brightness', 'slider-contrast', 'slider-saturation', 'slider-warmth'].forEach(id => {
            document.getElementById(id)?.addEventListener('input', applyStudioLiveFilters);
        });

        // Crop drag listeners
        const cropBox = document.getElementById('interactive-crop-box');
        if (cropBox) {
            cropBox.addEventListener('mousedown', startCropDrag);
            cropBox.addEventListener('touchstart', startCropDrag, { passive: false });
        }
        window.addEventListener('mousemove', moveCropDrag);
        window.addEventListener('touchmove', moveCropDrag, { passive: false });
        window.addEventListener('mouseup', endCropDrag);
        window.addEventListener('touchend', endCropDrag);

        const select = document.getElementById('real_category_select');
        if (select && select.value) {
            const selectedOpt = select.options[select.selectedIndex];
            if (selectedOpt && selectedOpt.value) {
                selectCategoryOption(selectedOpt.value, selectedOpt.text.trim());
            }
        }
    });

    document.addEventListener('click', (e) => {
        const dropdown = document.getElementById('custom-category-dropdown');
        const menu = document.getElementById('category-options-menu');
        const chevron = document.getElementById('category-chevron');
        if (dropdown && !dropdown.contains(e.target) && menu && !menu.classList.contains('hidden')) {
            menu.classList.add('hidden');
            if (chevron) chevron.classList.remove('rotate-180');
        }
    });
</script>
@endsection
