<div class="space-y-6">
    {{-- ============================================================ --}}
    {{-- HEADER --}}
    {{-- ============================================================ --}}
    <div
        class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
    >
        <div>
            <h1
                class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white"
            >
                Employees
            </h1>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Manage employee records and information.</p>
        </div>

        <flux:button
            {{-- variant="primary" --}}
            icon="plus"
            href="{{ route('employee.index') }}"
            wire:navigate
        >
            Add Employee
        </flux:button>
    </div>

    {{-- ============================================================ --}}
    {{-- SEARCH / FILTERS --}}
    {{-- ============================================================ --}}
    <div
        class="flex flex-col gap-3 rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-700 dark:bg-zinc-900 lg:flex-row lg:items-center"
    >
        {{-- Search --}}
        <div class="w-full lg:flex-1">
            <flux:input
                wire:model.live.debounce.300ms="filter"
                icon="magnifying-glass"
                placeholder="Search by name, employee ID or position..."
            />
        </div>

        {{-- Company Filter --}}
        {{-- Static for now --}}
        <div class="w-full lg:w-52">
            <flux:select disabled>
                <flux:select.option> All Companies </flux:select.option>
            </flux:select>
        </div>

        {{-- Department Filter --}}
        {{-- Static for now --}}
        <div class="w-full lg:w-52">
            <flux:select disabled>
                <flux:select.option> All Departments </flux:select.option>
            </flux:select>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- EMPLOYEE TABLE --}}
    {{-- ============================================================ --}}
    <div
        class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900"
    >
        {{-- Table Title --}}
        <div
            class="flex items-center justify-between border-b border-zinc-200 px-6 py-4 dark:border-zinc-700"
        >
            <div>
                <h2 class="font-semibold text-zinc-900 dark:text-white">
                    Employee List
                </h2>

                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Employee records across the MAMSAR Group.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] text-left">
                {{-- ==================================================== --}}
                {{-- TABLE HEADER --}}
                {{-- ==================================================== --}}
                <thead
                    class="border-b border-zinc-200 bg-zinc-50/70 dark:border-zinc-700 dark:bg-zinc-800/50"
                >
                    <tr>
                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                        >
                            Employee
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                        >
                            Company
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                        >
                            Department
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                        >
                            Position
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                        >
                            Status
                        </th>

                        <th class="w-24 px-6 py-3">
                            <span class="sr-only"> Actions </span>
                        </th>
                    </tr>
                </thead>

                {{-- ==================================================== --}}
                {{-- TABLE BODY --}}
                {{-- ==================================================== --}}
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    @forelse ($employees as $employee)
                        <tr
                            class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                        >
                            {{-- ======================================== --}}
                            {{-- EMPLOYEE --}}
                            {{-- ======================================== --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    {{-- Profile Picture --}}
                                    <div
                                        class="flex size-10 shrink-0 items-center justify-center overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-800"
                                    >
                                        @if ($employee->image?->pic)
                                            <img
                                                src="{{ asset('storage/' . $employee->image?->path . '/' . $employee->image?->pic) }}"
                                                alt="{{ $employee->fname }}"
                                                class="size-full object-cover"
                                            />

                                        @else
                                            {{-- Image fallback --}}
                                            <span
                                                class="text-sm font-semibold text-zinc-500 dark:text-zinc-400"
                                            >
                                                {{ strtoupper(substr($employee->fname, 0, 1)) }} {{ strtoupper(substr($employee->lname, 0, 1)) }}
                                            </span>

                                        @endif
                                    </div>

                                    {{-- Employee Name --}}
                                    <div class="min-w-0">
                                        <p
                                            class="truncate text-sm font-medium text-zinc-900 dark:text-zinc-100"
                                        >
                                            {{ $this->getFullname(
                                                $employee->fname,
                                                $employee->mname,
                                                $employee->lname
                                            ) }}
                                        </p>

                                        <p
                                            class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400"
                                        >
                                            ID: {{ $employee->empId }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- ======================================== --}}
                            {{-- COMPANY --}}
                            {{-- ======================================== --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                <span
                                    class="text-sm text-zinc-600 dark:text-zinc-300"
                                >
                                    -
                                </span>
                            </td>

                            {{-- ======================================== --}}
                            {{-- DEPARTMENT --}}
                            {{-- ======================================== --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                <span
                                    class="text-sm text-zinc-600 dark:text-zinc-300"
                                >
                                    -
                                </span>
                            </td>

                            {{-- ======================================== --}}
                            {{-- POSITION --}}
                            {{-- ======================================== --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                <span
                                    class="text-sm text-zinc-700 dark:text-zinc-300"
                                >
                                    {{ $employee->empinfo?->position ?? '-' }}
                                </span>
                            </td>

                            {{-- ======================================== --}}
                            {{-- STATUS --}}
                            {{-- ======================================== --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20"
                                >
                                    <span
                                        class="size-1.5 rounded-full bg-green-500"
                                    ></span>

                                    Active
                                </span>
                            </td>

                            {{-- ======================================== --}}
                            {{-- ACTIONS --}}
                            {{-- ======================================== --}}
                            <td class="whitespace-nowrap px-6 py-4">
                                <div
                                    class="flex items-center justify-end gap-1"
                                >
                                    {{-- View --}}
                                    <flux:button
                                        href="{{ route('employee.show', [
                                            'employee' => $employee->id,
                                            'page' => $employees->currentPage()
                                        ]) }}"
                                        wire:navigate
                                        variant="ghost"
                                        size="sm"
                                        icon="eye"
                                    >
                                        View
                                    </flux:button>

                                    {{-- More Actions --}}
                                    <flux:dropdown
                                        position="bottom"
                                        align="end"
                                    >
                                        <flux:button
                                            variant="ghost"
                                            size="sm"
                                            icon="ellipsis-horizontal"
                                        />

                                        <flux:menu>
                                            <flux:menu.item
                                                icon="pencil-square"
                                            >
                                                Edit
                                            </flux:menu.item>

                                            <flux:menu.separator />

                                            <flux:menu.item
                                                icon="trash"
                                                variant="danger"
                                            >
                                                Delete
                                            </flux:menu.item>
                                        </flux:menu>
                                    </flux:dropdown>
                                </div>
                            </td>
                        </tr>

                    @empty
                        {{-- ============================================ --}}
                        {{-- EMPTY STATE --}}
                        {{-- ============================================ --}}
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div
                                    class="mx-auto flex size-12 items-center justify-center rounded-full bg-zinc-100 dark:bg-zinc-800"
                                >
                                    <flux:icon.users
                                        class="size-6 text-zinc-400 dark:text-zinc-500"
                                    />
                                </div>

                                <h3
                                    class="mt-4 text-sm font-medium text-zinc-900 dark:text-zinc-100"
                                >
                                    No employees found
                                </h3>

                                <p
                                    class="mx-auto mt-1 max-w-sm text-sm text-zinc-500 dark:text-zinc-400"
                                >No employee records match your current search or filters.</p>
                            </td>
                        </tr>

                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ============================================================ --}}
        {{-- PAGINATION --}}
        {{-- ============================================================ --}}
        @if ($employees->hasPages())
            <div
                class="border-t border-zinc-200 bg-zinc-50/50 px-6 py-4 dark:border-zinc-700 dark:bg-zinc-800/30"
            >
                {{ $employees->links(data: ['scrollTo' => false]) }}
            </div>

        @endif
    </div>
</div>
