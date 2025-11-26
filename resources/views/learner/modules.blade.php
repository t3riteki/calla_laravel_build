<x-layout>
    <x-slot:title>Learner Modules - CALLA</x-slot:title>

    <div class="flex min-h-screen bg-gray-50 transition-all duration-300">

        <!-- SIDEBAR -->
        <x-sidebar />

        <main class="flex-1 p-6 lg:ml-64 md:ml-56 sm:ml-0 overflow-y-auto transition-all duration-300">

            <!-- 📚 Modules -->
            <section class="mb-10">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">📚 Modules</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    @foreach ($modules as $module)
                        <div class="bg-white rounded-2xl shadow-lg p-5 hover:shadow-2xl transition-all duration-300 border border-gray-200 animate-fade-slide">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-3xl animate-bounce">
                                    {{ $module->emoji ?? '📝' }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg text-gray-800">{{ $module->name }}</h4>
                                    <p class="text-gray-500 text-xs truncate">{{ $module->description }}</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $module->short_intro ?? 'Start this module and have fun learning!' }}
                            </p>
                            <a href="{{ route('modules.show', $module->id) }}"
                               class="btn w-full rounded-xl bg-gradient-to-r from-red-700 to-red-500 text-white hover:opacity-90 transition">
                                Start Module
                            </a>
                        </div>
                    @endforeach
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
