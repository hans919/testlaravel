@extends('layouts.app')

@section('title', 'Add New Student')

@section('content')
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl p-8 mb-8 text-white shadow-2xl">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Add New Student</h1>
                <p class="text-white/90 text-lg">Create a new student record with RFID assignment</p>
            </div>
            <div class="hidden md:block">
                <a href="{{ route('students.index') }}" 
                   class="bg-white/20 hover:bg-white/30 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Back to Students</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Mobile Back Button -->
    <div class="md:hidden mb-6">
        <a href="{{ route('students.index') }}" 
           class="w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 flex items-center justify-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Back to Students</span>
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-4 rounded-lg mb-6 dark:bg-red-900/20 dark:border-red-400 dark:text-red-300">
            <div class="flex items-start">
                <svg class="w-5 h-5 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <div>
                    <h3 class="font-medium mb-2">Please fix the following errors:</h3>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Form Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-primary/10">
        <form action="{{ route('students.store') }}" method="POST" class="p-8">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Personal Information -->
                <div class="space-y-6">
                    <div class="border-l-4 border-primary pl-4">
                        <h3 class="text-xl font-bold text-dark dark:text-light mb-2">Personal Information</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Basic student details and contact information</p>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-dark dark:text-light mb-2">
                                First Name *
                            </label>
                            <input type="text" 
                                   id="first_name" 
                                   name="first_name" 
                                   value="{{ old('first_name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:text-white @error('first_name') border-red-500 @enderror" 
                                   placeholder="Enter first name"
                                   required>
                            @error('first_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="last_name" class="block text-sm font-medium text-dark dark:text-light mb-2">
                                Last Name *
                            </label>
                            <input type="text" 
                                   id="last_name" 
                                   name="last_name" 
                                   value="{{ old('last_name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:text-white @error('last_name') border-red-500 @enderror" 
                                   placeholder="Enter last name"
                                   required>
                            @error('last_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-dark dark:text-light mb-2">
                                Email Address *
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror" 
                                   placeholder="student@example.com"
                                   required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-dark dark:text-light mb-2">
                                Phone Number <span class="text-gray-500">(Optional)</span>
                            </label>
                            <input type="text" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:text-white @error('phone') border-red-500 @enderror"
                                   placeholder="+63 XXX XXX XXXX">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Academic Information -->
                <div class="space-y-6">
                    <div class="border-l-4 border-secondary pl-4">
                        <h3 class="text-xl font-bold text-dark dark:text-light mb-2">Academic Information</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Student ID, course details, and RFID assignment</p>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="student_id" class="block text-sm font-medium text-dark dark:text-light mb-2">
                                Student ID *
                            </label>
                            <input type="text" 
                                   id="student_id" 
                                   name="student_id" 
                                   value="{{ old('student_id') }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:text-white font-mono @error('student_id') border-red-500 @enderror" 
                                   placeholder="20XX-XXXXX"
                                   required>
                            @error('student_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="course" class="block text-sm font-medium text-dark dark:text-light mb-2">
                                Course *
                            </label>
                            <input type="text" 
                                   id="course" 
                                   name="course" 
                                   value="{{ old('course') }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:text-white @error('course') border-red-500 @enderror" 
                                   placeholder="e.g., Computer Science, Business Administration"
                                   required>
                            @error('course')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="year" class="block text-sm font-medium text-dark dark:text-light mb-2">
                                    Year Level *
                                </label>
                                <select id="year" 
                                        name="year" 
                                        class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:text-white @error('year') border-red-500 @enderror" 
                                        required>
                                    <option value="">Select Year</option>
                                    <option value="1" {{ old('year') == 1 ? 'selected' : '' }}>1st Year</option>
                                    <option value="2" {{ old('year') == 2 ? 'selected' : '' }}>2nd Year</option>
                                    <option value="3" {{ old('year') == 3 ? 'selected' : '' }}>3rd Year</option>
                                    <option value="4" {{ old('year') == 4 ? 'selected' : '' }}>4th Year</option>
                                    <option value="5" {{ old('year') == 5 ? 'selected' : '' }}>5th Year</option>
                                </select>
                                @error('year')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="section" class="block text-sm font-medium text-dark dark:text-light mb-2">
                                    Section *
                                </label>
                                <input type="text" 
                                       id="section" 
                                       name="section" 
                                       value="{{ old('section') }}"
                                       class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:text-white @error('section') border-red-500 @enderror" 
                                       placeholder="A, B, C, etc."
                                       required>
                                @error('section')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="rfid_tag" class="block text-sm font-medium text-dark dark:text-light mb-2">
                                RFID Tag *
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       id="rfid_tag" 
                                       name="rfid_tag" 
                                       value="{{ old('rfid_tag') }}"
                                       class="w-full px-4 py-3 pr-12 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:text-white font-mono @error('rfid_tag') border-red-500 @enderror" 
                                       placeholder="Scan or enter RFID tag"
                                       required>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M12 12h-4.01M12 12v4m0 0h4.01M12 16h-4.01"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                You can scan the RFID card or enter the tag manually
                            </p>
                            @error('rfid_tag')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-600 flex justify-end space-x-4">
                <a href="{{ route('students.index') }}" 
                   class="px-6 py-3 bg-gray-300 hover:bg-gray-400 dark:bg-gray-600 dark:hover:bg-gray-500 text-gray-800 dark:text-gray-200 font-medium rounded-lg transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-gradient-to-r from-primary to-secondary hover:from-primary/90 hover:to-secondary/90 text-white font-bold rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>Create Student</span>
                </button>
            </div>
        </form>
    </div>
@endsection
