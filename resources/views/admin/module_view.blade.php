<x-layout>
    <x-slot:title>{{ $module->name }} - Module Details</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-screen bg-white">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 md:p-8 lg:ml-64 overflow-y-auto">

            <!-- BACK BUTTON -->
            <a href="{{ url()->previous() }}"
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
                            @isset($classroomModule)
                                <div class="p-4 bg-gray-50 rounded-lg border">
                                    <p class="text-sm text-gray-500">Classroom</p>
                                    <p class="font-medium text-gray-700">{{ $classroomModule->classroom->name ?? 'N/A' }}</p>
                                </div>
                            @else
                                <div class="p-4 bg-gray-50 rounded-lg border">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">Classrooms</span>
                                    </div>


                                    @foreach ($module->classroomModule as $classModule)
                                        <a href="{{ route('classrooms.show', $classModule->classroom->id) }}" class="link">{{ $classModule->classroom->name }}</a>
                                        @if(! $loop->last)
                                            ,
                                        @endif

                                    @endforeach
                                </div>
                            @endisset


                            <div class="p-4 bg-gray-50 rounded-lg border">
                                <p class="text-sm text-gray-500">Number of Lessons</p>
                                <p class="font-medium text-gray-700">{{ $module->lesson->count() ?? 0 }}</p>
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
                    <div class="flex flex-col gap-3 md:w-48 w-full">

                        <a href="{{ route('modules.edit', $module->id) }}"
                        class="px-4 py-2 text-center bg-red-700 hover:bg-red-600 text-white rounded-lg transition">
                            Edit Module
                        </a>

                        <form method="POST" action="{{ route('modules.destroy', $module->id) }}" onsubmit="return confirm('Delete this module?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full px-4 py-2 border border-red-700 text-red-700 hover:bg-red-50 rounded-lg transition">
                                Delete Module
                            </button>
                        </form>

                    </div>

                </div>

                <!-- LESSON CARDS  -->
                @if($module->lesson->count() > 0)
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Lessons</h3>

                        <div class="flex flex-col col gap-1">
                            @foreach ($module->lesson as $lesson)
                                <div class="bg-gradient-to-br from-gray-50 to-white border border-gray-200 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 p-6 flex flex-col">

                                    <!-- Lesson Header -->
                                    <div class="mb-4">
                                        <h4 class="text-xl font-bold text-gray-800">{{ $lesson->name }}</h4>
                                        <p class="text-gray-500 text-sm">{{ $lesson->created_at->format('M d, Y') }}</p>
                                    </div>

                                    <!-- Lesson Description -->
                                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $lesson->description }}</p>
                                    <!-- Lesson Content Preview -->
                                    <div class="prose prose-sm max-w-none mb-6 flex-grow">
                                        <div class="overflow-x-auto border border-gray-200 rounded-lg max-h-48">
                                            <table class="table table-compact w-full">
                                                <thead>
                                                    <tr class="bg-gray-100">
                                                        <th class="w-1/3">Term</th>
                                                        <th>Meaning</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($lesson->glossary as $glossary)
                                                        <tr>
                                                            <td>{{ $glossary->term }}</td>
                                                            <td>{{ $glossary->meaning }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Start Lesson Button -->
                                    <button onclick="toBeImplementedModal.showModal()"
                                       class="btn bg-gradient-to-r from-red-700 to-red-500 text-white hover:opacity-90 transition self-start">
                                        Start Lesson →
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="mt-8 text-center py-8 text-gray-500">
                        <p>No lessons available for this module yet.</p>
                    </div>
                @endif

            </div>
        </main>
    </div>
</x-layout>
