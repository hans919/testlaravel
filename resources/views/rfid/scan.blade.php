@extends('layouts.app')

@section('title', 'RFID Scanner')

@section('content')
    <!-- Scanner Header -->
    <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl p-8 mb-8 text-white shadow-2xl">
        <div class="text-center">
            <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold mb-2">RFID Scanner</h1>
            <p class="text-white/90 text-lg">Scan or enter RFID tag to record attendance</p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto">
        <!-- Scanner Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8 mb-8 border border-primary/10">
            <form id="rfidForm" class="max-w-md mx-auto">
                @csrf
                <div class="mb-6">
                    <label for="rfid_tag" class="block text-sm font-medium text-dark dark:text-light mb-3">
                        RFID Tag
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="rfid_tag" 
                               name="rfid_tag" 
                               class="w-full px-4 py-4 text-lg border-2 border-primary/20 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-colors dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                               placeholder="Scan or enter RFID tag"
                               autofocus
                               autocomplete="off">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M12 12h-4.01M12 12v4m0 0h4.01M12 16h-4.01"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-primary to-secondary hover:from-primary/90 hover:to-secondary/90 text-white font-bold py-4 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Process Attendance
                </button>
            </form>
        </div>

        <!-- Results Display -->
        <div id="results" class="mb-8 hidden">
            <div id="success-message" class="hidden bg-green-50 border-l-4 border-green-400 text-green-700 p-6 rounded-lg mb-4 dark:bg-green-900/20 dark:border-green-400 dark:text-green-300">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-green-800 dark:text-green-200">Attendance Recorded Successfully!</h3>
                        <div class="mt-2 text-sm text-green-700 dark:text-green-300" id="success-details"></div>
                    </div>
                </div>
            </div>

            <div id="error-message" class="hidden bg-red-50 border-l-4 border-red-400 text-red-700 p-6 rounded-lg mb-4 dark:bg-red-900/20 dark:border-red-400 dark:text-red-300">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-100 dark:bg-red-800 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-red-800 dark:text-red-200">Error!</h3>
                        <div class="mt-2 text-sm text-red-700 dark:text-red-300" id="error-details"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Scans -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-primary/10">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-dark dark:text-light">Recent Scans</h3>
                <div class="w-3 h-3 bg-green-400 rounded-full animate-pulse"></div>
            </div>
            <div id="recent-scans" class="space-y-3">
                <div class="text-center py-8">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400">No recent scans</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('rfidForm');
            const rfidInput = document.getElementById('rfid_tag');
            const resultsDiv = document.getElementById('results');
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');
            const successDetails = document.getElementById('success-details');
            const errorDetails = document.getElementById('error-details');
            const recentScans = document.getElementById('recent-scans');

            const submitBtn = form.querySelector('button[type="submit"]');
            // Keep manual button visible but disabled while processing to show status
            if (submitBtn) {
                submitBtn.disabled = false; // start enabled for fallback
            }

            let debounceTimer = null;

            // Centralized processing function reused by submit handler and auto-submit
            function processTag(rfidTag) {
                if (!rfidTag) {
                    showError('Please enter an RFID tag');
                    return;
                }

                // Optimistic UI: show processing indicator in the results area
                if (resultsDiv) resultsDiv.classList.remove('hidden');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    var originalText = submitBtn.textContent;
                    submitBtn.textContent = 'Processing...';
                    submitBtn.classList.add('opacity-70', 'cursor-not-allowed');
                }

                // Send AJAX request
                fetch('{{ route("rfid.process") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ rfid_tag: rfidTag })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccess(data);
                        addToRecentScans(data);
                    } else {
                        showError(data.message || 'An error occurred');
                    }
                    rfidInput.value = '';
                    rfidInput.focus();
                    // Auto-clear results after a short time
                    setTimeout(() => {
                        if (resultsDiv) resultsDiv.classList.add('hidden');
                    }, 4000);
                })
                .catch(error => {
                    console.error('Error:', error);
                    showError('Network error occurred');
                    rfidInput.focus();
                });
                
                // Re-enable the submit button after request completes (best-effort)
                // Note: fetch is async; re-enable in both then/catch paths above. As a safety, also set a timeout.
                setTimeout(() => {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = originalText || 'Process Attendance';
                        submitBtn.classList.remove('opacity-70', 'cursor-not-allowed');
                    }
                }, 2500);
            }

            // Keep existing form submit as a fallback (hidden button)
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                processTag(rfidInput.value.trim());
            });

            // Auto-submit when user scans or stops typing (debounce)
            rfidInput.addEventListener('input', function() {
                const tag = rfidInput.value.trim();

                // if tag looks like it's complete (length heuristic), submit immediately
                if (tag.length >= 6 && tag.length <= 64 && /^[\w-]+$/.test(tag)) {
                    // very short delay to allow full tag to populate from fast scanners
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => processTag(tag), 60);
                    return;
                }

                clearTimeout(debounceTimer);
                // general input debounce (shortened for snappy auto-submit)
                debounceTimer = setTimeout(() => {
                    if (rfidInput.value.trim()) processTag(rfidInput.value.trim());
                }, 150);
            });

            // Also submit immediately on Enter key
            rfidInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(debounceTimer);
                    processTag(rfidInput.value.trim());
                }
            });

            function showSuccess(data) {
                resultsDiv.classList.remove('hidden');
                successMessage.classList.remove('hidden');
                errorMessage.classList.add('hidden');
                
                successDetails.innerHTML = `
                    <div class="font-semibold text-lg mb-2">${data.student.full_name}</div>
                    <div class="text-sm opacity-90">${data.student.course} - Year ${data.student.year} - ${data.student.section}</div>
                    <div class="mt-3 p-3 bg-green-100 dark:bg-green-800/50 rounded-lg">
                        <div class="font-medium">${data.action.replace('_', ' ').toUpperCase()}</div>
                        <div class="text-sm">${data.session} Session - ${data.time}</div>
                    </div>
                `;
            }

            function showError(message) {
                resultsDiv.classList.remove('hidden');
                errorMessage.classList.remove('hidden');
                successMessage.classList.add('hidden');
                errorDetails.textContent = message;
            }

            function addToRecentScans(data) {
                const scanEntry = document.createElement('div');
                scanEntry.className = 'flex justify-between items-center bg-primary/5 hover:bg-primary/10 dark:bg-gray-700 p-4 rounded-lg border border-primary/10 transition-colors';
                scanEntry.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary to-secondary rounded-full flex items-center justify-center">
                            <span class="text-white font-medium text-sm">${data.student.first_name.charAt(0)}${data.student.last_name.charAt(0)}</span>
                        </div>
                        <div>
                            <div class="font-medium text-dark dark:text-light">${data.student.full_name}</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">${data.student.course} - ${data.student.section}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-medium text-primary">${data.action.replace('_', ' ').toUpperCase()}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">${data.session} - ${data.time}</div>
                    </div>
                `;

                // Clear "no scans" message if present
                const noScansMessage = recentScans.querySelector('.text-center');
                if (noScansMessage) {
                    recentScans.innerHTML = '';
                }
                
                recentScans.insertBefore(scanEntry, recentScans.firstChild);
                
                // Keep only last 5 scans
                const scans = recentScans.querySelectorAll('div.flex');
                if (scans.length > 5) {
                    recentScans.removeChild(scans[scans.length - 1]);
                }
            }

            // Auto-focus on input when page loads
            rfidInput.focus();
        });
    </script>
@endsection
