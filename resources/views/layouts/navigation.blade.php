<!-- Sidebar navigation for desktop and mobile -->
<div class="flex flex-col w-full h-full bg-gradient-to-b from-primary to-secondary dark:from-gray-900 dark:to-gray-800 shadow-xl">
    <!-- Logo and brand -->
    <div class="flex items-center justify-center h-16 lg:h-20 px-4 bg-black/20">
        <div class="flex items-center space-x-2 lg:space-x-3">
            <!-- Laravel Logo -->
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 lg:w-8 lg:h-8 text-white" viewBox="0 0 50 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M49.626 11.564a.809.809 0 0 1 .028.209v10.972a.8.8 0 0 1-.402.694l-9.209 5.302V39.25c0 .286-.152.55-.4.694L20.42 51.01c-.044.025-.092.041-.14.058-.018.006-.035.017-.054.022a.805.805 0 0 1-.41 0c-.022-.006-.042-.018-.063-.026-.044-.016-.09-.03-.132-.054L.402 39.944A.801.801 0 0 1 0 39.25V6.334c0-.072.016-.142.028-.21.015-.084.044-.165.08-.242.036-.065.08-.125.13-.18.065-.068.138-.13.217-.186l19.22-11.066c.248-.143.54-.143.788 0l19.22 11.066a.803.803 0 0 1 .348.366c.035.077.064.158.08.242zm-1.574 10.718v-9.124l-3.363 1.936-4.126 2.376v9.124l7.489-4.312zm-9.61 16.505v-9.13l-4.056 2.31-8.156 4.646v9.168l12.212-6.994zm-17.85 6.993V35.64l-8.131-4.634v9.168l8.131 4.634zm-10.327-28.85v9.124l7.489 4.312v-9.124L8.365 14.236 4.265 12.299zm8.91-5.31L9.683 6.864l19.396-11.164 9.491 5.442-19.396 11.165zM8.365 23.18L39.42 6.334l-.001-.001-19.22-11.066L.977 6.334l7.388 4.246zm-6.789 3.931l7.489 4.312v16.498l-7.489-4.312V27.11zm8.91 20.81l12.212 6.994v-16.498l-4.126-2.305-8.086-4.53V43.92zm13.492-8.05l12.252-6.994V15.372l-4.126 2.376-8.126 4.676v16.447z" fill="currentColor"/>
                </svg>
            </div>
            <!-- Brand Text -->
            <div class="flex flex-col">
                <h2 class="text-base lg:text-lg font-bold text-white leading-tight">RFID Attendance</h2>
                <span class="text-xs text-white/60 font-medium hidden sm:block lg:block">Laravel System</span>
            </div>
        </div>
    </div>

    <!-- Navigation menu -->
    <nav class="flex-1 px-3 lg:px-4 py-4 lg:py-6 space-y-1 lg:space-y-2 overflow-y-auto">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="group flex items-center px-3 lg:px-4 py-2 lg:py-3 text-sm font-medium rounded-lg transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white border-l-4 border-accent-orange shadow-lg' : 'text-white/80 hover:bg-white/10 hover:text-white hover:shadow-md' }}">
            <svg class="w-5 h-5 mr-2 lg:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5v2m8-2v2"></path>
            </svg>
            <span class="truncate">Dashboard</span>
        </a>

        <!-- RFID Scanner -->
        <a href="{{ route('rfid.scan') }}" 
           class="group flex items-center px-3 lg:px-4 py-2 lg:py-3 text-sm font-medium rounded-lg transition-all duration-150 {{ request()->routeIs('rfid.*') ? 'bg-white/20 text-white border-l-4 border-accent-orange shadow-lg' : 'text-white/80 hover:bg-white/10 hover:text-white hover:shadow-md' }}">
            <svg class="w-5 h-5 mr-2 lg:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
            </svg>
            <span class="truncate">RFID Scanner</span>
        </a>

        <!-- Students -->
        <a href="{{ route('students.index') }}" 
           class="group flex items-center px-3 lg:px-4 py-2 lg:py-3 text-sm font-medium rounded-lg transition-all duration-150 {{ request()->routeIs('students.*') ? 'bg-white/20 text-white border-l-4 border-accent-orange shadow-lg' : 'text-white/80 hover:bg-white/10 hover:text-white hover:shadow-md' }}">
            <svg class="w-5 h-5 mr-2 lg:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
            </svg>
            <span class="truncate">Students</span>
        </a>

        <!-- Attendance -->
        <a href="{{ route('attendance.index') }}" 
           class="group flex items-center px-3 lg:px-4 py-2 lg:py-3 text-sm font-medium rounded-lg transition-all duration-150 {{ request()->routeIs('attendance.*') ? 'bg-white/20 text-white border-l-4 border-accent-orange shadow-lg' : 'text-white/80 hover:bg-white/10 hover:text-white hover:shadow-md' }}">
            <svg class="w-5 h-5 mr-2 lg:mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="truncate">Attendance Records</span>
        </a>
    </nav>

    <!-- User section at bottom -->
    <div class="px-3 lg:px-4 py-4 lg:py-6 border-t border-white/20" x-data="{ open: false }">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 lg:w-10 lg:h-10 bg-accent-orange rounded-full flex items-center justify-center">
                    <span class="text-sm lg:text-base font-medium text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
            </div>
            <div class="ml-3 flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-white/60 truncate hidden sm:block lg:block">{{ Auth::user()->email }}</p>
            </div>
            <button @click="open = !open" class="ml-2 lg:ml-3 text-white/60 hover:text-white transition-colors p-1">
                <svg class="w-4 h-4 lg:w-5 lg:h-5 transform transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
        </div>

        <!-- User dropdown menu -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="transform opacity-0 scale-95"
             x-transition:enter-end="transform opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="transform opacity-100 scale-100"
             x-transition:leave-end="transform opacity-0 scale-95"
             class="mt-2 space-y-1">
            <a href="{{ route('profile.edit') }}" 
               class="flex items-center px-3 lg:px-4 py-2 text-sm text-white/80 hover:text-white hover:bg-white/10 rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2 lg:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="truncate">Profile Settings</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="w-full flex items-center px-3 lg:px-4 py-2 text-sm text-white/80 hover:text-white hover:bg-white/10 rounded-lg transition-colors text-left">
                    <svg class="w-4 h-4 mr-2 lg:mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="truncate">Sign Out</span>
                </button>
            </form>
        </div>
    </div>
</div>
