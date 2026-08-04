<div
    class="min-h-screen bg-gradient-to-br from-gray-100 via-blue-50 to-gray-200 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 p-6 h">

    <div class="flex justify-between item-center mb-4">

        <a href="{{ @route('id.create') }}">
            <button
                class="px-2 py-1.5 rounded-md text-sm text-white bg-gray-400 hover:bg-blue-600 transition duration-200">Create
                New ID</button>
        </a>

        <div class="flex justify-end">
            <div class="w-72">
                <input type="text" wire:model.live="search" placeholder="search"
                    class="w-full px-4 py-1.5 border text-gray-900 bg-gray-100 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 dark:text-gray-100 dark:bg-gray-700 dark:shadow-black dark:focus:ring-400 dark:focu:border-blue-400 dark:placeholder-gray-500 transition duration-200">
            </div>
        </div>
    </div>

    <div class="mt-6 bg-white dark:bg-gray-800 rounded-2xl shadow-lg w-full overflow-x-auto">

        <div class="grid gap-6
            sm:grid-cols-1
            md:grid-cols-2
            xl:grid-cols-3 p-5">
            @foreach ($employees as $employee)
                <div class="bg-white rounded-xl shadow-md border border-gray-200 p-5">

                    <div class="flex justify-between items-start">
                        <div class="flex gap-4">

                            <!-- Picture -->
                            <img src="{{ asset('storage/' . $employee->image?->path . '/' . $employee->image?->pic) }}"
                                class="w-20 h-20 rounded-lg object-cover border">

                            <div>
                                <p class="text-xs text-gray-500">
                                    Employee #{{ $employee->empId }}
                                </p>

                                <h2 class="text-lg font-semibold">
                                    {{ $employee->lname }},

                                    {{ $employee->fname }}

                                    @if ($employee->mname)
                                        {{ strtoupper(substr($employee->mname, 0, 1)) }}.
                                    @endif


                                </h2>

                                <p class="text-gray-500">
                                    {{ $employee->position }}
                                </p>
                            </div>

                        </div>

                        <!-- ID -->
                        <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-sm font-medium">
                            {{ $employees->firstItem() + $loop->index }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mt-5">

                        <!-- Signature -->
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-2">
                                Signature
                            </p>

                            <img src="{{ asset('storage/' . $employee->image?->path . '/' . $employee->image?->sig) }}"
                                class="h-16 w-1/2 object-contain border rounded bg-gray-50">
                        </div>

                        <!-- Government ID -->
                        <div>
                            <p class="text-sm font-medium text-gray-600 mb-2">
                                Government IDs
                            </p>

                            <button wire:click="openGovIdModal({{ $employee->id }})"
                                class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition duration-200">
                                <i class="fa fa-magnifying-glass"></i>
                                View IDs
                            </button>
                        </div>

                    </div>

                    <div class="flex justify-end gap-2 mt-6 border-t pt-4">

                        <a href="{{ route('show.id', $employee->id) }}"
                            class="px-3 py-2 rounded-lg bg-gray-100 hover:bg-gray-200">
                            View
                        </a>

                        <a href="{{ route('id.edit', $employee->id) }}"
                            class="px-3 py-2 rounded-lg bg-amber-500 text-white hover:bg-amber-600">
                            Edit
                        </a>

                        <button wire:click="openDeleteEmployeeModal({{ $employee->id }})"
                            class="px-3 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700">
                            Delete
                        </button>

                    </div>

                </div>
            @endforeach

        </div>


        <!-- Pagination -->
        <div class="p-4 bg-gray-50 dark:bg-gray-800 border-t dark:border-gray-700">
            {{ $employees->links(data: ['scrollTo' => false]) }}
        </div>

    </div>

</div>
