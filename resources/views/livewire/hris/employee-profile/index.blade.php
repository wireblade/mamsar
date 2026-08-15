<div>
    <div class="space-y-6">

        {{-- ============================================================ --}}
        {{-- HEADER --}}
        {{-- ============================================================ --}}

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-xl font-semibold text-zinc-900">
                    Employees
                </h1>

                <p class="mt-1 text-sm text-zinc-500">
                    Manage employee records and information.
                </p>
            </div>


            {{-- Add Employee --}}
            <button type="button"
                class="inline-flex items-center justify-center gap-2 rounded-lg
                   bg-zinc-900 px-4 py-2.5 text-sm font-medium text-white
                   transition hover:bg-zinc-800">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

                Add Employee

            </button>

        </div>

        {{-- ============================================================ --}}
        {{-- SEARCH / FILTER --}}
        {{-- ============================================================ --}}

        <div class="flex flex-col gap-3 sm:flex-row">

            {{-- Search --}}
            <div class="relative flex-1">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                    stroke="currentColor"
                    class="pointer-events-none absolute left-3 top-1/2 size-4
                       -translate-y-1/2 text-zinc-400">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-4.35-4.35m0 0A7.5 7.5 0 1 0 6.05 6.05a7.5 7.5 0 0 0 10.6 10.6Z" />
                </svg>

                <input wire:model.live="filter" type="text" placeholder="Search employees..."
                    class="w-full rounded-lg border border-zinc-200 bg-white
                       py-2.5 pl-10 pr-4 text-sm text-zinc-900
                       outline-none transition
                       placeholder:text-zinc-400
                       focus:border-zinc-400 focus:ring-2 focus:ring-zinc-100">

            </div>

        </div>

        {{-- ============================================================ --}}
        {{-- TABLE --}}
        {{-- ============================================================ --}}

        <div class="overflow-hidden rounded-xl border border-zinc-200 bg-white">

            <div class="overflow-x-auto">

                <table class="w-full min-w-[900px]">

                    {{-- Table Header --}}
                    <thead class="border-b border-zinc-200 bg-zinc-50/70">

                        <tr>

                            <th
                                class="px-5 py-3.5 text-left text-xs font-semibold
                                   uppercase tracking-wide text-zinc-500">
                                ID No.
                            </th>

                            <th
                                class="px-5 py-3.5 text-left text-xs font-semibold
                                   uppercase tracking-wide text-zinc-500">
                                Employee
                            </th>

                            <th
                                class="px-5 py-3.5 text-left text-xs font-semibold
                                   uppercase tracking-wide text-zinc-500">
                                Position
                            </th>

                            <th
                                class="px-5 py-3.5 text-left text-xs font-semibold
                                   uppercase tracking-wide text-zinc-500">
                                Department
                            </th>

                            <th
                                class="px-5 py-3.5 text-left text-xs font-semibold
                                   uppercase tracking-wide text-zinc-500">
                                Status
                            </th>

                            <th
                                class="px-5 py-3.5 text-right text-xs font-semibold
                                   uppercase tracking-wide text-zinc-500">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    {{-- Table Body --}}
                    <tbody class="divide-y divide-zinc-100">


                        {{-- ================================================= --}}
                        {{-- EMPLOYEE 1 --}}
                        {{-- ================================================= --}}

                        @foreach ($employees as $employee)
                            <tr class="transition hover:bg-zinc-50/60">

                                {{-- ID --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    <span class="text-sm font-medium text-zinc-700">
                                        {{ $employee->empId }}
                                    </span>

                                </td>


                                {{-- Employee --}}
                                <td class="px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        {{-- Profile Picture --}}
                                        <div
                                            class="flex size-10 shrink-0 items-center
                                           justify-center overflow-hidden
                                           rounded-full bg-zinc-100">

                                            <img
                                                src="{{ asset('storage/' . $employee->image?->path . '/' . $employee->image?->pic) }}" />

                                        </div>


                                        {{-- Name --}}
                                        <div>

                                            <p class="text-sm font-medium text-zinc-900">
                                                {{ $this->getFullname($employee->fname, $employee->mname, $employee->lname) }}
                                            </p>

                                            <p class="mt-0.5 text-xs text-zinc-500">
                                                -
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Position --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    <span class="text-sm text-zinc-700">
                                        {{ $employee->position }}
                                    </span>

                                </td>


                                {{-- Department --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    <span class="text-sm text-zinc-600">
                                        -
                                    </span>

                                </td>


                                {{-- Status --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    <span
                                        class="inline-flex items-center gap-1.5
                                       rounded-full bg-green-50 px-2.5 py-1
                                       text-xs font-medium text-green-700">

                                        <span class="size-1.5 rounded-full bg-green-500"></span>

                                        Active

                                    </span>

                                </td>

                                {{-- Actions --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- View --}}
                                        <a href="{{ route('employee.show', ['employee' => $employee->id, 'page' => $employees->currentPage()]) }}"
                                            class="rounded-lg border border-zinc-200
                                           bg-white px-3 py-1.5 text-xs
                                           font-medium text-zinc-700
                                           transition hover:bg-zinc-50">
                                            View
                                        </a>

                                        {{-- Edit --}}
                                        <button type="button"
                                            class="rounded-lg border border-zinc-200
                                           bg-white px-3 py-1.5 text-xs
                                           font-medium text-zinc-700
                                           transition hover:bg-zinc-50">
                                            Edit
                                        </button>

                                        {{-- Delete --}}
                                        <button type="button"
                                            class="rounded-lg border border-red-200
                                           bg-white px-3 py-1.5 text-xs
                                           font-medium text-red-600
                                           transition hover:bg-red-50">
                                            Delete
                                        </button>

                                    </div>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- ======================================================== --}}
            {{-- TABLE FOOTER --}}
            {{-- ======================================================== --}}

            <!-- Pagination -->
            <div class="p-4 border-zinc-200 bg-zinc-50/70 dark:bg-gray-800 border-t dark:border-gray-700">
                {{ $employees->links(data: ['scrollTo' => false]) }}
            </div>

        </div>

    </div>
</div>
