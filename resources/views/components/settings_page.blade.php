<div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg border border-gray-100 p-8 relative">
    {{-- <a href="{{ auth()->user()->role === 'instructor' ? route('instructor.dashboard') : route('student.dashboard') }}"
       class="absolute top-6 right-6 btn btn-sm bg-gradient-to-r from-red-700 to-red-800 text-white border-none hover:opacity-90 transition">
        ← Back to Dashboard
    </a> --}}

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Settings</h2>
        <p class="text-sm text-gray-500 mt-1">
            Manage your account preferences and role-specific options
        </p>
    </div>

    <div class="space-y-6">
        <!-- Shared settings for both -->
        <div class="p-5 bg-gray-50 rounded-xl border hover:shadow-sm transition">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="font-semibold text-gray-800">Theme Preference</h3>
                    <p class="text-sm text-gray-500">Choose your preferred dashboard theme.</p>
                </div>
                <select class="select select-bordered select-sm w-32 focus:ring-2 focus:ring-red-700">
                    <option>Light</option>
                    <option>Dark</option>
                </select>
            </div>
        </div>

        <div class="p-5 bg-gray-50 rounded-xl border hover:shadow-sm transition">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="font-semibold text-gray-800">Email Notifications</h3>
                    <p class="text-sm text-gray-500">Get updates about classes and announcements.</p>
                </div>
                <input type="checkbox" class="toggle toggle-error" checked />
            </div>
        </div>

        <!-- Instructor-only -->
        @if (auth()->user()->role === 'instructor')
            <div class="p-5 bg-gray-50 rounded-xl border hover:shadow-sm transition">
                <h3 class="font-semibold text-gray-800 mb-2">Class Preferences</h3>
                <select class="select select-bordered select-sm w-full focus:ring-2 focus:ring-red-700">
                    <option>Private (Invite Only)</option>
                    <option>Public (Join via Code)</option>
                </select>
            </div>

            <div class="p-5 bg-gray-50 rounded-xl border hover:shadow-sm transition">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-semibold text-gray-800">Default Class Code Prefix</span>
                    </label>
                    <input type="text" placeholder="e.g., ENG or SCI"
                        class="input input-bordered w-full input-sm focus:ring-2 focus:ring-red-700" />
                    <p class="text-xs text-gray-500 mt-1">This prefix will appear before auto-generated class codes.</p>
                </div>
            </div>
        @endif

        <!-- Student-only -->
        @if (auth()->user()->role === 'student')
            <div class="p-5 bg-gray-50 rounded-xl border hover:shadow-sm transition">
                <h3 class="font-semibold text-gray-800 mb-2">Learning Preferences</h3>
                <p class="text-sm text-gray-500 mb-2">Select your preferred learning pace or style.</p>
                <select class="select select-bordered select-sm w-full focus:ring-2 focus:ring-red-700">
                    <option>Standard Pace</option>
                    <option>Self-paced Learning</option>
                </select>
            </div>
        @endif

        <div class="flex justify-end">
            <button class="btn bg-red-700 hover:bg-red-800 text-white px-6 rounded-lg">
                Save Changes
            </button>
        </div>
    </div>
</div>
