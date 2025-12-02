<x-layout>
    <x-slot:title>All Users - CALLA</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-screen bg-white transition-all duration-300">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto lg:ml-64 md:ml-56 sm:ml-0">

            <!-- 👥 ALL USERS -->
            <section class="mb-10">
                <div class="card bg-base-100 shadow-lg border">
                    <div class="card-body">

                        <!-- Header -->
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <h3 class="card-title text-lg sm:text-xl">All Users</h3>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto mt-4">
                            <table class="table text-center table-zebra w-full text-sm sm:text-base">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Joined</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>

                                        <!-- role column (placeholder or real data) -->
                                        <td>
                                            @if ($user->role === 'instructor')
                                                Instructor
                                            @elseif ($user->role === 'learner')
                                                Learner
                                            @elseif ($user->role === 'admin')
                                                Administrator
                                            @else
                                                Unknown
                                            @endif
                                        </td>

                                        <td>{{ $user->created_at->format('M d, Y') }}</td>

                                        <td class="space-x-2 flex justify-center">
                                            <a href="{{ route('user.show', $user->id) }}"
                                                class="text-red-700 hover:underline">
                                                View
                                            </a>

                                            <a href="{{ route('user.edit', $user->id) }}"
                                                class="text-blue-500 hover:underline">
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
