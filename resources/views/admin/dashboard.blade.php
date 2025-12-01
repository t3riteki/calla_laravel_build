 <x-layout>
    <x-slot:title>Admin Dashboard - CALLA</x-slot:title>

    <div class="flex min-h-screen bg-gray-100">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 lg:ml-64 md:ml-56 sm:ml-0 transition-all duration-300">

            <!-- 🔥 HEADER / HERO -->
            <section class="mb-10">
                <div class="rounded-3xl bg-gradient-to-r from-red-900 via-red-700 to-red-500
                            p-8 text-white shadow-xl relative overflow-hidden">

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

            <!-- 📊 QUICK METRICS -->
            <section class="mb-10">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                        <h4 class="text-gray-600 text-sm">Total Learners</h4>
                        <p class="text-4xl font-bold text-red-700 mt-2">{{ $data['learner_count'] ?? 0 }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                        <h4 class="text-gray-600 text-sm">Total Instructors</h4>
                        <p class="text-4xl font-bold text-red-700 mt-2">{{ $data['instructor_count'] ?? 0 }}</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                        <h4 class="text-gray-600 text-sm">System Activity</h4>
                        <p class="text-sm text-gray-500 mt-2">Everything is running smoothly ✓</p>
                    </div>

                </div>
            </section>

            <!-- 👥 USER MANAGEMENT -->
            <section class="mt-10">
                <div class="bg-white rounded-2xl p-6 shadow-lg border">

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
                                            <a href="{{ route('users.show', $user->id) }}"
                                            class="text-red-600 hover:underline">View</a>
                                            |
                                            <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-blue-600 hover:underline">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </section>

            <!-- 🏫 CLASSROOM MANAGEMENT -->
            <section class="mb-10">
                <div class="bg-white rounded-2xl p-6 shadow-lg border">

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
                                    <th>Learners</th>
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
                                            <a href="{{ route('classrooms.show', $classroom->id) }}"
                                               class="text-red-600 hover:underline">View</a>
                                            |
                                            <a onclick="document.getElementById('editClassModal-{{ $classroom->id }}').showModal()"
                                               class="text-blue-600 hover:underline cursor-pointer">Edit</a>
                                        </td>
                                    </tr>

                                    <!-- EDIT MODAL -->
                                    <dialog id="editClassModal-{{ $classroom->id }}" class="modal">
                                        <div class="modal-box rounded-xl p-6">
                                            <h3 class="text-lg font-bold mb-4">Edit Classroom</h3>

                                            <form method="POST" action="{{ route('classrooms.update', $classroom->id) }}" class="space-y-3">
                                                @csrf
                                                @method('PUT')

                                                <input type="text" name="name" value="{{ $classroom->name }}"
                                                    class="input input-bordered w-full rounded-lg" required>

                                                <textarea name="description" class="textarea textarea-bordered w-full rounded-lg" required>{{ $classroom->description }}</textarea>

                                                <div class="flex justify-end gap-3 mt-4">
                                                    <button type="button" class="btn" onclick="document.getElementById('editClassModal-{{ $classroom->id }}').close()">Cancel</button>
                                                    <button class="btn bg-red-700 text-white hover:bg-red-600">Save</button>
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

            <!-- 📚 MODULE MANAGEMENT -->
            <section>
                <div class="bg-white rounded-2xl p-6 shadow-lg border">

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
                                            <a href="{{ route('modules.show', $module->id) }}"
                                               class="text-red-600 hover:underline">View</a>
                                            |
                                            <a href="{{ route('modules.edit', $module->id) }}"
                                               class="text-blue-600 hover:underline">Edit</a>
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

    <style>
        @keyframes fadeSlideUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-slide { animation: fadeSlideUp 0.7s ease forwards; }
    </style>

</x-layout>
