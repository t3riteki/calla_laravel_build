<x-layout>
    <x-slot:title>Login - CALLA</x-slot:title>

    <main class="flex-1 bg-red-900 w-full flex items-center justify-center min-h-[calc(100vh-64px)]">
        <div class="hero w-full">
            <div class="hero-content flex-col text-center">
                <div class="card w-96 bg-white shadow-2xl rounded-2xl">

                    <div class="card-body">
                        <div class="card-title text-center mb-4">
                            <img src="{{ asset('images/logo.png') }}"
                            alt="Logo"
                            class="w-16 h-auto ">
                            <h2 class="text-2xl font-bold text-red-900">LOGIN</h2>
                        </div>

                        <form action="/login" method="POST">
                            @csrf

                            <!-- Email -->
                            <label class="floating-label mb-6">
                                <input
                                    type="email"
                                    name="email"
                                    placeholder="Email"
                                    value="{{ old('email') }}"
                                    class="input input-bordered w-full @error('email') input-error @enderror"
                                    required
                                    autocomplete="username">
                                <span>Email</span>
                            </label>
                            @error('email')
                                <div class="label -mt-4 mb-2">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </div>
                            @enderror

                            <!-- Password -->
                            <label class="floating-label">
                                <input
                                    type="password"
                                    name="password"
                                    placeholder="Password"
                                    class="input input-bordered w-full @error('password') input-error @enderror"
                                    required>
                                <span>Password</span>
                            </label>
                            @error('password')
                                <div class="label -mt-4 mb-2">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </div>
                            @enderror

                            <!-- Forgot Password -->
                            <div class="text-right mb-6">
                                <a href="" class="text-xs text-red-800 font-semibold hover:underline">
                                    Forgot password?
                                </a>
                            </div>

                            <!-- Remember Me + Register Link -->
                            <div class="form-control flex justify-between mt-4">
                                <label class="label cursor-pointer justify-start gap-2">
                                    <input type="checkbox" name="remember" class="checkbox checkbox-sm">
                                    <span class="text-xs text-gray-700">Remember me</span>
                                </label>
                                <div>
                                    <a href="/register" class="text-xs text-red-800 font-semibold hover:underline">
                                        Don't have an account?
                                    </a>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-control mt-8">
                                <button type="submit" class="btn bg-red-900 text-white font-semibold hover:bg-red-800 btn-sm w-full">
                                    Sign In
                                </button>
                            </div>

                            <!-- Divider -->
                            <div class="divider text-gray-400 text-sm">or sign in with</div>

                            <!-- Social Buttons -->
                            <div class="flex flex-row gap-5 justify-center">
                                <a href="{{ url('auth/google') }}" class="flex link link-hover items-center justify-center">
                                    <img class="h-11 rounded-lg" src="{{ asset('images/google-icon.png') }}" alt="Login with Google">
                                </a>
                                <a href="{{ url('auth/facebook') }}" class="flex link link-hover items-center justify-center">
                                    <img class="h-8 rounded-lg" src="{{ asset('images/facebook-icon.png') }}" alt="Login with Facebook">
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>

@push('scripts')
  <script src="{{ asset('js/login.js') }}"></script>
@endpush
