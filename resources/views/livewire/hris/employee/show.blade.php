<div class="space-y-6">
    {{-- ============================================================ --}}
    {{-- BACK --}}
    {{-- ============================================================ --}}
    <div>
        <a
            href="{{ route('employee.index', ['page' => $page]) }}"
            wire:navigate
            class="inline-flex items-center gap-1.5 text-sm text-zinc-500 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white"
        >
            <flux:icon.arrow-left class="size-4" />
            Back to Employees
        </a>
    </div>

    {{-- ============================================================ --}}
    {{-- PROFILE HEADER --}}
    {{-- ============================================================ --}}
    <section
        class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900"
    >
        {{-- Subtle accent --}}
        <div class="h-1 bg-orange-500"></div>

        <div class="p-6 sm:p-8">
            <div
                class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between"
            >
                {{-- Employee --}}
                <div class="flex flex-col gap-5 sm:flex-row sm:items-center">
                    {{-- Photo --}}
                    <div
                        class="flex size-24 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-zinc-100 ring-1 ring-zinc-200 dark:bg-zinc-800 dark:ring-zinc-700"
                    >
                        @if ($profile_photo)
                            <img
                                src="{{ asset(
                                    'storage/' .
                                    $profile_photo
                                ) }}"
                                alt="{{ $fname }}"
                                class="size-full object-cover"
                            />

                        @else
                            <span
                                class="text-2xl font-semibold text-zinc-400 dark:text-zinc-500"
                            >
                                {{ strtoupper(substr($fname, 0, 1)) }} {{ strtoupper(substr($lname, 0, 1)) }}
                            </span>

                        @endif
                    </div>

                    {{-- Main Details --}}
                    <div>
                        <div class="mb-2 flex flex-wrap items-center gap-2">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20"
                            >
                                <span
                                    class="size-1.5 rounded-full bg-green-500"
                                ></span>
                                Active
                            </span>

                            <span
                                class="text-xs font-medium text-zinc-500 dark:text-zinc-400"
                            >
                                {{ $empId }}
                            </span>
                        </div>

                        <h1
                            class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white sm:text-3xl"
                        >
                            {{ $this->getFullname() }}
                        </h1>

                        <p
                            class="mt-1.5 text-sm text-zinc-600 dark:text-zinc-300"
                        >
                            {{ $empinfo?->position ?? 'No position assigned' }}
                        </p>

                        {{-- Company / Department --}}
                        <div
                            class="mt-3 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-zinc-500 dark:text-zinc-400"
                        >
                            <span class="inline-flex items-center gap-1.5">
                                <flux:icon.building-office-2 class="size-4" />

                                {{-- Static until relationship is ready --}}
                                Mamsar Construction & Industrial Corporation
                            </span>

                            <span class="inline-flex items-center gap-1.5">
                                <flux:icon.building-office class="size-4" />

                                {{-- Static --}}
                                Engineering
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-wrap items-center gap-2">
                    <flux:button icon="identification"> View ID </flux:button>

                    <flux:button variant="primary" icon="pencil-square">
                        Edit Employee
                    </flux:button>

                    <flux:dropdown position="bottom" align="end">
                        <flux:button icon="ellipsis-horizontal" />

                        <flux:menu>
                            <flux:menu.item icon="printer">
                                Print Profile
                            </flux:menu.item>

                            <flux:menu.separator />

                            <flux:menu.item icon="trash" variant="danger">
                                Delete Employee
                            </flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- MAIN INFORMATION --}}
    {{-- ============================================================ --}}
    <div class="grid gap-6 xl:grid-cols-3">
        {{-- ======================================================== --}}
        {{-- PERSONAL INFORMATION --}}
        {{-- ======================================================== --}}
        <section
            class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900 xl:col-span-2"
        >
            {{-- Header --}}
            <div
                class="flex items-center gap-3 border-b border-zinc-200 px-6 py-4 dark:border-zinc-700"
            >
                <div
                    class="flex size-9 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                >
                    <flux:icon.user
                        class="size-4 text-zinc-600 dark:text-zinc-300"
                    />
                </div>

                <div>
                    <h2 class="font-semibold text-zinc-900 dark:text-white">
                        Personal Information
                    </h2>

                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Basic employee information and contact details.</p>
                </div>
            </div>

            {{-- Details --}}
            <div class="p-6">
                <dl class="grid gap-x-8 gap-y-6 sm:grid-cols-2 lg:grid-cols-3">
                    {{-- First Name --}}
                    <div>
                        <dt
                            class="text-xs font-medium text-zinc-500 dark:text-zinc-400"
                        >
                            First Name
                        </dt>

                        <dd
                            class="mt-1.5 text-sm font-medium text-zinc-900 dark:text-zinc-100"
                        >
                            {{ $fname }}
                        </dd>
                    </div>

                    {{-- Middle Name --}}
                    <div>
                        <dt
                            class="text-xs font-medium text-zinc-500 dark:text-zinc-400"
                        >
                            Middle Name
                        </dt>

                        <dd
                            class="mt-1.5 text-sm text-zinc-700 dark:text-zinc-300"
                        >
                            {{ $mname ?: '-' }}
                        </dd>
                    </div>

                    {{-- Last Name --}}
                    <div>
                        <dt
                            class="text-xs font-medium text-zinc-500 dark:text-zinc-400"
                        >
                            Last Name
                        </dt>

                        <dd
                            class="mt-1.5 text-sm font-medium text-zinc-900 dark:text-zinc-100"
                        >
                            {{ $lname }}
                        </dd>
                    </div>

                    {{-- Date of Birth --}}
                    <div>
                        <dt
                            class="text-xs font-medium text-zinc-500 dark:text-zinc-400"
                        >
                            Date of Birth
                        </dt>

                        <dd
                            class="mt-1.5 text-sm text-zinc-700 dark:text-zinc-300"
                        >
                            {{ $dob ?? '-' }}
                        </dd>
                    </div>

                    {{-- Civil Status --}}
                    <div>
                        <dt
                            class="text-xs font-medium text-zinc-500 dark:text-zinc-400"
                        >
                            Civil Status
                        </dt>

                        <dd
                            class="mt-1.5 text-sm text-zinc-700 dark:text-zinc-300"
                        >
                            -
                        </dd>
                    </div>

                    {{-- Contact --}}
                    <div>
                        <dt
                            class="text-xs font-medium text-zinc-500 dark:text-zinc-400"
                        >
                            Contact Number
                        </dt>

                        <dd
                            class="mt-1.5 text-sm text-zinc-700 dark:text-zinc-300"
                        >
                            -
                        </dd>
                    </div>

                    {{-- Address --}}
                    <div class="sm:col-span-2 lg:col-span-3">
                        <dt
                            class="text-xs font-medium text-zinc-500 dark:text-zinc-400"
                        >
                            Address
                        </dt>

                        <dd
                            class="mt-1.5 text-sm leading-6 text-zinc-700 dark:text-zinc-300"
                        >
                            {{ $address ?? '-' }}
                        </dd>
                    </div>
                </dl>
            </div>
        </section>

        {{-- ======================================================== --}}
        {{-- EMPLOYMENT INFORMATION --}}
        {{-- ======================================================== --}}
        <section
            class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900"
        >
            <div
                class="flex items-center gap-3 border-b border-zinc-200 px-6 py-4 dark:border-zinc-700"
            >
                <div
                    class="flex size-9 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                >
                    <flux:icon.briefcase
                        class="size-4 text-zinc-600 dark:text-zinc-300"
                    />
                </div>

                <div>
                    <h2 class="font-semibold text-zinc-900 dark:text-white">
                        Employment
                    </h2>

                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Current assignment.</p>
                </div>
            </div>

            <dl class="divide-y divide-zinc-100 dark:divide-zinc-800">
                <div class="px-6 py-4">
                    <dt class="text-xs text-zinc-500 dark:text-zinc-400">
                        Employee ID
                    </dt>

                    <dd
                        class="mt-1 text-sm font-medium text-zinc-900 dark:text-zinc-100"
                    >
                        {{ $empId }}
                    </dd>
                </div>

                <div class="px-6 py-4">
                    <dt class="text-xs text-zinc-500 dark:text-zinc-400">
                        Company
                    </dt>

                    <dd class="mt-1 text-sm text-zinc-700 dark:text-zinc-300">
                        Mamsar Construction & Industrial Corporation
                    </dd>
                </div>

                <div class="px-6 py-4">
                    <dt class="text-xs text-zinc-500 dark:text-zinc-400">
                        Department
                    </dt>

                    <dd class="mt-1 text-sm text-zinc-700 dark:text-zinc-300">
                        Engineering
                    </dd>
                </div>

                <div class="px-6 py-4">
                    <dt class="text-xs text-zinc-500 dark:text-zinc-400">
                        Position
                    </dt>

                    <dd class="mt-1 text-sm text-zinc-700 dark:text-zinc-300">
                        {{ $empinfo?->position ?? '-' }}
                    </dd>
                </div>

                <div class="px-6 py-4">
                    <dt class="text-xs text-zinc-500 dark:text-zinc-400">
                        Date Hired
                    </dt>

                    <dd class="mt-1 text-sm text-zinc-700 dark:text-zinc-300">
                        January 15, 2024
                    </dd>
                </div>

                <div class="px-6 py-4">
                    <dt class="text-xs text-zinc-500 dark:text-zinc-400">
                        Employment Status
                    </dt>

                    <dd class="mt-2">
                        <span
                            class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400"
                        >
                            <span
                                class="size-1.5 rounded-full bg-green-500"
                            ></span>
                            Active
                        </span>
                    </dd>
                </div>
            </dl>
        </section>
    </div>

    {{-- ============================================================ --}}
    {{-- GOVERNMENT IDS + EMERGENCY CONTACT --}}
    {{-- ============================================================ --}}
    <div class="grid gap-6 lg:grid-cols-2">
        {{-- Government IDs --}}
        <section
            class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900"
        >
            <div
                class="flex items-center gap-3 border-b border-zinc-200 px-6 py-4 dark:border-zinc-700"
            >
                <div
                    class="flex size-9 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                >
                    <flux:icon.identification
                        class="size-4 text-zinc-600 dark:text-zinc-300"
                    />
                </div>

                <div>
                    <h2 class="font-semibold text-zinc-900 dark:text-white">
                        Government IDs
                    </h2>

                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Employee government identification numbers.</p>
                </div>
            </div>

            <div class="grid gap-6 p-6 sm:grid-cols-2">
                <div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">SSS Number</p>

                    <p class="mt-1.5 text-sm font-medium text-zinc-800 dark:text-zinc-200">00-0000000-0</p>
                </div>

                <div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">TIN</p>

                    <p class="mt-1.5 text-sm font-medium text-zinc-800 dark:text-zinc-200">000-000-000-000</p>
                </div>

                <div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">PhilHealth</p>

                    <p class="mt-1.5 text-sm font-medium text-zinc-800 dark:text-zinc-200">00-000000000-0</p>
                </div>

                <div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Pag-IBIG</p>

                    <p class="mt-1.5 text-sm font-medium text-zinc-800 dark:text-zinc-200">0000-0000-0000</p>
                </div>
            </div>
        </section>

        {{-- Emergency Contact --}}
        <section
            class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900"
        >
            <div
                class="flex items-center gap-3 border-b border-zinc-200 px-6 py-4 dark:border-zinc-700"
            >
                <div
                    class="flex size-9 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                >
                    <flux:icon.phone
                        class="size-4 text-zinc-600 dark:text-zinc-300"
                    />
                </div>

                <div>
                    <h2 class="font-semibold text-zinc-900 dark:text-white">
                        Emergency Contact
                    </h2>

                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Person to contact in case of emergency.</p>
                </div>
            </div>

            <div class="grid gap-6 p-6 sm:grid-cols-2">
                <div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Contact Person</p>

                    <p class="mt-1.5 text-sm font-medium text-zinc-800 dark:text-zinc-200">Maria Dela Cruz</p>
                </div>

                <div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Contact Number</p>

                    <p class="mt-1.5 text-sm font-medium text-zinc-800 dark:text-zinc-200">0912 345 6789</p>
                </div>

                <div>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Relationship</p>

                    <p class="mt-1.5 text-sm text-zinc-700 dark:text-zinc-300">Spouse</p>
                </div>
            </div>
        </section>
    </div>

    {{-- ============================================================ --}}
    {{-- EMPLOYEE RECORDS --}}
    {{-- ============================================================ --}}
    <section class="mt-8">
        {{-- Section Header --}}
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-zinc-900 dark:text-white">
                Employee Records
            </h2>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Employment history and project assignments.</p>
        </div>

        {{-- ======================================================== --}}
        {{-- RECORDS CONTAINER --}}
        {{-- ======================================================== --}}
        <div
            x-data="{
            tab: localStorage.getItem('employeeProfileTab') ?? 'employment',

            changeTab(value) {
                this.tab = value;
                localStorage.setItem('employeeProfileTab', value);
            }
        }"
            class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900"
        >
            {{-- ==================================================== --}}
            {{-- TABS --}}
            {{-- ==================================================== --}}
            <div class="border-b border-zinc-200 px-6 dark:border-zinc-700">
                <div class="flex gap-6 overflow-x-auto">
                    {{-- Employment History Tab --}}
                    <button
                        type="button"
                        @click="changeTab('employment')"
                        class="relative shrink-0 py-4 text-sm font-medium transition"
                        :class="
                        tab === 'employment'
                            ? 'text-orange-600 dark:text-orange-400'
                            : 'text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200'
                    "
                    >
                        Employment History

                        <span
                            x-show="tab === 'employment'"
                            x-cloak
                            class="absolute inset-x-0 bottom-0 h-0.5 bg-orange-500"
                        ></span>
                    </button>

                    {{-- Project Assignments Tab --}}
                    <button
                        type="button"
                        @click="changeTab('projects')"
                        class="relative shrink-0 py-4 text-sm font-medium transition"
                        :class="
                        tab === 'projects'
                            ? 'text-orange-600 dark:text-orange-400'
                            : 'text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200'
                    "
                    >
                        Project Assignments

                        <span
                            x-show="tab === 'projects'"
                            x-cloak
                            class="absolute inset-x-0 bottom-0 h-0.5 bg-orange-500"
                        ></span>
                    </button>
                </div>
            </div>

            {{-- ==================================================== --}}
            {{-- EMPLOYMENT HISTORY TAB --}}
            {{-- ==================================================== --}}
            <div x-show="tab === 'employment'" x-cloak>
                {{-- Employment Header --}}
                <div
                    class="flex flex-col gap-3 border-b border-zinc-200 px-6 py-4 dark:border-zinc-700 sm:flex-row sm:items-center sm:justify-between"
                >
                    <div>
                        <h3
                            class="text-sm font-semibold text-zinc-900 dark:text-white"
                        >
                            Employment History
                        </h3>

                        <p
                            class="mt-1 text-sm text-zinc-500 dark:text-zinc-400"
                        >Track the employee's position, department, and employment changes.</p>
                    </div>

                    {{-- Add Employment History --}}
                    <flux:button variant="primary" size="sm" icon="plus">
                        Add Employment History
                    </flux:button>
                </div>

                {{-- ================================================= --}}
                {{-- EMPLOYMENT TIMELINE --}}
                {{-- ================================================= --}}
                <div class="p-6">
                    <div class="relative">
                        {{-- Timeline vertical line --}}
                        <div
                            class="absolute bottom-2 left-[7px] top-2 w-px bg-zinc-200 dark:bg-zinc-700"
                        ></div>

                        <div class="space-y-8">
                            {{-- ========================================= --}}
                            {{-- HISTORY 1 --}}
                            {{-- ========================================= --}}
                            <div class="relative flex gap-4">
                                {{-- Timeline Dot --}}
                                <div
                                    class="relative z-10 mt-1 flex size-4 shrink-0 items-center justify-center rounded-full bg-orange-100 ring-4 ring-white dark:bg-orange-500/20 dark:ring-zinc-900"
                                >
                                    <span
                                        class="size-2 rounded-full bg-orange-500"
                                    ></span>
                                </div>

                                {{-- Record --}}
                                <div class="min-w-0 flex-1">
                                    <div
                                        class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between"
                                    >
                                        <div>
                                            {{-- Title --}}
                                            <div
                                                class="flex flex-wrap items-center gap-2"
                                            >
                                                <h4
                                                    class="text-sm font-semibold text-zinc-900 dark:text-zinc-100"
                                                >
                                                    Promoted to Project Engineer
                                                </h4>

                                                <span
                                                    class="rounded-full bg-orange-50 px-2 py-0.5 text-xs font-medium text-orange-700 dark:bg-orange-500/10 dark:text-orange-400"
                                                >
                                                    Promotion
                                                </span>
                                            </div>

                                            {{-- Company --}}
                                            <p
                                                class="mt-2 text-sm font-medium text-zinc-700 dark:text-zinc-300"
                                            >Mamsar Construction & Industrial Corporation</p>

                                            {{-- Details --}}
                                            <div
                                                class="mt-2 flex flex-wrap gap-x-5 gap-y-1 text-sm text-zinc-500 dark:text-zinc-400"
                                            >
                                                <span>
                                                    Engineering Department
                                                </span>

                                                <span> Project Engineer </span>
                                            </div>

                                            {{-- Remarks --}}
                                            <p
                                                class="mt-3 text-sm text-zinc-500 dark:text-zinc-400"
                                            >Promoted from Junior Project Engineer.</p>
                                        </div>

                                        {{-- Effective Date --}}
                                        <div class="shrink-0">
                                            <p
                                                class="text-xs text-zinc-400 dark:text-zinc-500"
                                            >Effective Date</p>

                                            <p
                                                class="mt-1 text-sm font-medium text-zinc-700 dark:text-zinc-300"
                                            >January 1, 2026</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ========================================= --}}
                            {{-- HISTORY 2 --}}
                            {{-- ========================================= --}}
                            <div class="relative flex gap-4">
                                {{-- Timeline Dot --}}
                                <div
                                    class="relative z-10 mt-1 flex size-4 shrink-0 items-center justify-center rounded-full bg-zinc-100 ring-4 ring-white dark:bg-zinc-700 dark:ring-zinc-900"
                                >
                                    <span
                                        class="size-2 rounded-full bg-zinc-400 dark:bg-zinc-500"
                                    ></span>
                                </div>

                                {{-- Record --}}
                                <div class="min-w-0 flex-1">
                                    <div
                                        class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between"
                                    >
                                        <div>
                                            <div
                                                class="flex flex-wrap items-center gap-2"
                                            >
                                                <h4
                                                    class="text-sm font-semibold text-zinc-900 dark:text-zinc-100"
                                                >
                                                    Joined the Company
                                                </h4>

                                                <span
                                                    class="rounded-full bg-zinc-100 px-2 py-0.5 text-xs font-medium text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300"
                                                >
                                                    Hired
                                                </span>
                                            </div>

                                            {{-- Company --}}
                                            <p
                                                class="mt-2 text-sm font-medium text-zinc-700 dark:text-zinc-300"
                                            >Mamsar Construction & Industrial Corporation</p>

                                            {{-- Department / Position --}}
                                            <div
                                                class="mt-2 flex flex-wrap gap-x-5 gap-y-1 text-sm text-zinc-500 dark:text-zinc-400"
                                            >
                                                <span>
                                                    Engineering Department
                                                </span>

                                                <span>
                                                    Junior Project Engineer
                                                </span>
                                            </div>

                                            <p
                                                class="mt-3 text-sm text-zinc-500 dark:text-zinc-400"
                                            >Initial employment record.</p>
                                        </div>

                                        {{-- Effective Date --}}
                                        <div class="shrink-0">
                                            <p
                                                class="text-xs text-zinc-400 dark:text-zinc-500"
                                            >Effective Date</p>

                                            <p
                                                class="mt-1 text-sm font-medium text-zinc-700 dark:text-zinc-300"
                                            >January 15, 2024</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==================================================== --}}
            {{-- PROJECT ASSIGNMENTS TAB --}}
            {{-- ==================================================== --}}
            <div x-show="tab === 'projects'" x-cloak>
                {{-- Project Header --}}
                <div
                    class="flex flex-col gap-3 border-b border-zinc-200 px-6 py-4 dark:border-zinc-700 sm:flex-row sm:items-center sm:justify-between"
                >
                    <div>
                        <h3
                            class="text-sm font-semibold text-zinc-900 dark:text-white"
                        >
                            Project Assignments
                        </h3>

                        <p
                            class="mt-1 text-sm text-zinc-500 dark:text-zinc-400"
                        >Projects this employee has been assigned to.</p>
                    </div>
                </div>

                {{-- ================================================= --}}
                {{-- PROJECT TABLE --}}
                {{-- ================================================= --}}
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[750px] text-left">
                        {{-- Table Header --}}
                        <thead
                            class="border-b border-zinc-200 bg-zinc-50/70 dark:border-zinc-700 dark:bg-zinc-800/50"
                        >
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                                >
                                    Project
                                </th>

                                <th
                                    class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                                >
                                    Role
                                </th>

                                <th
                                    class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                                >
                                    Date Assigned
                                </th>

                                <th
                                    class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                                >
                                    Status
                                </th>

                                <th class="w-16 px-6 py-3"></th>
                            </tr>
                        </thead>

                        {{-- Table Body --}}
                        <tbody
                            class="divide-y divide-zinc-100 dark:divide-zinc-800"
                        >
                            {{-- ========================================= --}}
                            {{-- PROJECT 1 --}}
                            {{-- ========================================= --}}
                            <tr
                                class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                            >
                                <td class="px-6 py-4">
                                    <p
                                        class="text-sm font-medium text-zinc-900 dark:text-zinc-100"
                                    >Iligan Industrial Development</p>

                                    <p
                                        class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400"
                                    >Iligan City</p>
                                </td>

                                <td
                                    class="px-6 py-4 text-sm text-zinc-700 dark:text-zinc-300"
                                >
                                    Project Engineer
                                </td>

                                <td
                                    class="px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400"
                                >
                                    February 10, 2026
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400"
                                    >
                                        <span
                                            class="size-1.5 rounded-full bg-green-500"
                                        ></span>

                                        Active
                                    </span>
                                </td>

                                <td class="px-6 py-4">
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
                                                Remove
                                            </flux:menu.item>
                                        </flux:menu>
                                    </flux:dropdown>
                                </td>
                            </tr>

                            {{-- ========================================= --}}
                            {{-- PROJECT 2 --}}
                            {{-- ========================================= --}}
                            <tr
                                class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                            >
                                <td class="px-6 py-4">
                                    <p
                                        class="text-sm font-medium text-zinc-900 dark:text-zinc-100"
                                    >Plant Rehabilitation Project</p>

                                    <p
                                        class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400"
                                    >Misamis Oriental</p>
                                </td>

                                <td
                                    class="px-6 py-4 text-sm text-zinc-700 dark:text-zinc-300"
                                >
                                    Junior Project Engineer
                                </td>

                                <td
                                    class="px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400"
                                >
                                    June 5, 2024
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex rounded-full bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300"
                                    >
                                        Completed
                                    </span>
                                </td>

                                <td class="px-6 py-4">
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
                                                Remove
                                            </flux:menu.item>
                                        </flux:menu>
                                    </flux:dropdown>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- ALPINE CLOAK --}}
    {{-- ============================================================ --}}
    @once
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
    @endonce
</div>
