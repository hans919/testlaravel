@extends('layouts.app')

@section('title', 'RFID Attendance Dashboard')

@section('content')
    <!-- Welcome Banner -->
    <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl p-8 mb-8 text-white shadow-2xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-white/90 text-lg">Track attendance with ease using our RFID system</p>
                <p class="text-white/70 mt-1">{{ now()->format('l, F j, Y') }}</p>
            </div>
            <div class="hidden md:block">
                <div class="w-32 h-32 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-primary/10">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-primary/20 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div>
                    <div class="text-3xl font-bold text-primary">{{ \App\Models\Student::where('status', 'active')->count() }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Active Students</div>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-green-200">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <div class="text-3xl font-bold text-green-600">{{ \App\Models\AttendanceRecord::where('attendance_date', today())->where('status', 'present')->count() }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Present Today</div>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-accent-orange/30">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-accent-orange/20 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-accent-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <div class="text-3xl font-bold text-accent-orange">{{ \App\Models\AttendanceRecord::where('attendance_date', today())->where('status', 'partial')->count() }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Partial Today</div>
                </div>
            </div>
        </div>
        
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg border border-red-200">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <div>
                    <div class="text-3xl font-bold text-red-600">{{ \App\Models\Student::where('status', 'active')->count() - \App\Models\AttendanceRecord::where('attendance_date', today())->count() }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Absent Today</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('rfid.scan') }}" class="group bg-gradient-to-br from-primary to-secondary hover:from-primary/90 hover:to-secondary/90 text-white p-8 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105">
            <div class="flex items-center justify-center mb-4">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-center">
                <div class="text-xl font-bold mb-2">RFID Scanner</div>
                <div class="text-white/90">Scan student RFID tags</div>
            </div>
        </a>
        
        <a href="{{ route('students.index') }}" class="group bg-gradient-to-br from-green-500 to-green-600 hover:from-green-400 hover:to-green-500 text-white p-8 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105">
            <div class="flex items-center justify-center mb-4">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-center">
                <div class="text-xl font-bold mb-2">Manage Students</div>
                <div class="text-white/90">Add, edit, and view students</div>
            </div>
        </a>
        
        <a href="{{ route('attendance.index') }}" class="group bg-gradient-to-br from-purple-500 to-purple-600 hover:from-purple-400 hover:to-purple-500 text-white p-8 rounded-xl shadow-lg transition-all duration-300 transform hover:scale-105">
            <div class="flex items-center justify-center mb-4">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
            <div class="text-center">
                <div class="text-xl font-bold mb-2">View Attendance</div>
                <div class="text-white/90">Check attendance records</div>
            </div>
        </a>
    </div>

    <!-- Recent Attendance -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-primary/10">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-dark dark:text-light">Recent Attendance</h2>
            <span class="text-sm bg-primary/10 text-primary px-3 py-1 rounded-full">Today</span>
        </div>
        
        <div class="overflow-hidden">
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse(\App\Models\AttendanceRecord::with('student')->where('attendance_date', today())->latest()->take(8)->get() as $record)
                <div class="py-4 flex items-center justify-between hover:bg-primary/5 dark:hover:bg-gray-700/50 px-4 -mx-4 rounded-lg transition-colors">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center">
                            <span class="text-white font-medium">{{ substr($record->student->first_name, 0, 1) }}{{ substr($record->student->last_name, 0, 1) }}</span>
                        </div>
                        <div>
                            <div class="font-semibold text-dark dark:text-light">{{ $record->student->full_name }}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">{{ $record->student->course }} - Year {{ $record->student->year }} - {{ $record->student->section }}</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                            @if($record->status === 'present') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100
                            @elseif($record->status === 'partial') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100
                            @else bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100 @endif">
                            {{ ucfirst($record->status) }}
                        </span>
                        <div class="text-sm text-gray-500 dark:text-gray-400 font-mono">{{ $record->updated_at->format('H:i') }}</div>
                    </div>
                </div>
                @empty
                <div class="py-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No attendance records today</h3>
                    <p class="text-gray-500 dark:text-gray-400">Start scanning RFID tags to record attendance</p>
                </div>
                @endforelse
            </div>
        </div>
        
        @if(\App\Models\AttendanceRecord::where('attendance_date', today())->count() > 8)
        <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ route('attendance.index') }}" class="text-primary hover:text-secondary font-medium text-sm flex items-center justify-center space-x-2 transition-colors">
                <span>View all attendance records</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
        @endif
    </div>
@endsection
