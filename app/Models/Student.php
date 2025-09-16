<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'rfid_tag',
        'first_name',
        'last_name',
        'student_id',
        'course',
        'year',
        'section',
        'email',
        'phone',
        'status'
    ];

    protected $casts = [
        'year' => 'integer',
    ];

    protected $appends = ['full_name'];

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(AttendanceRecord::class);
    }

    public function getTodayAttendance()
    {
        return $this->attendanceRecords()
            ->where('attendance_date', today())
            ->first();
    }
}
