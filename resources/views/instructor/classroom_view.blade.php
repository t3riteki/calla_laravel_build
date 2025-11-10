 <x-layout>
    <x-slot:title>Instructor Dashboard - CALLA</x-slot:title>

    <!-- DASHBOARD CONTAINER -->
    <div class="flex min-h-screen bg-white pt-15">

        <!-- SIDEBAR -->
        <x-sidebar />

        <main class="flex-1 ml-64 p-8 overflow-y-auto">
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
        </main>
    </div>
</x-layout>
