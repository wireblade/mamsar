<div class="mx-auto w-full max-w-full space-y-5 p-3 sm:space-y-6 sm:p-5 lg:p-8">

    {{-- Admin Navigation --}}
    @auth
        @if (auth()->user()->username === 'admin')
            @include('livewire.attendance.partials.navbar')
        @endif
    @endauth

    {{-- Flash Message --}}
    @if (session()->has('attendance_message'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition
            class="flex items-start justify-between gap-3 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 dark:border-green-800 dark:bg-green-900/30 dark:text-green-300">
            <span>{{ session('attendance_message') }}</span>

            <button type="button" @click="show = false" class="shrink-0 text-lg leading-none"
                aria-label="Dismiss notification">
                &times;
            </button>
        </div>
    @endif

    {{-- Header and Actions --}}
    <section class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        {{-- Header --}}
        <div class="min-w-0">
            <a href="{{ route('attendance.cutoffs') }}"
                class="inline-flex items-center gap-2 text-sm font-medium text-orange-600 hover:text-orange-700 dark:text-orange-400">
                <span aria-hidden="true">←</span>
                Back to cutoff list
            </a>

            <h1 class="mt-2 text-2xl font-bold tracking-tight text-zinc-900 sm:text-3xl dark:text-white">
                Attendance Report
            </h1>

            @if ($cutoff)
                <div class="mt-3 flex flex-wrap items-center gap-2">
                    <span
                        class="inline-flex rounded-full bg-orange-100 px-3 py-1 text-xs font-semibold text-orange-700 dark:bg-orange-900/30 dark:text-orange-300">
                        {{ $cutoff->company_code }}
                    </span>

                    <span class="text-sm text-zinc-600 dark:text-zinc-400">
                        {{ $cutoff->name }}
                        <span class="mx-1 text-orange-500">·</span>
                        {{ $startDate }} to {{ $endDate }}
                    </span>
                </div>
            @else
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                    View saved attendance records by cutoff period.
                </p>
            @endif
        </div>

        {{-- Actions --}}
        @if ($cutoff)
            <div class="grid shrink-0 grid-cols-1 gap-2 sm:flex sm:flex-wrap sm:items-center sm:justify-end">
                @auth
                    @if (auth()->user()->username === 'admin')
                        <button type="button" wire:click="exportExcel" wire:loading.attr="disabled"
                            wire:target="exportExcel"
                            class="inline-flex min-h-11 w-full items-center justify-center rounded-lg bg-green-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-green-700 disabled:cursor-not-allowed disabled:opacity-50 sm:w-auto">
                            <span wire:loading.remove wire:target="exportExcel">
                                Export to Excel
                            </span>
                            <span wire:loading wire:target="exportExcel">
                                Preparing Excel...
                            </span>
                        </button>
                    @endif
                @endauth

                <a href="{{ route('attendance.edit', ['cutoffId' => $cutoff->id]) }}"
                    class="inline-flex min-h-11 w-full items-center justify-center rounded-lg bg-orange-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-orange-700 sm:w-auto">
                    Edit Attendance Records
                </a>
            </div>
        @endif

    </section>

    @if (!$cutoff)

        {{-- No Cutoff Selected --}}
        <section
            class="rounded-xl border border-zinc-200 bg-white p-6 text-center sm:p-10 dark:border-zinc-800 dark:bg-zinc-900">
            <div
                class="mx-auto flex size-12 items-center justify-center rounded-full bg-orange-100 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400">
                <span class="text-xl" aria-hidden="true">📋</span>
            </div>

            <h2 class="mt-4 text-lg font-semibold text-zinc-900 dark:text-white">
                No attendance cutoff selected
            </h2>

            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                Select a saved cutoff period from Attendance History to view its records.
            </p>

            <a href="{{ route('attendance.cutoffs') }}"
                class="mt-5 inline-flex min-h-11 items-center justify-center rounded-lg bg-orange-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-orange-700">
                View Attendance History
            </a>
        </section>
    @else
        {{-- Summary Cards --}}
        {{-- <section class="grid grid-cols-2 gap-3 xl:grid-cols-4">
            <div
                class="min-w-0 rounded-xl border border-zinc-200 bg-white p-3 sm:p-4 dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-xs font-medium text-zinc-500 sm:text-sm dark:text-zinc-400">
                    Total Records
                </p>
                <p class="mt-2 text-2xl font-bold tabular-nums text-zinc-900 sm:text-3xl dark:text-white">
                    {{ $filteredResults->total() }}
                </p>
            </div>

            <div
                class="min-w-0 rounded-xl border border-zinc-200 bg-white p-3 sm:p-4 dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-xs font-medium text-zinc-500 sm:text-sm dark:text-zinc-400">
                    Present
                </p>
                <p class="mt-2 text-2xl font-bold tabular-nums text-green-600 sm:text-3xl dark:text-green-400">
                    {{ collect($filteredResults->items())->where('status', 'PRESENT')->count() }}
                </p>
            </div>

            <div
                class="min-w-0 rounded-xl border border-zinc-200 bg-white p-3 sm:p-4 dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-xs font-medium text-zinc-500 sm:text-sm dark:text-zinc-400">
                    Tardy
                </p>
                <p class="mt-2 text-2xl font-bold tabular-nums text-amber-600 sm:text-3xl dark:text-amber-400">
                    {{ collect($filteredResults->items())->where('status', 'TARDY')->count() }}
                </p>
            </div>

            <div
                class="min-w-0 rounded-xl border border-zinc-200 bg-white p-3 sm:p-4 dark:border-zinc-800 dark:bg-zinc-900">
                <p class="text-xs font-medium text-zinc-500 sm:text-sm dark:text-zinc-400">
                    Absent
                </p>
                <p class="mt-2 text-2xl font-bold tabular-nums text-red-600 sm:text-3xl dark:text-red-400">
                    {{ collect($filteredResults->items())->where('status', 'ABSENT')->count() }}
                </p>
            </div>
        </section> --}}

        {{-- Search and Status Filter --}}
        <section class="grid grid-cols-1 gap-3 sm:grid-cols-[minmax(0,1fr)_13rem]">
            <div class="relative min-w-0">
                <label for="attendance-search" class="sr-only">
                    Search attendance records
                </label>

                <input id="attendance-search" type="text" wire:model.live.debounce.300ms="search"
                    placeholder="Search employee name or AC-No..."
                    class="min-h-11 w-full rounded-lg border border-zinc-300 bg-white px-4 py-2.5 text-sm text-zinc-900 placeholder:text-zinc-400 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white">
            </div>

            <div class="min-w-0">
                <label for="attendance-status" class="sr-only">
                    Filter by attendance status
                </label>

                <select id="attendance-status" wire:model.live="statusFilter"
                    class="min-h-11 w-full rounded-lg border border-zinc-300 bg-white px-4 py-2.5 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white">
                    <option value="ALL">All Statuses</option>
                    <option value="PRESENT">Early</option>
                    <option value="TARDY">Late</option>
                    <option value="ABSENT">Absent</option>
                    <option value="INCOMPLETE">Incomplete</option>
                </select>
            </div>
        </section>

        {{-- Mobile Attendance Cards --}}
        <section class="space-y-3 lg:hidden">
            @forelse ($filteredResults as $row)
                @php
                    $statusClasses = match ($row['status']) {
                        'PRESENT' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                        'TARDY' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300',
                        'ABSENT' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                        'INCOMPLETE' => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300',
                        default => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300',
                    };
                @endphp

                <article wire:key="attendance-mobile-{{ $row['ac_no'] }}-{{ $row['date'] }}"
                    class="min-w-0 overflow-hidden rounded-xl border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                    {{-- Employee and Status --}}
                    <div class="flex items-start justify-between gap-3">
                        <div class="min-w-0">
                            <h2 class="break-words font-semibold text-zinc-900 dark:text-white">
                                {{ $row['name'] }}
                            </h2>

                            <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                                AC-No. {{ $row['ac_no'] }}
                            </p>

                            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                                {{ \Carbon\Carbon::parse($row['date'])->format('M d, Y') }}
                            </p>
                        </div>

                        <span
                            class="{{ $statusClasses }} shrink-0 rounded-full px-2.5 py-1 text-[10px] font-semibold sm:text-xs">
                            {{ $row['status'] }}
                        </span>
                    </div>

                    {{-- Main Metrics --}}
                    <div class="mt-4 grid grid-cols-2 gap-3">
                        <div class="rounded-lg bg-zinc-50 p-3 dark:bg-zinc-800/70">
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                Total Late
                            </p>
                            <p class="mt-1 text-lg font-semibold tabular-nums text-zinc-900 dark:text-white">
                                {{ $row['total_late_minutes'] }}
                                <span class="text-xs font-normal">min</span>
                            </p>
                        </div>

                        <div class="rounded-lg bg-zinc-50 p-3 dark:bg-zinc-800/70">
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                Minutes Worked
                            </p>
                            <p class="mt-1 text-lg font-semibold tabular-nums text-zinc-900 dark:text-white">
                                {{ $row['total_minutes_worked'] }}
                                <span class="text-xs font-normal">min</span>
                            </p>
                        </div>
                    </div>

                    {{-- Additional Details --}}
                    <div class="mt-4 space-y-2.5 text-sm">
                        <div class="flex items-center justify-between gap-3">
                            <span class="text-zinc-500 dark:text-zinc-400">
                                Late Morning
                            </span>
                            <span class="font-medium tabular-nums text-zinc-800 dark:text-zinc-200">
                                {{ $row['late_minutes_morning'] }} min
                            </span>
                        </div>

                        <div class="flex items-center justify-between gap-3">
                            <span class="text-zinc-500 dark:text-zinc-400">
                                Late Afternoon
                            </span>
                            <span class="font-medium tabular-nums text-zinc-800 dark:text-zinc-200">
                                {{ $row['late_minutes_afternoon'] }} min
                            </span>
                        </div>

                        <div class="flex items-center justify-between gap-3">
                            <span class="text-zinc-500 dark:text-zinc-400">
                                Half Day
                            </span>
                            <span class="font-medium text-zinc-800 dark:text-zinc-200">
                                {{ $row['is_half_day'] ? 'Yes' : 'No' }}
                            </span>
                        </div>
                    </div>

                    {{-- Clock Times --}}
                    <div class="mt-4 border-t border-zinc-200 pt-4 dark:border-zinc-800">
                        <p class="mb-3 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                            Clock Times
                        </p>

                        <div class="grid grid-cols-2 gap-x-4 gap-y-4">
                            @foreach ([
        'In 1' => 'clock_in_1',
        'Out 1' => 'clock_out_1',
        'In 2' => 'clock_in_2',
        'Out 2' => 'clock_out_2',
    ] as $label => $field)
                                <div class="min-w-0">
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                        {{ $label }}
                                    </p>
                                    <p
                                        class="mt-1 break-words font-medium tabular-nums text-zinc-800 dark:text-zinc-200">
                                        {{ $row[$field] ?: '—' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </article>
            @empty
                <div
                    class="rounded-xl border border-zinc-200 bg-white px-4 py-10 text-center dark:border-zinc-800 dark:bg-zinc-900">
                    <p class="font-medium text-zinc-700 dark:text-zinc-300">
                        No attendance records found
                    </p>
                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                        Try changing your search or status filter.
                    </p>
                </div>
            @endforelse
        </section>

        {{-- Desktop and Tablet Attendance Table --}}
        <section
            class="hidden rounded-xl border border-zinc-200 bg-white lg:block dark:border-zinc-800 dark:bg-zinc-900">
            <div>
                <table class="w-full min-w-[1400px] divide-y divide-zinc-200 text-sm dark:divide-zinc-800">
                    <thead class="sticky top-0 z-30 bg-zinc-50 dark:bg-zinc-800">
                        <tr
                            class="text-left text-xs font-semibold uppercase tracking-wider text-orange-500 dark:text-orange-400">
                            <th class="whitespace-nowrap px-4 py-3">AC-No.</th>
                            <th class="whitespace-nowrap px-4 py-3">Name</th>
                            <th class="whitespace-nowrap px-4 py-3">Date</th>
                            <th class="whitespace-nowrap px-4 py-3 text-center">Half Day</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right">Late Morning</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right">Late Afternoon</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right">Total Late</th>
                            <th class="whitespace-nowrap px-4 py-3 text-right">Minutes Worked</th>
                            <th class="whitespace-nowrap px-4 py-3">In 1</th>
                            <th class="whitespace-nowrap px-4 py-3">Out 1</th>
                            <th class="whitespace-nowrap px-4 py-3">In 2</th>
                            <th class="whitespace-nowrap px-4 py-3">Out 2</th>
                            <th class="whitespace-nowrap px-4 py-3">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        @forelse ($filteredResults as $row)
                            @php
                                $statusClasses = match ($row['status']) {
                                    'PRESENT' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                                    'TARDY' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300',
                                    'ABSENT' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                    'INCOMPLETE' => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300',
                                    default => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300',
                                };
                            @endphp

                            <tr wire:key="attendance-desktop-{{ $row['ac_no'] }}-{{ $row['date'] }}"
                                class="transition hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                                <td class="whitespace-nowrap px-4 py-3 font-medium text-zinc-900 dark:text-white">
                                    {{ $row['ac_no'] }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-zinc-700 dark:text-zinc-300">
                                    {{ $row['name'] }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-zinc-600 dark:text-zinc-400">
                                    {{ \Carbon\Carbon::parse($row['date'])->format('M d, Y') }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-center">
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
                                    <span class="{{ $statusClasses }} rounded-full px-2.5 py-1 text-xs font-medium">
                                        @if ($row['status'] == 'TARDY')
                                            LATE | PRESENT
                                        @elseif ($row['status'] == 'PRESENT' && !$row['is_half_day'])
                                            EARLY | PRESENT
                                        @else
                                            @if ($row['is_half_day'])
                                                <font class="text-blue-600 dark:text-blue-300">HALF DAY</font>
                                            @else
                                                {{ $row['status'] }}
                                            @endif
                                        @endif
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
        </section>

        {{-- Pagination: shared by both layouts --}}
        <div
            class="overflow-x-auto border-t border-zinc-200 px-1 py-3 text-xs text-zinc-600 dark:border-zinc-800 dark:text-zinc-400">
            {{ $filteredResults->links(data: ['scrollTo' => false]) }}
        </div>

    @endif
</div>
