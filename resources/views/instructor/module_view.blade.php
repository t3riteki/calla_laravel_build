<x-layout>
    <x-slot:title>{{ $module->name }} - Module Details</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-screen bg-white">

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
                            @isset($classroomModule)
                                <div class="p-4 bg-gray-50 rounded-lg border">
                                    <p class="text-sm text-gray-500">Classroom</p>
                                    <p class="font-medium text-gray-700">{{ $classroomModule->classroom->name ?? 'N/A' }}</p>
                                </div>
                            @else
                                <div class="p-4 bg-gray-50 rounded-lg border">
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-500">Classrooms</span>
                                        <button class="btn btn-ghost btn-xs text-xs text-red-300" onclick="newClassroomModuleModal.showModal()">Add to Classroom</button>
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

                    <!-- ADD TO CLASSROOM MODAL -->
                    <dialog id="newClassroomModuleModal" class="modal">
                        <div class="modal-box max-w-lg bg-white/95 backdrop-blur-md rounded-2xl shadow-lg border border-gray-100">

                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                                    <span class="text-red-800 text-xl">📘</span> Add to Classroom
                                </h3>

                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost text-gray-500 hover:text-red-700">✕</button>
                                </form>
                            </div>

                            <!-- FORM -->
                            <form method="POST" action="{{ route('classroommodule.store',$module->id) }}" class="space-y-4">
                                @csrf
                                <input type="hidden" name="added_by" value="{{ auth()->user()->id }}"/>
                                <input type="hidden" name="module_id" value="{{ $module->id }}"/>

                                <!-- CLASSROOM DROPDOWN -->
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text text-sm font-semibold text-gray-600">Classroom</span>
                                    </label>
                                    <select name="classroom_id"
                                        class="select select-bordered w-full focus:ring-2 focus:ring-red-700 rounded-lg" required>
                                        <option disabled selected>Select classroom</option>
                                        @foreach(auth()->user()->classroom as $classroom)
                                            @if(!$classroom->classroomModule->where('module_id', $module->id)->count())
                                                <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="modal-action flex justify-end gap-3 mt-6">
                                    <button type="button" class="btn btn-ghost text-gray-600 hover:bg-gray-100"
                                        onclick="newClassroomModuleModal.close()">Cancel</button>

                                    <button type="submit"
                                        class="btn bg-gradient-to-r from-red-800 to-red-700 text-white hover:opacity-90 transition px-6">
                                        Add Module
                                    </button>
                                </div>
                            </form>
                        </div>
                    </dialog>


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

                <!-- LESSON LIST (Optional) -->
                @if($module->lesson->count() > 0)
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Lessons</h3>
                        <ul class="list-disc list-inside">
                            @foreach ($module->lesson as $lesson)
                                <li>
                                    <span class="font-medium">{{ $lesson->name }}</span> -
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
