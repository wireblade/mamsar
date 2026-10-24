<div x-data="{
    currentPath: window.location.pathname,
    updatePath() {
        this.currentPath = window.location.pathname;
    },
    isRegular() {
        return this.currentPath.includes('/attendance/weekly') ?
            false :
            this.currentPath.includes('/attendance');
    },
    isWeekly() {
        return this.currentPath.includes('/attendance/weekly');
    }
}" x-init="document.addEventListener('livewire:navigated', () => updatePath());
document.addEventListener('livewire:navigated', () => updatePath());" class="mb-6 border-b border-zinc-200 dark:border-zinc-700">
    <nav class="-mb-px flex flex-wrap gap-2 sm:gap-6" aria-label="Attendance navigation">

        {{-- Regular Attendance --}}
        <a href="{{ route('attendance.processor') }}"
            class="inline-flex items-center gap-2 border-b-2 px-3 py-3 text-sm font-semibold transition"
            :class="isRegular() ?
                'border-orange-500 text-orange-600 dark:text-orange-400' :
                'border-transparent text-zinc-500 hover:border-zinc-300 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-white'">

            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                    d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 0 1 1 1v14H4V6a1 1 0 0 1 1-1Z" />
            </svg>

            Regular Attendance
        </a>

        {{-- Weekly Attendance --}}
        <a href="{{ route('attendance.weekly.process') }}"
            class="inline-flex items-center gap-2 border-b-2 px-3 py-3 text-sm font-semibold transition"
            :class="isWeekly() ?
                'border-orange-500 text-orange-600 dark:text-orange-400' :
                'border-transparent text-zinc-500 hover:border-zinc-300 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-white'">

            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                    d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
            </svg>

            Weekly Attendance
        </a>

    </nav>
</div>
