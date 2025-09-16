@extends('layouts.app')

@section('title', 'Attendance Report')

@section('content')
    <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl p-8 mb-8 text-white shadow-2xl">
        <div class="text-center">
            <h1 class="text-4xl font-bold mb-2">Attendance Report</h1>
            <p class="text-white/90 text-lg">Generate and view attendance records between two dates</p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto space-y-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-primary/10">
            <form method="GET" class="flex flex-col sm:flex-row items-center gap-3">
                <div class="w-full sm:w-auto">
                    <label class="block text-sm font-medium text-dark dark:text-light mb-1">Start Date</label>
                    <input type="date" name="start_date" value="{{ request('start_date', \Carbon\Carbon::parse($startDate)->format('Y-m-d')) }}" class="px-3 py-2 border rounded-md focus:ring-2 focus:ring-primary">
                </div>

                <div class="w-full sm:w-auto">
                    <label class="block text-sm font-medium text-dark dark:text-light mb-1">End Date</label>
                    <input type="date" name="end_date" value="{{ request('end_date', \Carbon\Carbon::parse($endDate)->format('Y-m-d')) }}" class="px-3 py-2 border rounded-md focus:ring-2 focus:ring-primary">
                </div>

                <div class="mt-3 sm:mt-0 flex items-center space-x-2">
                    <button type="submit" class="bg-primary hover:bg-secondary text-white px-4 py-2 rounded-md">Apply</button>
                    <a href="{{ route('attendance.export', ['start_date' => request('start_date', \Carbon\Carbon::parse($startDate)->format('Y-m-d')), 'end_date' => request('end_date', \Carbon\Carbon::parse($endDate)->format('Y-m-d'))]) }}" class="inline-flex items-center px-4 py-2 bg-white border border-primary/10 rounded-md text-sm text-dark hover:bg-primary/5">Download CSV</a>
                </div>
            </form>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-primary/10 overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">Student</th>
                        <th class="px-4 py-3 text-left">Course</th>
                        <th class="px-4 py-3 text-left">Date</th>
                        <th class="px-4 py-3 text-left">AM In</th>
                        <th class="px-4 py-3 text-left">AM Out</th>
                        <th class="px-4 py-3 text-left">PM In</th>
                        <th class="px-4 py-3 text-left">PM Out</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                    @forelse($attendances as $att)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3">
                                <div class="font-medium text-dark dark:text-light">{{ $att->student->full_name }}</div>
                                <div class="text-sm text-gray-500">{{ $att->student->student_id }}</div>
                            </td>
                            <td class="px-4 py-3 text-sm text-dark dark:text-light">{{ $att->student->course }} - Year {{ $att->student->year }} {{ $att->student->section }}</td>
                            <td class="px-4 py-3 text-sm text-dark dark:text-light">{{ \Carbon\Carbon::parse($att->attendance_date)->format('M d, Y') }}</td>
                            <td class="px-4 py-3 text-sm">{{ $att->am_time_in ?? '--:--' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $att->am_time_out ?? '--:--' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $att->pm_time_in ?? '--:--' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $att->pm_time_out ?? '--:--' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">No records found for the selected range.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
