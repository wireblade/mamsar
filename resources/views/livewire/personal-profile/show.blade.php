<div>
     <div class="max-w-7xl mx-auto p-6 space-y-6">

    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

        <!-- Cover -->
        <div class="h-40 bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-500"></div>

        <div class="px-8 pb-8">

            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between">

                <div class="flex items-end gap-6 -mt-16">

                    <img
                        src="{{ $employee->photo_url }}"
                        class="w-32 h-32 rounded-2xl border-4 border-white object-cover shadow-lg"
                    >

                    <div class="pb-2">

                        <h1 class="text-3xl font-bold text-slate-900">
                            {{ $employee->full_name }}
                        </h1>

                        <p class="text-slate-600">
                            {{ $employee->position->name }}
                        </p>

                        <div class="flex flex-wrap gap-3 mt-3">

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                                Active
                            </span>

                            <span class="px-3 py-1 rounded-full bg-slate-100 text-slate-700 text-sm">
                                {{ $employee->employee_number }}
                            </span>

                            <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-sm">
                                {{ $employee->department->name }}
                            </span>

                        </div>

                    </div>

                </div>

                <div class="mt-6 lg:mt-0">

                    <button
                        class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white hover:bg-indigo-700 transition"
                    >
                        Edit Profile
                    </button>

                </div>

            </div>

        </div>

    </div>

    <!-- Information Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- Personal -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200">

            <div class="border-b px-6 py-4">
                <h2 class="font-semibold text-lg">
                    Personal Information
                </h2>
            </div>

            <div class="divide-y">

                @foreach([
                    'Birthday' => $employee->birth_date,
                    'Gender' => $employee->gender,
                    'Civil Status' => $employee->civil_status,
                    'Nationality' => $employee->nationality,
                    'Address' => $employee->address,
                ] as $label => $value)

                <div class="flex justify-between px-6 py-4">
                    <span class="text-slate-500">{{ $label }}</span>
                    <span class="font-medium">{{ $value }}</span>
                </div>

                @endforeach

            </div>

        </div>

        <!-- Employment -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200">

            <div class="border-b px-6 py-4">
                <h2 class="font-semibold text-lg">
                    Employment Information
                </h2>
            </div>

            <div class="divide-y">

                @foreach([
                    'Employee ID' => $employee->employee_number,
                    'Department' => $employee->department->name,
                    'Position' => $employee->position->name,
                    'Employment Status' => $employee->employment_status,
                    'Date Hired' => $employee->hire_date,
                    'Supervisor' => $employee->supervisor?->full_name,
                ] as $label => $value)

                <div class="flex justify-between px-6 py-4">
                    <span class="text-slate-500">{{ $label }}</span>
                    <span class="font-medium">{{ $value }}</span>
                </div>

                @endforeach

            </div>

        </div>

        <!-- Contact -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200">

            <div class="border-b px-6 py-4">
                <h2 class="font-semibold text-lg">
                    Contact Information
                </h2>
            </div>

            <div class="divide-y">

                <div class="flex justify-between px-6 py-4">
                    <span>Email</span>
                    <span>{{ $employee->email }}</span>
                </div>

                <div class="flex justify-between px-6 py-4">
                    <span>Phone</span>
                    <span>{{ $employee->phone }}</span>
                </div>

            </div>

        </div>

        <!-- Government -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200">

            <div class="border-b px-6 py-4">
                <h2 class="font-semibold text-lg">
                    Government Information
                </h2>
            </div>

            <div class="divide-y">

                <div class="flex justify-between px-6 py-4">
                    <span>SSS</span>
                    <span>{{ $employee->sss }}</span>
                </div>

                <div class="flex justify-between px-6 py-4">
                    <span>PhilHealth</span>
                    <span>{{ $employee->philhealth }}</span>
                </div>

                <div class="flex justify-between px-6 py-4">
                    <span>Pag-IBIG</span>
                    <span>{{ $employee->pagibig }}</span>
                </div>

                <div class="flex justify-between px-6 py-4">
                    <span>TIN</span>
                    <span>{{ $employee->tin }}</span>
                </div>

            </div>

        </div>

    </div>

</div>
</div>
