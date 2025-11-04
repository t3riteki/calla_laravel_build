<!-- SIDEBAR -->
<aside class="w-64 fixed bg-white flex flex-col min-h-screen">
    <nav class="flex-1 p-4 space-y-2 text-gray-700">
        @switch(auth()->user()->role)
            @case('admin')
                <a href="/dashboard" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                    <i class="ri-dashboard-line text-lg"></i> Dashboard
                </a>
                <a href="/classrooms" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                    <i class="ri-dashboard-line text-lg"></i> Classrooms
                </a>
                <a href="/modules" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                    <i class="ri-dashboard-line text-lg"></i> Modules
                </a>
                <a href="/dashboard" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                    <i class="ri-dashboard-line text-lg"></i> Saging Delata
                </a>

                @break

            @case('instructor')
                <a href="/dashboard" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                    <i class="ri-dashboard-line text-lg"></i> Dashboard
                </a>
                <a href="/classrooms" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                    <i class="ri-dashboard-line text-lg"></i> Classrooms
                </a>
                <a href="/modules" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                    <i class="ri-dashboard-line text-lg"></i> Modules
                </a>
                <a href="/dashboard" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                    <i class="ri-dashboard-line text-lg"></i> Saging Delata
                </a>
                @break

            @case('learner')
                <a href="/dashboard" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                    <i class="ri-dashboard-line text-lg"></i> Dashboard
                </a>
                <a href="/classrooms" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                    <i class="ri-dashboard-line text-lg"></i> Classrooms
                </a>
                <a href="/modules" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                    <i class="ri-dashboard-line text-lg"></i> Modules
                </a>
                <a href="/dashboard" class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-red-50 hover:text-red-800 transition">
                    <i class="ri-dashboard-line text-lg"></i> Saging Delata
                </a>

                @break
            @default
                <p>Go hack something else retard</p>
        @endswitch

    </nav>
</aside>


