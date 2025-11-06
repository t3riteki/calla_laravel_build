<x-layout>
    <x-slot:title>Instructor Dashboard - CALLA</x-slot:title>

    <!-- NAVBAR -->
    <x-navbar />

    @if(session('success'))
        <x-toast :message="session('success')" />
    @endif

    <!-- DASHBOARD CONTAINER -->
    <div class="flex flex-col lg:flex-row min-h-screen bg-white pt-15 transition-all duration-300">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN CONTENT -->
        <main
            class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto
                   lg:ml-64 md:ml-56 sm:ml-0 transition-all duration-300">

            <!-- 📊 DASHBOARD OVERVIEW -->
            <section class="mb-10">
                <div class="hero rounded-2xl bg-gradient-to-r from-red-900 via-red-700 to-red-600 text-white p-6 sm:p-8 md:p-10">
                    <div class="hero-content flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 lg:gap-16 w-full">
                        <div>
                            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold">Dashboard Overview</h2>
                            <p class="py-4 text-sm sm:text-base opacity-80">
                                Welcome {{ auth()->user()->role }}, here's everything so far ^_^
                            </p>
                        </div>

                        <!-- DaisyUI Stats -->
                        <div class="stats stats-vertical sm:stats-horizontal shadow mt-4 lg:mt-0 flex-shrink-0">
                            <div class="stat bg-white/10 text-white backdrop-blur-md">
                                <div class="stat-title text-gray-200">Total Classes</div>
                                <div class="stat-value text-white text-2xl sm:text-3xl">
                                    {{ $data['classroom_count'] }}
                                </div>
                            </div>

                            <div class="stat bg-white/10 text-white backdrop-blur-md">
                                <div class="stat-title text-gray-200">Total Modules</div>
                                <div class="stat-value text-white text-2xl sm:text-3xl">
                                    {{ $data['module_count'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 🏫 CLASS LIST -->
            <section class="mb-10">
                <div class="card bg-base-100 shadow-lg border">
                    <div class="card-body">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <h3 class="card-title text-lg sm:text-xl">My Classrooms</h3>
                            <a class="btn btn-sm bg-red-800 hover:bg-red-700 text-white w-full sm:w-auto" href="/classrooms">
                                View All
                            </a>
                        </div>

                        <div class="overflow-x-auto mt-4">
                            <table class="table table-zebra w-full text-sm sm:text-base">
                                <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Class Description</th>
                                        <th>Enrollees</th>
                                        <th>Date Added</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['classrooms'] as $classroom)
                                        <tr>
                                            <td>{{ $classroom->name }}</td>
                                            <td class="max-w-[150px] truncate">{{ $classroom->description }}</td>
                                            <td>{{ $classroom->enrollee_count }}</td>
                                            <td>{{ $classroom->created_at }}</td>
                                            <td class="py-3 px-4 space-x-2">
                                                <button class="text-red-700 hover:underline">View</button>
                                                <button class="text-gray-500 hover:underline">Edit</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 📚 MODULE MANAGEMENT -->
            <section>
                <div class="card bg-base-100 shadow-lg border">
                    <div class="card-body">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <h3 class="card-title text-lg sm:text-xl">My Modules</h3>
                            <a class="btn btn-sm bg-red-800 hover:bg-red-700 text-white w-full sm:w-auto" href="/modules">
                                View All
                            </a>
                        </div>

                        <div class="overflow-x-auto mt-4">
                            <table class="table table-zebra w-full text-sm sm:text-base">
                                <thead>
                                    <tr>
                                        <th>Module Title</th>
                                        <th>Module Description</th>
                                        <th>Instance Count</th>
                                        <th>Date Added</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['modules'] as $module)
                                        <tr>
                                            <td>{{ $module->name }}</td>
                                            <td class="max-w-[150px] truncate">{{ $module->description }}</td>
                                            <td>{{ $module->ClassroomModule_count }}</td>
                                            <td>{{ $module->created_at }}</td>
                                            <td class="py-3 px-4 space-x-2">
                                                <button class="text-red-700 hover:underline">View</button>
                                                <button class="text-gray-500 hover:underline">Edit</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

        </main>
    </div>
</x-layout>
