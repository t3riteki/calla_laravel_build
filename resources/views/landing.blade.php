<x-layout class="px-6">
    <x-slot:title>Welcome</x-slot:title>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- WRAPPER: make footer stick at bottom -->
    <div class="flex flex-col min-h-screen">

        <!-- MAIN CONTENT -->
        <main
            id="about"
            class="flex flex-col lg:flex-row items-center justify-center flex-grow
                    min-h-[100vh] px-6 md:px-12 lg:px-20 gap-10
                    bg-gradient-to-r from-red-100 via-white to-red-200">


            <!-- LEFT: Text section -->
            <div class="w-full lg:w-5/12 text-center lg:text-left flex flex-col pr-10 mt-15 sm:mt-0">
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
                    <button class="btn btn-primary btn-sm sm:btn-md mt-[1rem] translate-y-[10px] hover:scale-105">
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
                    <button class="btn btn-primary btn-sm sm:btn-md hover:scale-105">Get Started</button>
                </div>
            </div>

        </main>

        <!-- FEATURES SECTION -->
        <section
            id="features"
            class="min-h-[100vh] bg-gray-100 py-40 px-6 md:px-20 lg:px-25 bg-cover bg-center bg-no-repeat"
            style="background-image: url('{{ asset('images/USeP_eagle.jpg') }}');"
        >
            <div class="max-w-6xl mx-auto text-center bg-white/70 backdrop-blur-sm rounded-2xl p-10">
                <h2 class="text-3xl font-bold text-red-900 mb-6">Features</h2>
                <p class="text-lg text-black mb-12">
                    Discover how CALLA makes language learning fun, adaptive, and effective for all ages!
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                    <div class="bg-white shadow-lg rounded-2xl p-6">
                        <h3 class="text-xl font-semibold text-red-900 mb-2">Adaptive Learning</h3>
                        <p class="text-gray-600">CALLA customizes lessons based on your pace, interests, and skill level. Using intelligent adaptation, the app identifies your strengths and areas for improvement, ensuring that every activity challenges you just enough to keep learning fun and effective. Whether you’re just starting out or advancing your fluency, CALLA evolves with you — making every learning experience unique, personal, and rewarding.</p>
                    </div>
                    <div class="bg-white shadow-lg rounded-2xl p-6">
                        <h3 class="text-xl font-semibold text-red-900 mb-2">Interactive Lessons</h3>
                        <p class="text-gray-600">Engage with games, quizzes, and activities designed for fun, interactive learning. CALLA turns every lesson into an exciting adventure — helping you practice speaking, listening, reading, and writing while having a great time. Earn points, unlock achievements, and challenge yourself through creative exercises that make learning feel more like play. With CALLA, you don’t just study a language — you live it!</p>
                    </div>
                    <div class="bg-white shadow-lg rounded-2xl p-6">
                        <h3 class="text-xl font-semibold text-red-900 mb-2">Progress Tracking</h3>
                        <p class="text-gray-600">Monitor your improvement with visual insights and milestones that celebrate every step of your language journey. CALLA provides detailed progress reports, interactive charts, and personalized feedback to help you see how far you’ve come and where you can grow next. From daily streaks to achievement badges, every milestone keeps you motivated and inspired to reach your goals. With CALLA, your progress isn’t just measured — it’s celebrated!</p>
                    </div>
                </div>
            </div>
        </section>


        <!-- CONTACT SECTION -->
        <section
            id="contact"
            class="min-h-[95vh] bg-red-900 py-20 px-6 md:px-20 lg:px-25 flex flex-col lg:flex-row items-center justify-center gap-12"
        >
            <!-- LEFT SIDE: Contact Info Grid -->
            <div class="w-full lg:w-1/2 text-white flex flex-col items-center">
                <h2 class="text-3xl font-bold text-center mb-10">Get In Touch With Us Now!</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 w-full max-w-2xl">
                    <!-- Phone -->
                    <div class="bg-white text-black rounded-2xl p-8 shadow-lg text-center hover:scale-105 transition-transform duration-300">
                        <div class="flex flex-col items-center">
                            <i class="fa-solid fa-phone text-4xl text-red-900 mb-4"></i>
                            <h3 class="font-bold text-xl mb-2">Phone Number</h3>
                            <a href="tel:+639123456789" class="text-red-700 hover:underline">+63 912 345 6789 (Mobile)</a>
                            <a href="tel:+63822223344" class="text-red-700 hover:underline">+63 (82) 222-3344 (Landline)</a>
                            <a href="tel:+639876543210" class="text-red-700 hover:underline">Hotline: +63 987 654 3210</a>
                            <p class="text-gray-700 mt-2 text-sm">Available for calls and SMS during business hours</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="bg-white text-black rounded-2xl p-8 shadow-lg text-center hover:scale-105 transition-transform duration-300">
                        <div class="flex flex-col items-center">
                            <i class="fa-solid fa-envelope text-4xl text-red-900 mb-4"></i>
                            <h3 class="font-bold text-xl mb-3">Email</h3>
                            <a href="mailto:CallaLearnCorp@gmail.com" class="text-red-700 hover:underline">CallaLearnCorp@gmail.com</a>
                            <a href="mailto:support@calla.com" class="text-red-700 hover:underline">support@calla.com</a>
                            <a href="mailto:info@calla.com" class="text-red-700 hover:underline">info@calla.com</a>
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="bg-white text-black rounded-2xl p-8 shadow-lg text-center hover:scale-105 transition-transform duration-300">
                        <div class="flex flex-col items-center">
                            <i class="fa-solid fa-location-dot text-4xl text-red-900 mb-4"></i>
                            <h3 class="font-bold text-xl mb-2">Location</h3>
                             <a
                                href="https://www.google.com/maps/place/University+of+Southeastern+Philippines/@7.0862388,125.6130513,17z/data=!3m1!4b1!4m6!3m5!1s0x32f96daf5b8f0ce5:0x5643261c936b7994!8m2!3d7.0862335!4d125.6156262!16s%2Fm%2F09gddn2?entry=ttu&g_ep=EgoyMDI1MTAyMi4wIKXMDSoASAFQAw%3D%3D"
                                target="_blank"
                                class="text-red-700 hover:underline text-base">
                                University of Southeastern Philippines, Iñigo St., Obrero, Davao City, 8000 Davao del Sur, Philippines
                            </a>
                        </div>
                    </div>

                    <!-- Working Hours -->
                    <div class="bg-white text-black rounded-2xl p-8 shadow-lg text-center hover:scale-105 transition-transform duration-300">
                        <div class="flex flex-col items-center">
                            <i class="fa-solid fa-clock text-4xl text-red-900 mb-4"></i>
                            <h3 class="font-bold text-xl mb-2">Working Hours</h3>
                            <p class="text-gray-700">Monday – Saturday</p>
                            <p class="text-gray-700">09:00 AM – 06:00 PM (PHT)</p>
                            <p class="text-gray-700">Closed on Sundays and Public Holidays</p>
                            <p class="text-gray-700 mt-2 text-sm">Online support available 24/7 via email</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE: Contact Form -->
            <div class="w-full lg:w-1/2 bg-white rounded-2xl p-10 shadow-xl text-black">
                <form class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2" for="name">Name</label>
                        <input
                            type="text"
                            id="name"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
                            placeholder="Your Name"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
                            placeholder="you@example.com"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2" for="message">Message</label>
                        <textarea
                            id="message"
                            rows="5"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-600"
                            placeholder="Your message..."
                        ></textarea>
                    </div>

                    <button
                        type="submit"
                        class="bg-red-700 text-white text-lg font-bold px-6 py-3 rounded-lg transition transform duration-300 hover:bg-red-800 hover:scale-105 hover:shadow-lg"
                    >
                        Send Message
                    </button>
                </form>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="bg-white text-red-900 py-5 w-full">
            <div class="container mx-auto px-6 flex justify-between items-center">
                <h2 class="text-sm"></h2>
                <p class="text-sm">&copy; 2025 CALLA. All rights reserved.</p>
            </div>
        </footer>

        <!-- BACK TO TOP ARROW -->
        <button id="backToTop"
                class="fixed bottom-8 right-8 bg-red-900 text-white p-4 rounded-full shadow-lg hidden hover:bg-red-400 transition transform duration-300 hover:scale-110 z-50">
            ↑
        </button>

        <script>
            const backToTopButton = document.getElementById('backToTop');

            // Show button when scrolled down
            window.addEventListener('scroll', () => {
                if (window.scrollY > window.innerHeight) { // after first screen
                    backToTopButton.classList.remove('hidden');
                } else {
                    backToTopButton.classList.add('hidden');
                }
            });

            // Scroll smoothly to top on click
            backToTopButton.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        </script>

    </div>
</x-layout>
