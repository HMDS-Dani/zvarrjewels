@extends('admin.layout')

@section('title', 'Edit Product')
@section('header_title', 'Edit Product')

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
    <div class="glass-card-luxury p-5 sm:p-8 rounded-3xl space-y-6">
        <div class="mb-5 sm:mb-6 pb-4 sm:pb-6 border-b border-white/5 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h2 class="font-cinzel font-bold text-lg sm:text-xl text-white">Edit: {{ $product->name }}</h2>
                <p class="text-xs text-stone-400 mt-1">Update specifications and photos for this item.</p>
            </div>
            <span class="text-xs text-amber-400 font-mono px-3 py-1 rounded-full bg-amber-400/10 border border-amber-400/30 self-start sm:self-auto">ID: #{{ $product->id }}</span>
        </div>

        <form id="product-form" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5 sm:space-y-6">
            @csrf
            @method('PUT')

            <!-- Hidden input for client-side processed transparent PNG -->
            <input type="hidden" name="transparent_image_base64" id="transparent_image_base64">

            <!-- 1. Name & Category -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        Product Name <span class="text-amber-400">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                        class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        Category <span class="text-amber-400">*</span>
                    </label>

                    <!-- Custom Luxury Dark Dropdown -->
                    <div class="relative" id="custom-category-dropdown">
                        <!-- Hidden select for form submit / validation -->
                        <select name="category_id" id="real_category_select" class="hidden" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Custom Trigger Button -->
                        <button type="button" id="category-trigger-btn" onclick="toggleCategoryMenu()"
                            class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 hover:border-amber-400/40 rounded-2xl text-xs sm:text-sm text-left flex items-center justify-between transition group focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                            <span id="category-selected-label" class="text-stone-400 flex items-center gap-2 truncate">
                                <i class="fa-solid fa-tags text-amber-400/60 text-xs"></i>
                                <span>Select Category</span>
                            </span>
                            <i id="category-chevron" class="fa-solid fa-chevron-down text-stone-500 group-hover:text-amber-400 text-xs transition transform duration-200"></i>
                        </button>

                        <!-- Custom Dark Luxury Dropdown Menu -->
                        <div id="category-options-menu" class="hidden absolute left-0 right-0 top-full mt-2 z-50 bg-[#0d0d14] border border-amber-400/30 rounded-2xl p-1.5 shadow-2xl shadow-black/95 backdrop-blur-2xl max-h-64 overflow-y-auto space-y-1 divide-y divide-white/5">
                            @foreach($categories as $cat)
                                <div onclick="selectCategoryOption('{{ $cat->id }}', '{{ addslashes($cat->name) }}')"
                                    class="category-option-item flex items-center justify-between px-3.5 py-3 rounded-xl cursor-pointer hover:bg-amber-400/10 hover:text-amber-300 text-stone-200 text-xs sm:text-sm transition {{ old('category_id', $product->category_id) == $cat->id ? 'bg-amber-400/15 text-amber-300 font-bold' : '' }}"
                                    data-id="{{ $cat->id }}">
                                    <span class="flex items-center gap-2.5 truncate">
                                        <span class="w-2 h-2 rounded-full bg-amber-400/60 flex-shrink-0"></span>
                                        <span class="truncate">{{ $cat->name }}</span>
                                    </span>
                                    <i class="fa-solid fa-check text-amber-400 text-xs {{ old('category_id', $product->category_id) == $cat->id ? '' : 'hidden' }} checkmark-icon"></i>
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
                    <input type="text" name="material" value="{{ old('material', $product->material) }}" required
                        class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        Available Stock Count <span class="text-amber-400">*</span>
                    </label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required
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
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required
                            class="w-full pl-12 pr-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white font-cinzel font-bold focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        Discount Price (Optional)
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-stone-500 text-xs font-bold font-cinzel">Rs.</span>
                        <input type="number" step="0.01" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}"
                            class="w-full pl-12 pr-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white font-cinzel focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>
                </div>
            </div>

            <!-- 4. Description -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                    Product Description
                </label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition resize-none">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- 5. UPLOAD OPTIONS & AI REMOVAL SELECTION -->
            <div class="p-5 sm:p-6 rounded-3xl bg-[#08080d] border border-amber-400/15 space-y-5">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-amber-400 flex items-center gap-2">
                        <i class="fa-solid fa-camera-retro"></i>
                        <span>Product Image & Upload Mode</span>
                    </h4>
                    @if($product->image)
                        <span class="text-xs text-emerald-400 flex items-center gap-1">
                            <i class="fa-solid fa-check"></i> Image Saved
                        </span>
                    @endif
                </div>

                <!-- Mode Selector -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <label id="label-mode-ai" class="flex items-start gap-3 p-4 rounded-2xl border-2 border-amber-400 bg-amber-400/10 cursor-pointer transition shadow-lg shadow-amber-500/5">
                        <input type="radio" name="bg_mode" value="ai" checked class="mt-0.5 text-amber-500 focus:ring-amber-400">
                        <div>
                            <div class="text-xs font-bold text-amber-300 flex items-center gap-1.5">
                                <i class="fa-solid fa-wand-magic-sparkles text-amber-400"></i>
                                <span>AI Background Remover</span>
                            </div>
                            <p class="text-[11px] text-stone-400 mt-0.5 font-light">Auto removes image background for a clean dark look.</p>
                        </div>
                    </label>

                    <label id="label-mode-direct" class="flex items-start gap-3 p-4 rounded-2xl border-2 border-white/10 hover:border-white/20 bg-white/[0.02] cursor-pointer transition">
                        <input type="radio" name="bg_mode" value="direct" class="mt-0.5 text-amber-500 focus:ring-amber-400">
                        <div>
                            <div class="text-xs font-bold text-stone-300 flex items-center gap-1.5">
                                <i class="fa-solid fa-image text-stone-400"></i>
                                <span>Direct Upload (Keep Original Photo)</span>
                            </div>
                            <p class="text-[11px] text-stone-400 mt-0.5 font-light">Displays photo directly without background removal.</p>
                        </div>
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-1">
                    <div>
                        <label class="block text-xs font-semibold text-stone-300 mb-2">Option A: Direct Image Web URL</label>
                        <input type="url" id="input_image_url" name="image_url" value="{{ old('image_url') }}"
                            placeholder="https://images.unsplash.com/photo-..."
                            class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-stone-300 mb-2">Option B: Upload New File</label>
                        <input type="file" id="input_image_file" name="image_file" accept="image/*"
                            class="w-full px-4 py-2.5 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs text-stone-300 file:mr-3 file:py-1 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-amber-400 file:text-slate-950 hover:file:bg-amber-300 cursor-pointer">
                    </div>
                </div>

                <!-- AI Processing Progress Bar -->
                <div id="ai-loading-bar" class="hidden p-3.5 sm:p-4 rounded-xl bg-amber-500/10 border border-amber-500/30 space-y-2">
                    <div class="flex items-center justify-between text-xs text-amber-300 font-semibold">
                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-spinner fa-spin text-amber-400"></i>
                            <span id="ai-status-text">Removing image background...</span>
                        </span>
                        <span id="ai-percentage" class="text-amber-400 font-mono">Running</span>
                    </div>
                    <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden">
                        <div id="ai-progress-fill" class="bg-gradient-to-r from-amber-400 via-yellow-400 to-amber-500 h-full w-3/4 transition-all duration-300 animate-pulse"></div>
                    </div>
                </div>

                <!-- Live Preview on Website's Dark Card Background with Edit Studio Button -->
                <div id="preview-wrapper" class="hidden pt-4 border-t border-slate-800/80 space-y-3">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2.5">
                        <span class="text-xs font-bold text-slate-300">Live Website Dark Card Preview:</span>
                        <button type="button" onclick="openStudioModal()" 
                            class="self-start sm:self-auto px-3.5 py-2 rounded-xl bg-amber-500/20 hover:bg-amber-500/30 text-amber-300 border border-amber-500/40 text-xs font-bold flex items-center gap-1.5 transition">
                            <i class="fa-solid fa-sliders"></i>
                            <span>Adjust Lighting</span>
                        </button>
                    </div>

                    <div id="card-preview-podium" class="flex items-center justify-center p-4 sm:p-6 rounded-2xl border border-white/10 bg-gradient-to-b from-[#141218] via-[#09080c] to-[#040406] shadow-2xl min-h-[220px] sm:min-h-[260px] relative overflow-hidden">
                        <div id="spotlight-aura" class="absolute w-36 sm:w-44 h-36 sm:h-44 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
                        <img id="live-transparent-preview" src="" alt="Transparent Preview" 
                            class="max-h-48 sm:max-h-56 max-w-full object-contain relative z-10 drop-shadow-[0_20px_35px_rgba(0,0,0,0.95)]">
                    </div>
                </div>

            </div>

            <!-- 6. Featured Spotlight Toggle -->
            <div class="flex items-center gap-3.5 p-4 bg-[#08080d] rounded-2xl border border-white/5">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
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
                    <i class="fa-solid fa-check text-xs"></i> 
                    <span>Update Product</span>
                </button>
            </div>

        </form>
    </div>

</div>

<!-- INTERACTIVE IMAGE EDIT STUDIO MODAL -->
<div id="studio-modal" class="hidden fixed inset-0 bg-black/85 backdrop-blur-xl z-50 items-center justify-center p-4">
    <div class="glass-card-luxury p-6 sm:p-8 rounded-3xl max-w-2xl w-full shadow-2xl relative space-y-5 border border-amber-400/30">
        
        <!-- Header -->
        <div class="flex items-center justify-between border-b border-white/10 pb-4">
            <div>
                <h3 class="text-lg font-bold text-white font-cinzel flex items-center gap-2">
                    <i class="fa-solid fa-wand-magic-sparkles text-amber-400"></i>
                    <span>Jewellery Polish & Lighting Studio</span>
                </h3>
                <p class="text-xs text-stone-400 mt-0.5">Refine brilliance, metal warmth, and card stage aura.</p>
            </div>
            <button type="button" onclick="closeStudioModal()" class="w-8 h-8 rounded-xl bg-white/5 text-stone-400 hover:text-white flex items-center justify-center text-sm border border-white/10">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Studio Body -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-center">
            
            <!-- Left: Live Podium Canvas Preview (7 cols) -->
            <div class="md:col-span-7 flex items-center justify-center p-6 rounded-2xl border border-white/10 bg-gradient-to-b from-[#141218] via-[#09080c] to-[#040406] min-h-[220px] relative overflow-hidden">
                <div id="modal-spotlight-aura" class="absolute w-36 h-36 bg-amber-500/20 rounded-full blur-2xl pointer-events-none"></div>
                <img id="studio-preview-img" src="" alt="Editing" 
                    class="max-h-48 max-w-full object-contain relative z-10 drop-shadow-[0_20px_35px_rgba(0,0,0,0.95)]">
            </div>

            <!-- Right: Sliders & Controls (5 cols) -->
            <div class="md:col-span-5 space-y-4 text-xs">
                
                <!-- Brightness -->
                <div>
                    <div class="flex justify-between text-slate-300 mb-1 font-semibold">
                        <span>✨ Sparkle Brightness</span>
                        <span id="val-brightness">105%</span>
                    </div>
                    <input type="range" id="slider-brightness" min="70" max="150" value="105" 
                        class="w-full accent-amber-400 bg-slate-800 rounded-lg cursor-pointer">
                </div>

                <!-- Contrast -->
                <div>
                    <div class="flex justify-between text-slate-300 mb-1 font-semibold">
                        <span>💎 Clarity & Contrast</span>
                        <span id="val-contrast">110%</span>
                    </div>
                    <input type="range" id="slider-contrast" min="80" max="160" value="110" 
                        class="w-full accent-amber-400 bg-slate-800 rounded-lg cursor-pointer">
                </div>

                <!-- Saturation / Gold Vibrance -->
                <div>
                    <div class="flex justify-between text-slate-300 mb-1 font-semibold">
                        <span>👑 Metal Vibrance</span>
                        <span id="val-saturation">108%</span>
                    </div>
                    <input type="range" id="slider-saturation" min="50" max="160" value="108" 
                        class="w-full accent-amber-400 bg-slate-800 rounded-lg cursor-pointer">
                </div>

                <!-- Card Spotlight Aura Color Presets -->
                <div class="pt-1 border-t border-slate-800">
                    <label class="block text-[11px] font-bold uppercase text-slate-400 mb-2">Card Spotlight Glow:</label>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="setSpotlightAura('rgba(245, 158, 11, 0.25)')" title="Royal Warm Gold"
                            class="w-7 h-7 rounded-full bg-amber-500 border-2 border-white/40 hover:scale-110 transition shadow"></button>
                        <button type="button" onclick="setSpotlightAura('rgba(56, 189, 248, 0.25)')" title="Diamond Crystal Blue"
                            class="w-7 h-7 rounded-full bg-sky-400 border-2 border-white/20 hover:scale-110 transition shadow"></button>
                        <button type="button" onclick="setSpotlightAura('rgba(244, 63, 94, 0.25)')" title="Rose Gold Ruby"
                            class="w-7 h-7 rounded-full bg-rose-500 border-2 border-white/20 hover:scale-110 transition shadow"></button>
                        <button type="button" onclick="setSpotlightAura('rgba(255, 255, 255, 0.15)')" title="Pure Platinum"
                            class="w-7 h-7 rounded-full bg-slate-100 border-2 border-white/20 hover:scale-110 transition shadow"></button>
                    </div>
                </div>

            </div>

        </div>

        <!-- Actions -->
        <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-800">
            <button type="button" onclick="closeStudioModal()" class="px-5 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold">
                Done & Keep
            </button>
            <button type="button" onclick="applyBakeAdjustments()" class="px-6 py-2.5 bg-gradient-to-r from-amber-400 to-yellow-600 hover:opacity-95 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-amber-500/20">
                Apply & Save Polish
            </button>
        </div>

    </div>
</div>

<!-- ZVARR AI Segmentation & Alpha Speck Cleanup Engine -->
<script type="module">
    import { removeBackground } from 'https://cdn.jsdelivr.net/npm/@imgly/background-removal@1.7.0/+esm';

    const fileInput = document.getElementById('input_image_file');
    const urlInput = document.getElementById('input_image_url');
    const previewWrapper = document.getElementById('preview-wrapper');
    const previewImg = document.getElementById('live-transparent-preview');
    const hiddenBase64Input = document.getElementById('transparent_image_base64');
    const loadingBar = document.getElementById('ai-loading-bar');
    const statusText = document.getElementById('ai-status-text');
    const submitBtn = document.getElementById('submit-btn');

    // Mode Radio Buttons
    const modeRadios = document.querySelectorAll('input[name="bg_mode"]');
    const labelAi = document.getElementById('label-mode-ai');
    const labelDirect = document.getElementById('label-mode-direct');

    modeRadios.forEach(r => {
        r.addEventListener('change', () => {
            if (r.value === 'ai') {
                labelAi.classList.add('border-amber-500', 'bg-amber-500/10');
                labelAi.classList.remove('border-slate-700', 'bg-slate-900');
                labelDirect.classList.remove('border-amber-500', 'bg-amber-500/10');
                labelDirect.classList.add('border-slate-700', 'bg-slate-900');
            } else {
                labelDirect.classList.add('border-amber-500', 'bg-amber-500/10');
                labelDirect.classList.remove('border-slate-700', 'bg-slate-900');
                labelAi.classList.remove('border-amber-500', 'bg-amber-500/10');
                labelAi.classList.add('border-slate-700', 'bg-slate-900');
            }
            if (fileInput.files[0]) handleSource(fileInput.files[0]);
            else if (urlInput.value) handleSource(urlInput.value);
        });
    });

    // Intelligent Noise Speck & Halo Cleaner
    function cleanAlphaNoise(blob) {
        return new Promise((resolve) => {
            const img = new Image();
            img.onload = () => {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d', { willReadFrequently: true });
                const w = img.naturalWidth || img.width;
                const h = img.naturalHeight || img.height;
                canvas.width = w;
                canvas.height = h;
                ctx.drawImage(img, 0, 0);

                const imgData = ctx.getImageData(0, 0, w, h);
                const d = imgData.data;

                // 1. Erase low-alpha semi-transparent speckles
                for (let i = 0; i < d.length; i += 4) {
                    if (d[i + 3] < 40) {
                        d[i + 3] = 0;
                    }
                }

                // 2. Erase isolated tiny islands of noise (< 80 connected pixels)
                const visited = new Uint8Array(w * h);
                const minClusterSize = 80;

                for (let y = 0; y < h; y++) {
                    for (let x = 0; x < w; x++) {
                        const pos = y * w + x;
                        if (d[pos * 4 + 3] > 0 && !visited[pos]) {
                            const cluster = [];
                            const queue = [pos];
                            visited[pos] = 1;
                            let head = 0;

                            while (head < queue.length) {
                                const curr = queue[head++];
                                cluster.push(curr);
                                const cx = curr % w;
                                const cy = Math.floor(curr / w);

                                const neighbors = [
                                    [cx + 1, cy], [cx - 1, cy],
                                    [cx, cy + 1], [cx, cy - 1]
                                ];

                                for (let n = 0; n < neighbors.length; n++) {
                                    const nx = neighbors[n][0];
                                    const ny = neighbors[n][1];
                                    if (nx >= 0 && nx < w && ny >= 0 && ny < h) {
                                        const nPos = ny * w + nx;
                                        if (!visited[nPos] && d[nPos * 4 + 3] > 0) {
                                            visited[nPos] = 1;
                                            queue.push(nPos);
                                        }
                                    }
                                }
                            }

                            if (cluster.length < minClusterSize) {
                                for (let k = 0; k < cluster.length; k++) {
                                    d[cluster[k] * 4 + 3] = 0;
                                }
                            }
                        }
                    }
                }

                ctx.putImageData(imgData, 0, 0);
                resolve(canvas.toDataURL('image/png'));
            };
            img.src = URL.createObjectURL(blob);
        });
    }

    async function handleSource(imageSource) {
        if (!imageSource) return;

        const isAiMode = document.querySelector('input[name="bg_mode"]:checked')?.value === 'ai';

        if (!isAiMode) {
            loadingBar.classList.add('hidden');
            if (typeof imageSource === 'string') {
                previewImg.src = imageSource;
                hiddenBase64Input.value = '';
            } else {
                const reader = new FileReader();
                reader.onload = (e) => {
                    hiddenBase64Input.value = e.target.result;
                    previewImg.src = e.target.result;
                };
                reader.readAsDataURL(imageSource);
            }
            previewWrapper.classList.remove('hidden');
            if (submitBtn) submitBtn.disabled = false;
            return;
        }

        loadingBar.classList.remove('hidden');
        previewWrapper.classList.add('hidden');
        if (submitBtn) submitBtn.disabled = true;

        statusText.textContent = 'ZVARR AI is segmenting jewelry & eliminating noise...';

        try {
            const rawBlob = await removeBackground(imageSource, {
                model: 'medium', // High-definition precision
                output: {
                    format: 'image/png',
                    quality: 0.98
                }
            });

            const cleanedPng = await cleanAlphaNoise(rawBlob);

            hiddenBase64Input.value = cleanedPng;
            previewImg.src = cleanedPng;
            loadingBar.classList.add('hidden');
            previewWrapper.classList.remove('hidden');
            if (submitBtn) submitBtn.disabled = false;

        } catch (error) {
            console.warn('AI fallback to canvas segmentation:', error);
            fallbackCanvasProcessor(imageSource);
        }
    }

    function fallbackCanvasProcessor(src) {
        const img = new Image();
        img.crossOrigin = 'anonymous';
        img.onload = () => {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            canvas.width = img.naturalWidth || img.width;
            canvas.height = img.naturalHeight || img.height;
            ctx.drawImage(img, 0, 0);

            const transparentPng = canvas.toDataURL('image/png');
            hiddenBase64Input.value = transparentPng;
            previewImg.src = transparentPng;
            loadingBar.classList.add('hidden');
            previewWrapper.classList.remove('hidden');
            if (submitBtn) submitBtn.disabled = false;
        };
        if (typeof src === 'string') img.src = src;
        else img.src = URL.createObjectURL(src);
    }

    if (fileInput) {
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) handleSource(file);
        });
    }

    if (urlInput) {
        urlInput.addEventListener('blur', (e) => {
            if (e.target.value) handleSource(e.target.value);
        });
    }
</script>

<!-- Interactive Studio Polish Script -->
<script>
let currentAuraColor = 'rgba(245, 158, 11, 0.2)';

function openStudioModal() {
    const previewImg = document.getElementById('live-transparent-preview');
    const studioPreview = document.getElementById('studio-preview-img');
    if (!previewImg.src) return;

    studioPreview.src = previewImg.src;
    document.getElementById('studio-modal').classList.remove('hidden');
    document.getElementById('studio-modal').classList.add('flex');
    applyStudioLiveFilters();
}

function closeStudioModal() {
    document.getElementById('studio-modal').classList.add('hidden');
    document.getElementById('studio-modal').classList.remove('flex');
}

function setSpotlightAura(color) {
    currentAuraColor = color;
    document.getElementById('modal-spotlight-aura').style.backgroundColor = color;
    document.getElementById('spotlight-aura').style.backgroundColor = color;
}

function applyStudioLiveFilters() {
    const b = document.getElementById('slider-brightness').value;
    const c = document.getElementById('slider-contrast').value;
    const s = document.getElementById('slider-saturation').value;

    document.getElementById('val-brightness').textContent = `${b}%`;
    document.getElementById('val-contrast').textContent = `${c}%`;
    document.getElementById('val-saturation').textContent = `${s}%`;

    const filterString = `brightness(${b}%) contrast(${c}%) saturate(${s}%)`;
    document.getElementById('studio-preview-img').style.filter = filterString;
}

['slider-brightness', 'slider-contrast', 'slider-saturation'].forEach(id => {
    document.getElementById(id).addEventListener('input', applyStudioLiveFilters);
});

function applyBakeAdjustments() {
    const studioImg = document.getElementById('studio-preview-img');
    const b = document.getElementById('slider-brightness').value;
    const c = document.getElementById('slider-contrast').value;
    const s = document.getElementById('slider-saturation').value;

    const canvas = document.createElement('canvas');
    const ctx = canvas.getContext('2d');
    canvas.width = studioImg.naturalWidth || studioImg.width;
    canvas.height = studioImg.naturalHeight || studioImg.height;

    ctx.filter = `brightness(${b}%) contrast(${c}%) saturate(${s}%)`;
    ctx.drawImage(studioImg, 0, 0, canvas.width, canvas.height);

    const bakedPng = canvas.toDataURL('image/png');
    document.getElementById('transparent_image_base64').value = bakedPng;
    document.getElementById('live-transparent-preview').src = bakedPng;

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

// Init selected category if present on load
document.addEventListener('DOMContentLoaded', () => {
    const select = document.getElementById('real_category_select');
    if (select && select.value) {
        const selectedOpt = select.options[select.selectedIndex];
        if (selectedOpt && selectedOpt.value) {
            selectCategoryOption(selectedOpt.value, selectedOpt.text.trim());
        }
    }
});

// Close dropdown on outside click
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
