<x-layout>
    <x-slot:title>{{ $user->name }} - User Details</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-screen bg-white">
        <x-sidebar />

        <main class="flex-1 p-6 md:p-8 lg:ml-64 overflow-y-auto">

            <a href="{{ route('user.index') }}"
                class="btn btn-sm mb-6 bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90">
                ← Back to Users
            </a>

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
                                @foreach ($user->modules as $module)
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
                                        <a href="{{ route('users.logs', $user->id) }}"
                                            class="text-gray-600 hover:underline">Logs</a>
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
                        @foreach ($user->classrooms as $classroom)
                        <li>{{ $classroom->name }}</li>
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
                                @foreach ($progress as $entry)
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
                                        <a href="{{ route('users.show', $user->id) }}"
                                            class="text-red-600 hover:underline">View</a>
                                        |
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-blue-600 hover:underline">Edit</a>
                                        |
                                        <a href="{{ route('users.logs', $user->id) }}"
                                            class="text-gray-600 hover:underline">Logs</a>
                                        |
                                        <form action="{{ route('users.destroy',$user->id) }}" method="POST"
                                            class="inline">
                                            @csrf @method('DELETE')
                                            <button class="text-red-700 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

            </div>
        </main>
    </div>
</x-layout>
