<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<x-layout>
    <x-slot:title>Register - CALLA</x-slot:title>

    <x-navbar class="navbar sticky bg-base-100"></x-navbar>

    <section
        class="flex flex-col lg:flex-row lg:h-[calc(100vh-64px)] overflow-hidden"
        x-data="registerForm()">

        <!-- LEFT SIDE -->
        <div class="w-full lg:w-1/2 bg-red-900 text-white flex flex-col justify-center items-center px-10 py-12">
            <h1 class="text-4xl lg:text-5xl font-extrabold mb-4 text-center">
                Welcome to <span class="text-yellow-300">CALLA</span>
            </h1>
            <p class="text-base lg:text-lg text-gray-200 text-center max-w-md">
                Unlock your potential by learning or teaching new languages on our adaptive platform.
            </p>
            <img src="{{ asset('images/logo.png') }}" alt="Language Learning" class="mt-8 w-56 lg:w-80 object-contain">
        </div>

        <!-- RIGHT SIDE -->
        <div
            class="relative w-full lg:w-1/2 flex items-center justify-center bg-gray-50 p-6 overflow-hidden"
        >

            <div
                class="bg-white rounded-2xl shadow-xl p-8 relative
                        w-[90%] sm:w-[400px] md:w-[450px] lg:w-[500px]
                        h-[500px] sm:h-[500px] md:h-[550px]"
                >

                <!-- ROLE SELECTION -->
                @unless (old('role'))
                <div
                    x-show="step === 'choose'"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 translate-x-10"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 -translate-x-10"
                    x-cloak
                    class="absolute inset-0 flex flex-col justify-center items-center bg-white rounded-2xl -translate-y-6"
                >
                    <h2 class="text-2xl font-bold text-center text-red-900 pb-10">Choose your role</h2>
                    <p class="text-center text-gray-600 pb-5">Select whether you want to learn or teach.</p>

                    <div class="flex flex-col items-center space-y-4 w-full">
                        <button
                            @click="selectRole('learner')"
                            class="w-[80%] sm:w-[70%] md:w-[60%] bg-red-50 border border-red-200
                                text-red-900 font-semibold py-3 rounded-lg
                                hover:bg-red-100 transition flex items-center justify-center gap-2">
                            <span>I’m a Learner</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5l7 7-7 7"/></svg>
                        </button>

                        <button
                            @click="selectRole('instructor')"
                            class="w-[80%] sm:w-[70%] md:w-[60%] bg-red-50 border border-red-200
                                text-red-900 font-semibold py-3 rounded-lg
                                hover:bg-red-100 transition flex items-center justify-center gap-2">
                            <span>I’m an Instructor</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>
                @endunless
                <!-- REGISTRATION FORM -->
                <form
                    x-show="step === 'form'"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 -translate-x-10"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 translate-x-10"
                    x-cloak

                    action="/register"
                    method="POST"

                    class="absolute inset-0 flex flex-col justify-center bg-white rounded-2xl p-8"
                >
                    @csrf
                    <button type="button"
                         @click="goBack()"
                        class="text-sm text-gray-600 hover:text-red-800 mb-2 flex items-center gap-1 transition-transform duration-300 hover:translate-x-[-4px]">
                        ← Back
                    </button>

                    <h2 class="text-2xl font-bold text-center text-red-900 mb-4">
                        Register as <span class="capitalize" x-text="role"></span>
                    </h2>

                    <input type="hidden" name="role" :value="role">

                    <div class="mb-3">
                        <label class="block text-sm font-semibold mb-1" >Username</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Username"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-700 focus:outline-none">
                    </div>

                    <div class="mb-3">
                        <label class="block text-sm font-semibold mb-1">Email</label>
                        <input type="email" name="email" value ="{{ old('email') }}"required placeholder="Email"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-700 focus:outline-none">
                    </div>

                    <div class="form-control mb-3">
                        <label class="block text-sm font-semibold mb-1">
                            <span class="label-text font-semibold">Password</span>
                        </label>

                        <input
                            type="password"
                            name="password"
                            required
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}"
                            placeholder="Password"
                            class="input w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-700 focus:outline-none
                                @error('password') input-error @enderror"
                        >
                            <p class="label text-xs px-0.5">
                            Must be more than 8 characters, including
                            <br/>At least one number
                            <br/>At least one lowercase letter
                            <br/>At least one uppercase letter
                            </p>
                    </div>

                    <div class="form-control mb-5">
                        <label class="label">
                            <span class="label-text font-semibold">Confirm Password</span>
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="Confirm password"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-700 focus:outline-none
                                @error('password_confirmation') input-error @enderror"
                        >

                        @error('password_confirmation')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-red-900 text-white font-bold py-2.5 rounded-lg hover:bg-red-800 transition-transform duration-300 hover:scale-105 shadow-md">
                        Sign Up
                    </button>

                    <p class="text-center text-sm text-gray-600 mt-4">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-red-800 font-semibold hover:underline">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </section>
    <script>
        function registerForm() {
            return {
                role: '{{ old('role') ?? '' }}',
                step: '{{ old('role') ? 'form' : 'choose' }}',
                selectRole(selectedRole) {
                    this.role = selectedRole;
                    this.step = 'form';
                },
                goBack() {
                    this.step = 'choose';
                }
            }
        }
    </script>
</x-layout>
