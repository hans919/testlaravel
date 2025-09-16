@extends('layouts.app')

@section('title', 'Attendance Records')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl p-8 mb-8 text-white shadow-2xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Attendance Records</h1>
                <p class="text-white/90 text-lg">Track and manage student attendance data</p>
            </div>
            <div class="hidden md:flex space-x-3">
                <a href="{{ route('attendance.create') }}" 
                   class="bg-white/20 hover:bg-white/30 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Manual Entry</span>
                </a>
                <a href="{{ route('attendance.report') }}" 
                   class="bg-white/20 hover:bg-white/30 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span>Generate Report</span>
                </a>
            </div>
        </div>
        
        <!-- Mobile Action Buttons -->
        <div class="md:hidden mt-6 flex space-x-3">
            <a href="{{ route('attendance.create') }}" 
               class="flex-1 bg-white/20 hover:bg-white/30 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span>Manual Entry</span>
            </a>
            <a href="{{ route('attendance.report') }}" 
               class="flex-1 bg-white/20 hover:bg-white/30 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span>Report</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 text-green-700 p-4 rounded-lg mb-6 dark:bg-green-900/20 dark:border-green-400 dark:text-green-300">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Filters Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-primary/10 mb-8">
        <div class="bg-gradient-to-r from-secondary to-accent-orange p-6">
            <h3 class="text-xl font-bold text-white flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filter Records
            </h3>
        </div>
        
        <form method="GET" class="p-4 lg:p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
                <div class="sm:col-span-2 lg:col-span-1">
                    <label for="date" class="block text-sm font-medium text-dark dark:text-light mb-2">Date</label>
                    <input type="date" 
                           id="date" 
                           name="date" 
                           value="{{ request('date', today()->format('Y-m-d')) }}"
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:text-white">
                </div>

                <div>
                    <label for="course" class="block text-sm font-medium text-dark dark:text-light mb-2">Course</label>
                    <select id="course" 
                            name="course" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:text-white">
                        <option value="">All Courses</option>
                        @if(isset($courses))
                            @foreach($courses as $course)
                                <option value="{{ $course }}" {{ request('course') == $course ? 'selected' : '' }}>
                                    {{ $course }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div>
                    <label for="year" class="block text-sm font-medium text-dark dark:text-light mb-2">Year</label>
                    <select id="year" 
                            name="year" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:text-white">
                        <option value="">All Years</option>
                        @if(isset($years))
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                    Year {{ $year }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div>
                    <label for="section" class="block text-sm font-medium text-dark dark:text-light mb-2">Section</label>
                    <select id="section" 
                            name="section" 
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:text-white">
                        <option value="">All Sections</option>
                        @if(isset($sections))
                            @foreach($sections as $section)
                                <option value="{{ $section }}" {{ request('section') == $section ? 'selected' : '' }}>
                                    {{ $section }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="sm:col-span-2 lg:col-span-2 flex flex-col sm:flex-row items-end space-y-2 sm:space-y-0 sm:space-x-2">
                    <button type="submit" 
                            class="w-full sm:flex-1 bg-gradient-to-r from-primary to-secondary hover:from-primary/90 hover:to-secondary/90 text-white font-bold py-2 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                        </svg>
                        <span>Apply Filters</span>
                    </button>
                    @if(request()->hasAny(['date', 'course', 'year', 'section']))
                        <a href="{{ route('attendance.index') }}" 
                           class="w-full sm:w-auto px-4 py-2 bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 font-medium rounded-lg transition-colors text-center">
                            Clear
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Attendance Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-primary/10">
        <!-- Desktop Table View -->
        <div class="hidden lg:block overflow-x-auto">
            <table class="min-w-full bg-white dark:bg-gray-800">
                <thead class="bg-gradient-to-r from-primary to-secondary text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Student</th>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Course & Section</th>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">AM Session</th>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">PM Session</th>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                    @if(isset($attendances))
                        @forelse($attendances as $attendance)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-r from-primary to-secondary flex items-center justify-center text-white font-bold text-sm">
                                                {{ substr($attendance->student->first_name, 0, 1) }}{{ substr($attendance->student->last_name, 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-dark dark:text-light">{{ $attendance->student->full_name }}</div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $attendance->student->student_id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-dark dark:text-light">
                                    <div class="font-medium">{{ $attendance->student->course }}</div>
                                    <div class="text-gray-500 dark:text-gray-400">Year {{ $attendance->student->year }} - {{ $attendance->student->section }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-dark dark:text-light font-medium">
                                    {{ $attendance->attendance_date->format('M d, Y') }}
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $attendance->attendance_date->format('l') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    <div class="space-y-1">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-xs text-gray-500 dark:text-gray-400 w-8">In:</span>
                                            <span class="font-mono {{ $attendance->am_time_in ? 'text-green-600 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}">
                                                {{ $attendance->am_time_in ? \Carbon\Carbon::parse($attendance->am_time_in)->format('H:i') : '--:--' }}
                                            </span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-xs text-gray-500 dark:text-gray-400 w-8">Out:</span>
                                            <span class="font-mono {{ $attendance->am_time_out ? 'text-red-600 dark:text-red-400' : 'text-gray-400 dark:text-gray-500' }}">
                                                {{ $attendance->am_time_out ? \Carbon\Carbon::parse($attendance->am_time_out)->format('H:i') : '--:--' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    <div class="space-y-1">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-xs text-gray-500 dark:text-gray-400 w-8">In:</span>
                                            <span class="font-mono {{ $attendance->pm_time_in ? 'text-green-600 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}">
                                                {{ $attendance->pm_time_in ? \Carbon\Carbon::parse($attendance->pm_time_in)->format('H:i') : '--:--' }}
                                            </span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-xs text-gray-500 dark:text-gray-400 w-8">Out:</span>
                                            <span class="font-mono {{ $attendance->pm_time_out ? 'text-red-600 dark:text-red-400' : 'text-gray-400 dark:text-gray-500' }}">
                                                {{ $attendance->pm_time_out ? \Carbon\Carbon::parse($attendance->pm_time_out)->format('H:i') : '--:--' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $hasAMIn = $attendance->am_time_in;
                                        $hasAMOut = $attendance->am_time_out;
                                        $hasPMIn = $attendance->pm_time_in;
                                        $hasPMOut = $attendance->pm_time_out;
                                        
                                        if ($hasAMIn && $hasAMOut && $hasPMIn && $hasPMOut) {
                                            $status = 'complete';
                                            $statusText = 'Complete';
                                            $statusColor = 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
                                        } elseif ($hasAMIn || $hasPMIn) {
                                            $status = 'partial';
                                            $statusText = 'Partial';
                                            $statusColor = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
                                        } else {
                                            $status = 'absent';
                                            $statusText = 'Absent';
                                            $statusColor = 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
                                        }
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor }}">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button class="bg-primary hover:bg-secondary text-white px-3 py-1 rounded-lg transition-colors text-xs">
                                            Edit
                                        </button>
                                        <button class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-lg transition-colors text-xs">
                                            View
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="text-gray-500 dark:text-gray-400">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-lg font-medium">No attendance records found</p>
                                        <p class="text-sm">Try adjusting your filters or scan a student ID to create records.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="text-gray-500 dark:text-gray-400">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="text-lg font-medium">No attendance records found</p>
                                    <p class="text-sm">Try adjusting your filters or scan a student ID to create records.</p>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="lg:hidden">
            @if(isset($attendances))
                @forelse($attendances as $attendance)
                    <div class="p-4 border-b border-gray-200 dark:border-gray-600 last:border-b-0">
                        <!-- Student Info Header -->
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-primary to-secondary flex items-center justify-center">
                                <span class="text-white font-bold text-lg">{{ substr($attendance->student->first_name, 0, 1) }}{{ substr($attendance->student->last_name, 0, 1) }}</span>
                            </div>
                            <div class="ml-3 flex-1">
                                <h3 class="text-lg font-semibold text-dark dark:text-light">{{ $attendance->student->full_name }}</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $attendance->student->student_id }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $attendance->student->course }} - Year {{ $attendance->student->year }} {{ $attendance->student->section }}</p>
                            </div>
                        </div>

                        <!-- Date and Status -->
                        <div class="flex justify-between items-center mb-4 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div>
                                <p class="text-sm font-medium text-dark dark:text-light">{{ $attendance->attendance_date->format('M d, Y') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $attendance->attendance_date->format('l') }}</p>
                            </div>
                            <div>
                                @php
                                    $hasAMIn = $attendance->am_time_in;
                                    $hasAMOut = $attendance->am_time_out;
                                    $hasPMIn = $attendance->pm_time_in;
                                    $hasPMOut = $attendance->pm_time_out;
                                    
                                    if ($hasAMIn && $hasAMOut && $hasPMIn && $hasPMOut) {
                                        $status = 'complete';
                                        $statusText = 'Complete';
                                        $statusColor = 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
                                    } elseif ($hasAMIn || $hasPMIn) {
                                        $status = 'partial';
                                        $statusText = 'Partial';
                                        $statusColor = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
                                    } else {
                                        $status = 'absent';
                                        $statusText = 'Absent';
                                        $statusColor = 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
                                    }
                                @endphp
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                    {{ $statusText }}
                                </span>
                            </div>
                        </div>

                        <!-- Time Records Grid -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <!-- AM Times -->
                            <div class="space-y-2">
                                <h4 class="text-sm font-semibold text-primary">Morning Session</h4>
                                <div class="space-y-2 text-xs">
                                    <div class="flex justify-between items-center p-2 bg-gray-50 dark:bg-gray-700 rounded">
                                        <span class="text-gray-600 dark:text-gray-400">Time In:</span>
                                        <span class="font-mono font-medium {{ $attendance->am_time_in ? 'text-green-600 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}">
                                            {{ $attendance->am_time_in ? \Carbon\Carbon::parse($attendance->am_time_in)->format('H:i') : '--:--' }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center p-2 bg-gray-50 dark:bg-gray-700 rounded">
                                        <span class="text-gray-600 dark:text-gray-400">Time Out:</span>
                                        <span class="font-mono font-medium {{ $attendance->am_time_out ? 'text-red-600 dark:text-red-400' : 'text-gray-400 dark:text-gray-500' }}">
                                            {{ $attendance->am_time_out ? \Carbon\Carbon::parse($attendance->am_time_out)->format('H:i') : '--:--' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- PM Times -->
                            <div class="space-y-2">
                                <h4 class="text-sm font-semibold text-secondary">Afternoon Session</h4>
                                <div class="space-y-2 text-xs">
                                    <div class="flex justify-between items-center p-2 bg-gray-50 dark:bg-gray-700 rounded">
                                        <span class="text-gray-600 dark:text-gray-400">Time In:</span>
                                        <span class="font-mono font-medium {{ $attendance->pm_time_in ? 'text-green-600 dark:text-green-400' : 'text-red-500 dark:text-red-400' }}">
                                            {{ $attendance->pm_time_in ? \Carbon\Carbon::parse($attendance->pm_time_in)->format('H:i') : '--:--' }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center p-2 bg-gray-50 dark:bg-gray-700 rounded">
                                        <span class="text-gray-600 dark:text-gray-400">Time Out:</span>
                                        <span class="font-mono font-medium {{ $attendance->pm_time_out ? 'text-red-600 dark:text-red-400' : 'text-gray-400 dark:text-gray-500' }}">
                                            {{ $attendance->pm_time_out ? \Carbon\Carbon::parse($attendance->pm_time_out)->format('H:i') : '--:--' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex space-x-2">
                            <button class="flex-1 bg-primary hover:bg-secondary text-white px-4 py-2 rounded-lg transition-colors text-sm font-medium">
                                Edit Record
                            </button>
                            <button class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors text-sm font-medium">
                                View Details
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No attendance records found</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Try adjusting your filters or scan a student ID to create records.</p>
                    </div>
                @endforelse
            @else
                <div class="p-8 text-center">
                    <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No attendance records found</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Try adjusting your filters or scan a student ID to create records.</p>
                </div>
            @endif
        </div>
    </div>
               
        <!-- Pagination -->
        @if(isset($attendances) && $attendances->hasPages())
            <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-t border-gray-200 dark:border-gray-600">
                {{ $attendances->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection