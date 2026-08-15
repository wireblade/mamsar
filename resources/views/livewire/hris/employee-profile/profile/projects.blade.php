<div x-show="tab === 'projects'" x-cloak class="p-6">

    {{-- ================================================ --}}
    {{-- HEADER --}}
    {{-- ================================================ --}}

    <div class="mb-6 flex items-center justify-between gap-4">

        <div>

            <h3 class="text-base font-semibold text-zinc-900">
                Project Assignments
            </h3>

            <p class="mt-1 text-sm text-zinc-500">
                Projects assigned to the employee.
            </p>

        </div>


        {{-- Add Project --}}
        <button type="button"
            class="inline-flex shrink-0 items-center gap-2
                           rounded-lg border border-zinc-200 bg-white
                           px-3 py-2 text-sm font-medium text-zinc-700
                           shadow-sm transition
                           hover:bg-zinc-50 hover:text-zinc-900">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>

            Add Project

        </button>

    </div>



    {{-- ================================================ --}}
    {{-- PROJECT TIMELINE --}}
    {{-- ================================================ --}}

    <div class="space-y-8">


        {{-- ============================================ --}}
        {{-- CURRENT PROJECT --}}
        {{-- ============================================ --}}

        <div class="relative pl-8">

            {{-- Timeline Line --}}
            <div class="absolute left-[7px] top-4 h-full w-px
                               bg-zinc-200">
            </div>

            {{-- Timeline Dot --}}
            <div
                class="absolute left-0 top-1.5 size-4 rounded-full
                               border-2 border-orange-500 bg-white">
            </div>


            <div>

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <div class="flex flex-wrap items-center gap-2">

                            <h3 class="text-sm font-semibold text-zinc-900">
                                Iligan City Warehouse Project
                            </h3>

                            <span
                                class="rounded-full bg-green-50 px-2.5 py-1
                                               text-xs font-medium text-green-700">
                                Active
                            </span>

                        </div>

                        <p class="mt-1 text-sm text-zinc-600">
                            Field Worker
                        </p>

                    </div>


                    {{-- Three Dot Menu --}}
                    <div x-data="{ open: false }" @click.outside="open = false" class="relative">

                        <button type="button" @click="open = !open"
                            class="flex size-8 items-center
                                           justify-center rounded-lg
                                           text-zinc-400 transition
                                           hover:bg-zinc-100
                                           hover:text-zinc-700">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.75h.008v.008H12V6.75Zm0 5.25h.008v.008H12V12Zm0 5.25h.008v.008H12V17.25Z" />
                            </svg>

                        </button>


                        <div x-cloak x-show="open" x-transition
                            class="absolute right-0 z-20 mt-2 w-32
                                           overflow-hidden rounded-lg border
                                           border-zinc-200 bg-white py-1
                                           shadow-lg">

                            <button type="button" @click="open = false"
                                class="block w-full px-3 py-2
                                               text-left text-sm
                                               text-zinc-700
                                               hover:bg-zinc-50">
                                Edit
                            </button>

                            <button type="button" @click="open = false"
                                class="block w-full px-3 py-2
                                               text-left text-sm
                                               text-red-600
                                               hover:bg-red-50">
                                Delete
                            </button>

                        </div>

                    </div>

                </div>


                <p class="mt-1 text-xs text-zinc-400">
                    January 2025 – Present
                </p>


                <div
                    class="mt-4 flex flex-wrap gap-x-8 gap-y-2
                                   text-xs text-zinc-500">

                    <span>
                        <span class="font-medium text-zinc-700">
                            Location:
                        </span>
                        Iligan City, Lanao del Norte
                    </span>

                    <span>
                        <span class="font-medium text-zinc-700">
                            Project Code:
                        </span>
                        MAMSAR-2025-001
                    </span>

                </div>

            </div>

        </div>



        {{-- ============================================ --}}
        {{-- SECOND PROJECT --}}
        {{-- ============================================ --}}

        <div class="relative pl-8">

            {{-- Timeline Line --}}
            <div class="absolute left-[7px] top-4 h-full w-px
                               bg-zinc-200">
            </div>

            {{-- Timeline Dot --}}
            <div
                class="absolute left-0 top-1.5 size-4 rounded-full
                               border-2 border-zinc-300 bg-white">
            </div>


            <div>

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <div class="flex flex-wrap items-center gap-2">

                            <h3 class="text-sm font-semibold text-zinc-900">
                                Cagayan de Oro Commercial Building
                            </h3>

                            <span
                                class="rounded-full bg-zinc-100 px-2.5 py-1
                                               text-xs font-medium text-zinc-600">
                                Completed
                            </span>

                        </div>

                        <p class="mt-1 text-sm text-zinc-600">
                            Field Worker
                        </p>

                    </div>


                    {{-- Three Dot Menu --}}
                    <div x-data="{ open: false }" @click.outside="open = false" class="relative">

                        <button type="button" @click="open = !open"
                            class="flex size-8 items-center
                                           justify-center rounded-lg
                                           text-zinc-400 transition
                                           hover:bg-zinc-100
                                           hover:text-zinc-700">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.75h.008v.008H12V6.75Zm0 5.25h.008v.008H12V12Zm0 5.25h.008v.008H12V17.25Z" />
                            </svg>

                        </button>


                        <div x-cloak x-show="open" x-transition
                            class="absolute right-0 z-20 mt-2 w-32
                                           overflow-hidden rounded-lg border
                                           border-zinc-200 bg-white py-1
                                           shadow-lg">

                            <button type="button" @click="open = false"
                                class="block w-full px-3 py-2
                                               text-left text-sm
                                               text-zinc-700
                                               hover:bg-zinc-50">
                                Edit
                            </button>

                            <button type="button" @click="open = false"
                                class="block w-full px-3 py-2
                                               text-left text-sm
                                               text-red-600
                                               hover:bg-red-50">
                                Delete
                            </button>

                        </div>

                    </div>

                </div>


                <p class="mt-1 text-xs text-zinc-400">
                    June 2024 – December 2024
                </p>


                <div
                    class="mt-4 flex flex-wrap gap-x-8 gap-y-2
                                   text-xs text-zinc-500">

                    <span>
                        <span class="font-medium text-zinc-700">
                            Location:
                        </span>
                        Cagayan de Oro City
                    </span>

                    <span>
                        <span class="font-medium text-zinc-700">
                            Project Code:
                        </span>
                        MAMSAR-2024-008
                    </span>

                </div>

            </div>

        </div>



        {{-- ============================================ --}}
        {{-- THIRD PROJECT --}}
        {{-- ============================================ --}}

        <div class="relative pl-8">

            {{-- Timeline Dot --}}
            <div
                class="absolute left-0 top-1.5 size-4 rounded-full
                               border-2 border-zinc-300 bg-white">
            </div>


            <div>

                <div class="flex items-start justify-between gap-4">

                    <div>

                        <div class="flex flex-wrap items-center gap-2">

                            <h3 class="text-sm font-semibold text-zinc-900">
                                Bukidnon Road Construction
                            </h3>

                            <span
                                class="rounded-full bg-zinc-100 px-2.5 py-1
                                               text-xs font-medium text-zinc-600">
                                Completed
                            </span>

                        </div>

                        <p class="mt-1 text-sm text-zinc-600">
                            Field Worker
                        </p>

                    </div>


                    {{-- Three Dot Menu --}}
                    <div x-data="{ open: false }" @click.outside="open = false" class="relative">

                        <button type="button" @click="open = !open"
                            class="flex size-8 items-center
                                           justify-center rounded-lg
                                           text-zinc-400 transition
                                           hover:bg-zinc-100
                                           hover:text-zinc-700">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6.75h.008v.008H12V6.75Zm0 5.25h.008v.008H12V12Zm0 5.25h.008v.008H12V17.25Z" />
                            </svg>

                        </button>


                        <div x-cloak x-show="open" x-transition
                            class="absolute right-0 z-20 mt-2 w-32
                                           overflow-hidden rounded-lg border
                                           border-zinc-200 bg-white py-1
                                           shadow-lg">

                            <button type="button" @click="open = false"
                                class="block w-full px-3 py-2
                                               text-left text-sm
                                               text-zinc-700
                                               hover:bg-zinc-50">
                                Edit
                            </button>

                            <button type="button" @click="open = false"
                                class="block w-full px-3 py-2
                                               text-left text-sm
                                               text-red-600
                                               hover:bg-red-50">
                                Delete
                            </button>

                        </div>

                    </div>

                </div>


                <p class="mt-1 text-xs text-zinc-400">
                    January 2024 – May 2024
                </p>


                <div
                    class="mt-4 flex flex-wrap gap-x-8 gap-y-2
                                   text-xs text-zinc-500">

                    <span>
                        <span class="font-medium text-zinc-700">
                            Location:
                        </span>
                        Malaybalay, Bukidnon
                    </span>

                    <span>
                        <span class="font-medium text-zinc-700">
                            Project Code:
                        </span>
                        MAMSAR-2024-003
                    </span>

                </div>

            </div>

        </div>


    </div>

</div>
