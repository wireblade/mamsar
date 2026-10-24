<div>
    <div class="mx-auto max-w-full space-y-6 p-4 sm:p-6 lg:p-8">

        @include('livewire.attendance.partials.navbar')
        @if (session()->has('success'))
            <div
                class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 dark:border-green-900 dark:bg-green-950 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif
        {{-- Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                @if ($this->cutoff)
                    <a href="{{ route('attendance.report', ['cutoff' => $this->cutoff->id]) }}"
                        class="mb-2 inline-flex items-center gap-2 text-sm font-medium text-orange-600 hover:text-orange-700 dark:text-orange-400">
                        <span aria-hidden="true">←</span>
                        Back to {{ $this->cutoff->company_code }}
                        ({{ $this->cutoff->start_date->format('M d, Y') }}
                        - {{ $this->cutoff->end_date->format('M d, Y') }})
                    </a>
                @else
                    <a href="{{ route('attendance.cutoffs') }}"
                        class="mb-2 inline-flex items-center gap-2 text-sm font-medium text-orange-600 hover:text-orange-700 dark:text-orange-400">
                        <span aria-hidden="true">←</span>
                        Back to cutoff list
                    </a>
                @endif
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">
                    Attendance Time Editor
                </h1>

                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    View attendance records and correct employee clock-in and clock-out times.
                </p>
            </div>
        </div>

        {{-- Filters --}}
        <div
            class="grid grid-cols-1 gap-4 rounded-xl border border-zinc-200 bg-white p-4 sm:grid-cols-2 dark:border-zinc-800 dark:bg-zinc-900">

            {{-- <div>
                <label for="cutoffId" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                    Select Cutoff
                </label>

                <select id="cutoffId" wire:model.live="cutoffId"
                    class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 focus:border-orange-500 focus:ring-orange-500 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                    <option value="">Choose an attendance cutoff</option>

                    @foreach ($cutoffs as $cutoff)
                        <option value="{{ $cutoff->id }}">
                            {{ $cutoff->company_code }} — {{ $cutoff->name }}
                        </option>
                    @endforeach
                </select>
            </div> --}}

            <div>
                <label for="search" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                    Search Employee
                </label>

                <input id="search" type="text" wire:model.live.debounce.300ms="search"
                    placeholder="Enter AC-No. or employee name..." @disabled($cutoffId === '')
                    class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 placeholder:text-zinc-400 focus:border-orange-500 focus:ring-orange-500 disabled:cursor-not-allowed disabled:opacity-50 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" />
            </div>

        </div>

        {{-- Attendance Records --}}
        <div class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">

            @if ($cutoffId === '')

                <div class="p-10 text-center">
                    <h2 class="text-lg font-medium text-zinc-900 dark:text-white">
                        Select an Attendance Cutoff
                    </h2>

                    <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                        Choose a cutoff above to view its attendance records.
                    </p>
                </div>
            @elseif ($records->isEmpty())
                <div class="p-10 text-center">
                    <h2 class="text-lg font-medium text-zinc-900 dark:text-white">
                        No Attendance Records Found
                    </h2>

                    <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                        Try another search or select a different cutoff.
                    </p>
                </div>
            @else
                <div class="w-full overflow-x-auto">
                    <table class="w-full min-w-max text-left text-sm">

                        <thead class="bg-zinc-50 dark:bg-zinc-800/70">
                            <tr>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                                    AC-No.
                                </th>

                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                                    Employee
                                </th>

                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                                    Date
                                </th>

                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                                    IN 1
                                </th>

                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                                    OUT 1
                                </th>

                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                                    IN 2
                                </th>

                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                                    OUT 2
                                </th>
                                <th
                                    class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                            @foreach ($records as $record)
                                <tr wire:key="attendance-record-{{ $record->id }}"
                                    class="hover:bg-zinc-50 dark:hover:bg-zinc-800/50">

                                    <td class="whitespace-nowrap px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                                        {{ $record->ac_no }}
                                    </td>

                                    <td
                                        class="whitespace-nowrap px-4 py-3 text-sm font-medium text-zinc-900 dark:text-white">
                                        {{ $record->employee_name }}
                                    </td>

                                    <td class="whitespace-nowrap px-4 py-3 text-sm text-zinc-600 dark:text-zinc-300">
                                        {{ \Carbon\Carbon::parse($record->attendance_date)->format('M d, Y') }}
                                    </td>

                                    {{-- IN 1 --}}
                                    <td class="whitespace-nowrap px-4 py-3 text-sm">
                                        @if (isset($editedTimes[$record->id]))
                                            <input type="time"
                                                wire:model="editedTimes.{{ $record->id }}.clock_in_1"
                                                class="w-32 rounded-lg border border-zinc-300 bg-white px-2 py-2 text-sm text-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" />
                                        @else
                                            <span class="text-zinc-600 dark:text-zinc-300">
                                                {{ $record->clock_in_1 ?? '—' }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- OUT 1 --}}
                                    <td class="whitespace-nowrap px-4 py-3 text-sm">
                                        @if (isset($editedTimes[$record->id]))
                                            <input type="time"
                                                wire:model="editedTimes.{{ $record->id }}.clock_out_1"
                                                class="w-32 rounded-lg border border-zinc-300 bg-white px-2 py-2 text-sm text-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" />
                                        @else
                                            <span class="text-zinc-600 dark:text-zinc-300">
                                                {{ $record->clock_out_1 ?? '—' }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- IN 2 --}}
                                    <td class="whitespace-nowrap px-4 py-3 text-sm">
                                        @if (isset($editedTimes[$record->id]))
                                            <input type="time"
                                                wire:model="editedTimes.{{ $record->id }}.clock_in_2"
                                                class="w-32 rounded-lg border border-zinc-300 bg-white px-2 py-2 text-sm text-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" />
                                        @else
                                            <span class="text-zinc-600 dark:text-zinc-300">
                                                {{ $record->clock_in_2 ?? '—' }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- OUT 2 --}}
                                    <td class="whitespace-nowrap px-4 py-3 text-sm">
                                        @if (isset($editedTimes[$record->id]))
                                            <input type="time"
                                                wire:model="editedTimes.{{ $record->id }}.clock_out_2"
                                                class="w-32 rounded-lg border border-zinc-300 bg-white px-2 py-2 text-sm text-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white" />
                                        @else
                                            <span class="text-zinc-600 dark:text-zinc-300">
                                                {{ $record->clock_out_2 ?? '—' }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="whitespace-nowrap px-4 py-3 text-sm">
                                        @if (isset($editedTimes[$record->id]))
                                            <button type="button" wire:click="saveTimes({{ $record->id }})"
                                                wire:loading.attr="disabled"
                                                class="rounded-lg bg-orange-600 px-3 py-2 font-medium text-white transition hover:bg-orange-700 disabled:opacity-50">
                                                Save
                                            </button>
                                        @else
                                            <button type="button" wire:click="editTimes({{ $record->id }})"
                                                class="rounded-lg border border-zinc-300 px-3 py-2 font-medium text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800">
                                                Edit
                                            </button>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

                <div class="border-t border-zinc-200 px-4 py-3 dark:border-zinc-800">
                    {{ $records->links(data: ['scrollTo' => false]) }}
                </div>

            @endif

        </div>

    </div>
</div>
