<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- Wrapper keseluruhan --}}
    <div class="flex flex-1">

        {{-- Sidebar --}}
        @php
            $role = auth()->user()->role;
        @endphp
        <div id="sidebar" class="sticky top-0 h-screen w-64 bg-white shadow z-30 transition-all duration-300">
            @include('partials.sidebar')
        </div>

        {{-- Konten utama --}}
        <div class="flex flex-col flex-1 min-h-screen overflow-hidden">

            {{-- Navbar --}}
            <div class="sticky top-0 w-full bg-white shadow z-20">
                @include('partials.nav')
            </div>

            {{-- Main content (scrollable) --}}
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="w-full bg-white shadow mt-auto">
                @include('partials.footer')
            </footer>
        </div>
    </div>

    {{-- Scripts --}}
    @include('partials.script')
</body>
</html>
