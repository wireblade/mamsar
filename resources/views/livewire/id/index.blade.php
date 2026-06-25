<div class="min-h-screen bg-gradient-to-br from-gray-100 via-blue-50 to-gray-200 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-6 h">

    <a href="{{ route('id.create') }}" class="bg-blue-600 rounded-md px-3 py-2 hover:bg-blue-700 text-white tansition duration-200 cursor-pointer">
        <span class="fa fa-plus fa-sm"></span> Add Employee
    </a>

    <div class="mt-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg w-full overflow-x-auto">

        <!-- Table -->
        <table class="min-w-full text-sm text-left">

            <!-- Header -->
            <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-1">No</th>
                    <th class="px-6 py-1">ID No.</th>
                    <th class="px-6 py-1 text-center">Picture</th>
                    <th class="px-6 py-1 text-center">Signature</th>
                    <th class="px-6 py-1">Name</th>
                    <th class="px-6 py-1">Position</th>
                    <th class="px-6 py-1">Civil Status</th>
                    <th class="px-6 py-1">Address</th>
                    <th class="px-6 py-1">EC Name</th>
                    <th class="px-6 py-1">EC Number</th>
                    <th class="px-6 py-1">SSS</th>
                    <th class="px-6 py-1">PHIC</th>
                    <th class="px-6 py-1">HDMF</th>
                    <th class="px-6 py-1 text-center">Action</th>
                </tr>
            </thead>

            <!-- Body -->
            <tbody class="text-gray-700 dark:text-gray-300">

                @forelse ($employees as $employee)

                    <tr class="border-b dark:border-gray-700 even:bg-gray-50 dark:even:bg-gray-900 hover:bg-blue-50 dark:hover:bg-gray-700 transition">

                        <!-- No -->
                        <td class="px-6 py-4">
                            {{$employees->firstItem() + $loop->index}}
                        </td>

                        <!-- ID -->
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            {{$employee->empId}}
                        </td>

                        <!-- Picture -->
                        <td class="px-6 py-4">
                            <center>
                                @if($employee->image?->picture_path == '')
                                    <div class="w-14 h-14 bg-gray-300 dark:bg-gray-600 rounded-full border-2 border-gray-300 dark:border-gray-600 shadow"></div>
                                @else
                                <div class="flex justify-center">
                                    <img src="{{ asset('storage/' . $employee->image?->picture_path) }}"
                                        class="w-14 h-14 object-cover rounded-full border-2 border-gray-300 dark:border-gray-600 shadow">
                                </div>
                                @endif
                            </center>
                        </td>

                        <td>
                            <center>
                                @if($employee->image?->signature_path == '')
                                    <div class="w-20 h-10 bg-gray-300 dark:bg-gray-600 rounded-lg border-2 border-gray-300 dark:border-gray-600 shadow"></div>
                                @else
                                <div class="flex justify-center">
                                    <img src="{{ asset('storage/' . $employee->image?->signature_path) }}"
                                        class="w-20 h-10 object-cover rounded-lg border-2 border-gray-300 dark:bg-white dark:border-gray-600 shadow"> 
                                </div>
                                @endif
                            </center>
                        </td>

                        <!-- Name -->
                        <td class="px-6 py-4 font-medium">
                            {{$employee->fname}}
                            @if($employee->mname) 
                                {{ strtoupper(substr($employee->mname, 0, 1)) }}.
                            @endif
                            {{$employee->lname}}
                        </td>

                        <!-- Position -->
                        <td class="px-6 py-4">
                            <span class="px-1 py-1 text-xs rounded-lg bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300">
                                {{$employee->position}}
                            </span>
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-lg bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300">
                                {{ $employee->status }}
                            </span>
                        </td>

                        <!-- Address -->
                        <td class="px-6 py-4 text-xs">
                            {{$employee->address}}
                        </td>

                        <!-- EC Name -->
                        <td class="px-6 py-4">
                            {{$employee->emergency?->contact_name ?? 'N/A'}}
                        </td>

                        <!-- EC Number -->
                        <td class="px-6 py-4">
                            {{$employee->emergency?->contact_number ?? 'N/A'}}
                        </td>

                        
                        <!-- SSS -->
                        <td class="px-6 py-4">
                            {{$employee->govId?->sss_no ?? 'N/A'}}
                        </td>
                        
                        <!-- PHIC -->
                        <td class="px-6 py-4">
                            {{$employee->govId?->philhealth_no ?? 'N/A'}}
                        </td>
                        
                        <!-- HDMF -->
                        <td class="px-6 py-4">
                            {{$employee->govId?->pagibig_no ?? 'N/A'}}
                        </td>

                        <!-- Action -->
                        <td class="px-6 py-4">

                            <div class="flex items-center gap-2">

                                <a href="{{ route('id.edit', $employee->id) }}"
                                    class="px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition">
                                    Edit
                                </a>

                                <a href="{{ route('show.id', $employee->id) }}"
                                    class="px-3 py-1 text-xs font-semibold text-white bg-green-500 rounded-lg hover:bg-green-600 transition">
                                    View
                                </a>

                                <button
                                    wire:click="openDeleteEmployeeModal({{ $employee->id }})"
                                    class="px-3 py-1 text-xs text-white cursor-pointer hover:bg-red-700 bg-red-500 rounded-lg transition duration-200">
                                    Delete
                                </button>

                             </div>

                        </td>   

                    </tr>

                @empty
                <tr>
                    <td colspan="14" class="px-6 py-6 text-center text-gray-500">
                        No Employees found.
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

        <!-- Pagination -->
        <div class="p-4 bg-gray-50 dark:bg-gray-800 border-t dark:border-gray-700">
            {{ $employees->links(data: ['scrollTo' => false]) }}
        </div>

    </div>
</div>