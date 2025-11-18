 <x-layout>
    <x-slot:title>Instructor Dashboard - CALLA</x-slot:title>

    <!-- DASHBOARD CONTAINER -->
    <div class="flex flex-col lg:flex-row min-h-screen bg-white transition-all duration-300">

        <!-- SIDEBAR -->
        <x-sidebar />

        <main class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto lg:ml-64 md:ml-56 sm:ml-0 transition-all duration-300">
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
                                    <form method="POST" action="{{ route('classrooms.store') }}" class="space-y-4">
                                        @csrf

                                        <!-- Class Name -->
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text text-sm font-semibold text-gray-600">Class Name</span>
                                            </label>
                                            <input type="text" name="name" placeholder="Enter class name"
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
                                                <input
                                                    type="text"
                                                    name="code"
                                                    id="class_code"
                                                    placeholder="Enter or auto-generate a code"
                                                    class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg"
                                                >

                                                <!-- Auto Generate Button -->
                                                <button
                                                    type="button"
                                                    id="generateClassCode"
                                                    class="btn btn-sm bg-red-700 text-white hover:bg-red-600 absolute right-1 top-1/2
                                                        transform -translate-y-1/2 rounded-full px-3 py-1 text-xs"
                                                    onclick="generateCode()">
                                                    Auto
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

                        <div class="max-h-96 overflow-y-auto mt-4">
                            <table class="table table-zebra text-center w-full">
                                <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Description</th>
                                        <th>Students</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($classrooms as $classroom)
                                        <tr>
                                            <td>{{ $classroom->name }}</td>

                                            {{-- Subject (truncate like your original) --}}
                                            <td class="max-w-[150px] truncate">
                                                {{ $classroom->description }}
                                            </td>

                                            {{-- Student Count --}}
                                            <td>{{ $classroom->EnrolledUser->where('user.role','learner')->count() }}</td>

                                            {{-- Actions --}}
                                            <td>
                                                <a href="{{ route('classrooms.show', $classroom->id) }}"
                                                class="btn btn-link text-red-700 no-underline hover:underline">
                                                    View
                                                </a>

                                                <!-- Edit Button triggers modal -->
                                                <button onclick="document.getElementById('editClassModal-{{ $classroom->id }}').showModal()"
                                                    class="btn btn-link text-blue-500 no-underline hover:underline">
                                                    Edit
                                                </button>

                                                <!-- Edit Modal -->
                                                <dialog id="editClassModal-{{ $classroom->id }}" class="modal">
                                                    <div class="modal-box max-w-lg bg-white/95 backdrop-blur-md rounded-2xl shadow-lg border border-gray-100">
                                                        <div class="flex justify-between items-center mb-4">
                                                            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                                                <span class="text-red-800 text-xl">✏️</span> Edit Class
                                                            </h3>
                                                            <form method="dialog">
                                                                <button class="btn btn-sm btn-circle btn-ghost text-gray-500 hover:text-red-700">✕</button>
                                                            </form>
                                                        </div>

                                                        <!-- EDIT FORM -->
                                                        <form method="POST" action="{{ route('classrooms.update', $classroom->id) }}" class="space-y-4">
                                                            @csrf
                                                            @method('PUT')

                                                            <!-- Class Name -->
                                                            <div class="form-control">
                                                                <label class="label">
                                                                    <span class="label-text text-sm font-semibold text-gray-600">Class Name</span>
                                                                </label>
                                                                <input type="text" name="name" value="{{ $classroom->name }}"
                                                                    class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg" required>
                                                            </div>

                                                            <!-- Description -->
                                                            <div class="form-control">
                                                                <label class="label">
                                                                    <span class="label-text text-sm font-semibold text-gray-600">Description</span>
                                                                </label>
                                                                <textarea name="description"
                                                                    class="textarea textarea-bordered w-full h-24 resize-none focus:ring-2 focus:ring-red-700 rounded-lg"
                                                                    required>{{ $classroom->description }}</textarea>
                                                            </div>

                                                            <!-- Class Code -->
                                                            <div class="form-control">
                                                                <label class="label">
                                                                    <span class="label-text text-sm font-semibold text-gray-600">Class Code</span>
                                                                </label>
                                                                <div class="relative">
                                                                    <input type="text" name="code" value="{{ $classroom->code }}"
                                                                        class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg">

                                                                    <button type="button"
                                                                            class="btn btn-sm bg-red-700 text-white hover:bg-red-600 absolute right-1 top-1/2
                                                                                transform -translate-y-1/2 rounded-full px-3 py-1 text-xs"
                                                                            onclick="generateEditCode('{{ $classroom->id }}')">
                                                                        Auto
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <!-- ACTION BUTTONS -->
                                                            <div class="modal-action flex justify-end gap-3 mt-6">
                                                                <button type="button" class="btn btn-ghost text-gray-600 hover:bg-gray-100"
                                                                    onclick="document.getElementById('editClassModal-{{ $classroom->id }}').close()">Cancel</button>
                                                                <button type="submit"
                                                                    class="btn bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90 transition px-6">
                                                                    Save Changes
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </dialog>
                                                </a>
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

    <script>
    document.getElementById("generateClassCode").addEventListener("click", function () {
        // You can customize this generator however you want
        let code = "CLS-" + Math.random().toString(36).substring(2, 7).toUpperCase();
        document.getElementById("class_code").value = code;
    });
    </script>
</x-layout>
