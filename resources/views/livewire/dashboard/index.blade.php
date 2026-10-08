<div class="space-y-6">

    {{-- Dashboard Header --}}
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white">
                Dashboard
            </h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                Welcome to MAMSAR System. Here's an overview of your organization.
            </p>
        </div>

        <span
            class="w-fit rounded-lg border border-zinc-200 bg-white px-4 py-2 text-sm text-zinc-600 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300">
            October 2026
        </span>
    </div>

    {{-- Static Dashboard Data --}}
    @php
        $stats = [
            [
                'title' => 'Total Employees',
                'value' => '90',
                'description' => 'Across all companies',
                'icon' => 'employees',
            ],
            ['title' => 'Active Employees', 'value' => '84', 'description' => 'Currently employed', 'icon' => 'active'],
            [
                'title' => 'Departments',
                'value' => '12',
                'description' => 'Registered departments',
                'icon' => 'departments',
            ],
            ['title' => 'Positions', 'value' => '36', 'description' => 'Registered positions', 'icon' => 'positions'],
        ];

        $companies = [
            ['name' => 'MAMSAR Construction & Industrial Corporation', 'code' => 'MCIC', 'employees' => 58],
            ['name' => '4K Development Corporation', 'code' => '4K', 'employees' => 21],
            ['name' => 'Zeman Marine & Logistics Services Inc.', 'code' => 'ZMLS', 'employees' => 11],
        ];

        $recentEmployees = [
            ['name' => 'Sample Employee 01', 'company' => 'MCIC', 'date' => 'Oct 07, 2026'],
            ['name' => 'Sample Employee 02', 'company' => '4K', 'date' => 'Oct 05, 2026'],
            ['name' => 'Sample Employee 03', 'company' => 'ZMLS', 'date' => 'Oct 02, 2026'],
        ];

        $modules = [
            ['name' => 'Employee Management', 'status' => 'Available'],
            ['name' => 'Company Management', 'status' => 'Available'],
            ['name' => 'Department Management', 'status' => 'Available'],
            ['name' => 'Position Management', 'status' => 'Available'],
            ['name' => 'Attendance Management', 'status' => 'Planned'],
            ['name' => 'Rover Ticketing', 'status' => 'Planned'],
        ];
    @endphp

    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        @foreach ($stats as $stat)
            <div class="rounded-xl border border-zinc-200 bg-white p-5 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">

                <div class="flex items-center justify-between">
                    <p class="text-sm font-medium text-zinc-500 dark:text-zinc-400">
                        {{ $stat['title'] }}
                    </p>

                    <div
                        class="flex size-10 items-center justify-center rounded-lg bg-orange-50 text-orange-600 dark:bg-orange-500/10 dark:text-orange-400">

                        @if ($stat['icon'] === 'employees')
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0ZM4 21v-2a8 8 0 0116 0v2" />
                            </svg>
                        @elseif ($stat['icon'] === 'active')
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4M12 3a9 9 0 100 18 9 9 0 000-18Z" />
                            </svg>
                        @elseif ($stat['icon'] === 'departments')
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h1m4 0h1M9 11h1m4 0h1M9 15h1m4 0h1" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="1.8">
                                <rect x="3" y="7" width="18" height="14" rx="2" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2M3 13h18" />
                            </svg>
                        @endif

                    </div>
                </div>

                <h2 class="mt-4 text-3xl font-bold text-zinc-900 dark:text-white">
                    {{ $stat['value'] }}
                </h2>

                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                    {{ $stat['description'] }}
                </p>
            </div>
        @endforeach

    </div>

    {{-- Company Distribution and Quick Actions --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- Employees by Company --}}
        <div
            class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm xl:col-span-2 dark:border-zinc-800 dark:bg-zinc-900">

            <h3 class="text-base font-semibold text-zinc-900 dark:text-white">
                Employees by Company
            </h3>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                Employee distribution across the MAMSAR group.
            </p>

            <div class="mt-7 space-y-7">
                @foreach ($companies as $company)
                    <div>
                        <div class="mb-2 flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-200">
                                    {{ $company['code'] }}
                                </p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                    {{ $company['name'] }}
                                </p>
                            </div>

                            <span class="text-sm font-semibold text-zinc-900 dark:text-white">
                                {{ $company['employees'] }}
                            </span>
                        </div>

                        <div class="h-2.5 overflow-hidden rounded-full bg-zinc-100 dark:bg-zinc-800">
                            <div class="h-full rounded-full bg-orange-500"
                                style="width: {{ ($company['employees'] / 90) * 100 }}%">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        {{-- Quick Actions --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">

            <h3 class="text-base font-semibold text-zinc-900 dark:text-white">
                Quick Actions
            </h3>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                Frequently accessed HRIS modules.
            </p>

            <div class="mt-5 space-y-3">

                @foreach (['Employee Management', 'Company Management', 'Department Management', 'Position Management', 'Employee ID Maker'] as $action)
                    <div
                        class="flex items-center justify-between rounded-lg border border-zinc-200 px-4 py-3 transition-colors hover:border-orange-400 hover:bg-orange-50 dark:border-zinc-700 dark:hover:border-orange-500 dark:hover:bg-zinc-800">

                        <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            {{ $action }}
                        </span>

                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 text-zinc-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 18l6-6-6-6" />
                        </svg>

                    </div>
                @endforeach

            </div>
        </div>

    </div>

    {{-- Recent Employees and System Overview --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">

        {{-- Recent Employees --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">

            <h3 class="text-base font-semibold text-zinc-900 dark:text-white">
                Recently Added Employees
            </h3>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                Latest employee records.
            </p>

            <div class="mt-5 divide-y divide-zinc-100 dark:divide-zinc-800">

                @foreach ($recentEmployees as $employee)
                    <div class="flex items-center justify-between gap-3 py-4">

                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-10 shrink-0 items-center justify-center rounded-full bg-orange-100 text-sm font-semibold text-orange-700 dark:bg-orange-500/10 dark:text-orange-400">
                                {{ strtoupper(substr($employee['name'], 0, 1)) }}
                            </div>

                            <div>
                                <p class="text-sm font-medium text-zinc-900 dark:text-white">
                                    {{ $employee['name'] }}
                                </p>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                    {{ $employee['company'] }}
                                </p>
                            </div>
                        </div>

                        <span class="text-xs text-zinc-500 dark:text-zinc-400">
                            {{ $employee['date'] }}
                        </span>

                    </div>
                @endforeach

            </div>
        </div>

        {{-- System Overview --}}
        <div class="rounded-xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">

            <h3 class="text-base font-semibold text-zinc-900 dark:text-white">
                System Overview
            </h3>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                MAMSAR System modules and availability.
            </p>

            <div class="mt-5 space-y-5">

                @foreach ($modules as $module)
                    <div class="flex items-center justify-between gap-3">

                        <span class="text-sm text-zinc-700 dark:text-zinc-300">
                            {{ $module['name'] }}
                        </span>

                        @if ($module['status'] === 'Available')
                            <span
                                class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400">
                                Available
                            </span>
                        @else
                            <span
                                class="rounded-full bg-zinc-100 px-3 py-1 text-xs font-medium text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                                Planned
                            </span>
                        @endif

                    </div>
                @endforeach

            </div>
        </div>

    </div>

    {{-- Footer --}}
    <p class="pb-2 text-center text-xs text-zinc-400 dark:text-zinc-500">
        MAMSAR System — Internal Management Platform
    </p>

</div>
