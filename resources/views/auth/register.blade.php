<x-layout>
    <x-slot:title>Welcome</x-slot:title>
    <x-navbar class="navbar"></x-navbar>

    <main class="flex-1 container mx-auto px-4">
        <div class="hero min-h-[calc(100vh-4rem)]">
            <div class="hero-content flex-col">
                <div class="card w-96 bg-base-100">

                    <div class="card-body">
                        <div class="card-title text-center flex">
                            <div class="flex text-25 items-center">LOGIN</div>
                        </div>

                        <form action="/register" method="POST">
                            @csrf

                                <label class="floating-label mb-6">
                                    <input
                                    type="email"
                                    name="email"
                                    placeholder="Email"
                                    value="{{ old('email') }}"
                                    class="input input-bordered @error('password') input-error @enderror"
                                    required
                                    autocomplete="username">
                                    <span>Email</span>
                                </label>
                                @error('email')
                                    <div class="label -mt-4 mb-2">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </div>
                                @enderror

                                <label class="floating-label mb-6">
                                    <input
                                    type="password"
                                    name="password"
                                    placeholder="Password"
                                    class="input input-bordered @error('password') input-error @enderror"
                                    required>
                                    <span>Password</span>
                                </label>

                                @error('password')
                                    <div class="label -mt-4 mb-2">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </div>
                                @enderror

                            <!-- Remember Me -->
                            <div class="form-control flex justify-between mt-4">
                                <label class="label cursor-pointer justify-start">
                                    <input type="checkbox"
                                        name="remember"
                                        class="checkbox">
                                    <span class="text-xs">Remember me</span>
                                </label>
                                <div><a href="/login" class="link link text-5 items-center">Already have an account?</a></div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-control mt-8">
                                <button type="submit" class="btn btn-primary btn-sm w-full">
                                    Sign In
                                </button>
                            </div>

                            <div class="divider">or sign in with</div>
                            <div class="flex flex-col gap-5">
                                <a href="{{ url('auth/google') }}" class="flex link link-hover items-center justify-center">
                                    <img class="h-8" src="{{ asset('images/google-icon.png') }}" alt="Login with Google">
                                    <span class="flex">Google</span>
                                </a>
                                <a href="{{ url('auth/facebook') }}" class="flex link link-hover items-center justify-center">
                                    <img class="h-5" src="{{ asset('images/facebook-icon.png') }}" alt="Login with Facebook">
                                    <span>Facebook</span>
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
