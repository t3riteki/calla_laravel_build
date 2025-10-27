<nav class="navbar sticky bg-base-100 px-6">
    <div class="navbar-start">
        @if (request()->is('/') || request()->is('#') || request()->is('home'))
            <a href="#about" class="text-2xl font-bold text-red-900 pl-10 transition-colors duration-300 hover:scale-105">About</a>
            <a href="#features" class="text-2xl font-bold text-red-900 pl-10 transition-colors duration-300 hover:scale-105">Features</a>
            <a href="#contact" class="text-2xl font-bold text-red-900 pl-10 transition-colors duration-300 hover:scale-105">Contact</a>
        @else
            <a href="/" class="text-2xl font-bold text-red-900 pl-10 transition-colors duration-300 hover:scale-105">CALLA</a>
        @endif
    </div>

    <div class="navbar-end gap-2">
        @auth
            <span class="text-sm">{{ auth()->user()->name }}</span>
            <form action="/logout" method="post" class="inline">
                @csrf
                <button type="submit" class="btn btn-ghost btn-sm">Logout</button>
            </form>
        @else
            <a href="/login" class="btn btn-ghost btn-sm">Sign In</a>
            <a href="/register" class="btn btn-primary btn-sm">Sign Up</a>
        @endauth
    </div>
</nav>
