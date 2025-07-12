<aside
    class="w-64 bg-white text-gray-800 min-h-screen shadow-md flex flex-col justify-between transition-all duration-300 ease-in-out overflow-hidden"
>

    <!-- Header with Title and Toggle -->
    <div
        class="p-4 flex items-center justify-between border-b-2 text-green-600"
    >
        <span id="sidebarTitle" class="text-xl font-bold">SPK-KSM</span>
        <button
            onclick="toggleSidebar()"
            class="w-10 h-10 text-5xl hover:opacity-55 relative"
        >
            <span
                id="toggleIcon"
                class="absolute bottom-0 transition duration-200"
                >«</span
            >
        </button>
    </div>
    <!-- Menu -->
    <nav class="px-2 flex-1 pt-3">
        <ul class="space-y-2 text-sm">
            @php 
                $role = Auth::check() ? Auth::user()->role : null; 
                $dashboardRoute = match ($role) 
                { 'administration' => 'administration.dashboard',
                'homeroom-teacher' => 'homeroom-teacher.dashboard', 
                'headmaster' => 'headmaster.dashboard',
                'ksm-teacher' => 'ksm-teacher.dashboard', 
                default => '#', }; 
            @endphp 

            {{-- Menu umum --}}
            @if(in_array($role, ['administration', 'homeroom-teacher',
            'headmaster', 'ksm-teacher']))
            <li>
                <p
                    class="sidebar-label text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 mt-6 mb-1"
                >
                    Menu Dashboard
                </p>
                <a
                    href="{{ route($dashboardRoute) }}"
                    class="flex items-center gap-3 p-3 mt-3 rounded {{ Route::is($dashboardRoute) ? 'bg-green-600 text-white' : 'bg-gray-100 text-green-600 hover:bg-green-600 hover:text-white' }} transition font-semibold text-lg"
                >
                    <i class="fa-solid fa-house text-2xl"></i>
                    <span class="sidebar-label">Dashboard</span>
                </a>
            </li>
            @endif

            {{-- Menu khusus administration --}}
            @if($role === 'administration')
            <li>
                <p
                    class="sidebar-label text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 mt-6 mb-1"
                >
                    User Management
                </p>
                <a
                    href="{{ route('administration.users.index') }}"
                    class="flex items-center gap-3 p-3 mt-3 rounded {{ Route::is('administration.users.*') ? 'bg-green-600 text-white' : 'bg-gray-100 text-green-600 hover:bg-green-600 hover:text-white' }} transition font-semibold text-lg"
                >
                    <i class="fa-solid fa-user-plus text-2xl"></i>
                    <span class="sidebar-label">Users</span>
                </a>
            </li>
            <li>
                <p
                    class="sidebar-label text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 mt-6 mb-1"
                >
                    Component SPK
                </p>
                <a
                    href="{{ route('administration.students.index') }}"
                    class="flex items-center gap-3 p-3 mt-3 rounded {{ Route::is('administration.students.*') ? 'bg-green-600 text-white' : 'bg-gray-100 text-green-600 hover:bg-green-600 hover:text-white' }} transition font-semibold text-lg"
                >
                    <i class="fa-solid fa-address-card text-2xl"></i>
                    <span class="sidebar-label">Student Data</span>
                </a>
            </li>
            <li>
                <a
                    href="{{ route('administration.criterias.index') }}"
                    class="flex items-center gap-3 p-3 mt-3 rounded {{ Route::is('administration.criterias.*') ? 'bg-green-600 text-white' : 'bg-gray-100 text-green-600 hover:bg-green-600 hover:text-white' }} transition font-semibold text-lg"
                >
                    <i class="fa-solid fa-square-poll-vertical text-2xl"></i>
                    <span class="sidebar-label">Criteria Data</span>
                </a>
            </li>
            <li>
                <a
                    href="{{ route('administration.scores.index') }}"
                    class="flex items-center gap-3 p-3 mt-3 rounded {{ Route::is('administration.scores.*') ? 'bg-green-600 text-white' : 'bg-gray-100 text-green-600 hover:bg-green-600 hover:text-white' }} transition font-semibold text-lg"
                >
                    <i class="fa-solid fa-book-open text2xl"></i>
                    <span class="sidebar-label">Score Data</span>
                </a>
            </li>
            <li>
                <a
                    href="{{ route('administration.results.index') }}"
                    class="flex items-center gap-3 p-3 mt-3 rounded {{ Route::is('administration.results.*') ? 'bg-green-600 text-white' : 'bg-gray-100 text-green-600 hover:bg-green-600 hover:text-white' }} transition font-semibold text-lg"
                >
                    <i class="fa-solid fa-calculator text-2xl"></i>
                    <span class="sidebar-label">Count Result</span>
                </a>
            </li>
            @endif

            {{-- Menu khusus homeroom-teacher --}}
            @if($role === 'homeroom-teacher')
            <li>
                <p
                    class="sidebar-label text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 mt-6 mb-1"
                >
                    Component SPK
                </p>
                <a
                    href="{{ route('homeroom-teacher.students.index') }}"
                    class="flex items-center gap-3 p-3 mt-3 rounded {{ Route::is('homeroom-teacher.students.*') ? 'bg-green-600 text-white' : 'bg-gray-100 text-green-600 hover:bg-green-600 hover:text-white' }} transition font-semibold text-lg"
                >
                    <i class="fa-solid fa-address-card text-2xl"></i>
                    <span class="sidebar-label">Student Data</span>
                </a>
            </li>
            <li>
                <a
                    href="{{ route('homeroom-teacher.scores.index') }}"
                    class="flex items-center gap-3 p-3 mt-3 rounded {{ Route::is('homeroom-teacher.scores.*') ? 'bg-green-600 text-white' : 'bg-gray-100 text-green-600 hover:bg-green-600 hover:text-white' }} transition font-semibold text-lg"
                >
                    <i class="fa-solid fa-book-open text2xl"></i>
                    <span class="sidebar-label">Score Data</span>
                </a>
            </li>
            <li>
                <a
                    href="{{ route('homeroom-teacher.results.index') }}"
                    class="flex items-center gap-3 p-3 mt-3 rounded {{ Route::is('homeroom-teacher.results.*') ? 'bg-green-600 text-white' : 'bg-gray-100 text-green-600 hover:bg-green-600 hover:text-white' }} transition font-semibold text-lg"
                >
                    <i class="fa-solid fa-calculator text-2xl"></i>
                    <span class="sidebar-label">Count Result</span>
                </a>
            </li>
            @endif

            {{-- Menu untuk headmaster dan ksm-teacher --}}
            @php 
                $role = Auth::check() ? Auth::user()->role : null; 
                $scoreRoute = match ($role) 
                { 
                'headmaster' => 'headmaster.scores.index',
                'ksm-teacher' => 'ksm-teacher.scores.index', 
                default => '#', }; 
                $resultRoute = match ($role) 
                { 
                'headmaster' => 'headmaster.results.index',
                'ksm-teacher' => 'ksm-teacher.results.index', 
                default => '#', }; 
            @endphp
            @if(in_array($role, ['headmaster', 'ksm-teacher']))
                <li>
                    <p class="sidebar-label text-xs font-semibold text-gray-500 uppercase tracking-wider px-3 mt-6 mb-1">
                        Component SPK
                    </p>
                    <a href="{{ route($scoreRoute) }}" class="flex items-center gap-3 p-3 mt-3 rounded {{ Route::is($scoreRoute) ? 'bg-green-600 text-white' : 'bg-gray-100 text-green-600 hover:bg-green-600 hover:text-white' }} transition font-semibold text-lg">
                        <i class="fa-solid fa-book-open text-2xl"></i>
                        <span class="sidebar-label">Score Data</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route($resultRoute) }}" class="flex items-center gap-3 p-3 mt-3 rounded {{ Route::is($resultRoute) ? 'bg-green-600 text-white' : 'bg-gray-100 text-green-600 hover:bg-green-600 hover:text-white' }} transition font-semibold text-lg">
                        <i class="fa-solid fa-calculator text-2xl"></i>
                        <span class="sidebar-label">Count Result</span>
                    </a>
                </li>
            @endif
        </ul>
    </nav>
</aside>
