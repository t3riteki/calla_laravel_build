<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg border border-gray-100 p-8 relative">

    <!-- 🔙 Back Button -->
    <a href="/dashboard"
       class="absolute top-6 right-6 btn btn-sm bg-gradient-to-r from-red-700 to-red-800 text-white border-none hover:opacity-90 transition-all duration-200">
        ← Back to Dashboard
    </a>

    <div class="flex flex-col md:flex-row items-center gap-6 mt-4">
        <!-- Avatar -->
        <div class="avatar">
            <div class="w-32 rounded-full ring ring-red-700 ring-offset-base-100 ring-offset-2">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($name) }}&background=dc2626&color=fff" alt="Profile">
            </div>
        </div>

        <!-- Profile Info -->
        <div class="flex-1 text-center md:text-left">
            <h2 class="text-2xl font-bold text-gray-800">{{ $name }}</h2>
            <p class="text-gray-600">{{ $email }}</p>
            <p class="mt-1 text-sm text-gray-500">{{ ucfirst($role ?? 'User') }}</p>

            <div class="mt-4 flex justify-center md:justify-start gap-3">
                <button onclick="editProfileModal.showModal()" class="btn btn-sm bg-red-700 text-white hover:bg-red-800 transition">
                    Edit Profile
                </button>
                <button onclick="changePasswordModal.showModal()" class="btn btn-sm btn-outline border-red-700 text-red-700 hover:bg-red-100">Change Password</button>
            </div>
        </div>
    </div>

    <hr class="my-6">

    <!-- Additional Info -->
    <div>
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Account Information</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="p-4 bg-gray-50 rounded-lg border">
                <p class="text-sm text-gray-500">Account Created</p>
                {{-- Example static value — replace with dynamic value later --}}
                <p class="font-medium text-gray-700">{{ auth()->user()->created_at}}</p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg border">
                <p class="text-sm text-gray-500">Last Updated</p>
                <p class="font-medium text-gray-700">{{ auth()->user()->updated_at}}</p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg border">
                <p class="text-sm text-gray-500">Birthdate</p>
                <p class="font-medium text-gray-700">
                    {{ auth()->user()->birthday ?? 'Not Specified' }}
                </p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg border">
                <p class="text-sm text-gray-500">Gender</p>
                <p class="font-medium text-gray-700">
                    {{ ucfirst(auth()->user()->gender ?? 'Not Specified') }}
                </p>
            </div>

        </div>
    </div>
    <dialog id="editProfileModal" class="modal">
        <div class="modal-box max-w-md">
            <h3 class="font-bold text-lg mb-4">Edit Profile</h3>
            <form method="POST" action="/profile/{{auth()->user()->id}}">
                @csrf
                @method('PUT')
                <div class="form-control mb-3">
                    <label class="label"><span class="label-text">Full Name</span></label>
                    <input
                        type="text"
                        name="name"
                        value="{{ auth()->user()->name }}"
                        class="input input-bordered w-full focus:ring-2 focus:ring-red-700"
                    />
                </div>
                <div class="form-control mb-3">
                    <label class="label"><span class="label-text">Birthdate</span></label>
                    <input
                        type="date"
                        name="birthday"
                        value="{{ auth()->user()->birthday}}"
                        class="input input-bordered w-full focus:ring-2 focus:ring-red-700"
                    />
                </div>
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

    <dialog id="changePasswordModal" class="modal">
        <div class="modal-box max-w-md">
            <h3 class="font-bold text-lg mb-4">Change Password</h3>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="form-control mb-3">
                    <label class="label"><span class="label-text">Current Password</span></label>
                    <input
                        type="password"
                        name="current_password"
                        required
                        class="input input-bordered w-full focus:ring-2 focus:ring-red-700"
                    />
                    @error('current_password')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mb-3">
                    <label class="label"><span class="label-text">New Password</span></label>
                    <input
                        type="password"
                        name="password"
                        required
                        class="input input-bordered w-full focus:ring-2 focus:ring-red-700"
                    />
                    @error('password')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-control mb-3">
                    <label class="label"><span class="label-text">Confirm New Password</span></label>
                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        class="input input-bordered w-full focus:ring-2 focus:ring-red-700"
                    />
                </div>

                <div class="modal-action">
                    <button type="submit" class="btn bg-red-700 text-white hover:bg-red-800">Update Password</button>
                    <button type="button" class="btn" onclick="changePasswordModal.close()">Cancel</button>
                </div>
            </form>
        </div>
    </dialog>
</div>
