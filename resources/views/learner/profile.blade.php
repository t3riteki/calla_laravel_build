<x-layout>
    <x-slot:title>My Profile</x-slot:title>

    <main class="min-h-[calc(100vh-64px)] bg-gradient-to-br from-red-50 via-white to-red-100 pt-15">
        <x-profile-card
            :name="auth()->user()->name"
            :email="auth()->user()->email"
            :role="auth()->user()->role ?? 'Instructor'"

        />
    </main>
</x-layout>
