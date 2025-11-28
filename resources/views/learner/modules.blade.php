<x-layout>
    <x-slot:title>Learner Modules - CALLA</x-slot:title>
    <div class="flex min-h-screen bg-gray-50 transition-all duration-300">

        <!-- SIDEBAR -->
        <x-sidebar />

        <main class="flex-1 p-6 lg:ml-64 md:ml-56 sm:ml-0 overflow-y-auto transition-all duration-300">

            <!-- 📚 Modules -->
            <section
                x-data="{
                    search: '',
                    modules: {{ json_encode($classroommodules->map(function($m) {
                        return [
                            'id' => $m->id,
                            'name' => $m->module->name,
                            'classroom' => $m->classroom->name,
                            'short_intro' => $m->module->short_intro ?? 'Start this module and have fun learning!'
                        ];
                    })) }}
                }"
            >
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">📚 Modules</h3>
                </div>

                <!-- 🔍 Search Bar -->
                <div class="mb-6">
                    <input
                        type="text"
                        x-model="search"
                        placeholder="Search modules..."
                        class="input input-bordered w-full md:w-1/2"
                    >
                </div>

                <!-- MODULES GRID -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    <template x-for="module in modules" :key="module.id">
                        <div
                            class="bg-white rounded-2xl shadow-lg p-5 hover:shadow-2xl transition-all duration-300 border border-gray-200 animate-fade-slide"
                            x-show="module.name.toLowerCase().includes(search.toLowerCase()) || module.classroom.toLowerCase().includes(search.toLowerCase()) || search === ''"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 transform translate-y-6"
                            x-transition:enter-end="opacity-100 transform translate-y-0"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform translate-y-0"
                            x-transition:leave-end="opacity-0 transform translate-y-6"
                        >
                            <div class="flex items-center gap-3 mb-3">
                                <div>
                                    <h4 class="font-bold text-lg text-gray-800" x-text="module.name"></h4>
                                    <p class="text-gray-500 text-xs truncate" x-text="module.classroom"></p>
                                </div>
                            </div>

                            <p class="text-gray-600 text-sm mb-4 line-clamp-2" x-text="module.short_intro"></p>

                            <a :href="`/classroommodule/${module.id}`"
                            class="btn w-full rounded-xl bg-gradient-to-r from-red-700 to-red-500 text-white hover:opacity-90 transition">
                            View Module
                            </a>
                        </div>
                    </template>
                </div>
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
