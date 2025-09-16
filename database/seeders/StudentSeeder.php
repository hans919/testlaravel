<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'rfid_tag' => 'RFID001',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'student_id' => 'STU001',
                'course' => 'Computer Science',
                'year' => 4,
                'section' => 'A',
                'email' => 'john.doe@example.com',
                'phone' => '09123456789',
                'status' => 'active'
            ],
            [
                'rfid_tag' => 'RFID002',
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'student_id' => 'STU002',
                'course' => 'Computer Science',
                'year' => 4,
                'section' => 'A',
                'email' => 'jane.smith@example.com',
                'phone' => '09123456790',
                'status' => 'active'
            ],
            [
                'rfid_tag' => 'RFID003',
                'first_name' => 'Mike',
                'last_name' => 'Johnson',
                'student_id' => 'STU003',
                'course' => 'Business Administration',
                'year' => 3,
                'section' => 'B',
                'email' => 'mike.johnson@example.com',
                'phone' => '09123456791',
                'status' => 'active'
            ],
            [
                'rfid_tag' => 'RFID004',
                'first_name' => 'Sarah',
                'last_name' => 'Williams',
                'student_id' => 'STU004',
                'course' => 'Business Administration',
                'year' => 3,
                'section' => 'B',
                'email' => 'sarah.williams@example.com',
                'phone' => '09123456792',
                'status' => 'active'
            ],
            [
                'rfid_tag' => 'RFID005',
                'first_name' => 'David',
                'last_name' => 'Brown',
                'student_id' => 'STU005',
                'course' => 'Engineering',
                'year' => 2,
                'section' => 'C',
                'email' => 'david.brown@example.com',
                'phone' => '09123456793',
                'status' => 'active'
            ]
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
