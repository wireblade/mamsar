{{-- Personal Information --}}
<section class="mt-6">

    <div class="mb-4">
        <h2 class="text-lg font-semibold text-zinc-900">
            Personal Information
        </h2>

        <p class="mt-1 text-sm text-zinc-500">
            Personal and contact details of the employee.
        </p>
    </div>


    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">

        {{-- Basic Information --}}
        <div class="rounded-2xl border border-zinc-200 bg-white p-6">

            <div class="mb-6 flex items-center gap-3">

                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-50 text-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a8.25 8.25 0 0 1 15 0" />
                    </svg>
                </div>

                <div>
                    <h3 class="font-semibold text-zinc-900">
                        Basic Information
                    </h3>

                    <p class="text-xs text-zinc-500">
                        Personal details
                    </p>
                </div>

            </div>


            <div class="grid grid-cols-1 gap-x-8 gap-y-5 sm:grid-cols-2">

                {{-- First Name --}}
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                        First Name
                    </p>

                    <p class="mt-1 text-sm font-medium text-zinc-900">
                        {{ $fname ?: '—' }}
                    </p>
                </div>


                {{-- Middle Name --}}
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                        Middle Name
                    </p>

                    <p class="mt-1 text-sm font-medium text-zinc-900">
                        {{ $mname ?: '—' }}
                    </p>
                </div>


                {{-- Last Name --}}
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                        Last Name
                    </p>

                    <p class="mt-1 text-sm font-medium text-zinc-900">
                        {{ $lname ?: '—' }}
                    </p>
                </div>


                {{-- Date of Birth --}}
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                        Date of Birth
                    </p>

                    <p class="mt-1 text-sm font-medium text-zinc-900">
                        {{ $dob ? \Carbon\Carbon::parse($dob)->format('M j, Y') : '—' }}
                    </p>
                </div>


                {{-- Gender --}}
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                        Gender
                    </p>

                    <p class="mt-1 text-sm font-medium text-zinc-900">
                        {{ $gender ?: '—' }}
                    </p>
                </div>


                {{-- Civil Status --}}
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                        Civil Status
                    </p>

                    <p class="mt-1 text-sm font-medium text-zinc-900">
                        {{ $civil_status ?: '—' }}
                    </p>
                </div>

            </div>

        </div>


        {{-- Contact Information --}}
        <div class="rounded-2xl border border-zinc-200 bg-white p-6">

            <div class="mb-6 flex items-center gap-3">

                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-50 text-orange-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106a1.125 1.125 0 0 0-1.173.417l-.97 1.293c-.46.613-1.316.806-1.998.447a12.035 12.035 0 0 1-5.545-5.545c-.359-.682-.166-1.538.447-1.998l1.293-.97c.394-.296.56-.8.417-1.173L7.875 4.102a1.125 1.125 0 0 0-1.091-.852H5.25A2.25 2.25 0 0 0 3 5.5v1.25Z" />
                    </svg>
                </div>

                <div>
                    <h3 class="font-semibold text-zinc-900">
                        Contact Information
                    </h3>

                    <p class="text-xs text-zinc-500">
                        Contact and address details
                    </p>
                </div>

            </div>


            <div class="space-y-5">

                {{-- Contact Number --}}
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                        Contact Number
                    </p>

                    <p class="mt-1 text-sm font-medium text-zinc-900">
                        {{ $contactNumber ?: '—' }}
                    </p>
                </div>


                {{-- Email --}}
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                        Email Address
                    </p>

                    <p class="mt-1 break-all text-sm font-medium text-zinc-900">
                        {{ $email ?: '—' }}
                    </p>
                </div>


                {{-- Address --}}
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                        Address
                    </p>

                    <p class="mt-1 text-sm font-medium leading-6 text-zinc-900">
                        {{ $address ?: '—' }}
                    </p>
                </div>

            </div>

        </div>

    </div>

</section>

{{-- Employment Information --}}
<section class="mt-6">

    <div class="mb-4">
        <h2 class="text-lg font-semibold text-zinc-900">
            Employment Information
        </h2>

        <p class="mt-1 text-sm text-zinc-500">
            Information related to the employee's employment.
        </p>
    </div>


    <div class="rounded-2xl border border-zinc-200 bg-white p-6">

        {{-- Section Header --}}
        <div class="mb-6 flex items-center gap-3">

            <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-50 text-orange-600">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                    stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 14.15v4.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25v-4.25m16.5 0-7.5-3.75-7.5 3.75m15 0v-3.75a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25v3.75m7.5-6V3.75m0 0-3 3m3-3 3 3" />
                </svg>

            </div>

            <div>
                <h3 class="font-semibold text-zinc-900">
                    Employment Details
                </h3>

                <p class="text-xs text-zinc-500">
                    Current employment information
                </p>
            </div>

        </div>


        {{-- Employment Details --}}
        <div class="grid grid-cols-1 gap-x-10 gap-y-6 sm:grid-cols-2 lg:grid-cols-3">

            {{-- Department --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                    Department
                </p>

                <p class="mt-1 text-sm font-medium text-zinc-900">
                    {{ $department ?? '—' }}
                </p>

            </div>


            {{-- Employment Type --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                    Employment Type
                </p>

                <p class="mt-1 text-sm font-medium text-zinc-900">
                    {{ $empType ?: '—' }}
                </p>

            </div>


            {{-- Date Hired --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                    Date Hired
                </p>

                <p class="mt-1 text-sm font-medium text-zinc-900">

                    {{ $dateHired ? \Carbon\Carbon::parse($dateHired)->format('M j, Y') : '—' }}

                </p>

            </div>


            {{-- Immediate Head --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                    Immediate Head
                </p>

                <p class="mt-1 text-sm font-medium text-zinc-900">
                    {{ $supervisor ?: '—' }}
                </p>

            </div>


            {{-- Work Location --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                    Work Location
                </p>

                <p class="mt-1 text-sm font-medium text-zinc-900">
                    {{ $workLoc ?: '—' }}
                </p>

            </div>


            {{-- Years of Service --}}
            <div>

                <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                    Years of Service
                </p>

                <p class="mt-1 text-sm font-medium text-zinc-900">

                    @if ($dateHired)
                        {{ $years = number_format(\Carbon\Carbon::parse($dateHired)->floatDiffInYears(now()), 1) }}
                    @else
                        —
                    @endif

                </p>

            </div>

        </div>

    </div>

</section>

{{-- Government Identification --}}
<section class="mt-6">

    <div class="mb-4">
        <h2 class="text-lg font-semibold text-zinc-900">
            Government Identification
        </h2>

        <p class="mt-1 text-sm text-zinc-500">
            Government-issued identification numbers of the employee.
        </p>
    </div>


    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        {{-- SSS --}}
        <div class="rounded-2xl border border-zinc-200 bg-white p-5">

            <div class="flex items-center gap-3">

                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-50 text-orange-600">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2.25-10.5h-4.5a2.25 2.25 0 0 1-4.5 0h-4.5A2.25 2.25 0 0 0 3 7.75v10.5A2.25 2.25 0 0 0 5.25 20.5h13.5A2.25 2.25 0 0 0 21 18.25V7.75a2.25 2.25 0 0 0-2.25-2.25Z" />
                    </svg>

                </div>

                <div>
                    <p class="text-sm font-semibold text-zinc-900">
                        SSS
                    </p>

                    <p class="text-xs text-zinc-400">
                        Social Security System
                    </p>
                </div>

            </div>


            <div class="mt-5">

                <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                    SSS Number
                </p>

                <p class="mt-1 font-mono text-sm font-medium tracking-wide text-zinc-900">
                    {{ $sss ?: '—' }}
                </p>

            </div>

        </div>


        {{-- PhilHealth --}}
        <div class="rounded-2xl border border-zinc-200 bg-white p-5">

            <div class="flex items-center gap-3">

                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-50 text-orange-600">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m9-9H3" />
                    </svg>

                </div>

                <div>
                    <p class="text-sm font-semibold text-zinc-900">
                        PhilHealth
                    </p>

                    <p class="text-xs text-zinc-400">
                        Philippine Health Insurance
                    </p>
                </div>

            </div>


            <div class="mt-5">

                <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                    PhilHealth Number
                </p>

                <p class="mt-1 font-mono text-sm font-medium tracking-wide text-zinc-900">
                    {{ $philhealth ?: '—' }}
                </p>

            </div>

        </div>


        {{-- Pag-IBIG --}}
        <div class="rounded-2xl border border-zinc-200 bg-white p-5">

            <div class="flex items-center gap-3">

                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-50 text-orange-600">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 21h18M4.5 21V10.5L12 4l7.5 6.5V21M9 21v-6h6v6" />
                    </svg>

                </div>

                <div>
                    <p class="text-sm font-semibold text-zinc-900">
                        Pag-IBIG
                    </p>

                    <p class="text-xs text-zinc-400">
                        Home Development Mutual Fund
                    </p>
                </div>

            </div>


            <div class="mt-5">

                <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                    Pag-IBIG Number
                </p>

                <p class="mt-1 font-mono text-sm font-medium tracking-wide text-zinc-900">
                    {{ $pagibig ?: '—' }}
                </p>

            </div>

        </div>


        {{-- TIN --}}
        <div class="rounded-2xl border border-zinc-200 bg-white p-5">

            <div class="flex items-center gap-3">

                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-orange-50 text-orange-600">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                        stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 9h.01M12 12h.01M9 15h.01M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z" />
                    </svg>

                </div>

                <div>
                    <p class="text-sm font-semibold text-zinc-900">
                        TIN
                    </p>

                    <p class="text-xs text-zinc-400">
                        Tax Identification Number
                    </p>
                </div>

            </div>


            <div class="mt-5">

                <p class="text-xs font-medium uppercase tracking-wide text-zinc-400">
                    TIN Number
                </p>

                <p class="mt-1 font-mono text-sm font-medium tracking-wide text-zinc-900">
                    {{ $tin ?: '—' }}
                </p>

            </div>

        </div>

    </div>

</section>
