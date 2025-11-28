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
                    </div>

                    <!-- Stats & Back Button-->
                        <div class="flex flex-col gap-4">
                    <!-- Back Button above stats -->
                    <a href="{{ route('classrooms.index') }}"
                    class="btn btn-sm bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90">
                        ← Back to Classrooms
                    </a>

                    <!-- Leave Button -->
                    <button onclick="leaveClassroomModal.showModal()"
                            class="btn btn-sm bg-gradient-to-r from-orange-600 to-orange-500 text-white hover:opacity-90">
                        Leave Classroom
                    </button>

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
                        <h3 class="card-title text-lg sm:text-xl">Enrolled Students</h3>

                        <!-- Table -->
                        <div class="overflow-x-auto mt-4">
                            <table class="table text-center table-zebra w-full text-sm sm:text-base">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th>Joined</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($classroom->EnrolledUser->where('user.role','learner') as $enrollment)
                                        <tr>
                                            <td>{{ $enrollment->user->name }}</td>
                                            <td>{{ $enrollment->user->email }}</td>
                                            <td>{{ $enrollment->user->created_at->format('M d, Y') }}</td>
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
                        <h3 class="card-title text-lg sm:text-xl">Class Modules</h3>

                        <!-- Table -->
                        <div class="overflow-x-auto mt-4">
                            <table class="table table-zebra w-full text-sm sm:text-base">
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
                                            <td class="space-x-2">
                                                <a href="{{ route('classroommodule.show', $classmodule->id) }}"
                                                   class="text-red-700 hover:underline">View</a>
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

    <!-- LEAVE CLASSROOM MODAL -->
    <dialog id="leaveClassroomModal" class="modal">
        <div class="modal-box max-w-md bg-white rounded-xl shadow-xl p-6">
            <h3 class="font-bold text-lg mb-4">Leave Classroom</h3>
            <p class="mb-6 text-gray-600">Are you sure you want to leave this classroom? You can rejoin later using the classroom code.</p>

            <div class="modal-action">
                <button type="button" class="btn" onclick="leaveClassroomModal.close()">Cancel</button>
                <form method="POST" action="{{ route('enrolleduser.destroy', Auth::user()->enrolledUser()->where('classroom_id', $classroom->id)->first()->id) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn bg-orange-600 text-white hover:bg-orange-700">Leave</button>
                </form>
            </div>
        </div>
    </dialog>

</x-layout>
