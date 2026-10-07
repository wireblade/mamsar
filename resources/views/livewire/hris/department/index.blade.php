<div class="space-y-6">
    {{-- ============================================================ --}}
    {{-- PAGE HEADER --}}
    {{-- ============================================================ --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">
                Departments
            </h1>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Manage departments across the MAMSAR Group.</p>
        </div>

        {{-- Add Department --}}
        <x-buttons.button click="openCreateDepartmentModal" placeholder="Add Department" icon='plus' />
    </div>

    {{-- ============================================================ --}}
    {{-- SEARCH & FILTER --}}
    {{-- ============================================================ --}}

    <div
        class="flex flex-col gap-3 rounded-xl border border-zinc-200 bg-white p-4 lg:flex-row lg:items-center dark:border-zinc-700 dark:bg-zinc-900">
        {{-- Search --}}
        <div class="relative flex-1">
            <x-heroicon-o-magnifying-glass
                class="pointer-events-none absolute left-3 top-1/2 size-5 -translate-y-1/2 text-zinc-400" />

            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search departments..."
                class="w-full rounded-lg border border-zinc-300 bg-white py-2.5 pl-10 pr-3 text-sm text-zinc-900 outline-none transition placeholder:text-zinc-400 focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:placeholder:text-zinc-500 dark:focus:border-orange-500">
        </div>

        {{-- Company Filter --}}
        <div class="w-full lg:w-64">
            <select wire:model.live="companyFilter"
                class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:focus:border-orange-500">
                <option value="">All Companies</option>

                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">
                        {{ $company->code }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Status Filter --}}
        <div class="w-full lg:w-44">
            <select wire:model.live="statusFilter"
                class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm text-zinc-900 outline-none transition focus:border-orange-500 focus:ring-2 focus:ring-orange-500/20 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white dark:focus:border-orange-500">
                <option value="">All Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
    </div>
    {{-- ============================================================ --}}
    {{-- DEPARTMENT LIST --}}
    {{-- ============================================================ --}}
    <div class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
        {{-- Table Header --}}
        <div
            class="flex flex-col gap-1 border-b border-zinc-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-between dark:border-zinc-700">
            <div>
                <h2 class="text-sm font-semibold text-zinc-900 dark:text-white">
                    Department List
                </h2>

                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Departments registered under each company.</p>
            </div>

            <span class="text-sm text-zinc-500 dark:text-zinc-400">
                {{ $departments->count() }} departments
            </span>
        </div>

        {{-- ======================================================== --}}
        {{-- TABLE --}}
        {{-- ======================================================== --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[800px] text-left">
                {{-- Table Head --}}
                <thead class="border-b border-zinc-200 bg-zinc-50/70 dark:border-zinc-700 dark:bg-zinc-800/50">
                    <tr>
                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                            Department
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                            Company
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                            Description
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400">
                            Status
                        </th>

                        <th class="w-16 px-6 py-3"></th>
                    </tr>
                </thead>

                {{-- ================================================= --}}
                {{-- TABLE BODY --}}
                {{-- ================================================= --}}
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">

                    @foreach ($departments as $department)
                        <tr class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800">
                                        <flux:icon.building-office class="size-4 text-zinc-500 dark:text-zinc-400" />
                                    </div>

                                    <div>
                                        <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                                            {{ $department->name }}</p>

                                        <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">
                                            {{ $department->employees_count }} employees</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    {{ $department->company->code }}
                                </span>
                            </td>

                            <td class="max-w-sm px-6 py-4 text-sm text-zinc-500 dark:text-zinc-400">
                                Engineering and project operations.
                            </td>

                            <td class="px-6 py-4">
                                @if ($department->is_active)
                                    {{-- Active --}}
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20">
                                        <span class="size-1.5 rounded-full bg-green-500"></span>
                                        Active
                                    </span>
                                @else
                                    {{-- Inactive --}}
                                    <span
                                        class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20 dark:bg-red-500/10 dark:text-red-400 dark:ring-red-500/20">
                                        <span class="size-1.5 rounded-full bg-red-500"></span>
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                <flux:dropdown position="bottom" align="end">
                                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />

                                    <flux:menu>
                                        <flux:menu.item icon="pencil-square">
                                            Edit
                                        </flux:menu.item>

                                        <flux:menu.separator />

                                        <flux:menu.item icon="trash" variant="danger">
                                            Delete
                                        </flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>

        {{-- ======================================================== --}}
        {{-- FOOTER --}}
        {{-- ======================================================== --}}
        <div class="border-t border-zinc-200 px-6 py-4 dark:border-zinc-700">
            {{ $departments->links(data: ['scrollTo' => false]) }}
        </div>
    </div>
</div>
