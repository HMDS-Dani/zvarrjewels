<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ZVARR by Zaiyal | Affordable Luxury Jewellery Pakistan')</title>
    
    <!-- Luxury Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700;900&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Three.js for 3D Stage & Models -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <!-- Tailwind CSS -->
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
                            DEFAULT: '#050507',
                            card: '#0a0a0d',
                            surface: '#0f0f14',
                        },
                        gold: {
                            100: '#FBF5DF',
                            200: '#F5E6B4',
                            300: '#E8C265',
                            400: '#D4AF37',
                            500: '#AA820A',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #050507;
            color: #E6E6E6;
            overflow-x: hidden;
        }
        .gold-gradient-text {
            background: linear-gradient(135deg, #FBF5DF 0%, #E8C265 50%, #AA820A 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .glass-nav-transparent {
            background: rgba(5, 5, 7, 0.75);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.12);
        }
        .glass-card-3d {
            background: rgba(14, 14, 18, 0.65);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-50%); }
        }
        .animate-marquee {
            display: flex;
            width: 200%;
            animation: marquee 25s linear infinite;
        }
        .animate-marquee:hover {
            animation-play-state: paused;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between antialiased selection:bg-amber-400 selection:text-black">

    <!-- Golden Floating Particles Canvas in Background -->
    <canvas id="particles-canvas" class="fixed inset-0 pointer-events-none z-0 opacity-25"></canvas>

    <!-- SLEEK MINIMALIST TRANSPARENT NAVBAR -->
    <header id="main-navbar" class="glass-nav-transparent fixed top-0 inset-x-0 z-50 transition-all duration-1000 {{ request()->routeIs('home') ? 'opacity-0 -translate-y-full' : 'opacity-100 translate-y-0' }}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20 gap-4">
                
                <!-- Brand Logo (Exact Reference Luxury Jewelry Maison Design) -->
                <a href="{{ route('home') }}" class="flex flex-col items-center justify-center group py-0.5 select-none text-center flex-shrink-0">
                    <!-- Top Star Accent -->
                    <span class="text-amber-300 text-[8px] sm:text-[9px] leading-none mb-0.5 transition-transform duration-300 group-hover:scale-125 drop-shadow-[0_0_6px_rgba(234,179,8,0.9)] animate-pulse">✦</span>
                    
                    <!-- Main Serif Wordmark -->
                    <span class="font-cinzel font-semibold text-xl sm:text-2xl tracking-[0.28em] sm:tracking-[0.32em] text-transparent bg-clip-text bg-gradient-to-b from-[#FFF5D1] via-[#E8C265] to-[#AA7C11] block leading-none pl-[0.28em] sm:pl-[0.32em] drop-shadow-[0_2px_10px_rgba(217,119,6,0.4)] group-hover:brightness-110 transition-all duration-300">
                        ZVARR
                    </span>
                    
                    <!-- Center Hairline Divider with Diamond Rhombus -->
                    <div class="flex items-center justify-center w-full max-w-[130px] sm:max-w-[145px] my-1 sm:my-1.5 relative">
                        <div class="h-[1px] flex-1 bg-gradient-to-r from-transparent via-amber-400/80 to-amber-300"></div>
                        <span class="text-[7px] sm:text-[8px] text-amber-300 px-1 leading-none drop-shadow-[0_0_5px_rgba(245,158,11,0.9)]">◆</span>
                        <div class="h-[1px] flex-1 bg-gradient-to-l from-transparent via-amber-400/80 to-amber-300"></div>
                    </div>
                    
                    <!-- Subtitle Tagline -->
                    <span class="text-[8px] sm:text-[9px] uppercase font-bold tracking-[0.45em] sm:tracking-[0.52em] text-[#E8C265] group-hover:text-amber-100 transition-colors duration-300 leading-none pl-[0.45em] sm:pl-[0.52em]">
                        BY ZAIYAL
                    </span>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center space-x-5 xl:space-x-7 text-[11px] uppercase tracking-[0.18em] font-semibold text-stone-300">
                    <a href="{{ route('home') }}" 
                        class="hover:text-amber-300 transition whitespace-nowrap {{ request()->routeIs('home') ? 'text-amber-400 font-bold border-b border-amber-400 pb-1' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('shop.index') }}" 
                        class="hover:text-amber-300 transition whitespace-nowrap {{ request()->routeIs('shop.index') && !request('category') ? 'text-amber-400 font-bold border-b border-amber-400 pb-1' : '' }}">
                        Shop All
                    </a>
                    <a href="{{ route('shop.category', 'pendants') }}" 
                        class="hover:text-amber-300 transition whitespace-nowrap {{ request()->is('category/pendants*') ? 'text-amber-400 font-bold border-b border-amber-400 pb-1' : '' }}">
                        Pendants
                    </a>
                    <a href="{{ route('shop.category', 'rings') }}" 
                        class="hover:text-amber-300 transition whitespace-nowrap {{ request()->is('category/rings*') ? 'text-amber-400 font-bold border-b border-amber-400 pb-1' : '' }}">
                        Rings
                    </a>
                    <a href="{{ route('shop.category', 'necklaces') }}" 
                        class="hover:text-amber-300 transition whitespace-nowrap {{ request()->is('category/necklaces*') ? 'text-amber-400 font-bold border-b border-amber-400 pb-1' : '' }}">
                        Necklaces
                    </a>
                    <a href="{{ route('about') }}" 
                        class="hover:text-amber-300 transition whitespace-nowrap {{ request()->routeIs('about') ? 'text-amber-400 font-bold border-b border-amber-400 pb-1' : '' }}">
                        About Us
                    </a>
                    <a href="{{ route('contact') }}" 
                        class="hover:text-amber-300 transition whitespace-nowrap {{ request()->routeIs('contact') ? 'text-amber-400 font-bold border-b border-amber-400 pb-1' : '' }}">
                        Contact
                    </a>
                </nav>

                <!-- Clean Actions: Minimalist Icons & Auth Dropdown/Modal -->
                <div class="flex items-center gap-2 sm:gap-3">
                    
                    <!-- Search Link Icon -->
                    <a href="{{ route('shop.index') }}" 
                        title="Search All Jewelry"
                        class="w-9 h-9 rounded-full bg-white/5 hover:bg-amber-400/15 text-stone-300 hover:text-amber-300 flex items-center justify-center text-sm border border-white/10 hover:border-amber-400/30 transition shadow-sm">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>

                    <!-- Dynamic Social Media & WhatsApp Links -->
                    @if(!empty($storeSettings['instagram_url']))
                        <a href="{{ $storeSettings['instagram_url'] }}" target="_blank" 
                            title="Instagram"
                            class="hidden md:flex w-9 h-9 rounded-full bg-white/5 hover:bg-gradient-to-tr hover:from-amber-600 hover:to-amber-400 text-stone-300 hover:text-black items-center justify-center text-sm border border-white/10 hover:border-transparent transition shadow-sm">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    @endif

                    @if(!empty($storeSettings['facebook_url']))
                        <a href="{{ $storeSettings['facebook_url'] }}" target="_blank" 
                            title="Facebook"
                            class="hidden md:flex w-9 h-9 rounded-full bg-white/5 hover:bg-blue-600 text-stone-300 hover:text-white items-center justify-center text-sm border border-white/10 hover:border-transparent transition shadow-sm">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    @endif

                    @if(!empty($storeSettings['tiktok_url']))
                        <a href="{{ $storeSettings['tiktok_url'] }}" target="_blank" 
                            title="TikTok"
                            class="hidden md:flex w-9 h-9 rounded-full bg-white/5 hover:bg-white text-stone-300 hover:text-black items-center justify-center text-sm border border-white/10 hover:border-transparent transition shadow-sm">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    @endif

                    @if(!empty($storeSettings['whatsapp_number']))
                        <a href="https://wa.me/{{ $storeSettings['whatsapp_number'] }}" target="_blank"
                            title="Order on WhatsApp"
                            class="hidden md:flex w-9 h-9 rounded-full bg-emerald-500/10 hover:bg-emerald-500/20 text-emerald-400 items-center justify-center text-sm border border-emerald-500/30 transition shadow-sm">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                    @endif

                    <!-- User Account Dropdown or In-Place Sign In Popup Trigger -->
                    @auth
                        <div class="relative group">
                            <button class="w-9 h-9 rounded-full bg-white/5 hover:bg-amber-400/15 text-amber-300 flex items-center justify-center text-xs shadow-md border border-amber-400/30 transition hover:border-amber-400/60" title="Account Menu">
                                <i class="fa-regular fa-user text-xs"></i>
                            </button>

                            <div class="absolute right-0 mt-2 w-52 glass-card-3d bg-[#0d0c11] rounded-2xl shadow-2xl py-2 hidden group-hover:block transition z-50 border border-white/10">
                                <div class="px-4 py-2.5 border-b border-white/10">
                                    <div class="flex items-center gap-1.5 mb-0.5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                        <span class="text-[9px] uppercase font-bold tracking-widest text-amber-300">ZVARR Member</span>
                                    </div>
                                    <p class="text-xs font-bold text-stone-100 truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-[10px] text-stone-400 truncate">{{ Auth::user()->email }}</p>
                                </div>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2.5 text-xs font-medium text-rose-400 hover:bg-white/5 transition flex items-center gap-2">
                                        <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i> Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- In-Place Sign In Button (Opens Modal without leaving page) -->
                        <button onclick="openAuthModal('login')" 
                            class="px-3.5 sm:px-4 py-1.5 sm:py-2 rounded-full text-xs font-bold bg-white/5 hover:bg-amber-400/15 text-amber-300 border border-amber-400/30 transition shadow-sm flex items-center gap-1.5">
                            <i class="fa-regular fa-user text-xs"></i>
                            <span>Sign In</span>
                        </button>
                    @endauth

                    <!-- Mobile Menu Hamburger Button -->
                    <button onclick="toggleMobileMenu()" 
                        class="lg:hidden w-9 h-9 rounded-full bg-white/5 hover:bg-white/10 text-stone-300 flex items-center justify-center text-sm border border-white/10">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                </div>
            </div>
        </div>

        <!-- Mobile Navigation Drawer -->
        <div id="mobile-menu" class="hidden lg:hidden bg-[#09090c] border-b border-white/10 px-6 py-6 space-y-4">
            <div class="flex flex-col space-y-3 text-xs uppercase tracking-widest font-semibold text-stone-300">
                <a href="{{ route('home') }}" class="py-2 hover:text-amber-300 border-b border-white/5">Home</a>
                <a href="{{ route('shop.index') }}" class="py-2 hover:text-amber-300 border-b border-white/5">Shop All</a>
                <a href="{{ route('shop.category', 'pendants') }}" class="py-2 hover:text-amber-300 border-b border-white/5">Pendants</a>
                <a href="{{ route('shop.category', 'rings') }}" class="py-2 hover:text-amber-300 border-b border-white/5">Rings</a>
                <a href="{{ route('shop.category', 'necklaces') }}" class="py-2 hover:text-amber-300 border-b border-white/5">Necklaces</a>
                <a href="{{ route('shop.category', 'earrings') }}" class="py-2 hover:text-amber-300 border-b border-white/5">Earrings</a>
                <a href="{{ route('shop.category', 'bracelets') }}" class="py-2 hover:text-amber-300">Bracelets & Cuffs</a>
            </div>
        </div>
    </header>

    <!-- Global Toast Alert Messages -->
    @if(session('success'))
        <div id="toast-success" class="fixed bottom-6 right-6 z-50 max-w-sm glass-card-3d bg-[#0d0c11]/90 border border-emerald-500/40 p-4 rounded-2xl shadow-2xl flex items-center gap-3 animate-bounce">
            <div class="w-8 h-8 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-check text-sm"></i>
            </div>
            <p class="text-xs text-stone-200 font-medium">{{ session('success') }}</p>
            <button onclick="document.getElementById('toast-success').remove()" class="text-stone-500 hover:text-white ml-auto">
                <i class="fa-solid fa-xmark text-xs"></i>
            </button>
        </div>
    @endif

    <!-- MAIN PAGE CONTENT -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- PRODUCTION LEVEL LUXURY FOOTER -->
    <footer class="bg-[#030304] text-stone-300 border-t border-white/10 pt-12 sm:pt-16 pb-10 relative z-20 overflow-hidden">
        <!-- Ambient Subtle Gold Flare -->
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[600px] h-[200px] bg-amber-500/5 rounded-full blur-[140px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Luxury Grid: Responsive for Mobile & Desktop -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 mb-10 sm:mb-12">
                
                <!-- Col 1: Brand Info (4 cols) -->
                <div class="lg:col-span-4 space-y-3.5 sm:space-y-4">
                    <a href="{{ route('home') }}" class="inline-flex flex-col items-start group select-none">
                        <!-- Top Star Accent -->
                        <span class="text-amber-300 text-[8px] sm:text-[9px] leading-none mb-0.5 transition-transform duration-300 group-hover:scale-125 drop-shadow-[0_0_6px_rgba(234,179,8,0.9)] animate-pulse">✦</span>
                        
                        <!-- Main Serif Wordmark -->
                        <span class="font-cinzel font-semibold text-2xl tracking-[0.28em] sm:tracking-[0.32em] text-transparent bg-clip-text bg-gradient-to-b from-[#FFF5D1] via-[#E8C265] to-[#AA7C11] block leading-none pl-[0.28em] sm:pl-[0.32em] drop-shadow-[0_2px_10px_rgba(217,119,6,0.4)] group-hover:brightness-110 transition-all duration-300">
                            ZVARR
                        </span>
                        
                        <!-- Center Hairline Divider with Diamond Rhombus -->
                        <div class="flex items-center justify-center w-full max-w-[145px] my-1.5 relative">
                            <div class="h-[1px] flex-1 bg-gradient-to-r from-transparent via-amber-400/80 to-amber-300"></div>
                            <span class="text-[8px] text-amber-300 px-1 leading-none drop-shadow-[0_0_5px_rgba(245,158,11,0.9)]">◆</span>
                            <div class="h-[1px] flex-1 bg-gradient-to-l from-transparent via-amber-400/80 to-amber-300"></div>
                        </div>
                        
                        <!-- Subtitle Tagline -->
                        <span class="text-[9px] uppercase font-bold tracking-[0.45em] sm:tracking-[0.52em] text-[#E8C265] group-hover:text-amber-100 transition-colors duration-300 leading-none pl-[0.45em] sm:pl-[0.52em]">
                            BY ZAIYAL
                        </span>
                    </a>

                    <p class="text-xs text-stone-400 leading-relaxed font-light max-w-sm sm:max-w-md">
                        Everyday luxury jewellery crafted with marine-grade waterproof stainless steel and 18K/22K vacuum gold & platinum finishes. Designed to never fade, tarnish, or turn green on skin.
                    </p>

                    <!-- Dynamic Social Media Badges -->
                    <div class="flex items-center gap-2.5 pt-1">
                        @if(!empty($storeSettings['instagram_url']))
                            <a href="{{ $storeSettings['instagram_url'] }}" target="_blank" class="w-8 h-8 rounded-xl bg-white/5 hover:bg-gradient-to-tr hover:from-amber-600 hover:to-amber-400 text-stone-300 hover:text-black flex items-center justify-center text-xs transition border border-white/10 hover:border-transparent" title="Instagram">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        @endif
                        @if(!empty($storeSettings['facebook_url']))
                            <a href="{{ $storeSettings['facebook_url'] }}" target="_blank" class="w-8 h-8 rounded-xl bg-white/5 hover:bg-blue-600 text-stone-300 hover:text-white flex items-center justify-center text-xs transition border border-white/10 hover:border-transparent" title="Facebook">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        @endif
                        @if(!empty($storeSettings['tiktok_url']))
                            <a href="{{ $storeSettings['tiktok_url'] }}" target="_blank" class="w-8 h-8 rounded-xl bg-white/5 hover:bg-white text-stone-300 hover:text-black flex items-center justify-center text-xs transition border border-white/10 hover:border-transparent" title="TikTok">
                                <i class="fa-brands fa-tiktok"></i>
                            </a>
                        @endif
                        @if(!empty($storeSettings['whatsapp_number']))
                            <a href="https://wa.me/{{ $storeSettings['whatsapp_number'] }}" target="_blank" class="w-8 h-8 rounded-xl bg-emerald-500/10 hover:bg-emerald-500/25 text-emerald-400 flex items-center justify-center text-xs transition border border-emerald-500/30" title="WhatsApp">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Combined Links Container: 2-Columns Side-by-Side on Mobile (4 cols on lg) -->
                <div class="lg:col-span-4 grid grid-cols-2 gap-6 sm:gap-8">
                    <!-- Col 2: Signature Vaults -->
                    <div class="space-y-3">
                        <h4 class="font-cinzel font-bold text-xs uppercase tracking-widest text-amber-300">Signature Vaults</h4>
                        <ul class="space-y-2 text-xs text-stone-400">
                            <li><a href="{{ route('shop.index') }}" class="hover:text-amber-300 transition flex items-center gap-1.5"><i class="fa-solid fa-gem text-[8px] text-amber-400"></i> All Jewelry</a></li>
                            <li><a href="{{ route('shop.category', 'pendants') }}" class="hover:text-amber-300 transition">Pendants</a></li>
                            <li><a href="{{ route('shop.category', 'rings') }}" class="hover:text-amber-300 transition">Pavé Rings</a></li>
                            <li><a href="{{ route('shop.category', 'necklaces') }}" class="hover:text-amber-300 transition">Necklaces</a></li>
                            <li><a href="{{ route('shop.category', 'earrings') }}" class="hover:text-amber-300 transition">Earrings</a></li>
                            <li><a href="{{ route('shop.category', 'bracelets') }}" class="hover:text-amber-300 transition">Cuffs</a></li>
                        </ul>
                    </div>

                    <!-- Col 3: The Maison & Policies -->
                    <div class="space-y-3">
                        <h4 class="font-cinzel font-bold text-xs uppercase tracking-widest text-amber-300">The Maison</h4>
                        <ul class="space-y-2 text-xs text-stone-400">
                            <li><a href="{{ route('about') }}" class="hover:text-amber-300 transition">About Our Story</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:text-amber-300 transition">Contact Concierge</a></li>
                            <li><span class="text-stone-400 cursor-default">Anti-Tarnish</span></li>
                            <li><span class="text-stone-400 cursor-default">Open Parcel COD</span></li>
                            <li><span class="text-stone-400 cursor-default">Vault Packaging</span></li>
                        </ul>
                    </div>
                </div>

                <!-- Col 4: Dynamic Live Concierge Card (4 cols) -->
                <div class="lg:col-span-4 space-y-3">
                    <h4 class="font-cinzel font-bold text-xs uppercase tracking-widest text-amber-300">Customer Concierge</h4>
                    
                    <div class="p-4 sm:p-5 rounded-2xl glass-card-3d space-y-3 border border-white/10 bg-black/40">
                        @if(!empty($storeSettings['whatsapp_number']))
                            <a href="https://wa.me/{{ $storeSettings['whatsapp_number'] }}?text={{ urlencode($storeSettings['whatsapp_greeting'] ?? 'Hi ZVARR by Zaiyal! I want to inquire about jewellery.') }}" 
                                target="_blank"
                                class="w-full py-2.5 px-3 rounded-xl bg-emerald-500/15 hover:bg-emerald-500/25 border border-emerald-500/30 text-emerald-400 text-xs font-bold flex items-center justify-between transition">
                                <span class="flex items-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                    <span>WhatsApp: {{ $storeSettings['phone'] ?? ('+' . $storeSettings['whatsapp_number']) }}</span>
                                </span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        @endif

                        <ul class="space-y-1.5 text-xs text-stone-400 font-light">
                            @if(!empty($storeSettings['instagram_url']))
                                <li class="flex items-center gap-2">
                                    <i class="fa-brands fa-instagram text-amber-400"></i>
                                    <a href="{{ $storeSettings['instagram_url'] }}" target="_blank" class="hover:text-amber-300">Instagram: @zvarrjewelspk</a>
                                </li>
                            @endif
                            @if(!empty($storeSettings['email']))
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-envelope text-blue-400"></i>
                                    <a href="mailto:{{ $storeSettings['email'] }}" class="hover:text-amber-300">{{ $storeSettings['email'] }}</a>
                                </li>
                            @endif
                            <li class="flex items-center gap-2 text-[11px] text-stone-500 pt-1">
                                <i class="fa-solid fa-location-dot text-amber-400/80"></i>
                                <span>{{ $storeSettings['address'] ?? 'Karachi, Pakistan' }} • Express COD</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- Trust Badges Ribbon -->
            <div class="py-5 sm:py-6 border-y border-white/5 grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 text-center">
                <div class="flex items-center justify-center gap-2 text-stone-300 text-[11px] sm:text-xs font-semibold">
                    <i class="fa-solid fa-shield-halved text-amber-400 text-sm"></i>
                    <span>100% Anti-Tarnish</span>
                </div>
                <div class="flex items-center justify-center gap-2 text-stone-300 text-[11px] sm:text-xs font-semibold">
                    <i class="fa-solid fa-box-open text-amber-400 text-sm"></i>
                    <span>Open Parcel Checking</span>
                </div>
                <div class="flex items-center justify-center gap-2 text-stone-300 text-[11px] sm:text-xs font-semibold">
                    <i class="fa-solid fa-gem text-amber-400 text-sm"></i>
                    <span>18K / 22K Gold Finish</span>
                </div>
                <div class="flex items-center justify-center gap-2 text-stone-300 text-[11px] sm:text-xs font-semibold">
                    <i class="fa-solid fa-truck-fast text-amber-400 text-sm"></i>
                    <span>Fast COD Nationwide 🇵🇰</span>
                </div>
            </div>

            <!-- Bottom Copyright & Developer Credit -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between text-xs text-stone-500 gap-3 text-center sm:text-left">
                <div>
                    <p>&copy; {{ date('Y') }} ZVARR by Zaiyal. All Rights Reserved.</p>
                    <p class="text-[11px] text-stone-400 mt-0.5">
                        Designed &amp; Developed by <span class="text-amber-300 font-semibold">Daniyal Sheikh</span>
                    </p>
                </div>

                <div class="flex items-center gap-3 sm:gap-4 text-[11px]">
                    <a href="{{ route('about') }}" class="hover:text-amber-300 transition">About</a>
                    <span>•</span>
                    <a href="{{ route('contact') }}" class="hover:text-amber-300 transition">Contact</a>
                    <span>•</span>
                    <a href="{{ route('shop.index') }}" class="hover:text-amber-300 transition">Catalog</a>
                </div>
            </div>

        </div>
    </footer>

    <!-- IN-PLACE VIP LUXURY AUTH POPUP MODAL -->
    <div id="auth-modal" class="{{ ($errors->any() && !Auth::check()) ? 'flex' : 'hidden' }} fixed inset-0 bg-black/85 backdrop-blur-md z-50 items-center justify-center p-4">
        <div class="glass-card-3d bg-gradient-to-b from-[#16161c] via-[#09090b] to-[#040405] p-6 sm:p-8 rounded-3xl border border-amber-400/30 max-w-md w-full shadow-2xl relative">
            
            <!-- Close Button -->
            <button onclick="closeAuthModal()" class="absolute top-5 right-5 text-stone-400 hover:text-white transition w-8 h-8 rounded-full bg-white/5 flex items-center justify-center">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>

            <!-- Brand Header (Reference Luxury Design) -->
            <div class="text-center mb-6 space-y-1.5 flex flex-col items-center">
                <!-- Top Star Accent -->
                <span class="text-amber-300 text-[9px] leading-none mb-0.5 animate-pulse">✦</span>
                
                <!-- Main Serif Wordmark -->
                <span class="font-cinzel font-semibold text-2xl tracking-[0.3em] text-transparent bg-clip-text bg-gradient-to-b from-[#FFF5D1] via-[#E8C265] to-[#AA7C11] block leading-none pl-[0.3em] drop-shadow-[0_2px_10px_rgba(217,119,6,0.4)]">
                    ZVARR
                </span>
                
                <!-- Center Hairline Divider with Diamond Rhombus -->
                <div class="flex items-center justify-center w-full max-w-[145px] my-1 relative">
                    <div class="h-[1px] flex-1 bg-gradient-to-r from-transparent via-amber-400/80 to-amber-300"></div>
                    <span class="text-[7px] text-amber-300 px-1 leading-none drop-shadow-[0_0_4px_rgba(245,158,11,0.8)]">◆</span>
                    <div class="h-[1px] flex-1 bg-gradient-to-l from-transparent via-amber-400/80 to-amber-300"></div>
                </div>
                
                <!-- Subtitle Tagline -->
                <span class="text-[8.5px] uppercase font-bold tracking-[0.48em] text-[#E8C265] leading-none pl-[0.48em]">
                    BY ZAIYAL
                </span>

                <h3 class="text-xl font-serif-luxury font-normal text-white pt-2">Vault Access</h3>
                <p class="text-[11px] text-stone-400 font-light">Exclusive access to bespoke jewelry & order tracking</p>
            </div>

            <!-- Tabs: Sign In / Create Account -->
            <div class="flex rounded-xl bg-black/50 p-1 border border-white/10 mb-5">
                <button id="login-tab-btn" onclick="switchAuthTab('login')" 
                    class="flex-1 py-2 text-xs font-bold rounded-lg transition bg-amber-400/20 text-amber-300 border border-amber-400/40">
                    Sign In
                </button>
                <button id="register-tab-btn" onclick="switchAuthTab('register')" 
                    class="flex-1 py-2 text-xs font-bold rounded-lg transition text-stone-400 hover:text-white">
                    Create Account
                </button>
            </div>

            <!-- Error Messages -->
            @if($errors->any())
                <div class="mb-4 p-3 bg-rose-500/10 border border-rose-500/30 text-rose-400 text-xs font-medium rounded-xl">
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- 1. SIGN IN FORM -->
            <div id="login-tab-content">
                <form action="{{ url('/login') }}" method="POST" class="space-y-3.5">
                    @csrf
                    <div>
                        <label class="block text-[9.5px] uppercase font-bold tracking-widest text-stone-400 mb-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="you@example.com"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-black/60 border border-white/10 text-white placeholder-stone-600 text-xs focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>

                    <div>
                        <label class="block text-[9.5px] uppercase font-bold tracking-widest text-stone-400 mb-1">Password</label>
                        <input type="password" name="password" required
                            placeholder="••••••••"
                            class="w-full px-3.5 py-2.5 rounded-xl bg-black/60 border border-white/10 text-white placeholder-stone-600 text-xs focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>

                    <div class="flex items-center justify-between pt-0.5">
                        <label class="flex items-center gap-1.5 cursor-pointer">
                            <input type="checkbox" name="remember" class="w-3.5 h-3.5 rounded bg-black/60 border-white/20 text-amber-500 focus:ring-amber-400">
                            <span class="text-[11px] text-stone-400">Remember Me</span>
                        </label>
                    </div>

                    <button type="submit" 
                        class="w-full py-3 bg-gradient-to-r from-amber-400 via-amber-500 to-yellow-600 hover:opacity-95 text-black font-extrabold text-xs uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-amber-500/20 transition transform hover:-translate-y-0.5 mt-1">
                        Sign In
                    </button>
                </form>
            </div>

            <!-- 2. CREATE ACCOUNT FORM -->
            <div id="register-tab-content" class="hidden">
                <form action="{{ url('/register') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-[9.5px] uppercase font-bold tracking-widest text-stone-400 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            placeholder="e.g. Ayesha Khan"
                            class="w-full px-3.5 py-2 rounded-xl bg-black/60 border border-white/10 text-white placeholder-stone-600 text-xs focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>

                    <div>
                        <label class="block text-[9.5px] uppercase font-bold tracking-widest text-stone-400 mb-1">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="you@example.com"
                            class="w-full px-3.5 py-2 rounded-xl bg-black/60 border border-white/10 text-white placeholder-stone-600 text-xs focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>

                    <div>
                        <label class="block text-[9.5px] uppercase font-bold tracking-widest text-stone-400 mb-1">Password</label>
                        <input type="password" name="password" required
                            placeholder="••••••••"
                            class="w-full px-3.5 py-2 rounded-xl bg-black/60 border border-white/10 text-white placeholder-stone-600 text-xs focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>

                    <div>
                        <label class="block text-[9.5px] uppercase font-bold tracking-widest text-stone-400 mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" required
                            placeholder="••••••••"
                            class="w-full px-3.5 py-2 rounded-xl bg-black/60 border border-white/10 text-white placeholder-stone-600 text-xs focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition">
                    </div>

                    <button type="submit" 
                        class="w-full py-3 bg-gradient-to-r from-amber-400 via-amber-500 to-yellow-600 hover:opacity-95 text-black font-extrabold text-xs uppercase tracking-[0.2em] rounded-xl shadow-xl shadow-amber-500/20 transition transform hover:-translate-y-0.5 mt-2">
                        Create Account
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        }

        function openAuthModal(tab = 'login') {
            const modal = document.getElementById('auth-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            switchAuthTab(tab);
        }

        function closeAuthModal() {
            const modal = document.getElementById('auth-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function switchAuthTab(tab) {
            const loginContent = document.getElementById('login-tab-content');
            const regContent = document.getElementById('register-tab-content');
            const loginBtn = document.getElementById('login-tab-btn');
            const regBtn = document.getElementById('register-tab-btn');

            if (tab === 'login') {
                loginContent.classList.remove('hidden');
                regContent.classList.add('hidden');
                loginBtn.classList.add('bg-amber-400/20', 'text-amber-300', 'border-amber-400/40');
                loginBtn.classList.remove('text-stone-400');
                regBtn.classList.remove('bg-amber-400/20', 'text-amber-300', 'border-amber-400/40');
                regBtn.classList.add('text-stone-400');
            } else {
                loginContent.classList.add('hidden');
                regContent.classList.remove('hidden');
                regBtn.classList.add('bg-amber-400/20', 'text-amber-300', 'border-amber-400/40');
                regBtn.classList.remove('text-stone-400');
                loginBtn.classList.remove('bg-amber-400/20', 'text-amber-300', 'border-amber-400/40');
                loginBtn.classList.add('text-stone-400');
            }
        }

        // Ambient Gold Particles Background Engine
        (function() {
            const canvas = document.getElementById('particles-canvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let particles = [];

            function resize() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            }
            window.addEventListener('resize', resize);
            resize();

            class Particle {
                constructor() { this.reset(); }
                reset() {
                    this.x = Math.random() * canvas.width;
                    this.y = Math.random() * canvas.height;
                    this.size = Math.random() * 1.5 + 0.5;
                    this.speedY = Math.random() * 0.3 + 0.1;
                    this.speedX = (Math.random() - 0.5) * 0.2;
                    this.opacity = Math.random() * 0.4 + 0.1;
                }
                update() {
                    this.y -= this.speedY;
                    this.x += this.speedX;
                    if (this.y < 0) this.y = canvas.height;
                    if (this.x < 0) this.x = canvas.width;
                    if (this.x > canvas.width) this.x = 0;
                }
                draw() {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(212, 175, 55, ${this.opacity})`;
                    ctx.fill();
                }
            }

            for (let i = 0; i < 25; i++) {
                particles.push(new Particle());
            }

            function animate() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                particles.forEach(p => {
                    p.update();
                    p.draw();
                });
                requestAnimationFrame(animate);
            }
            animate();
        })();

        // Automated Luxury Image Background Remover (True Alpha Segmentation)
        function autoRemoveWhiteBackgrounds() {
            const images = document.querySelectorAll('img.auto-remove-bg');
            images.forEach(img => {
                if (img.dataset.bgProcessed || (img.src && img.src.startsWith('data:'))) {
                    img.dataset.bgProcessed = 'true';
                    return;
                }

                const process = () => {
                    if (img.dataset.bgProcessed) return;
                    try {
                        const canvas = document.createElement('canvas');
                        const ctx = canvas.getContext('2d', { willReadFrequently: true });
                        const w = img.naturalWidth || img.width;
                        const h = img.naturalHeight || img.height;
                        if (!w || !h) return;

                        canvas.width = w;
                        canvas.height = h;
                        ctx.drawImage(img, 0, 0, w, h);

                        const imgData = ctx.getImageData(0, 0, w, h);
                        const d = imgData.data;

                        const getPixel = (x, y) => {
                            const idx = (y * w + x) * 4;
                            return [d[idx], d[idx + 1], d[idx + 2]];
                        };

                        const corners = [
                            getPixel(0, 0),
                            getPixel(w - 1, 0),
                            getPixel(0, h - 1),
                            getPixel(w - 1, h - 1)
                        ];

                        let bgR = 0, bgG = 0, bgB = 0;
                        corners.forEach(c => { bgR += c[0]; bgG += c[1]; bgB += c[2]; });
                        bgR /= corners.length; bgG /= corners.length; bgB /= corners.length;

                        // Only process if corner indicates white / light / solid background
                        if (bgR > 190 && bgG > 190 && bgB > 190) {
                            const visited = new Uint8Array(w * h);
                            const queue = [];

                            for (let x = 0; x < w; x++) {
                                queue.push(x, 0);
                                queue.push(x, h - 1);
                                visited[x] = 1;
                                visited[(h - 1) * w + x] = 1;
                            }
                            for (let y = 0; y < h; y++) {
                                queue.push(0, y);
                                queue.push(w - 1, y);
                                visited[y * w] = 1;
                                visited[y * w + (w - 1)] = 1;
                            }

                            const threshold = 40;
                            const feather = 18;
                            let head = 0;

                            while (head < queue.length) {
                                const cx = queue[head++];
                                const cy = queue[head++];
                                const idx = (cy * w + cx) * 4;

                                const r = d[idx], g = d[idx + 1], b = d[idx + 2];
                                const dist = Math.sqrt(Math.pow(r - bgR, 2) + Math.pow(g - bgG, 2) + Math.pow(b - bgB, 2));

                                if (dist <= threshold + feather) {
                                    if (dist <= threshold) {
                                        d[idx + 3] = 0; // Transparent
                                    } else {
                                        const factor = (dist - threshold) / feather;
                                        d[idx + 3] = Math.round(d[idx + 3] * factor);
                                    }

                                    const neighbors = [
                                        [cx + 1, cy], [cx - 1, cy],
                                        [cx, cy + 1], [cx, cy - 1]
                                    ];

                                    for (let i = 0; i < neighbors.length; i++) {
                                        const nx = neighbors[i][0];
                                        const ny = neighbors[i][1];

                                        if (nx >= 0 && nx < w && ny >= 0 && ny < h) {
                                            const nPos = ny * w + nx;
                                            if (!visited[nPos]) {
                                                visited[nPos] = 1;
                                                const nIdx = nPos * 4;
                                                const nDist = Math.sqrt(
                                                    Math.pow(d[nIdx] - bgR, 2) +
                                                    Math.pow(d[nIdx + 1] - bgG, 2) +
                                                    Math.pow(d[nIdx + 2] - bgB, 2)
                                                );
                                                if (nDist <= threshold + feather) {
                                                    queue.push(nx, ny);
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                            ctx.putImageData(imgData, 0, 0);
                            img.src = canvas.toDataURL('image/png');
                        }
                        img.dataset.bgProcessed = 'true';
                    } catch (e) {
                        img.dataset.bgProcessed = 'fallback';
                    }
                };

                if (img.complete && img.naturalWidth) {
                    process();
                } else {
                    img.addEventListener('load', process, { once: true });
                }
            });
        }

        document.addEventListener('DOMContentLoaded', autoRemoveWhiteBackgrounds);
        window.addEventListener('load', autoRemoveWhiteBackgrounds);
    </script>

</body>
</html>
