<div wire:ignore.self x-data="{ open: @entangle('openModal') }" x-cloak @keyup.escape.window="open = false">

    <div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

        <div @click.outside="$wire.set('openModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150 transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="bg-white p-6 rounded-lg w-full max-w-lg dark:bg-gray-800">

            <div class="flex items-center justify-between pb-3 border-b border-gray-200 mb-4">
                <h3 class="text-base font-medium text-gray-900 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-400" ...></svg>
                    Government IDs
                </h3>
                <div
                    class="inline-flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-full px-3 py-1 text-sm text-gray-600">
                    <div
                        class="w-10 h-6 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-medium">
                        {{ $this->getFirstInitials(1) . $this->getMiddleInitials(1) . $this->getLastInitials(1) }}
                    </div>
                    {{ $this->getFullName() }}
                </div>
            </div>

            {{-- ID Cards Grid --}}
            <div class="grid grid-cols-2 gap-3">

                {{-- SSS --}}
                <div class="bg-white border border-gray-200 rounded-xl p-4 flex flex-col gap-1.5">
                    <div class="flex items-center gap-2.5 mb-1">
                        <div
                            class="w-9 h-9 rounded-lg bg-blue-50 text-blue-700 flex items-center justify-center shrink-0">
                            <x-heroicon-o-building-office-2 class="w-5 h-5" />
                        </div>
                        <div>
                            <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">Social Security</p>
                            <p class="text-sm font-medium text-gray-900">SSS</p>
                        </div>
                    </div>
                    <hr class="border-gray-100">
                    <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">ID Number</p>
                    <p class="text-lg font-medium font-mono tracking-wide text-gray-900">{{ $sss_no }}
                    </p>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-xs text-gray-400">SSS registered </span>
                        <span
                            class="text-[11px] font-medium px-2 py-0.5 rounded-full bg-green-50 text-green-700">Active</span>
                    </div>
                </div>

                {{-- TIN --}}
                <div class="bg-white border border-gray-200 rounded-xl p-4 flex flex-col gap-1.5">
                    <div class="flex items-center gap-2.5 mb-1">
                        <div
                            class="w-9 h-9 rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center shrink-0">
                            <x-heroicon-o-receipt-percent class="w-5 h-5" />
                        </div>
                        <div>
                            <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">Tax Identification
                            </p>
                            <p class="text-sm font-medium text-gray-900">TIN</p>
                        </div>
                    </div>
                    <hr class="border-gray-100">
                    <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">ID Number</p>
                    <p class="text-lg font-medium font-mono tracking-wide text-gray-900">{{ $tin_no }}
                    </p>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-xs text-gray-400">BIR registered</span>
                        <span
                            class="text-[11px] font-medium px-2 py-0.5 rounded-full bg-green-50 text-green-700">Active</span>
                    </div>
                </div>

                {{-- PhilHealth --}}
                <div class="bg-white border border-gray-200 rounded-xl p-4 flex flex-col gap-1.5">
                    <div class="flex items-center gap-2.5 mb-1">
                        <div
                            class="w-9 h-9 rounded-lg bg-green-50 text-green-700 flex items-center justify-center shrink-0">
                            <x-heroicon-o-heart class="w-5 h-5" />
                        </div>
                        <div>
                            <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">Health Insurance
                            </p>
                            <p class="text-sm font-medium text-gray-900">PhilHealth</p>
                        </div>
                    </div>
                    <hr class="border-gray-100">
                    <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">ID Number</p>
                    <p class="text-lg font-medium font-mono tracking-wide text-gray-900">
                        {{ $philhealth_no }}</p>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-xs text-gray-400">DOH covered</span>
                        <span
                            class="text-[11px] font-medium px-2 py-0.5 rounded-full bg-green-50 text-green-700">Active</span>
                    </div>
                </div>

                {{-- Pag-IBIG --}}
                <div class="bg-white border border-gray-200 rounded-xl p-4 flex flex-col gap-1.5">
                    <div class="flex items-center gap-2.5 mb-1">
                        <div
                            class="w-9 h-9 rounded-lg bg-pink-50 text-pink-700 flex items-center justify-center shrink-0">
                            <x-heroicon-o-home class="w-5 h-5" />
                        </div>
                        <div>
                            <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">Housing Fund</p>
                            <p class="text-sm font-medium text-gray-900">Pag-IBIG</p>
                        </div>
                    </div>
                    <hr class="border-gray-100">
                    <p class="text-[11px] font-medium uppercase tracking-wide text-gray-400">ID Number</p>
                    <p class="text-lg font-medium font-mono tracking-wide text-gray-900">
                        {{ $pagibig_no }}</p>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-xs text-gray-400">HDMF registered</span>
                        <span
                            class="text-[11px] font-medium px-2 py-0.5 rounded-full bg-green-50 text-green-700">Active</span>
                    </div>
                </div>


            </div>

            <div class="mt-4 flex justify-end space-x-2">
                <button wire:click="$set('openModal', false)"> cancel</button>
            </div>

        </div>
    </div>
</div>
