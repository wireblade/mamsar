<div class="space-y-6">
    {{-- Header --}}
    <div
        class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
    >
        <div>
            <h1
                class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white"
            >
                Companies
            </h1>

            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Manage companies under the MAMSAR Group.</p>
        </div>

        <flux:button icon="plus"> Add Company </flux:button>
    </div>

    {{-- Companies Table --}}
    <div
        class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900"
    >
        {{-- Table Header --}}
        <div
            class="flex items-center justify-between border-b border-zinc-200 px-6 py-4 dark:border-zinc-700"
        >
            <div>
                <h2 class="font-semibold text-zinc-900 dark:text-white">
                    Company List
                </h2>

                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">3 companies registered</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead
                    class="border-b border-zinc-200 bg-zinc-50/70 dark:border-zinc-700 dark:bg-zinc-800/50"
                >
                    <tr>
                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                        >
                            Company
                        </th>

                        <th
                            class="px-6 py-3 text-xs font-medium uppercase tracking-wide text-zinc-500 dark:text-zinc-400"
                        >
                            Code
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

                        <th class="w-20 px-6 py-3">
                            <span class="sr-only"> Actions </span>
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800">
                    {{-- MCIC --}}
                    <tr
                        class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                    >
                        {{-- Company --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                                >
                                    <flux:icon.building-office-2
                                        class="size-5 text-zinc-600 dark:text-zinc-300"
                                    />
                                </div>

                                <div>
                                    <p class="font-medium text-zinc-900 dark:text-zinc-100">Mamsar Construction & Industrial Corporation</p>

                                    <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">MAMSAR Group</p>
                                </div>
                            </div>
                        </td>

                        {{-- Code --}}
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                            >
                                MCIC
                            </span>
                        </td>

                        {{-- Description --}}
                        <td
                            class="max-w-xs px-6 py-4 text-sm leading-5 text-zinc-600 dark:text-zinc-300"
                        >
                            Construction and industrial manpower operations.
                        </td>

                        {{-- Status --}}
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

                        {{-- Actions --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-1">
                                <flux:button
                                    href="{{ route('company.show', 1) }}"
                                    wire:navigate
                                    variant="ghost"
                                    size="sm"
                                    icon="eye"
                                >
                                    View
                                </flux:button>

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
                            </div>
                        </td>
                    </tr>

                    {{-- 4K Development --}}
                    <tr
                        class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                    >
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                                >
                                    <flux:icon.building-office-2
                                        class="size-5 text-zinc-600 dark:text-zinc-300"
                                    />
                                </div>

                                <div>
                                    <p class="font-medium text-zinc-900 dark:text-zinc-100">4K Development Corporation</p>

                                    <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">MAMSAR Group</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                            >
                                4K
                            </span>
                        </td>

                        <td
                            class="max-w-xs px-6 py-4 text-sm leading-5 text-zinc-600 dark:text-zinc-300"
                        >
                            Equipment and logistics support for company
                            projects.
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
                            <div class="flex items-center justify-end gap-1">
                                <flux:button
                                    href="{{ route('company.show', 2) }}"
                                    wire:navigate
                                    variant="ghost"
                                    size="sm"
                                    icon="eye"
                                >
                                    View
                                </flux:button>

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
                            </div>
                        </td>
                    </tr>

                    {{-- Zeeman --}}
                    <tr
                        class="transition hover:bg-zinc-50/70 dark:hover:bg-zinc-800/40"
                    >
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex size-10 shrink-0 items-center justify-center rounded-lg bg-zinc-100 dark:bg-zinc-800"
                                >
                                    <flux:icon.building-office-2
                                        class="size-5 text-zinc-600 dark:text-zinc-300"
                                    />
                                </div>

                                <div>
                                    <p class="font-medium text-zinc-900 dark:text-zinc-100">Zeeman Marine & Logistics Services Inc.</p>

                                    <p class="mt-0.5 text-xs text-zinc-500 dark:text-zinc-400">MAMSAR Group</p>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span
                                class="inline-flex rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300"
                            >
                                ZMLS
                            </span>
                        </td>

                        <td
                            class="max-w-xs px-6 py-4 text-sm leading-5 text-zinc-600 dark:text-zinc-300"
                        >
                            Marine logistics utilizing tugboats and barges.
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
                            <div class="flex items-center justify-end gap-1">
                                <flux:button
                                    href="{{ route('company.show', 3) }}"
                                    wire:navigate
                                    variant="ghost"
                                    size="sm"
                                    icon="eye"
                                >
                                    View
                                </flux:button>

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
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        <div
            class="flex items-center justify-between border-t border-zinc-200 px-6 py-4 dark:border-zinc-700"
        >
            <p class="text-sm text-zinc-500 dark:text-zinc-400">Showing
            <span class="font-medium text-zinc-700 dark:text-zinc-300"> 3 </span>
            companies</p>
        </div>
    </div>
</div>
