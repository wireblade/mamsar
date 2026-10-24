<div>
    <div class="mx-auto max-w-5xl space-y-6 p-4 sm:p-6 lg:p-8">
        <a href="{{ route('attendance.index') }}"
            class="mb-2 inline-flex items-center gap-2 text-sm font-medium text-orange-600 hover:text-orange-700 dark:text-orange-400">
            <span aria-hidden="true">←</span>
            Back to Attendance Dashboard
        </a>
        @include('livewire.attendance.partials.navbar')
        <div x-data="{
            show: false,
            message: '',
            timer: null,
            display(message) {
                this.message = message;
                this.show = true;
        
                clearTimeout(this.timer);
        
                this.timer = setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }" x-on:weekly-attendance-success.window="display($event.detail.message)" x-cloak
            x-show="show" x-transition:leave.duration.300ms
            class="mb-4 flex items-center justify-between rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800 dark:border-green-800 dark:bg-green-900/20 dark:text-green-300"
            role="status" aria-live="polite">
            <span x-text="message"></span>

            <button type="button" @click="show = false" class="ml-4 text-lg" aria-label="Dismiss notification">
                &times;
            </button>
        </div>


        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-white">
                Weekly Attendance Processor
            </h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                Upload and process attendance records for a Monday–Sunday week.
            </p>
        </div>

        <a href="{{ route('attendance.weekly.report') }}" wire:navigate
            class="inline-flex items-center gap-2 rounded-lg bg-orange-600 px-4 py-2 text-sm font-medium text-white hover:bg-orange-700">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>

            View Weekly Reports
        </a>
        {{-- Upload Form --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-700 dark:bg-zinc-900">
            <form wire:submit="processAttendance" class="space-y-5">

                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                    {{-- Company --}}
                    <div>
                        <label for="companyCode"
                            class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            Company
                        </label>

                        <select id="companyCode" wire:model="companyCode"
                            class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 focus:border-orange-500 focus:ring-orange-500 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white">
                            <option value="MCIC">MCIC</option>
                            <option value="4KDC">4K Development Corporation (4KDC)</option>
                        </select>

                        @error('companyCode')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Week Start --}}
                    <div>
                        <label for="weekStartDate"
                            class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            Week Starting (Monday)
                        </label>

                        <input type="date" id="weekStartDate" wire:model="weekStartDate"
                            class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 focus:border-orange-500 focus:ring-orange-500 dark:border-zinc-600 dark:bg-zinc-800 dark:text-white" />

                        @error('weekStartDate')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Excel File --}}
                    <div>
                        <label for="file" class="mb-2 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            Attendance File
                        </label>

                        <input type="file" id="file" wire:model="file" accept=".xlsx,.xls,.csv"
                            class="block w-full text-sm text-zinc-600 file:mr-3 file:rounded-lg file:border-0 file:bg-orange-50 file:px-4 file:py-2.5 file:font-medium file:text-orange-700 hover:file:bg-orange-100 dark:text-zinc-300 dark:file:bg-zinc-800 dark:file:text-orange-400" />

                        @error('file')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                        <div wire:loading wire:target="file" class="mt-1 text-sm text-zinc-500">
                            Uploading file...
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="flex flex-wrap items-center gap-3 border-t border-zinc-200 pt-5 dark:border-zinc-700">
                    <button type="submit" wire:loading.attr="disabled" wire:target="process"
                        class="inline-flex items-center rounded-lg bg-orange-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-orange-700 disabled:cursor-not-allowed disabled:opacity-50">
                        <span wire:loading.remove wire:target="process">
                            Process Attendance
                        </span>
                        <span wire:loading wire:target="process">
                            Processing...
                        </span>
                    </button>

                    <span wire:loading wire:target="process" class="text-sm text-zinc-500">
                        Please wait while attendance is being processed.
                    </span>
                </div>
            </form>
        </div>

        {{-- Success Message --}}
        @if (session()->has('success'))
            <div
                class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800 dark:border-green-900 dark:bg-green-950 dark:text-green-300">
                {{ session('success') }}
            </div>
        @endif

        {{-- General Error --}}
        @if (session()->has('error'))
            <div
                class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800 dark:border-red-900 dark:bg-red-950 dark:text-red-300">
                {{ session('error') }}
            </div>
        @endif



    </div>
</div>
