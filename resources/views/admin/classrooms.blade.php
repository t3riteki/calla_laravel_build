<x-layout>
    <x-slot:title>Admin Classrooms - CALLA</x-slot:title>

    <!-- DASHBOARD CONTAINER -->
    <div class="flex flex-col lg:flex-row min-h-screen bg-white transition-all duration-300">

        <!-- SIDEBAR -->
        <x-sidebar />

        <main class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto lg:ml-64 md:ml-56 sm:ml-0 transition-all duration-300">

            <!-- 🏫 CLASSROOM LIST -->
            <section class="mb-10">
                <div class="card bg-base-100 shadow-lg border">
                    <div class="card-body">

                        <div class="flex items-center justify-between">
                            <h3 class="card-title text-lg font-semibold">All Classrooms</h3>

                            <!-- + New Classroom Button -->
                            <button onclick="newClassModal.showModal()"
                                class="bg-red-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 transition">
                                + New Classroom
                            </button>

                            <!-- CREATE NEW CLASS MODAL -->
                            <dialog id="newClassModal" class="modal">
                                <div class="modal-box max-w-lg bg-white/95 backdrop-blur-md rounded-2xl shadow-lg border border-gray-100">

                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                            <span class="text-red-800 text-xl">📚</span> New Classroom
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
                                                <span class="label-text text-sm font-semibold text-gray-600">Classroom Name</span>
                                            </label>
                                            <input type="text" name="name" placeholder="Enter classroom name"
                                                class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg" required>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text text-sm font-semibold text-gray-600">Description</span>
                                            </label>
                                            <textarea name="description"
                                                class="textarea textarea-bordered w-full h-24 resize-none focus:ring-2 focus:ring-red-700 rounded-lg"
                                                placeholder="Brief description about this classroom..."></textarea>
                                        </div>

                                        <!-- Class Code -->
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text text-sm font-semibold text-gray-600">Classroom Code</span>
                                            </label>

                                            <div class="relative">
                                                <input type="text" name="code" id="class_code"
                                                    placeholder="Enter or auto-generate a code"
                                                    class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg">

                                                <button
                                                    type="button"
                                                    id="generateClassCode"
                                                    class="btn btn-sm bg-red-700 text-white hover:bg-red-600 absolute right-1 top-1/2 -translate-y-1/2 rounded-full px-3 py-1 text-xs"
                                                    onclick="generateCode()">
                                                    Auto
                                                </button>
                                            </div>
                                        </div>

                                        <!-- ACTIONS -->
                                        <div class="modal-action flex justify-end gap-3 mt-6">
                                            <button type="button" class="btn btn-ghost text-gray-600 hover:bg-gray-100"
                                                onclick="newClassModal.close()">Cancel</button>

                                            <button type="submit"
                                                class="btn bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90 transition px-6">
                                                Create Classroom
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </dialog>
                        </div>

                        <!-- TABLE -->
                        <div class="max-h-96 mt-4 overflow-x-auto overflow-y-visible">
                            <table class="table table-zebra text-center w-full">
                                <thead>
                                    <tr>
                                        <th>Classroom Name</th>
                                        <th>Description</th>
                                        <th>Students</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($classrooms as $classroom)
                                        <tr>

                                            <!-- Name -->
                                            <td class="font-semibold">{{ $classroom->name }}</td>

                                            <!-- Description -->
                                            <td class="max-w-[150px] truncate">{{ $classroom->description }}</td>

                                            <!-- Student Count -->
                                            <td>{{ $classroom->EnrolledUser->where('user.role','learner')->count() }}</td>

                                            <!-- ACTIONS -->
                                            <td class="space-x-2">

                                                <!-- View -->
                                                <a href="{{ route('classrooms.show', $classroom->id) }}"
                                                    class="btn btn-link text-red-700 no-underline hover:underline">
                                                    View
                                                </a>

                                                <!-- Edit -->
                                                <button onclick="document.getElementById('editClassModal-{{ $classroom->id }}').showModal()"
                                                    class="btn btn-link text-blue-500 no-underline hover:underline">
                                                    Edit
                                                </button>

                                                <!-- Delete -->
                                                <button onclick="document.getElementById('deleteConfirmModal-{{ $classroom->id }}').showModal()"
                                                    class="btn btn-link text-red-500 no-underline hover:underline">
                                                    Delete
                                                </button>

                                                <!-- EDIT MODAL -->
                                                <dialog id="editClassModal-{{ $classroom->id }}" class="modal">
                                                    <div class="modal-box max-w-lg bg-white/95 backdrop-blur-md rounded-2xl shadow-lg border border-gray-100">

                                                        <div class="flex justify-between items-center mb-4">
                                                            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                                                <span class="text-red-800 text-xl">✏️</span> Edit Classroom
                                                            </h3>
                                                            <form method="dialog">
                                                                <button class="btn btn-sm btn-circle btn-ghost text-gray-500 hover:text-red-700">✕</button>
                                                            </form>
                                                        </div>

                                                        <!-- EDIT FORM -->
                                                        <form method="POST" action="{{ route('classrooms.update', $classroom->id) }}" class="space-y-4">
                                                            @csrf
                                                            @method('PUT')

                                                            <!-- Name -->
                                                            <div class="form-control">
                                                                <label class="label">
                                                                    <span class="label-text text-sm font-semibold text-gray-600">Classroom Name</span>
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

                                                            <!-- Code -->
                                                            <div class="form-control">
                                                                <label class="label">
                                                                    <span class="label-text text-sm font-semibold text-gray-600">Classroom Code</span>
                                                                </label>

                                                                <div class="relative">
                                                                    <input type="text" name="code" value="{{ $classroom->code }}"
                                                                        class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg">

                                                                    <button
                                                                        type="button"
                                                                        class="btn btn-sm bg-red-700 text-white hover:bg-red-600 absolute right-1 top-1/2 -translate-y-1/2 rounded-full px-3 py-1 text-xs"
                                                                        onclick="generateEditCode('{{ $classroom->id }}')">
                                                                        Auto
                                                                    </button>
                                                                </div>
                                                            </div>

                                                            <!-- ACTIONS -->
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

                                                <!-- DELETE MODAL -->
                                                <dialog id="deleteConfirmModal-{{ $classroom->id }}" class="modal">
                                                    <div class="modal-box bg-white rounded-2xl shadow-xl border border-red-100">

                                                        <h3 class="text-xl font-semibold text-red-700 flex items-center gap-2">
                                                            ⚠️ Confirm Delete
                                                        </h3>

                                                        <p class="mt-3 text-gray-600 leading-relaxed">
                                                            You are about to delete the classroom
                                                            <span class="font-semibold text-gray-800">"{{ $classroom->name }}"</span>.
                                                            This action <strong class="text-red-600">cannot be undone</strong>.
                                                        </p>

                                                        <div class="modal-action flex justify-end gap-3 mt-6">
                                                            <form method="dialog">
                                                                <button class="btn px-5 rounded-xl border border-gray-300 bg-white hover:bg-gray-100">
                                                                    Cancel
                                                                </button>
                                                            </form>

                                                            <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn px-5 rounded-xl bg-red-600 text-white hover:bg-red-700 shadow-sm">
                                                                    Yes, Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <form method="dialog" class="modal-backdrop bg-black/40 backdrop-blur-sm"></form>
                                                </dialog>

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
    function generateCode() {
        let code = "CLS-" + Math.random().toString(36).substring(2, 7).toUpperCase();
        document.getElementById("class_code").value = code;
    }

    function generateEditCode(id) {
        let code = "CLS-" + Math.random().toString(36).substring(2, 7).toUpperCase();
        document.querySelector(`#editClassModal-${id} input[name='code']`).value = code;
    }
    </script>

</x-layout>
