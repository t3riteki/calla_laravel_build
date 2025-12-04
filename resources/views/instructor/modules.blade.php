<x-layout>
    <x-slot:title>Instructor Modules - CALLA</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-[calc(100vh-64px)] bg-white transition-all duration-300">

        <x-sidebar />

        <main class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto lg:ml-64 md:ml-56 sm:ml-0 transition-all duration-300">

            <section class="mb-10" x-data="{ search: '' }">
                <div class="card bg-base-100 shadow-lg border">
                    <div class="card-body">

                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <h3 class="card-title text-lg">My Modules</h3>

                            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">

                                <div class="relative w-full sm:w-64">
                                    <input type="text"
                                           x-model="search"
                                           placeholder="Search modules..."
                                           class="input input-bordered input-sm w-full pl-10 focus:ring-2 focus:ring-red-700" />
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>

                                <button onclick="newModuleModal.showModal()"
                                    class="bg-red-800 text-white px-4 py-1.5 rounded-lg text-sm hover:bg-red-700 transition whitespace-nowrap">
                                    + New Module
                                </button>
                            </div>

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

                                    <form method="POST" action="/parse" enctype="multipart/form-data" class="space-y-4">
                                        @csrf
                                        <fieldset class="fieldset">
                                            <legend class="fieldset-legend">Pick a file</legend>
                                            <input type="file" class="file-input w-full" name="attachment" id="attachment"/>
                                            <label class="label">Max size 25MB</label>
                                        </fieldset>

                                        <div class="modal-action flex justify-end gap-3 mt-6">
                                            <button type="button" class="btn btn-ghost text-gray-600 hover:bg-gray-100" onclick="newModuleModal.close()">Cancel</button>
                                            <button type="submit" class="btn bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90 transition px-6">Upload File</button>
                                        </div>
                                    </form>
                                </div>
                            </dialog>
                        </div>

                        <div class="h-[calc(100vh-276px)] overflow-y-auto mt-4">
                            <table class="table table-zebra text-center table-fixed w-full">
                                <thead class="sticky top-0 bg-base-100 z-10 shadow-sm">
                                    <tr>
                                        <th>Module</th>
                                        <th>Description</th>
                                        <th>Classrooms</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($modules as $module)
                                        <tr x-show="$el.innerText.toLowerCase().includes(search.toLowerCase())"
                                            class="transition-opacity duration-300">

                                            <td>{{ $module->name }}</td>

                                            <td class="max-w-[150px] truncate">
                                                {{ $module->description }}
                                            </td>

                                            <td class="truncate">
                                                {{ $module->classroomModule->pluck('classroom.name')->join(', ') ?? 'N/A' }}
                                            </td>

                                            <td>
                                                <a href="{{ route('modules.show', $module->id) }}"
                                                   class="btn btn-link text-red-700 no-underline hover:underline">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div x-show="$el.querySelectorAll('tbody tr[style*=\'display: none\']').length === {{ count($modules) }}"
                                 class="text-center py-8 text-gray-500 hidden"
                                 :class="{'hidden': false, 'block': true}">
                                No modules found matching "<span x-text="search" class="font-bold"></span>"
                            </div>
                        </div>

                    </div>
                </div>
            </section>

        </main>
    </div>
</x-layout>
