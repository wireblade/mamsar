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
                        class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-600 ring-1 ring-inset ring-orange-600/10 dark:bg-orange-500/10 dark:text-orange-400 dark:ring-orange-500/20">
                        <x-heroicon-o-building-office class="size-5" />
                    </div>

                    <div>
                        <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">
                            Add Department
                        </h2>

                        <p class="mt-0.5 text-sm text-zinc-500 dark:text-zinc-400">
                            Create a new department in the system.
                        </p>
                    </div>

                </div>

                {{-- Close --}}
                <button type="button" wire:click="$set('openModal', false)"
                    class="flex size-9 shrink-0 items-center justify-center rounded-lg text-zinc-400 transition hover:bg-zinc-100 hover:text-zinc-700 dark:text-zinc-500 dark:hover:bg-zinc-800 dark:hover:text-zinc-200">
                    <x-heroicon-o-x-mark class="size-5" />
                </button>

            </div>


            {{-- ================================================== --}}
            {{-- CONTENT --}}
            {{-- ================================================== --}}
            <div class="space-y-5 px-6 py-5">

                <div>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                        Department Information
                    </h3>

                    <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                        Enter the basic information for the department.
                    </p>
                </div>


                {{-- ================================================== --}}
                {{-- COMPANY --}}
                {{-- ================================================== --}}
                <div>
                    <label for="company" class="mb-1.5 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        Company
                        <span class="text-red-500">*</span>
                    </label>

                    <select id="company" wire:model="companyId"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:focus:border-orange-500 dark:focus:ring-orange-500/15">
                        <option value="">Select company</option>
                        @foreach ($companies as $company)
                            {{-- Static for now --}}
                            <option value="{{ $company->id }}">
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('companyId')
                        <p class="mt-1.5 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @else
                        <p class="mt-1.5 text-xs text-zinc-400 dark:text-zinc-500">
                            Select the company this department belongs to.
                        </p>
                    @enderror
                </div>


                {{-- ================================================== --}}
                {{-- DEPARTMENT NAME --}}
                {{-- ================================================== --}}
                <div>
                    <label for="department_name"
                        class="mb-1.5 block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        Department Name
                        <span class="text-red-500">*</span>
                    </label>

                    <input id="department_name" wire:model="name" type="text" placeholder="e.g. Engineering"
                        autocomplete="off"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-orange-500 dark:focus:ring-orange-500/15" />

                    @error('name')
                        <p class="mt-1.5 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- ================================================== --}}
                {{-- DESCRIPTION --}}
                {{-- ================================================== --}}
                <div>

                    <div class="mb-1.5 flex items-center justify-between">

                        <label for="department_description"
                            class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            Description
                        </label>

                        <span class="text-xs text-zinc-400 dark:text-zinc-500">
                            Optional
                        </span>

                    </div>

                    <textarea id="department_description" wire:mode="description" rows="3"
                        placeholder="Brief description of the department..."
                        class="w-full resize-none rounded-lg border border-zinc-300 bg-white px-3.5 py-2.5 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:focus:border-orange-500 dark:focus:ring-orange-500/15"></textarea>

                </div>


                {{-- ================================================== --}}
                {{-- STATUS --}}
                {{-- ================================================== --}}
                <div
                    class="flex items-center justify-between gap-4 rounded-xl border border-zinc-200 bg-zinc-50/70 p-4 dark:border-zinc-700 dark:bg-zinc-800/40">

                    <div class="flex items-center gap-3">

                        <div
                            class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-white text-zinc-500 ring-1 ring-zinc-200 dark:bg-zinc-900 dark:text-zinc-400 dark:ring-zinc-700">
                            <x-heroicon-o-check-circle class="size-5" />
                        </div>

                        <div>
                            <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                Active Department
                            </p>

                            <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">
                                Allow this department to be used throughout the system.
                            </p>
                        </div>

                    </div>

                    <button type="button" wire:click="$toggle('is_active')" @class([
                        'relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full transition-colors duration-200',
                        'bg-orange-500' => $is_active,
                        'bg-zinc-300 dark:bg-zinc-600' => !$is_active,
                    ]) role="switch"
                        aria-checked="{{ $is_active ? 'true' : 'false' }}">
                        <span @class([
                            'absolute top-0.5 size-5 rounded-full bg-white shadow-sm transition-all duration-200',
                            'left-[22px]' => $is_active,
                            'left-0.5' => !$is_active,
                        ])></span>
                    </button>

                </div>

            </div>


            {{-- ================================================== --}}
            {{-- FOOTER --}}
            {{-- ================================================== --}}
            <div
                class="flex items-center justify-end gap-2 border-t border-zinc-200 bg-zinc-50/70 px-6 py-4 dark:border-zinc-700 dark:bg-zinc-800/30">

                <button type="button" wire:click="$set('openModal', false)"
                    class="rounded-lg border border-zinc-300 bg-white px-4 py-2.5 text-sm font-medium text-zinc-700 transition hover:bg-zinc-50 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200 dark:hover:bg-zinc-700">
                    Cancel
                </button>


                {{-- Same standardized Add button style --}}
                <button type="button" wire:click="addDepartment"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-orange-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition-all duration-200 hover:bg-orange-700 hover:shadow focus:outline-none focus:ring-2 focus:ring-orange-500/30 focus:ring-offset-2 active:scale-[0.98] dark:bg-orange-600 dark:hover:bg-orange-500 dark:focus:ring-orange-500/40 dark:focus:ring-offset-zinc-900">
                    <x-heroicon-o-plus class="size-4" />

                    Add Department
                </button>

            </div>

        </div>
    </div>
</div>
