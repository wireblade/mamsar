<div>

    <div class="mb-4">
        <a href="{{ route('employee.index', ['page' => $page]) }}"
            class="inline-flex items-center gap-2 text-sm text-zinc-500 transition hover:text-zinc-900">
            <flux:icon.arrow-left class="size-4" />
            Back to Employee List
        </a>
    </div>

    <div class="mx-auto">

        {{-- header section --}}
        @include('livewire.employee-profile.profile.header')

        {{-- employee information --}}
        @include('livewire.employee-profile.profile.employee-info')


        {{-- ============================================================ --}}
        {{-- EMPLOYEE RECORDS --}}
        {{-- ============================================================ --}}

        <section class="mt-8">

            {{-- Section Header --}}
            <div class="mb-4">

                <h2 class="text-lg font-semibold text-zinc-900">
                    Employee Records
                </h2>

                <p class="mt-1 text-sm text-zinc-500">
                    Employment history and project assignments.
                </p>

            </div>


            {{-- ======================================================== --}}
            {{-- RECORDS CONTAINER --}}
            {{-- ======================================================== --}}

            <div x-data="{
                tab: localStorage.getItem('employeeProfileTab') ?? 'employment',
            
                changeTab(value) {
                    this.tab = value;
                    localStorage.setItem('employeeProfileTab', value);
                }
            }" class="overflow-hidden rounded-2xl border border-zinc-200 bg-white">


                {{-- ==================================================== --}}
                {{-- TABS --}}
                {{-- ==================================================== --}}

                <div class="border-b border-zinc-200 px-6">

                    <div class="flex gap-6">

                        {{-- ============================================ --}}
                        {{-- EMPLOYMENT TAB --}}
                        {{-- ============================================ --}}

                        <button type="button" @click="changeTab('employment')"
                            class="relative py-4 text-sm font-medium transition"
                            :class="tab === 'employment'
                                ?
                                'text-orange-600' :
                                'text-zinc-500 hover:text-zinc-700'">

                            Employment History

                            {{-- Active Indicator --}}
                            <span x-show="tab === 'employment'" x-cloak
                                class="absolute inset-x-0 bottom-0 h-0.5
                               rounded-full bg-orange-500"></span>

                        </button>


                        {{-- ============================================ --}}
                        {{-- PROJECT TAB --}}
                        {{-- ============================================ --}}

                        <button type="button" @click="changeTab('projects')"
                            class="relative py-4 text-sm font-medium transition"
                            :class="tab === 'projects'
                                ?
                                'text-orange-600' :
                                'text-zinc-500 hover:text-zinc-700'">

                            Project Assignments

                            {{-- Active Indicator --}}
                            <span x-show="tab === 'projects'" x-cloak
                                class="absolute inset-x-0 bottom-0 h-0.5
                               rounded-full bg-orange-500"></span>

                        </button>

                    </div>

                </div>


                {{-- ==================================================== --}}
                {{-- EMPLOYMENT HISTORY --}}
                {{-- ==================================================== --}}
                @include('livewire.employee-profile.profile.employments')



                {{-- ==================================================== --}}
                {{-- PROJECT ASSIGNMENTS --}}
                {{-- ==================================================== --}}

                @include('livewire.employee-profile.profile.projects')

            </div>

        </section>


        {{-- ============================================================ --}}
        {{-- ALPINE CLOAK --}}
        {{-- ============================================================ --}}

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

    </div>
</div>
