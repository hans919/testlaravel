<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'RFID Attendance') - {{ config('app.name', 'Laravel') }}</title>

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
    <body class="font-sans text-dark antialiased bg-light dark:bg-dark">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-light via-orange-50 to-red-50 dark:from-dark dark:via-gray-900 dark:to-gray-800">
            <div>
                <a href="/">
                    
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white dark:bg-gray-800 shadow-2xl border border-primary/10 overflow-hidden sm:rounded-lg">
                @yield('content')
            </div>

            <!-- Background decoration -->
            <div class="fixed inset-0 -z-10 overflow-hidden">
                <div class="absolute -top-40 -right-32 w-96 h-96 bg-primary/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-40 -left-32 w-96 h-96 bg-secondary/20 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-accent-orange/10 rounded-full blur-3xl"></div>
            </div>
        </div>
    </body>
</html>
