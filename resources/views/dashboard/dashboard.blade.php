<x-layout>
    <x-slot:title>Teacher Dashboard - CALLA</x-slot:title>

    <!-- NAVBAR (Header) -->
    <x-instructor-navbar id="about" class="navbar" />

    <!-- DASHBOARD CONTAINER -->
    <div class="flex min-h-screen bg-gray-50">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-red-900 text-white flex flex-col fixed top-16 left-0 bottom-0 h-full shadow-sm border-r border-gray-200">
            <x-instructor-sidebar />
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 ml-64 p-8 overflow-y-auto">

            <!-- 📊 DASHBOARD OVERVIEW -->
            <section class="mb-10 relative rounded-2xl overflow-hidden">
                <!-- Background -->
                <div class="absolute inset-0 bg-gradient-to-r from-red-900 via-red-700 to-red-600 opacity-90"></div>

                <!-- Content -->
                <div class="relative p-8 md:p-10 lg:p-12 text-white">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                        <div>
                            <h2 class="text-2xl font-bold">📊 Dashboard Overview</h2>
                            <p class="text-sm opacity-90">Welcome Instructor, here's everything so far ^_^</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                        <div class="bg-white/10 backdrop-blur-md p-6 rounded-xl shadow-sm hover:shadow-lg transition">
                            <h3 class="text-sm font-medium text-gray-200">Total Classes</h3>
                            <p class="text-3xl font-bold text-white mt-2">8</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md p-6 rounded-xl shadow-sm hover:shadow-lg transition">
                            <h3 class="text-sm font-medium text-gray-200">Active Students</h3>
                            <p class="text-3xl font-bold text-white mt-2">120</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md p-6 rounded-xl shadow-sm hover:shadow-lg transition">
                            <h3 class="text-sm font-medium text-gray-200">Modules</h3>
                            <p class="text-3xl font-bold text-white mt-2">45</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur-md p-6 rounded-xl shadow-sm hover:shadow-lg transition">
                            <h3 class="text-sm font-medium text-gray-200">Tests</h3>
                            <p class="text-3xl font-bold text-white mt-2">6</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 🏫 CLASS LIST -->
            <section class="mb-10">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">My Classes</h3>
                        <button class="bg-red-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 transition">
                            + New Class
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b bg-gray-50">
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Class Name</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Subject</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Students</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="py-3 px-4">Class 2A</td>
                                    <td class="py-3 px-4">English Basics</td>
                                    <td class="py-3 px-4">25</td>
                                    <td class="py-3 px-4">
                                        <button class="text-red-700 hover:underline">View</button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-3 px-4">Class 3B</td>
                                    <td class="py-3 px-4">Reading Skills</td>
                                    <td class="py-3 px-4">30</td>
                                    <td class="py-3 px-4">
                                        <button class="text-red-700 hover:underline">View</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- 👨‍🎓 STUDENT MANAGEMENT -->
            <section class="mb-10">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Student Management</h3>
                        <button class="bg-red-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 transition">
                            + Add Student
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b bg-gray-50">
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Student Name</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Class</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Email</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="py-3 px-4">Juan Dela Cruz</td>
                                    <td class="py-3 px-4">Class 2A</td>
                                    <td class="py-3 px-4">juan@example.com</td>
                                    <td class="py-3 px-4"><span class="text-green-600 font-medium">Active</span></td>
                                    <td class="py-3 px-4 space-x-2">
                                        <button class="text-red-700 hover:underline">View</button>
                                        <button class="text-gray-500 hover:underline">Edit</button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-3 px-4">Maria Santos</td>
                                    <td class="py-3 px-4">Class 3B</td>
                                    <td class="py-3 px-4">maria@example.com</td>
                                    <td class="py-3 px-4"><span class="text-green-600 font-medium">Active</span></td>
                                    <td class="py-3 px-4 space-x-2">
                                        <button class="text-red-700 hover:underline">View</button>
                                        <button class="text-gray-500 hover:underline">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- 📚 MODULE MANAGEMENT -->
            <section>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Module Management</h3>
                        <button class="bg-red-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 transition">
                            + New Module
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b bg-gray-50">
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Module Title</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Class</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Date Added</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Status</th>
                                    <th class="py-3 px-4 text-sm font-semibold text-gray-600">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="py-3 px-4">Module 1: Grammar Basics</td>
                                    <td class="py-3 px-4">Class 2A</td>
                                    <td class="py-3 px-4">Nov 1, 2025</td>
                                    <td class="py-3 px-4"><span class="text-green-600 font-medium">Published</span></td>
                                    <td class="py-3 px-4 space-x-2">
                                        <button class="text-red-700 hover:underline">View</button>
                                        <button class="text-gray-500 hover:underline">Edit</button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-3 px-4">Module 2: Reading Practice</td>
                                    <td class="py-3 px-4">Class 3B</td>
                                    <td class="py-3 px-4">Nov 3, 2025</td>
                                    <td class="py-3 px-4"><span class="text-yellow-600 font-medium">Draft</span></td>
                                    <td class="py-3 px-4 space-x-2">
                                        <button class="text-red-700 hover:underline">View</button>
                                        <button class="text-gray-500 hover:underline">Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </main>
    </div>
</x-layout>
