<div class="mx-auto max-w-full space-y-6 p-4 sm:p-6 lg:p-8">

    @if (session()->has('attendance_message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
            class="flex items-center justify-between rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800 dark:border-green-800 dark:bg-green-900/30 dark:text-green-300">

            <span>{{ session('attendance_message') }}</span>

            <button type="button" @click="show = false"
                class="ml-4 text-green-700 hover:text-green-900 dark:text-green-300" aria-label="Dismiss notification">
                &times;
            </button>
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">
                Attendance Report
            </h1>

            @if ($cutoff)
                <div class="mt-2 flex flex-wrap items-center gap-2">
                    <span
                        class="inline-flex rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700 dark:bg-orange-900/30 dark:text-orange-300">
                        {{ $cutoff->company_code }}
                    </span>

                    <span class="text-sm text-zinc-600 dark:text-zinc-400">
                        {{ $cutoff->name }}
                        <span class="mx-1">·</span>
                        {{ $startDate }} to {{ $endDate }}
                    </span>
                </div>
            @else
                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                    View saved attendance records by cutoff period.
                </p>
            @endif
        </div>

        <div class="flex flex-wrap items-center gap-3">

            @if ($cutoff)
                <button type="button" wire:click="exportExcel" wire:loading.attr="disabled" wire:target="exportExcel"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-green-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-green-700 disabled:cursor-not-allowed disabled:opacity-50">
                    <span wire:loading.remove wire:target="exportExcel">
                        Export to Excel
                    </span>

                    <span wire:loading wire:target="exportExcel">
                        Preparing Excel...
                    </span>
                </button>
            @endif

            <a href="{{ route('attendance.cutoffs') }}"
                class="inline-flex items-center justify-center rounded-lg border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800">
                Attendance History
            </a>

        </div>
    </div>

    @if (!$cutoff)

        {{-- No cutoff selected --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-8 text-center dark:border-zinc-800 dark:bg-zinc-900">
            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">
                No attendance cutoff selected
            </h2>

            <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                Select a saved cutoff period from Attendance History to view its records.
            </p>

            <a href="{{ route('attendance.cutoffs') }}"
                class="mt-5 inline-flex rounded-lg bg-orange-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-orange-700">
                View Attendance History
            </a>
        </div>
    @else
        {{-- Summary cards --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

            <div class="h-10 rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                    <font class="p-2">Total Records</font>

                    <font class="p-3 text-2xl font-semibold text-zinc-900 dark:text-white">
                        {{ count($filteredResults) }}
                    </font>
                </p>
            </div>

            <div class="h-10 rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                    <font class="p-2">Present</font>

                    <font class="p-3 text-2xl font-semibold text-green-600 dark:text-green-400">
                        {{ count($filteredResults) }}
                    </font>
                </p>

            </div>

            <div class="h-10 rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                    <font class="p-2">Tardy</font>

                    <font class="p-3 text-2xl font-semibold text-amber-600 dark:text-amber-400">
                        {{ collect($filteredResults)->where('status', 'TARDY')->count() }}
                    </font>
                </p>

            </div>

            <div class="h-10 rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                    <font class="p-2">Absent</font>

                    <font class="p-3 text-2xl font-semibold text-red-600 dark:text-red-400">
                        {{ collect($filteredResults)->where('status', 'ABSENT')->count() }}
                    </font>
                </p>
            </div>

        </div>

        {{-- Filters --}}
        <div class="flex flex-col gap-3 sm:flex-row">
            <div class="flex-1">
                <input type="text" wire:model.live.debounce.300ms="search"
                    placeholder="Search employee name or AC-No..."
                    class="w-full rounded-lg border border-zinc-300 bg-white px-4 py-2.5 text-sm text-zinc-900 placeholder:text-zinc-400 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white">
            </div>

            <div class="sm:w-52">
                <select wire:model.live="statusFilter"
                    class="w-full rounded-lg border border-zinc-300 bg-white px-4 py-2.5 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white">
                    <option value="ALL">All Statuses</option>
                    <option value="PRESENT">Present</option>
                    <option value="TARDY">Tardy</option>
                    <option value="ABSENT">Absent</option>
                    <option value="INCOMPLETE">Incomplete</option>
                </select>
            </div>
        </div>

        {{-- Attendance table --}}
        <div class="rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
            <div class="max-h-[70vh] overflow-auto">
                <table class="w-full min-w-[1400px] divide-y divide-zinc-200 text-sm dark:divide-zinc-800">

                    <thead class="sticky top-0 z-30 bg-zinc-50 dark:bg-zinc-800">
                        <tr
                            class="text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                            <th class="px-4 py-3">AC-No.</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3 text-center">Half Day</th>
                            <th class="px-4 py-3 text-right">Late Morning</th>
                            <th class="px-4 py-3 text-right">Late Afternoon</th>
                            <th class="px-4 py-3 text-right">Total Late</th>
                            <th class="px-4 py-3 text-right">Minutes Worked</th>
                            <th class="px-4 py-3">In 1</th>
                            <th class="px-4 py-3">Out 1</th>
                            <th class="px-4 py-3">In 2</th>
                            <th class="px-4 py-3">Out 2</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse ($filteredResults as $row)
                            <tr class="transition hover:bg-zinc-50 dark:hover:bg-zinc-800/50">

                                <td class="whitespace-nowrap px-4 py-3 font-medium text-zinc-900 dark:text-white">
                                    {{ $row['ac_no'] }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 text-zinc-700 dark:text-zinc-300">
                                    {{ $row['name'] }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 text-zinc-600 dark:text-zinc-400">
                                    {{ \Carbon\Carbon::parse($row['date'])->format('M d, Y') }}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    @if ($row['is_half_day'])
                                        <span
                                            class="rounded-full bg-amber-100 px-2 py-1 text-xs font-medium text-amber-700 dark:bg-amber-900/30 dark:text-amber-300">
                                            Yes
                                        </span>
                                    @else
                                        <span class="text-zinc-400">—</span>
                                    @endif
                                </td>

                                <td
                                    class="whitespace-nowrap px-4 py-3 text-right tabular-nums text-zinc-700 dark:text-zinc-300">
                                    {{ $row['late_minutes_morning'] }} min
                                </td>

                                <td
                                    class="whitespace-nowrap px-4 py-3 text-right tabular-nums text-zinc-700 dark:text-zinc-300">
                                    {{ $row['late_minutes_afternoon'] }} min
                                </td>

                                <td
                                    class="whitespace-nowrap px-4 py-3 text-right font-medium tabular-nums text-zinc-900 dark:text-white">
                                    {{ $row['total_late_minutes'] }} min
                                </td>

                                <td
                                    class="whitespace-nowrap px-4 py-3 text-right tabular-nums text-zinc-700 dark:text-zinc-300">
                                    {{ $row['total_minutes_worked'] }} min
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 text-zinc-600 dark:text-zinc-400">
                                    {{ $row['clock_in_1'] ?: '—' }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 text-zinc-600 dark:text-zinc-400">
                                    {{ $row['clock_out_1'] ?: '—' }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 text-zinc-600 dark:text-zinc-400">
                                    {{ $row['clock_in_2'] ?: '—' }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 text-zinc-600 dark:text-zinc-400">
                                    {{ $row['clock_out_2'] ?: '—' }}
                                </td>

                                <td class="whitespace-nowrap px-4 py-3">
                                    @php
                                        $statusClasses = match ($row['status']) {
                                            'PRESENT'
                                                => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                                            'TARDY'
                                                => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300',
                                            'ABSENT' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                            'INCOMPLETE'
                                                => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300',
                                            default => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300',
                                        };
                                    @endphp

                                    <span class="{{ $statusClasses }} rounded-full px-2.5 py-1 text-xs font-medium">
                                        {{ $row['status'] }}
                                    </span>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="px-4 py-12 text-center">
                                    <p class="font-medium text-zinc-700 dark:text-zinc-300">
                                        No attendance records found
                                    </p>
                                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                        Try changing your search or status filter.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div
                class="border-t border-zinc-200 px-4 py-3 text-xs text-zinc-500 dark:border-zinc-800 dark:text-zinc-400">
                Showing {{ count($filteredResults) }} record(s)
            </div>
        </div>

    @endif

</div>
