<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'Admin Portal') | ZVARR by Zaiyal Maison CRM</title>
    
    <!-- Luxury Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <!-- Google Fonts: Cinzel, Cormorant Garamond & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800;900&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome Pro Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Puter.js AI Engine for Real LLM Generation -->
    <script src="https://js.puter.com/v2/"></script>

    <!-- Tailwind CSS with Luxury Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        cinzel: ['Cinzel', 'serif'],
                        'serif-luxury': ['"Cormorant Garamond"', 'serif'],
                    },
                    colors: {
                        obsidian: {
                            DEFAULT: '#050508',
                            surface: '#09090e',
                            card: '#0f0f15',
                            border: '#1a1a24',
                        },
                        gold: {
                            50: '#FDFBF7',
                            100: '#FBF5DF',
                            200: '#F5E6B4',
                            300: '#E8C265',
                            400: '#D4AF37',
                            500: '#AA7C11',
                            600: '#855E09',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #050508;
            color: #E2E8F0;
            overflow-x: hidden;
        }

        .font-cinzel { font-family: 'Cinzel', serif; }
        .font-serif-luxury { font-family: 'Cormorant Garamond', serif; }

        /* Luxury Glassmorphism */
        .glass-card-luxury {
            background: rgba(15, 15, 21, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 55, 0.15);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.7);
        }

        .glass-card-luxury:hover {
            border-color: rgba(212, 175, 55, 0.35);
        }

        .glass-panel-gold {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.08) 0%, rgba(10, 10, 15, 0.9) 100%);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(212, 175, 55, 0.25);
        }

        /* Gold Gradient Text */
        .gold-text-shimmer {
            background: linear-gradient(135deg, #FBF5DF 0%, #D4AF37 50%, #AA7C11 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #050508;
        }
        ::-webkit-scrollbar-thumb {
            background: #232330;
            border-radius: 9999px;
            border: 1px solid rgba(212, 175, 55, 0.15);
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #D4AF37;
        }

        @keyframes pulseGlow {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.05); }
        }
        .animate-glow {
            animation: pulseGlow 4s infinite ease-in-out;
        }
    </style>
</head>
<body class="min-h-screen flex antialiased bg-[#050508] text-slate-200 selection:bg-amber-400 selection:text-black">

    <!-- DESKTOP SIDEBAR (STICKY LUXURY NAVIGATION) -->
    <aside class="w-72 bg-[#09090f]/95 backdrop-blur-2xl border-r border-amber-400/15 flex-col justify-between hidden md:flex min-h-screen sticky top-0 z-40">
        <div>
            <!-- Brand Logo -->
            <div class="h-24 flex items-center px-6 border-b border-white/5 gap-3.5 bg-gradient-to-b from-amber-950/20 to-transparent">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-200 via-amber-400 to-amber-600 p-[1px] shadow-lg shadow-amber-500/20 flex-shrink-0">
                    <div class="w-full h-full bg-[#09090d] rounded-2xl flex items-center justify-center">
                        <span class="font-cinzel font-black text-lg text-amber-300">Z</span>
                    </div>
                </div>
                <div>
                    <h1 class="font-cinzel font-bold text-lg tracking-widest text-white">ZVARR</h1>
                    <p class="text-[9px] uppercase font-bold tracking-[0.2em] text-amber-400">ADMIN PANEL</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1.5">
                <div class="px-3 py-1.5 text-[10px] font-bold uppercase tracking-widest text-stone-500">Store Management</div>

                <a href="{{ route('admin.dashboard') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-amber-400/20 via-amber-400/10 to-transparent text-amber-300 border-l-4 border-amber-400 shadow-md shadow-amber-500/10' : 'text-stone-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-chart-pie text-sm {{ request()->routeIs('admin.dashboard') ? 'text-amber-400' : 'text-stone-500' }}"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.products.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition duration-200 {{ request()->routeIs('admin.products.*') ? 'bg-gradient-to-r from-amber-400/20 via-amber-400/10 to-transparent text-amber-300 border-l-4 border-amber-400 shadow-md shadow-amber-500/10' : 'text-stone-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-gem text-sm {{ request()->routeIs('admin.products.*') ? 'text-amber-400' : 'text-stone-500' }}"></i>
                    <span>Products</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-gradient-to-r from-amber-400/20 via-amber-400/10 to-transparent text-amber-300 border-l-4 border-amber-400 shadow-md shadow-amber-500/10' : 'text-stone-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-tags text-sm {{ request()->routeIs('admin.categories.*') ? 'text-amber-400' : 'text-stone-500' }}"></i>
                    <span>Categories</span>
                </a>

                <div class="pt-3 px-3 py-1.5 text-[10px] font-bold uppercase tracking-widest text-stone-500">Customer Management</div>

                <a href="{{ route('admin.inquiries.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition duration-200 {{ request()->routeIs('admin.inquiries.*') ? 'bg-gradient-to-r from-amber-400/20 via-amber-400/10 to-transparent text-amber-300 border-l-4 border-amber-400 shadow-md shadow-amber-500/10' : 'text-stone-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-envelope-open-text text-sm {{ request()->routeIs('admin.inquiries.*') ? 'text-amber-400' : 'text-stone-500' }}"></i>
                    <span>Customer Inquiries</span>
                </a>

                <a href="{{ route('admin.reviews.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition duration-200 {{ request()->routeIs('admin.reviews.*') ? 'bg-gradient-to-r from-amber-400/20 via-amber-400/10 to-transparent text-amber-300 border-l-4 border-amber-400 shadow-md shadow-amber-500/10' : 'text-stone-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-star text-sm {{ request()->routeIs('admin.reviews.*') ? 'text-amber-400' : 'text-stone-500' }}"></i>
                    <span>Customer Reviews</span>
                </a>

                <a href="{{ route('admin.contacts.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition duration-200 {{ request()->routeIs('admin.contacts.*') ? 'bg-gradient-to-r from-amber-400/20 via-amber-400/10 to-transparent text-amber-300 border-l-4 border-amber-400 shadow-md shadow-amber-500/10' : 'text-stone-400 hover:text-white hover:bg-white/5' }}">
                    <i class="fa-solid fa-headset text-sm {{ request()->routeIs('admin.contacts.*') ? 'text-amber-400' : 'text-stone-500' }}"></i>
                    <span>Store Contacts & Social</span>
                </a>

                <div class="pt-4">
                    <a href="{{ url('/') }}" target="_blank"
                        class="flex items-center justify-between px-4 py-3 rounded-2xl text-xs font-bold text-amber-300 bg-amber-400/10 border border-amber-400/30 hover:bg-amber-400/20 transition duration-200 shadow-lg shadow-amber-500/5 group">
                        <span class="flex items-center gap-2.5">
                            <i class="fa-solid fa-store text-amber-400"></i>
                            View Storefront
                        </span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px] opacity-70 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition transform"></i>
                    </a>
                </div>
            </nav>
        </div>

        <!-- Admin Profile in Sidebar Bottom -->
        <div class="p-4 border-t border-white/5 bg-[#07070b]">
            <div class="p-3 rounded-2xl bg-white/[0.03] border border-white/5 flex items-center justify-between">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-400/20 to-amber-600/30 border border-amber-400/40 text-amber-300 flex items-center justify-center font-bold text-sm flex-shrink-0">
                        👑
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name ?? 'Administrator' }}</p>
                        <p class="text-[10px] text-amber-400 font-medium">Administrator</p>
                    </div>
                </div>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" title="Logout" class="text-stone-400 hover:text-rose-400 p-2 transition rounded-xl hover:bg-rose-500/10">
                        <i class="fa-solid fa-power-off text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN WRAPPER -->
    <div class="flex-1 flex flex-col min-w-0 relative">
        
        <!-- Ambient Background Glows -->
        <div class="fixed top-0 right-1/4 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl pointer-events-none -z-10 animate-glow"></div>
        <div class="fixed bottom-10 left-1/3 w-80 h-80 bg-amber-600/5 rounded-full blur-3xl pointer-events-none -z-10 animate-glow"></div>

        <!-- Top Header (Desktop & Mobile) -->
        <header class="h-16 sm:h-20 bg-[#07070b]/90 backdrop-blur-2xl border-b border-amber-400/15 px-3.5 sm:px-8 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-2.5 sm:gap-3.5 min-w-0">
                <button type="button" onclick="toggleMobileDrawer()" class="md:hidden w-10 h-10 rounded-2xl bg-white/5 hover:bg-white/10 text-amber-300 flex items-center justify-center text-sm border border-amber-400/20 transition flex-shrink-0">
                    <i class="fa-solid fa-bars-staggered"></i>
                </button>

                <div class="min-w-0">
                    <h2 class="text-xs sm:text-base md:text-lg font-cinzel font-bold text-white tracking-wide truncate max-w-[170px] sm:max-w-md">
                        @yield('header_title', 'Admin Panel')
                    </h2>
                    <p class="text-[10px] text-stone-400 hidden sm:block">ZVARR by Zaiyal • Jewellery Store Management</p>
                </div>
            </div>

            <div class="flex items-center gap-2 sm:gap-3.5 flex-shrink-0">
                <!-- Live Pill Badge (Visible on Desktop / Large Screens) -->
                <span class="hidden lg:inline-flex items-center px-3 py-1.5 rounded-full text-[10px] font-bold tracking-wider uppercase bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">
                    <span class="w-1.5 h-1.5 mr-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Store Online
                </span>

                <!-- Quick Store Link -->
                <a href="{{ url('/') }}" target="_blank" title="Preview Public Storefront"
                    class="p-2 sm:px-3.5 sm:py-2 rounded-xl bg-gradient-to-r from-amber-400/10 to-amber-600/10 hover:from-amber-400/20 hover:to-amber-600/20 text-amber-300 border border-amber-400/30 text-xs font-bold flex items-center gap-2 transition duration-200 shadow-md shadow-amber-500/5">
                    <i class="fa-solid fa-store text-amber-400 text-xs sm:text-sm"></i>
                    <span class="hidden sm:inline">Storefront</span>
                </a>

                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" title="Sign Out" 
                        class="p-2 sm:px-3.5 sm:py-2 text-xs font-bold text-stone-400 hover:text-rose-400 bg-white/5 hover:bg-rose-500/10 rounded-xl transition border border-white/5 hover:border-rose-500/30 flex items-center gap-1.5">
                        <i class="fa-solid fa-power-off text-xs sm:text-sm"></i>
                        <span class="hidden sm:inline">Sign Out</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- MOBILE SLIDE-OUT LUXURY DRAWER -->
        <div id="mobile-menu-drawer" class="hidden fixed inset-0 bg-black/85 backdrop-blur-xl z-50 md:hidden transition-all duration-300" onclick="handleDrawerBackdrop(event)">
            <div class="w-72 bg-[#09090f] border-r border-amber-400/20 h-full p-6 flex flex-col justify-between overflow-y-auto shadow-2xl">
                <div>
                    <div class="flex items-center justify-between pb-6 border-b border-white/5 mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-amber-200 via-amber-400 to-amber-600 p-[1px] shadow-lg shadow-amber-500/20">
                                <div class="w-full h-full bg-[#09090d] rounded-2xl flex items-center justify-center">
                                    <span class="font-cinzel font-black text-base text-amber-300">Z</span>
                                </div>
                            </div>
                            <div>
                                <span class="font-cinzel font-bold text-sm tracking-widest text-white">ZVARR</span>
                                <p class="text-[9px] uppercase tracking-widest text-amber-400 font-bold">ADMIN PANEL</p>
                            </div>
                        </div>
                        <button type="button" onclick="toggleMobileDrawer()" class="w-9 h-9 rounded-xl bg-white/5 text-stone-400 hover:text-white flex items-center justify-center text-sm border border-white/10">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <!-- Navigation Drawer Links -->
                    <nav class="space-y-1.5">
                        <a href="{{ route('admin.dashboard') }}" onclick="toggleMobileDrawer()"
                            class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-xs font-bold transition {{ request()->routeIs('admin.dashboard') ? 'bg-amber-400/20 text-amber-300 border border-amber-400/40 font-extrabold' : 'text-stone-300 hover:bg-white/5' }}">
                            <i class="fa-solid fa-chart-pie text-sm {{ request()->routeIs('admin.dashboard') ? 'text-amber-400' : 'text-stone-400' }}"></i>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('admin.products.index') }}" onclick="toggleMobileDrawer()"
                            class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-xs font-bold transition {{ request()->routeIs('admin.products.*') ? 'bg-amber-400/20 text-amber-300 border border-amber-400/40 font-extrabold' : 'text-stone-300 hover:bg-white/5' }}">
                            <i class="fa-solid fa-gem text-sm {{ request()->routeIs('admin.products.*') ? 'text-amber-400' : 'text-stone-400' }}"></i>
                            <span>Products</span>
                        </a>

                        <a href="{{ route('admin.categories.index') }}" onclick="toggleMobileDrawer()"
                            class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-xs font-bold transition {{ request()->routeIs('admin.categories.*') ? 'bg-amber-400/20 text-amber-300 border border-amber-400/40 font-extrabold' : 'text-stone-300 hover:bg-white/5' }}">
                            <i class="fa-solid fa-tags text-sm {{ request()->routeIs('admin.categories.*') ? 'text-amber-400' : 'text-stone-400' }}"></i>
                            <span>Categories</span>
                        </a>

                        <a href="{{ route('admin.inquiries.index') }}" onclick="toggleMobileDrawer()"
                            class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-xs font-bold transition {{ request()->routeIs('admin.inquiries.*') ? 'bg-amber-400/20 text-amber-300 border border-amber-400/40 font-extrabold' : 'text-stone-300 hover:bg-white/5' }}">
                            <i class="fa-solid fa-envelope-open-text text-sm {{ request()->routeIs('admin.inquiries.*') ? 'text-amber-400' : 'text-stone-400' }}"></i>
                            <span>Customer Inquiries</span>
                        </a>

                        <a href="{{ route('admin.reviews.index') }}" onclick="toggleMobileDrawer()"
                            class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-xs font-bold transition {{ request()->routeIs('admin.reviews.*') ? 'bg-amber-400/20 text-amber-300 border border-amber-400/40 font-extrabold' : 'text-stone-300 hover:bg-white/5' }}">
                            <i class="fa-solid fa-star text-sm {{ request()->routeIs('admin.reviews.*') ? 'text-amber-400' : 'text-stone-400' }}"></i>
                            <span>Customer Reviews</span>
                        </a>

                        <a href="{{ route('admin.contacts.index') }}" onclick="toggleMobileDrawer()"
                            class="flex items-center gap-3.5 px-4 py-3.5 rounded-2xl text-xs font-bold transition {{ request()->routeIs('admin.contacts.*') ? 'bg-amber-400/20 text-amber-300 border border-amber-400/40 font-extrabold' : 'text-stone-300 hover:bg-white/5' }}">
                            <i class="fa-solid fa-headset text-sm {{ request()->routeIs('admin.contacts.*') ? 'text-amber-400' : 'text-stone-400' }}"></i>
                            <span>Store Contacts & Social</span>
                        </a>

                        <a href="{{ url('/') }}" target="_blank"
                            class="flex items-center justify-between px-4 py-3.5 rounded-2xl text-xs font-bold text-amber-300 bg-amber-400/10 border border-amber-400/30 mt-4 shadow-lg shadow-amber-500/10">
                            <span class="flex items-center gap-2.5">
                                <i class="fa-solid fa-store text-amber-400"></i>
                                View Storefront
                            </span>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[11px]"></i>
                        </a>
                    </nav>
                </div>

                <div class="border-t border-white/10 pt-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-amber-400/20 border border-amber-400/40 text-amber-300 flex items-center justify-center font-bold text-xs">
                            👑
                        </div>
                        <div>
                            <p class="text-xs font-bold text-white">{{ Auth::user()->name ?? 'Administrator' }}</p>
                            <p class="text-[10px] text-amber-400 font-medium">Administrator</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-stone-400 hover:text-rose-400 p-2.5 rounded-xl bg-white/5">
                            <i class="fa-solid fa-power-off text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- MAIN BODY CONTENT -->
        <main class="flex-1 p-4 sm:p-8 pb-28 md:pb-12 max-w-7xl w-full mx-auto">
            
            <!-- Success Flash Notification -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-gradient-to-r from-emerald-950/80 via-[#0a1a12] to-[#0a1a12] border border-emerald-500/40 text-emerald-300 text-xs sm:text-sm font-semibold rounded-2xl flex items-center gap-3 shadow-xl shadow-emerald-950/30 animate-pulse">
                    <div class="w-8 h-8 rounded-xl bg-emerald-500/20 border border-emerald-500/40 flex items-center justify-center text-emerald-400 flex-shrink-0">
                        <i class="fa-solid fa-circle-check text-base"></i>
                    </div>
                    <span class="flex-1">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Error Flash Notification -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-gradient-to-r from-rose-950/80 via-[#1a0a0f] to-[#1a0a0f] border border-rose-500/40 text-rose-300 text-xs sm:text-sm font-medium rounded-2xl shadow-xl shadow-rose-950/30">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 rounded-xl bg-rose-500/20 border border-rose-500/40 flex items-center justify-center text-rose-400 flex-shrink-0">
                            <i class="fa-solid fa-triangle-exclamation text-base"></i>
                        </div>
                        <span class="font-bold text-white">Please resolve the following:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1 pl-11 text-xs text-rose-200">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- FLOATING MOBILE BOTTOM NAVIGATION DOCK (VIP PRODUCTION EXPERIENCE) -->
        <nav class="md:hidden fixed bottom-3 inset-x-3 bg-[#0a0a12]/95 backdrop-blur-2xl border border-amber-400/20 rounded-3xl px-3 py-2 flex items-center justify-around z-40 shadow-2xl shadow-black/80">
            <a href="{{ route('admin.dashboard') }}" 
                class="flex flex-col items-center gap-1 py-1 px-3 rounded-2xl transition {{ request()->routeIs('admin.dashboard') ? 'text-amber-300 font-bold bg-amber-400/10' : 'text-stone-400' }}">
                <i class="fa-solid fa-chart-pie text-base"></i>
                <span class="text-[9px] uppercase tracking-wider">Home</span>
            </a>

            <a href="{{ route('admin.products.index') }}" 
                class="flex flex-col items-center gap-1 py-1 px-3 rounded-2xl transition {{ request()->routeIs('admin.products.*') && !request()->routeIs('admin.products.create') ? 'text-amber-300 font-bold bg-amber-400/10' : 'text-stone-400' }}">
                <i class="fa-solid fa-gem text-base"></i>
                <span class="text-[9px] uppercase tracking-wider">Products</span>
            </a>

            <!-- Center Floating Add Action Button -->
            <a href="{{ route('admin.products.create') }}" 
                class="-mt-7 bg-gradient-to-br from-amber-200 via-amber-400 to-amber-600 text-slate-950 w-12 h-12 min-w-[48px] min-h-[48px] max-w-[48px] max-h-[48px] rounded-2xl shadow-xl shadow-amber-500/30 flex items-center justify-center font-bold border-2 border-[#0a0a12] active:scale-95 transition transform">
                <i class="fa-solid fa-plus text-lg"></i>
            </a>

            <a href="{{ route('admin.inquiries.index') }}" 
                class="flex flex-col items-center gap-1 py-1 px-3 rounded-2xl transition {{ request()->routeIs('admin.inquiries.*') ? 'text-amber-300 font-bold bg-amber-400/10' : 'text-stone-400' }}">
                <i class="fa-solid fa-envelope-open-text text-base"></i>
                <span class="text-[9px] uppercase tracking-wider">Messages</span>
            </a>

            <button type="button" onclick="toggleMobileDrawer()" 
                class="flex flex-col items-center gap-1 py-1 px-3 rounded-2xl text-stone-400 hover:text-amber-300">
                <i class="fa-solid fa-bars-staggered text-base"></i>
                <span class="text-[9px] uppercase tracking-wider">Menu</span>
            </button>
        </nav>

    </div>

    <!-- GLOBAL VIP DELETE CONFIRMATION MODAL -->
    <div id="delete-confirm-modal" class="hidden fixed inset-0 bg-black/85 backdrop-blur-md z-50 items-center justify-center p-4">
        <div class="glass-card-luxury p-6 sm:p-8 rounded-3xl max-w-md w-full shadow-2xl relative space-y-5 text-center border border-rose-500/30">
            
            <div class="w-16 h-16 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-400 flex items-center justify-center text-2xl mx-auto shadow-lg shadow-rose-500/10">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>

            <div class="space-y-2">
                <h3 class="text-xl font-bold text-white font-cinzel tracking-wide">Confirm Delete</h3>
                <p class="text-xs text-stone-300 leading-relaxed">
                    Are you sure you want to delete <br>
                    <span id="delete-modal-item-name" class="font-bold text-rose-400 underline decoration-rose-500/40"></span>?
                </p>
                <p class="text-[11px] text-stone-500">This action cannot be undone.</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3 pt-3">
                <button type="button" onclick="closeDeleteModal()" 
                    class="flex-1 py-3.5 bg-white/5 hover:bg-white/10 text-stone-300 hover:text-white font-bold text-xs uppercase tracking-wider rounded-2xl transition border border-white/10">
                    Cancel
                </button>

                <form id="delete-modal-form" action="" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="w-full py-3.5 bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 hover:to-red-500 text-white font-bold text-xs uppercase tracking-wider rounded-2xl shadow-lg shadow-rose-600/30 transition transform hover:-translate-y-0.5">
                        Yes, Delete
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- Interactive Scripts -->
    <script>
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `fixed bottom-6 right-6 z-50 max-w-sm glass-card-3d bg-[#0d0c11]/95 border ${type === 'success' ? 'border-emerald-500/40 text-emerald-300' : 'border-rose-500/40 text-rose-300'} p-4 rounded-2xl shadow-2xl flex items-center gap-3 animate-bounce`;
            toast.innerHTML = `
                <div class="w-8 h-8 rounded-full ${type === 'success' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-rose-500/20 text-rose-400'} flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid ${type === 'success' ? 'fa-check' : 'fa-xmark'} text-sm"></i>
                </div>
                <p class="text-xs font-medium flex-1">${message}</p>
                <button onclick="this.parentElement.remove()" class="text-stone-500 hover:text-white">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            `;
            document.body.appendChild(toast);
            setTimeout(() => { toast.remove(); }, 4000);
        }
        window.showToast = showToast;

        function toggleMobileDrawer() {
            const drawer = document.getElementById('mobile-menu-drawer');
            drawer.classList.toggle('hidden');
        }

        function handleDrawerBackdrop(event) {
            if (event.target === document.getElementById('mobile-menu-drawer')) {
                toggleMobileDrawer();
            }
        }

        function triggerDeleteModal(actionUrl, itemName = 'this item') {
            const modal = document.getElementById('delete-confirm-modal');
            const form = document.getElementById('delete-modal-form');
            const nameSpan = document.getElementById('delete-modal-item-name');

            form.action = actionUrl;
            nameSpan.textContent = `"${itemName}"`;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('delete-confirm-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

</body>
</html>
