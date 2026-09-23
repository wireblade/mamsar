<div wire:ignore.self x-data="{ open: @entangle('openModal') }" x-cloak @keyup.escape.window="open = false">

    <div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/30">

        <div @click.outside="$wire.set('openModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150 transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="w-full max-w-lg rounded-lg bg-white p-6 dark:bg-gray-800">

            <div class="mb-4 flex items-center justify-between border-b border-gray-200 pb-3">
                <h3 class="flex items-center gap-2 text-base font-medium text-gray-900">
                    <svg class="h-5 w-5 text-gray-400" ...></svg>
                    Add Company
                </h3>

            </div>

            <div class="grid grid-cols-2 gap-3">

            </div>

            <div class="mt-4 flex justify-end space-x-2">
                <button wire:click="$set('openModal', false)"> cancel</button>
            </div>

        </div>
    </div>
</div>
