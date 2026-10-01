<div wire:ignore.self x-data="{ open: @entangle('openModal') }" x-cloak @keydown.escape.window="open = false">
    {{-- Backdrop --}}
    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4 backdrop-blur-[2px] dark:bg-black/60">

        {{-- Modal --}}
        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-2" @click.outside="$wire.set('openModal', false)"
            class="w-full max-w-xl overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-2xl dark:border-zinc-700 dark:bg-zinc-900">


            {{-- ================================================== --}}
            {{-- HEADER --}}
            {{-- ================================================== --}}
            <div class="flex items-start justify-between gap-4 border-b border-zinc-200 px-6 py-5 dark:border-zinc-700">

                <div class="flex items-center gap-3">

                    {{-- Icon --}}
                    <div
                        class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-600 ring-1 ring-inset ring-orange-600/10 dark:bg-orange-500/10 dark:text-orange-400 dark:ring-orange-500/20">
                        <x-heroicon-o-identification class="size-5" />
                    </div>

                    <div>
                        <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">
                            Government IDs
                        </h3>

                        <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">
                            Employee government identification records
                        </p>
                    </div>

                </div>


                {{-- Employee --}}
                <div
                    class="inline-flex w-fit items-center gap-2 rounded-full border border-zinc-200 bg-zinc-50 py-1.5 pl-1.5 pr-3 dark:border-zinc-700 dark:bg-zinc-800">
                    {{-- Initials --}}
                    <div
                        class="flex size-7 shrink-0 items-center justify-center rounded-full bg-orange-100 text-[10px] font-bold text-orange-700 dark:bg-orange-500/15 dark:text-orange-400">
                        {{ $this->getFirstInitials(1) . $this->getMiddleInitials(1) . $this->getLastInitials(1) }}
                    </div>

                    <span class="max-w-48 truncate text-xs font-medium text-zinc-700 dark:text-zinc-200">
                        {{ $this->getFullName() }}
                    </span>
                </div>

                {{-- Close --}}
                <button type="button" wire:click="$set('openModal', false)"
                    class="flex size-9 shrink-0 items-center justify-center rounded-lg text-zinc-400 transition hover:bg-zinc-100 hover:text-zinc-700 dark:text-zinc-500 dark:hover:bg-zinc-800 dark:hover:text-zinc-200">
                    <x-heroicon-o-x-mark class="size-5" />
                </button>

            </div>


            {{-- ========================================================== --}}
            {{-- GOVERNMENT ID GRID --}}
            {{-- ========================================================== --}}
            <div class="m-3 grid grid-cols-1 gap-3 sm:grid-cols-2">

                {{-- ====================================================== --}}
                {{-- SSS --}}
                {{-- ====================================================== --}}
                <div
                    class="rounded-xl border border-zinc-200 bg-white p-4 transition hover:border-zinc-300 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-zinc-600">
                    {{-- Card Header --}}
                    <div class="flex items-start gap-3">

                        <div
                            class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-500/10 dark:text-blue-400">
                            <x-heroicon-o-building-office-2 class="size-5" />
                        </div>

                        <div class="min-w-0">
                            <p
                                class="text-[10px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
                                Social Security
                            </p>

                            <h4 class="mt-0.5 text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                                SSS
                            </h4>
                        </div>

                    </div>


                    {{-- ID Number --}}
                    <div class="mt-4 border-t border-zinc-100 pt-3 dark:border-zinc-800">
                        <p class="text-[10px] font-medium uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
                            ID Number
                        </p>

                        <p
                            class="mt-1 break-all font-mono text-base font-semibold tracking-wide text-zinc-800 dark:text-zinc-200">
                            {{ $sss_no ?: 'Not provided' }}
                        </p>
                    </div>


                    {{-- Status --}}
                    <div class="mt-3 flex items-center justify-between gap-3">

                        <span class="text-xs text-zinc-400 dark:text-zinc-500">
                            SSS
                        </span>

                        @if ($sss_no)
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                                <span class="size-1.5 rounded-full bg-emerald-500"></span>

                                Registered
                            </span>
                        @else
                            <span
                                class="rounded-full bg-zinc-100 px-2 py-1 text-[10px] font-medium text-zinc-500 dark:bg-zinc-800 dark:text-zinc-400">
                                Not provided
                            </span>
                        @endif

                    </div>
                </div>


                {{-- ====================================================== --}}
                {{-- TIN --}}
                {{-- ====================================================== --}}
                <div
                    class="rounded-xl border border-zinc-200 bg-white p-4 transition hover:border-zinc-300 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-zinc-600">
                    <div class="flex items-start gap-3">

                        <div
                            class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                            <x-heroicon-o-receipt-percent class="size-5" />
                        </div>

                        <div>
                            <p
                                class="text-[10px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
                                Tax Identification
                            </p>

                            <h4 class="mt-0.5 text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                                TIN
                            </h4>
                        </div>

                    </div>


                    <div class="mt-4 border-t border-zinc-100 pt-3 dark:border-zinc-800">
                        <p class="text-[10px] font-medium uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
                            ID Number
                        </p>

                        <p
                            class="mt-1 break-all font-mono text-base font-semibold tracking-wide text-zinc-800 dark:text-zinc-200">
                            {{ $tin_no ?: 'Not provided' }}
                        </p>
                    </div>


                    <div class="mt-3 flex items-center justify-between gap-3">

                        <span class="text-xs text-zinc-400 dark:text-zinc-500">
                            BIR
                        </span>

                        @if ($tin_no)
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                                <span class="size-1.5 rounded-full bg-emerald-500"></span>

                                Registered
                            </span>
                        @else
                            <span
                                class="rounded-full bg-zinc-100 px-2 py-1 text-[10px] font-medium text-zinc-500 dark:bg-zinc-800 dark:text-zinc-400">
                                Not provided
                            </span>
                        @endif

                    </div>
                </div>


                {{-- ====================================================== --}}
                {{-- PHILHEALTH --}}
                {{-- ====================================================== --}}
                <div
                    class="rounded-xl border border-zinc-200 bg-white p-4 transition hover:border-zinc-300 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-zinc-600">
                    <div class="flex items-start gap-3">

                        <div
                            class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                            <x-heroicon-o-heart class="size-5" />
                        </div>

                        <div>
                            <p
                                class="text-[10px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
                                Health Insurance
                            </p>

                            <h4 class="mt-0.5 text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                                PhilHealth
                            </h4>
                        </div>

                    </div>


                    <div class="mt-4 border-t border-zinc-100 pt-3 dark:border-zinc-800">
                        <p class="text-[10px] font-medium uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
                            ID Number
                        </p>

                        <p
                            class="mt-1 break-all font-mono text-base font-semibold tracking-wide text-zinc-800 dark:text-zinc-200">
                            {{ $philhealth_no ?: 'Not provided' }}
                        </p>
                    </div>


                    <div class="mt-3 flex items-center justify-between gap-3">

                        <span class="text-xs text-zinc-400 dark:text-zinc-500">
                            PhilHealth
                        </span>

                        @if ($philhealth_no)
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                                <span class="size-1.5 rounded-full bg-emerald-500"></span>

                                Registered
                            </span>
                        @else
                            <span
                                class="rounded-full bg-zinc-100 px-2 py-1 text-[10px] font-medium text-zinc-500 dark:bg-zinc-800 dark:text-zinc-400">
                                Not provided
                            </span>
                        @endif

                    </div>
                </div>


                {{-- ====================================================== --}}
                {{-- PAG-IBIG --}}
                {{-- ====================================================== --}}
                <div
                    class="rounded-xl border border-zinc-200 bg-white p-4 transition hover:border-zinc-300 dark:border-zinc-700 dark:bg-zinc-900 dark:hover:border-zinc-600">
                    <div class="flex items-start gap-3">

                        <div
                            class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-rose-50 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400">
                            <x-heroicon-o-home class="size-5" />
                        </div>

                        <div>
                            <p
                                class="text-[10px] font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
                                Housing Fund
                            </p>

                            <h4 class="mt-0.5 text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                                Pag-IBIG
                            </h4>
                        </div>

                    </div>


                    <div class="mt-4 border-t border-zinc-100 pt-3 dark:border-zinc-800">
                        <p class="text-[10px] font-medium uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
                            ID Number
                        </p>

                        <p
                            class="mt-1 break-all font-mono text-base font-semibold tracking-wide text-zinc-800 dark:text-zinc-200">
                            {{ $pagibig_no ?: 'Not provided' }}
                        </p>
                    </div>


                    <div class="mt-3 flex items-center justify-between gap-3">

                        <span class="text-xs text-zinc-400 dark:text-zinc-500">
                            HDMF
                        </span>

                        @if ($pagibig_no)
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-medium text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400">
                                <span class="size-1.5 rounded-full bg-emerald-500"></span>

                                Registered
                            </span>
                        @else
                            <span
                                class="rounded-full bg-zinc-100 px-2 py-1 text-[10px] font-medium text-zinc-500 dark:bg-zinc-800 dark:text-zinc-400">
                                Not provided
                            </span>
                        @endif

                    </div>
                </div>

            </div>


            {{-- ========================================================== --}}
            {{-- FOOTER --}}
            {{-- ========================================================== --}}

            <div
                class="flex items-center justify-end gap-2 border-t border-zinc-200 bg-zinc-50/70 px-6 py-4 dark:border-zinc-700 dark:bg-zinc-800/30">

                {{-- Cancel --}}
                <button type="button" wire:click="$set('openModal', false)"
                    class="rounded-lg border border-zinc-300 bg-white px-4 py-2 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200 dark:hover:bg-zinc-700">
                    Close
                </button>

            </div>


        </div>
    </div>
</div>
