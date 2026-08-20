@extends('shop.layout')

@section('title', 'Contact Customer Concierge | ZVARR by Zaiyal')

@section('content')

<style>
    /* Radial Deep Luxury Vignette */
    .bg-obsidian-contact {
        background: radial-gradient(circle at 50% 20%, #17151b 0%, #0d0c11 50%, #040405 100%);
    }
    .luxury-contact-card {
        background: linear-gradient(180deg, #16151e 0%, #0b0a10 40%, #030305 100%);
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 16px 36px -8px rgba(0, 0, 0, 0.85), inset 0 1px 0 rgba(255, 255, 255, 0.12);
    }
</style>

<div class="bg-obsidian-contact min-h-screen pt-20 sm:pt-28 pb-20 text-white relative overflow-hidden">
    
    <!-- Ambient Glow Flare -->
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 w-[550px] h-[550px] bg-amber-500/5 rounded-full blur-[140px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-12 sm:space-y-16">
        
        <!-- 1. HEADER SECTION -->
        <div class="text-center max-w-2xl mx-auto space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-black/70 border border-amber-400/30 text-amber-300 text-[10px] font-bold uppercase tracking-[0.25em] backdrop-blur-md">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                <span>Customer Concierge</span>
            </div>

            <h1 class="text-3xl sm:text-5xl font-serif-luxury font-normal text-white">
                We're Here to <span class="text-amber-300 font-serif-luxury italic">Assist</span> You
            </h1>

            <p class="text-xs sm:text-sm text-stone-300 font-light leading-relaxed">
                Have a question about ring sizing, custom gifting, or an ongoing order? Connect directly with our concierge team across Pakistan.
            </p>
        </div>

        <!-- 2. CONTACT CHANNELS GRID (Dynamic from CRM) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
            
            <!-- WhatsApp Card -->
            @if(!empty($storeSettings['whatsapp_number']))
                <a href="https://wa.me/{{ $storeSettings['whatsapp_number'] }}?text={{ urlencode($storeSettings['whatsapp_greeting'] ?? 'Hi ZVARR by Zaiyal! I want to inquire about your jewellery.') }}" 
                    target="_blank"
                    class="p-6 rounded-3xl luxury-contact-card space-y-3 block group hover:border-emerald-500/50 transition">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 flex items-center justify-center text-2xl group-hover:scale-110 transition">
                        <i class="fa-brands fa-whatsapp"></i>
                    </div>
                    <h4 class="font-serif font-bold text-base text-stone-100 group-hover:text-emerald-300 transition">WhatsApp Concierge</h4>
                    <p class="text-xs text-stone-400 font-light leading-relaxed">
                        Instant replies for fast orders & video previews of items.
                    </p>
                    <span class="inline-flex items-center gap-1.5 text-xs text-emerald-400 font-semibold pt-1">
                        <span>Chat Now</span>
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition"></i>
                    </span>
                </a>
            @endif

            <!-- Instagram Card -->
            @if(!empty($storeSettings['instagram_url']))
                <a href="{{ $storeSettings['instagram_url'] }}" 
                    target="_blank"
                    class="p-6 rounded-3xl luxury-contact-card space-y-3 block group hover:border-amber-400/50 transition">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-400 border border-rose-500/20 flex items-center justify-center text-2xl group-hover:scale-110 transition">
                        <i class="fa-brands fa-instagram"></i>
                    </div>
                    <h4 class="font-serif font-bold text-base text-stone-100 group-hover:text-amber-300 transition">Instagram Stories</h4>
                    <p class="text-xs text-stone-400 font-light leading-relaxed">
                        Daily dispatch unboxing, packaging reels & client tags.
                    </p>
                    <span class="inline-flex items-center gap-1.5 text-xs text-amber-400 font-semibold pt-1">
                        <span>@zvarrjewelspk</span>
                        <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition"></i>
                    </span>
                </a>
            @endif

            <!-- Email Card -->
            <a href="mailto:{{ $storeSettings['email'] ?? 'contact@zvarr.com' }}" 
                class="p-6 rounded-3xl luxury-contact-card space-y-3 block group hover:border-blue-500/50 transition">
                <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-400 border border-blue-500/20 flex items-center justify-center text-xl group-hover:scale-110 transition">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <h4 class="font-serif font-bold text-base text-stone-100 group-hover:text-blue-300 transition">Email Inquiries</h4>
                <p class="text-xs text-stone-400 font-light leading-relaxed">
                    {{ $storeSettings['email'] ?? 'contact@zvarr.com' }}
                </p>
                <span class="inline-flex items-center gap-1.5 text-xs text-blue-400 font-semibold pt-1">
                    <span>Send Email</span>
                    <i class="fa-solid fa-arrow-right text-[10px] group-hover:translate-x-1 transition"></i>
                </span>
            </a>

            <!-- Dispatch Hub Card -->
            <div class="p-6 rounded-3xl luxury-contact-card space-y-3">
                <div class="w-12 h-12 rounded-2xl bg-amber-400/10 text-amber-400 border border-amber-400/20 flex items-center justify-center text-xl">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                <h4 class="font-serif font-bold text-base text-stone-100">Pan-Pakistan Dispatch</h4>
                <p class="text-xs text-stone-400 font-light leading-relaxed">
                    {{ $storeSettings['address'] ?? 'Karachi, Pakistan' }} • 2-4 Days Fast Delivery with Open Parcel Inspection.
                </p>
                <span class="inline-flex items-center gap-1.5 text-xs text-amber-300 font-semibold pt-1">
                    <span>COD Available</span>
                </span>
            </div>

        </div>

        <!-- 3. DIRECT MESSAGE CONCIERGE FORM -->
        <div class="max-w-3xl mx-auto p-6 sm:p-10 rounded-3xl luxury-contact-card space-y-6">
            <div class="text-center space-y-1">
                <h3 class="font-serif font-bold text-xl sm:text-2xl text-stone-100">Send an Instant Message</h3>
                <p class="text-xs text-stone-400 font-light">Fill out the form below and our team will get in touch via WhatsApp or email.</p>
            </div>

            <!-- Inline Success Toast Banner (Hidden by default) -->
            <div id="contact-success-msg" class="hidden p-4 rounded-2xl bg-emerald-950/70 border border-emerald-500/40 text-emerald-300 text-xs sm:text-sm font-semibold flex items-center gap-2.5 shadow-xl">
                <i class="fa-solid fa-circle-check text-emerald-400 text-base"></i>
                <span>Thank you! Your message has been received. Our team will contact you shortly.</span>
            </div>

            <form id="contact-form" onsubmit="handleContactSubmit(event)" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-300 mb-1.5">
                            Your Full Name <span class="text-amber-400">*</span>
                        </label>
                        <input type="text" id="contact_name" name="name" required placeholder="e.g. Ayesha Khan"
                            class="w-full px-4 py-2.5 bg-black/60 border border-white/10 rounded-xl text-xs sm:text-sm text-stone-100 placeholder-stone-600 focus:outline-none focus:ring-1 focus:ring-amber-400">
                    </div>

                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-300 mb-1.5">
                            WhatsApp / Phone Number <span class="text-amber-400">*</span>
                        </label>
                        <input type="text" id="contact_phone" name="phone" required placeholder="0300 1234567"
                            class="w-full px-4 py-2.5 bg-black/60 border border-white/10 rounded-xl text-xs sm:text-sm text-stone-100 placeholder-stone-600 focus:outline-none focus:ring-1 focus:ring-amber-400 font-mono">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-300 mb-1.5">
                        Inquiry Topic
                    </label>
                    <select id="contact_topic" name="topic"
                        class="w-full px-4 py-2.5 bg-black/60 border border-white/10 rounded-xl text-xs sm:text-sm text-stone-200 focus:outline-none focus:ring-1 focus:ring-amber-400">
                        <option value="Product Sizing & Details">Product Sizing & Details</option>
                        <option value="Order Tracking & Dispatch">Order Tracking & Dispatch</option>
                        <option value="Custom Gift Box Packing">Custom Gift Box Packaging</option>
                        <option value="Wholesale / Partnership">Wholesale / Partnership</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-300 mb-1.5">
                        Message / Query <span class="text-amber-400">*</span>
                    </label>
                    <textarea id="contact_message" name="message" rows="3" required placeholder="How can we help you today?..."
                        class="w-full px-4 py-2.5 bg-black/60 border border-white/10 rounded-xl text-xs sm:text-sm text-stone-100 placeholder-stone-600 focus:outline-none focus:ring-1 focus:ring-amber-400 resize-none"></textarea>
                </div>

                <button type="submit" id="contact-submit-btn"
                    class="w-full py-3.5 bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-600 hover:from-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-amber-500/20 transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-paper-plane text-sm"></i>
                    <span>Send Message</span>
                </button>
            </form>
        </div>

    </div>
</div>

<!-- LUXURY SUCCESS MODAL POPUP -->
<div id="inquiry-success-modal" class="fixed inset-0 z-50 bg-black/85 backdrop-blur-md hidden items-center justify-center p-4">
    <div class="glass-card-3d bg-slate-900 border border-amber-400/30 rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl text-center space-y-4 animate-in fade-in zoom-in-95 duration-200">
        
        <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 border border-emerald-500/40 text-emerald-400 flex items-center justify-center text-2xl mx-auto shadow-lg shadow-emerald-500/20">
            <i class="fa-solid fa-circle-check"></i>
        </div>

        <div class="space-y-1.5">
            <h3 class="font-serif-luxury font-normal text-2xl text-white">Message Received</h3>
            <p class="text-xs text-stone-300 font-light leading-relaxed">
                Thank you for contacting <strong>ZVARR by Zaiyal</strong>. Our customer concierge team has registered your query and will get back to you shortly.
            </p>
        </div>

        <div class="pt-2">
            <button type="button" onclick="closeSuccessModal()"
                class="w-full py-3 bg-gradient-to-r from-amber-500 via-amber-400 to-yellow-600 hover:from-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg transition">
                Continue Browsing
            </button>
        </div>

    </div>
</div>

<script>
    function closeSuccessModal() {
        const modal = document.getElementById('inquiry-success-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    async function handleContactSubmit(e) {
        e.preventDefault();
        const submitBtn = document.getElementById('contact-submit-btn');
        const name = document.getElementById('contact_name').value;
        const phone = document.getElementById('contact_phone').value;
        const topic = document.getElementById('contact_topic').value;
        const msg = document.getElementById('contact_message').value;

        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin text-sm"></i> <span>Sending Message...</span>';

        try {
            // Save to CRM Database via AJAX
            const response = await fetch("{{ route('contact.inquiry') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    name: name,
                    phone: phone,
                    topic: topic,
                    message: msg
                })
            });

            if (response.ok) {
                // Show Success Modal
                const modal = document.getElementById('inquiry-success-modal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');

                document.getElementById('contact-form').reset();
            }
        } catch (error) {
            console.error("Error submitting inquiry:", error);
            document.getElementById('contact-success-msg').classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fa-solid fa-paper-plane text-sm"></i> <span>Send Message</span>';
        }
    }
</script>
@endsection
