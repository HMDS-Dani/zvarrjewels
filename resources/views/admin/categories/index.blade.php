@extends('admin.layout')

@section('title', 'Categories Management')
@section('header_title', 'Jewellery Categories')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-12 gap-5 sm:gap-8">

    <!-- LEFT: Add New Category Form (5 cols) -->
    <div class="lg:col-span-5">
        <div class="p-4 sm:p-6 rounded-2xl sm:rounded-3xl bg-slate-900 border border-slate-800 shadow-xl lg:sticky lg:top-28">
            <div class="flex items-center gap-2 mb-1">
                <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                <h3 class="font-serif font-bold text-base sm:text-lg text-slate-100">Add New Category</h3>
            </div>
            <p class="text-xs text-slate-400 mb-4 sm:mb-6">Create new collections (e.g. Rings, Pendants, Bangles)</p>

            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                        Category Name <span class="text-amber-400">*</span>
                    </label>
                    <input type="text" name="name" required placeholder="e.g. Bridal Sets"
                        class="w-full px-3.5 sm:px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                        Description
                    </label>
                    <textarea name="description" rows="2" placeholder="Brief tagline..."
                        class="w-full px-3.5 sm:px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500 resize-none"></textarea>
                </div>

                <!-- Cover Image (Dual: Device Upload or Web URL) -->
                <div class="space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300">
                        Category Cover Image
                    </label>

                    <!-- Device File Upload -->
                    <div class="p-3 rounded-xl bg-slate-950/60 border border-dashed border-slate-700 text-center hover:border-amber-500/50 transition">
                        <label class="cursor-pointer flex flex-col items-center justify-center gap-1">
                            <i class="fa-solid fa-cloud-arrow-up text-amber-400 text-base"></i>
                            <span class="text-[11px] font-semibold text-slate-300">Upload Image File</span>
                            <span class="text-[9.5px] text-slate-500">PNG, JPG, WEBP up to 5MB</span>
                            <input type="file" name="image_file" accept="image/*" class="hidden" onchange="previewAddImage(this)">
                        </label>
                        <div id="add-file-name" class="text-[10px] text-amber-300 font-mono mt-1 hidden"></div>
                    </div>

                    <!-- Web Image URL Input -->
                    <div>
                        <span class="text-[10px] uppercase font-semibold text-slate-400 block mb-1">Or Image URL:</span>
                        <input type="url" name="image" id="add-image-url" placeholder="https://images.unsplash.com/..."
                            oninput="previewAddUrl(this.value)"
                            class="w-full px-3.5 sm:px-4 py-2 bg-slate-800 border border-slate-700 rounded-xl text-xs text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-amber-500">
                    </div>

                    <!-- Live Image Preview Box -->
                    <div id="add-preview-container" class="hidden mt-2 p-2 rounded-xl bg-slate-950 border border-slate-800 flex items-center gap-3">
                        <img id="add-preview-img" src="" alt="Preview" class="w-12 h-12 rounded-lg object-cover border border-slate-700">
                        <span class="text-xs text-slate-300 font-medium">Image Ready</span>
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-bold text-xs uppercase tracking-wider shadow-md shadow-amber-500/20 transition flex items-center justify-center gap-2 mt-2">
                    <i class="fa-solid fa-plus"></i>
                    Save Category
                </button>
            </form>
        </div>
    </div>

    <!-- RIGHT: Categories List (7 cols) -->
    <div class="lg:col-span-7 space-y-4">
        <div class="p-4 sm:p-6 rounded-2xl sm:rounded-3xl bg-slate-900 border border-slate-800 shadow-xl">
            <div class="flex items-center justify-between mb-4 sm:mb-6">
                <div>
                    <h3 class="font-serif font-bold text-base sm:text-lg text-slate-100 mb-0.5">Active Categories</h3>
                    <p class="text-xs text-slate-400">All collections currently active on the store</p>
                </div>
                <span class="px-3 py-1 rounded-full bg-amber-400/10 text-amber-300 border border-amber-400/20 text-xs font-bold font-mono">
                    {{ $categories->count() }} Total
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                @forelse($categories as $category)
                    <div class="p-3.5 sm:p-4 rounded-2xl bg-slate-950/70 border border-slate-800 hover:border-slate-700 flex flex-col justify-between gap-3 transition">
                        
                        <div class="flex items-start gap-3">
                            @if($category->image)
                                <img src="{{ $category->image }}" alt="{{ $category->name }}" class="w-12 sm:w-14 h-12 sm:h-14 rounded-xl object-cover border border-slate-800 flex-shrink-0 bg-slate-900">
                            @else
                                <div class="w-12 sm:w-14 h-12 sm:h-14 rounded-xl bg-slate-800 flex items-center justify-center text-slate-500 flex-shrink-0">
                                    <i class="fa-solid fa-tag text-base"></i>
                                </div>
                            @endif

                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-slate-100 text-sm truncate">{{ $category->name }}</h4>
                                <p class="text-[10.5px] text-slate-400 font-mono mt-0.5">slug: {{ $category->slug }}</p>
                                <span class="inline-flex items-center gap-1 text-[11px] text-amber-400 font-semibold mt-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                    {{ $category->products_count }} Products
                                </span>
                            </div>
                        </div>

                        <!-- Card Action Buttons (Touch-friendly on Mobile & Desktop) -->
                        <div class="pt-2 border-t border-slate-800/80 flex items-center justify-end gap-2">
                            <!-- Edit Button -->
                            <button type="button" 
                                onclick="openEditCategoryModal({{ $category->id }}, '{{ addslashes($category->name) }}', '{{ addslashes($category->description ?? '') }}', '{{ addslashes($category->image ?? '') }}')"
                                class="px-3 py-1.5 rounded-lg bg-amber-500/10 hover:bg-amber-500/20 text-amber-300 border border-amber-500/30 text-xs font-semibold flex items-center gap-1.5 transition">
                                <i class="fa-solid fa-pen text-[10px]"></i>
                                <span>Edit</span>
                            </button>

                            <!-- Delete Button -->
                            <button type="button" 
                                onclick="triggerDeleteModal('{{ route('admin.categories.destroy', $category->id) }}', 'Category: {{ addslashes($category->name) }} (and all its associated products)')"
                                class="px-3 py-1.5 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/30 text-xs font-semibold flex items-center gap-1.5 transition">
                                <i class="fa-regular fa-trash-can text-[10px]"></i>
                                <span>Delete</span>
                            </button>
                        </div>

                    </div>
                @empty
                    <div class="col-span-2 text-center py-12 text-slate-500">
                        No categories found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

<!-- EDIT CATEGORY MODAL -->
<div id="edit-category-modal" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-md hidden items-center justify-center p-4">
    <div class="bg-slate-900 border border-slate-700 rounded-3xl p-5 sm:p-7 max-w-lg w-full shadow-2xl space-y-4 animate-in fade-in zoom-in-95 duration-200">
        
        <div class="flex items-center justify-between border-b border-slate-800 pb-3">
            <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                <h3 class="font-serif font-bold text-lg text-slate-100">Edit Category</h3>
            </div>
            <button type="button" onclick="closeEditCategoryModal()" class="text-slate-400 hover:text-white p-1 rounded-lg">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form id="edit-category-form" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                    Category Name <span class="text-amber-400">*</span>
                </label>
                <input type="text" id="edit-name" name="name" required
                    class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                    Description
                </label>
                <textarea id="edit-description" name="description" rows="2"
                    class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 focus:outline-none focus:ring-2 focus:ring-amber-500 resize-none"></textarea>
            </div>

            <!-- Cover Image (Upload or URL) -->
            <div class="space-y-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300">
                    Update Cover Image
                </label>

                <div class="p-3 rounded-xl bg-slate-950 border border-dashed border-slate-700 text-center hover:border-amber-500/50 transition">
                    <label class="cursor-pointer flex flex-col items-center justify-center gap-1">
                        <i class="fa-solid fa-cloud-arrow-up text-amber-400 text-base"></i>
                        <span class="text-[11px] font-semibold text-slate-300">Upload New File</span>
                        <input type="file" name="image_file" accept="image/*" class="hidden" onchange="previewEditImage(this)">
                    </label>
                    <div id="edit-file-name" class="text-[10px] text-amber-300 font-mono mt-1 hidden"></div>
                </div>

                <div>
                    <span class="text-[10px] uppercase font-semibold text-slate-400 block mb-1">Or Image URL:</span>
                    <input type="url" id="edit-image-url" name="image" placeholder="https://..."
                        oninput="previewEditUrl(this.value)"
                        class="w-full px-4 py-2 bg-slate-800 border border-slate-700 rounded-xl text-xs text-slate-100 focus:outline-none focus:ring-1 focus:ring-amber-500">
                </div>

                <!-- Preview Current / New Image -->
                <div id="edit-preview-container" class="mt-2 p-2 rounded-xl bg-slate-950 border border-slate-800 flex items-center gap-3">
                    <img id="edit-preview-img" src="" alt="Cover" class="w-12 h-12 rounded-lg object-cover border border-slate-700">
                    <span class="text-xs text-slate-300 font-medium">Cover Image Preview</span>
                </div>
            </div>

            <div class="pt-2 flex items-center gap-3">
                <button type="button" onclick="closeEditCategoryModal()"
                    class="w-1/2 py-2.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-bold transition">
                    Cancel
                </button>
                <button type="submit"
                    class="w-1/2 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 text-slate-950 text-xs font-bold uppercase tracking-wider shadow-md shadow-amber-500/20 transition">
                    Save Changes
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    // Preview Add Form Image File
    function previewAddImage(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            document.getElementById('add-file-name').textContent = file.name;
            document.getElementById('add-file-name').classList.remove('hidden');

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('add-preview-img').src = e.target.result;
                document.getElementById('add-preview-container').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    // Preview Add Form URL
    function previewAddUrl(url) {
        if (url && url.trim() !== '') {
            document.getElementById('add-preview-img').src = url;
            document.getElementById('add-preview-container').classList.remove('hidden');
        }
    }

    // Open Edit Category Modal
    function openEditCategoryModal(id, name, description, image) {
        const form = document.getElementById('edit-category-form');
        form.action = `/admin/categories/${id}`;

        document.getElementById('edit-name').value = name;
        document.getElementById('edit-description').value = description;
        document.getElementById('edit-image-url').value = image;

        if (image && image.trim() !== '') {
            document.getElementById('edit-preview-img').src = image;
            document.getElementById('edit-preview-container').classList.remove('hidden');
        } else {
            document.getElementById('edit-preview-container').classList.add('hidden');
        }

        const modal = document.getElementById('edit-category-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditCategoryModal() {
        const modal = document.getElementById('edit-category-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Preview Edit Form Image File
    function previewEditImage(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            document.getElementById('edit-file-name').textContent = file.name;
            document.getElementById('edit-file-name').classList.remove('hidden');

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('edit-preview-img').src = e.target.result;
                document.getElementById('edit-preview-container').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    // Preview Edit Form URL
    function previewEditUrl(url) {
        if (url && url.trim() !== '') {
            document.getElementById('edit-preview-img').src = url;
            document.getElementById('edit-preview-container').classList.remove('hidden');
        }
    }
</script>
@endsection
