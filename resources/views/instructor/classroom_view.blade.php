<x-layout>
    <x-slot:title>{{ $classroom->name }} - Classroom View</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-screen bg-white transition-all duration-300">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN CONTENT -->
        <main
            class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto
                   lg:ml-64 md:ml-56 sm:ml-0 transition-all duration-300">

            <!-- 🏫 CLASSROOM HEADER -->
            <section class="mb-10">
                <div class="hero rounded-2xl bg-gradient-to-r from-red-900 via-red-700 to-red-600 text-white p-6 sm:p-8 md:p-10">
                    <div class="hero-content flex flex-col lg:flex-row lg:items-center lg:justify-between w-full gap-6">

                        <div>
                            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold">
                                {{ $classroom->name }}
                            </h2>
                            <p class="py-4 text-sm sm:text-base opacity-80 max-w-xl">
                                {{ $classroom->description }}
                            </p>
                            <p class="inline-block px-3 py-1 bg-red-100 text-red-700 rounded-lg text-sm font-medium">
                                Code: {{ $classroom->code }}
                            </p>
                        </div>

                        <!-- Right Section: Back Button, Actions, Stats -->
                        <div class="flex flex-col gap-4">

                            <!-- Back Button -->
                            <a href="{{ url()->previous() }}"
                            class="btn btn-sm bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90">
                                ← Back to Classrooms
                            </a>

                            <!-- ACTION BUTTONS -->
                            <div class="flex gap-3">

                                <!-- Edit Button triggers modal -->
                                <button onclick="document.getElementById('editClassModal-{{ $classroom->id }}').showModal()"
                                    class="btn btn-sm bg-white text-red-700 border border-red-200 hover:bg-red-50 font-semibold">
                                        Edit Classroom
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
                                                    class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg text-black" required>
                                            </div>

                                            <!-- Description -->
                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text text-sm font-semibold text-gray-600">Description</span>
                                                </label>
                                                <textarea name="description"
                                                    class="textarea textarea-bordered w-full h-24 resize-none focus:ring-2 focus:ring-red-700 rounded-lg text-black"
                                                    required>{{ $classroom->description }}
                                                </textarea>
                                            </div>

                                            <!-- Class Code -->
                                            <div class="form-control">
                                                <label class="label">
                                                    <span class="label-text text-sm font-semibold text-gray-600">Class Code</span>
                                                </label>
                                                <div class="relative">
                                                    <input type="text" name="code" value="{{ $classroom->code }}"
                                                        id="edit_class_code_{{ $classroom->id }}"
                                                        class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg text-black">

                                                    <button type="button"
                                                        class="btn btn-sm bg-red-700 text-white hover:bg-red-600 absolute right-2 top-1/2
                                                            transform -translate-y-1/2 z-10 px-4 py-2"
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

                                <!-- Delete Classroom -->
                                <button onclick="document.getElementById('deleteClassroomModal').showModal()"
                                    class="btn btn-sm bg-red-600 text-white hover:bg-red-700 font-semibold">
                                    Delete Classroom
                                </button>

                                <!-- Delete Classroom Modal -->
                                <dialog id="deleteClassroomModal" class="modal">
                                    <div class="modal-box bg-white rounded-2xl shadow-xl border border-red-100">

                                        <h3 class="text-xl font-semibold text-red-700 flex items-center gap-2">
                                            <i class="ri-error-warning-line text-2xl"></i>
                                            Delete Classroom
                                        </h3>

                                        <p class="py-4 text-gray-600">
                                            Are you sure you want to delete this classroom? All modules, students, and data related to it will also be removed.
                                        </p>

                                        <div class="modal-action">
                                            <form method="dialog">
                                                <button class="btn">Cancel</button>
                                            </form>

                                            <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn bg-red-600 text-white hover:bg-red-700">
                                                    Yes, Delete
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </dialog>

                            </div>

                            <!-- Stats -->
                            <div class="stats stats-vertical sm:stats-horizontal shadow mt-4">
                                <div class="stat bg-white/10 text-white backdrop-blur-md">
                                    <div class="stat-title text-gray-200">Students</div>
                                    <div class="stat-value text-white text-3xl">
                                        {{ $classroom->EnrolledUser->where('user.role','learner')->count() }}
                                    </div>
                                </div>

                                <div class="stat bg-white/10 text-white backdrop-blur-md">
                                    <div class="stat-title text-gray-200">Modules</div>
                                    <div class="stat-value text-white text-3xl">
                                        {{ $classroom->ClassroomModule->count() }}
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </section>

            <!-- 👨‍🎓 STUDENT LIST -->
            <section class="mb-10">
                <div class="card bg-base-100 shadow-lg border">
                    <div class="card-body">

                        <!-- Header -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <h3 class="card-title text-lg sm:text-xl">Enrolled Students</h3>

                            <button onclick="addStudentModal.showModal()"
                                class="btn btn-sm bg-red-800 hover:bg-red-700 text-white w-full sm:w-auto">
                                + Add Student
                            </button>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto mt-4">
                            <table class="table text-center table-zebra w-full text-sm sm:text-base">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Joined</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($classroom->EnrolledUser->where('user.role','learner') as $enrollment)
                                        <tr>
                                            <td>{{ $enrollment->user->name }}</td>
                                            <td>{{ $enrollment->user->email }}</td>
                                            <td>TBA</td>
                                            <td>{{ $enrollment->user->created_at->format('M d, Y') }}</td>
                                            <td class="space-x-2 flex justify-center">
                                                <a href="{{ route('enrolleduser.show', [$enrollment->id]) }}"
                                                    class="btn btn-link text-red-700 no-underline hover:underline">
                                                    View
                                                </a>
                                                <!-- Remove Button -->
                                                <button type="button"
                                                        class="btn btn-link text-red-500 no-underline hover:underline"
                                                        onclick="document.getElementById('removeEnrollmentModal-{{ $enrollment->id }}').showModal()">
                                                    Remove
                                                </button>

                                                <!-- Confirmation Modal -->
                                                <dialog id="removeEnrollmentModal-{{ $enrollment->id }}" class="modal">
                                                    <div class="modal-box bg-white rounded-2xl shadow-xl border border-red-100">

                                                        <!-- Modal Title -->
                                                        <h3 class="text-xl font-semibold text-red-700 flex items-center gap-2">
                                                            <i class="ri-error-warning-line text-2xl"></i>
                                                            Confirm Removal
                                                        </h3>

                                                        <!-- Message -->
                                                        <p class="mt-3 text-gray-600 leading-relaxed">
                                                            You are about to remove the user
                                                            <span class="font-semibold text-gray-800">{{ $enrollment->user->name }}</span>
                                                            from this classroom.
                                                            <br>This action <strong class="text-red-600">cannot be undone</strong>.
                                                        </p>

                                                        <!-- Buttons -->
                                                        <div class="modal-action flex justify-end gap-3 mt-6">

                                                            <!-- Cancel -->
                                                            <button type="button"
                                                                    class="btn px-5 rounded-xl border border-gray-300 bg-white hover:bg-gray-100"
                                                                    onclick="document.getElementById('removeEnrollmentModal-{{ $enrollment->id }}').close()">
                                                                Cancel
                                                            </button>

                                                            <!-- Confirm Remove -->
                                                            <form method="POST" action="{{ route('enrolleduser.destroy', $enrollment->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                        class="btn px-5 rounded-xl bg-red-600 text-white hover:bg-red-700 shadow-sm">
                                                                    Yes, Remove
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </div>

                                                    <!-- Background overlay -->
                                                    <div class="modal-backdrop bg-black/40 backdrop-blur-sm"
                                                        onclick="document.getElementById('removeEnrollmentModal-{{ $enrollment->id }}').close()"></div>
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

            <!-- 📚 MODULE LIST -->
            <section>
                <div class="card bg-base-100 shadow-lg border">
                    <div class="card-body">

                        <!-- Header -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <h3 class="card-title text-lg sm:text-xl">Class Modules</h3>
                            <button onclick="newClassroomModuleModal.showModal()"
                               class="btn btn-sm bg-red-800 hover:bg-red-700 text-white w-full sm:w-auto">
                                + Add Module
                        </button>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto mt-4">
                            <table class="table text-center table-zebra w-full text-sm sm:text-base">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Date Added</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classroom->ClassroomModule as $classmodule)
                                        <tr>
                                            <td>{{ $classmodule->module->name }}</td>
                                            <td class="max-w-[200px] truncate">{{ $classmodule->module->description }}</td>
                                            <td>{{ $classmodule->module->created_at->format('M d, Y') }}</td>
                                            <td class="space-x-2 flex justify-center">
                                                <a href="{{ route('classroommodule.show',$classmodule->id) }}"
                                                    class="btn btn-link text-red-700 no-underline hover:underline">
                                                    View
                                                </a>
                                                <!-- Remove Button -->
                                                <button type="button"
                                                        class="btn btn-link text-red-500 no-underline hover:underline"
                                                        onclick="document.getElementById('removeClassModuleModal-{{ $classmodule->id }}').showModal()">
                                                    Remove
                                                </button>

                                                <!-- Confirmation Modal -->
                                                <dialog id="removeClassModuleModal-{{ $classmodule->id }}" class="modal">
                                                    <div class="modal-box bg-white rounded-2xl shadow-xl border border-red-100">

                                                        <!-- Modal Title -->
                                                        <h3 class="text-xl font-semibold text-red-700 flex items-center gap-2">
                                                            <i class="ri-error-warning-line text-2xl"></i>
                                                            Confirm Removal
                                                        </h3>

                                                        <!-- Message -->
                                                        <p class="mt-3 text-gray-600 leading-relaxed">
                                                            You are about to remove this module from the classroom
                                                            <span class="font-semibold text-gray-800">{{ $classmodule->classroom->name }}</span>.
                                                            <br>This action <strong class="text-red-600">cannot be undone</strong>.
                                                        </p>

                                                        <!-- Buttons -->
                                                        <div class="modal-action flex justify-end gap-3 mt-6">

                                                            <!-- Cancel -->
                                                            <button type="button"
                                                                    class="btn px-5 rounded-xl border border-gray-300 bg-white hover:bg-gray-100"
                                                                    onclick="document.getElementById('removeClassModuleModal-{{ $classmodule->id }}').close()">
                                                                Cancel
                                                            </button>

                                                            <!-- Confirm Remove -->
                                                            <form method="POST" action="{{ route('classroommodule.destroy', $classmodule->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                        class="btn px-5 rounded-xl bg-red-600 text-white hover:bg-red-700 shadow-sm">
                                                                    Yes, Remove
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </div>

                                                    <!-- Background overlay -->
                                                    <div class="modal-backdrop bg-black/40 backdrop-blur-sm"
                                                        onclick="document.getElementById('removeClassModuleModal-{{ $classmodule->id }}').close()"></div>
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

    <!-- ADD STUDENT MODAL -->
    <dialog id="addStudentModal" class="modal">
        <div class="modal-box max-w-md bg-white rounded-xl shadow-xl p-6">
            <h3 class="font-bold text-lg mb-4">Add Student</h3>

            <form method="POST" action="{{ route('enrolleduser.store', $classroom->id) }}" class="space-y-4">
                @csrf

                <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">

                <div class="form-control">
                    <label class="label"><span class="label-text">Student Email</span></label>
                    <input type="email" name="email" class="input input-bordered w-full" required>
                </div>

                <div class="modal-action">
                    <button type="button" class="btn" onclick="addStudentModal.close()">Cancel</button>
                    <button type="submit" class="btn bg-red-800 text-white hover:bg-red-700">Add</button>
                </div>
            </form>
        </div>
    </dialog>

    <dialog id="newClassroomModuleModal" class="modal">
        <div class="modal-box max-w-lg bg-white/95 backdrop-blur-md rounded-2xl shadow-lg border border-gray-100">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                    <span class="text-red-800 text-xl">📘</span> Add Module to Classroom
                </h3>

                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost text-gray-500 hover:text-red-700">✕</button>
                </form>
            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('classroommodule.store',$classroom->id) }}" class="space-y-4">
                @csrf

                <!-- Correct: classroom_id is fixed -->
                <input type="hidden" name="classroom_id" value="{{ $classroom->id }}"/>

                <!-- added_by is correct -->
                <input type="hidden" name="added_by" value="{{ auth()->user()->id }}"/>

                <!-- Correct: module_id comes from dropdown -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text text-sm font-semibold text-gray-600">Module</span>
                    </label>
                    <select name="module_id"
                        class="select select-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg" required>
                        <option disabled selected>Select Module</option>

                        @foreach(auth()->user()->module as $module)
                            @if(!$classroom->classroomModule->where('module_id', $module->id)->count())
                                <option value="{{ $module->id }}">{{ $module->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="modal-action flex justify-end gap-3 mt-6">
                    <button type="button" class="btn btn-ghost text-gray-600 hover:bg-gray-100"
                        onclick="newClassroomModuleModal.close()">Cancel</button>

                    <button type="submit"
                        class="btn bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90 transition px-6">
                        Add Module
                    </button>
                </div>
            </form>
        </div>
    </dialog>
    <script>
    function generateEditCode(id) {
        let code = "CLS-" + Math.random().toString(36).substring(2, 7).toUpperCase();
        document.getElementById(`edit_class_code_${id}`).value = code;
    }
    </script>
</x-layout>
