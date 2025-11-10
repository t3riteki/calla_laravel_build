<!-- HEADER / NAVBAR -->
<nav class="navbar fixed z-50 bg-white px-6">

  <!-- LEFT SIDE -->
  <div class="navbar-start px-4.5">
    @auth
    <a href="/dashboard" class="flex flex-row ">
        <div class="text-2xl font-bold text-red-900 transition-colors duration-300 hover:scale-105">CALLA</div>
        <div class="text-1xl font-italic text-red-300 mx-1 self-end">{{ auth()->user()->role }}</div>
    </a>

    @else
    <div class="text-2xl font-bold text-red-900 transition-colors duration-300 hover:scale-105">CALLA</div>
    @endauth

  </div>

  <!-- RIGHT SIDE -->
  <div class="navbar-end gap-2">
    @if (Route::is('landing'))
      <!-- HOME PAGE LINKS -->
      <ul class="menu menu-horizontal px-1 hidden lg:flex">
        <li><a href="#about" class="hover:text-red-700">About</a></li>
        <li><a href="#features" class="hover:text-red-700">Features</a></li>
        <li><a href="#contact" class="hover:text-red-700">Contact</a></li>
        @auth
            <li><a href="/dashboard" class="hover:text-red-700">Dashboard</a></li>
        @endauth
      </ul>
    @endif

    <!-- CENTER (only for authenticated users) -->
    @auth
        @if(!Route::is('landing'))
            <div class="navbar-center hidden md:flex">
                <label class="input input-bordered flex items-center gap-2 w-150">
                <i class="ri-search-line text-gray-500"></i>
                <input type="text" placeholder="Search classes, students, modules..." class="grow" />
                </label>
            </div>
        @endif
    @endauth

    @auth
      <!-- Profile Dropdown -->
      <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full ring ring-red-700 ring-offset-base-100 ring-offset-2">
            <img src="{{ asset('images/Profile-Picture_Placeholder.jpg') }}" alt="Profile" />
          </div>
        </label>
        <ul tabindex="0"
            class="menu menu-sm dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
          <li class="menu-title">{{ auth()->user()->name }}</li>
          <li><a href="/profile" class="hover:bg-red-100">Profile</a></li>
          <li><a href="/settings" class="hover:bg-red-100">Settings</a></li>
          <li><a href="/logout" class="text-red-600 hover:text-red-800 font-semibold">Logout</a></li>
        </ul>
      </div>

    @else
      <!-- Guest Buttons -->
      <a href="/login" class="btn btn-ghost btn-sm">Sign In</a>
      <a href="/register" class="btn btn-primary btn-sm">Sign Up</a>
    @endauth
  </div>

</nav>
