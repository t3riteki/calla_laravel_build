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
                            <!-- + New Class Button -->
                            <button onclick="newClassModal.showModal()"
                                class="bg-red-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 transition">
                                + New Class
                            </button>

                            <!-- Modern Modal -->
                            <dialog id="newClassModal" class="modal">
                                <div class="modal-box max-w-lg bg-white/95 backdrop-blur-md rounded-2xl shadow-lg border border-gray-100">
                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                            <span class="text-red-800 text-xl">📚</span> New Class
                                        </h3>
                                        <form method="dialog">
                                            <button class="btn btn-sm btn-circle btn-ghost text-gray-500 hover:text-red-700">✕</button>
                                        </form>
                                    </div>

                                    <!-- FORM -->
                                    {{-- <form method="POST" action="{{ route('instructor.classes.store') }}" class="space-y-4"> --}}
                                        @csrf

                                        <!-- Class Name -->
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text text-sm font-semibold text-gray-600">Class Name</span>
                                            </label>
                                            <input type="text" name="name" placeholder="Enter class name"
                                                class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg" required>
                                        </div>

                                        <!-- Subject -->
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text text-sm font-semibold text-gray-600">Subject</span>
                                            </label>
                                            <input type="text" name="subject" placeholder="Enter subject"
                                                class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg" required>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text text-sm font-semibold text-gray-600">Description</span>
                                            </label>
                                            <textarea name="description"
                                                class="textarea textarea-bordered w-full h-24 resize-none focus:ring-2 focus:ring-red-700 rounded-lg"
                                                placeholder="Brief description about this class..."></textarea>
                                        </div>

                                        <!-- Class Code -->
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text text-sm font-semibold text-gray-600">Class Code</span>
                                            </label>
                                            <div class="relative">
                                                <!-- Input Field for Class Code -->
                                                <input type="text" name="class_code" id="class_code" placeholder="e.g., ENG101-A"
                                                    class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg" readonly>

                                                <!-- Auto Generate Button -->
                                                <button type="button" id="generateClassCode"
                                                   class="btn btn-sm bg-red-700 text-white hover:bg-red-600 absolute right-1 top-1/2 transform -translate-y-1/2 rounded-full px-3 py-1 text-xs"
                                                    onclick="()">
                                                    Auto Generate
                                                </button>


                                            </div>
                                        </div>

                                        <!-- ACTION BUTTONS -->
                                        <div class="modal-action flex justify-end gap-3 mt-6">
                                            <button type="button" class="btn btn-ghost text-gray-600 hover:bg-gray-100"
                                                onclick="newClassModal.close()">Cancel</button>
                                            <button type="submit"
                                                class="btn bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90 transition px-6">
                                                Create Class
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </dialog>
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
                            <!-- + New Student Button -->
                            <<button onclick="addStudentModal.showModal()"
                                class="btn btn-sm bg-red-800 hover:bg-red-700 text-white">
                                + Add Student
                            </button>

                            <!-- 💎 ADD STUDENT AND SEARCH MODAL -->
                            <dialog id="addStudentModal" class="modal">
                                <div class="modal-box max-w-full sm:max-w-4xl bg-white/95 backdrop-blur-md rounded-2xl shadow-lg border border-gray-100 flex space-x-6">
                                    <!-- SEARCH MODAL -->
                                    <div class="w-1/3 max-w-sm">
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                                <span class="text-red-800 text-xl">🔍</span> Search Students
                                            </h3>
                                        </div>

                                        <!-- Search Bar -->
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text text-sm font-semibold text-gray-600">Search Student</span>
                                            </label>
                                            <input type="text" id="studentSearch" placeholder="Search by name..."
                                                class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg text-sm">
                                        </div>

                                        <!-- Student List -->
                                        <div class="overflow-y-auto mt-4 max-h-64">
                                            <ul id="studentList" class="space-y-2">
                                                <!-- Students will be dynamically inserted here via JavaScript -->
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- ADD STUDENT FORM -->
                                    <div class="w-2/3 max-w-lg">
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                                <span class="text-red-800 text-xl">👩‍🎓</span> Add Student
                                            </h3>
                                            <form method="dialog">
                                                <button class="btn btn-sm btn-circle btn-ghost text-gray-500 hover:text-red-700">✕</button>
                                            </form>
                                        </div>

                                        <!-- FORM -->
                                        {{-- <form method="POST" action="{{ route('instructor.students.store') }}" class="space-y-4"> --}}
                                            @csrf

                                            <!-- Student Name -->
                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text text-sm font-semibold text-gray-600">Student Name</span>
                                                </label>
                                                <input type="text" name="student_name" placeholder="Enter student name"
                                                    class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg" required>
                                            </div>

                                            <!-- Email -->
                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text text-sm font-semibold text-gray-600">Email</span>
                                                </label>
                                                <input type="email" name="email" placeholder="Enter student email"
                                                    class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg" required>
                                            </div>

                                            <!-- Class -->
                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text text-sm font-semibold text-gray-600">Class</span>
                                                </label>
                                                <select name="class_id"
                                                    class="select select-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg" required>
                                                    <option disabled selected>Select class</option>
                                                    <option value="1">Class 2A</option>
                                                    <option value="2">Class 3B</option>
                                                    <option value="3">Class 4C</option>
                                                </select>
                                            </div>

                                            <!-- Status -->
                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text text-sm font-semibold text-gray-600">Status</span>
                                                </label>
                                                <select name="status"
                                                    class="select select-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg" required>
                                                    <option value="active" selected>Active</option>
                                                    <option value="inactive">Inactive</option>
                                                </select>
                                            </div>

                                            <!-- ACTION BUTTONS -->
                                            <div class="modal-action flex justify-end gap-3 mt-6">
                                                <button type="button" class="btn btn-ghost text-gray-600 hover:bg-gray-100"
                                                    onclick="addStudentModal.close()">Cancel</button>
                                                <button type="submit"
                                                    class="btn bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90 transition px-6">
                                                    Add Student
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </dialog>


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
