@extends('admin.layout')

@section('title', 'Customer Inquiries & Messages')
@section('header_title', 'Inquiries & Messages')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Header Banner -->
    <div class="p-5 sm:p-7 rounded-2xl sm:rounded-3xl bg-slate-900 border border-slate-800 shadow-xl flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                <h3 class="font-serif font-bold text-lg sm:text-xl text-slate-100">Customer Messages Hub</h3>
            </div>
            <p class="text-xs text-slate-400">
                Inquiries and customer queries submitted through the Contact Us storefront form.
            </p>
        </div>

        <div class="flex items-center gap-3">
            @if($newCount > 0)
                <span class="px-3 py-1.5 rounded-xl bg-rose-500/20 text-rose-300 border border-rose-500/30 text-xs font-bold flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-rose-400 animate-ping"></span>
                    <span>{{ $newCount }} New Messages</span>
                </span>
            @endif
            <span class="px-3.5 py-1.5 rounded-xl bg-amber-400/10 text-amber-300 border border-amber-400/20 text-xs font-bold font-mono">
                {{ $inquiries->total() }} Total
            </span>
        </div>
    </div>

    <!-- Inquiries List Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-5">
        @forelse($inquiries as $inquiry)
            @php
                $cleanPhone = preg_replace('/[^0-9]/', '', $inquiry->phone);
                if (str_starts_with($cleanPhone, '03')) {
                    $cleanPhone = '92' . substr($cleanPhone, 1);
                }
            @endphp
            <div class="p-5 sm:p-6 rounded-2xl bg-slate-900 border {{ $inquiry->status === 'new' ? 'border-amber-500/40 bg-amber-500/[0.02]' : 'border-slate-800' }} flex flex-col justify-between gap-4 relative group hover:border-slate-700 transition">
                
                <div class="space-y-3">
                    <!-- Card Top: Name, Status & Date -->
                    <div class="flex items-start justify-between gap-2">
                        <div class="flex items-center gap-2.5">
                            <div class="w-9 h-9 rounded-xl bg-amber-500/10 text-amber-300 border border-amber-500/20 flex items-center justify-center font-serif font-bold text-sm">
                                {{ substr($inquiry->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-100 text-sm">{{ $inquiry->name }}</h4>
                                <span class="text-xs text-slate-400 font-mono flex items-center gap-1">
                                    <i class="fa-solid fa-phone text-[10px] text-amber-400"></i>
                                    {{ $inquiry->phone }}
                                </span>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        @if($inquiry->status === 'new')
                            <span class="px-2.5 py-0.5 rounded-full bg-rose-500/15 text-rose-400 border border-rose-500/30 text-[10px] font-bold uppercase tracking-wider">
                                New
                            </span>
                        @elseif($inquiry->status === 'contacted')
                            <span class="px-2.5 py-0.5 rounded-full bg-blue-500/15 text-blue-400 border border-blue-500/30 text-[10px] font-bold uppercase tracking-wider">
                                Contacted
                            </span>
                        @else
                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/15 text-emerald-400 border border-emerald-500/30 text-[10px] font-bold uppercase tracking-wider">
                                Resolved
                            </span>
                        @endif
                    </div>

                    <!-- Topic Badge -->
                    @if($inquiry->topic)
                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-slate-950 text-amber-300 text-[11px] font-semibold border border-slate-800">
                            <i class="fa-solid fa-tag text-[9px] text-amber-400"></i>
                            <span>{{ $inquiry->topic }}</span>
                        </div>
                    @endif

                    <!-- Message Body -->
                    <div class="p-3.5 rounded-xl bg-slate-950/60 border border-slate-800/80">
                        <p class="text-xs text-slate-200 leading-relaxed font-light whitespace-pre-wrap">
                            {{ $inquiry->message }}
                        </p>
                    </div>

                    <div class="text-[10px] text-slate-500 flex items-center gap-1.5">
                        <i class="fa-regular fa-clock"></i>
                        <span>Received: {{ $inquiry->created_at->format('M d, Y - h:i A') }} ({{ $inquiry->created_at->diffForHumans() }})</span>
                    </div>
                </div>

                <!-- Card Bottom Actions -->
                <div class="pt-3 border-t border-slate-800 flex items-center justify-between gap-2 flex-wrap">
                    
                    <div class="flex items-center gap-2">
                        <!-- Direct WhatsApp Reply -->
                        <a href="https://wa.me/{{ $cleanPhone }}?text={{ urlencode('Hi ' . $inquiry->name . '! Thank you for contacting ZVARR by Zaiyal regarding ' . $inquiry->topic . '.') }}" 
                            target="_blank"
                            class="px-3 py-1.5 rounded-xl bg-emerald-500/15 hover:bg-emerald-500/25 text-emerald-400 border border-emerald-500/30 text-xs font-bold flex items-center gap-1.5 transition">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                            <span>Reply WhatsApp</span>
                        </a>

                        <!-- Direct Call -->
                        <a href="tel:{{ $inquiry->phone }}" 
                            class="px-2.5 py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-300 border border-slate-700 text-xs font-semibold flex items-center gap-1.5 transition">
                            <i class="fa-solid fa-phone text-[10px]"></i>
                            <span>Call</span>
                        </a>
                    </div>

                    <div class="flex items-center gap-2">
                        <!-- Status Update Form -->
                        <form action="{{ route('admin.inquiries.status', $inquiry->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()"
                                class="px-2.5 py-1 rounded-xl bg-slate-800 border border-slate-700 text-[11px] text-slate-300 font-semibold focus:outline-none focus:ring-1 focus:ring-amber-400 cursor-pointer">
                                <option value="new" {{ $inquiry->status === 'new' ? 'selected' : '' }}>New</option>
                                <option value="contacted" {{ $inquiry->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                <option value="resolved" {{ $inquiry->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                            </select>
                        </form>

                        <!-- Delete Button -->
                        <button type="button" 
                            onclick="triggerDeleteModal('{{ route('admin.inquiries.destroy', $inquiry->id) }}', 'Inquiry from {{ addslashes($inquiry->name) }}')"
                            class="p-2 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 text-xs transition"
                            title="Delete Inquiry">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </div>

                </div>

            </div>
        @empty
            <div class="col-span-2 text-center py-16 bg-slate-900 rounded-3xl border border-slate-800 text-slate-500">
                <i class="fa-regular fa-envelope-open text-4xl mb-3 text-slate-600"></i>
                <p class="text-sm font-semibold">No inquiries or messages received yet.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $inquiries->links() }}
    </div>

</div>
@endsection
