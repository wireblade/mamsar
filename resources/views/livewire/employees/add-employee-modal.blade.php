<div x-data="{ open: @entangle('openModal') }" x-cloak @keyup.escape.window="open = false"
    x-init="$watch('open', value => { if(value) $nextTick(() => $refs.focusInput.focus()) })"
    wire:keydown.enter="addEmployee">

    <div x-show="open" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-400"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">

        <div @click.outside="$wire.set('openModal', false)" x-show="open"
            x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150 transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
            class="bg-white p-6 rounded-lg w-full max-w-lg dark:bg-gray-800 max-h-[80vh] overflow-y-auto">

            <h2 class="text-xl font-bold mb-4">Add Employee</h2>
            <div class="space-y-3">

                <x-form.input label="ID No." name="empId" placeholder="ID No." autofocus="focusInput" />
                <x-form.input label="First Name" name="fname" placeholder="Enter First Name" />
                <x-form.input label="Middle Name" name="mname" placeholder="Enter Middle Name" />
                <x-form.input label="Last Name" name="lname" placeholder="Enter Last Name" />
                <x-form.input label="Position" name="position" placeholder="Enter Position" />
                <x-form.input label="Address" name="address" placeholder="Enter Address" />
                <x-form.input label="EC Name" name="iceName" placeholder="Enter Emergency Contact Name" />
                <x-form.input label="EC Number" name="iceNo" placeholder="Enter Emergency Contact Number" />

                <x-form.input type="file" label="Picture" name="picPath" placeholder="Enter Emergency Contact Number" />

                <x-form.input type="file" label="Signature" name="sigPath" placeholder="Enter Emergency Contact Number" />
            
            </div>

            <div class="mt-5 flex justify-end gap-3">

                <button wire:click="addEmployee" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 transition duration-200">
                    Add Employee
                </button>

                <button wire:click="$set('openModal', false)" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-200">
                    Cancel
                </button>

            </div>
        </div>
    </div>

</div>