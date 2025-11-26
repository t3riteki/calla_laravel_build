<x-layout>
    <x-slot:title>Learner Dashboard - CALLA</x-slot:title>

    <div class="flex min-h-screen bg-gray-50 transition-all duration-300">

        <!-- SIDEBAR -->
        <x-sidebar />

        <main class="flex-1 p-6 lg:ml-64 md:ml-56 sm:ml-0 overflow-y-auto transition-all duration-300">

            <!-- 🏫 Classrooms -->
            <section class="mb-10">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">🏫 Classrooms</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    <!-- Placeholder Classroom Cards -->
                    @foreach ($classrooms as $classroom)
                        <div class="bg-white rounded-2xl shadow-lg p-5 hover:shadow-2xl transition-all duration-300 border border-gray-200 animate-fade-slide">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-3xl animate-bounce">
                                    {{ $classroom->emoji ?? '📘' }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg text-gray-800">{{ $classroom->name }}</h4>
                                    <p class="text-gray-500 text-xs truncate">{{ $classroom->description }}</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $classroom->short_intro ?? 'Start learning and have fun!' }}
                            </p>
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-gray-700 font-semibold">👥 {{ $classroom->EnrolledUser->where('user.role','learner')->count() ?? 0 }} classmates</span>
                            </div>
                            <a href="{{ route('classrooms.show', $classroom->id) }}"
                               class="btn w-full rounded-xl bg-gradient-to-r from-red-700 to-red-500 text-white hover:opacity-90 transition">
                                View Classroom
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
