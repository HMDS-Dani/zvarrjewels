@extends('admin.layout')

@section('title', 'Client Testimonials & Reviews')
@section('header_title', 'Client Testimonials & Reviews')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Header Banner -->
    <div class="glass-card-luxury p-5 sm:p-7 rounded-3xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2.5 mb-1">
                <span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span>
                <h3 class="font-cinzel font-bold text-lg sm:text-xl text-white">Client Testimonials & Feedback</h3>
            </div>
            <p class="text-xs text-stone-400">
                Verified luxury customer reviews displayed across boutique showcase and product pages.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <span class="px-3.5 py-2 rounded-2xl bg-amber-400/10 text-amber-300 border border-amber-400/30 text-xs font-bold font-mono">
                {{ $reviews->total() }} Total Reviews
            </span>

            <button type="button" onclick="openAddReviewModal()"
                class="px-5 py-2.5 bg-gradient-to-r from-amber-300 via-amber-400 to-amber-500 hover:from-amber-200 hover:to-amber-400 text-slate-950 text-xs font-bold uppercase tracking-wider rounded-2xl shadow-lg shadow-amber-500/20 transition transform hover:-translate-y-0.5 active:scale-95 flex items-center gap-2">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Add Review</span>
            </button>
        </div>
    </div>

    <!-- Reviews Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        @forelse($reviews as $review)
            <div class="glass-card-luxury p-5 sm:p-6 rounded-3xl flex flex-col justify-between gap-4 relative group hover:border-amber-400/35 transition duration-200">
                
                <div class="space-y-3.5">
                    <div class="flex items-center justify-between">
                        <div class="flex text-amber-400 text-xs gap-1 drop-shadow-sm">
                            @for($i = 1; $i <= $review->rating; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                        <span class="text-[10px] text-stone-500 font-mono">{{ $review->created_at->format('M d, Y') }}</span>
                    </div>

                    @if($review->product)
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-[#08080d] text-amber-300 text-[10.5px] font-semibold border border-amber-400/20">
                            <i class="fa-solid fa-gem text-[9px] text-amber-400"></i>
                            <span class="truncate max-w-[180px]">{{ $review->product->name }}</span>
                        </div>
                    @else
                        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-[#08080d] text-stone-400 text-[10.5px] font-semibold border border-white/5">
                            <i class="fa-solid fa-store text-[9px]"></i>
                            <span>Storefront Overall</span>
                        </div>
                    @endif

                    <div class="p-3.5 rounded-2xl bg-[#08080d] border border-white/5">
                        <p class="text-xs text-stone-200 leading-relaxed font-light italic">
                            "{{ $review->comment }}"
                        </p>
                    </div>
                </div>

                <div class="pt-3 border-t border-white/5 flex items-center justify-between">
                    <div>
                        <h5 class="font-bold text-white text-xs">{{ $review->name }}</h5>
                        <div class="flex items-center gap-2 mt-0.5">
                            <span class="text-[10px] text-stone-400">{{ $review->city ?? 'Pakistan' }}</span>
                            @if($review->is_verified_buyer)
                                <span class="text-[9px] text-emerald-300 font-bold bg-emerald-500/10 px-2 py-0.5 rounded-full border border-emerald-500/30">Verified</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="button" 
                            onclick="openEditReviewModal({{ json_encode($review) }})"
                            class="p-2 rounded-xl bg-amber-400/10 hover:bg-amber-400/20 text-amber-300 text-xs border border-amber-400/30 transition"
                            title="Edit Review">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        <button type="button" 
                            onclick="triggerDeleteModal('{{ route('admin.reviews.destroy', $review->id) }}', 'Review by {{ addslashes($review->name) }}')"
                            class="p-2 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 border border-rose-500/30 text-xs transition"
                            title="Delete Review">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-3 text-center py-16 glass-card-luxury rounded-3xl text-stone-500 space-y-2">
                <i class="fa-regular fa-star text-4xl mb-2 text-stone-600"></i>
                <p class="text-sm font-semibold text-stone-400">No client reviews registered yet.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $reviews->links() }}
    </div>

</div>

<!-- 1. ADD NEW REVIEW MODAL -->
<div id="add-review-modal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-xl hidden items-center justify-center p-4">
    <div class="glass-card-luxury rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-4 border border-amber-400/30">
        <div class="flex items-center justify-between border-b border-white/10 pb-3">
            <div>
                <h3 class="font-cinzel font-bold text-lg text-white">Add Customer Review</h3>
                <p class="text-xs text-stone-400">Create a verified client testimonial</p>
            </div>
            <button type="button" onclick="closeAddReviewModal()" class="w-8 h-8 rounded-xl bg-white/5 text-stone-400 hover:text-white flex items-center justify-center text-sm border border-white/10">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ route('admin.reviews.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-1.5">Attach to Product (Optional)</label>
                <select name="product_id" class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    <option value="">-- General Storefront Review --</option>
                    @foreach($products as $prod)
                        <option value="{{ $prod->id }}">{{ $prod->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-1.5">Reviewer Name <span class="text-amber-400">*</span></label>
                    <input type="text" name="name" required placeholder="e.g. Mahnoor Ali"
                        class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-1.5">City / Location</label>
                    <input type="text" name="city" placeholder="e.g. Lahore, Karachi"
                        class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-1.5">Star Rating (1 - 5) <span class="text-amber-400">*</span></label>
                <select name="rating" class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-amber-300 font-bold focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    <option value="5">★★★★★ (5 Stars - Exceptional)</option>
                    <option value="4">★★★★☆ (4 Stars - Great)</option>
                    <option value="3">★★★☆☆ (3 Stars - Good)</option>
                    <option value="2">★★☆☆☆ (2 Stars - Average)</option>
                    <option value="1">★☆☆☆☆ (1 Star - Poor)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-1.5">Review Comment <span class="text-amber-400">*</span></label>
                <textarea name="comment" rows="3" required placeholder="Write the customer's testimonial..."
                    class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white placeholder-stone-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition resize-none"></textarea>
            </div>

            <div class="flex items-center gap-3 p-3 rounded-2xl bg-[#08080d] border border-white/5">
                <input type="checkbox" name="is_verified_buyer" value="1" checked id="add_verified" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400">
                <label for="add_verified" class="text-xs font-semibold text-stone-200 cursor-pointer">Mark as Verified Boutique Buyer</label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-white/10">
                <button type="button" onclick="closeAddReviewModal()" class="px-5 py-2.5 bg-white/5 hover:bg-white/10 text-stone-300 rounded-2xl text-xs font-bold transition">
                    Cancel
                </button>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-amber-300 via-amber-400 to-amber-500 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-2xl shadow-lg shadow-amber-500/20 transition">
                    Submit Review
                </button>
            </div>
        </form>
    </div>
</div>

<!-- 2. EDIT REVIEW MODAL -->
<div id="edit-review-modal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-xl hidden items-center justify-center p-4">
    <div class="glass-card-luxury rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-4 border border-amber-400/30">
        <div class="flex items-center justify-between border-b border-white/10 pb-3">
            <div>
                <h3 class="font-cinzel font-bold text-lg text-white">Edit Customer Review</h3>
                <p class="text-xs text-stone-400">Modify client rating and comment</p>
            </div>
            <button type="button" onclick="closeEditReviewModal()" class="w-8 h-8 rounded-xl bg-white/5 text-stone-400 hover:text-white flex items-center justify-center text-sm border border-white/10">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form id="edit-review-form" action="" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-1.5">Attach to Product (Optional)</label>
                <select name="product_id" id="edit_product_id" class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    <option value="">-- General Storefront Review --</option>
                    @foreach($products as $prod)
                        <option value="{{ $prod->id }}">{{ $prod->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-1.5">Reviewer Name <span class="text-amber-400">*</span></label>
                    <input type="text" name="name" id="edit_name" required
                        class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-1.5">City / Location</label>
                    <input type="text" name="city" id="edit_city"
                        class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-1.5">Star Rating (1 - 5) <span class="text-amber-400">*</span></label>
                <select name="rating" id="edit_rating" class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-amber-300 font-bold focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    <option value="5">★★★★★ (5 Stars - Exceptional)</option>
                    <option value="4">★★★★☆ (4 Stars - Great)</option>
                    <option value="3">★★★☆☆ (3 Stars - Good)</option>
                    <option value="2">★★☆☆☆ (2 Stars - Average)</option>
                    <option value="1">★☆☆☆☆ (1 Star - Poor)</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-stone-300 mb-1.5">Review Comment <span class="text-amber-400">*</span></label>
                <textarea name="comment" id="edit_comment" rows="3" required
                    class="w-full px-4 py-3 bg-[#0a0a10] border border-white/10 rounded-2xl text-xs sm:text-sm text-white focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition resize-none"></textarea>
            </div>

            <div class="flex items-center gap-3 p-3 rounded-2xl bg-[#08080d] border border-white/5">
                <input type="checkbox" name="is_verified_buyer" value="1" id="edit_verified" class="w-4 h-4 rounded text-amber-400 focus:ring-amber-400">
                <label for="edit_verified" class="text-xs font-semibold text-stone-200 cursor-pointer">Mark as Verified Boutique Buyer</label>
            </div>

            <div class="flex items-center justify-end gap-3 pt-3 border-t border-white/10">
                <button type="button" onclick="closeEditReviewModal()" class="px-5 py-2.5 bg-white/5 hover:bg-white/10 text-stone-300 rounded-2xl text-xs font-bold transition">
                    Cancel
                </button>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-amber-300 via-amber-400 to-amber-500 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-2xl shadow-lg shadow-amber-500/20 transition">
                    Save Changes
                </button>
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
        const modal = document.getElementById('edit-review-modal');
        const form = document.getElementById('edit-review-form');
        form.action = `/admin/reviews/${review.id}`;
        
        document.getElementById('edit_product_id').value = review.product_id || '';
        document.getElementById('edit_name').value = review.name;
        document.getElementById('edit_city').value = review.city || '';
        document.getElementById('edit_rating').value = review.rating;
        document.getElementById('edit_comment').value = review.comment;
        document.getElementById('edit_verified').checked = review.is_verified_buyer ? true : false;

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
