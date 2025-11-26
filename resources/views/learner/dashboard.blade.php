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
                                Welcome Back, Learner! 🎓
                                <span class="emoji-container inline-block relative w-10 h-10 ml-2"></span>
                            </h2>
                            <p class="py-4 text-sm sm:text-base opacity-80">
                                Here’s your learning progress and classrooms at a glance. Keep exploring and have fun!
                            </p>
                        </div>

                        <div class="flex gap-4">
                            <div class="stat bg-white/20 text-white backdrop-blur-md p-4 rounded-2xl shadow-md w-32 text-center animate-fade-slide delay-100">
                                <div class="text-gray-200 font-semibold">Classes</div>
                                <div class="text-2xl font-bold">{{ $data['classroom_count'] ?? 3 }}</div>
                            </div>
                            <div class="stat bg-white/20 text-white backdrop-blur-md p-4 rounded-2xl shadow-md w-32 text-center animate-fade-slide delay-200">
                                <div class="text-gray-200 font-semibold">Modules</div>
                                <div class="text-2xl font-bold">{{ $data['module_count'] ?? 5 }}</div>
                            </div>
                            <div class="stat bg-white/20 text-white backdrop-blur-md p-4 rounded-2xl shadow-md w-32 text-center animate-fade-slide delay-300">
                                <div class="text-gray-200 font-semibold">Completed</div>
                                <div class="text-2xl font-bold">{{ $data['completed_count'] ?? 2 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 🏫 My Classrooms -->
            <section class="mb-10">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">🏫 My Classrooms</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    <!-- Classroom Cards -->
                    <div class="bg-white rounded-2xl shadow-lg p-5 hover:shadow-2xl transition-all duration-300 border border-gray-200 animate-fade-slide delay-100">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-3xl animate-bounce">
                                📘
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-800">Math 101</h4>
                                <p class="text-gray-500 text-xs">Start your journey into numbers!</p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Learn addition, subtraction, and more with fun exercises!</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-gray-700 font-semibold">👥 25 classmates</span>
                        </div>
                        <button class="btn w-full rounded-xl bg-gradient-to-r from-red-700 to-red-500 text-white hover:opacity-90 transition">
                            View Classroom
                        </button>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-5 hover:shadow-2xl transition-all duration-300 border border-gray-200 animate-fade-slide delay-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-3xl animate-bounce">
                                🔬
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-800">Science 202</h4>
                                <p class="text-gray-500 text-xs">Discover and experiment!</p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Exciting experiments await you in physics and chemistry!</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-gray-700 font-semibold">👥 30 classmates</span>
                        </div>
                        <button class="btn w-full rounded-xl bg-gradient-to-r from-red-700 to-red-500 text-white hover:opacity-90 transition">
                            View Classroom
                        </button>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-5 hover:shadow-2xl transition-all duration-300 border border-gray-200 animate-fade-slide delay-300">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-3xl animate-bounce">
                                📖
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-800">English Lit</h4>
                                <p class="text-gray-500 text-xs">Stories, poems, and fun reading!</p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Explore stories that spark your imagination!</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-gray-700 font-semibold">👥 28 classmates</span>
                        </div>
                        <button class="btn w-full rounded-xl bg-gradient-to-r from-red-700 to-red-500 text-white hover:opacity-90 transition">
                            View Classroom
                        </button>
                    </div>
                </div>
            </section>

            <!-- 📚 My Modules -->
            <section class="mb-10">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">📚 My Modules</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                    <!-- Module Cards -->
                    <div class="bg-white rounded-2xl shadow-lg p-5 hover:shadow-2xl transition-all duration-300 border border-gray-200 animate-fade-slide delay-100">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-3xl animate-bounce">
                                📝
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-800">Algebra Basics</h4>
                                <p class="text-gray-500 text-xs">Learn equations and problem-solving!</p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Interactive lessons and quizzes to master algebra.</p>
                        <button class="btn w-full rounded-xl bg-gradient-to-r from-red-700 to-red-500 text-white hover:opacity-90 transition">
                            Start Module
                        </button>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-5 hover:shadow-2xl transition-all duration-300 border border-gray-200 animate-fade-slide delay-200">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-3xl animate-bounce">
                                📊
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-800">Statistics 101</h4>
                                <p class="text-gray-500 text-xs">Graphs, charts, and numbers!</p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">Fun exercises to understand data and trends.</p>
                        <button class="btn w-full rounded-xl bg-gradient-to-r from-red-700 to-red-500 text-white hover:opacity-90 transition">
                            Start Module
                        </button>
                    </div>
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
            rgba(248, 113, 113, 0.2) 0%,  /* red-400 translucent */
            rgba(251, 191, 36, 0.3) 50%,   /* yellow-ish sparkle for fun */
            rgba(248, 113, 113, 0.2) 100%
        );
        background-size: 200% 100%;
        animation: highlightSweep 1.5s ease forwards;
        border-radius: inherit; /* match the hero rounding */
        }

        @keyframes sparkle {
            0% { opacity: 0; transform: scale(0.5) translate(0,0); }
            50% { opacity: 1; transform: scale(1.2) translate(-2px, -2px); }
            100% { opacity: 0; transform: scale(0.5) translate(0,0); }
        }

        ..emoji-container {
            position: relative;
            width: 2.5rem; /* matches approx emoji size */
            height: 2.5rem;
            display: inline-block;
        }

        .sparkle {
            position: absolute;
            width: 6px; height: 6px;
            background: #f87171; /* red-400 */
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
                for(let i=0; i<5; i++) { // 5 sparkles per emoji
                    const sparkle = document.createElement('div');
                    sparkle.classList.add('sparkle');
                    sparkle.style.top = `${Math.random() * 80}%`;
                    sparkle.style.left = `${Math.random() * 80}%`;
                    sparkle.style.animationDelay = `${Math.random() * 2}s`; // random delay
                    sparkle.style.animationDuration = `${0.8 + Math.random()}s`; // random duration
                    container.appendChild(sparkle);
                }
            });
        });
    </script>
</x-layout>
