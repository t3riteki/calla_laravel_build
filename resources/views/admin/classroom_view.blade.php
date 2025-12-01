<x-layout>
    <x-slot:title>{{ $classroom->name }} - Classroom</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-screen bg-gray-50">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 lg:ml-64 md:ml-56">

            <!-- HEADER -->
            <section class="mb-10">
                <div class="rounded-2xl bg-gradient-to-r from-red-900 via-red-700 to-red-600 text-white p-8 shadow-lg">
                    <div class="flex flex-col lg:flex-row justify-between gap-6">

                        <!-- Title + Description -->
                        <div>
                            <h2 class="text-4xl font-bold">{{ $classroom->name }}</h2>
                            <p class="opacity-80 mt-3 max-w-xl">{{ $classroom->description }}</p>

                            <p class="mt-3 inline-block px-3 py-1 bg-red-100 text-red-800 rounded-lg text-sm font-medium">
                                Code: {{ $classroom->code }}
                            </p>
                        </div>

                        <!-- Stats + Back -->
                        <div class="flex flex-col items-start gap-4">
                            <a href="{{ route('classrooms.index') }}"
                               class="btn btn-sm bg-white/20 text-white hover:bg-white/30">
                                ← Back to Classrooms
                            </a>

                            <div class="stats stats-vertical sm:stats-horizontal shadow-lg">
                                <div class="stat bg-white/10 backdrop-blur-md text-white">
                                    <div class="stat-title text-gray-200">Students</div>
                                    <div class="stat-value">{{ $classroom->EnrolledUser->where('user.role','learner')->count() }}</div>
                                </div>

                                <div class="stat bg-white/10 backdrop-blur-md text-white">
                                    <div class="stat-title text-gray-200">Modules</div>
                                    <div class="stat-value">{{ $classroom->ClassroomModule->count() }}</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- STUDENT LIST -->
            <section class="mb-10">
                <div class="card bg-white shadow-lg border rounded-xl">
                    <div class="card-body">

                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Enrolled Students</h3>

                            <button class="btn btn-sm bg-red-800 text-white hover:bg-red-700"
                                onclick="addStudentModal.showModal()">
                                + Add Student
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table table-zebra text-center w-full">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Joined</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($classroom->EnrolledUser->where('user.role','learner') as $enroll)
                                        <tr>
                                            <td>{{ $enroll->user->name }}</td>
                                            <td>{{ $enroll->user->email }}</td>
                                            <td>Active</td>
                                            <td>{{ $enroll->created_at->format('M d, Y') }}</td>
                                            <td class="flex justify-center gap-3">

                                                <a href="{{ route('enrolleduser.show', $enroll->id) }}"
                                                   class="text-red-700 hover:underline">View</a>

                                                <form method="POST" action="{{ route('enrolleduser.destroy',$enroll->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-blue-600 hover:underline">Remove</button>
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

            <!-- MODULE LIST -->
            <section class="mb-10">
                <div class="card bg-white shadow-lg border rounded-xl">
                    <div class="card-body">

                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">Class Modules</h3>

                            <button onclick="moduleModal.showModal()"
                               class="btn btn-sm bg-red-800 text-white hover:bg-red-700">
                                + Add Module
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="table table-zebra text-center w-full">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Date Added</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classroom->ClassroomModule as $mod)
                                        <tr>
                                            <td>{{ $mod->module->name }}</td>
                                            <td class="max-w-[250px] truncate">{{ $mod->module->description }}</td>
                                            <td>{{ $mod->module->created_at->format('M d, Y') }}</td>

                                            <td class="flex justify-center gap-3">
                                                <a href="{{ route('classroommodule.show',$mod->id) }}"
                                                   class="text-red-700 hover:underline">View</a>

                                                <form method="POST" action="{{ route('classroommodule.destroy', $mod->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="text-blue-600 hover:underline">Remove</button>
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

    <!-- MODAL: ADD STUDENT -->
    <dialog id="addStudentModal" class="modal">
        <div class="modal-box rounded-xl shadow-xl bg-white">
            <h3 class="font-bold text-lg mb-4">Add Student</h3>

            <form method="POST" action="{{ route('enrolleduser.store', $classroom->id) }}" class="space-y-4">
                @csrf
                <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">

                <div>
                    <label class="label-text">Student Email</label>
                    <input type="email" name="email" class="input input-bordered w-full" required>
                </div>

                <div class="modal-action">
                    <button type="button" class="btn" onclick="addStudentModal.close()">Cancel</button>
                    <button class="btn bg-red-800 text-white hover:bg-red-700">Add</button>
                </div>
            </form>
        </div>
    </dialog>

    <!-- MODAL: ADD MODULE -->
    <dialog id="moduleModal" class="modal">
        <div class="modal-box rounded-xl shadow-xl bg-white max-w-lg">

            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-lg">Add Module</h3>
                <button onclick="moduleModal.close()" class="btn btn-sm btn-ghost">✕</button>
            </div>

            <form method="POST" action="{{ route('classroommodule.store', $classroom->id) }}" class="space-y-4">
                @csrf

                <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                <input type="hidden" name="added_by" value="{{ auth()->id() }}">

                <div>
                    <label class="label-text">Module</label>
                    <select name="module_id" class="select select-bordered w-full" required>
                        <option disabled selected>Select Module</option>

                        @foreach(auth()->user()->module as $module)
                            @if(!$classroom->ClassroomModule->where('module_id', $module->id)->count())
                                <option value="{{ $module->id }}">{{ $module->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="modal-action">
                    <button type="button" class="btn" onclick="moduleModal.close()">Cancel</button>
                    <button class="btn bg-red-800 text-white hover:bg-red-700">Add Module</button>
                </div>
            </form>

        </div>
    </dialog>

</x-layout>
