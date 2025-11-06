<x-layout>
    <x-slot:title>Instructor Dashboard - CALLA</x-slot:title>

    <!-- NAVBAR -->
    <x-navbar />

    @if(session('success'))
        <x-toast :message="session('success')" />
    @endif

    <!-- DASHBOARD CONTAINER -->
    <div class="flex min-h-screen bg-white pt-15">

        <!-- SIDEBAR -->
        <x-sidebar />


        <!-- MAIN CONTENT -->
        <main class="flex-1 ml-64 p-8 overflow-y-auto">

            <!-- 📊 DASHBOARD OVERVIEW -->
            <section class="mb-10">
                <div class="hero rounded-2xl bg-gradient-to-r from-red-900 via-red-700 to-red-600 text-white p-10 ">

                    <div class="hero-content flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10 lg:gap-20 w-full">
                        <div>
                            <h2 class="text-5xl font-bold">Dashboard Overview</h2>
                            <p class="py-6 opacity-80">Welcome {{ auth()->user()->role }}, here's everything so far ^_^</p>
                        </div>

                        <!-- DaisyUI Stats -->
                        <div class="stats stats-vertical sm:stats-horizontal shadow mt-4 lg:mt-0 flex-shrink-0">
                            <div class="stat bg-white/10 text-white backdrop-blur-md">
                                <div class="stat-title text-gray-200">Total Classes</div>
                                <div class="stat-value text-white">{{ $data['classroom_count'] }}</div>
                            </div>

                            <div class="stat bg-white/10 text-white backdrop-blur-md">
                                <div class="stat-title text-gray-200">Total Modules</div>
                                <div class="stat-value text-white">{{ $data['module_count'] }}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

            <!-- 🏫 CLASS LIST -->
            <section class="mb-10">
                <div class="card bg-base-100 shadow-lg border">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <h3 class="card-title text-lg">My Classrooms</h3>
                            <a class="btn btn-sm bg-red-800 hover:bg-red-700 text-white" href="/classrooms">View All</a>
                        </div>
                        <div class="overflow-x-auto mt-4">
                            <table class="table table-zebra w-full">
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
                                            <td>{{ $classroom->description }}</td>
                                            <td>{{ $classroom->enrollee_count }}</td>
                                            <td>{{ $classroom->created_at}}</td>
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
                        <div class="flex items-center justify-between">
                            <h3 class="card-title text-lg">My Modules</h3>
                            <a class="btn btn-sm bg-red-800 hover:bg-red-700 text-white" href="/modules">View All</a>
                        </div>

                        <div class="overflow-x-auto mt-4">
                            <table class="table table-zebra w-full">
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
                                            <td>{{ $module->description }}</td>
                                            <td>{{ $module->ClassroomModule_count }}</td>
                                            <td>{{ $module->created_at}}</td>
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
