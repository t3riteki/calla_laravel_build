<x-layout>
    <x-slot:title>{{ $user->name }} - User Details</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-screen bg-white">
        <x-sidebar />

        <main class="flex-1 p-6 md:p-8 lg:ml-64 overflow-y-auto">

            <a href="{{ route('user.index') }}"
                class="btn btn-sm mb-6 bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90">
                ← Back to Users
            </a>

            <div class="flex flex-col md:flex-row gap-6">
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">👤 {{ $user->name }}</h2>
                    <p class="text-gray-600 mt-1 text-sm">Role: {{ ucfirst($user->role) }}</p>

                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-lg border">
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium text-gray-700">{{ $user->email }}</p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg border">
                            <p class="text-sm text-gray-500">Birthday</p>
                            <p class="font-medium text-gray-700">{{ $user->birthday ?? 'Not set' }}</p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg border">
                            <p class="text-sm text-gray-500">Gender</p>
                            <p class="font-medium text-gray-700">{{ $user->gender ?? 'Not set' }}</p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg border">
                            <p class="text-sm text-gray-500">Joined</p>
                            <p class="font-medium text-gray-700">{{ $user->created_at->format('F d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>


            @if($user->role === 'instructor')
            <div class="mt-10">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Modules Owned</h3>

                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th>Module</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($user->module as $module)
                            <tr>
                                <td>{{ $module->name }}</td>
                                <td>{{ $module->description }}</td>
                                <td>{{ $module->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('modules.show', $module->id) }}"
                                        class="text-red-600 hover:underline">View</a>
                                    |
                                    <a href="{{ route('modules.edit', $module->id) }}"
                                        class="text-blue-600 hover:underline">Edit</a>
                                    |

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            @if($user->role === 'learner')
            <div class="mt-10">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Classes Enrolled</h3>

                <ul class="list-disc ml-6 text-gray-700 mb-8">
                    @foreach ($user->enrolledUser as $enrollment)
                    <li>{{ $enrollment->classroom->name }}</li>
                    @endforeach
                </ul>

                <h3 class="text-lg font-semibold text-gray-800 mb-3">Module Progress</h3>
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th>Module</th>
                                <th>Lesson</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->enrolledUser as $enrollment)
                                @foreach ($enrollment->userProgress as $entry)
                                    <tr>
                                        <td>{{ $entry->classroomModule->module->name }}</td>
                                        <td>{{ $entry->lesson->name }}</td>
                                        <td>
                                            @if($entry->is_done)
                                                <span class="badge badge-success">Completed</span>
                                            @else
                                                <span class="badge badge-warning">In Progress</span>
                                            @endif
                                        </td>
                                        <td>{{ $entry->updated_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('user.show', $user->id) }}"
                                                class="text-red-600 hover:underline">View</a>
                                            |
                                            <a href="{{ route('user.edit', $user->id) }}"
                                                class="text-blue-600 hover:underline">Edit</a>
                                            |
                                            <form action="{{ route('user.destroy',$user->id) }}" method="POST"
                                                class="inline">
                                                @csrf @method('DELETE')
                                                <button class="text-red-700 hover:underline">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </main>
    </div>
</x-layout>
