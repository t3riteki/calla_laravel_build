<x-layout>
    <x-slot:title>My Profile</x-slot:title>
    <x-navbar />

    <main class="min-h-screen bg-gradient-to-br from-red-50 via-white to-red-100 py-12 px-6 mt-15">
        <x-profile-card
            :name="auth()->user()->name"
            :email="auth()->user()->email"
            :role="auth()->user()->role ?? 'Instructor'"
            {{-- :created_at="auth()->user()->created_at->format('F d, Y')"
            :updated_at="auth()->user()->updated_at->format('F d, Y')" --}}
        />
    </main>
</x-layout>
