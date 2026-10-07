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

            {{-- Header --}}
            <div class="flex items-start justify-between border-b border-zinc-200 px-6 py-5 dark:border-zinc-700">
                <div>
                    <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">
                        Add Position
                    </h2>

                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                        Create a new position under a department.
                    </p>
                </div>

                <button type="button" wire:click="$set('openModal', false)"
                    class="rounded-lg p-2 text-zinc-400 transition hover:bg-zinc-100 hover:text-zinc-600 dark:hover:bg-zinc-800 dark:hover:text-zinc-300">
                    <x-heroicon-o-x-mark class="size-5" />
                </button>
            </div>


            {{-- Form --}}
            <form wire:submit="save">

                <div class="space-y-5 px-6 py-5">

                    {{-- Department --}}
                    <div>
                        <label for="departmentId"
                            class="mb-1.5 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            Department
                            <span class="text-red-500">*</span>
                        </label>

                        <select id="departmentId" wire:model="departmentId"
                            class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:focus:border-orange-500">
                            <option value="">Select Department</option>

                            {{-- @foreach ($departments as $department)
                                <option value="{{ $department->id }}">
                                    {{ $department->company->code }} — {{ $department->name }}
                                </option>
                            @endforeach --}}
                        </select>

                        @error('departmentId')
                            <p class="mt-1.5 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Position Name --}}
                    <div>
                        <label for="name" class="mb-1.5 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            Position Name
                            <span class="text-red-500">*</span>
                        </label>

                        <input id="name" type="text" wire:model="name" placeholder="e.g. Project Engineer"
                            class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:placeholder:text-zinc-500 dark:focus:border-orange-500">

                        @error('name')
                            <p class="mt-1.5 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Description --}}
                    <div>
                        <label for="description"
                            class="mb-1.5 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            Description
                        </label>

                        <textarea id="description" wire:model="description" rows="3" placeholder="Brief description of this position..."
                            class="w-full resize-none rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:placeholder:text-zinc-500 dark:focus:border-orange-500"></textarea>

                        @error('description')
                            <p class="mt-1.5 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>


                    {{-- Active --}}
                    <div
                        class="flex items-center justify-between rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-3 dark:border-zinc-700 dark:bg-zinc-800/50">
                        <div>
                            <p class="text-sm font-medium text-zinc-900 dark:text-white">
                                Active Position
                            </p>

                            <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">
                                Allow this position to be assigned to employees.
                            </p>
                        </div>

                        {{-- <button type="button" wire:click="$toggle('is_active')" @class([
                            'relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full transition-colors duration-200',
                            'bg-orange-500' => $is_active,
                            'bg-zinc-300 dark:bg-zinc-600' => !$is_active,
                        ])
                            role="switch" aria-checked="{{ $is_active ? 'true' : 'false' }}">
                            <span @class([
                                'absolute top-0.5 size-5 rounded-full bg-white shadow-sm transition-all duration-200',
                                'left-[22px]' => $is_active,
                                'left-0.5' => !$is_active,
                            ])></span>
                        </button> --}}
                    </div>

                </div>


                {{-- Footer --}}
                <div
                    class="flex items-center justify-end gap-3 border-t border-zinc-200 bg-zinc-50 px-6 py-4 dark:border-zinc-700 dark:bg-zinc-900">
                    <button type="button" wire:click="$set('openModal', false)"
                        class="rounded-lg border border-zinc-300 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700">
                        Cancel
                    </button>

                    <button type="submit" wire:loading.attr="disabled" wire:target="save"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-orange-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition-all duration-200 hover:bg-orange-700 hover:shadow active:scale-[0.98] disabled:pointer-events-none disabled:opacity-50 dark:bg-orange-600 dark:hover:bg-orange-500">
                        <x-heroicon-o-plus wire:loading.remove wire:target="save" class="size-4" />

                        <span wire:loading.remove wire:target="save">
                            Add Position
                        </span>

                        <span wire:loading wire:target="save">
                            Saving...
                        </span>
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
