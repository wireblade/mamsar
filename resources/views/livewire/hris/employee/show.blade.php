<div class="space-y-6" x-data="{
    sections: ['personal', 'employment', 'government', 'emergency', 'history', 'projects', 'test'],
    section: 'personal',

    init() {
        const saved = localStorage.getItem('employeeProfileSection');
        if (saved && this.sections.includes(saved)) {
            this.section = saved;
        }
    },

    go(value) {
        this.section = value;
        localStorage.setItem('employeeProfileSection', value);
    },
}">
    {{-- ============================================================ --}}
    {{-- BACK --}}
    {{-- ============================================================ --}}
    <div>
        <a href="{{ route(
            'employee.index',
            array_filter([
                'page' => session('employee_list.page'),
                'search' => session('employee_list.search'),
                'companyFilter' => session('employee_list.companyFilter'),
                'departmentFilter' => session('employee_list.departmentFilter'),
            ]),
        ) }}"
            wire:navigate
            class="inline-flex items-center gap-1.5 text-sm text-zinc-500 transition hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white">
            <flux:icon.arrow-left class="size-4" />
            Back to Employees
        </a>
    </div>

    {{-- ============================================================ --}}
    {{-- PROFILE HEADER --}}
    {{-- ============================================================ --}}
    <section class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
        <div class="h-1 bg-orange-500"></div>

        <div class="p-6 sm:p-8">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                {{-- Employee --}}
                <div class="flex flex-col gap-5 sm:flex-row sm:items-center">
                    {{-- Photo --}}
                    <div
                        class="flex size-24 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-zinc-100 ring-1 ring-zinc-200 dark:bg-zinc-800 dark:ring-zinc-700">
                        @if ($employee->image->pic)
                            <img src="{{ asset('storage/' . $employee->image->path . '/' . $employee->image->pic) }}"
                                alt="{{ $employee->fname }}" class="size-full object-cover" />
                        @else
                            <span class="text-2xl font-semibold text-zinc-400 dark:text-zinc-500">
                                {{ strtoupper(substr($employee->fname, 0, 1)) }}
                                {{ strtoupper(substr($employee->lname, 0, 1)) }}
                            </span>
                        @endif
                    </div>

                    {{-- Main Details --}}
                    <div>
                        <div class="mb-2 flex flex-wrap items-center gap-2">

                            <span class="text-xs font-medium text-zinc-500 dark:text-zinc-400">
                                #{{ $employee->empinfo->id_number }}
                            </span>
                        </div>

                        <h1 class="text-2xl font-semibold tracking-tight text-zinc-900 sm:text-3xl dark:text-white">
                            {{ $this->getFullname($employee->fname, $employee->mname, $employee->lname) }}
                        </h1>

                        <p class="mt-1.5 text-sm text-zinc-600 dark:text-zinc-300">
                            {{ $employee->empinfo?->position->name ?? 'No position assigned' }}
                        </p>

                        {{-- Company / Department --}}
                        <div
                            class="mt-3 flex flex-wrap items-center gap-x-5 gap-y-2 text-sm text-zinc-500 dark:text-zinc-400">
                            <span class="inline-flex items-center gap-1.5">
                                <flux:icon.building-office-2 class="size-4" />

                                {{-- Static until relationship is ready --}}
                                {{ $employee->empinfo->position->department->company->name }}
                            </span>

                            <span class="inline-flex items-center gap-1.5">
                                <flux:icon.building-office class="size-4" />

                                {{-- Static --}}
                                {{ $employee->empinfo->position->department->name }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-wrap items-center gap-2">
                    <flux:button :href="route('show.id', $employee)" icon="identification">
                        View ID
                    </flux:button>

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
    {{-- SIDEBAR + CONTENT --}}
    {{-- ============================================================ --}}
    <div class="grid items-start gap-6 lg:grid-cols-[16rem_minmax(0,1fr)]">
        {{-- ======================================================== --}}
        {{-- LEFT SIDE PANEL --}}
        {{-- On mobile it becomes a horizontally scrollable bar --}}
        {{-- ======================================================== --}}
        <aside
            class="overflow-hidden rounded-xl border border-zinc-200 bg-white lg:sticky lg:top-6 dark:border-zinc-700 dark:bg-zinc-900">
            <nav aria-label="Employee sections"
                class="flex gap-1 overflow-x-auto p-2 lg:flex-col lg:overflow-visible lg:p-3">

                {{-- Group: Profile --}}
                <p class="hidden px-3 pb-1 pt-2 text-xs font-medium text-zinc-400 lg:block dark:text-zinc-500">
                    Profile
                </p>

                <button type="button" @click="go('personal')" :aria-current="section === 'personal' ? 'page' : null"
                    class="flex shrink-0 items-center gap-2.5 rounded-lg px-3 py-2 text-left text-sm font-medium transition focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500"
                    :class="section === 'personal'
                        ?
                        'bg-orange-50 text-orange-700 dark:bg-orange-500/10 dark:text-orange-400' :
                        'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white'">
                    <flux:icon.user class="size-4 shrink-0" />
                    <span class="whitespace-nowrap">Personal Information</span>
                </button>

                <button type="button" @click="go('employment')"
                    :aria-current="section === 'employment' ? 'page' : null"
                    class="flex shrink-0 items-center gap-2.5 rounded-lg px-3 py-2 text-left text-sm font-medium transition focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500"
                    :class="section === 'employment'
                        ?
                        'bg-orange-50 text-orange-700 dark:bg-orange-500/10 dark:text-orange-400' :
                        'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white'">
                    <flux:icon.briefcase class="size-4 shrink-0" />
                    <span class="whitespace-nowrap">Employment</span>
                </button>

                <button type="button" @click="go('government')"
                    :aria-current="section === 'government' ? 'page' : null"
                    class="flex shrink-0 items-center gap-2.5 rounded-lg px-3 py-2 text-left text-sm font-medium transition focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500"
                    :class="section === 'government'
                        ?
                        'bg-orange-50 text-orange-700 dark:bg-orange-500/10 dark:text-orange-400' :
                        'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white'">
                    <flux:icon.identification class="size-4 shrink-0" />
                    <span class="whitespace-nowrap">Government IDs</span>
                </button>

                <button type="button" @click="go('emergency')" :aria-current="section === 'emergency' ? 'page' : null"
                    class="flex shrink-0 items-center gap-2.5 rounded-lg px-3 py-2 text-left text-sm font-medium transition focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500"
                    :class="section === 'emergency'
                        ?
                        'bg-orange-50 text-orange-700 dark:bg-orange-500/10 dark:text-orange-400' :
                        'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white'">
                    <flux:icon.phone class="size-4 shrink-0" />
                    <span class="whitespace-nowrap">Emergency Contact</span>
                </button>

                {{-- Group: Records --}}
                <div class="mx-3 my-2 hidden border-t border-zinc-200 lg:block dark:border-zinc-700"></div>

                <p class="hidden px-3 pb-1 text-xs font-medium text-zinc-400 lg:block dark:text-zinc-500">
                    Records
                </p>

                <button type="button" @click="go('history')" :aria-current="section === 'history' ? 'page' : null"
                    class="flex shrink-0 items-center gap-2.5 rounded-lg px-3 py-2 text-left text-sm font-medium transition focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500"
                    :class="section === 'history'
                        ?
                        'bg-orange-50 text-orange-700 dark:bg-orange-500/10 dark:text-orange-400' :
                        'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white'">
                    <flux:icon.clock class="size-4 shrink-0" />
                    <span class="whitespace-nowrap">Employment History</span>
                </button>

                <button type="button" @click="go('projects')" :aria-current="section === 'projects' ? 'page' : null"
                    class="flex shrink-0 items-center gap-2.5 rounded-lg px-3 py-2 text-left text-sm font-medium transition focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500"
                    :class="section === 'projects'
                        ?
                        'bg-orange-50 text-orange-700 dark:bg-orange-500/10 dark:text-orange-400' :
                        'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white'">
                    <flux:icon.folder class="size-4 shrink-0" />
                    <span class="whitespace-nowrap">Project Assignments</span>
                </button>

                <button type="button" @click="go('test')" :aria-current="section === 'test' ? 'page' : null"
                    class="flex shrink-0 items-center gap-2.5 rounded-lg px-3 py-2 text-left text-sm font-medium transition focus:outline-none focus-visible:ring-2 focus-visible:ring-orange-500"
                    :class="section === 'test'
                        ?
                        'bg-orange-50 text-orange-700 dark:bg-orange-500/10 dark:text-orange-400' :
                        'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white'">
                    <flux:icon.folder class="size-4 shrink-0" />
                    <span class="whitespace-nowrap">test</span>
                </button>
            </nav>
        </aside>

        {{-- ======================================================== --}}
        {{-- RIGHT CONTENT --}}
        {{-- ======================================================== --}}
        <div class="min-w-0">
            {{-- ==================================================== --}}
            {{-- PERSONAL INFORMATION --}}
            {{-- ==================================================== --}}
            <section x-show="section === 'personal'" x-cloak
                class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center gap-3 border-b border-zinc-200 px-6 py-4 dark:border-zinc-700">
                    <div class="flex size-9 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                        <flux:icon.user class="size-4 text-zinc-600 dark:text-zinc-300" />
                    </div>

                    <div>
                        <h2 class="font-semibold text-zinc-900 dark:text-white">Personal Information</h2>

                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Basic employee information and contact
                            details.</p>
                    </div>
                </div>

                <div class="p-6">
                    <dl class="grid gap-x-8 gap-y-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div>
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">First Name</dt>
                            <dd class="mt-1.5 text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                {{ $employee->fname }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Middle Name</dt>
                            <dd class="mt-1.5 text-sm text-zinc-700 dark:text-zinc-300">{{ $employee->mname ?: '-' }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Last Name</dt>
                            <dd class="mt-1.5 text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                {{ $employee->lname }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Date of Birth</dt>
                            <dd class="mt-1.5 text-sm text-zinc-700 dark:text-zinc-300">{{ $employee->dob ?? '-' }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Civil Status</dt>
                            <dd class="mt-1.5 text-sm text-zinc-700 dark:text-zinc-300">
                                {{ $employee->marital_status ?? '-' }}</dd>
                        </div>

                        <div>
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Contact Number</dt>
                            <dd class="mt-1.5 text-sm text-zinc-700 dark:text-zinc-300">
                                {{ $employee->contactNumber }}-</dd>
                        </div>

                        <div class="sm:col-span-2 lg:col-span-3">
                            <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Address</dt>
                            <dd class="mt-1.5 text-sm leading-6 text-zinc-700 dark:text-zinc-300">
                                {{ $employee->address ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>
            </section>

            {{-- ==================================================== --}}
            {{-- EMPLOYMENT --}}
            {{-- ==================================================== --}}
            <section x-show="section === 'employment'" x-cloak
                class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center gap-3 border-b border-zinc-200 px-6 py-4 dark:border-zinc-700">
                    <div class="flex size-9 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                        <flux:icon.briefcase class="size-4 text-zinc-600 dark:text-zinc-300" />
                    </div>

                    <div>
                        <h2 class="font-semibold text-zinc-900 dark:text-white">Employment</h2>

                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Current assignment.</p>
                    </div>
                </div>

                <dl class="grid divide-y divide-zinc-100 sm:grid-cols-2 sm:divide-y-0 dark:divide-zinc-800">
                    <div class="px-6 py-4 sm:border-b sm:border-zinc-100 sm:dark:border-zinc-800">
                        <dt class="text-xs text-zinc-500 dark:text-zinc-400">Employee ID</dt>
                        <dd class="mt-1 text-sm font-medium text-zinc-900 dark:text-zinc-100">
                            {{ $employee->empinfo->id_number }}</dd>
                    </div>

                    <div class="px-6 py-4 sm:border-b sm:border-zinc-100 sm:dark:border-zinc-800">
                        <dt class="text-xs text-zinc-500 dark:text-zinc-400">Company</dt>
                        <dd class="mt-1 text-sm text-zinc-700 dark:text-zinc-300">
                            {{ $employee->empinfo->position->department->company->name }}</dd>
                    </div>

                    <div class="px-6 py-4 sm:border-b sm:border-zinc-100 sm:dark:border-zinc-800">
                        <dt class="text-xs text-zinc-500 dark:text-zinc-400">Department</dt>
                        <dd class="mt-1 text-sm text-zinc-700 dark:text-zinc-300">
                            {{ $employee->empinfo->position->department->name }}</dd>
                    </div>

                    <div class="px-6 py-4 sm:border-b sm:border-zinc-100 sm:dark:border-zinc-800">
                        <dt class="text-xs text-zinc-500 dark:text-zinc-400">Position</dt>
                        <dd class="mt-1 text-sm text-zinc-700 dark:text-zinc-300">
                            {{ $employee->empinfo->position->name ?? '-' }}
                        </dd>
                    </div>

                    <div class="px-6 py-4">
                        <dt class="text-xs text-zinc-500 dark:text-zinc-400">Date Hired</dt>
                        <dd class="mt-1 text-sm text-zinc-700 dark:text-zinc-300">{{ $employee->dob }}</dd>
                    </div>

                    <div class="px-6 py-4">
                        <dt class="text-xs text-zinc-500 dark:text-zinc-400">Employment Status</dt>
                        {{-- <dd class="mt-2">
                            <span
                                class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400">
                                <span class="size-1.5 rounded-full bg-green-500"></span>
                                Active
                            </span>
                        </dd> --}}
                        <x-status.status mt="2" is_active="{{ $employee->empinfo->is_active }}" />
                    </div>
                </dl>
            </section>

            {{-- ==================================================== --}}
            {{-- GOVERNMENT IDS --}}
            {{-- ==================================================== --}}
            <section x-show="section === 'government'" x-cloak
                class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center gap-3 border-b border-zinc-200 px-6 py-4 dark:border-zinc-700">
                    <div class="flex size-9 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                        <flux:icon.identification class="size-4 text-zinc-600 dark:text-zinc-300" />
                    </div>

                    <div>
                        <h2 class="font-semibold text-zinc-900 dark:text-white">Government IDs</h2>

                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Employee government identification
                            numbers.</p>
                    </div>
                </div>

                <div class="grid gap-6 p-6 sm:grid-cols-2">
                    <div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">SSS Number</p>
                        <p class="mt-1.5 text-sm font-medium text-zinc-800 dark:text-zinc-200">
                            {{ $employee->govid->sss_no }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">TIN</p>
                        <p class="mt-1.5 text-sm font-medium text-zinc-800 dark:text-zinc-200">
                            {{ $employee->govid->tin_no ?: 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">PhilHealth</p>
                        <p class="mt-1.5 text-sm font-medium text-zinc-800 dark:text-zinc-200">
                            {{ $employee->govid->philhealth_no ?: 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">Pag-IBIG</p>
                        <p class="mt-1.5 text-sm font-medium text-zinc-800 dark:text-zinc-200">
                            {{ $employee->govid->pagibig_no ?: 'N/A' }}</p>
                    </div>
                </div>
            </section>

            {{-- ==================================================== --}}
            {{-- EMERGENCY CONTACT --}}
            {{-- ==================================================== --}}
            <section x-show="section === 'emergency'" x-cloak
                class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center gap-3 border-b border-zinc-200 px-6 py-4 dark:border-zinc-700">
                    <div class="flex size-9 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                        <flux:icon.phone class="size-4 text-zinc-600 dark:text-zinc-300" />
                    </div>

                    <div>
                        <h2 class="font-semibold text-zinc-900 dark:text-white">Emergency Contact</h2>

                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Person to contact in case of emergency.
                        </p>
                    </div>
                </div>

                <div class="grid gap-6 p-6 sm:grid-cols-2">
                    <div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">Contact Person</p>
                        <p class="mt-1.5 text-sm font-medium text-zinc-800 dark:text-zinc-200">
                            {{ $employee->emergency->contact_name ?: 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">Contact Number</p>
                        <p class="mt-1.5 text-sm font-medium text-zinc-800 dark:text-zinc-200">
                            {{ $employee->emergency->contact_number ?: 'N/A' }}</p>
                    </div>

                    <div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">Relationship</p>
                        <p class="mt-1.5 text-sm text-zinc-700 dark:text-zinc-300">
                            {{ $employee->emergency->relation ?: 'N/A' }}</p>
                    </div>
                </div>
            </section>

            {{-- ==================================================== --}}
            {{-- EMPLOYMENT HISTORY --}}
            {{-- ==================================================== --}}
            <section x-show="section === 'history'" x-cloak
                class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
                <div
                    class="flex flex-col gap-3 border-b border-zinc-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between dark:border-zinc-700">
                    <div class="flex items-center gap-3">
                        <div class="flex size-9 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                            <flux:icon.clock class="size-4 text-zinc-600 dark:text-zinc-300" />
                        </div>

                        <div>
                            <h2 class="font-semibold text-zinc-900 dark:text-white">Employment History</h2>

                            <p class="text-sm text-zinc-500 dark:text-zinc-400">Track the employee's position,
                                department, and employment changes.</p>
                        </div>
                    </div>

                    <flux:button variant="primary" size="sm" icon="plus">
                        Add Employment History
                    </flux:button>
                </div>

                <div class="p-6">
                    <div class="relative">
                        {{-- Timeline vertical line --}}
                        <div class="absolute bottom-2 left-[7px] top-2 w-px bg-zinc-200 dark:bg-zinc-700"></div>

                        <div class="space-y-8">
                            {{-- HISTORY 1 --}}
                            <div class="relative flex gap-4">
                                <div
                                    class="relative z-10 mt-1 flex size-4 shrink-0 items-center justify-center rounded-full bg-orange-100 ring-4 ring-white dark:bg-orange-500/20 dark:ring-zinc-900">
                                    <span class="size-2 rounded-full bg-orange-500"></span>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                                                    Promoted to Project Engineer
                                                </h4>

                                                <span
                                                    class="rounded-full bg-orange-50 px-2 py-0.5 text-xs font-medium text-orange-700 dark:bg-orange-500/10 dark:text-orange-400">
                                                    Promotion
                                                </span>
                                            </div>

                                            <p class="mt-2 text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                                Mamsar Construction & Industrial Corporation</p>

                                            <div
                                                class="mt-2 flex flex-wrap gap-x-5 gap-y-1 text-sm text-zinc-500 dark:text-zinc-400">
                                                <span>Engineering Department</span>
                                                <span>Project Engineer</span>
                                            </div>

                                            <p class="mt-3 text-sm text-zinc-500 dark:text-zinc-400">Promoted from
                                                Junior Project Engineer.</p>
                                        </div>

                                        <div class="shrink-0">
                                            <p class="text-xs text-zinc-400 dark:text-zinc-500">Effective Date</p>
                                            <p class="mt-1 text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                                January 1, 2026</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- HISTORY 2 --}}
                            <div class="relative flex gap-4">
                                <div
                                    class="relative z-10 mt-1 flex size-4 shrink-0 items-center justify-center rounded-full bg-zinc-100 ring-4 ring-white dark:bg-zinc-700 dark:ring-zinc-900">
                                    <span class="size-2 rounded-full bg-zinc-400 dark:bg-zinc-500"></span>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                                        <div>
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h4 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                                                    Joined the Company
                                                </h4>

                                                <span
                                                    class="rounded-full bg-zinc-100 px-2 py-0.5 text-xs font-medium text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">
                                                    Hired
                                                </span>
                                            </div>

                                            <p class="mt-2 text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                                Mamsar Construction & Industrial Corporation</p>

                                            <div
                                                class="mt-2 flex flex-wrap gap-x-5 gap-y-1 text-sm text-zinc-500 dark:text-zinc-400">
                                                <span>Engineering Department</span>
                                                <span>Junior Project Engineer</span>
                                            </div>

                                            <p class="mt-3 text-sm text-zinc-500 dark:text-zinc-400">Initial
                                                employment record.</p>
                                        </div>

                                        <div class="shrink-0">
                                            <p class="text-xs text-zinc-400 dark:text-zinc-500">Effective Date</p>
                                            <p class="mt-1 text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                                January 15, 2024</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ==================================================== --}}
            {{-- PROJECT ASSIGNMENTS --}}
            {{-- ==================================================== --}}
            <section x-show="section === 'projects'" x-cloak
                class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center gap-3 border-b border-zinc-200 px-6 py-4 dark:border-zinc-700">
                    <div class="flex size-9 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                        <flux:icon.folder class="size-4 text-zinc-600 dark:text-zinc-300" />
                    </div>

                    <div>
                        <h2 class="font-semibold text-zinc-900 dark:text-white">Project Assignments</h2>

                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Projects this employee has been
                            assigned to.</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[650px] text-left">
                        <thead class="border-b border-zinc-200 bg-zinc-50/70 dark:border-zinc-700 dark:bg-zinc-800/50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                                    Project</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                                    Role</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                                    Date Assigned</th>
                                <th
                                    class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                                    Status</th>
                                <th class="w-16 px-6 py-3"></th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                            {{-- PROJECT 1 --}}
                            <tr class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40">
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">Iligan Industrial
                                        Development</p>
                                    <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">Iligan City</p>
                                </td>

                                <td class="px-6 py-4 text-sm text-zinc-700 dark:text-zinc-300">Project Engineer</td>

                                <td class="px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400">February 10, 2026</td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 dark:bg-green-500/10 dark:text-green-400">
                                        <span class="size-1.5 rounded-full bg-green-500"></span>
                                        Active
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <flux:dropdown position="bottom" align="end">
                                        <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />

                                        <flux:menu>
                                            <flux:menu.item icon="pencil-square">Edit</flux:menu.item>

                                            <flux:menu.separator />

                                            <flux:menu.item icon="trash" variant="danger">Remove</flux:menu.item>
                                        </flux:menu>
                                    </flux:dropdown>
                                </td>
                            </tr>

                            {{-- PROJECT 2 --}}
                            <tr class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40">
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">Plant
                                        Rehabilitation Project</p>
                                    <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">Misamis Oriental</p>
                                </td>

                                <td class="px-6 py-4 text-sm text-zinc-700 dark:text-zinc-300">Junior Project
                                    Engineer</td>

                                <td class="px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400">June 5, 2024</td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex rounded-full bg-zinc-100 px-2.5 py-1 text-xs font-medium text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">
                                        Completed
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <flux:dropdown position="bottom" align="end">
                                        <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />

                                        <flux:menu>
                                            <flux:menu.item icon="pencil-square">Edit</flux:menu.item>

                                            <flux:menu.separator />

                                            <flux:menu.item icon="trash" variant="danger">Remove</flux:menu.item>
                                        </flux:menu>
                                    </flux:dropdown>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
            <section x-show="section === 'test'" x-cloak
                class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
                <div class="flex items-center gap-3 border-b border-zinc-200 px-6 py-4 dark:border-zinc-700">
                    test
                </div>
            </section>
        </div>

    </div>

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
