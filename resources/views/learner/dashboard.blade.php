<x-layout>
    <x-slot:title>Learner Dashboard - CALLA</x-slot:title>

    <div class="flex min-h-screen bg-gray-50 transition-all duration-300">

        <!-- SIDEBAR -->
        <x-sidebar />

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-6 lg:ml-64 md:ml-56 sm:ml-0 overflow-y-auto transition-all duration-300">

            <!-- 🎉 Welcome Banner -->
            <section class="mb-10 animate-fade-slide">
                <div class="hero rounded-2xl bg-gradient-to-r from-red-900 via-red-700 to-red-600 text-white p-6 sm:p-8 md:p-10 shadow-lg animate-highlight-sweep">
                    <div class="hero-content flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 lg:gap-16 w-full">
                        <div>
                            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold animate-bounce relative">
                                Welcome Back, {{ Auth::user()->name ?? 'Learner' }}! 🎓
                                <span class="emoji-container inline-block relative w-10 h-10 ml-2"></span>
                            </h2>
                            <p class="py-4 text-sm sm:text-base opacity-80">
                                Here's your learning progress and classrooms at a glance. Keep exploring and have fun!
                            </p>
                        </div>

                        <div class="flex gap-4">
                            <div class="stat bg-white/20 text-white backdrop-blur-md p-4 rounded-2xl shadow-md w-32 text-center animate-fade-slide delay-100">
                                <div class="text-gray-200 font-semibold">Classes</div>
                                <div class="text-2xl font-bold">
                                    {{ count($data['joinedClassrooms'] ?? []) }}
                                </div>
                            </div>

                            <div class="stat bg-white/20 text-white backdrop-blur-md p-4 rounded-2xl shadow-md w-32 text-center animate-fade-slide delay-200">
                                <div class="text-gray-200 font-semibold">Modules</div>
                                <div class="text-2xl font-bold">
                                    {{ count($data['classroommodules'] ?? []) }}
                                </div>
                            </div>

                            <div class="stat bg-white/20 text-white backdrop-blur-md p-4 rounded-2xl shadow-md w-32 text-center animate-fade-slide delay-300">
                                <div class="text-gray-200 font-semibold">Completed</div>
                                <div class="text-2xl font-bold">
                                    {{ $data['completedCount'] ?? 0 }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- 🏫 My Classrooms -->
            <section class="mb-10">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">🏫 My Classrooms</h3>
                    <a class="btn btn-sm bg-red-800 hover:bg-red-700 text-white w-full sm:w-auto" href="/classrooms">
                        View All
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    @forelse($data['joinedClassrooms'] ?? [] as $classroom)
                        <div class="bg-white rounded-2xl shadow-lg p-5 hover:shadow-2xl transition-all duration-300 border border-gray-200 animate-fade-slide">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-3xl animate-bounce">
                                    {{ $classroom->emoji ?? '📘' }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg text-gray-800">{{ $classroom->name ?? 'Untitled Classroom' }}</h4>
                                    <p class="text-gray-500 text-xs">{{ $classroom->description ?? 'No description' }}</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $classroom->short_intro ?? 'Start learning and have fun!' }}
                            </p>
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-gray-700 font-semibold">
                                    👥 {{ optional($classroom->enrolledUser)->count() ?? 0 }} members
                                </span>
                            </div>
                            <a href="{{ route('classrooms.show', $classroom->id) }}"
                               class="btn w-full rounded-xl bg-gradient-to-r from-red-700 to-red-500 text-white hover:opacity-90 transition">
                                View Classroom
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8 text-gray-500">
                            <p>
                                No classrooms joined yet.
                                <a href="{{ route('classrooms.index') }}" class="text-red-600 font-semibold">Browse classrooms</a>
                            </p>
                        </div>
                    @endforelse
                </div>
            </section>

            <!-- 📚 My Modules -->
            <section class="mb-10">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">📚 My Modules</h3>
                    <a class="btn btn-sm bg-red-800 hover:bg-red-700 text-white w-full sm:w-auto" href="/classroommodule">
                        View All
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    @forelse($data['classroommodules'] ?? [] as $classroommodule)
                        <div class="bg-white rounded-2xl shadow-lg p-5 hover:shadow-2xl transition-all duration-300 border border-gray-200 animate-fade-slide">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-3xl animate-bounce">
                                    {{ optional($classroommodule->module)->emoji ?? '📝' }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg text-gray-800">
                                        {{ optional($classroommodule->module)->name ?? 'Untitled Module' }}
                                    </h4>
                                    <p class="text-gray-500 text-xs">
                                        {{ optional($classroommodule->classroom)->name ?? 'Unknown Classroom' }}
                                    </p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ optional($classroommodule->module)->short_intro ?? 'Start learning and have fun!' }}
                            </p>
                            <a href="{{ route('classroommodule.show', $classroommodule->id) }}"
                               class="btn w-full rounded-xl bg-gradient-to-r from-red-700 to-red-500 text-white hover:opacity-90 transition">
                                Start Module
                            </a>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8 text-gray-500">
                            <p>No modules available yet.</p>
                        </div>
                    @endforelse
                </div>
            </section>

        </main>
    </div>

    <!-- Tailwind Custom Animations -->
    <style>
        @keyframes fadeSlideUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-slide { animation: fadeSlideUp 0.8s ease forwards; }
        .animate-fade-slide.delay-100 { animation-delay: 0.1s; }
        .animate-fade-slide.delay-200 { animation-delay: 0.2s; }
        .animate-fade-slide.delay-300 { animation-delay: 0.3s; }

        @keyframes highlightSweep {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .animate-highlight-sweep {
            position: relative;
            overflow: hidden;
        }

        .animate-highlight-sweep::after {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            background: linear-gradient(
                120deg,
                rgba(248, 113, 113, 0.2) 0%,
                rgba(251, 191, 36, 0.3) 50%,
                rgba(248, 113, 113, 0.2) 100%
            );
            background-size: 200% 100%;
            animation: highlightSweep 1.5s ease forwards;
            border-radius: inherit;
        }

        @keyframes sparkle {
            0% { opacity: 0; transform: scale(0.5) translate(0,0); }
            50% { opacity: 1; transform: scale(1.2) translate(-2px, -2px); }
            100% { opacity: 0; transform: scale(0.5) translate(0,0); }
        }

        .emoji-container {
            position: relative;
            width: 2.5rem;
            height: 2.5rem;
            display: inline-block;
        }

        .sparkle {
            position: absolute;
            width: 6px; height: 6px;
            background: #f87171;
            border-radius: 50%;
            pointer-events: none;
            animation-name: sparkle;
            animation-iteration-count: infinite;
            animation-timing-function: ease-in-out;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.emoji-container').forEach(container => {
                for(let i = 0; i < 5; i++) {
                    const sparkle = document.createElement('div');
                    sparkle.classList.add('sparkle');
                    sparkle.style.top = `${Math.random() * 80}%`;
                    sparkle.style.left = `${Math.random() * 80}%`;
                    sparkle.style.animationDelay = `${Math.random() * 2}s`;
                    sparkle.style.animationDuration = `${0.8 + Math.random()}s`;
                    container.appendChild(sparkle);
                }
            });
        });
    </script>
</x-layout>
