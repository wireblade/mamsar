<div class="space-y-6">
    {{-- Header --}}
    <div
        class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
    >
        <div>
            <a
                href="{{ route('company.index') }}"
                wire:navigate
                class="mb-2 inline-flex items-center gap-1.5 text-sm text-zinc-500 transition hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200"
            >
                <flux:icon.arrow-left class="size-4" />
                Back to Companies
            </a>

            <div class="flex items-center gap-3">
                <div
                    class="flex size-11 shrink-0 items-center justify-center rounded-xl bg-zinc-100 dark:bg-zinc-800"
                >
                    <flux:icon.building-office-2
                        class="size-6 text-zinc-600 dark:text-zinc-300"
                    />
                </div>

                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h1
                            class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white"
                        >
                            Mamsar Construction & Industrial Corporation
                        </h1>

                        <span
                            class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400"
                        >
                            Active
                        </span>
                    </div>

                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">MCIC</p>
                </div>
            </div>
        </div>

        <flux:button icon="pencil-square"> Edit Company </flux:button>
    </div>

    {{-- Company Information --}}
    <div
        class="rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900"
    >
        <div class="border-b border-zinc-200 px-6 py-4 dark:border-zinc-700">
            <h2 class="font-semibold text-zinc-900 dark:text-white">
                Company Information
            </h2>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">General information about the company.</p>
        </div>

        <div class="grid gap-6 p-6 sm:grid-cols-2 lg:grid-cols-3">
            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Company Name</p>

                <p class="mt-1.5 text-sm font-medium text-zinc-900 dark:text-zinc-100">Mamsar Construction & Industrial Corporation</p>
            </div>

            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Company Code</p>

                <p class="mt-1.5 text-sm font-medium text-zinc-900 dark:text-zinc-100">MCIC</p>
            </div>

            <div>
                <p class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Status</p>

                <div class="mt-1.5">
                    <span
                        class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400"
                    >
                        Active
                    </span>
                </div>
            </div>

            <div class="sm:col-span-2 lg:col-span-3">
                <p class="text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">Description</p>

                <p class="mt-1.5 max-w-3xl text-sm leading-6 text-zinc-700 dark:text-zinc-300">Construction and industrial manpower operations providing services and support for various projects and operations under the MAMSAR Group.</p>
            </div>
        </div>
    </div>

    {{-- Summary Cards --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        {{-- Employees --}}
        <div
            class="rounded-xl border border-zinc-200 bg-white p-5 dark:border-zinc-700 dark:bg-zinc-900"
        >
            <div class="flex items-center justify-between">
                <div
                    class="flex size-10 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                >
                    <flux:icon.users
                        class="size-5 text-zinc-600 dark:text-zinc-300"
                    />
                </div>
            </div>

            <p class="mt-4 text-2xl font-semibold text-zinc-900 dark:text-white">90</p>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Total Employees</p>
        </div>

        {{-- Departments --}}
        <div
            class="rounded-xl border border-zinc-200 bg-white p-5 dark:border-zinc-700 dark:bg-zinc-900"
        >
            <div class="flex items-center justify-between">
                <div
                    class="flex size-10 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                >
                    <flux:icon.building-office
                        class="size-5 text-zinc-600 dark:text-zinc-300"
                    />
                </div>
            </div>

            <p class="mt-4 text-2xl font-semibold text-zinc-900 dark:text-white">8</p>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Departments</p>
        </div>

        {{-- Positions --}}
        <div
            class="rounded-xl border border-zinc-200 bg-white p-5 dark:border-zinc-700 dark:bg-zinc-900"
        >
            <div class="flex items-center justify-between">
                <div
                    class="flex size-10 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                >
                    <flux:icon.briefcase
                        class="size-5 text-zinc-600 dark:text-zinc-300"
                    />
                </div>
            </div>

            <p class="mt-4 text-2xl font-semibold text-zinc-900 dark:text-white">24</p>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Positions</p>
        </div>

        {{-- Active Employees --}}
        <div
            class="rounded-xl border border-zinc-200 bg-white p-5 dark:border-zinc-700 dark:bg-zinc-900"
        >
            <div class="flex items-center justify-between">
                <div
                    class="flex size-10 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                >
                    <flux:icon.user-group
                        class="size-5 text-zinc-600 dark:text-zinc-300"
                    />
                </div>
            </div>

            <p class="mt-4 text-2xl font-semibold text-zinc-900 dark:text-white">87</p>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Active Employees</p>
        </div>
    </div>

    {{-- Departments --}}
    <div
        class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900"
    >
        <div
            class="flex items-center justify-between border-b border-zinc-200 px-6 py-4 dark:border-zinc-700"
        >
            <div>
                <h2 class="font-semibold text-zinc-900 dark:text-white">
                    Departments
                </h2>

                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Departments under Mamsar Construction & Industrial Corporation.</p>
            </div>

            <span class="text-sm text-zinc-500 dark:text-zinc-400">
                8 Departments
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead
                    class="border-b border-zinc-200 bg-zinc-50/70 dark:border-zinc-700 dark:bg-zinc-800/50"
                >
                    <tr>
                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500"
                        >
                            Department
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500"
                        >
                            Employees
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500"
                        >
                            Status
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    <tr>
                        <td class="px-6 py-4">
                            <div
                                class="font-medium text-zinc-900 dark:text-zinc-100"
                            >
                                Engineering
                            </div>
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300"
                        >
                            25
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400"
                            >
                                Active
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4">
                            <div
                                class="font-medium text-zinc-900 dark:text-zinc-100"
                            >
                                Accounting
                            </div>
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300"
                        >
                            12
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400"
                            >
                                Active
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4">
                            <div
                                class="font-medium text-zinc-900 dark:text-zinc-100"
                            >
                                Human Resources
                            </div>
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300"
                        >
                            6
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400"
                            >
                                Active
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4">
                            <div
                                class="font-medium text-zinc-900 dark:text-zinc-100"
                            >
                                Purchasing
                            </div>
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300"
                        >
                            9
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400"
                            >
                                Active
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4">
                            <div
                                class="font-medium text-zinc-900 dark:text-zinc-100"
                            >
                                Warehouse
                            </div>
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300"
                        >
                            11
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400"
                            >
                                Active
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4">
                            <div
                                class="font-medium text-zinc-900 dark:text-zinc-100"
                            >
                                Safety
                            </div>
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300"
                        >
                            10
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400"
                            >
                                Active
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4">
                            <div
                                class="font-medium text-zinc-900 dark:text-zinc-100"
                            >
                                Clinic
                            </div>
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300"
                        >
                            5
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400"
                            >
                                Active
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4">
                            <div
                                class="font-medium text-zinc-900 dark:text-zinc-100"
                            >
                                Legal
                            </div>
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300"
                        >
                            12
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400"
                            >
                                Active
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent Employees --}}
    <div
        class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900"
    >
        <div class="border-b border-zinc-200 px-6 py-4 dark:border-zinc-700">
            <h2 class="font-semibold text-zinc-900 dark:text-white">
                Employees
            </h2>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Employees currently assigned to this company.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead
                    class="border-b border-zinc-200 bg-zinc-50/70 dark:border-zinc-700 dark:bg-zinc-800/50"
                >
                    <tr>
                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500"
                        >
                            Employee
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500"
                        >
                            Department
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500"
                        >
                            Position
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500"
                        >
                            Status
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    <tr>
                        <td class="px-6 py-4">
                            <div
                                class="font-medium text-zinc-900 dark:text-zinc-100"
                            >
                                Juan Dela Cruz
                            </div>
                            <div class="mt-0.5 text-xs text-zinc-500">
                                MCIC-001
                            </div>
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300"
                        >
                            Engineering
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300"
                        >
                            Project Engineer
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400"
                            >
                                Active
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4">
                            <div
                                class="font-medium text-zinc-900 dark:text-zinc-100"
                            >
                                Maria Santos
                            </div>
                            <div class="mt-0.5 text-xs text-zinc-500">
                                MCIC-002
                            </div>
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300"
                        >
                            Accounting
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300"
                        >
                            Accounting Staff
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400"
                            >
                                Active
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="px-6 py-4">
                            <div
                                class="font-medium text-zinc-900 dark:text-zinc-100"
                            >
                                Pedro Reyes
                            </div>
                            <div class="mt-0.5 text-xs text-zinc-500">
                                MCIC-003
                            </div>
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300"
                        >
                            Safety
                        </td>

                        <td
                            class="px-6 py-4 text-sm text-zinc-600 dark:text-zinc-300"
                        >
                            Safety Officer
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400"
                            >
                                Active
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="border-t border-zinc-200 px-6 py-4 dark:border-zinc-700">
            <button
                type="button"
                class="text-sm font-medium text-zinc-700 transition hover:text-zinc-950 dark:text-zinc-300 dark:hover:text-white"
            >
                View all employees →
            </button>
        </div>
    </div>
</div>
