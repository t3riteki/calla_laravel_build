<nav class="navbar sticky bg-base-100">
        <div class="navbar-start">
            <a href="#about" class="hover:text-red-800 text-xl pl-10 transition-colors duration-300">About</a>
            <a href="#features" class="hover:text-red-800 text-xl pl-15 transition-colors duration-300">Features</a>
            <a href="#contact" class="hover:text-red-800 text-xl pl-15 transition-colors duration-300">Contact</a>

        </div>

        <div class="navbar-end gap-2">
        @auth
            <span class="text-sm">{{auth()->user()->name}}</span>
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
