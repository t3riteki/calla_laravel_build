<x-layout>
    <x-slot:title>Instructor Dashboard - CALLA</x-slot:title>

    <!-- DASHBOARD CONTAINER -->
    <div class="flex flex-col lg:flex-row min-h-screen bg-white transition-all duration-300">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN CONTENT -->
        <main
            class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto
                   lg:ml-64 md:ml-56 sm:ml-0 transition-all duration-300">

            <!-- 📊 DASHBOARD OVERVIEW -->
            <section class="mb-10">
                <div class="hero rounded-2xl bg-gradient-to-r from-red-900 via-red-700 to-red-600 text-white p-6 sm:p-8 md:p-10">
                    <div class="hero-content flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 lg:gap-16 w-full">
                        <div>
                            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold">Dashboard Overview</h2>
                            <p class="py-4 text-sm sm:text-base opacity-80">
                                Welcome {{ auth()->user()->role }}, here's everything so far ^_^
                            </p>
                        </div>

                        <!-- DaisyUI Stats -->
                        <div class="stats stats-vertical sm:stats-horizontal shadow mt-4 lg:mt-0 flex-shrink-0">
                            <div class="stat bg-white/10 text-white backdrop-blur-md">
                                <div class="stat-title text-gray-200">Total Classes</div>
                                <div class="stat-value text-white text-2xl sm:text-3xl">
                                    {{ $data['classroom_count'] }}
                                </div>
                            </div>

                            <div class="stat bg-white/10 text-white backdrop-blur-md">
                                <div class="stat-title text-gray-200">Total Modules</div>
                                <div class="stat-value text-white text-2xl sm:text-3xl">
                                    {{ $data['module_count'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 🏫 CLASS LIST -->
            <section class="mb-10">
                <div class="card bg-base-100 shadow-lg border">
                    <div class="card-body">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <h3 class="card-title text-lg sm:text-xl">My Classrooms</h3>
                            <a class="btn btn-sm bg-red-800 hover:bg-red-700 text-white w-full sm:w-auto" href="/classrooms">
                                View All
                            </a>
                        </div>

                        <div class="overflow-x-auto mt-4">
                            <table class="table table-zebra w-full text-center text-sm sm:text-base">
                                <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Class Description</th>
                                        <th>Enrollees</th>
                                        <th>Date Added</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['classrooms'] as $classroom)
                                        <tr>
                                            <td>{{ $classroom->name }}</td>
                                            <td class="max-w-[150px] truncate">{{ $classroom->description }}</td>
                                            <td>{{ $classroom->EnrolledUser->where('user.role','learner')->count() }}</td>
                                            <td>{{ $classroom->created_at }}</td>
                                            <td class="py-3 px-4 space-x-2">
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
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 📚 MODULE MANAGEMENT -->
            <section>
                <div class="card bg-base-100 shadow-lg border">
                    <div class="card-body">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <h3 class="card-title text-lg sm:text-xl">My Modules</h3>
                            <a class="btn btn-sm bg-red-800 hover:bg-red-700 text-white w-full sm:w-auto" href="/modules">
                                View All
                            </a>
                        </div>

                        <div class="overflow-x-auto mt-4">
                            <table class="table table-zebra w-full text-center text-sm sm:text-base">
                                <thead>
                                    <tr>
                                        <th>Module Title</th>
                                        <th>Module Description</th>
                                        <th>Instance Count</th>
                                        <th>Date Added</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['modules'] as $module)
                                        <tr class="align-center">
                                            <td>{{ $module->name }}</td>
                                            <td class="max-w-[150px] truncate">{{ $module->description }}</td>
                                            <td>{{ $module->ClassroomModule->count() }}</td>
                                            <td>{{ $module->created_at }}</td>
                                            <td class="py-3 px-4 space-x-2">
                                                <a href="{{ route('modules.show', $module->id) }}"
                                                class="btn btn-link text-red-700 no-underline hover:underline">
                                                    View
                                                </a>
                                                <a href="{{ route('modules.edit', $module->id) }}"
                                                class="btn btn-link text-blue-500 no-underline hover:underline">
                                                    Edit
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
</x-layout>
