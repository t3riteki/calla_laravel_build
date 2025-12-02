<x-layout>
    <x-slot:title>Admin Dashboard - CALLA</x-slot:title>

    <!-- DASHBOARD CONTAINER -->
    <div class="flex flex-col lg:flex-row min-h-screen bg-gray-100 transition-all duration-300">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN CONTENT -->
        <main
            class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto
                   lg:ml-64 md:ml-56 sm:ml-0 transition-all duration-300">

            <!-- HEADER / HERO -->
            <section class="mb-10">
                <div class="rounded-3xl bg-gradient-to-r from-red-900 via-red-700 to-red-500 p-8 text-white shadow-xl relative overflow-hidden">

                    <!-- Decorative Blobs -->
                    <div class="absolute top-0 right-0 w-60 h-60 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-56 h-56 bg-black/10 rounded-full blur-2xl"></div>

                    <div class="relative z-10 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6">

                        <div>
                            <h1 class="text-4xl lg:text-5xl font-extrabold">Admin Dashboard</h1>
                            <p class="text-gray-200 mt-2 text-sm">
                                Welcome back Admin, here’s your updated overview and activity summary.
                            </p>
                        </div>

                        <!-- STAT CARDS -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 shadow">
                                <p class="text-gray-200 text-xs">Total Classrooms</p>
                                <h3 class="text-3xl font-bold">{{ $data['classroom_count'] }}</h3>
                            </div>

                            <div class="p-4 rounded-xl bg-white/10 backdrop-blur-md border border-white/20 shadow">
                                <p class="text-gray-200 text-xs">Total Modules</p>
                                <h3 class="text-3xl font-bold">{{ $data['module_count'] }}</h3>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- QUICK METRICS -->
            <section class="mb-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <div class="bg-white p-6 rounded-2xl shadow border">
                        <h4 class="text-gray-600 text-sm">Total Learners</h4>
                        <p class="text-4xl font-bold text-red-700 mt-2">{{ $data['learner_count'] ?? 0 }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow border">
                        <h4 class="text-gray-600 text-sm">Total Instructors</h4>
                        <p class="text-4xl font-bold text-red-700 mt-2">{{ $data['instructor_count'] ?? 0 }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow border">
                        <h4 class="text-gray-600 text-sm">System Activity</h4>
                        <p class="text-sm text-gray-500 mt-2">Everything is running smoothly ✓</p>
                    </div>

                </div>
            </section>

            <!-- USER MANAGEMENT -->
            <section class="mb-10">
                <div class="bg-white rounded-2xl p-6 shadow border">

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold">User Overview</h3>
                        <a href="/users" class="btn btn-sm bg-red-700 hover:bg-red-600 text-white">View All</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full text-sm text-center">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Date Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data['users'] as $user)
                                    <tr>
                                        <td class="font-medium">{{ $user->name }}</td>
                                        <td class="text-gray-600">{{ $user->email }}</td>
                                        <td class="capitalize">
                                            @if ($user->role === 'admin')
                                                <span class="text-red-700 font-semibold">Admin</span>
                                            @elseif ($user->role === 'instructor')
                                                <span class="text-blue-700 font-semibold">Instructor</span>
                                            @else
                                                <span class="text-green-700 font-semibold">Learner</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('user.show', $user->id) }}" class="text-red-600 hover:underline">View</a>
                                            |
                                            <!-- Edit Button triggers modal -->
                                            <button onclick="document.getElementById('editUserModal-{{ $user->id }}').showModal()"
                                                class="btn btn-link text-blue-500 no-underline hover:underline">
                                                Edit
                                            </button>

                                             <!-- Edit User Modal -->
                                            <dialog id="editUserModal-{{ $user->id }}" class="modal">
                                                <div class="modal-box max-w-lg bg-white/95 backdrop-blur-md rounded-2xl shadow-lg border border-gray-100">

                                                    <!-- Header -->
                                                    <div class="flex justify-between items-center mb-4">
                                                        <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                                            <span class="text-blue-700 text-xl">🧑‍💼</span> Edit User
                                                        </h3>

                                                        <form method="dialog">
                                                            <button class="btn btn-sm btn-circle btn-ghost text-gray-500 hover:text-red-700">✕</button>
                                                        </form>
                                                    </div>

                                                    <!-- USER EDIT FORM -->
                                                    <form method="POST" action="{{ route('user.update', $user->id) }}" class="space-y-4">
                                                        @csrf
                                                        @method('PUT')

                                                        <!-- NAME -->
                                                        <div class="form-control">
                                                            <label class="label">
                                                                <span class="label-text text-sm font-semibold text-gray-600">Name</span>
                                                            </label>
                                                            <input type="text" name="name" value="{{ $user->name }}"
                                                                class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg" required>
                                                        </div>

                                                        <!-- EMAIL -->
                                                        <div class="form-control">
                                                            <label class="label">
                                                                <span class="label-text text-sm font-semibold text-gray-600">Email</span>
                                                            </label>
                                                            <input type="email" name="email" value="{{ $user->email }}"
                                                                class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg" required>
                                                        </div>

                                                         <!-- PASSWORD -->
                                                        <div class="form-control">
                                                            <label class="label">
                                                                <span class="label-text text-sm font-semibold text-gray-600">Password</span>
                                                            </label>
                                                            <input type="password" name="password"
                                                                placeholder="Enter new password (leave blank to keep current)"
                                                                class="input input-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg">
                                                        </div>

                                                        <!-- ACTION BUTTONS -->
                                                        <div class="modal-action flex justify-end gap-3 mt-6">
                                                            <button type="button"
                                                                class="btn btn-ghost text-gray-600 hover:bg-gray-100"
                                                                onclick="document.getElementById('editUserModal-{{ $user->id }}').close()">
                                                                Cancel
                                                            </button>

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
            </section>

            <!-- CLASSROOM MANAGEMENT -->
            <section class="mb-10">
                <div class="bg-white rounded-2xl p-6 shadow border">

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold">Classroom Overview</h3>
                        <a href="/classrooms" class="btn btn-sm bg-red-700 hover:bg-red-600 text-white">View All</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full text-sm text-center">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Lners</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data['classrooms'] as $classroom)
                                    <tr>
                                        <td class="font-medium">{{ $classroom->name }}</td>
                                        <td class="max-w-[200px] truncate">{{ $classroom->description }}</td>
                                        <td>{{ $classroom->EnrolledUser->where('user.role', 'learner')->count() }}</td>
                                        <td>{{ $classroom->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('classrooms.show', $classroom->id) }}" class="text-red-600 hover:underline">View</a>
                                            |
                                            <button onclick="document.getElementById('editClassModal-{{ $classroom->id }}').showModal()"
                                                class="btn btn-link text-blue-500 no-underline hover:underline">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <dialog id="editClassModal-{{ $classroom->id }}" class="modal">
                                        <div class="modal-box max-w-lg bg-white rounded-2xl shadow border">

                                            <div class="flex justify-between items-center mb-4">
                                                <h3 class="text-lg font-semibold text-gray-800">Edit Classroom</h3>

                                                <form method="dialog">
                                                    <button class="btn btn-sm btn-circle btn-ghost text-gray-500">✕</button>
                                                </form>
                                            </div>

                                            <form method="POST" action="{{ route('classrooms.update', $classroom->id) }}" class="space-y-4">
                                                @csrf
                                                @method('PUT')

                                                <div class="form-control">
                                                    <label class="label">
                                                        <span class="label-text text-sm font-semibold">Class Name</span>
                                                    </label>
                                                    <input type="text" name="name" value="{{ $classroom->name }}" class="input input-bordered w-full rounded-lg" required>
                                                </div>

                                                <div class="form-control">
                                                    <label class="label">
                                                        <span class="label-text text-sm font-semibold">Description</span>
                                                    </label>
                                                    <textarea name="description" class="textarea textarea-bordered w-full h-24 resize-none rounded-lg" required>{{ $classroom->description }}</textarea>
                                                </div>

                                                <div class="modal-action flex justify-end gap-3">
                                                    <button type="button" class="btn btn-ghost" onclick="document.getElementById('editClassModal-{{ $classroom->id }}').close()">
                                                        Cancel
                                                    </button>

                                                    <button class="btn bg-red-700 text-white hover:bg-red-600">
                                                        Save Changes
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </dialog>

                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </section>

            <!-- MODULE MANAGEMENT -->
            <section class="mb-10">
                <div class="bg-white rounded-2xl p-6 shadow border">

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-semibold">Module Overview</h3>
                        <a href="/modules" class="btn btn-sm bg-red-700 hover:bg-red-600 text-white">View All</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full text-sm text-center">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th>Module</th>
                                    <th>Description</th>
                                    <th>Instances</th>
                                    <th>Date Added</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($data['modules'] as $module)
                                    <tr>
                                        <td class="font-medium">{{ $module->name }}</td>
                                        <td class="max-w-[200px] truncate">{{ $module->description }}</td>
                                        <td>{{ $module->ClassroomModule->count() }}</td>
                                        <td>{{ $module->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('modules.show', $module->id) }}" class="text-red-600 hover:underline">View</a>
                                            |
                                            <a href="{{ route('modules.edit', $module->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </section>

        </main>
    </div>

</x-layout>
