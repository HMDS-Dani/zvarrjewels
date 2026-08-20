@extends('admin.layout')

@section('title', 'Customer Reviews & Feedback')
@section('header_title', 'Customer Reviews')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Header Banner -->
    <div class="p-5 sm:p-7 rounded-2xl sm:rounded-3xl bg-slate-900 border border-slate-800 shadow-xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                <h3 class="font-serif font-bold text-lg sm:text-xl text-slate-100">Client Reviews Moderation</h3>
            </div>
            <p class="text-xs text-slate-400">
                Verified customer testimonials displayed across product pages and storefront.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <span class="px-3.5 py-2 rounded-xl bg-amber-400/10 text-amber-300 border border-amber-400/20 text-xs font-bold font-mono">
                {{ $reviews->total() }} Total Reviews
            </span>

            <button type="button" onclick="openAddReviewModal()"
                class="px-4 py-2 bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 text-slate-950 text-xs font-bold uppercase tracking-wider rounded-xl shadow-md shadow-amber-500/20 transition flex items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                <span>Add Review</span>
            </button>
        </div>
    </div>

    <!-- Reviews Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
        @forelse($reviews as $review)
            <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800 flex flex-col justify-between gap-4 relative group hover:border-slate-700 transition">
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex text-amber-400 text-xs gap-0.5">
                            @for($i = 1; $i <= $review->rating; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                        <span class="text-[10px] text-slate-500 font-mono">{{ $review->created_at->format('M d, Y') }}</span>
                    </div>

                    @if($review->product)
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-slate-950 text-amber-300 text-[10px] font-semibold border border-slate-800">
                            <i class="fa-solid fa-gem text-[8px]"></i>
                            <span class="truncate max-w-[180px]">{{ $review->product->name }}</span>
                        </div>
                    @else
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-slate-950 text-stone-400 text-[10px] font-semibold border border-slate-800">
                            <i class="fa-solid fa-store text-[8px]"></i>
                            <span>Storefront General</span>
                        </div>
                    @endif

                    <p class="text-xs text-slate-200 leading-relaxed font-light">
                        "{{ $review->comment }}"
                    </p>
                </div>

                <div class="pt-3 border-t border-slate-800 flex items-center justify-between">
                    <div>
                        <h5 class="font-bold text-slate-200 text-xs">{{ $review->name }}</h5>
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] text-slate-500">{{ $review->city ?? 'Pakistan' }}</span>
                            @if($review->is_verified_buyer)
                                <span class="text-[9px] text-emerald-400 font-semibold bg-emerald-500/10 px-1.5 py-0.2 rounded border border-emerald-500/20">Verified</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-1.5">
                        <button type="button" 
                            onclick="openEditReviewModal({{ json_encode($review) }})"
                            class="p-2 rounded-lg bg-amber-500/10 hover:bg-amber-500/20 text-amber-300 text-xs transition"
                            title="Edit Review">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        <button type="button" 
                            onclick="triggerDeleteModal('{{ route('admin.reviews.destroy', $review->id) }}', 'Review by {{ addslashes($review->name) }}')"
                            class="p-2 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 text-xs transition"
                            title="Delete Review">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-3 text-center py-16 bg-slate-900 rounded-3xl border border-slate-800 text-slate-500">
                <i class="fa-regular fa-star text-4xl mb-3 text-slate-600"></i>
                <p class="text-sm font-semibold">No reviews submitted yet.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $reviews->links() }}
    </div>

</div>

<!-- 1. ADD NEW REVIEW MODAL -->
<div id="add-review-modal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-md hidden items-center justify-center p-4">
    <div class="bg-slate-900 border border-slate-700 rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-4">
        <div class="flex items-center justify-between border-b border-slate-800 pb-3">
            <div>
                <h3 class="font-serif font-bold text-lg text-white">Add Customer Review</h3>
                <p class="text-xs text-slate-400">Create a verified client testimonial</p>
            </div>
            <button type="button" onclick="closeAddReviewModal()" class="text-slate-400 hover:text-white p-1">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form action="{{ route('admin.reviews.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">Attach to Product (Optional)</label>
                <select name="product_id" class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 focus:outline-none focus:ring-1 focus:ring-amber-400">
                    <option value="">-- General Storefront Review --</option>
                    @foreach($products as $prod)
                        <option value="{{ $prod->id }}">{{ $prod->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">Reviewer Name <span class="text-amber-400">*</span></label>
                    <input type="text" name="name" required placeholder="e.g. Mahnoor Ali"
                        class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-amber-400">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">City / Location</label>
                    <input type="text" name="city" placeholder="e.g. Lahore, Karachi"
                        class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-amber-400">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">Star Rating (1 - 5) <span class="text-amber-400">*</span></label>
                <select name="rating" class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-amber-400 font-bold focus:outline-none focus:ring-1 focus:ring-amber-400">
                    <option value="5" selected>⭐⭐⭐⭐⭐ (5 Stars - Excellent)</option>
                    <option value="4">⭐⭐⭐⭐ (4 Stars - Very Good)</option>
                    <option value="3">⭐⭐⭐ (3 Stars - Good)</option>
                    <option value="2">⭐⭐ (2 Stars - Fair)</option>
                    <option value="1">⭐ (1 Star - Poor)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">Review Feedback <span class="text-amber-400">*</span></label>
                <textarea name="comment" rows="3" required placeholder="Enter customer testimonial..."
                    class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-amber-400 resize-none"></textarea>
            </div>

            <div class="flex items-center gap-6 pt-1">
                <label class="flex items-center gap-2 text-xs font-semibold text-slate-300 cursor-pointer">
                    <input type="checkbox" name="is_verified_buyer" value="1" checked class="w-4 h-4 rounded text-amber-500 bg-slate-800 border-slate-700 focus:ring-0">
                    <span>Verified Buyer Badge</span>
                </label>
                <label class="flex items-center gap-2 text-xs font-semibold text-slate-300 cursor-pointer">
                    <input type="checkbox" name="is_approved" value="1" checked class="w-4 h-4 rounded text-amber-500 bg-slate-800 border-slate-700 focus:ring-0">
                    <span>Publish Immediately</span>
                </label>
            </div>

            <div class="pt-2 flex items-center gap-3">
                <button type="button" onclick="closeAddReviewModal()" class="w-1/2 py-2.5 rounded-xl bg-slate-800 text-slate-300 text-xs font-bold">Cancel</button>
                <button type="submit" class="w-1/2 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 text-slate-950 text-xs font-bold uppercase tracking-wider shadow-md">Add Review</button>
            </div>
        </form>
    </div>
</div>

<!-- 2. EDIT REVIEW MODAL -->
<div id="edit-review-modal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-md hidden items-center justify-center p-4">
    <div class="bg-slate-900 border border-slate-700 rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-4">
        <div class="flex items-center justify-between border-b border-slate-800 pb-3">
            <div>
                <h3 class="font-serif font-bold text-lg text-white">Edit Customer Review</h3>
                <p class="text-xs text-slate-400">Modify review details & rating</p>
            </div>
            <button type="button" onclick="closeEditReviewModal()" class="text-slate-400 hover:text-white p-1">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>

        <form id="edit-review-form" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">Attach to Product (Optional)</label>
                <select name="product_id" id="edit_product_id" class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 focus:outline-none focus:ring-1 focus:ring-amber-400">
                    <option value="">-- General Storefront Review --</option>
                    @foreach($products as $prod)
                        <option value="{{ $prod->id }}">{{ $prod->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">Reviewer Name <span class="text-amber-400">*</span></label>
                    <input type="text" name="name" id="edit_name" required
                        class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 focus:outline-none focus:ring-1 focus:ring-amber-400">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">City / Location</label>
                    <input type="text" name="city" id="edit_city"
                        class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 focus:outline-none focus:ring-1 focus:ring-amber-400">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">Star Rating (1 - 5) <span class="text-amber-400">*</span></label>
                <select name="rating" id="edit_rating" class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-amber-400 font-bold focus:outline-none focus:ring-1 focus:ring-amber-400">
                    <option value="5">⭐⭐⭐⭐⭐ (5 Stars - Excellent)</option>
                    <option value="4">⭐⭐⭐⭐ (4 Stars - Very Good)</option>
                    <option value="3">⭐⭐⭐ (3 Stars - Good)</option>
                    <option value="2">⭐⭐ (2 Stars - Fair)</option>
                    <option value="1">⭐ (1 Star - Poor)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">Review Feedback <span class="text-amber-400">*</span></label>
                <textarea name="comment" id="edit_comment" rows="3" required
                    class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-xl text-xs sm:text-sm text-slate-100 focus:outline-none focus:ring-1 focus:ring-amber-400 resize-none"></textarea>
            </div>

            <div class="flex items-center gap-6 pt-1">
                <label class="flex items-center gap-2 text-xs font-semibold text-slate-300 cursor-pointer">
                    <input type="checkbox" name="is_verified_buyer" id="edit_is_verified" value="1" class="w-4 h-4 rounded text-amber-500 bg-slate-800 border-slate-700 focus:ring-0">
                    <span>Verified Buyer Badge</span>
                </label>
                <label class="flex items-center gap-2 text-xs font-semibold text-slate-300 cursor-pointer">
                    <input type="checkbox" name="is_approved" id="edit_is_approved" value="1" class="w-4 h-4 rounded text-amber-500 bg-slate-800 border-slate-700 focus:ring-0">
                    <span>Published</span>
                </label>
            </div>

            <div class="pt-2 flex items-center gap-3">
                <button type="button" onclick="closeEditReviewModal()" class="w-1/2 py-2.5 rounded-xl bg-slate-800 text-slate-300 text-xs font-bold">Cancel</button>
                <button type="submit" class="w-1/2 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-400 text-slate-950 text-xs font-bold uppercase tracking-wider shadow-md">Update Review</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddReviewModal() {
        const modal = document.getElementById('add-review-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeAddReviewModal() {
        const modal = document.getElementById('add-review-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function openEditReviewModal(review) {
        document.getElementById('edit-review-form').action = `/admin/reviews/${review.id}`;
        document.getElementById('edit_name').value = review.name || '';
        document.getElementById('edit_city').value = review.city || '';
        document.getElementById('edit_rating').value = review.rating || 5;
        document.getElementById('edit_comment').value = review.comment || '';
        document.getElementById('edit_product_id').value = review.product_id || '';
        document.getElementById('edit_is_verified').checked = !!review.is_verified_buyer;
        document.getElementById('edit_is_approved').checked = !!review.is_approved;

        const modal = document.getElementById('edit-review-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEditReviewModal() {
        const modal = document.getElementById('edit-review-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
