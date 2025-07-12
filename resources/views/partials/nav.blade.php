@php 
$role = Auth::check() ? Auth::user()->role : null; 
$dashboardRoute = match ($role) 
{ 'administration' => 'administration.dashboard',
 'homeroom-teacher' => 'homeroom-teacher.dashboard', 
'headmaster' => 'headmaster.dashboard',
'ksm-teacher' => 'ksm-teacher.dashboard', 
default => '#', }; 
@endphp

<header class="bg-green-800 text-white shadow px-10 py-3 flex justify-between items-center relative">
    <a href={{ route($dashboardRoute) }} class="text-xl font-bold capitalize hover:text-white/70">{{ auth()->user()->role }} Panel</a>

    <!-- Profile Dropdown -->
    <div x-data="{ open: false }" class="relative">
        <button 
            @click="open = !open" 
            class="flex items-center space-x-2 focus:outline-none rounded-md text-gray-200 transform hover:-translate-y-1 hover:bg-gray-300/80 hover:text-white transition duration-200 font-semibold text-md p-1"
        >
            <!-- Icon Profile -->
            <i class="fa-solid fa-circle-user text-2xl"></i>
            <!-- Nama User -->
            <span class="font-semibold">{{ auth()->user()->name }}</span>
            <!-- Icon Dropdown -->
            <svg class="w-4 h-4 transform transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor"
                stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown -->
        <div x-show="open" @click.away="open = false"
            class="absolute right-0 mt-2 w-64 bg-white text-black rounded-lg shadow-lg z-50 overflow-hidden">
            <!-- Header -->
            <div class="flex justify-center items-center gap-3 p-3 bg-gray-100 border-b">
                <i class="fa-solid fa-face-smile text-2xl"></i>
                <div>
                    <div class="font-bold text-sm">{{ auth()->user()->name }}</div>
                    <div class="text-xs text-gray-600">{{ auth()->user()->email ?? 'Email Not Found' }}</div>
                </div>
            </div>

            <!-- Logout Option -->
            <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="button" onclick="confirmLogout()"
                    class="w-full text-left px-5 py-3 text-red-600 hover:bg-red-50 flex items-center space-x-2 transition">
                    <i class="fas fa-sign-out-alt text-xl text-red-600"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</header>
@include('partials.alert')
