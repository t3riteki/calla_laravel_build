<x-layout>
    <x-slot:title>{{ $module->name }} - Module Details</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-screen bg-white pt-15">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 md:p-8 lg:ml-64 overflow-y-auto">

            <!-- BACK BUTTON -->
            <a href="{{ route('modules.index') }}"
               class="btn btn-sm mb-6 bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90">
                ← Back to Modules
            </a>

            <!-- MODULE DETAILS -->
            <div class="card bg-base-100 shadow-lg border rounded-2xl p-6">
                <div class="flex flex-col md:flex-row gap-6">

                    <!-- Module Info -->
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $module->name }}</h2>
                        <p class="text-gray-600 mt-2">{{ $module->description }}</p>

                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="p-4 bg-gray-50 rounded-lg border">
                                <p class="text-sm text-gray-500">Classroom</p>
                                <p class="font-medium text-gray-700">{{ $module->classroom->name ?? 'N/A' }}</p>
                            </div>

                            <div class="p-4 bg-gray-50 rounded-lg border">
                                <p class="text-sm text-gray-500">Number of Lessons</p>
                                <p class="font-medium text-gray-700">{{ $module->lessons_count ?? 0 }}</p>
                            </div>

                            <div class="p-4 bg-gray-50 rounded-lg border">
                                <p class="text-sm text-gray-500">Created At</p>
                                <p class="font-medium text-gray-700">{{ $module->created_at->format('F d, Y') }}</p>
                            </div>

                            <div class="p-4 bg-gray-50 rounded-lg border">
                                <p class="text-sm text-gray-500">Last Updated</p>
                                <p class="font-medium text-gray-700">{{ $module->updated_at->format('F d, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- ACTIONS -->
                    <div class="flex flex-col gap-3 justify-start">
                        <a href="{{ route('modules.edit', $module->id) }}"
                           class="btn btn-sm bg-red-700 hover:bg-red-600 text-white w-full">Edit Module</a>

                        <form method="POST" action="{{ route('modules.destroy', $module->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm btn-outline border-red-700 text-red-700 hover:bg-red-100 w-full">
                                Delete Module
                            </button>
                        </form>
                    </div>

                </div>

                <!-- LESSON LIST (Optional) -->
                @if($module->lessons->count() > 0)
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Lessons</h3>
                        <ul class="list-disc list-inside">
                            @foreach ($module->lessons as $lesson)
                                <li>
                                    <span class="font-medium">{{ $lesson->title }}</span> -
                                    <span class="text-gray-500 text-sm">{{ $lesson->created_at->format('M d, Y') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </main>
    </div>
</x-layout>
