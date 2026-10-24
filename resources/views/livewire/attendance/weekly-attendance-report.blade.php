<div>

    <div class="mx-auto max-w-full space-y-6 p-4 sm:p-6 lg:p-8">
        @auth
            @if (auth()->user()->username === 'admin')
                @include('livewire.attendance.partials.navbar')
            @endif
        @endauth
        @if (session()->has('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition:leave.duration.300ms
                class="mb-4 flex items-center justify-between rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 dark:border-green-800 dark:bg-green-900/20 dark:text-green-300"
                role="status">
                <div class="flex items-center gap-2">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>

                    <span>{{ session('success') }}</span>
                </div>

                <button type="button" @click="show = false"
                    class="ml-4 rounded p-1 hover:bg-green-100 dark:hover:bg-green-800/40"
                    aria-label="Dismiss notification">
                    &times;
                </button>
            </div>
        @endif

        {{-- Header --}}
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <a href="{{ route('attendance.index') }}"
                    class="mb-2 inline-flex items-center gap-2 text-sm font-medium text-orange-600 hover:text-orange-700 dark:text-orange-400">
                    <span aria-hidden="true">←</span>
                    Back to Attendance Dashboard
                </a>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">
                    Weekly Attendance Report
                </h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    View saved weekly attendance records by company.
                </p>
            </div>

        </div>

        {{-- Company selector --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-5 dark:border-zinc-700 dark:bg-zinc-900">
            <label for="companyCode" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                Company
            </label>

            <select id="companyCode" wire:model.live="companyCode"
                class="w-full max-w-md rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm dark:border-zinc-600 dark:bg-zinc-800 dark:text-white">
                <option value="MCIC">MCIC</option>
                <option value="4KDC">4K Development Corporation (4KDC)</option>
            </select>
        </div>


        {{-- Saved weeks list --}}
        @if (!$week)
            <div
                class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
                <div class="border-b border-zinc-200 p-5 dark:border-zinc-700">
                    <h2 class="font-semibold text-zinc-900 dark:text-white">
                        Saved Weeks — {{ $companyCode }}
                    </h2>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                        Select a week to view its attendance records.
                    </p>
                </div>

                @if ($weeks->isNotEmpty())
                    <div class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @foreach ($weeks as $savedWeek)
                            <button type="button" wire:key="weekly-attendance-week-{{ $savedWeek->id }}"
                                wire:click="openWeek({{ $savedWeek->id }})"
                                class="flex w-full items-center justify-between gap-4 px-5 py-4 text-left transition hover:bg-zinc-50 dark:hover:bg-zinc-800/60">
                                <div>
                                    <p class="font-medium text-zinc-900 dark:text-white">
                                        {{ \Carbon\Carbon::parse($savedWeek->start_date)->format('M d, Y') }}
                                        –
                                        {{ \Carbon\Carbon::parse($savedWeek->end_date)->format('M d, Y') }}
                                    </p>
                                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                        {{ $savedWeek->records_count }}
                                        {{ \Illuminate\Support\Str::plural('record', $savedWeek->records_count) }}
                                    </p>
                                </div>

                                <span
                                    class="inline-flex items-center gap-2 text-sm font-medium text-orange-600 dark:text-orange-400">
                                    View report
                                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M7.21 14.77a.75.75 0 0 1 .02-1.06L10.94 10 7.23 6.29a.75.75 0 1 1 1.06-1.06l4.24 4.24a.75.75 0 0 1 0 1.06l-4.24 4.24a.75.75 0 0 1-1.08 0Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>
                        @endforeach
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <h3 class="font-semibold text-zinc-900 dark:text-white">
                            No saved weeks found
                        </h3>
                        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                            Upload attendance for {{ $companyCode }} to create a weekly report.
                        </p>
                    </div>
                @endif
            </div>

            {{-- Selected week report --}}
        @else
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-zinc-900 dark:text-white">
                        {{ $companyCode }} Attendance
                    </h2>

                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                        {{ \Carbon\Carbon::parse($week->start_date)->format('M d, Y') }}
                        –
                        {{ \Carbon\Carbon::parse($week->end_date)->format('M d, Y') }}
                    </p>
                </div>

                @auth
                    @if (auth()->user()->username === 'admin')
                        <button type="button" wire:click="exportExcel" wire:loading.attr="disabled"
                            wire:target="exportExcel"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-green-700 disabled:cursor-not-allowed disabled:opacity-50">
                            <span wire:loading.remove wire:target="exportExcel">
                                Export Excel
                            </span>

                            <span wire:loading wire:target="exportExcel">
                                Exporting...
                            </span>
                        </button>
                    @endif
                @endauth
            </div>


            <div
                class="overflow-hidden rounded-xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                <div class="border-b border-zinc-200 p-5 dark:border-zinc-700">
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">
                        {{ $records->total() }} saved records
                    </p>
                </div>

                @if ($records->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-zinc-200 text-sm dark:divide-zinc-700">

                            <thead class="bg-zinc-50 dark:bg-zinc-800">
                                <tr
                                    class="text-left text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                                    <th class="whitespace-nowrap px-4 py-3">AC-No.</th>
                                    <th class="whitespace-nowrap px-4 py-3">Name</th>
                                    <th class="whitespace-nowrap px-4 py-3">Date</th>
                                    <th class="whitespace-nowrap px-4 py-3">Half Day</th>
                                    <th class="whitespace-nowrap px-4 py-3">Late Morning</th>
                                    <th class="whitespace-nowrap px-4 py-3">Late Afternoon</th>
                                    <th class="whitespace-nowrap px-4 py-3">Total Late</th>
                                    <th class="whitespace-nowrap px-4 py-3">Minutes Worked</th>
                                    <th class="whitespace-nowrap px-4 py-3">In 1</th>
                                    <th class="whitespace-nowrap px-4 py-3">Out 1</th>
                                    <th class="whitespace-nowrap px-4 py-3">In 2</th>
                                    <th class="whitespace-nowrap px-4 py-3">Out 2</th>
                                    <th class="whitespace-nowrap px-4 py-3">Status</th>
                                    @auth
                                        @if (auth()->user()->username === 'admin')
                                            <th class="px-4 py-3 text-right">Action</th>
                                        @endif
                                    @endauth
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                                @foreach ($records as $record)
                                    <tr wire:key="weekly-attendance-record-{{ $record->id }}"
                                        class="text-zinc-700 hover:bg-zinc-50 dark:text-zinc-300 dark:hover:bg-zinc-800/50">
                                        <td class="whitespace-nowrap px-4 py-3">{{ $record->ac_no }}</td>
                                        <td class="whitespace-nowrap px-4 py-3 font-medium">
                                            {{ $record->employee_name }}</td>
                                        <td class="whitespace-nowrap px-4 py-3">
                                            {{ $record->attendance_date->format('M d, Y') }}</td>
                                        <td class="whitespace-nowrap px-4 py-3">
                                            {{ $record->is_half_day ? 'Yes' : 'No' }}</td>
                                        <td class="whitespace-nowrap px-4 py-3">{{ $record->late_minutes_morning }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3">{{ $record->late_minutes_afternoon }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3">{{ $record->total_late_minutes }}</td>
                                        <td class="whitespace-nowrap px-4 py-3">{{ $record->total_minutes_worked }}
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3">{{ $record->clock_in_1 ?? '—' }}</td>
                                        <td class="whitespace-nowrap px-4 py-3">{{ $record->clock_out_1 ?? '—' }}</td>
                                        <td class="whitespace-nowrap px-4 py-3">{{ $record->clock_in_2 ?? '—' }}</td>
                                        <td class="whitespace-nowrap px-4 py-3">{{ $record->clock_out_2 ?? '—' }}</td>
                                        <td class="whitespace-nowrap px-4 py-3">{{ $record->status ?? '—' }}</td>
                                        @auth
                                            @if (auth()->user()->username === 'admin')
                                                <td class="px-4 py-3 text-right">
                                                    <button type="button" wire:click="editRecord({{ $record->id }})"
                                                        class="rounded-lg bg-orange-500 px-3 py-2 text-sm font-medium text-white hover:bg-orange-600">
                                                        Edit
                                                    </button>
                                                </td>
                                            @endif
                                        @endauth
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>


                        {{-- Edit Attendance Modal --}}
                        @if ($editingRecordId)
                            <div class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-zinc-950/50 p-4 backdrop-blur-sm"
                                wire:key="weekly-attendance-edit-modal">
                                <div class="my-auto w-full max-w-xl overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-black/5 dark:bg-zinc-900 dark:ring-white/10"
                                    role="dialog" aria-modal="true" aria-labelledby="weekly-edit-title">
                                    {{-- Modal Header --}}
                                    <div class="border-b border-zinc-200 px-6 py-5 dark:border-zinc-700">
                                        <div class="flex items-start justify-between gap-4">
                                            <div>
                                                <p
                                                    class="text-xs font-semibold uppercase tracking-wider text-orange-600">
                                                    Weekly Attendance
                                                </p>

                                                <h2 id="weekly-edit-title"
                                                    class="mt-1 text-xl font-semibold text-zinc-900 dark:text-white">
                                                    Edit Time Records
                                                </h2>

                                                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                                    Correct the employee's recorded punch times.
                                                </p>
                                            </div>

                                            <button type="button" wire:click="cancelEdit"
                                                aria-label="Close edit dialog"
                                                class="rounded-lg p-2 text-zinc-500 hover:bg-zinc-100 hover:text-zinc-800 dark:hover:bg-zinc-800 dark:hover:text-white">
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="1.8">
                                                    <path stroke-linecap="round" d="m6 6 12 12M18 6 6 18" />
                                                </svg>
                                            </button>
                                        </div>

                                        {{-- Employee Details --}}
                                        <div class="mt-5 rounded-xl bg-zinc-50 p-4 dark:bg-zinc-800/70">
                                            <p class="font-semibold text-zinc-900 dark:text-white">
                                                {{ $editingEmployeeName }}
                                            </p>

                                            <div
                                                class="mt-2 flex flex-wrap gap-x-5 gap-y-1 text-sm text-zinc-500 dark:text-zinc-400">
                                                <span>
                                                    <span class="font-medium">AC-No.:</span>
                                                    {{ $editingAcNo }}
                                                </span>

                                                <span>
                                                    <span class="font-medium">Date:</span>
                                                    {{ $editingDate }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal Form --}}
                                    <form wire:submit="saveRecord">
                                        <div class="space-y-5 px-6 py-6">
                                            <div>
                                                <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">
                                                    Time punches
                                                </h3>
                                                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                                    Leave a field empty if no punch was recorded.
                                                </p>
                                            </div>

                                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                                {{-- Morning In --}}
                                                <div>
                                                    <label for="clockIn1"
                                                        class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                                        In 1
                                                    </label>

                                                    <input id="clockIn1" type="time" wire:model="clockIn1"
                                                        class="block w-full rounded-xl border border-zinc-300 bg-white px-3 py-3 text-base text-zinc-900 outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white" />

                                                    @error('clockIn1')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                {{-- Morning Out --}}
                                                <div>
                                                    <label for="clockOut1"
                                                        class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                                        Out 1
                                                    </label>

                                                    <input id="clockOut1" type="time" wire:model="clockOut1"
                                                        class="block w-full rounded-xl border border-zinc-300 bg-white px-3 py-3 text-base text-zinc-900 outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white" />

                                                    @error('clockOut1')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                {{-- Afternoon In --}}
                                                <div>
                                                    <label for="clockIn2"
                                                        class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                                        In 2
                                                    </label>

                                                    <input id="clockIn2" type="time" wire:model="clockIn2"
                                                        class="block w-full rounded-xl border border-zinc-300 bg-white px-3 py-3 text-base text-zinc-900 outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white" />

                                                    @error('clockIn2')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                {{-- Afternoon Out --}}
                                                <div>
                                                    <label for="clockOut2"
                                                        class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                                        Out 2
                                                    </label>

                                                    <input id="clockOut2" type="time" wire:model="clockOut2"
                                                        class="block w-full rounded-xl border border-zinc-300 bg-white px-3 py-3 text-base text-zinc-900 outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white" />

                                                    @error('clockOut2')
                                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <p class="text-xs leading-5 text-zinc-500 dark:text-zinc-400">
                                                Attendance totals, lateness, half-day status, and attendance status are
                                                recalculated when you save.
                                            </p>
                                        </div>

                                        {{-- Modal Footer --}}
                                        <div
                                            class="flex flex-col-reverse gap-3 border-t border-zinc-200 bg-zinc-50 px-6 py-4 sm:flex-row sm:justify-end dark:border-zinc-700 dark:bg-zinc-800/40">
                                            <button type="button" wire:click="cancelEdit"
                                                class="rounded-xl border border-zinc-300 px-5 py-2.5 text-sm font-semibold text-zinc-700 hover:bg-white dark:border-zinc-600 dark:text-zinc-200 dark:hover:bg-zinc-800">
                                                Cancel
                                            </button>

                                            <button type="submit" wire:loading.attr="disabled"
                                                wire:target="saveRecord"
                                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-orange-500 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-orange-600 disabled:cursor-not-allowed disabled:opacity-60">
                                                <span wire:loading.remove wire:target="saveRecord">
                                                    Save Changes
                                                </span>

                                                <span wire:loading wire:target="saveRecord">
                                                    Saving changes...
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif


                    </div>

                    <div class="border-t border-zinc-200 p-4 dark:border-zinc-700">
                        {{ $records->links(data: ['scrollTo' => false]) }}
                    </div>
                @else
                    <div class="px-6 py-12 text-center">
                        <h3 class="font-semibold text-zinc-900 dark:text-white">
                            No attendance records found
                        </h3>
                        <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                            This saved week has no attendance records.
                        </p>
                    </div>
                @endif
            </div>
        @endif

    </div>
</div>
