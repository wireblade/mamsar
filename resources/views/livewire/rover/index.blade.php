<div class="min-h-screen bg-slate-50 text-slate-900">
    {{-- HEADER --}}
    <header class="border-b border-slate-200 bg-white">
        <div
            class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4 lg:px-8"
        >
            <a
                href="{{ route('rover.index') }}"
                class="flex items-center gap-3"
            >
                <div
                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-900 text-lg font-bold text-white shadow-sm"
                >
                    IT
                </div>

                <div>
                    <h1 class="text-lg font-bold tracking-tight text-slate-900">
                        ROVER
                    </h1>
                    <p class="text-xs font-medium text-slate-500">Mamsar IT Support</p>
                </div>
            </a>
        </div>
    </header>

    {{-- MAIN --}}
    <main class="mx-auto max-w-7xl px-6 py-8 lg:px-8 lg:py-10">
        {{-- HERO --}}
        <section
            class="relative overflow-hidden rounded-[28px] bg-slate-900 px-6 py-10 text-white shadow-xl shadow-slate-900/10 sm:px-10 lg:px-14 lg:py-14"
        >
            {{-- Decorative background --}}
            <div
                class="pointer-events-none absolute -right-24 -top-24 h-72 w-72 rounded-full bg-white/5"
            ></div>
            <div
                class="pointer-events-none absolute -bottom-32 right-40 h-64 w-64 rounded-full bg-white/5"
            ></div>

            <div class="relative max-w-3xl">
                {{-- Availability --}}
                <div
                    class="mb-6 inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/10 px-3 py-1.5 text-xs font-medium text-slate-200 backdrop-blur"
                >
                    <span class="relative flex h-2 w-2">
                        <span
                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"
                        ></span>
                        <span
                            class="relative inline-flex h-2 w-2 rounded-full bg-emerald-400"
                        ></span>
                    </span>

                    IT Support is available
                </div>

                <p class="mb-3 text-sm font-semibold uppercase tracking-[0.2em] text-slate-400">Rover IT Support</p>

                <h2
                    class="max-w-2xl text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl"
                >
                    How can we help?
                </h2>

                <p class="mt-5 max-w-2xl text-base leading-7 text-slate-300 sm:text-lg">Experiencing a computer, network, printer, software, or other IT-related problem? Send a ticket and our IT team will assist you.</p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a
                        href="{{ route('rover.create-ticket') }}"
                        wire:navigate
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-bold text-slate-900 shadow-sm transition hover:bg-slate-100"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>

                        Report a Problem
                    </a>
                </div>
            </div>
        </section>

        {{-- TICKETS --}}
        <section id="tickets" class="mt-10">
            {{-- Section heading --}}
            <div
                class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between"
            >
                <div>
                    <p class="text-sm font-semibold text-slate-500">SERVICE REQUESTS</p>

                    <h3
                        class="mt-1 text-2xl font-bold tracking-tight text-slate-900"
                    >
                        Recent Tickets
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">Latest IT concerns submitted by employees.</p>
                </div>

                {{-- Search --}}
                <div class="relative w-full sm:w-72">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m21 21-4.35-4.35m2.35-5.65a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"
                        />
                    </svg>

                    <input
                        type="text"
                        placeholder="Search tickets..."
                        class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-4 focus:ring-slate-100"
                    />
                </div>
            </div>

            {{-- TICKET LIST --}}
            <div class="space-y-3">
                {{-- Ticket 1 --}}
                <div
                    class="group rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:border-slate-300 hover:shadow-md sm:p-5"
                >
                    <div
                        class="flex flex-col gap-5 lg:flex-row lg:items-center"
                    >
                        {{-- Employee --}}
                        <div class="flex min-w-0 items-center gap-3 lg:w-64">
                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-700"
                            >
                                JD
                            </div>

                            <div class="min-w-0">
                                <p class="truncate text-sm font-bold text-slate-900">Juan Dela Cruz</p>

                                <div
                                    class="mt-1 flex items-center gap-1.5 text-xs text-slate-500"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3.5 w-3.5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 21h18M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16M9 9h1m4 0h1M9 13h1m4 0h1M9 17h1m4 0h1"
                                        />
                                    </svg>

                                    Accounting
                                </div>
                            </div>
                        </div>

                        {{-- Ticket info --}}
                        <div
                            class="min-w-0 flex-1 lg:border-l lg:border-slate-100 lg:pl-6"
                        >
                            <div
                                class="mb-1.5 flex flex-wrap items-center gap-2"
                            >
                                <span class="text-xs font-bold text-slate-400">
                                    RV-0001
                                </span>

                                <span
                                    class="rounded-full bg-red-50 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-red-600"
                                >
                                    High
                                </span>
                            </div>

                            <p class="truncate text-sm font-semibold text-slate-900 sm:text-base">Computer won't turn on</p>

                            <p class="mt-1 truncate text-xs text-slate-500">Desktop computer is not powering on even after checking the power connection.</p>
                        </div>

                        {{-- Status/date --}}
                        <div
                            class="flex items-center justify-between gap-6 lg:w-52 lg:justify-end"
                        >
                            <div class="text-right">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-3 py-1.5 text-xs font-semibold text-amber-700"
                                >
                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-amber-500"
                                    ></span>

                                    In Progress
                                </span>

                                <p class="mt-2 text-xs text-slate-400">Sep 8, 2026</p>
                            </div>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="hidden h-5 w-5 text-slate-300 transition group-hover:translate-x-1 group-hover:text-slate-500 sm:block"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m9 18 6-6-6-6"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Ticket 2 --}}
                <div
                    class="group rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:border-slate-300 hover:shadow-md sm:p-5"
                >
                    <div
                        class="flex flex-col gap-5 lg:flex-row lg:items-center"
                    >
                        <div class="flex min-w-0 items-center gap-3 lg:w-64">
                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-violet-100 text-sm font-bold text-violet-700"
                            >
                                MS
                            </div>

                            <div class="min-w-0">
                                <p class="truncate text-sm font-bold text-slate-900">Maria Santos</p>

                                <div
                                    class="mt-1 flex items-center gap-1.5 text-xs text-slate-500"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3.5 w-3.5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 21h18M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16M9 9h1m4 0h1M9 13h1m4 0h1M9 17h1m4 0h1"
                                        />
                                    </svg>

                                    Human Resources
                                </div>
                            </div>
                        </div>

                        <div
                            class="min-w-0 flex-1 lg:border-l lg:border-slate-100 lg:pl-6"
                        >
                            <div class="mb-1.5 flex items-center gap-2">
                                <span class="text-xs font-bold text-slate-400">
                                    RV-0002
                                </span>

                                <span
                                    class="rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-slate-500"
                                >
                                    Normal
                                </span>
                            </div>

                            <p class="truncate text-sm font-semibold text-slate-900 sm:text-base">Printer not working</p>

                            <p class="mt-1 truncate text-xs text-slate-500">Unable to print documents from the HR workstation.</p>
                        </div>

                        <div
                            class="flex items-center justify-between gap-6 lg:w-52 lg:justify-end"
                        >
                            <div class="text-right">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700"
                                >
                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-blue-500"
                                    ></span>

                                    Assigned
                                </span>

                                <p class="mt-2 text-xs text-slate-400">Sep 8, 2026</p>
                            </div>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="hidden h-5 w-5 text-slate-300 transition group-hover:translate-x-1 group-hover:text-slate-500 sm:block"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m9 18 6-6-6-6"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Ticket 3 --}}
                <div
                    class="group rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:border-slate-300 hover:shadow-md sm:p-5"
                >
                    <div
                        class="flex flex-col gap-5 lg:flex-row lg:items-center"
                    >
                        <div class="flex min-w-0 items-center gap-3 lg:w-64">
                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-sm font-bold text-emerald-700"
                            >
                                PR
                            </div>

                            <div class="min-w-0">
                                <p class="truncate text-sm font-bold text-slate-900">Pedro Reyes</p>

                                <div
                                    class="mt-1 flex items-center gap-1.5 text-xs text-slate-500"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3.5 w-3.5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 21h18M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16M9 9h1m4 0h1M9 13h1m4 0h1M9 17h1m4 0h1"
                                        />
                                    </svg>

                                    Engineering
                                </div>
                            </div>
                        </div>

                        <div
                            class="min-w-0 flex-1 lg:border-l lg:border-slate-100 lg:pl-6"
                        >
                            <div class="mb-1.5 flex items-center gap-2">
                                <span class="text-xs font-bold text-slate-400">
                                    RV-0003
                                </span>

                                <span
                                    class="rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-slate-500"
                                >
                                    Normal
                                </span>
                            </div>

                            <p class="truncate text-sm font-semibold text-slate-900 sm:text-base">Internet connection issue</p>

                            <p class="mt-1 truncate text-xs text-slate-500">Workstation was unable to connect to the company network.</p>
                        </div>

                        <div
                            class="flex items-center justify-between gap-6 lg:w-52 lg:justify-end"
                        >
                            <div class="text-right">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700"
                                >
                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-emerald-500"
                                    ></span>

                                    Resolved
                                </span>

                                <p class="mt-2 text-xs text-slate-400">Sep 7, 2026</p>
                            </div>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="hidden h-5 w-5 text-slate-300 transition group-hover:translate-x-1 group-hover:text-slate-500 sm:block"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m9 18 6-6-6-6"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Ticket 4 --}}
                <div
                    class="group rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:border-slate-300 hover:shadow-md sm:p-5"
                >
                    <div
                        class="flex flex-col gap-5 lg:flex-row lg:items-center"
                    >
                        <div class="flex min-w-0 items-center gap-3 lg:w-64">
                            <div
                                class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-orange-100 text-sm font-bold text-orange-700"
                            >
                                AG
                            </div>

                            <div class="min-w-0">
                                <p class="truncate text-sm font-bold text-slate-900">Ana Garcia</p>

                                <div
                                    class="mt-1 flex items-center gap-1.5 text-xs text-slate-500"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-3.5 w-3.5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 21h18M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16M9 9h1m4 0h1M9 13h1m4 0h1M9 17h1m4 0h1"
                                        />
                                    </svg>

                                    Administration
                                </div>
                            </div>
                        </div>

                        <div
                            class="min-w-0 flex-1 lg:border-l lg:border-slate-100 lg:pl-6"
                        >
                            <div class="mb-1.5 flex items-center gap-2">
                                <span class="text-xs font-bold text-slate-400">
                                    RV-0004
                                </span>

                                <span
                                    class="rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wide text-slate-500"
                                >
                                    Normal
                                </span>
                            </div>

                            <p class="truncate text-sm font-semibold text-slate-900 sm:text-base">Cannot access shared folder</p>

                            <p class="mt-1 truncate text-xs text-slate-500">Department shared files are inaccessible from the workstation.</p>
                        </div>

                        <div
                            class="flex items-center justify-between gap-6 lg:w-52 lg:justify-end"
                        >
                            <div class="text-right">
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600"
                                >
                                    <span
                                        class="h-1.5 w-1.5 rounded-full bg-slate-400"
                                    ></span>

                                    New
                                </span>

                                <p class="mt-2 text-xs text-slate-400">Sep 7, 2026</p>
                            </div>

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="hidden h-5 w-5 text-slate-300 transition group-hover:translate-x-1 group-hover:text-slate-500 sm:block"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m9 18 6-6-6-6"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- FOOTER --}}
    <footer class="mt-12 border-t border-slate-200 bg-white">
        <div
            class="mx-auto flex max-w-7xl flex-col gap-2 px-6 py-6 text-center text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between sm:text-left lg:px-8"
        >
            <p>© {{ date('Y') }} Mamsar Construction & Industrial Corporation</p>

            <p>Rover IT Service Desk · Developed by Peter Bill Gamboa</p>
        </div>
    </footer>
</div>
