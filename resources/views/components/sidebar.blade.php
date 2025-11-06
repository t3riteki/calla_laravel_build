<!-- SIDEBAR / NAVIGATION -->
<aside class="bg-white md:w-64 md:fixed md:top-0 md:left-0 md:min-h-screen md:flex md:flex-col shadow-sm">
    <nav class="flex flex-col md:flex-col md:p-4 p-2 space-y-2 text-gray-700 md:mt-16">

        @switch(auth()->user()->role)
            @case('admin')
                <div class="flex flex-wrap md:flex-col justify-center md:justify-start gap-2 md:gap-0">
                    <a href="/dashboard" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                        <i class="ri-dashboard-line text-lg"></i> Dashboard
                    </a>
                    <a href="/classrooms" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                        <i class="ri-graduation-cap-line text-lg"></i> Classrooms
                    </a>
                    <a href="/modules" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                        <i class="ri-book-2-line text-lg"></i> Modules
                    </a>
                    <a href="/dashboard" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                        <i class="ri-restaurant-line text-lg"></i> Saging Delata
                    </a>
                </div>
                @break

            @case('instructor')
                <div class="flex flex-wrap md:flex-col justify-center md:justify-start gap-2 md:gap-0">
                    <a href="/dashboard" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                        <i class="ri-dashboard-line text-lg"></i> Dashboard
                    </a>
                    <a href="/classrooms" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                        <i class="ri-graduation-cap-line text-lg"></i> Classrooms
                    </a>
                    <a href="/modules" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                        <i class="ri-book-2-line text-lg"></i> Modules
                    </a>
                    <a href="/dashboard" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                        <i class="ri-restaurant-line text-lg"></i> Saging Delata
                    </a>
                </div>
                @break

            @case('learner')
                <div class="flex flex-wrap md:flex-col justify-center md:justify-start gap-2 md:gap-0">
                    <a href="/dashboard" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                        <i class="ri-dashboard-line text-lg"></i> Dashboard
                    </a>
                    <a href="/classrooms" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                        <i class="ri-graduation-cap-line text-lg"></i> Classrooms
                    </a>
                    <a href="/modules" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                        <i class="ri-book-2-line text-lg"></i> Modules
                    </a>
                    <a href="/dashboard" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                        <i class="ri-restaurant-line text-lg"></i> Saging Delata
                    </a>
                </div>
                @break

            @default
                <p class="text-red-700 font-bold text-center md:text-left">Unauthorized access</p>
        @endswitch
    </nav>
</aside>

