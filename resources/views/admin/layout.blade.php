<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin CRM') - ZVARR Jewellery CRM</title>
    <!-- Luxury Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Cinzel & Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-cinzel { font-family: 'Cinzel', serif; }
        .font-serif-luxury { font-family: 'Cormorant Garamond', serif; }
        .glass-card-admin {
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex antialiased">

    <!-- DESKTOP SIDEBAR -->
    <aside class="w-64 bg-slate-900 border-r border-slate-800 flex flex-col justify-between hidden md:flex min-h-screen sticky top-0">
        <div>
            <!-- Brand Logo -->
            <div class="h-20 flex items-center px-6 border-b border-slate-800 gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-400 via-amber-500 to-yellow-600 flex items-center justify-center text-slate-950 shadow-md shadow-amber-500/20 font-bold text-lg">
                    <span class="font-cinzel font-black text-sm">Z</span>
                </div>
                <div>
                    <h1 class="font-cinzel font-bold text-base tracking-widest text-amber-200">ZVARR</h1>
                    <p class="text-[9px] uppercase font-bold tracking-widest text-amber-400">BY ZAIYAL CRM</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1.5">
                <a href="{{ route('admin.dashboard') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20 font-bold' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800' }}">
                    <i class="fa-solid fa-chart-pie text-base"></i>
                    Dashboard Overview
                </a>

                <a href="{{ route('admin.products.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.products.*') ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20 font-bold' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800' }}">
                    <i class="fa-solid fa-gem text-base"></i>
                    Jewellery Inventory
                </a>

                <a href="{{ route('admin.categories.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.categories.*') ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20 font-bold' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800' }}">
                    <i class="fa-solid fa-tags text-base"></i>
                    Categories
                </a>

                <a href="{{ route('admin.contacts.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.contacts.*') ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20 font-bold' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800' }}">
                    <i class="fa-solid fa-headset text-base"></i>
                    Contacts & Social
                </a>

                <a href="{{ route('admin.inquiries.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.inquiries.*') ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20 font-bold' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800' }}">
                    <i class="fa-solid fa-envelope-open-text text-base"></i>
                    Inquiries & Messages
                </a>

                <a href="{{ route('admin.reviews.index') }}" 
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition {{ request()->routeIs('admin.reviews.*') ? 'bg-amber-500 text-slate-950 shadow-md shadow-amber-500/20 font-bold' : 'text-slate-400 hover:text-slate-100 hover:bg-slate-800' }}">
                    <i class="fa-solid fa-star text-base"></i>
                    Customer Reviews
                </a>

                <a href="{{ url('/') }}" target="_blank"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-emerald-400 hover:bg-emerald-950/40 hover:text-emerald-300 transition border border-emerald-500/20 mt-4">
                    <i class="fa-solid fa-arrow-up-right-from-square text-base"></i>
                    View Live Storefront
                </a>
            </nav>
        </div>

        <!-- Admin Profile in Sidebar Bottom -->
        <div class="p-4 border-t border-slate-800">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-full bg-amber-500/20 border border-amber-500/40 text-amber-300 flex items-center justify-center font-bold text-xs">
                        👑
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-200">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-amber-400 font-semibold">Store Manager</p>
                    </div>
                </div>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" title="Logout" class="text-slate-400 hover:text-rose-400 p-2 transition">
                        <i class="fa-solid fa-power-off text-sm"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT WRAPPER -->
    <div class="flex-1 flex flex-col min-w-0">
        
        <!-- Top Navbar (Responsive Mobile & Desktop) -->
        <header class="h-16 sm:h-20 bg-slate-900/90 backdrop-blur-md border-b border-slate-800 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-2.5 min-w-0">
                <button type="button" onclick="toggleMobileMenu()" class="md:hidden w-9 h-9 rounded-xl bg-slate-800 hover:bg-slate-700 text-amber-400 flex items-center justify-center text-sm border border-slate-700">
                    <i class="fa-solid fa-bars"></i>
                </button>
                
                <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-amber-400 to-yellow-600 flex items-center justify-center text-slate-950 font-bold flex-shrink-0">
                    <span class="font-cinzel text-xs font-black">Z</span>
                </div>
                <h2 class="text-xs sm:text-base font-bold text-slate-100 truncate">
                    @yield('header_title', 'Admin CRM')
                </h2>
            </div>

            <div class="flex items-center gap-2 sm:gap-3 flex-shrink-0">
                <span class="hidden sm:inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/30">
                    <span class="w-1.5 h-1.5 mr-1.5 rounded-full bg-amber-400 animate-pulse"></span>
                    Live Mode
                </span>

                <a href="{{ url('/') }}" target="_blank" title="View Store"
                    class="p-2 sm:px-3 sm:py-1.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-emerald-400 border border-slate-700 text-xs font-bold flex items-center gap-1.5 transition">
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                    <span class="hidden sm:inline">Store</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" title="Logout" 
                        class="p-2 sm:px-3 sm:py-1.5 text-xs font-bold text-slate-400 hover:text-rose-400 bg-slate-800 hover:bg-rose-950/30 rounded-xl transition border border-slate-700 hover:border-rose-500/30">
                        <i class="fa-solid fa-power-off sm:mr-1"></i>
                        <span class="hidden sm:inline">Logout</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- Mobile Slide-out Drawer Navigation -->
        <div id="mobile-menu-drawer" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 md:hidden">
            <div class="w-72 bg-slate-900 h-full border-r border-slate-800 p-6 flex flex-col justify-between animate-smooth-in">
                <div class="space-y-6">
                    <div class="flex items-center justify-between border-b border-slate-800 pb-4">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-amber-400 to-yellow-600 flex items-center justify-center text-slate-950 font-bold">
                                <span class="font-cinzel text-xs font-black">Z</span>
                            </div>
                            <span class="font-cinzel font-bold text-sm tracking-widest text-amber-200">ZVARR CRM</span>
                        </div>
                        <button type="button" onclick="toggleMobileMenu()" class="text-slate-400 hover:text-white p-1 text-lg">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <nav class="space-y-2">
                        <a href="{{ route('admin.dashboard') }}" onclick="toggleMobileMenu()"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500 text-slate-950 font-extrabold' : 'text-slate-300 hover:bg-slate-800' }}">
                            <i class="fa-solid fa-chart-pie text-sm"></i>
                            <span>Dashboard Overview</span>
                        </a>

                        <a href="{{ route('admin.products.index') }}" onclick="toggleMobileMenu()"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition {{ request()->routeIs('admin.products.*') ? 'bg-amber-500 text-slate-950 font-extrabold' : 'text-slate-300 hover:bg-slate-800' }}">
                            <i class="fa-solid fa-gem text-sm"></i>
                            <span>Jewellery Inventory</span>
                        </a>

                        <a href="{{ route('admin.categories.index') }}" onclick="toggleMobileMenu()"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition {{ request()->routeIs('admin.categories.*') ? 'bg-amber-500 text-slate-950 font-extrabold' : 'text-slate-300 hover:bg-slate-800' }}">
                            <i class="fa-solid fa-tags text-sm"></i>
                            <span>Categories</span>
                        </a>

                        <a href="{{ route('admin.contacts.index') }}" onclick="toggleMobileMenu()"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition {{ request()->routeIs('admin.contacts.*') ? 'bg-amber-500 text-slate-950 font-extrabold' : 'text-slate-300 hover:bg-slate-800' }}">
                            <i class="fa-solid fa-headset text-sm"></i>
                            <span>Contacts & Social</span>
                        </a>

                        <a href="{{ route('admin.inquiries.index') }}" onclick="toggleMobileMenu()"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition {{ request()->routeIs('admin.inquiries.*') ? 'bg-amber-500 text-slate-950 font-extrabold' : 'text-slate-300 hover:bg-slate-800' }}">
                            <i class="fa-solid fa-envelope-open-text text-sm"></i>
                            <span>Inquiries & Messages</span>
                        </a>

                        <a href="{{ route('admin.reviews.index') }}" onclick="toggleMobileMenu()"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition {{ request()->routeIs('admin.reviews.*') ? 'bg-amber-500 text-slate-950 font-extrabold' : 'text-slate-300 hover:bg-slate-800' }}">
                            <i class="fa-solid fa-star text-sm"></i>
                            <span>Customer Reviews</span>
                        </a>

                        <a href="{{ url('/') }}" target="_blank"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold text-emerald-400 bg-emerald-950/30 border border-emerald-500/30 mt-4">
                            <i class="fa-solid fa-arrow-up-right-from-square text-sm"></i>
                            <span>View Storefront</span>
                        </a>
                    </nav>
                </div>

                <div class="border-t border-slate-800 pt-4 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold text-slate-200">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-amber-400 font-semibold">Store Manager</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-slate-400 hover:text-rose-400 p-2 text-sm">
                            <i class="fa-solid fa-power-off"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Body (Spaced for mobile bottom bar) -->
        <main class="flex-1 p-3.5 sm:p-8 pb-24 md:pb-8 max-w-7xl w-full mx-auto">
            
            <!-- Success Flash Notification -->
            @if(session('success'))
                <div class="mb-4 sm:mb-6 p-3.5 sm:p-4 bg-emerald-950/60 border border-emerald-500/40 text-emerald-300 text-xs sm:text-sm font-semibold rounded-2xl flex items-center gap-2.5 shadow-lg">
                    <i class="fa-solid fa-circle-check text-emerald-400 text-base flex-shrink-0"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Error Flash Notification -->
            @if($errors->any())
                <div class="mb-4 sm:mb-6 p-3.5 sm:p-4 bg-rose-950/60 border border-rose-500/40 text-rose-300 text-xs sm:text-sm font-medium rounded-2xl shadow-lg">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Sleek VIP Mobile Bottom Navigation Bar -->
        <nav class="md:hidden fixed bottom-0 inset-x-0 bg-slate-900/95 backdrop-blur-xl border-t border-slate-800 px-4 py-2 flex items-center justify-around z-40">
            <a href="{{ route('admin.dashboard') }}" 
                class="flex flex-col items-center gap-1 py-1 px-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'text-amber-400 font-bold' : 'text-slate-400 hover:text-slate-200' }}">
                <i class="fa-solid fa-chart-pie text-base"></i>
                <span class="text-[9.5px]">Dashboard</span>
            </a>

            <a href="{{ route('admin.products.index') }}" 
                class="flex flex-col items-center gap-1 py-1 px-3 rounded-xl {{ request()->routeIs('admin.products.*') ? 'text-amber-400 font-bold' : 'text-slate-400 hover:text-slate-200' }}">
                <i class="fa-solid fa-gem text-base"></i>
                <span class="text-[9.5px]">Inventory</span>
            </a>

            <a href="{{ route('admin.products.create') }}" 
                class="flex flex-col items-center gap-1 -mt-5 bg-gradient-to-tr from-amber-400 to-yellow-600 text-slate-950 w-12 h-12 rounded-full shadow-lg shadow-amber-500/30 flex items-center justify-center font-bold">
                <i class="fa-solid fa-plus text-base"></i>
            </a>

            <a href="{{ route('admin.categories.index') }}" 
                class="flex flex-col items-center gap-1 py-1 px-3 rounded-xl {{ request()->routeIs('admin.categories.*') ? 'text-amber-400 font-bold' : 'text-slate-400 hover:text-slate-200' }}">
                <i class="fa-solid fa-tags text-base"></i>
                <span class="text-[9.5px]">Categories</span>
            </a>

            <a href="{{ url('/') }}" target="_blank" 
                class="flex flex-col items-center gap-1 py-1 px-3 rounded-xl text-emerald-400">
                <i class="fa-solid fa-store text-base"></i>
                <span class="text-[9.5px]">Store</span>
            </a>
        </nav>

    </div>

    <!-- GLOBAL VIP LUXURY DELETE CONFIRMATION MODAL -->
    <div id="delete-confirm-modal" class="hidden fixed inset-0 bg-black/80 backdrop-blur-md z-50 items-center justify-center p-4">
        <div class="bg-slate-900 border border-rose-500/30 p-6 sm:p-8 rounded-3xl max-w-md w-full shadow-2xl relative animate-smooth-in space-y-5 text-center">
            
            <div class="w-14 h-14 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-400 flex items-center justify-center text-2xl mx-auto shadow-lg shadow-rose-500/10">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>

            <div class="space-y-1.5">
                <h3 class="text-xl font-bold text-white font-cinzel">Confirm Deletion</h3>
                <p class="text-xs text-slate-300 leading-relaxed">
                    Are you sure you want to permanently delete <br>
                    <span id="delete-modal-item-name" class="font-bold text-rose-400 underline decoration-rose-500/40"></span>?
                </p>
                <p class="text-[11px] text-slate-500">This action cannot be reversed.</p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-3 pt-2">
                <button type="button" onclick="closeDeleteModal()" 
                    class="flex-1 py-3 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white font-bold text-xs uppercase tracking-wider rounded-xl transition border border-slate-700">
                    Cancel
                </button>

                <form id="delete-modal-form" action="" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                        class="w-full py-3 bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 hover:to-red-500 text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-rose-600/30 transition transform hover:-translate-y-0.5">
                        Yes, Delete
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script>
        function toggleMobileMenu() {
            const drawer = document.getElementById('mobile-menu-drawer');
            drawer.classList.toggle('hidden');
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
