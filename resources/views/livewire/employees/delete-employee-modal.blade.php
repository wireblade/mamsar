<div wire:ignore.self x-data="{ open: @entangle('openModal') }" x-cloak @keyup.escape.window="open = false"
    x-init="$watch('open', value => { if(value) $nextTick(() => $refs.focusInput.focus()) })"
    wire:keydown.enter="deleteEmployee">

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

            <h2 class="text-lg font-bold mb-3">Confirm Deletion</h2>

            <p>Are you sure you want to delete ID: <b>{{$empId}}</b> <small>({{$fullname}})</small> ?</p>
            <br>

            <div class="space-y-3">

                <div class="mt-4 flex justify-end space-x-2">
  
                    <button wire:click="$set('openModal', false)"> cancel</button>

                    <button wire:click="deleteEmployee">Delete</button>

                </div>

            </div>

        </div>
    </div>
</div>