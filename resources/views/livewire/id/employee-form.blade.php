<div class="bg-gradient-to-br">

    <div class="min-h-screen py-10 px-4">
        <!-- Background decoration -->

        <div class="max-w-3xl mx-auto">

            <a href="{{ route('id.index') }}"
                class="absolute top-4 left-6 flex items-center gap-2 text-black/50 hover:text-black dark:text-white transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="text-sm font-medium">Back</span>
            </a>

            <!-- Header -->
            <div div class="text-center mb-8">
                <div div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-blue-600 mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-semibold text-slate-800 dark:text-white tracking-tight">Employee Registration
                </h1>
                <p class="text-sm text-slate-500 dark:text-gray-400 mt-1">Complete all fields to register a new employee
                    record</p>
            </div>

            <div
                class=" rounded-2xl shadow-sm border border-slate-200 dark:border-gray-700 overflow-hidden dark:bg-gray-900">

                <!-- Section: Personal Information -->
                <div class="px-6 py-4 border-b border-slate-200 dark:border-gray-700">
                    <h2
                        class="text-xs font-600 font-semibold text-slate-400 dark:text-gray-500 uppercase tracking-widest">
                        Personal Information</h2>
                </div>

                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-form.input label="ID No." autofocus model="empId" placeholder="Employee ID" />
                    <x-form.input type="date" label=" Date of Birth" model="dob" placeholder="Date of Birth" />
                    <x-form.input label="First Name" model="fname" placeholder="Enter first name" />
                    <x-form.input label="Middle Name" model="mname" placeholder="Enter middle name" />
                    <x-form.input label="Last Name" model="lname" placeholder="Enter last name" />
                    <x-form.input label="Suffix" model="suffix" placeholder="Enter suffix" />
                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-slate-500 dark:text-gray-400">Civil Status</label>
                        <select wire:model="status"
                            class="h-10 px-3 rounded-lg border border-slate-200 dark:border-gray-600 text-sm text-slate-800 dark:text-gray-100 bg-white dark:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition appearance-none">
                            <option value="" disabled selected>Select status</option>
                            <option>Single</option>
                            <option>Married</option>
                            <option>Widowed</option>
                            <option>Separated</option>
                        </select>
                    </div>
                    <x-form.input label="Position" model="position" placeholder="Enter position" />
                    <x-form.input label="Address" model="address" placeholder="Enter full address" />
                </div>

                <!-- Section: Government IDs -->
                <div class="px-6 py-4 bg-slate-50 dark:bg-gray-800 border-y border-slate-200 dark:border-gray-700">
                    <h2 class="text-xs font-semibold text-slate-400 dark:text-gray-500 uppercase tracking-widest">
                        Government IDs
                    </h2>
                </div>

                <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-4">

                    <x-form.input label="SSS No." model="sss_no" placeholder="XX-XXXXXXX-X" />
                    <x-form.input label="TIN No." model="tin_no" placeholder="XXX-XXX-XXX" />
                    <x-form.input label="PhilHealth (PHIC)" model="philhealth_no" placeholder="XXXX-XXXX-XXXX" />
                    <x-form.input label="Pag-IBIG (HDMF)" model="pagibig_no" placeholder="XXXX-XXXX-XXXX" />

                </div>

                <!-- Section: Emergency Contact -->
                <div class="px-6 py-4 bg-slate-50 dark:bg-gray-800 border-y border-slate-200 dark:border-gray-700">
                    <h2 class="text-xs font-semibold text-slate-400 dark:text-gray-500 uppercase tracking-widest">
                        Emergency
                        Contact</h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <x-form.input label="Emergency Contact" model="contact_name"
                        placeholder="Enter emergency contact name" />

                    <x-form.input label="Contact Number" model="contact_number"
                        placeholder="Enter emergency contact number" />

                </div>

                <!-- Section: Documents -->
                <div class="px-6 py-4 bg-slate-50 dark:bg-gray-800 border-y border-slate-200 dark:border-gray-700">
                    <h2 class="text-xs font-semibold text-slate-400 dark:text-gray-500 uppercase tracking-widest">
                        Documents &
                        Media</h2>
                </div>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-slate-500 dark:text-gray-400">Profile Picture</label>
                        <input type="file" wire:model="picture_path" accept="image/*"
                            class="text-sm text-slate-500 dark:text-gray-400 file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border file:border-slate-200 dark:file:border-gray-600 file:text-xs file:font-medium file:text-slate-600 dark:file:text-gray-300 file:bg-slate-50 dark:file:bg-gray-700 hover:file:bg-slate-100 dark:hover:file:bg-gray-600 file:cursor-pointer cursor-pointer" />
                        @error('picture_path')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-slate-500 dark:text-gray-400">Signature</label>
                        <input type="file" wire:model="signature_path" accept="image/*"
                            class="text-sm text-slate-500 dark:text-gray-400 file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border file:border-slate-200 dark:file:border-gray-600 file:text-xs file:font-medium file:text-slate-600 dark:file:text-gray-300 file:bg-slate-50 dark:file:bg-gray-700 hover:file:bg-slate-100 dark:hover:file:bg-gray-600 file:cursor-pointer cursor-pointer" />
                        @error('signature_path')
                            <small class="text-red-500">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <!-- Actions -->
                <div
                    class="px-6 py-4 bg-slate-50 dark:bg-gray-800 border-t border-slate-200 dark:border-gray-700 flex items-center justify-end">
                    <button
                        class="px-4 py-2 {{ $isEditing ? 'bg-green-500 hover:bg-green-600' : 'bg-blue-500 hover:bg-blue-600' }} text-white text-sm font-medium rounded-lg transition duration-200"
                        wire:click="save">
                        {{ $isEditing ? 'Save Changes' : 'Register Employee' }}
                    </button>
                </div>

            </div>

            <p class="text-center text-xs text-slate-400 mt-6">All fields are required unless marked optional.</p>
        </div>

    </div>
</div>
