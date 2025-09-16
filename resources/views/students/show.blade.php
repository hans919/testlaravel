@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl p-8 mb-8 text-white shadow-2xl">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{ $student->full_name }}</h1>
                    <p class="text-white/90 text-lg">{{ $student->student_id }} • {{ $student->course }}</p>
                    <div class="flex items-center mt-2 space-x-4">
                        <span class="text-white/80 text-sm">{{ $student->year }} Year - Section {{ $student->section }}</span>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                            {{ $student->status === 'active' 
                                ? 'bg-green-500/20 text-green-100 border border-green-400/30' 
                                : 'bg-red-500/20 text-red-100 border border-red-400/30' }}">
                            {{ ucfirst($student->status) }}
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="hidden md:flex space-x-3">
                <a href="{{ route('students.edit', $student) }}" 
                   class="bg-white/20 hover:bg-white/30 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    <span>Edit</span>
                </a>
                <a href="{{ route('students.index') }}" 
                   class="bg-white/20 hover:bg-white/30 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Back</span>
                </a>
            </div>
        </div>
        
        <!-- Mobile Action Buttons -->
        <div class="md:hidden mt-6 flex space-x-3">
            <a href="{{ route('students.edit', $student) }}" 
               class="flex-1 bg-white/20 hover:bg-white/30 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                <span>Edit</span>
            </a>
            <a href="{{ route('students.index') }}" 
               class="flex-1 bg-white/20 hover:bg-white/30 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Back</span>
            </a>
        </div>
    </div>

    <!-- Student Information Cards -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Personal Information -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-primary/10">
            <div class="bg-gradient-to-r from-primary to-secondary p-6">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Personal Information
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-600">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</span>
                    <span class="text-sm text-dark dark:text-light font-semibold">{{ $student->full_name }}</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-600">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Address</span>
                    <span class="text-sm text-dark dark:text-light">
                        <a href="mailto:{{ $student->email }}" class="hover:text-primary transition-colors">
                            {{ $student->email }}
                        </a>
                    </span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-600">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Phone Number</span>
                    <span class="text-sm text-dark dark:text-light">
                        {{ $student->phone ?: 'Not provided' }}
                    </span>
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Account Status</span>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full 
                        {{ $student->status === 'active' 
                            ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300' 
                            : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300' }}">
                        {{ ucfirst($student->status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Academic Information -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-secondary/10">
            <div class="bg-gradient-to-r from-secondary to-accent-orange p-6">
                <h3 class="text-xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Academic Information
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-600">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Student ID</span>
                    <span class="text-sm text-dark dark:text-light font-mono bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded">
                        {{ $student->student_id }}
                    </span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-600">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Course</span>
                    <span class="text-sm text-dark dark:text-light font-semibold">{{ $student->course }}</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-600">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Year Level</span>
                    <span class="text-sm text-dark dark:text-light">{{ $student->year }} Year</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-600">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Section</span>
                    <span class="text-sm text-dark dark:text-light">{{ $student->section }}</span>
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">RFID Tag</span>
                    <span class="text-sm text-dark dark:text-light font-mono bg-primary/10 dark:bg-primary/20 px-2 py-1 rounded">
                        {{ $student->rfid_tag }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance History -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-primary/10">
        <div class="bg-gradient-to-r from-primary to-secondary p-6">
            <h3 class="text-xl font-bold text-white flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                Recent Attendance History
            </h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Date
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            AM Session
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            PM Session
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Notes
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                    @forelse($student->attendanceRecords as $record)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-dark dark:text-light font-medium">
                                {{ $record->attendance_date->format('M d, Y') }}
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $record->attendance_date->format('l') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                <div class="space-y-1">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs text-gray-500 dark:text-gray-400 w-8">In:</span>
                                        <span class="font-mono {{ $record->am_time_in ? 'text-green-600 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}">
                                            {{ $record->am_time_in ? \Carbon\Carbon::parse($record->am_time_in)->format('H:i') : '--:--' }}
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs text-gray-500 dark:text-gray-400 w-8">Out:</span>
                                        <span class="font-mono {{ $record->am_time_out ? 'text-red-600 dark:text-red-400' : 'text-gray-400 dark:text-gray-500' }}">
                                            {{ $record->am_time_out ? \Carbon\Carbon::parse($record->am_time_out)->format('H:i') : '--:--' }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                <div class="space-y-1">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs text-gray-500 dark:text-gray-400 w-8">In:</span>
                                        <span class="font-mono {{ $record->pm_time_in ? 'text-green-600 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}">
                                            {{ $record->pm_time_in ? \Carbon\Carbon::parse($record->pm_time_in)->format('H:i') : '--:--' }}
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xs text-gray-500 dark:text-gray-400 w-8">Out:</span>
                                        <span class="font-mono {{ $record->pm_time_out ? 'text-red-600 dark:text-red-400' : 'text-gray-400 dark:text-gray-500' }}">
                                            {{ $record->pm_time_out ? \Carbon\Carbon::parse($record->pm_time_out)->format('H:i') : '--:--' }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    @if($record->status === 'present') 
                                        bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300
                                    @elseif($record->status === 'partial') 
                                        bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-300
                                    @else 
                                        bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300
                                    @endif">
                                    {{ ucfirst($record->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                {{ $record->notes ?: '--' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center space-y-4">
                                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                    </svg>
                                    <div class="text-center">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Attendance Records</h3>
                                        <p class="text-gray-500 dark:text-gray-400">No attendance records found for this student yet.</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
