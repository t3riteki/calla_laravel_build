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
                <button onclick="openEditModal()" class="btn btn-sm bg-red-700 text-white hover:bg-red-800 transition">
                    Edit Profile
                </button>
                <button class="btn btn-sm btn-outline border-red-700 text-red-700 hover:bg-red-100">Change Password</button>
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
                <p class="font-medium text-gray-700">{{ $created_at ?? '07/17/2004'}}</p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg border">
                <p class="text-sm text-gray-500">Last Updated</p>
                <p class="font-medium text-gray-700">{{ $updated_at ?? '11/06/2025'}}</p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg border">
                <p class="text-sm text-gray-500">Birthdate</p>
                <p class="font-medium text-gray-700">
                    {{ $birthdate ?? 'No Birthdate' }}
                </p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg border">
                <p class="text-sm text-gray-500">Gender</p>
                <p class="font-medium text-gray-700">
                    {{ ucfirst($gender ?? 'Not specified') }}
                </p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg border">
                <p class="text-sm text-gray-500">Contact Number</p>
                <p class="font-medium text-gray-700">
                    {{ $contact_number ?? 'Not provided' }}
                </p>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg border">
                <p class="text-sm text-gray-500">Address</p>
                <p class="font-medium text-gray-700">
                    {{ $address ?? 'Not provided' }}
                </p>
            </div>


        </div>
    </div>
</div>
