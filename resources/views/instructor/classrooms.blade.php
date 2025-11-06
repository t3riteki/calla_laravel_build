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

        <main class="flex-1 ml-64 p-8 overflow-y-auto">
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
        </main>
    </div>
</x-layout>
