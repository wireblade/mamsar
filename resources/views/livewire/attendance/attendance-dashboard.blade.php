<div class="mx-auto max-w-7xl space-y-6 p-4 sm:p-6 lg:p-8">
    @auth
        @if (auth()->user()->username === 'admin')
            <a href="{{ route('dashboard.index') }}"
                class="mb-2 inline-flex items-center gap-2 text-sm font-medium text-orange-600 hover:text-orange-700 dark:text-orange-400">
                <span aria-hidden="true">←</span>
                Back to HRIS Dashboard
            </a>
        @endif
    @endauth


    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">
                Attendance Management
            </h1>

            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                Manage regular and weekly attendance processing and reports.
            </p>
        </div>

        {{-- Theme Toggle --}}
        <div class="shrink-0">
            <flux:button variant="ghost" square aria-label="Toggle appearance" x-data
                x-on:click="$flux.appearance = $flux.appearance === 'dark' ? 'light' : 'dark'">
                <flux:icon name="sun" x-show="$flux.appearance === 'dark'" />
                <flux:icon name="moon" x-show="$flux.appearance !== 'dark'" />
            </flux:button>
        </div>

    </div>

    {{-- Attendance Modules --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- Regular Attendance --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-900">

            <div
                class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 text-orange-600 dark:bg-orange-900/30 dark:text-orange-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 0 1 1 1v14H4V6a1 1 0 0 1 1-1Z" />
                </svg>
            </div>

            <h2 class="mt-4 text-lg font-semibold text-zinc-900 dark:text-white">
                Regular Attendance
            </h2>

            <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                Process biometric attendance records, review saved cutoff reports,
                and correct employee clock-in and clock-out times.
            </p>

            <div class="mt-6 flex flex-wrap gap-3">

                <a href="{{ route('attendance.processor') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-orange-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-orange-700">
                    Process Attendance
                </a>

                <a href="{{ route('attendance.cutoffs') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800">
                    Attendance History
                </a>

            </div>
        </div>

        {{-- Weekly Attendance --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-800 dark:bg-zinc-900">

            <div
                class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <rect x="3" y="4" width="18" height="17" rx="2" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 2v4M8 2v4M3 10h18M8 14h2m4 0h2m-8 4h2" />
                </svg>
            </div>

            <h2 class="mt-4 text-lg font-semibold text-zinc-900 dark:text-white">
                Weekly Attendance
            </h2>

            <p class="mt-2 text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                Process weekly attendance records and access the weekly
                attendance reporting workflow.
            </p>

            <div class="mt-6 flex flex-wrap gap-3">

                <a href="{{ route('attendance.weekly.process') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-orange-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-orange-700">
                    Process Weekly Attendance
                </a>

                <a href="{{ route('attendance.weekly.report') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-zinc-300 px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:text-zinc-200 dark:hover:bg-zinc-800">
                    Weekly Report
                </a>

            </div>

        </div>

    </div>
    {{-- Footer --}}
    <footer
        class="mt-12 border-t border-zinc-300/80 bg-white/85 px-4 py-6 text-center backdrop-blur-md dark:border-zinc-700/80 dark:bg-zinc-950/85">

        <p class="text-xs font-semibold tracking-wide text-zinc-800 dark:text-zinc-100">
            MCIC <span class="mx-1 text-orange-500">|</span> IT Department
        </p>

        <p class="mt-1.5 text-xs text-zinc-700 dark:text-zinc-300">
            Attendance Management System
        </p>

        <div class="mx-auto my-4 h-px w-10 bg-orange-500"></div>

        <p class="text-xs text-zinc-700 dark:text-zinc-300">
            Developed by
            <span class="font-semibold text-zinc-900 dark:text-white">PBG</span>
            <span class="mx-1">·</span>
            IT Specialist
        </p>

        {{-- System Environment --}}
        <div
            class="mx-auto mt-4 max-w-md space-y-1.5 rounded-lg border border-zinc-200/80 bg-zinc-100/90 px-4 py-3 text-[11px] text-zinc-700 dark:border-zinc-700/80 dark:bg-zinc-900/90 dark:text-zinc-300">
            <p>
                Hosted on the IT workstation
                <span class="mx-1 text-orange-500">·</span>
                Laragon / Nginx
            </p>

            <p>Database: PostgreSQL</p>

            <p>For internal office-network use</p>
        </div>

        <p class="mt-4 text-[11px] leading-relaxed text-zinc-600 dark:text-zinc-400">
            Built with Laravel, Livewire, PHP, Alpine.js, and Tailwind CSS
        </p>

        <p class="mt-3 text-[10px] text-zinc-600 dark:text-zinc-400">
            &copy; {{ date('Y') }} MCIC. All rights reserved.
        </p>
    </footer>
</div>
