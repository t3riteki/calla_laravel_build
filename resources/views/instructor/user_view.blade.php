<x-layout>
    <x-slot:title>{{ $user->name }} - Student Details</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-screen bg-white">
        <x-sidebar />

        <main class="flex-1 p-6 md:p-8 lg:ml-64 overflow-y-auto">

            <a href="{{ url()->previous() }}" class="btn btn-sm mb-6 bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90">
                ← Back to Classroom
            </a>

            <div class="card bg-base-100 shadow-lg border rounded-2xl p-6">
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

                <div class="mt-10">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Module Progress in This Classroom</h3>
                    <div class="overflow-x-auto">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr class="bg-gray-100 text-gray-700">
                                    <th>Module</th>
                                    <th>Lesson</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>
</x-layout>
