<x-layout>
    <x-slot:title>Instructor Classrooms - CALLA</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-[calc(100vh-64px)] bg-white transition-all duration-300">

        <x-sidebar />

        <main class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto lg:ml-64 md:ml-56 sm:ml-0 transition-all duration-300">

            <section class="mb-10" x-data="{ search: '' }">
                <div class="card bg-base-100 shadow-lg ">
                    <div class="card-body">

                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <h3 class="card-title text-lg">My Classes</h3>

                            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">

                                <div class="relative w-full sm:w-64">
                                    <input type="text"
                                           x-model="search"
                                           placeholder="Search classes..."
                                           class="input input-bordered input-sm w-full pl-10 focus:ring-2 focus:ring-red-700" />
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>

                                <button onclick="newClassModal.showModal()"
                                    class="bg-red-800 text-white px-4 py-1.5 rounded-lg text-sm hover:bg-red-700 transition whitespace-nowrap">
                                    + New Class
                                </button>
                            </div>

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

                                    <form method="POST" action="{{ route('classrooms.store') }}" class="space-y-4">
                                        @csrf
                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text text-sm font-semibold text-gray-600">Class Name</span>
                                            </label>
                                            <input type="text" name="name" placeholder="Enter class name"
                                                class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg" required>
                                        </div>

                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text text-sm font-semibold text-gray-600">Description</span>
                                            </label>
                                            <textarea name="description"
                                                class="textarea textarea-bordered w-full h-24 resize-none focus:ring-2 focus:ring-red-700 rounded-lg"
                                                placeholder="Brief description about this class..."></textarea>
                                        </div>

                                        <div class="form-control">
                                            <label class="label">
                                                <span class="label-text text-sm font-semibold text-gray-600">Class Code</span>
                                            </label>
                                            <div class="relative">
                                                <input type="text" name="code" id="class_code"
                                                    placeholder="Enter or auto-generate a code"
                                                    class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg">
                                                <button type="button" id="generateClassCode"
                                                    class="btn btn-sm bg-red-700 text-white hover:bg-red-600 absolute right-1 top-1/2 transform -translate-y-1/2 rounded-full px-3 py-1 text-xs"
                                                    onclick="generateCode()">
                                                    Auto
                                                </button>
                                            </div>
                                        </div>

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

                        <div class="h-[calc(100vh-276px)] mt-4 overflow-x-auto overflow-y-visible">
                            <table class="table table-zebra text-center w-full">
                                <thead class="sticky top-0 bg-base-100 z-10 shadow-sm">
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Description</th>
                                        <th>Students</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($classrooms as $classroom)
                                        <tr x-show="$el.innerText.toLowerCase().includes(search.toLowerCase())"
                                            class="transition-opacity duration-300">

                                            <td>{{ $classroom->name }}</td>

                                            <td class="max-w-[150px] truncate">
                                                {{ $classroom->description }}
                                            </td>

                                            <td>{{ $classroom->EnrolledUser->where('user.role','learner')->count() }}</td>

                                            <td>
                                                <a href="{{ route('classrooms.show', $classroom->id) }}"
                                                class="btn btn-link text-red-700 no-underline hover:underline">
                                                    View
                                                </a>

                                                <button onclick="document.getElementById('editClassModal-{{ $classroom->id }}').showModal()"
                                                    class="btn btn-link text-blue-500 no-underline hover:underline">
                                                    Edit
                                                </button>

                                                <dialog id="editClassModal-{{ $classroom->id }}" class="modal text-left">
                                                    <div class="modal-box max-w-lg bg-white/95 backdrop-blur-md rounded-2xl shadow-lg border border-gray-100">
                                                        <div class="flex justify-between items-center mb-4">
                                                            <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                                                <span class="text-red-800 text-xl">✏️</span> Edit Class
                                                            </h3>
                                                            <form method="dialog">
                                                                <button class="btn btn-sm btn-circle btn-ghost text-gray-500 hover:text-red-700">✕</button>
                                                            </form>
                                                        </div>

                                                        <form method="POST" action="{{ route('classrooms.update', $classroom->id) }}" class="space-y-4">
                                                            @csrf @method('PUT')

                                                            <div class="form-control">
                                                                <label class="label"><span class="label-text text-sm font-semibold text-gray-600">Class Name</span></label>
                                                                <input type="text" name="name" value="{{ $classroom->name }}" class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg text-black" required>
                                                            </div>

                                                            <div class="form-control">
                                                                <label class="label"><span class="label-text text-sm font-semibold text-gray-600">Description</span></label>
                                                                <textarea name="description" class="textarea textarea-bordered w-full h-24 resize-none focus:ring-2 focus:ring-red-700 rounded-lg text-black" required>{{ $classroom->description }}</textarea>
                                                            </div>

                                                            <div class="form-control">
                                                                <label class="label"><span class="label-text text-sm font-semibold text-gray-600">Class Code</span></label>
                                                                <div class="relative">
                                                                    <input type="text" name="code" value="{{ $classroom->code }}" id="edit_class_code_{{ $classroom->id }}" class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg text-black">
                                                                    <button type="button" class="btn btn-sm bg-red-700 text-white hover:bg-red-600 absolute right-2 top-1/2 transform -translate-y-1/2 z-10 px-4 py-2" onclick="generateEditCode('{{ $classroom->id }}')">Auto</button>
                                                                </div>
                                                            </div>

                                                            <div class="modal-action flex justify-end gap-3 mt-6">
                                                                <button type="button" class="btn btn-ghost text-gray-600 hover:bg-gray-100" onclick="document.getElementById('editClassModal-{{ $classroom->id }}').close()">Cancel</button>
                                                                <button type="submit" class="btn bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90 transition px-6">Save Changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </dialog>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div x-show="$el.querySelectorAll('tbody tr[style*=\'display: none\']').length === {{ count($classrooms) }}"
                                 class="text-center py-8 text-gray-500 hidden"
                                 :class="{'hidden': false, 'block': true}">
                                No classes found matching "<span x-text="search" class="font-bold"></span>"
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
    // Generator for New Class Modal
    function generateCode() {
        let code = "CLS-" + Math.random().toString(36).substring(2, 7).toUpperCase();
        document.getElementById("class_code").value = code;
    }

    // Generator for Edit Class Modal
    function generateEditCode(id) {
        let code = "CLS-" + Math.random().toString(36).substring(2, 7).toUpperCase();
        document.getElementById(`edit_class_code_${id}`).value = code;
    }
    </script>
</x-layout>
