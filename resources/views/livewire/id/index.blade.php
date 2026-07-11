<div
    class="min-h-screen bg-gradient-to-br from-gray-100 via-blue-50 to-gray-200 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-6 h">

    <div class="flex justify-between item-center mb-4">

        <a href="{{ @route('id.create') }}">
            <button class="px-2 py-1.5 rounded-md text-white bg-blue-500 hover:bg-blue-600 transition duration-200">Add
                Employee</button>
        </a>

        <div class="flex justify-end">
            <div class="w-72">
                <input type="text" wire:model.live="search" placeholder="search"
                    class="w-full px-4 py-1.5 border text-gray-900 bg-gray-100 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 dark:text-gray-100 dark:bg-gray-700 dark:shadow-black dark:focus:ring-400 dark:focu:border-blue-400 dark:placeholder-gray-500 transition duration-200">
            </div>
        </div>
    </div>

    <div class="mt-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg w-full overflow-x-auto">

        <!-- Table -->
        <table class="min-w-full text-sm text-left">

            <!-- Header -->
            <thead
                class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-xs uppercase tracking-wider">
                <tr>
                    <th class="px-6 py-2">No</th>
                    <th class="px-6 py-2">ID No.</th>
                    <th class="px-6 py-2 text-center">Picture</th>
                    <th class="px-6 py-2 text-center">Signature</th>
                    <th class="px-6 py-2">Name</th>
                    <th class="px-6 py-2">Position</th>
                    <th class="px-6 py-2 text-center">Government Id</th>
                    <th class="px-6 py-2 text-center">Action</th>
                </tr>
            </thead>

            <!-- Body -->
            <tbody class="text-gray-700 dark:text-gray-300">

                @forelse ($employees as $employee)
                    <tr
                        class="border-b dark:border-gray-700 even:bg-gray-50 dark:even:bg-gray-900 hover:bg-blue-50 dark:hover:bg-gray-700 transition">

                        <!-- No -->
                        <td class="px-6 py-4">
                            {{ $employees->firstItem() + $loop->index }}
                        </td>

                        <!-- ID -->
                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            {{ $employee->empId }}
                        </td>

                        <!-- Picture -->
                        <td class="px-6 py-4">
                            <center>
                                @if ($employee->image?->path == '')
                                    <div
                                        class="w-14 h-14 bg-gray-300 dark:bg-gray-600 rounded-full border-2 border-gray-300 dark:border-gray-600 shadow">
                                    </div>
                                @else
                                    <div class="flex justify-center">
                                        <img src="{{ asset('storage/' . $employee->image?->path . '/' . $employee->image?->pic) }}"
                                            class="w-14 h-14 object-cover rounded-full border-2 border-gray-300 dark:border-gray-600 shadow">
                                    </div>
                                @endif
                            </center>
                        </td>

                        <td>
                            <center>
                                @if ($employee->image?->path == '')
                                    <div
                                        class="w-20 h-10 bg-gray-300 dark:bg-gray-600 rounded-lg border-2 border-gray-300 dark:border-gray-600 shadow">
                                    </div>
                                @else
                                    <div class="flex justify-center">
                                        <img src="{{ asset('storage/' . $employee->image?->path . '/' . $employee->image?->sig) }}"
                                            class="w-20 h-10 object-cover rounded-lg border-2 border-gray-300 dark:bg-white dark:border-gray-600 shadow">
                                    </div>
                                @endif
                            </center>
                        </td>

                        <!-- Name -->
                        <td class="px-6 py-4 font-medium">
                            {{ $employee->fname }}
                            @if ($employee->mname)
                                {{ strtoupper(substr($employee->mname, 0, 1)) }}.
                            @endif
                            {{ $employee->lname }}
                        </td>

                        <!-- Position -->
                        <td class="px-6 py-4">
                            <span
                                class="px-1 py-1 text-xs rounded-lg bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300">
                                {{ $employee->position }}
                            </span>
                        </td>

                        <!-- SSS -->
                        <td class="px-6 py-4 text-center">
                            {{-- {{ $employee->govId?->sss_no ?? 'N/A' }} --}}
                            <button
                                class="px-2 py-2 border rounded-md text-black hover:bg-blue-700 transition duration-200"
                                wire:click="openGovIdModal({{ $employee->id }})">
                                <i class="fa fa-magnifying-glass"></i>
                            </button>
                        </td>

                        <!-- Action -->
                        <td class="px-6 py-4 text-center">


                            <a href="{{ route('id.edit', $employee->id) }}"
                                class="m-1 px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition">
                                Edit
                            </a>

                            <a href="{{ route('show.id', $employee->id) }}"
                                class="m-1 px-3 py-1 text-xs font-semibold text-white bg-green-500 rounded-lg hover:bg-green-600 transition">
                                View
                            </a>

                            <button wire:click="openDeleteEmployeeModal({{ $employee->id }})"
                                class="m-1 px-3 py-1 text-xs text-white cursor-pointer hover:bg-red-700 bg-red-500 rounded-lg transition duration-200">
                                Delete
                            </button>



                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="9" class="px-6 py-6 text-center text-gray-500">
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
