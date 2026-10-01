<div
    class="h min-h-screen bg-gradient-to-br from-gray-100 via-blue-50 to-gray-200 p-6 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <div class="item-center mb-4 flex justify-between">


        <x-buttons.button route="id.create" icon="user" placeholder="Add ID" />

        <div class="flex justify-end">
            <div class="relative w-full sm:w-80 lg:w-96">

                {{-- Search Icon --}}
                <div
                    class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-zinc-400 dark:text-zinc-500">
                    <x-heroicon-o-magnifying-glass class="size-4" />
                </div>

                {{-- Search Input --}}
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search employees..."
                    class="w-full rounded-xl border border-zinc-200 bg-white py-2.5 pl-10 pr-4 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 hover:border-zinc-300 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/10 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100 dark:placeholder:text-zinc-500 dark:hover:border-zinc-600 dark:focus:border-orange-500 dark:focus:ring-orange-500/15" />

            </div>
        </div>
    </div>

    <div class="mt-6 w-full overflow-x-auto rounded-2xl bg-white shadow-lg dark:bg-gray-800">
        <div class="grid gap-6 p-5 sm:grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($employees as $employee)
                <div
                    class="overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-md dark:border-zinc-700 dark:bg-zinc-900 dark:shadow-none">
                    {{-- ========================================================== --}}
                    {{-- EMPLOYEE HEADER --}}
                    {{-- ========================================================== --}}
                    <div class="p-5">

                        <div class="flex items-start justify-between gap-4">

                            <div class="flex min-w-0 items-center gap-4">

                                {{-- Profile Picture --}}
                                <div class="relative shrink-0">

                                    @if ($employee->image?->pic)
                                        <img src="{{ asset('storage/' . $employee->image->path . '/' . $employee->image->pic) }}"
                                            alt="{{ $employee->fname }} {{ $employee->lname }}"
                                            class="size-20 rounded-xl border border-zinc-200 bg-zinc-100 object-cover dark:border-zinc-700 dark:bg-zinc-800" />
                                    @else
                                        <div
                                            class="flex size-20 items-center justify-center rounded-xl border border-zinc-200 bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800">
                                            <flux:icon.user class="size-8 text-zinc-400 dark:text-zinc-500" />
                                        </div>
                                    @endif


                                    {{-- Employee Active Status --}}
                                    <span
                                        class="absolute -bottom-1 -right-1 size-4 rounded-full border-[3px] border-white bg-green-500 dark:border-zinc-900"
                                        title="Active Employee"></span>

                                </div>


                                {{-- Employee Details --}}
                                <div class="min-w-0">

                                    <p class="mb-1 text-xs font-medium text-zinc-500 dark:text-zinc-400">
                                        Employee #{{ $employee->empinfo?->id_number ?? 'N/A' }}
                                    </p>


                                    {{-- Name --}}
                                    <h2 class="truncate text-lg font-semibold text-zinc-900 dark:text-white">
                                        {{ $employee->lname }},
                                        {{ $employee->fname }}

                                        @if ($employee->mname)
                                            {{ strtoupper(substr($employee->mname, 0, 1)) }}.
                                        @endif
                                    </h2>


                                    {{-- Position --}}
                                    <div class="mt-1.5 flex items-center gap-1.5">

                                        <flux:icon.briefcase class="size-4 shrink-0 text-zinc-400 dark:text-zinc-500" />

                                        <p class="truncate text-sm text-zinc-500 dark:text-zinc-400">
                                            {{ $employee->empinfo?->position ?? 'No position assigned' }}
                                        </p>

                                    </div>

                                </div>

                            </div>


                            {{-- List Number --}}
                            <span
                                class="inline-flex shrink-0 items-center rounded-full bg-orange-50 px-2.5 py-1 text-xs font-semibold text-orange-700 ring-1 ring-inset ring-orange-600/10 dark:bg-orange-500/10 dark:text-orange-400 dark:ring-orange-500/20">
                                #{{ $employees->firstItem() + $loop->index }}
                            </span>

                        </div>


                        {{-- ====================================================== --}}
                        {{-- ID ASSETS --}}
                        {{-- ====================================================== --}}
                        <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2">

                            {{-- ================================================== --}}
                            {{-- SIGNATURE --}}
                            {{-- ================================================== --}}
                            <div
                                class="rounded-xl border border-zinc-200 bg-zinc-50/70 p-4 dark:border-zinc-700 dark:bg-zinc-800/40">

                                <div class="mb-3 flex items-center justify-between gap-3">

                                    <div class="flex items-center gap-2">

                                        <flux:icon.pencil class="size-4 text-zinc-400 dark:text-zinc-500" />

                                        <span
                                            class="text-xs font-semibold uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                                            Signature
                                        </span>

                                    </div>


                                </div>


                                {{-- Signature Preview --}}
                                <div
                                    class="flex h-20 items-center justify-center rounded-lg border border-zinc-200 bg-white px-3 py-2 dark:border-zinc-700 dark:bg-zinc-300">

                                    @if ($employee->image?->sig)
                                        <img src="{{ asset('storage/' . $employee->image->path . '/' . $employee->image->sig) }}"
                                            alt="Employee signature" class="h-full max-w-full object-contain" />
                                    @else
                                        <div class="flex items-center gap-2 text-xs text-zinc-400 dark:text-zinc-500">
                                            <flux:icon.pencil-square class="size-4" />

                                            No signature uploaded
                                        </div>
                                    @endif

                                </div>

                            </div>


                            {{-- ================================================== --}}
                            {{-- GOVERNMENT IDs --}}
                            {{-- ================================================== --}}
                            <div
                                class="flex flex-col rounded-xl border border-zinc-200 bg-zinc-50/70 p-4 dark:border-zinc-700 dark:bg-zinc-800/40">

                                <div class="flex items-start gap-3">

                                    {{-- Icon --}}
                                    <div
                                        class="flex size-10 shrink-0 items-center justify-center rounded-lg border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
                                        <flux:icon.identification class="size-5 text-zinc-500 dark:text-zinc-400" />
                                    </div>


                                    {{-- Text --}}
                                    <div class="min-w-0">

                                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                                            Government IDs
                                        </h3>

                                        <p class="mt-1 text-xs leading-5 text-zinc-500 dark:text-zinc-400">
                                            View SSS, TIN, PhilHealth and Pag-IBIG information.
                                        </p>

                                    </div>

                                </div>


                                {{-- ONE modal button --}}
                                <div class="mt-auto pt-4">

                                    <flux:button size="sm" variant="ghost" icon="eye"
                                        wire:click="openGovIdModal({{ $employee->id }})">
                                        View Government IDs
                                    </flux:button>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- ========================================================== --}}
                    {{-- FOOTER / ACTIONS --}}
                    {{-- ========================================================== --}}
                    <div
                        class="flex items-center justify-between gap-3 border-t border-zinc-200 bg-zinc-50/70 px-5 py-3 dark:border-zinc-700 dark:bg-zinc-800/30">

                        {{-- Footer Label --}}
                        <div class="flex items-center gap-2 text-xs text-zinc-500 dark:text-zinc-400">
                            <flux:icon.identification class="size-4" />

                            <span>Employee ID Card</span>
                        </div>


                        {{-- Actions --}}
                        <div class="flex items-center gap-1">

                            {{-- View ID --}}
                            <flux:button :href="route('show.id', $employee->id)" size="sm" variant="ghost"
                                icon="eye" wire:navigate>
                                View
                            </flux:button>


                            {{-- Edit ID --}}
                            <flux:button :href="route('id.edit', $employee->id)" size="sm" variant="ghost"
                                icon="pencil-square" wire:navigate>
                                Edit
                            </flux:button>


                            {{-- More Actions --}}
                            <flux:dropdown position="bottom" align="end">

                                <flux:button size="sm" variant="ghost" icon="ellipsis-horizontal" />

                                <flux:menu>

                                    <flux:menu.item icon="trash" variant="danger"
                                        wire:click="openDeleteEmployeeModal({{ $employee->id }})">
                                        Delete Employee
                                    </flux:menu.item>

                                </flux:menu>

                            </flux:dropdown>

                        </div>

                    </div>

                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="border-t bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-800">
            {{ $employees->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
