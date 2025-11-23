<x-layout>
    <x-slot:title>Instructor Modules - CALLA</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-screen bg-white transition-all duration-300">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto lg:ml-64 md:ml-56 sm:ml-0 transition-all duration-300">

            <!-- 📘 MODULE LIST -->
            <section class="mb-10">
                <div class="card bg-base-100 shadow-lg border">
                    <div class="card-body">

                        <div class="flex items-center justify-between">
                            <h3 class="card-title text-lg">My Modules</h3>

                            <!-- + NEW MODULE BUTTON -->
                            <button onclick="newModuleModal.showModal()"
                                class="bg-red-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 transition">
                                + New Module
                            </button>

                            <!-- NEW MODULE MODAL -->
                            <dialog id="newModuleModal" class="modal">
                                <div class="modal-box max-w-lg bg-white/95 backdrop-blur-md rounded-2xl shadow-lg border border-gray-100">

                                    <div class="flex justify-between items-center mb-4">
                                        <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                            <span class="text-red-800 text-xl">📘</span> New Module
                                        </h3>

                                        <form method="dialog">
                                            <button class="btn btn-sm btn-circle btn-ghost text-gray-500 hover:text-red-700">✕</button>
                                        </form>
                                    </div>

                                    <!-- FORM -->
                                    <form method="POST" action="/parse" class="space-y-4">
                                        @csrf

                                        <fieldset class="fieldset">
                                            <legend class="fieldset-legend">Pick a file</legend>
                                            <input type="file" class="file-input" />
                                            <label class="label">Max size 25MB</label>
                                        </fieldset>

                                        <div class="modal-action flex justify-end gap-3 mt-6">
                                            <button type="button" class="btn btn-ghost text-gray-600 hover:bg-gray-100"
                                                onclick="newModuleModal.close()">Cancel</button>

                                            <button type="submit"
                                                class="btn bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90 transition px-6">
                                                Upload File
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </dialog>
                        </div>

                        <!-- MODULE TABLE -->
                        <div class="max-h-96 overflow-y-auto mt-4">
                            <table class="table table-zebra text-center table-fixed w-full">
                                <thead>
                                    <tr>
                                        <th>Module</th>
                                        <th>Description</th>
                                        <th>Classrooms</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($modules as $module)
                                        <tr>
                                            <td>{{ $module->name }}</td>

                                            <td class="max-w-[150px] truncate">
                                                {{ $module->description }}
                                            </td>

                                            <td>
                                                {{ $module->classroomModule->pluck('classroom.name')->join(', ') ?? 'N/A' }}
                                            </td>

                                            <td>
                                                <a href="{{ route('modules.show', $module->id) }}"
                                                   class="btn btn-link text-red-700 no-underline hover:underline">
                                                    View
                                                </a>

                                                <button onclick="document.getElementById('editModuleModal-{{ $module->id }}').showModal()"
                                                    class="btn btn-link text-blue-500 no-underline hover:underline">
                                                    Edit
                                                </button>

                                                <!-- EDIT MODULE MODAL -->
                                                <dialog id="editModuleModal-{{ $module->id }}" class="modal">
                                                    <div class="modal-box max-w-lg bg-white/95 backdrop-blur-md rounded-2xl shadow-lg border border-gray-100">
                                                        <div class="flex justify-between items-center mb-4">
                                                            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                                                <span class="text-red-800 text-xl">✏️</span> Edit Module
                                                            </h3>
                                                            <form method="dialog">
                                                                <button class="btn btn-sm btn-circle btn-ghost text-gray-500 hover:text-red-700">✕</button>
                                                            </form>
                                                        </div>

                                                        <form method="POST" action="{{ route('modules.update', $module->id) }}"
                                                            class="space-y-4">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="form-control">
                                                                <label class="label">
                                                                    <span class="label-text font-semibold text-gray-600">Module Name</span>
                                                                </label>
                                                                <input type="text" name="name" value="{{ $module->name }}"
                                                                    class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg" required>
                                                            </div>

                                                            <div class="form-control">
                                                                <label class="label">
                                                                    <span class="label-text font-semibold text-gray-600">Description</span>
                                                                </label>
                                                                <textarea name="description"
                                                                    class="textarea textarea-bordered w-full h-24 resize-none focus:ring-2 focus:ring-red-700 rounded-lg">{{ $module->description }}</textarea>
                                                            </div>

                                                            <div class="form-control">
                                                                <label class="label">
                                                                    <span class="label-text font-semibold text-gray-600">Classroom</span>
                                                                </label>
                                                                <select name="classroom_id"
                                                                    class="select select-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg">
                                                                    @foreach(auth()->user()->classroom as $classroom)
                                                                        <option value="{{ $classroom->id }}"
                                                                            {{ $module->classroom_id == $classroom->id ? 'selected' : '' }}>
                                                                            {{ $classroom->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="modal-action flex justify-end gap-3 mt-6">
                                                                <button type="button" class="btn btn-ghost text-gray-600 hover:bg-gray-100"
                                                                    onclick="document.getElementById('editModuleModal-{{ $module->id }}').close()">Cancel</button>

                                                                <button type="submit"
                                                                    class="btn bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90 transition px-6">
                                                                    Save Changes
                                                                </button>
                                                            </div>

                                                        </form>
                                                    </div>
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
</x-layout>
