<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Royal Jewellery - Luxury Gold & Diamond Store</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col justify-between antialiased">

    <!-- Top Notice / Nav -->
    <nav class="h-20 border-b border-slate-800 px-6 sm:px-12 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500 to-amber-300 flex items-center justify-center text-slate-950 font-bold text-lg shadow-md shadow-amber-500/20">
                <i class="fa-solid fa-gem"></i>
            </div>
            <h1 class="font-serif font-bold text-xl tracking-wider text-amber-200">ROYAL JEWELS</h1>
        </div>

        <div class="flex items-center gap-4">
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs rounded-xl shadow-md transition flex items-center gap-2">
                        <i class="fa-solid fa-gauge-high"></i> Open Admin CRM
                    </a>
                @endif
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-xs font-semibold text-slate-400 hover:text-rose-400">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 font-bold text-xs rounded-xl border border-slate-700 transition">
                    Sign In / Admin Login
                </a>
            @endauth
        </div>
    </nav>

    <!-- Main Hero Box -->
    <main class="max-w-4xl mx-auto px-6 py-16 text-center space-y-8">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-bold uppercase tracking-widest">
            <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
            Step 2 Completed: Admin CRM Active
        </div>

        <h2 class="text-4xl sm:text-6xl font-serif font-bold tracking-tight text-slate-100 leading-tight">
            Timeless Elegance, <br>
            <span class="bg-gradient-to-r from-amber-200 via-amber-400 to-amber-200 bg-clip-text text-transparent">Crafted in Pure Gold & Diamonds</span>
        </h2>

        <p class="text-slate-400 text-base max-w-2xl mx-auto leading-relaxed">
            Your jewellery store backend & CRM panel are now ready. Manage your rings, bridal sets, and diamonds from the secret Admin CRM portal.
        </p>

        <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
            <a href="{{ route('admin.dashboard') }}" 
                class="px-8 py-4 bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-400 hover:to-amber-300 text-slate-950 font-bold text-sm rounded-2xl shadow-xl shadow-amber-500/20 transition flex items-center gap-3">
                <i class="fa-solid fa-gem text-base"></i>
                Go to Admin CRM Panel &rarr;
            </a>
            <a href="{{ route('login') }}" 
                class="px-8 py-4 bg-slate-900 hover:bg-slate-800 text-slate-200 font-bold text-sm rounded-2xl border border-slate-800 transition">
                Switch User / Login
            </a>
        </div>
    </main>

    <footer class="py-6 text-center border-t border-slate-900 text-xs text-slate-500">
        Royal Jewellery &copy; {{ date('Y') }}. Luxury E-Commerce & Management CRM.
    </footer>

</body>
</html>
