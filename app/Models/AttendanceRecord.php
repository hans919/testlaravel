<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttendanceRecord extends Model
{
    protected $fillable = [
        'student_id',
        'attendance_date',
        'am_time_in',
        'am_time_out',
        'pm_time_in',
        'pm_time_out',
        'status',
        'notes'
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'am_time_in' => 'datetime:H:i',
        'am_time_out' => 'datetime:H:i',
        'pm_time_in' => 'datetime:H:i',
        'pm_time_out' => 'datetime:H:i',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function updateStatus()
    {
        $hasAM = $this->am_time_in || $this->am_time_out;
        $hasPM = $this->pm_time_in || $this->pm_time_out;
        
        if ($hasAM && $hasPM) {
            $this->status = 'present';
        } elseif ($hasAM || $hasPM) {
            $this->status = 'partial';
        } else {
            $this->status = 'absent';
        }
        
        $this->save();
    }
}
