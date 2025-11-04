<!-- HEADER / NAVBAR -->
<header class="bg-white shadow-sm border-b border-gray-200 h-16 flex items-center justify-between px-6 sticky top-0 z-50">

    <!-- LEFT SIDE: PAGE TITLE OR LOGO -->
    <div class="flex items-center gap-3">
        <button id="menu-toggle" class="text-gray-600 text-2xl lg:hidden">
            <i class="ri-menu-line"></i>
        </button>
        <h1 class="text-xl font-bold text-red-800 tracking-wide">CALLA</h1>
    </div>

    <!-- MIDDLE: SEARCH BAR (optional) -->
    <div class="hidden md:flex items-center bg-gray-100 px-4 py-2 rounded-lg w-1/3">
        <i class="ri-search-line text-gray-500 mr-2"></i>
        <input type="text" placeholder="Search classes, students, modules..."
               class="bg-transparent w-full outline-none text-sm text-gray-700 placeholder-gray-500">
    </div>

    <!-- RIGHT SIDE: NOTIFICATIONS + PROFILE -->
    <div class="flex items-center gap-5">
        <!-- Notifications -->
        <button class="relative text-gray-600 hover:text-red-800 transition">
            <i class="ri-notification-3-line text-xl"></i>
            <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-600 rounded-full"></span>
        </button>

        <!-- Profile -->
        <div class="relative group">
            <button class="flex items-center gap-3 focus:outline-none">
                <img src="{{ asset('images/profile-placeholder.png') }}"
                     alt="Profile" class="w-9 h-9 rounded-full object-cover border-2 border-red-700">
                <span class="hidden md:block text-sm font-medium text-gray-700">John Doe</span>
                <i class="ri-arrow-down-s-line text-gray-600"></i>
            </button>

            <!-- Dropdown -->
            <div class="absolute right-0 mt-2 w-44 bg-white shadow-md rounded-lg border border-gray-100 opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-opacity">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-800">Profile</a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-red-50 hover:text-red-800">Settings</a>
                <div class="border-t border-gray-100 mt-1 px-4 py-2">
                    <span class="text-sm text-gray-700 block mb-1">{{ auth()->user()->name }}</span>
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-red-700 hover:text-red-800 font-medium">Logout</button>
                    </form>
            </div>
        </div>
    </div>

</header>
