@extends('shop.layout')

@section('title', 'Create Account | ZVARR by Zaiyal')

@section('content')
<div class="min-h-screen pt-24 pb-16 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full glass-card-3d bg-gradient-to-b from-[#16161c] via-[#09090b] to-[#040405] p-8 sm:p-10 rounded-3xl border border-amber-400/30 shadow-2xl relative">
        
        <!-- Header -->
        <div class="text-center mb-8 space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-300 via-amber-500 to-stone-900 p-[1px] mx-auto shadow-lg shadow-amber-500/20">
                <div class="w-full h-full bg-[#0a0a0c] rounded-2xl flex items-center justify-center">
                    <span class="font-cinzel font-black text-base text-amber-300">Z</span>
                </div>
            </div>
            <h2 class="text-3xl font-serif-luxury font-normal text-white">Join ZVARR Vault</h2>
            <p class="text-xs text-stone-400 font-light">Create an account for personalized luxury shopping.</p>
        </div>

        @if($errors->any())
            <div class="mb-5 p-3.5 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-medium rounded-xl">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/register') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-[10px] uppercase font-bold tracking-widest text-stone-400 mb-1.5">
                    Full Name
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                    placeholder="e.g. Ayesha Khan"
                    class="w-full px-4 py-3 rounded-xl bg-black/60 border border-white/10 text-white placeholder-stone-600 text-xs focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
            </div>

            <div>
                <label for="reg_email" class="block text-[10px] uppercase font-bold tracking-widest text-stone-400 mb-1.5">
                    Email Address
                </label>
                <input type="email" id="reg_email" name="email" value="{{ old('email') }}" required
                    placeholder="you@example.com"
                    class="w-full px-4 py-3 rounded-xl bg-black/60 border border-white/10 text-white placeholder-stone-600 text-xs focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
            </div>

            <div>
                <label for="reg_password" class="block text-[10px] uppercase font-bold tracking-widest text-stone-400 mb-1.5">
                    Password (Min 6 characters)
                </label>
                <input type="password" id="reg_password" name="password" required
                    placeholder="••••••••"
                    class="w-full px-4 py-3 rounded-xl bg-black/60 border border-white/10 text-white placeholder-stone-600 text-xs focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
            </div>

            <div>
                <label for="password_confirmation" class="block text-[10px] uppercase font-bold tracking-widest text-stone-400 mb-1.5">
                    Confirm Password
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    placeholder="••••••••"
                    class="w-full px-4 py-3 rounded-xl bg-black/60 border border-white/10 text-white placeholder-stone-600 text-xs focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
            </div>

            <button type="submit" 
                class="w-full py-3.5 bg-gradient-to-r from-amber-400 via-amber-500 to-yellow-600 hover:opacity-95 text-black font-extrabold text-xs uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-amber-500/20 transition transform hover:-translate-y-0.5 mt-2">
                Create Account
            </button>
        </form>

        <div class="mt-6 pt-5 border-t border-white/10 text-center text-xs text-stone-400 font-light">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-amber-400 hover:text-amber-300 font-bold ml-1">Sign In</a>
        </div>

    </div>
</div>
@endsection
