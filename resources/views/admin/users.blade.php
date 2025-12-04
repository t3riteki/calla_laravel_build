<x-layout>
    <x-slot:title>All Users - CALLA</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-[calc(100vh-64px)] bg-white transition-all duration-300">
        <x-sidebar />

        <main class="flex-1 p-4 sm:p-6 md:p-8 overflow-y-auto lg:ml-64 md:ml-56 sm:ml-0">

            <section class="mb-10" x-data="{ search: '' }">
                <div class="card bg-base-100 shadow-lg ">
                    <div class="card-body">

                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <h3 class="card-title text-lg sm:text-xl">All Users</h3>

                            <div class="form-control w-full sm:max-w-xs">
                                <input type="text"
                                       x-model="search"
                                       placeholder="Search users..."
                                       class="input input-bordered input-sm w-full" />
                            </div>
                        </div>

                        <div class="h-[calc(100vh-276px)] overflow-x-auto mt-4">
                            <table class="table text-center table-zebra w-full text-sm sm:text-base">
                                <thead class="sticky top-0 bg-base-100 z-10 shadow-sm">
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
                                    <tr x-show="$el.innerText.toLowerCase().includes(search.toLowerCase())"
                                        class="transition-opacity duration-300">

                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>

                                        <td>
                                            @if ($user->role === 'instructor')
                                                <span class="text-blue-700 font-semibold">Instructor</span>
                                            @elseif ($user->role === 'learner')
                                                <span class="text-green-700 font-semibold">Learner</span>
                                            @elseif ($user->role === 'admin')
                                                <span class="text-red-700 font-semibold">Admin</span>
                                            @else Unknown
                                            @endif
                                        </td>

                                        <td>{{ $user->created_at->format('M d, Y') }}</td>

                                        <td class="space-x-2 flex justify-center">
                                            <a href="{{ route('user.show', $user->id) }}"
                                                class="btn btn-link text-red-700 no-underline hover:underline">
                                                View
                                            </a>
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

                            <div x-show="$el.querySelectorAll('tbody tr[style*=\'display: none\']').length === {{ count($users) }}"
                                 class="text-center py-4 text-gray-500"
                                 style="display: none;">
                                No users found matching "<span x-text="search"></span>"
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </main>
    </div>
</x-layout>
