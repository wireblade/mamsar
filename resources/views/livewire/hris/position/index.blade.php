<div class="space-y-6">
    {{-- ============================================================ --}}
    {{-- PAGE HEADER --}}
    {{-- ============================================================ --}}
    <div
        class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
    >
        <div>
            <h1
                class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white"
            >
                Positions
            </h1>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Manage employee positions across departments.</p>
        </div>

        <flux:button variant="primary" icon="plus"> Add Position </flux:button>
    </div>

    {{-- ============================================================ --}}
    {{-- SEARCH & FILTERS --}}
    {{-- ============================================================ --}}
    <div
        class="flex flex-col gap-3 rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-700 dark:bg-zinc-900 lg:flex-row lg:items-center"
    >
        {{-- Search --}}
        <div class="flex-1">
            <flux:input
                icon="magnifying-glass"
                placeholder="Search positions..."
            />
        </div>

        {{-- Company Filter --}}
        <div class="w-full lg:w-56">
            <flux:select>
                <flux:select.option value="">
                    All Companies
                </flux:select.option>

                <flux:select.option value="1"> MCIC </flux:select.option>

                <flux:select.option value="2">
                    4K Development
                </flux:select.option>

                <flux:select.option value="3"> ZMLS </flux:select.option>
            </flux:select>
        </div>

        {{-- Department Filter --}}
        <div class="w-full lg:w-56">
            <flux:select>
                <flux:select.option value="">
                    All Departments
                </flux:select.option>

                <flux:select.option value="1"> Engineering </flux:select.option>

                <flux:select.option value="2"> Accounting </flux:select.option>

                <flux:select.option value="3"> Safety </flux:select.option>
            </flux:select>
        </div>

        {{-- Status Filter --}}
        <div class="w-full lg:w-40">
            <flux:select>
                <flux:select.option value=""> All Status </flux:select.option>

                <flux:select.option value="1"> Active </flux:select.option>

                <flux:select.option value="0"> Inactive </flux:select.option>
            </flux:select>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- POSITION LIST --}}
    {{-- ============================================================ --}}
    <div
        class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900"
    >
        {{-- List Header --}}
        <div
            class="flex flex-col gap-2 border-b border-zinc-200 px-6 py-4 dark:border-zinc-700 sm:flex-row sm:items-center sm:justify-between"
        >
            <div>
                <h2 class="text-sm font-semibold text-zinc-900 dark:text-white">
                    Position List
                </h2>

                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Positions registered under each department.</p>
            </div>

            <span class="text-sm text-zinc-500 dark:text-zinc-400">
                8 positions
            </span>
        </div>

        {{-- ======================================================== --}}
        {{-- TABLE --}}
        {{-- ======================================================== --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[850px] text-left">
                <thead
                    class="border-b border-zinc-200 bg-zinc-50/70 dark:border-zinc-700 dark:bg-zinc-800/50"
                >
                    <tr>
                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                        >
                            Position
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                        >
                            Department
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                        >
                            Company
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                        >
                            Description
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                        >
                            Status
                        </th>

                        <th class="w-16 px-6 py-3"></th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    {{-- ================================================= --}}
                    {{-- PROJECT ENGINEER --}}
                    {{-- ================================================= --}}
                    <tr
                        class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                    >
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                                >
                                    <flux:icon.briefcase
                                        class="size-4 text-zinc-500 dark:text-zinc-400"
                                    />
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">Project Engineer</p>

                                    <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">8 employees</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="text-sm text-zinc-700 dark:text-zinc-300"
                            >
                                Engineering
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                            >
                                MCIC
                            </span>
                        </td>

                        <td
                            class="max-w-xs px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400"
                        >
                            Handles engineering and project site activities.
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20"
                            >
                                <span
                                    class="size-1.5 rounded-full bg-green-500"
                                ></span>
                                Active
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <flux:dropdown position="bottom" align="end">
                                <flux:button
                                    variant="ghost"
                                    size="sm"
                                    icon="ellipsis-horizontal"
                                />

                                <flux:menu>
                                    <flux:menu.item icon="pencil-square">
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
                        </td>
                    </tr>

                    {{-- ================================================= --}}
                    {{-- SITE ENGINEER --}}
                    {{-- ================================================= --}}
                    <tr
                        class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                    >
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                                >
                                    <flux:icon.briefcase
                                        class="size-4 text-zinc-500 dark:text-zinc-400"
                                    />
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">Site Engineer</p>

                                    <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">12 employees</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="text-sm text-zinc-700 dark:text-zinc-300"
                            >
                                Engineering
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                            >
                                MCIC
                            </span>
                        </td>

                        <td
                            class="max-w-xs px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400"
                        >
                            Supervises engineering activities at project sites.
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20"
                            >
                                <span
                                    class="size-1.5 rounded-full bg-green-500"
                                ></span>
                                Active
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <flux:dropdown position="bottom" align="end">
                                <flux:button
                                    variant="ghost"
                                    size="sm"
                                    icon="ellipsis-horizontal"
                                />

                                <flux:menu>
                                    <flux:menu.item icon="pencil-square">
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
                        </td>
                    </tr>

                    {{-- ================================================= --}}
                    {{-- ACCOUNTANT --}}
                    {{-- ================================================= --}}
                    <tr
                        class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                    >
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                                >
                                    <flux:icon.briefcase
                                        class="size-4 text-zinc-500 dark:text-zinc-400"
                                    />
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">Accountant</p>

                                    <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">5 employees</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="text-sm text-zinc-700 dark:text-zinc-300"
                            >
                                Accounting
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                            >
                                MCIC
                            </span>
                        </td>

                        <td
                            class="max-w-xs px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400"
                        >
                            Handles financial records and accounting
                            transactions.
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20"
                            >
                                <span
                                    class="size-1.5 rounded-full bg-green-500"
                                ></span>
                                Active
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <flux:dropdown position="bottom" align="end">
                                <flux:button
                                    variant="ghost"
                                    size="sm"
                                    icon="ellipsis-horizontal"
                                />

                                <flux:menu>
                                    <flux:menu.item icon="pencil-square">
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
                        </td>
                    </tr>

                    {{-- ================================================= --}}
                    {{-- SAFETY OFFICER --}}
                    {{-- ================================================= --}}
                    <tr
                        class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                    >
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                                >
                                    <flux:icon.briefcase
                                        class="size-4 text-zinc-500 dark:text-zinc-400"
                                    />
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">Safety Officer</p>

                                    <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">7 employees</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="text-sm text-zinc-700 dark:text-zinc-300"
                            >
                                Safety
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                            >
                                MCIC
                            </span>
                        </td>

                        <td
                            class="max-w-xs px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400"
                        >
                            Monitors workplace safety and compliance.
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20"
                            >
                                <span
                                    class="size-1.5 rounded-full bg-green-500"
                                ></span>
                                Active
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <flux:dropdown position="bottom" align="end">
                                <flux:button
                                    variant="ghost"
                                    size="sm"
                                    icon="ellipsis-horizontal"
                                />

                                <flux:menu>
                                    <flux:menu.item icon="pencil-square">
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
                        </td>
                    </tr>

                    {{-- ================================================= --}}
                    {{-- HEAVY EQUIPMENT OPERATOR - 4K --}}
                    {{-- ================================================= --}}
                    <tr
                        class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                    >
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                                >
                                    <flux:icon.briefcase
                                        class="size-4 text-zinc-500 dark:text-zinc-400"
                                    />
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">Heavy Equipment Operator</p>

                                    <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">14 employees</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="text-sm text-zinc-700 dark:text-zinc-300"
                            >
                                Equipment Operations
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                            >
                                4K
                            </span>
                        </td>

                        <td
                            class="max-w-xs px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400"
                        >
                            Operates company heavy equipment and machinery.
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20"
                            >
                                <span
                                    class="size-1.5 rounded-full bg-green-500"
                                ></span>
                                Active
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <flux:dropdown position="bottom" align="end">
                                <flux:button
                                    variant="ghost"
                                    size="sm"
                                    icon="ellipsis-horizontal"
                                />

                                <flux:menu>
                                    <flux:menu.item icon="pencil-square">
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
                        </td>
                    </tr>

                    {{-- ================================================= --}}
                    {{-- TUGBOAT CAPTAIN - ZMLS --}}
                    {{-- ================================================= --}}
                    <tr
                        class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                    >
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                                >
                                    <flux:icon.briefcase
                                        class="size-4 text-zinc-500 dark:text-zinc-400"
                                    />
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">Tugboat Captain</p>

                                    <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">3 employees</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="text-sm text-zinc-700 dark:text-zinc-300"
                            >
                                Marine Operations
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                            >
                                ZMLS
                            </span>
                        </td>

                        <td
                            class="max-w-xs px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400"
                        >
                            Responsible for vessel command and marine
                            operations.
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20"
                            >
                                <span
                                    class="size-1.5 rounded-full bg-green-500"
                                ></span>
                                Active
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <flux:dropdown position="bottom" align="end">
                                <flux:button
                                    variant="ghost"
                                    size="sm"
                                    icon="ellipsis-horizontal"
                                />

                                <flux:menu>
                                    <flux:menu.item icon="pencil-square">
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
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- ======================================================== --}}
        {{-- FOOTER --}}
        {{-- ======================================================== --}}
        <div
            class="flex flex-col gap-2 border-t border-zinc-200 px-6 py-4 dark:border-zinc-700 sm:flex-row sm:items-center sm:justify-between"
        >
            <p class="text-sm text-zinc-500 dark:text-zinc-400">Showing 6 of 8 positions</p>

            {{-- Pagination will go here later --}}
        </div>
    </div>
</div>
