<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'primary': '#F53003',
                            'secondary': '#FF750F',
                            'dark': '#1b1b18',
                            'light': '#FDFDFC',
                            'accent-orange': '#F8B803',
                            'accent-red': '#F61500'
                        },
                        fontFamily: {
                            sans: ['Instrument Sans', 'ui-sans-serif', 'system-ui']
                        }
                    }
                }
            }
        </script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased"
        x-data="{
            sidebarOpen: false,
            darkMode: localStorage.getItem('darkMode') === 'true',
            toggleDarkMode() {
                this.darkMode = !this.darkMode;
                localStorage.setItem('darkMode', this.darkMode);
            }
        }"
        :class="{ 'dark': darkMode }"
        class="bg-light dark:bg-dark">
        <div class="min-h-screen flex">
            <!-- Mobile menu overlay -->
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="sidebarOpen = false"
                 class="fixed inset-0 flex z-40 lg:hidden">
                
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-black bg-opacity-50"></div>
                
                <!-- Mobile sidebar -->
                <div x-show="sidebarOpen"
                     x-transition:enter="transition ease-in-out duration-300 transform"
                     x-transition:enter-start="-translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transition ease-in-out duration-300 transform"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="-translate-x-full"
                     @click.stop
                     class="relative flex-1 flex flex-col max-w-xs w-full">
                    
                    <!-- Close button -->
                    <div class="absolute top-0 right-0 -mr-12 pt-2">
                        <button x-on:click="sidebarOpen = false" 
                                type="button" 
                                class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white bg-primary hover:bg-secondary transition-colors">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Mobile navigation -->
                    @include('layouts.navigation')
                </div>
                
                <!-- Spacer to prevent clicks on the sidebar from closing it -->
                <div class="flex-shrink-0 w-14" aria-hidden="true"></div>
            </div>

            <!-- Desktop sidebar -->
            <div class="hidden lg:flex lg:flex-shrink-0">
                <div class="flex flex-col w-64">
                    @include('layouts.navigation')
                </div>
            </div>

            <!-- Main content area -->
            <div class="flex flex-col flex-1 overflow-hidden">
                <!-- Top navigation bar -->
                <header class="bg-white dark:bg-gray-800 shadow-lg border-b-2 border-primary/20">
                    <div class="flex items-center justify-between px-4 py-6 sm:px-6 lg:px-8">
                        <div class="flex items-center">
                            <!-- Mobile menu button -->
                            <button x-on:click="sidebarOpen = true" 
                                    type="button" 
                                    class="lg:hidden p-2 rounded-md text-primary hover:text-secondary hover:bg-primary/10 focus:outline-none focus:ring-2 focus:ring-primary transition-colors">
                                <span class="sr-only">Open sidebar</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </button>
                            
                            <!-- Page title / header slot for component-based pages -->
                            <div class="ml-3">
                                @if(isset($header))
                                    <div class="text-xl sm:text-2xl font-semibold text-dark dark:text-light">{{ $header }}</div>
                                @else
                                    <h1 class="text-xl sm:text-2xl font-semibold text-dark dark:text-light">@yield('title', 'Dashboard')</h1>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <!-- Dark mode toggle -->
                            <button x-on:click="toggleDarkMode()" type="button" class="bg-primary/20 dark:bg-secondary/20 relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                                <span class="sr-only">Use setting</span>
                                <span :class="darkMode ? 'translate-x-5' : 'translate-x-0'" class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-primary shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>

                            <!-- Profile dropdown -->
                            <div class="relative" x-data="{ open: false }">
                                <button x-on:click="open = !open" type="button" class="bg-primary hover:bg-secondary transition-colors flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <div class="h-8 w-8 rounded-full bg-primary hover:bg-secondary transition-colors flex items-center justify-center">
                                        <span class="text-white font-medium">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                </button>

                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="transform opacity-0 scale-95"
                                     x-transition:enter-end="transform opacity-100 scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="transform opacity-100 scale-100"
                                     x-transition:leave-end="transform opacity-0 scale-95"
                                     x-on:click.away="open = false"
                                     class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white dark:bg-gray-800 ring-1 ring-primary/20 ring-opacity-5 focus:outline-none z-50 border border-primary/10" style="display: none;">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-dark dark:text-light hover:bg-primary/10 dark:hover:bg-secondary/10 transition-colors">{{ __('Profile') }}</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-dark dark:text-light hover:bg-primary/10 dark:hover:bg-secondary/10 transition-colors">{{ __('Log Out') }}</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page content -->
                <main class="flex-1 relative overflow-y-auto focus:outline-none">
                    <div class="py-6">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            {{-- Support both traditional blade sections and component slots --}}
                            @if(isset($slot))
                                {{ $slot }}
                            @else
                                @yield('content')
                            @endif
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
