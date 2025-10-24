<x-layout>
    <x-slot:title>Welcome</x-slot:title>
    <x-navbar class="navbar"></x-navbar>

    @if (session('success'))
        <x-toast :message="session('success')" />
    @endif

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- WRAPPER: make footer stick at bottom -->
    <div class="flex flex-col min-h-screen">

        <!-- MAIN CONTENT -->
        <main class="flex flex-col lg:flex-row items-center justify-center flex-grow
                    min-h-[95vh] px-6 md:px-12 lg:px-20 gap-10">

            <!-- LEFT: Text section -->
            <div class="w-full lg:w-5/12 text-center lg:text-left flex flex-col pr-10">
                <h1 class="text-3xl sm:text-4xl md:text-4xl font-bold mb-6">
                    Welcome to CALLA — the Content Adaptive Language Learning App!
                </h1>
                <p class="mb-6 leading-relaxed text-base sm:text-lg md:text-xl pr-0 lg:pr-15">
                    At CALLA, we believe that learning a new language should be exciting, meaningful, and tailored just for you.
                    Whether you’re a young learner exploring your first words or an adult eager to master a new language, CALLA adapts
                    to your pace, interests, and goals. Through interactive lessons, fun activities, and engaging content, you’ll build
                    confidence and fluency in the language of your choice. Start your journey with CALLA today — where every word learned
                    brings you closer to new cultures, connections, and opportunities!
                </p>

                <!-- BUTTON (desktop only) -->
                <div class="hidden lg:block mt-4">
                    <button class="btn btn-primary btn-sm sm:btn-md mt-[1rem] translate-y-[10px]">
                        Get Started
                    </button>
                </div>
            </div>

            <!-- RIGHT: Image Carousel -->
            <div class="w-full lg:w-7/12 flex flex-col items-center">

                <!-- CAROUSEL -->
                <div
                    x-data="{
                        active: 0,
                        slides: [
                            '{{ asset('images/L1.png') }}',
                            '{{ asset('images/L2.png') }}',
                            '{{ asset('images/L3.png') }}'
                        ],
                        interval: null,
                        start() {
                            this.interval = setInterval(() => {
                                this.active = (this.active + 1) % this.slides.length;
                            }, 3000);
                        },
                        stop() {
                            clearInterval(this.interval);
                            this.interval = null;
                        }
                    }"
                    x-init="start()"
                    class="relative w-full max-w-none lg:max-w-[1000px] lg:max-h-[600px]
                           overflow-hidden rounded-2xl shadow-lg"
                    @mouseenter="stop()"
                    @mouseleave="start()"
                >
                    <!-- IMAGES -->
                    <template x-for="(slide, index) in slides" :key="index">
                        <img
                            x-show="active === index"
                            x-transition:enter="transition-opacity duration-700"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            :src="slide"
                            class="w-full h-[300px] sm:h-[400px] md:h-[500px] lg:h-[600px]
                                   object-cover object-center rounded-2xl transition-all duration-300"
                            alt="Language Learning Image"
                        >
                    </template>

                    <!-- LEFT ARROW -->
                    <button
                        @click="active = (active - 1 + slides.length) % slides.length"
                        class="absolute left-2 top-1/2 -translate-y-1/2
                               bg-transparent text-red-900 hover:text-red-900 rounded-full p-2"
                    >
                        &#10094;
                    </button>

                    <!-- RIGHT ARROW -->
                    <button
                        @click="active = (active + 1) % slides.length"
                        class="absolute right-2 top-1/2 -translate-y-1/2
                               bg-transparent text-red-900 hover:text-red-900 rounded-full p-2"
                    >
                        &#10095;
                    </button>

                    <!-- DOTS -->
                    <div class="absolute bottom-3 w-full flex justify-center space-x-2">
                        <template x-for="(slide, index) in slides" :key="index">
                            <div
                                @click="active = index"
                                :class="{
                                    'w-3 h-3 rounded-full cursor-pointer transition-all': true,
                                    'bg-white': active === index,
                                    'bg-gray-400': active !== index
                                }"
                            ></div>
                        </template>
                    </div>
                </div>

                <!-- BUTTON (mobile only) -->
                <div class="block lg:hidden mt-4">
                    <button class="btn btn-primary btn-sm sm:btn-md">Get Started</button>
                </div>
            </div>

        </main>

        <!-- FEATURES SECTION -->
        <section id="features" class="min-h-[90vh] bg-gray-100 py-20 px-6 md:px-20 lg:px-25">
            <div class="max-w-6xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-red-900 mb-6">Features</h2>
                <p class="text-lg text-gray-700 mb-12">
                    Discover how CALLA makes language learning fun, adaptive, and effective for all ages!
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                    <div class="bg-white shadow-lg rounded-2xl p-6">
                        <h3 class="text-xl font-semibold text-red-900 mb-2">Adaptive Learning</h3>
                        <p class="text-gray-600">CALLA customizes lessons based on your pace and skill level.</p>
                    </div>
                    <div class="bg-white shadow-lg rounded-2xl p-6">
                        <h3 class="text-xl font-semibold text-red-900 mb-2">Interactive Lessons</h3>
                        <p class="text-gray-600">Engage with games, quizzes, and activities designed for fun learning.</p>
                    </div>
                    <div class="bg-white shadow-lg rounded-2xl p-6">
                        <h3 class="text-xl font-semibold text-red-900 mb-2">Progress Tracking</h3>
                        <p class="text-gray-600">Monitor your improvement with visual insights and milestones.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="bg-red-900 text-gray-300 py-6 w-full">
            <div class="container mx-auto px-6 flex justify-between items-center">
                <h2 class="text-sm">&copy; CallaLearnCorp@gmail.com</h2>
                <p class="text-sm">&copy; 2025 CALLA. All rights reserved.</p>
            </div>
        </footer>

    </div>
</x-layout>
