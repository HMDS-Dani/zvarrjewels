@extends('admin.layout')

@section('title', 'Categories')
@section('header_title', 'Categories')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8">

    <!-- LEFT: Add New Category Form (5 cols) -->
    <div class="lg:col-span-5">
        <div class="glass-card-luxury p-5 sm:p-7 rounded-3xl lg:sticky lg:top-28 space-y-5">
            <div class="flex items-center gap-2.5 pb-3 border-b border-white/5">
                <div class="w-8 h-8 rounded-xl bg-amber-400/15 border border-amber-400/30 text-amber-300 flex items-center justify-center text-xs font-bold">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div>
                    <h3 class="font-cinzel font-bold text-base text-white">Add Category</h3>
                    <p class="text-[10px] text-stone-400">Rings, Bridal Sets, Necklaces, etc.</p>
                </div>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-2">
                        Category Name <span class="text-amber-400">*</span>
                    </label>
                    <input type="text" name="name" required placeholder="e.g. Bridal Rings"
                        class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-stone-300">
                            Description
                        </label>
                        <button type="button" onclick="generateCategoryDescAI('add')"
                            class="px-2.5 py-1 rounded-xl bg-amber-400/10 hover:bg-amber-400/20 text-amber-300 border border-amber-400/30 text-[11px] font-bold flex items-center gap-1.5 transition active:scale-95">
                            <i class="fa-solid fa-wand-magic-sparkles text-amber-400 text-xs"></i>
                            <span id="ai-cat-btn-text-add">AI Copy ✨</span>
                        </button>
                    </div>
                    <textarea name="description" id="add-category-description" rows="2" placeholder="Brief description or click 'AI Copy'..."
                        class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition resize-none"></textarea>
                </div>

                <!-- Cover Image (Dual: Device Upload or Web URL) -->
                <div class="space-y-3 pt-1">
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300">
                        Category Image
                    </label>

                    <!-- Device File Upload -->
                    <div class="p-4 rounded-2xl bg-[#08080d] border border-dashed border-white/15 text-center hover:border-amber-400/50 transition">
                        <label class="cursor-pointer flex flex-col items-center justify-center gap-1.5">
                            <i class="fa-solid fa-cloud-arrow-up text-amber-400 text-lg"></i>
                            <span class="text-xs font-semibold text-stone-200">Upload Image File</span>
                            <span class="text-[10px] text-stone-500">PNG, JPG, WEBP up to 5MB</span>
                            <input type="file" name="image_file" accept="image/*" class="hidden" onchange="previewAddImage(this)">
                        </label>
                        <div id="add-file-name" class="text-[11px] text-amber-300 font-mono mt-2 hidden"></div>
                    </div>

                    <!-- Web Image URL Input -->
                    <div>
                        <span class="text-[10px] uppercase font-semibold text-stone-400 block mb-1">Or Web Image URL:</span>
                        <input type="url" name="image" id="add-image-url" placeholder="https://images.unsplash.com/..."
                            oninput="previewAddUrl(this.value)"
                            class="w-full px-4 py-2.5 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs text-white placeholder-stone-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>

                    <!-- Live Image Preview Box -->
                    <div id="add-preview-container" class="hidden mt-2 p-2.5 rounded-2xl bg-[#08080d] border border-white/10 flex items-center gap-3">
                        <img id="add-preview-img" src="" alt="Preview" class="w-12 h-12 rounded-xl object-cover border border-amber-400/30">
                        <span class="text-xs text-amber-300 font-medium">Cover Image Loaded</span>
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-3.5 rounded-2xl bg-gradient-to-r from-amber-300 via-amber-400 to-amber-500 hover:from-amber-200 hover:to-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider shadow-lg shadow-amber-500/20 transition transform hover:-translate-y-0.5 active:scale-95 flex items-center justify-center gap-2 mt-2">
                    <i class="fa-solid fa-plus text-xs"></i>
                    <span>Save Category</span>
                </button>
            </form>
        </div>
    </div>

    <!-- RIGHT: Categories List (7 cols) -->
    <div class="lg:col-span-7 space-y-4">
        <div class="glass-card-luxury p-5 sm:p-7 rounded-3xl space-y-5">
            <div class="flex items-center justify-between border-b border-white/5 pb-4">
                <div>
                    <h3 class="font-cinzel font-bold text-base sm:text-lg text-white">Active Categories</h3>
                    <p class="text-xs text-stone-400">All categories active on your store</p>
                </div>
                <span class="px-3 py-1 rounded-full bg-amber-400/10 text-amber-300 border border-amber-400/30 text-xs font-bold font-mono">
                    {{ $categories->count() }} Total
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @forelse($categories as $category)
                    <div class="p-4 rounded-2xl bg-[#08080d] border border-white/5 hover:border-amber-400/30 flex flex-col justify-between gap-3.5 transition group">
                        
                        <div class="flex items-start gap-3.5">
                            @if($category->image_url)
                                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" 
                                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=600';"
                                    class="w-14 h-14 min-w-[56px] min-h-[56px] max-w-[56px] max-h-[56px] rounded-2xl object-cover border border-amber-400/20 flex-shrink-0 bg-black/40 shadow-md">
                            @else
                                <div class="w-14 h-14 min-w-[56px] min-h-[56px] max-w-[56px] max-h-[56px] rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-amber-400 flex-shrink-0">
                                    <i class="fa-solid fa-tag text-lg"></i>
                                </div>
                            @endif

                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-white text-sm truncate group-hover:text-amber-300 transition">{{ $category->name }}</h4>
                                <p class="text-[10px] text-stone-400 font-mono mt-0.5">slug: {{ $category->slug }}</p>
                                <span class="inline-flex items-center gap-1.5 text-[11px] text-amber-300 font-semibold mt-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                    {{ $category->products_count }} Jewels
                                </span>
                            </div>
                        </div>

                        <!-- Card Action Buttons -->
                        <div class="pt-3 border-t border-white/5 flex items-center justify-end gap-2">
                            <!-- Edit Button -->
                            <button type="button" 
                                onclick="openEditCategoryModal({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->description ?? '') }}', '{{ addslashes($category->image ?? '') }}')"
                                class="px-3 py-1.5 rounded-xl bg-amber-400/10 hover:bg-amber-400/20 text-amber-300 border border-amber-400/30 text-xs font-semibold flex items-center gap-1.5 transition">
                                <i class="fa-solid fa-pen text-[10px]"></i>
                                <span>Edit</span>
                            </button>

                            <!-- Delete Button -->
                            <button type="button" 
                                onclick="triggerDeleteModal('{{ route('admin.categories.destroy', $category->id) }}', 'Category: {{ addslashes($category->name) }}')"
                                class="px-3 py-1.5 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/30 text-xs font-semibold flex items-center gap-1.5 transition">
                                <i class="fa-regular fa-trash-can text-[10px]"></i>
                                <span>Delete</span>
                            </button>
                        </div>

                    </div>
                @empty
                    <div class="col-span-2 text-center py-14 text-stone-500">
                        <i class="fa-solid fa-tags text-3xl mb-2 text-stone-600"></i>
                        <p class="text-xs">No collections registered yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

<!-- EDIT CATEGORY MODAL -->
<div id="edit-category-modal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-xl hidden items-center justify-center p-4">
    <div class="glass-card-luxury rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-4 border border-amber-400/30">
        
        <div class="flex items-center justify-between border-b border-white/10 pb-3">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-xl bg-amber-400/20 text-amber-300 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-pen"></i>
                </div>
                <h3 class="font-cinzel font-bold text-base text-white">Edit Collection</h3>
            </div>
            <button type="button" onclick="closeEditCategoryModal()" class="w-8 h-8 rounded-xl bg-white/5 text-stone-400 hover:text-white flex items-center justify-center text-sm border border-white/10">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form id="edit-category-form" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-1.5">Collection Name <span class="text-amber-400">*</span></label>
                <input type="text" name="name" id="edit-name" required
                    class="w-full px-4 py-2.5 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
            </div>

            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300">Description</label>
                    <button type="button" onclick="generateCategoryDescAI('edit')"
                        class="px-2.5 py-1 rounded-xl bg-amber-400/10 hover:bg-amber-400/20 text-amber-300 border border-amber-400/30 text-[11px] font-bold flex items-center gap-1.5 transition active:scale-95">
                        <i class="fa-solid fa-wand-magic-sparkles text-amber-400 text-xs"></i>
                        <span id="ai-cat-btn-text-edit">AI Copy ✨</span>
                    </button>
                </div>
                <textarea name="description" id="edit-description" rows="2"
                    class="w-full px-4 py-2.5 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition resize-none"></textarea>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-stone-300">Replace Cover Image</label>
                
                <div class="p-3 rounded-2xl bg-[#08080d] border border-dashed border-white/15 text-center">
                    <label class="cursor-pointer flex flex-col items-center justify-center gap-1">
                        <i class="fa-solid fa-cloud-arrow-up text-amber-400 text-base"></i>
                        <span class="text-xs text-stone-200">Upload New File</span>
                        <input type="file" name="image_file" accept="image/*" class="hidden">
                    </label>
                </div>

                <input type="url" name="image" id="edit-image-url" placeholder="Or enter new image URL..."
                    class="w-full px-4 py-2.5 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-white/10">
                <button type="button" onclick="closeEditCategoryModal()" class="px-5 py-2.5 bg-white/5 hover:bg-white/10 text-stone-300 rounded-xl text-xs font-bold transition">
                    Cancel
                </button>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-amber-300 via-amber-400 to-amber-500 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-amber-500/20 transition">
                    Save Changes
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    let aiCatAngleIndex = 0;

    function generateCategoryDescAI(mode) {
        const isEdit = mode === 'edit';
        const nameInput = isEdit ? document.getElementById('edit-name') : document.querySelector('input[name="name"]');
        const descTextarea = isEdit ? document.getElementById('edit-description') : document.getElementById('add-category-description');
        const btnText = document.getElementById(isEdit ? 'ai-cat-btn-text-edit' : 'ai-cat-btn-text-add');

        const catName = nameInput ? nameInput.value.trim() : '';
        if (!catName) {
            if (nameInput) nameInput.focus();
            alert('Please enter a Category Name first!');
            return;
        }

        const lower = catName.toLowerCase();
        let itemType = 'jewellery creations';
        if (lower.includes('ring')) itemType = 'statement rings and bands';
        else if (lower.includes('necklace') || lower.includes('choker') || lower.includes('pendant')) itemType = 'necklaces and opulent chokers';
        else if (lower.includes('earring') || lower.includes('jhumk') || lower.includes('stud')) itemType = 'earrings and heirloom jhumkas';
        else if (lower.includes('bracelet') || lower.includes('bangle')) itemType = 'bracelets and handcrafted bangles';
        else if (lower.includes('bridal') || lower.includes('set')) itemType = 'bridal sets and grand celebrations';

        const categoryAngles = [
            `Discover our exclusive collection of ${catName}, where timeless craftmanship meets contemporary radiance in every bespoke piece.`,
            `Curated for connoisseurs of luxury, this signature range of ${catName} showcases luminous stones and mastercrafted ${itemType}.`,
            `Elevate your jewellery wardrobe with ${catName}, designed to bring majestic glamour and understated grace to every occasion.`,
            `An exquisite curation of ${catName}, celebrating authentic artisanal heritage, luminous brilliance, and heirloom sophistication.`
        ];

        const chosen = categoryAngles[aiCatAngleIndex % categoryAngles.length];
        aiCatAngleIndex++;
        const currentAngle = ((aiCatAngleIndex - 1) % categoryAngles.length) + 1;

        if (descTextarea) descTextarea.value = chosen;
        if (btnText) btnText.textContent = `✨ Next (${currentAngle}/${categoryAngles.length})`;
    }
    window.generateCategoryDescAI = generateCategoryDescAI;

    function previewAddImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('add-preview-img').src = e.target.result;
                document.getElementById('add-preview-container').classList.remove('hidden');
                document.getElementById('add-file-name').textContent = input.files[0].name;
                document.getElementById('add-file-name').classList.remove('hidden');
                document.getElementById('add-image-url').value = '';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewAddUrl(url) {
        if (url && url.length > 5) {
            document.getElementById('add-preview-img').src = url;
            document.getElementById('add-preview-container').classList.remove('hidden');
            document.getElementById('add-file-name').classList.add('hidden');
        } else {
            document.getElementById('add-preview-container').classList.add('hidden');
        }
    }

    function openEditCategoryModal(id, name, description, image) {
        const modal = document.getElementById('edit-category-modal');
        const form = document.getElementById('edit-category-form');
        form.action = `/admin/categories/${id}`;
        document.getElementById('edit-name').value = name;
        document.getElementById('edit-description').value = description;
        document.getElementById('edit-image-url').value = image;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditCategoryModal() {
        const modal = document.getElementById('edit-category-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
