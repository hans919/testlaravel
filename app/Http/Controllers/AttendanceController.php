<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AttendanceRecord;
use App\Models\Student;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AttendanceRecord::with('student');
        
        // Filter by date
        if ($request->has('date') && $request->date) {
            $query->where('attendance_date', $request->date);
        } else {
            $query->where('attendance_date', Carbon::today());
        }
        
        // Filter by course
        if ($request->has('course') && $request->course) {
            $query->whereHas('student', function($q) use ($request) {
                $q->where('course', $request->course);
            });
        }
        
        // Filter by year
        if ($request->has('year') && $request->year) {
            $query->whereHas('student', function($q) use ($request) {
                $q->where('year', $request->year);
            });
        }
        
        // Filter by section
        if ($request->has('section') && $request->section) {
            $query->whereHas('student', function($q) use ($request) {
                $q->where('section', $request->section);
            });
        }
        
        $attendances = $query->orderBy('attendance_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        $courses = Student::distinct()->pluck('course');
        $years = Student::distinct()->pluck('year')->sort();
        $sections = Student::distinct()->pluck('section');
        
        return view('attendance.index', compact('attendances', 'courses', 'years', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::where('status', 'active')->orderBy('last_name')->get();
        return view('attendance.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'attendance_date' => 'required|date',
            'am_time_in' => 'nullable|date_format:H:i',
            'am_time_out' => 'nullable|date_format:H:i',
            'pm_time_in' => 'nullable|date_format:H:i',
            'pm_time_out' => 'nullable|date_format:H:i',
            'notes' => 'nullable|string',
        ]);

        $attendance = AttendanceRecord::updateOrCreate([
            'student_id' => $validated['student_id'],
            'attendance_date' => $validated['attendance_date']
        ], $validated);

        $attendance->updateStatus();

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AttendanceRecord $attendance)
    {
        $attendance->load('student');
        return view('attendance.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttendanceRecord $attendance)
    {
        $students = Student::where('status', 'active')->orderBy('last_name')->get();
        return view('attendance.edit', compact('attendance', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AttendanceRecord $attendance)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'attendance_date' => 'required|date',
            'am_time_in' => 'nullable|date_format:H:i',
            'am_time_out' => 'nullable|date_format:H:i',
            'pm_time_in' => 'nullable|date_format:H:i',
            'pm_time_out' => 'nullable|date_format:H:i',
            'notes' => 'nullable|string',
        ]);

        $attendance->update($validated);
        $attendance->updateStatus();

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttendanceRecord $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance record deleted successfully.');
    }

    public function report(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth());
        
        $attendances = AttendanceRecord::with('student')
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->orderBy('attendance_date', 'desc')
            ->get();
        
        return view('attendance.report', compact('attendances', 'startDate', 'endDate'));
    }

    /**
     * Export attendances in CSV format for the given range.
     */
    public function exportCsv(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::now()->startOfMonth());
        $endDate = $request->get('end_date', Carbon::now()->endOfMonth());

        $attendances = AttendanceRecord::with('student')
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->orderBy('attendance_date', 'desc')
            ->get();

        $filename = 'attendance_' . Carbon::now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $columns = ['Student Full Name', 'Student ID', 'Course', 'Year', 'Section', 'Date', 'AM In', 'AM Out', 'PM In', 'PM Out'];

        $callback = function() use ($attendances, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($attendances as $att) {
                fputcsv($file, [
                    $att->student->full_name,
                    $att->student->student_id,
                    $att->student->course,
                    $att->student->year,
                    $att->student->section,
                    $att->attendance_date,
                    $att->am_time_in,
                    $att->am_time_out,
                    $att->pm_time_in,
                    $att->pm_time_out,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
