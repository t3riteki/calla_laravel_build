<x-layout>
    <x-slot:title>Register - CALLA</x-slot:title>

    <!-- NAVBAR -->
    <x-navbar class="navbar sticky bg-base-100"></x-navbar>

    <!-- REGISTRATION SECTION -->
    <section
        class="flex flex-col lg:flex-row lg:h-[calc(100vh-64px)] lg:overflow-hidden overflow-auto">

        <!-- LEFT SIDE: Branding / Visual -->
        <div
            class="w-full lg:w-1/2 bg-red-900 text-white flex flex-col justify-center items-center px-10 py-12">
            <h1 class="text-4xl lg:text-5xl font-extrabold mb-4 text-center">
                Welcome to <span class="text-yellow-300">CALLA</span>
            </h1>
            <p class="text-base lg:text-lg text-gray-200 text-center max-w-md">
                Unlock your potential by learning new languages with our adaptive and interactive platform.
            </p>
            <img src="{{ asset('images/logo.png') }}"
                 alt="Language Learning"
                 class="mt-8 w-56 lg:w-80 object-contain">
        </div>

        <!-- RIGHT SIDE: Register Form -->
        <div
            class="w-full lg:w-1/2 flex items-center justify-center bg-gray-50 p-6">
            <form action="{{ route('register') }}" method="POST"
                  class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-sm sm:max-w-md scale-95">
                @csrf
                <h2 class="text-2xl lg:text-3xl font-bold text-center text-red-900 mb-6">
                    Create Your Account
                </h2>

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Enter your name"
                        required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-700 focus:outline-none">
                    @error('name')
                        <p class="text-red-700 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="you@example.com"
                        required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-700 focus:outline-none">
                    @error('email')
                        <p class="text-red-700 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="••••••••"
                        required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-700 focus:outline-none">
                    @error('password')
                        <p class="text-red-700 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-5">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Confirm Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="••••••••"
                        required
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-700 focus:outline-none">
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-red-900 text-white font-bold py-2.5 rounded-lg hover:bg-red-800 transition-transform duration-300 hover:scale-105 shadow-md">
                    Sign Up
                </button>

                <!-- Divider -->
                <div class="flex items-center my-4">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <span class="mx-2 text-gray-500 text-sm">or</span>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                <!-- Social Signup Buttons -->
                <div class="space-y-2">
                    <a href="{{ url('/auth/google') }}"
                       class="w-full flex items-center justify-center gap-2 border border-gray-300 py-2 rounded-lg hover:bg-gray-100 transition">
                        <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="w-5 h-5">
                        <span class="font-medium text-gray-700 text-sm">Sign up with Google</span>
                    </a>

                    <a href="{{ url('/auth/facebook') }}"
                       class="w-full flex items-center justify-center gap-2 border border-gray-300 py-2 rounded-lg hover:bg-gray-100 transition">
                        <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" alt="Facebook" class="w-5 h-5">
                        <span class="font-medium text-gray-700 text-sm">Sign up with Facebook</span>
                    </a>
                </div>

                <!-- Login Redirect -->
                <p class="text-center text-sm text-gray-600 mt-4">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-red-800 font-semibold hover:underline">Sign in</a>
                </p>
            </form>
        </div>
    </section>
</x-layout>
