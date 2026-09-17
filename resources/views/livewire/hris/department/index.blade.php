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
                Departments
            </h1>

            <p
                class="mt-1 text-sm text-zinc-500 dark:text-zinc-400"
            >Manage departments across the MAMSAR Group.</p>
        </div>

        {{-- Add Department --}}
        <flux:button variant="primary" icon="plus">
            Add Department
        </flux:button>
    </div>

    {{-- ============================================================ --}}
    {{-- SEARCH & FILTER --}}
    {{-- ============================================================ --}}
    <div
        class="flex flex-col gap-3 rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-700 dark:bg-zinc-900 lg:flex-row lg:items-center"
    >
        {{-- Search --}}
        <div class="flex-1">
            <flux:input
                icon="magnifying-glass"
                placeholder="Search departments..."
            />
        </div>

        {{-- Company Filter --}}
        <div class="w-full lg:w-64">
            <flux:select>
                <flux:select.option> All Companies </flux:select.option>

                <flux:select.option> MCIC </flux:select.option>

                <flux:select.option>
                    4K Development Corporation
                </flux:select.option>

                <flux:select.option> ZMLS </flux:select.option>
            </flux:select>
        </div>

        {{-- Status Filter --}}
        <div class="w-full lg:w-44">
            <flux:select>
                <flux:select.option> All Status </flux:select.option>

                <flux:select.option> Active </flux:select.option>

                <flux:select.option> Inactive </flux:select.option>
            </flux:select>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- DEPARTMENT LIST --}}
    {{-- ============================================================ --}}
    <div
        class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900"
    >
        {{-- Table Header --}}
        <div
            class="flex flex-col gap-1 border-b border-zinc-200 px-6 py-4 dark:border-zinc-700 sm:flex-row sm:items-center sm:justify-between"
        >
            <div>
                <h2 class="text-sm font-semibold text-zinc-900 dark:text-white">
                    Department List
                </h2>

                <p
                    class="mt-1 text-sm text-zinc-500 dark:text-zinc-400"
                >Departments registered under each company.</p>
            </div>

            <span class="text-sm text-zinc-500 dark:text-zinc-400">
                8 departments
            </span>
        </div>

        {{-- ======================================================== --}}
        {{-- TABLE --}}
        {{-- ======================================================== --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[800px] text-left">
                {{-- Table Head --}}
                <thead
                    class="border-b border-zinc-200 bg-zinc-50/70 dark:border-zinc-700 dark:bg-zinc-800/50"
                >
                    <tr>
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

                {{-- ================================================= --}}
                {{-- TABLE BODY --}}
                {{-- ================================================= --}}
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    {{-- ================================================= --}}
                    {{-- ENGINEERING --}}
                    {{-- ================================================= --}}
                    <tr
                        class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                    >
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                                >
                                    <flux:icon.building-office
                                        class="size-4 text-zinc-500 dark:text-zinc-400"
                                    />
                                </div>

                                <div>
                                    <p
                                        class="text-sm font-medium text-zinc-900 dark:text-zinc-100"
                                    >Engineering</p>

                                    <p
                                        class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400"
                                    >25 employees</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                            >
                                MCIC
                            </span>
                        </td>

                        <td
                            class="max-w-sm px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400"
                        >
                            Engineering and project operations.
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
                    {{-- ACCOUNTING --}}
                    {{-- ================================================= --}}
                    <tr
                        class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                    >
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                                >
                                    <flux:icon.building-office
                                        class="size-4 text-zinc-500 dark:text-zinc-400"
                                    />
                                </div>

                                <div>
                                    <p
                                        class="text-sm font-medium text-zinc-900 dark:text-zinc-100"
                                    >Accounting</p>

                                    <p
                                        class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400"
                                    >12 employees</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                            >
                                MCIC
                            </span>
                        </td>

                        <td
                            class="max-w-sm px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400"
                        >
                            Financial records and accounting operations.
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
                    {{-- HUMAN RESOURCES --}}
                    {{-- ================================================= --}}
                    <tr
                        class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                    >
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                                >
                                    <flux:icon.building-office
                                        class="size-4 text-zinc-500 dark:text-zinc-400"
                                    />
                                </div>

                                <div>
                                    <p
                                        class="text-sm font-medium text-zinc-900 dark:text-zinc-100"
                                    >Human Resources</p>

                                    <p
                                        class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400"
                                    >6 employees</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                            >
                                MCIC
                            </span>
                        </td>

                        <td
                            class="max-w-sm px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400"
                        >
                            Employee administration and human resources.
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
                    {{-- PURCHASING --}}
                    {{-- ================================================= --}}
                    <tr
                        class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                    >
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                                >
                                    <flux:icon.building-office
                                        class="size-4 text-zinc-500 dark:text-zinc-400"
                                    />
                                </div>

                                <div>
                                    <p
                                        class="text-sm font-medium text-zinc-900 dark:text-zinc-100"
                                    >Purchasing</p>

                                    <p
                                        class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400"
                                    >9 employees</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                            >
                                MCIC
                            </span>
                        </td>

                        <td
                            class="max-w-sm px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400"
                        >
                            Procurement of materials and company supplies.
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
                    {{-- WAREHOUSE --}}
                    {{-- ================================================= --}}
                    <tr
                        class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                    >
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                                >
                                    <flux:icon.building-office
                                        class="size-4 text-zinc-500 dark:text-zinc-400"
                                    />
                                </div>

                                <div>
                                    <p
                                        class="text-sm font-medium text-zinc-900 dark:text-zinc-100"
                                    >Warehouse</p>

                                    <p
                                        class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400"
                                    >11 employees</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                            >
                                MCIC
                            </span>
                        </td>

                        <td
                            class="max-w-sm px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400"
                        >
                            Materials storage and inventory operations.
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
        <div class="border-t border-zinc-200 px-6 py-4 dark:border-zinc-700">
            <p
                class="text-sm text-zinc-500 dark:text-zinc-400"
            >Showing 5 of 8 departments</p>
        </div>
    </div>
</div>
