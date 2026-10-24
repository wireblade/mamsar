<div>

    <div class="mx-auto max-w-5xl space-y-6 p-4 sm:p-6 lg:p-8">
        <a href="{{ route('attendance.index') }}"
            class="mb-2 inline-flex items-center gap-2 text-sm font-medium text-orange-600 hover:text-orange-700 dark:text-orange-400">
            <span aria-hidden="true">←</span>
            Back to Attendance Dashboard
        </a>
        @include('livewire.attendance.partials.navbar')

        {{-- Page Header --}}
        <div>

            <h1 class="mt-1 text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">
                Attendance Processor
            </h1>

            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                Upload your attendance Excel file and select the date range
                to process.
            </p>

            <div class="mt-4 flex flex-wrap gap-3">
                <a href="{{ route('attendance.cutoffs') }}"
                    class="inline-flex items-center gap-2 rounded-lg border border-zinc-300 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200 dark:hover:bg-zinc-800">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <rect x="3" y="4" width="18" height="17" rx="2" stroke-width="1.8" />
                        <path stroke-linecap="round" stroke-width="1.8" d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                    Cutoff History
                </a>

            </div>

        </div>

        {{-- Upload Form --}}
        <div
            class="rounded-2xl border border-zinc-200 bg-white p-5 shadow-sm sm:p-7 dark:border-zinc-800 dark:bg-zinc-900">

            <form wire:submit="processAttendance" class="space-y-6">

                {{-- Company Selection --}}
                <div>
                    <label for="company-code" class="mb-2 block text-sm font-medium text-zinc-800 dark:text-zinc-200">
                        Company
                    </label>

                    <select id="company-code" wire:model="companyCode"
                        class="w-full rounded-xl border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/20 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white">

                        <option value="MCIC">MCIC (Includes Zeman Marine)</option>
                        <option value="4KDC">4K Development Corporation (4KDC)</option>
                    </select>

                    @error('companyCode')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400">
                        Select the company associated with the uploaded biometric records.
                    </p>
                </div>


                {{-- Excel File --}}
                <div>
                    <label for="attendance-file"
                        class="mb-2 block text-sm font-medium text-zinc-800 dark:text-zinc-200">
                        Attendance Excel File
                    </label>

                    <input id="attendance-file" type="file" wire:model="file" accept=".xlsx,.xls"
                        class="block w-full rounded-xl border border-zinc-300 bg-white text-sm text-zinc-700 file:mr-4 file:border-0 file:bg-orange-50 file:px-4 file:py-3 file:font-medium file:text-orange-700 hover:file:bg-orange-100 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-300 dark:file:bg-zinc-800 dark:file:text-orange-300">

                    <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400">
                        Accepted formats: .xlsx and .xls. Maximum size: 20 MB.
                    </p>

                    @error('file')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div wire:loading wire:target="file" class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                        Uploading file...
                    </div>

                    @if ($file)
                        <p class="mt-2 text-sm text-emerald-600 dark:text-emerald-400">
                            Selected: {{ $file->getClientOriginalName() }}
                        </p>
                    @endif
                </div>

                {{-- Date Range --}}
                <div class="grid gap-5 sm:grid-cols-2">

                    <div>
                        <label for="start-date" class="mb-2 block text-sm font-medium text-zinc-800 dark:text-zinc-200">
                            Start Date
                        </label>

                        <input id="start-date" type="date" wire:model="startDate"
                            class="w-full rounded-xl border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/20 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white">

                        @error('startDate')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="end-date" class="mb-2 block text-sm font-medium text-zinc-800 dark:text-zinc-200">
                            End Date
                        </label>

                        <input id="end-date" type="date" wire:model="endDate"
                            class="w-full rounded-xl border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-500/20 dark:border-zinc-700 dark:bg-zinc-950 dark:text-white">

                        @error('endDate')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Shift Information --}}
                <div class="rounded-xl bg-zinc-50 p-4 dark:bg-zinc-800/60">
                    <h2 class="text-sm font-semibold text-zinc-900 dark:text-white">
                        Attendance Rules
                    </h2>

                    <ul class="mt-3 space-y-2 text-sm text-zinc-600 dark:text-zinc-300">
                        <li>
                            <span class="font-medium">DEFAULT:</span>
                            8:00 AM–12:00 PM and 1:00 PM–5:00 PM
                        </li>
                        <li>
                            <span class="font-medium">SHIFT_930:</span>
                            9:30 AM–12:00 PM and 1:00 PM–6:30 PM
                        </li>
                        <li>
                            <span class="font-medium">SHIFT_730:</span>
                            7:30 AM–12:00 PM and 1:00 PM–4:30 PM
                        </li>
                        <li>Morning grace period: 5 minutes.</li>
                        <li>Sundays are excluded from processing.</li>
                    </ul>
                </div>

                {{-- Submit --}}
                <div class="flex justify-end border-t border-zinc-200 pt-5 dark:border-zinc-800">
                    <button type="submit" wire:loading.attr="disabled" wire:target="processAttendance"
                        class="inline-flex items-center justify-center rounded-xl bg-orange-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-orange-700 disabled:cursor-not-allowed disabled:opacity-60">
                        <span wire:loading.remove wire:target="processAttendance">
                            Process Attendance
                        </span>

                        <span wire:loading wire:target="processAttendance">
                            Processing...
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>
