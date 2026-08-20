@extends('shop.layout')

@section('title', 'Sign In | ZVARR by Zaiyal')

@section('content')
<div class="min-h-screen pt-24 pb-16 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full glass-card-3d bg-gradient-to-b from-[#16161c] via-[#09090b] to-[#040405] p-8 sm:p-10 rounded-3xl border border-amber-400/30 shadow-2xl relative">
        
        <!-- Header (Exact Reference Luxury Design) -->
        <div class="text-center mb-8 space-y-1.5 flex flex-col items-center">
            <!-- Top Star Accent -->
            <span class="text-amber-300 text-[10px] leading-none mb-0.5 animate-pulse">✦</span>
            
            <!-- Main Serif Wordmark -->
            <span class="font-cinzel font-semibold text-3xl tracking-[0.3em] text-transparent bg-clip-text bg-gradient-to-b from-[#FFF5D1] via-[#E8C265] to-[#AA7C11] block leading-none pl-[0.3em] drop-shadow-[0_2px_12px_rgba(217,119,6,0.4)]">
                ZVARR
            </span>
            
            <!-- Center Hairline Divider with Diamond Rhombus -->
            <div class="flex items-center justify-center w-full max-w-[160px] my-1.5 relative">
                <div class="h-[1px] flex-1 bg-gradient-to-r from-transparent via-amber-400/80 to-amber-300"></div>
                <span class="text-[8px] text-amber-300 px-1.5 leading-none drop-shadow-[0_0_5px_rgba(245,158,11,0.9)]">◆</span>
                <div class="h-[1px] flex-1 bg-gradient-to-l from-transparent via-amber-400/80 to-amber-300"></div>
            </div>
            
            <!-- Subtitle Tagline -->
            <span class="text-[9.5px] uppercase font-bold tracking-[0.52em] text-[#E8C265] leading-none pl-[0.52em]">
                BY ZAIYAL
            </span>

            <h2 class="text-2xl font-serif-luxury font-normal text-white pt-3">Sign In to Vault</h2>
            <p class="text-xs text-stone-400 font-light">Access your exclusive wishlist & order tracking.</p>
        </div>

        @if(session('success'))
            <div class="mb-5 p-3.5 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-semibold rounded-xl flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-sm"></i>
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-5 p-3.5 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-medium rounded-xl">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-[10px] uppercase font-bold tracking-widest text-stone-400 mb-1.5">
                    Email Address
                </label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="you@example.com"
                    class="w-full px-4 py-3 rounded-xl bg-black/60 border border-white/10 text-white placeholder-stone-600 text-xs focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
            </div>

            <div>
                <label for="password" class="block text-[10px] uppercase font-bold tracking-widest text-stone-400 mb-1.5">
                    Password
                </label>
                <input type="password" id="password" name="password" required
                    placeholder="••••••••"
                    class="w-full px-4 py-3 rounded-xl bg-black/60 border border-white/10 text-white placeholder-stone-600 text-xs focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded bg-black/60 border-white/20 text-amber-500 focus:ring-amber-400">
                    <span class="text-[11px] text-stone-400">Remember Me</span>
                </label>
            </div>

            <button type="submit" 
                class="w-full py-3.5 bg-gradient-to-r from-amber-400 via-amber-500 to-yellow-600 hover:opacity-95 text-black font-extrabold text-xs uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-amber-500/20 transition transform hover:-translate-y-0.5">
                Sign In
            </button>
        </form>

        <div class="mt-6 pt-5 border-t border-white/10 text-center text-xs text-stone-400 font-light">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-amber-400 hover:text-amber-300 font-bold ml-1">Create Account</a>
        </div>

    </div>
</div>
@endsection
