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
                                <div class="stat-value text-white">8</div>
                            </div>

                            <div class="stat bg-white/10 text-white backdrop-blur-md">
                                <div class="stat-title text-gray-200">Active Students</div>
                                <div class="stat-value text-white">120</div>
                            </div>

                            <div class="stat bg-white/10 text-white backdrop-blur-md">
                                <div class="stat-title text-gray-200">Modules</div>
                                <div class="stat-value text-white">45</div>
                            </div>

                            <div class="stat bg-white/10 text-white backdrop-blur-md">
                                <div class="stat-title text-gray-200">Tests</div>
                                <div class="stat-value text-white">6</div>
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
                            <h3 class="card-title text-lg">My Classes</h3>
                            <button class="btn btn-sm bg-red-800 hover:bg-red-700 text-white">+ New Class</button>
                        </div>

                        <div class="overflow-x-auto mt-4">
                            <table class="table table-zebra w-full">
                                <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Subject</th>
                                        <th>Students</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Class 2A</td>
                                        <td>English Basics</td>
                                        <td>25</td>
                                        <td>
                                            <button class="btn btn-link text-red-700 no-underline hover:underline">View</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Class 3B</td>
                                        <td>Reading Skills</td>
                                        <td>30</td>
                                        <td>
                                            <button class="btn btn-link text-red-700 no-underline hover:underline">View</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 👨‍🎓 STUDENT MANAGEMENT -->
            <section class="mb-10">
                <div class="card bg-base-100 shadow-lg border">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <h3 class="card-title text-lg">Student Management</h3>
                            <button class="btn btn-sm bg-red-800 hover:bg-red-700 text-white">+ Add Student</button>
                        </div>

                        <div class="overflow-x-auto mt-4">
                            <table class="table table-zebra w-full">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Class</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Juan Dela Cruz</td>
                                        <td>Class 2A</td>
                                        <td>juan@example.com</td>
                                        <td><span class="badge badge-success">Active</span></td>
                                        <td>
                                            <button class="btn btn-link text-red-700 no-underline hover:underline">View</button>
                                            <button class="btn btn-link text-gray-500 no-underline hover:underline">Edit</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Maria Santos</td>
                                        <td>Class 3B</td>
                                        <td>maria@example.com</td>
                                        <td><span class="badge badge-success">Active</span></td>
                                        <td>
                                            <button class="btn btn-link text-red-700 no-underline hover:underline">View</button>
                                            <button class="btn btn-link text-gray-500 no-underline hover:underline">Edit</button>
                                        </td>
                                    </tr>
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
                            <h3 class="card-title text-lg">Module Management</h3>
                            <button class="btn btn-sm bg-red-800 hover:bg-red-700 text-white">+ New Module</button>
                        </div>

                        <div class="overflow-x-auto mt-4">
                            <table class="table table-zebra w-full">
                                <thead>
                                    <tr>
                                        <th>Module Title</th>
                                        <th>Class</th>
                                        <th>Date Added</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Module 1: Grammar Basics</td>
                                        <td>Class 2A</td>
                                        <td>Nov 1, 2025</td>
                                        <td><span class="badge badge-success">Published</span></td>
                                        <td>
                                            <button class="btn btn-link text-red-700 no-underline hover:underline">View</button>
                                            <button class="btn btn-link text-gray-500 no-underline hover:underline">Edit</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Module 2: Reading Practice</td>
                                        <td>Class 3B</td>
                                        <td>Nov 3, 2025</td>
                                        <td><span class="badge badge-warning">Draft</span></td>
                                        <td>
                                            <button class="btn btn-link text-red-700 no-underline hover:underline">View</button>
                                            <button class="btn btn-link text-gray-500 no-underline hover:underline">Edit</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

        </main>
    </div>
</x-layout>
