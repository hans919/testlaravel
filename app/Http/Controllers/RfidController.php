<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\AttendanceRecord;
use Carbon\Carbon;

class RfidController extends Controller
{
    public function scan(Request $request)
    {
        $request->validate([
            'rfid_tag' => 'required|string',
        ]);

        $student = Student::where('rfid_tag', $request->rfid_tag)
            ->where('status', 'active')
            ->first();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'RFID tag not found or student inactive'
            ], 404);
        }

        $today = Carbon::today();
        $currentTime = Carbon::now();
        
        // Get or create today's attendance record
        $attendance = AttendanceRecord::firstOrCreate([
            'student_id' => $student->id,
            'attendance_date' => $today
        ]);

        // Determine AM/PM and In/Out
        $isAM = $currentTime->hour < 12;
        $action = $this->determineAction($attendance, $isAM);

        // Update the appropriate field
        if ($isAM) {
            if ($action === 'time_in') {
                $attendance->am_time_in = $currentTime->format('H:i:s');
            } else {
                $attendance->am_time_out = $currentTime->format('H:i:s');
            }
        } else {
            if ($action === 'time_in') {
                $attendance->pm_time_in = $currentTime->format('H:i:s');
            } else {
                $attendance->pm_time_out = $currentTime->format('H:i:s');
            }
        }

        $attendance->save();
        $attendance->updateStatus();

        return response()->json([
            'success' => true,
            'student' => $student,
            'attendance' => $attendance,
            'action' => $action,
            'session' => $isAM ? 'AM' : 'PM',
            'time' => $currentTime->format('H:i:s')
        ]);
    }

    private function determineAction($attendance, $isAM)
    {
        if ($isAM) {
            return $attendance->am_time_in ? 'time_out' : 'time_in';
        } else {
            return $attendance->pm_time_in ? 'time_out' : 'time_in';
        }
    }

    public function scanPage()
    {
        return view('rfid.scan');
    }
}
