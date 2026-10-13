<div class="mx-auto max-w-5xl space-y-6 p-4 sm:p-6 lg:p-8">

    {{-- Header --}}
    <div>
        <a href="{{ route('employee.index') }}"
            class="mb-3 inline-flex items-center gap-2 text-sm text-zinc-500 hover:text-orange-600">
            <span aria-hidden="true">&larr;</span>
            Back to employees
        </a>

        <h1 class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-white">
            Add employee
        </h1>
        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
            Create a basic record now and complete the remaining information later.
        </p>
    </div>

    <form wire:submit="save" class="space-y-5">

        {{-- Basic information --}}
        <section class="rounded-2xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 px-5 py-4 dark:border-zinc-800">
                <h2 class="font-semibold text-zinc-900 dark:text-white">Basic information</h2>
                <p class="mt-1 text-sm text-zinc-500">Required fields are marked with *.</p>
            </div>

            <div class="grid gap-5 p-5 sm:grid-cols-2">
                <div>
                    <label for="fname" class="mb-1.5 block text-sm font-medium">First name *</label>
                    <input id="fname" wire:model="fname" required autocomplete="given-name" placeholder="First name"
                        class="w-full rounded-lg border border-zinc-300 bg-transparent px-3 py-2.5 text-sm dark:border-zinc-700">
                    @error('fname')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="lname" class="mb-1.5 block text-sm font-medium">Last name *</label>
                    <input id="lname" wire:model="lname" required autocomplete="family-name" placeholder="Last name"
                        class="w-full rounded-lg border border-zinc-300 bg-transparent px-3 py-2.5 text-sm dark:border-zinc-700">
                    @error('lname')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="middle" class="mb-1.5 block text-sm font-medium">Middle name</label>
                    <input id="middle" wire:model="mname" autocomplete="additional-name" placeholder="Optional"
                        class="w-full rounded-lg border border-zinc-300 bg-transparent px-3 py-2.5 text-sm dark:border-zinc-700">
                </div>

                <div>
                    <label for="suffix" class="mb-1.5 block text-sm font-medium">Suffix</label>
                    <input id="suffix" wire:model="suffix" placeholder="Jr., Sr., III"
                        class="w-full rounded-lg border border-zinc-300 bg-transparent px-3 py-2.5 text-sm dark:border-zinc-700">
                </div>
            </div>
        </section>

        {{-- Personal details --}}
        <section class="rounded-2xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 px-5 py-4 dark:border-zinc-800">
                <h2 class="font-semibold text-zinc-900 dark:text-white">Personal details</h2>
                <p class="mt-1 text-sm text-zinc-500">All fields in this section are optional.</p>
            </div>

            <div class="grid gap-5 p-5 sm:grid-cols-2">
                <div>
                    <label for="gender" class="mb-1.5 block text-sm font-medium">Gender</label>
                    <select id="gender" wire:model="gender"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm dark:border-zinc-700 dark:bg-zinc-950">
                        <option value="">Select gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div>
                    <label for="dob" class="mb-1.5 block text-sm font-medium">Date of birth</label>
                    <input id="dob" type="date" wire:model="dob"
                        class="w-full rounded-lg border border-zinc-300 bg-transparent px-3 py-2.5 text-sm dark:border-zinc-700">
                </div>

                <div>
                    <label for="marital_status" class="mb-1.5 block text-sm font-medium">Marital status</label>
                    <select id="marital_status" wire:model="marital_status"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm dark:border-zinc-700 dark:bg-zinc-950">
                        <option value="">Select status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Separated">Separated</option>
                    </select>
                </div>

                <div>
                    <label for="contact_number" class="mb-1.5 block text-sm font-medium">Contact number</label>
                    <input id="contact_number" type="tel" wire:model="contact_number" placeholder="09XX XXX XXXX"
                        class="w-full rounded-lg border border-zinc-300 bg-transparent px-3 py-2.5 text-sm dark:border-zinc-700">
                </div>

                <div class="sm:col-span-2">
                    <label for="address" class="mb-1.5 block text-sm font-medium">Address</label>
                    <textarea id="address" wire:model="address" rows="2" placeholder="House number, street, barangay, city..."
                        class="w-full rounded-lg border border-zinc-300 bg-transparent px-3 py-2.5 text-sm dark:border-zinc-700"></textarea>
                </div>
            </div>
        </section>

        {{-- Employment --}}
        <section class="rounded-2xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 px-5 py-4 dark:border-zinc-800">
                <h2 class="font-semibold text-zinc-900 dark:text-white">Employment placement</h2>
                <p class="mt-1 text-sm text-zinc-500">You can assign a position now or do it later.</p>
            </div>

            <div class="grid gap-5 p-5 sm:grid-cols-3">
                <div>
                    <label for="companyId" class="mb-1.5 block text-sm font-medium">Company</label>
                    <select id="companyId" wire:model.live="companyId"
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm dark:border-zinc-700 dark:bg-zinc-950">
                        <option value="">Not assigned</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="departmentId" class="mb-1.5 block text-sm font-medium">Department</label>
                    <select id="departmentId" wire:model.live="departmentId" @disabled(!$companyId)
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm disabled:opacity-50 dark:border-zinc-700 dark:bg-zinc-950">
                        <option value="">Not assigned</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="positionId" class="mb-1.5 block text-sm font-medium">Position</label>
                    <select id="positionId" wire:model="positionId" @disabled(!$departmentId)
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3 py-2.5 text-sm disabled:opacity-50 dark:border-zinc-700 dark:bg-zinc-950">
                        <option value="">Not assigned</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </section>

        {{-- Emergency contact --}}
        <section class="rounded-2xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
            <div class="border-b border-zinc-200 px-5 py-4 dark:border-zinc-800">
                <h2 class="font-semibold text-zinc-900 dark:text-white">Emergency contact</h2>
                <p class="mt-1 text-sm text-zinc-500">Optional. You can add this information later.</p>
            </div>

            <div class="grid gap-5 p-5 sm:grid-cols-3">
                <div>
                    <label for="emergency_name" class="mb-1.5 block text-sm font-medium">Contact person</label>
                    <input id="emergency_name" wire:model="emergency_name" placeholder="Full name"
                        class="w-full rounded-lg border border-zinc-300 bg-transparent px-3 py-2.5 text-sm dark:border-zinc-700">
                </div>

                <div>
                    <label for="emergency_relationship" class="mb-1.5 block text-sm font-medium">Relationship</label>
                    <input id="emergency_relationship" wire:model="emergency_relationship"
                        placeholder="e.g. Spouse, parent"
                        class="w-full rounded-lg border border-zinc-300 bg-transparent px-3 py-2.5 text-sm dark:border-zinc-700">
                </div>

                <div>
                    <label for="emergency_phone" class="mb-1.5 block text-sm font-medium">Contact number</label>
                    <input id="emergency_phone" type="tel" wire:model="emergency_phone"
                        placeholder="09XX XXX XXXX"
                        class="w-full rounded-lg border border-zinc-300 bg-transparent px-3 py-2.5 text-sm dark:border-zinc-700">
                </div>
            </div>
        </section>

        {{-- Actions --}}
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
            <a href="{{ route('employee.index') }}"
                class="inline-flex justify-center rounded-lg border border-zinc-300 px-5 py-2.5 text-sm font-medium hover:bg-zinc-100 dark:border-zinc-700 dark:hover:bg-zinc-800">
                Cancel
            </a>

            <button type="submit" wire:loading.attr="disabled"
                class="inline-flex items-center justify-center rounded-lg bg-orange-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-orange-700 disabled:opacity-60">
                <span wire:loading.remove wire:target="save">Save employee</span>
                <span wire:loading wire:target="save">Saving...</span>
            </button>
        </div>
    </form>
</div>
