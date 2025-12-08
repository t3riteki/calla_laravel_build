<x-layout>
    <x-slot:title>{{ $module->name }} - Module Details</x-slot:title>

    <div class="flex flex-col lg:flex-row min-h-screen bg-white">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 md:p-8 lg:ml-64 overflow-y-auto" x-data="{ editMode: false }">

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

                        <!-- VIEW MODE -->
                        <div x-show="!editMode">
                            <h2 class="text-2xl font-bold text-gray-800">{{ $module->name }}</h2>
                            <p class="text-gray-600 mt-2">{{ $module->description }}</p>
                        </div>

                        <!-- EDIT MODE -->
                        <form x-show="editMode"
                              method="POST"
                              action="{{ route('modules.update', $module->id) }}"
                              class="space-y-3">
                            @csrf
                            @method('PUT')

                            <input type="text"
                                   name="name"
                                   value="{{ $module->name }}"
                                   class="input input-bordered w-full"/>

                            <textarea
                                name="description"
                                rows="3"
                                class="textarea textarea-bordered w-full">{{ $module->description }}</textarea>

                            <div class="flex gap-3 mt-2">
                                <button type="submit"
                                        class="btn bg-red-800 hover:bg-red-700 text-white">
                                    Save
                                </button>

                                <button type="button"
                                        class="btn"
                                        @click="editMode = false">
                                    Cancel
                                </button>
                            </div>
                        </form>

                        <!-- Module Meta -->
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
                                        <button class="btn btn-ghost btn-xs text-xs text-red-300"
                                            onclick="newClassroomModuleModal.showModal()">Add to Classroom</button>
                                    </div>

                                    @foreach ($module->classroomModule as $classModule)
                                        <a href="{{ route('classrooms.show', $classModule->classroom->id) }}"
                                        class="link">{{ $classModule->classroom->name }}</a>
                                        @if(! $loop->last) , @endif
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

                    <!-- ACTION BUTTONS -->
                    <div class="flex flex-col gap-3 md:w-48 w-full">
                        <button @click="editMode = true"
                                class="px-4 py-2 text-center bg-red-700 hover:bg-red-600 text-white rounded-lg transition">
                            Edit Module
                        </button>

                        <!-- Delete Module Button -->
                        <button type="button"
                                class="w-full px-4 py-2 border border-red-700 text-red-700 hover:bg-red-50 rounded-lg transition"
                                onclick="document.getElementById('deleteModuleModal-{{ $module->id }}').showModal()">
                            Delete Module
                        </button>

                        <!-- Delete Confirmation Modal -->
                        <dialog id="deleteModuleModal-{{ $module->id }}" class="modal">
                            <div class="modal-box bg-white rounded-2xl shadow-xl border border-red-100">

                                <!-- Modal Title -->
                                <h3 class="text-xl font-semibold text-red-700 flex items-center gap-2">
                                    <i class="ri-error-warning-line text-2xl"></i>
                                    Confirm Delete
                                </h3>

                                <!-- Message -->
                                <p class="mt-3 text-gray-600 leading-relaxed">
                                    You are about to delete the module
                                    <span class="font-semibold text-gray-800">"{{ $module->name }}"</span>.
                                    <br>This action <strong class="text-red-600">cannot be undone</strong>.
                                </p>

                                <!-- Buttons -->
                                <div class="modal-action flex justify-end gap-3 mt-6">

                                    <!-- Cancel -->
                                    <button type="button"
                                            class="btn px-5 rounded-xl border border-gray-300 bg-white hover:bg-gray-100"
                                            onclick="document.getElementById('deleteModuleModal-{{ $module->id }}').close()">
                                        Cancel
                                    </button>

                                    <!-- Confirm Delete -->
                                    <form action="{{ route('modules.destroy', $module->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn px-5 rounded-xl bg-red-600 text-white hover:bg-red-700 shadow-sm">
                                            Yes, Delete
                                        </button>
                                    </form>

                                </div>
                            </div>

                            <!-- Background overlay -->
                            <div class="modal-backdrop bg-black/40 backdrop-blur-sm" onclick="document.getElementById('deleteModuleModal-{{ $module->id }}').close()"></div>
                        </dialog>
                    </div>

                </div>
            </div>

            <!-- LESSON CARDS  -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Lessons</h3>

                @if($module->lesson->count() > 0)
                    <div class="flex flex-col gap-4">
                        @foreach ($module->lesson as $lesson)
                            <div class="bg-gradient-to-br from-gray-50 to-white border border-gray-200 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 p-6 flex flex-col">
                                <!-- Lesson Header -->
                                <div class="mb-4 flex justify-between items-center">
                                    <div>
                                        <h4 class="text-xl font-bold text-gray-800">{{ $lesson->name }}</h4>
                                        <p class="text-gray-500 text-sm">{{ $lesson->created_at->format('M d, Y') }}</p>
                                    </div>

                                    <!-- REMOVE BUTTON (VISIBLE ONLY IN EDIT MODE) -->
                                    <form method="POST"
                                          action="{{ route('lessons.destroy', $lesson->id) }}"
                                          onsubmit="return confirm('Remove this lesson?')"
                                          x-show="editMode">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-xs border border-red-600 text-red-600 hover:bg-red-50">
                                            Remove
                                        </button>
                                    </form>
                                </div>

                                <!-- Description -->
                                <p class="text-gray-600 mb-4 line-clamp-2">{{ $lesson->description }}</p>

                                <!-- Content preview -->
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
                                <button x-show="!editMode"
                                        onclick="toBeImplementedModal.showModal()"
                                        class="btn bg-gradient-to-r from-red-700 to-red-500 text-white hover:opacity-90 transition self-start">
                                    Start Lesson →
                                </button>

                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="mt-8 text-center py-8 text-gray-500">
                        <p>No lessons available for this module yet.</p>
                    </div>
                @endif
            </div>

            <dialog id="newClassroomModuleModal" class="modal">
                <div class="modal-box bg-white rounded-2xl shadow-xl border border-gray-100">

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Add Module to Classroom</h3>
                        <form method="dialog">
                            <button class="btn btn-sm btn-circle btn-ghost text-gray-500 hover:bg-gray-100">✕</button>
                        </form>
                    </div>

                    <p class="text-gray-600 text-sm mb-6">
                        Select a classroom to associate with <span class="font-semibold text-red-700">"{{ $module->name }}"</span>.
                    </p>

                    <form action="{{ route('classroommodule.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <input type="hidden" name="module_id" value="{{ $module->id }}">
                        <input type="hidden" name="added_by" value="{{ $module->owner_id }}">

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-medium text-gray-700">Select Classroom</span>
                            </label>
                            <select name="classroom_id" class="select select-bordered w-full bg-gray-50 focus:border-red-700 focus:ring-red-700" required>
                                <option disabled selected value="">-- Choose a Classroom --</option>

                                @if($module->user->classroom->count() > 0)
                                    @foreach($module->user->classroom as $classroom)
                                        @php
                                            $isAlreadyAdded = $module->classroomModule->contains('classroom_id', $classroom->id);
                                        @endphp

                                        <option value="{{ $classroom->id }}" {{ $isAlreadyAdded ? 'disabled' : '' }}>
                                            {{ $classroom->name }} {{ $isAlreadyAdded ? '(Already Added)' : '' }}
                                        </option>
                                    @endforeach
                                @else
                                    <option disabled>No classrooms found</option>
                                @endif
                            </select>
                        </div>

                        <div class="modal-action mt-6">
                            <button type="button"
                                    onclick="document.getElementById('newClassroomModuleModal').close()"
                                    class="btn bg-white border-gray-300 text-gray-700 hover:bg-gray-50">
                                Cancel
                            </button>

                            <button type="submit" class="btn bg-red-800 hover:bg-red-700 text-white border-none">
                                Add to Classroom
                            </button>
                        </div>
                    </form>
                </div>

                <form method="dialog" class="modal-backdrop bg-black/40 backdrop-blur-sm">
                    <button>close</button>
                </form>
            </dialog>

            <dialog id="toBeImplementedModal" class="modal modal-bottom sm:modal-middle">
                <div class="modal-box bg-base-100 shadow-2xl rounded-2xl text-center">

                    <!-- Icon -->
                    <div class="flex justify-center mb-4">
                        <div class="w-14 h-14 rounded-full bg-warning/20 flex items-center justify-center text-3xl">
                            🚧
                        </div>
                    </div>

                    <!-- Title -->
                    <h3 class="font-bold text-xl text-gray-800 mb-2">
                        Feature Coming Soon
                    </h3>

                    <!-- Subtitle -->
                    <p class="text-gray-500 mb-6">
                        This feature is not yet available and will be implemented in a future update.
                    </p>

                    <!-- Actions -->
                    <div class="modal-action justify-center">
                        <form method="dialog">
                            <button class="btn btn-primary px-8 rounded-full">
                                Got it
                            </button>
                        </form>
                    </div>
                </div>
            </dialog>

        </main>
    </div>
</x-layout>
