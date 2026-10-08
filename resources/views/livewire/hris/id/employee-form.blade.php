<div class="bg-gradient-to-br">
    <div class="min-h-screen px-4 py-10">
        <!-- Background decoration -->

        <div class="boarder mx-auto max-w-3xl rounded-lg bg-white p-5 shadow-lg">
            <a href="{{ route('id.index') }}"
                class="absolute left-6 top-4 flex items-center gap-2 text-black/50 transition-colors duration-200 hover:text-black dark:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="text-sm font-medium">Back</span>
            </a>

            <!-- Header -->
            <div div class="mb-8 text-center">
                <div div class="inline-flex h-20 w-20 items-center justify-center rounded-xl">
                    {{-- <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg> --}}

                    <img src="{{ asset('storage/icons/logo.svg') }}" alt="Logo" />
                </div>
                <h1 class="text-2xl font-semibold tracking-tight text-slate-800 dark:text-white">
                    {{ $title }}
                </h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-gray-400">Complete all fields to register a new employee
                    record</p>
            </div>

            <div
                class="overflow-hidden rounded-2xl border border-slate-200 shadow-sm dark:border-gray-700 dark:bg-gray-900">
                <!-- Section: Personal Information -->
                <div class="border-b border-slate-200 px-6 py-4 dark:border-gray-700">
                    <h2
                        class="font-600 text-xs font-semibold uppercase tracking-widest text-slate-400 dark:text-gray-500">
                        Personal Information
                    </h2>
                </div>

                {{-- This is to check if the page is on Edit so i can manipulate the input component for ID to be disabled --}}
                @php
                    $lastSegment = request()->segment(count(request()->segments()));
                @endphp

                <div class="grid grid-cols-1 gap-4 p-6 sm:grid-cols-2">
                    <x-form.masked-input label="ID No." autofocus model="id_number" placeholder="Employee ID"
                        :maxdigits="9" :mask="[2, 2, 4]" />

                    <x-form.text-input type="date" label=" Date of Birth" model="dob"
                        placeholder="Date of Birth" />
                    <x-form.text-input label="First Name" model="fname" placeholder="Enter first name" />
                    <x-form.text-input label="Middle Name" model="mname" placeholder="Enter middle name" />
                    <x-form.text-input label="Last Name" model="lname" placeholder="Enter last name" />
                    <x-form.text-input label="Suffix" model="suffix" placeholder="Enter suffix" />
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-slate-500 dark:text-gray-400">Civil Status</label>
                        <select wire:model="marital_status"
                            class="h-10 appearance-none rounded-lg border border-slate-200 bg-white px-3 text-sm text-slate-800 transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                            <option value="" disabled selected>
                                Select status
                            </option>
                            <option>Single</option>
                            <option>Married</option>
                            <option>Widowed</option>
                            <option>Separated</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-slate-500 dark:text-gray-400">Position</label>
                        <select wire:model="position"
                            class="h-10 appearance-none rounded-lg border border-slate-200 bg-white px-3 text-sm text-slate-800 transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                            <option value="" selected>
                                Select Position
                            </option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">
                                    {{ '[' . $position->department->company->code . '] [' . $position->department->name . '] ' . $position->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <x-form.text-input label="Address" model="address" placeholder="Enter full address" />

                    {{-- <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-slate-500 dark:text-gray-400">Company</label>
                        <select wire:model="company"
                            class="@error('company')
                            border-red-500
                            @else
                            border-slate-200 dark:border-gray-600
                            @enderror h-10 appearance-none rounded-lg border bg-white px-3 text-sm text-slate-800 transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:text-gray-100">
                            <option value="" selected>
                                Select Company
                            </option>
                            @foreach ($this->companies as $company)
                                <option value="{{ $company->id }}">{{ $company->code }}</option>
                            @endforeach
                        </select>
                        @error('company')
                            <p class="text-sm text-red-500">
                                <i class="fa fa-triangle-exclamation text-xs"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div> --}}
                </div>

                <!-- Section: Government IDs -->
                <div class="border-y border-slate-200 bg-slate-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-800">
                    <h2 class="text-xs font-semibold uppercase tracking-widest text-slate-400 dark:text-gray-500">
                        Government IDs
                    </h2>
                </div>

                <div class="grid grid-cols-1 gap-4 p-6 sm:grid-cols-3">
                    <x-form.masked-input label="SSS No." model="sss_no" :mask="[2, 7, 1]" :maxdigits="10"
                        placeholder="XX-XXXXXXX-X" />

                    <x-form.masked-input label="TIN No." model="tin_no" :mask="[3, 3, 3]" :maxdigits="9"
                        placeholder="XXX-XXX-XXX" />

                    <x-form.masked-input label="PhilHealth (PHIC)" model="philhealth_no" :mask="[2, 9, 1]"
                        :maxdigits="12" placeholder="XX-XXXXXXXX-X" />

                    <x-form.masked-input label="Pag-IBIG (HDMF)" model="pagibig_no" :mask="[4, 4, 4]" :maxdigits="12"
                        placeholder="XXXX-XXXX-XXXX (optional)" />
                </div>

                <!-- Section: Emergency Contact -->
                <div class="border-y border-slate-200 bg-slate-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-800">
                    <h2 class="text-xs font-semibold uppercase tracking-widest text-slate-400 dark:text-gray-500">
                        Emergency Contact
                    </h2>
                </div>
                <div class="grid grid-cols-1 gap-4 p-6 sm:grid-cols-2">
                    <x-form.text-input label="Emergency Contact" model="contact_name"
                        placeholder="Enter emergency contact name" />

                    <x-form.text-input label="Contact Number" model="contact_number"
                        placeholder="Enter emergency contact number" />
                </div>

                <!-- Section: Documents -->
                <div class="border-y border-slate-200 bg-slate-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-800">
                    <h2 class="text-xs font-semibold uppercase tracking-widest text-slate-400 dark:text-gray-500">
                        Documents & Media
                    </h2>
                </div>

                <div class="grid grid-cols-1 gap-4 p-6 sm:grid-cols-2">
                    <x-form.text-input label="Profile Picture" type="file" model="picture_path" />

                    <x-form.text-input label="Signature" type="file" model="signature_path" />
                </div>

                <!-- Actions -->
                <div
                    class="flex items-center justify-end border-t border-slate-200 bg-slate-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-800">
                    <button
                        class="{{ $isEditing ? 'bg-green-500 hover:bg-green-600' : 'bg-blue-500 hover:bg-blue-600' }} rounded-lg px-4 py-2 text-sm font-medium text-white transition duration-200"
                        wire:click="save">
                        {{ $isEditing ? 'Save Changes' : 'Register Employee' }}
                    </button>
                </div>
            </div>

            <p class="mt-6 text-center text-xs text-slate-400">All fields are required unless marked optional.</p>
        </div>
    </div>
</div>
