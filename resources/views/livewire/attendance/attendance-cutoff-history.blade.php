<div>
    <div class="mx-auto max-w-5xl space-y-6 p-4 sm:p-6 lg:p-8">

        {{-- Admin Navbar --}}
        @auth
            @if (auth()->user()->username === 'admin')
                @include('livewire.attendance.partials.navbar')
            @endif
        @endauth

        {{-- Header --}}
        <div>
            <a href="{{ route('attendance.index') }}"
                class="mb-2 inline-flex items-center gap-2 text-sm font-medium text-orange-600 hover:text-orange-700 dark:text-orange-400">
                <span aria-hidden="true">←</span>
                Back to Attendance Dashboard
            </a>

            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">
                Attendance Cutoff History
            </h1>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                Browse previously uploaded attendance reports.
            </p>
        </div>

        {{-- Search --}}
        <div>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search cutoff periods..."
                class="w-full rounded-lg border border-zinc-300 bg-white px-4 py-2.5 text-sm text-zinc-900 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500 dark:border-zinc-700 dark:bg-zinc-900 dark:text-white">
        </div>

        {{-- Mobile Cards --}}
        <div class="space-y-3 md:hidden">
            @forelse ($cutoffs as $cutoff)
                <div wire:key="mobile-cutoff-{{ $cutoff->id }}"
                    class="space-y-4 rounded-xl border border-zinc-200 bg-white p-4 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
                    {{-- Company and Cutoff Name --}}
                    <div class="flex items-start gap-3">
                        <div class="min-w-0 flex-1">
                            <span
                                class="inline-flex rounded-full bg-orange-100 px-2.5 py-1 text-xs font-semibold text-orange-700 dark:bg-orange-900/30 dark:text-orange-300">
                                {{ $cutoff->company_code }}
                            </span>

                            <h2 class="mt-2 break-words font-semibold text-zinc-900 dark:text-white">
                                {{ $cutoff->name }}
                            </h2>
                        </div>

                        <div class="shrink-0 text-right">
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                Records
                            </p>
                            <p class="text-lg font-semibold tabular-nums text-zinc-900 dark:text-white">
                                {{ number_format($cutoff->records_count) }}
                            </p>
                        </div>
                    </div>

                    {{-- Dates --}}
                    <div class="grid grid-cols-2 gap-3 rounded-lg bg-zinc-50 p-3 dark:bg-zinc-800/70">
                        <div class="min-w-0">
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                Start Date
                            </p>
                            <p class="mt-1 text-sm font-medium text-zinc-800 dark:text-zinc-200">
                                {{ $cutoff->start_date->format('M d, Y') }}
                            </p>
                        </div>

                        <div class="min-w-0">
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                End Date
                            </p>
                            <p class="mt-1 text-sm font-medium text-zinc-800 dark:text-zinc-200">
                                {{ $cutoff->end_date->format('M d, Y') }}
                            </p>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col gap-2 sm:flex-row">
                        <a href="{{ route('attendance.report', ['cutoff' => $cutoff->id]) }}"
                            class="inline-flex min-h-10 flex-1 items-center justify-center rounded-lg bg-orange-500 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-orange-600">
                            View Report
                        </a>

                        @auth
                            @if (auth()->user()->username === 'admin')
                                <button type="button" wire:click="deleteCutoff({{ $cutoff->id }})"
                                    wire:confirm="Are you sure you want to delete this cutoff and all its attendance records? This cannot be undone."
                                    wire:loading.attr="disabled" wire:target="deleteCutoff"
                                    class="inline-flex min-h-10 items-center justify-center rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-700 disabled:opacity-50">
                                    Delete
                                </button>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div
                    class="rounded-xl border border-zinc-200 bg-white px-4 py-10 text-center text-sm text-zinc-500 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-400">
                    No saved attendance cutoffs found.
                </div>
            @endforelse
        </div>

        {{-- Desktop Table --}}
        <div class="hidden overflow-x-auto rounded-xl border border-zinc-200 md:block dark:border-zinc-700">
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
                        <tr wire:key="desktop-cutoff-{{ $cutoff->id }}"
                            class="bg-white hover:bg-zinc-50 dark:bg-zinc-900 dark:hover:bg-zinc-800/70">
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
                                <div class="inline-flex items-center justify-end gap-2">
                                    <a href="{{ route('attendance.report', ['cutoff' => $cutoff->id]) }}"
                                        class="inline-flex items-center rounded-lg bg-orange-500 px-3 py-2 text-sm font-medium text-white transition hover:bg-orange-600">
                                        View Report
                                    </a>

                                    @auth
                                        @if (auth()->user()->username === 'admin')
                                            <button type="button" wire:click="deleteCutoff({{ $cutoff->id }})"
                                                wire:confirm="Are you sure you want to delete this cutoff and all its attendance records? This cannot be undone."
                                                wire:loading.attr="disabled" wire:target="deleteCutoff"
                                                class="rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-700 disabled:opacity-50">
                                                Delete
                                            </button>
                                        @endif
                                    @endauth
                                </div>
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

        {{-- Pagination --}}
        @if (method_exists($cutoffs, 'links'))
            <div>
                {{ $cutoffs->links(data: ['scrollTo' => false]) }}
            </div>
        @endif

    </div>
</div>
