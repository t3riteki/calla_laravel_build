<x-layout>
    <x-slot:title>Admin Modules - CALLA</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-screen bg-white transition-all duration-300">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto lg:ml-64 md:ml-56 sm:ml-0 transition-all duration-300">

            <!-- 📘 MODULE LIST (ADMIN VERSION) -->
            <section class="mb-10">
                <div class="card bg-base-100 shadow-lg border">
                    <div class="card-body">

                        <div class="flex items-center justify-between">
                            <h3 class="card-title text-lg">All Modules</h3>

                            <!-- + NEW MODULE BUTTON -->
                            <a href="{{ route('modules.create') }}"
                                class="bg-red-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 transition">
                                + Add Module
                            </a>
                        </div>

                        <!-- MODULE TABLE -->
                        <div class="max-h-96 overflow-y-auto mt-4">
                            <table class="table table-zebra text-center table-fixed w-full">
                                <thead>
                                    <tr>
                                        <th>Module</th>
                                        <th>Description</th>
                                        <th>Used In Classes</th>
                                        <th>Created By</th>
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
                                                {{ $module->classroomModule->pluck('classroom.name')->join(', ') ?: 'None' }}
                                            </td>

                                            <td>
                                                {{ $module->user->name ?? 'Unknown' }}
                                            </td>

                                            <td class="flex justify-center gap-2">

                                                <!-- View -->
                                                <a href="{{ route('modules.show', $module->id) }}"
                                                   class="text-red-700 hover:underline text-sm">
                                                    View
                                                </a>

                                                <!-- Edit -->
                                                <a href="{{ route('modules.edit', $module->id) }}"
                                                   class="text-blue-600 hover:underline text-sm">
                                                    Edit
                                                </a>

                                                <!-- Delete -->
                                                <button onclick="document.getElementById('deleteModal-{{ $module->id }}').showModal()"
                                                    class="text-red-500 hover:underline text-sm">
                                                    Delete
                                                </button>

                                                <!-- DELETE MODAL -->
                                                <dialog id="deleteModal-{{ $module->id }}" class="modal">
                                                    <div class="modal-box bg-white rounded-2xl shadow-xl border border-red-100">

                                                        <h3 class="text-xl font-semibold text-red-700">
                                                            Confirm Delete
                                                        </h3>

                                                        <p class="mt-3 text-gray-600">
                                                            Are you sure you want to delete
                                                            <span class="font-semibold">{{ $module->name }}</span>?
                                                            <br>
                                                            This action <strong class="text-red-600">cannot be undone.</strong>
                                                        </p>

                                                        <div class="modal-action">

                                                            <!-- Cancel -->
                                                            <form method="dialog">
                                                                <button class="btn bg-gray-200 hover:bg-gray-300">
                                                                    Cancel
                                                                </button>
                                                            </form>

                                                            <!-- Confirm Delete -->
                                                            <form action="{{ route('modules.destroy', $module->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn bg-red-600 text-white hover:bg-red-700">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <form method="dialog" class="modal-backdrop bg-black/40"></form>
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
