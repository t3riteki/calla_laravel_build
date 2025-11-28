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

                    <!-- Stats & Back Button-->
                        <div class="flex flex-col gap-4">
                    <!-- Back Button above stats -->
                    <a href="{{ route('classrooms.index') }}"
                    class="btn btn-sm bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90">
                        ← Back to Classrooms
                    </a>

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
                                                <a href="{{ route('enrolleduser.show', [$enrollment->id]) }}" class="text-red-700 hover:underline">View</a>
                                                <form method="POST" action="{{ route('enrolleduser.destroy', $enrollment->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-blue-500 hover:underline cursor-pointer" type="submit">Remove</button>
                                                </form>
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
                                                <a href="{{ route('classroommodule.show',$classmodule->id) }}" class="text-red-700 hover:underline">View</a>
                                                <form method="POST" action="{{ route('classroommodule.destroy', $classmodule->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-blue-500 hover:underline cursor-pointer" type="submit">Remove</button>
                                                </form>
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
</x-layout>
