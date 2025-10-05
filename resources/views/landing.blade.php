<x-layout>
    <x-slot:title>Welcome</x-slot:title>
    <x-navbar class="navbar"></x-navbar>

    @if (session('success'))

        <x-toast :message = "session('success')"/>

    @endif

    <main class="flex-1 container mx-auto px-4 py-8">
       <div class="hero hero min-h-[calc(100vh-16rem)]">
            <div class="hero-content text-center">
                <div class="max-w-md">
                <h1 class="text-5xl font-bold">Hello there</h1>
                <p class="py-6">
                    Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                    quasi. In deleniti eaque aut repudiandae et a id nisi.
                </p>
                <button class="btn btn-primary">Get Started</button>
                </div>
            </div>
        </div>
    </main>

</x-layout>
