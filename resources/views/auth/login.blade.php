@extends('shop.layout')

@section('title', 'Sign In | ZVARR by Zaiyal')

@section('content')
<div class="min-h-screen pt-24 pb-16 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full glass-card-3d bg-gradient-to-b from-[#16161c] via-[#09090b] to-[#040405] p-8 sm:p-10 rounded-3xl border border-amber-400/30 shadow-2xl relative">
        
        <!-- Header -->
        <div class="text-center mb-8 space-y-2">
            <!-- Royal Diamond Star Insignia -->
            <div class="relative w-12 h-12 mx-auto flex items-center justify-center flex-shrink-0">
                <div class="absolute inset-0 bg-amber-400/25 rounded-full blur-md"></div>
                <svg class="w-full h-full relative z-10 drop-shadow-[0_2px_8px_rgba(245,158,11,0.4)]" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="authGold1" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#FFF5D1" />
                            <stop offset="35%" stop-color="#E8C265" />
                            <stop offset="70%" stop-color="#AA7C11" />
                            <stop offset="100%" stop-color="#F5E6B4" />
                        </linearGradient>
                        <linearGradient id="authGold2" x1="100%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" stop-color="#FBF5DF" />
                            <stop offset="50%" stop-color="#D4AF37" />
                            <stop offset="100%" stop-color="#855E09" />
                        </linearGradient>
                    </defs>
                    <path d="M24 3L44 24L24 45L4 24L24 3Z" stroke="url(#authGold1)" stroke-width="1.8" stroke-linejoin="round" fill="none" />
                    <path d="M24 9L38 24L24 39L10 24L24 9Z" stroke="url(#authGold2)" stroke-width="0.9" stroke-dasharray="2.5 1.5" fill="none" opacity="0.75" />
                    <line x1="24" y1="3" x2="24" y2="45" stroke="url(#authGold1)" stroke-width="0.9" opacity="0.75"/>
                    <line x1="4" y1="24" x2="44" y2="24" stroke="url(#authGold1)" stroke-width="0.9" opacity="0.75"/>
                    <path d="M24 15L26.8 21.2L33 24L26.8 26.8L24 33L21.2 26.8L15 24L21.2 21.2L24 15Z" fill="url(#authGold1)" />
                    <circle cx="24" cy="24" r="1.8" fill="#FFFFFF" />
                </svg>
            </div>
            <div>
                <span class="font-cinzel font-black text-3xl tracking-[0.26em] text-transparent bg-clip-text bg-gradient-to-r from-amber-100 via-amber-300 to-yellow-500 block drop-shadow-[0_2px_12px_rgba(245,158,11,0.35)]">
                    ZVARR
                </span>
                <span class="text-[9px] uppercase font-bold tracking-[0.45em] text-stone-400 block mt-0.5">
                    BY ZAIYAL
                </span>
            </div>
            <h2 class="text-2xl font-serif-luxury font-normal text-white pt-1">Sign In to Vault</h2>
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
