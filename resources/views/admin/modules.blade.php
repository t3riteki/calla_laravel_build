<x-layout>
    <x-slot:title>Admin Modules - CALLA</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-[calc(100vh-64px)] bg-white transition-all duration-300">

        <x-sidebar />

        <main class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto lg:ml-64 md:ml-56 sm:ml-0 transition-all duration-300">

            <section class="mb-10"
                x-data="{
                    search: '',
                    modules: {{ json_encode($modules->map(function($m) {
                        return [
                            'id' => $m->id,
                            'name' => $m->name,
                            'description' => $m->description ?? '',
                            'classrooms' => $m->classroomModule->pluck('classroom.name')->join(', ') ?: 'None',
                            'owner' => $m->user->name ?? 'Unknown',
                            'view_url' => route('modules.show', $m->id),
                            'delete_url' => route('modules.destroy', $m->id),
                        ];
                    })) }}
                }"
            >
                <div class="card bg-base-100 shadow-lg">
                    <div class="card-body grow">

                        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                            <h3 class="card-title text-lg">All Modules</h3>

                            <div class="flex items-center gap-3 w-full md:w-auto">
                                <input
                                    type="text"
                                    x-model="search"
                                    placeholder="Search modules, owners..."
                                    class="input input-bordered input-sm w-full md:w-64"
                                >

                                <a href="{{ route('modules.create') }}"
                                   class="bg-red-800 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 transition whitespace-nowrap">
                                    + Add Module
                                </a>
                            </div>
                        </div>

                        <div class="h-[calc(100vh-276px)] overflow-y-auto mt-4">
                            <table class="table table-zebra text-center table-fixed w-full">
                                <thead class="sticky top-0 bg-base-100 z-10 shadow-sm">
                                    <tr>
                                        <th>Module</th>
                                        <th>Description</th>
                                        <th>Created By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <template x-for="module in modules" :key="module.id">
                                        <tr x-show="
                                            module.name.toLowerCase().includes(search.toLowerCase()) ||
                                            module.owner.toLowerCase().includes(search.toLowerCase()) ||
                                            module.classrooms.toLowerCase().includes(search.toLowerCase()) ||
                                            search === ''
                                        " class="hover:bg-gray-50 transition">

                                            <td class="font-medium" x-text="module.name"></td>

                                            <td class="max-w-[150px] truncate" x-text="module.description"></td>

                                            <td x-text="module.owner"></td>

                                            <td class="flex justify-center gap-2">
                                                <a :href="module.view_url"
                                                   class="btn btn-link text-red-700 no-underline hover:underline">
                                                    View
                                                </a>

                                                <button type="button"
                                                        @click="document.getElementById('deleteModal-' + module.id).showModal()"
                                                        class="btn btn-link text-red-500 no-underline hover:underline">
                                                    Delete
                                                </button>

                                                <dialog :id="'deleteModal-' + module.id" class="modal text-left">
                                                    <div class="modal-box bg-white rounded-2xl shadow-xl border border-red-100">
                                                        <h3 class="text-xl font-semibold text-red-700">Confirm Delete</h3>
                                                        <p class="mt-3 text-gray-600">
                                                            Are you sure you want to delete <span class="font-bold" x-text="module.name"></span>?
                                                            <br>
                                                            This action <strong class="text-red-600">cannot be undone.</strong>
                                                        </p>

                                                        <div class="modal-action">
                                                            <form method="dialog">
                                                                <button class="btn btn-sm bg-gray-200 hover:bg-gray-300 border-none text-gray-700">Cancel</button>
                                                            </form>

                                                            <form :action="module.delete_url" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm bg-red-600 hover:bg-red-700 border-none text-white">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <form method="dialog" class="modal-backdrop bg-black/40">
                                                        <button>close</button>
                                                    </form>
                                                </dialog>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>

                            <div x-show="modules.filter(m => m.name.toLowerCase().includes(search.toLowerCase())).length === 0"
                                 class="text-center py-10 text-gray-500" style="display: none;">
                                No modules found matching your search.
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </main>
    </div>
</x-layout>
