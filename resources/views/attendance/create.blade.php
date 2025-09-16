<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manual Attendance Entry') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">Manual Attendance Entry</h1>
                        <a href="{{ route('attendance.index') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                            Back to Attendance
                        </a>
                    </div>

                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('attendance.store') }}" method="POST">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Basic Information -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Basic Information</h3>
                                
                                <div>
                                    <label for="student_id" class="block text-sm font-medium text-gray-700">Student</label>
                                    <select id="student_id" 
                                            name="student_id" 
                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                            required>
                                        <option value="">Select a student</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                                {{ $student->full_name }} ({{ $student->student_id }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="attendance_date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" 
                                           id="attendance_date" 
                                           name="attendance_date" 
                                           value="{{ old('attendance_date', today()->format('Y-m-d')) }}"
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                           required>
                                </div>

                                <div>
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Notes (Optional)</label>
                                    <textarea id="notes" 
                                              name="notes" 
                                              rows="3"
                                              placeholder="Any additional notes about this attendance record"
                                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('notes') }}</textarea>
                                </div>
                            </div>

                            <!-- Time Information -->
                            <div class="space-y-4">
                                <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Time Information</h3>
                                
                                <!-- AM Session -->
                                <div class="bg-blue-50 p-4 rounded-lg">
                                    <h4 class="text-md font-medium text-gray-800 mb-3">AM Session</h4>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="am_time_in" class="block text-sm font-medium text-gray-700">Time In</label>
                                            <input type="time" 
                                                   id="am_time_in" 
                                                   name="am_time_in" 
                                                   value="{{ old('am_time_in') }}"
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        </div>

                                        <div>
                                            <label for="am_time_out" class="block text-sm font-medium text-gray-700">Time Out</label>
                                            <input type="time" 
                                                   id="am_time_out" 
                                                   name="am_time_out" 
                                                   value="{{ old('am_time_out') }}"
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                    </div>
                                </div>

                                <!-- PM Session -->
                                <div class="bg-green-50 p-4 rounded-lg">
                                    <h4 class="text-md font-medium text-gray-800 mb-3">PM Session</h4>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="pm_time_in" class="block text-sm font-medium text-gray-700">Time In</label>
                                            <input type="time" 
                                                   id="pm_time_in" 
                                                   name="pm_time_in" 
                                                   value="{{ old('pm_time_in') }}"
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        </div>

                                        <div>
                                            <label for="pm_time_out" class="block text-sm font-medium text-gray-700">Time Out</label>
                                            <input type="time" 
                                                   id="pm_time_out" 
                                                   name="pm_time_out" 
                                                   value="{{ old('pm_time_out') }}"
                                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-yellow-50 p-3 rounded-lg">
                                    <p class="text-sm text-yellow-700">
                                        <strong>Note:</strong> Leave time fields empty if the student didn't attend that session. 
                                        The system will automatically determine the attendance status based on the times entered.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end space-x-4">
                            <a href="{{ route('attendance.index') }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancel
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                                Record Attendance
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
