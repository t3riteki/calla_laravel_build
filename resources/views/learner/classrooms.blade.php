<x-layout>
    <x-slot:title>Classrooms - CALLA</x-slot:title>
    <div class="flex min-h-[calc(100vh-64px)] bg-gray-50 transition-all duration-300">

        <!-- SIDEBAR -->
        <x-sidebar />

        <main class="flex-1 p-6 lg:ml-64 md:ml-56 sm:ml-0 overflow-y-auto transition-all duration-300">

            <!-- 🏫 Classrooms -->
            <section
                x-data="{
                    search: '',
                    tab: 'joined',
                    selectedClassroom: null,
                    classrooms: {
                        joined: {{ json_encode($classrooms['JoinedClasses']) }},
                        unjoined: {{ json_encode($classrooms['JoinableClasses']) }},
                    }
                }"
            >
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">🏫 Classrooms</h3>
                </div>

                <!-- 🔍 Search -->
                <div class="mb-6">
                    <input
                        type="text"
                        x-model.debounce.300ms="search"
                        placeholder="Search classrooms..."
                        class="input input-bordered w-full md:w-1/2"
                    >
                </div>

                <!-- 🗂 Tabs -->
                <div class="tabs mb-6">
                    <a class="tab tab-lg"
                    :class="tab === 'joined' ? 'tab-active font-semibold text-blue-600' : ''"
                    @click="tab = 'joined'">Joined</a>

                    <a class="tab tab-lg"
                    :class="tab === 'unjoined' ? 'tab-active font-semibold text-blue-600' : ''"
                    @click="tab = 'unjoined'">Not Joined</a>
                </div>

                <!-- CLASSROOMS GRID -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">

                    <!-- JOINED -->
                    <template x-if="tab === 'joined'">
                        <template x-for="classroom in classrooms.joined" :key="classroom.id">
                            <div
                                x-show="classroom.name.toLowerCase().includes(search.toLowerCase()) || search === ''"
                                x-transition.opacity.scale
                                class="bg-white rounded-2xl shadow-lg p-5 hover:shadow-2xl transition-all duration-200 border border-gray-200"
                            >
                                <h4 class="font-bold text-lg text-gray-800" x-text="classroom.name"></h4>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2" x-text="classroom.description ?? ''"></p>

                                <a :href="'/classrooms/' + classroom.id"
                                class="btn w-full rounded-xl bg-gradient-to-r from-red-700 to-red-500 text-white">
                                    View Classroom
                                </a>
                            </div>
                        </template>
                    </template>

                    <!-- UNJOINED -->
                    <template x-if="tab === 'unjoined'">
                        <template x-for="classroom in classrooms.unjoined" :key="classroom.id">
                            <div
                                x-show="classroom.name.toLowerCase().includes(search.toLowerCase()) || search === ''"
                                x-transition.opacity.scale
                                class="bg-white rounded-2xl shadow-lg p-5 hover:shadow-2xl transition-all duration-200 border border-gray-200"
                            >
                                <h4 class="font-bold text-lg text-gray-800" x-text="classroom.name"></h4>
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2" x-text="classroom.description ?? ''"></p>

                                <button
                                    @click="selectedClassroom = classroom; $refs.joinModal.showModal()"
                                    class="btn w-full rounded-xl bg-gradient-to-r from-red-600 to-red-500 text-white">
                                    Join Classroom
                                </button>
                            </div>
                        </template>
                    </template>

                </div>

                <!-- ✅ SINGLE GLOBAL MODAL -->
                <dialog x-ref="joinModal" class="modal">
                    <div class="modal-box animate-fade-slide">
                        <form :action="'/classrooms/' + selectedClassroom?.id + '/join'" method="POST">
                            @csrf

                            <div class="text-lg mb-4 font-semibold">
                                Join <span x-text="selectedClassroom?.name"></span>
                            </div>

                            <input type="text" name="code"
                                class="input input-bordered w-full mb-4"
                                placeholder="Classroom Code">

                            <button class="btn btn-primary w-full">Join</button>
                        </form>

                        <form method="dialog">
                            <button class="btn btn-sm btn-circle absolute right-2 top-2">✕</button>
                        </form>
                    </div>
                </dialog>
            </section>
        </main>
    </div>

    <!-- Tailwind Animations -->
    <style>
        @keyframes fadeSlideUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-slide { animation: fadeSlideUp 0.8s ease forwards; }
    </style>
</x-layout>
