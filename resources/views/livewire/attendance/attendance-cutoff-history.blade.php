<div>

    <div class="space-y-6 p-6">

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">
                    Attendance Cutoff History
                </h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    Browse previously uploaded attendance reports.
                </p>
            </div>

            <div class="flex flex-wrap gap-3">
                {{-- Attendance Processor --}}
                <a href="{{ route('attendance.processor') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-orange-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-orange-700">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4" />
                    </svg>
                    Attendance Processor
                </a>

                {{-- Record Editor --}}
                <a href="{{ route('attendance.edit') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-semibold text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                            d="M12 20h9M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4Z" />
                    </svg>
                    Record Editor
                </a>
            </div>
        </div>


        <div>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search cutoff periods..."
                class="w-full rounded-lg border border-zinc-300 bg-white px-4 py-2 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white">
        </div>

        <div class="overflow-x-auto rounded-xl border border-zinc-200 dark:border-zinc-700">
            <table class="w-full text-left text-sm">
                <thead class="bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">
                    <tr>
                        <th class="px-4 py-3 font-medium">Cutoff Period</th>
                        <th class="px-4 py-3 font-medium">Start Date</th>
                        <th class="px-4 py-3 font-medium">End Date</th>
                        <th class="px-4 py-3 font-medium">Records</th>
                        <th class="px-4 py-3 text-right font-medium">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse ($cutoffs as $cutoff)
                        <tr class="bg-white hover:bg-zinc-50 dark:bg-zinc-900 dark:hover:bg-zinc-800/70">
                            <td class="px-4 py-3">
                                <div class="flex flex-col items-start gap-1.5">
                                    <span
                                        class="inline-flex rounded-full bg-orange-100 px-2.5 py-1 text-xs font-semibold text-orange-700 dark:bg-orange-900/30 dark:text-orange-300">
                                        {{ $cutoff->company_code }}
                                    </span>

                                    <span class="font-medium text-zinc-900 dark:text-white">
                                        {{ $cutoff->name }}
                                    </span>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-zinc-600 dark:text-zinc-300">
                                {{ $cutoff->start_date->format('M d, Y') }}
                            </td>

                            <td class="px-4 py-3 text-zinc-600 dark:text-zinc-300">
                                {{ $cutoff->end_date->format('M d, Y') }}
                            </td>

                            <td class="px-4 py-3 text-zinc-600 dark:text-zinc-300">
                                {{ number_format($cutoff->records_count) }}
                            </td>

                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('attendance.report', ['cutoff' => $cutoff->id]) }}"
                                    class="inline-flex items-center rounded-lg bg-orange-500 px-3 py-2 text-sm font-medium text-white transition hover:bg-orange-600">
                                    View Report
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-10 text-center text-zinc-500 dark:text-zinc-400">
                                No saved attendance cutoffs found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
