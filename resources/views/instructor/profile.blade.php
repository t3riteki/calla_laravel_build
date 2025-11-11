<x-layout>
    <x-slot:title>My Profile</x-slot:title>

    <main class="min-h-[calc(100vh-64px)] bg-gradient-to-br from-red-50 via-white to-red-100 pt-15">
        <x-profile-card
            :name="auth()->user()->name"
            :email="auth()->user()->email"
            :role="auth()->user()->role ?? 'Instructor'"

            {{-- :created_at="auth()->user()->created_at->format('F d, Y')"
            :updated_at="auth()->user()->updated_at->format('F d, Y')" --}}
        />
    </main>

    <!-- 🧾 Edit Profile Modal -->
    <dialog id="editProfileModal" class="modal">
        <div class="modal-box max-w-md">
            <h3 class="font-bold text-lg mb-4">Edit Profile</h3>
            <form method="POST" action="/profile/{{auth()->user()->id}}">
                @csrf
                @method('PUT')
                <!-- Name -->
                <div class="form-control mb-3">
                    <label class="label"><span class="label-text">Full Name</span></label>
                    <input
                        type="text"
                        name="name"
                        value="{{ auth()->user()->name }}"
                        class="input input-bordered w-full focus:ring-2 focus:ring-red-700"
                    />
                </div>

                <!-- Birthdate -->
                <div class="form-control mb-3">
                    <label class="label"><span class="label-text">Birthdate</span></label>
                    <input
                        type="date"
                        name="birthday"
                        value="{{ auth()->user()->birthday}}"
                        class="input input-bordered w-full focus:ring-2 focus:ring-red-700"
                    />
                </div>

                <!-- Gender -->
                <div class="form-control mb-3">
                    <label class="label"><span class="label-text">Gender</span></label>
                    <select
                        name="gender"
                        class="select select-bordered w-full focus:ring-2 focus:ring-red-700"
                    >
                        <option value="">Select Gender</option>
                        <option value="male" @selected(auth()->user()->gender === 'male')>Male</option>
                        <option value="female" @selected(auth()->user()->gender === 'female')>Female</option>
                        <option value="other" @selected(auth()->user()->gender === 'other')>Other</option>
                    </select>
                </div>

                <div class="modal-action">
                    <button type="submit" class="btn bg-red-700 text-white hover:bg-red-800">Save</button>
                    <button type="button" class="btn" onclick="editProfileModal.close()">Cancel</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function openEditModal() {
            document.getElementById('editProfileModal').showModal();
        }
    </script>
</x-layout>
