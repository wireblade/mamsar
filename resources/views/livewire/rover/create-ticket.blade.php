<div class="min-h-screen bg-slate-50">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 sm:px-6 lg:px-8">

            {{-- Rover --}}
            <a
                href="{{ route('rover.index') }}"
                class="flex items-center gap-3"
            >

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900 text-lg font-bold text-white shadow-sm">
                    R
                </div>

                <div class="leading-tight">
                    <div class="text-base font-bold tracking-tight text-slate-900">
                        ROVER
                    </div>

                    <div class="text-[11px] font-medium uppercase tracking-wider text-slate-400">
                        IT Service Desk
                    </div>
                </div>

            </a>


            {{-- Back --}}
            <a
                href="{{ route('rover.index') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="h-4 w-4"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15.75 19.5 8.25 12l7.5-7.5"
                    />
                </svg>

                <span class="hidden sm:inline">
                    Back to Tickets
                </span>

                <span class="sm:hidden">
                    Back
                </span>

            </a>

        </div>
    </header>



    {{-- =========================================================
        MAIN
    ========================================================== --}}
    <main class="mx-auto max-w-3xl px-5 py-10 sm:px-6 lg:px-8">


        {{-- =====================================================
            PAGE INTRO
        ====================================================== --}}
        <div class="mb-8">

            <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-white shadow-sm">

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.8"
                    stroke="currentColor"
                    class="h-6 w-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15"
                    />
                </svg>

            </div>


            <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                Report a Problem
            </h1>

            <p class="mt-2 max-w-xl text-sm leading-6 text-slate-500">
                Tell us what is happening and where you need assistance.
                Our IT support team will review your request.
            </p>

        </div>



        {{-- =====================================================
            FORM
        ====================================================== --}}
        <form
            wire:submit="save"
            class="space-y-6"
        >


            {{-- =================================================
                YOUR INFORMATION
            ================================================== --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-6 py-5">

                    <h2 class="text-sm font-semibold text-slate-900">
                        Your Information
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Tell us who is experiencing the problem.
                    </p>

                </div>


                <div class="space-y-5 p-6">

                    {{-- Name --}}
                    <div>

                        <label
                            for="name"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Full Name
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="name"
                            type="text"
                            wire:model="name"
                            placeholder="Juan Dela Cruz"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-4 focus:ring-slate-100"
                        >

                        @error('name')
                            <p class="mt-1.5 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Department --}}
                    <div>

                        <label
                            for="department"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Department
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="department"
                            wire:model="department"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-4 focus:ring-slate-100"
                        >

                            <option value="">
                                Select your department
                            </option>

                            <option value="Administration">
                                Administration
                            </option>

                            <option value="Accounting">
                                Accounting
                            </option>

                            <option value="Engineering">
                                Engineering
                            </option>

                            <option value="Human Resources">
                                Human Resources
                            </option>

                            <option value="Purchasing">
                                Purchasing
                            </option>

                            <option value="Operations">
                                Operations
                            </option>

                            <option value="IT">
                                IT
                            </option>

                            <option value="Other">
                                Other
                            </option>

                        </select>

                        @error('department')
                            <p class="mt-1.5 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </section>



            {{-- =================================================
                PROBLEM DETAILS
            ================================================== --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-100 px-6 py-5">

                    <h2 class="text-sm font-semibold text-slate-900">
                        Problem Details
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Give us enough information to understand the issue.
                    </p>

                </div>


                <div class="space-y-5 p-6">

                    {{-- Subject --}}
                    <div>

                        <label
                            for="subject"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            What is the problem?
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            id="subject"
                            type="text"
                            wire:model="subject"
                            placeholder="e.g. Computer won't turn on"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-4 focus:ring-slate-100"
                        >

                        @error('subject')
                            <p class="mt-1.5 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Description --}}
                    <div>

                        <label
                            for="description"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Describe the problem
                        </label>

                        <textarea
                            id="description"
                            wire:model="description"
                            rows="5"
                            placeholder="Please describe what happened, what you were doing when the problem occurred, or any error message you saw."
                            class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm leading-6 text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-4 focus:ring-slate-100"
                        ></textarea>

                        @error('description')
                            <p class="mt-1.5 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Priority --}}
                    <div>

                        <label
                            for="priority"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Priority
                        </label>

                        <select
                            id="priority"
                            wire:model="priority"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-4 focus:ring-slate-100"
                        >

                            <option value="low">
                                Low — Can wait
                            </option>

                            <option value="normal">
                                Normal — Regular issue
                            </option>

                            <option value="high">
                                High — Affecting work
                            </option>

                            <option value="urgent">
                                Urgent — Cannot work
                            </option>

                        </select>

                        @error('priority')
                            <p class="mt-1.5 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </section>



            {{-- =================================================
                INFORMATION NOTICE
            ================================================== --}}
            <div class="flex gap-3 rounded-2xl border border-blue-100 bg-blue-50 p-4">

                <div class="mt-0.5 shrink-0">

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.8"
                        stroke="currentColor"
                        class="h-5 w-5 text-blue-600"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v3.75m0 3h.008v.008H12V15.75ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                        />
                    </svg>

                </div>


                <div>

                    <p class="text-sm font-medium text-blue-900">
                        What happens next?
                    </p>

                    <p class="mt-1 text-xs leading-5 text-blue-700">
                        Your request will be recorded by the IT Service Desk.
                        An IT staff member will review the problem and provide assistance.
                    </p>

                </div>

            </div>



            {{-- =================================================
                ACTIONS
            ================================================== --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('rover.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 disabled:cursor-not-allowed disabled:opacity-60"
                >

                    <svg
                        wire:loading
                        wire:target="save"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="h-4 w-4 animate-spin"
                    >
                        <path
                            stroke-linecap="round"
                            d="M12 3a9 9 0 1 0 9 9"
                        />
                    </svg>


                    <span wire:loading.remove wire:target="save">
                        Submit Ticket
                    </span>

                    <span wire:loading wire:target="save">
                        Submitting...
                    </span>

                </button>

            </div>


        </form>


        {{-- Footer --}}
        <div class="mt-10 text-center">

            <p class="text-xs text-slate-400">
                ROVER IT Service Desk
            </p>

            <p class="mt-1 text-[11px] text-slate-400">
                Internal IT Support
            </p>

        </div>

    </main>

</div>