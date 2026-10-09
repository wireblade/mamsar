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

                    {{-- <div class="flex flex-col gap-1">
                        <label class="text-xs font-medium text-slate-500 dark:text-gray-400">Position</label>
                        <select wire:model="position_id"
                            class="h-10 appearance-none rounded-lg border border-slate-200 bg-white px-3 text-sm text-slate-800 transition focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                            <option value="" selected>
                                Select Position
                            </option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">
                                    {{ '[' . $position->department->company->code . ']' }}
                                    {{ '[' . $position->department->name . '] ' . $position->name }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div x-data="{
                        open: false,
                        search: '',
                        selected: @entangle('position_id'),
                    
                        positions: @js(
    $positions
        ->map(
            fn($p) => [
                'id' => $p->id,
                'company' => $p->department->company->code,
                'department' => $p->department->name,
                'name' => $p->name,
            ],
        )
        ->values(),
),
                    
                        get filtered() {
                            return this.positions.filter(p =>
                                `${p.company} ${p.department} ${p.name}`
                                .toLowerCase()
                                .includes(this.search.toLowerCase())
                            );
                        },
                    
                        get selectedPosition() {
                            return this.positions.find(
                                p => String(p.id) === String(this.selected)
                            );
                        },
                    
                        choose(id) {
                            this.selected = id;
                            this.open = false;
                            this.search = '';
                        },
                    
                        companyColor(code) {
                            switch (code?.toUpperCase()) {
                                case 'MAMSAR':
                                    return 'text-orange-600 dark:text-orange-400';
                                case '4KDC':
                                    return 'text-emerald-500 dark:text-emerald-400';
                                case 'ZEMAN':
                                    return 'text-sky-500 dark:text-sky-400';
                                default:
                                    return 'text-zinc-600 dark:text-zinc-300';
                            }
                        }
                    }" @click.outside="open = false" @keydown.escape.window="open = false"
                        class="relative w-full">
                        {{-- Label --}}
                        <label class="mb-1 block text-sm font-medium dark:text-white">
                            Position
                        </label>

                        {{-- Dropdown trigger --}}
                        <button type="button" @click="open = !open" :aria-expanded="open"
                            class="flex w-full items-center justify-between gap-2 rounded-lg border border-zinc-300 bg-white px-3 py-2 text-left text-sm text-zinc-900 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                            <span x-show="!selectedPosition" class="text-zinc-400">
                                Select position...
                            </span>

                            <span x-show="selectedPosition" x-cloak
                                class="flex min-w-0 items-center gap-1 overflow-hidden whitespace-nowrap">
                                <span class="shrink-0 font-semibold" :class="companyColor(selectedPosition?.company)"
                                    x-text="'[' + selectedPosition?.company + ']'"></span>

                                <span class="shrink-0 text-blue-600 dark:text-blue-400"
                                    x-text="'[' + selectedPosition?.department + ']'"></span>

                                <span class="truncate" x-text="selectedPosition?.name"></span>
                            </span>

                            <svg class="h-4 w-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m6 9 6 6 6-6" />
                            </svg>
                        </button>

                        {{-- Dropdown panel --}}
                        <div x-show="open" x-cloak x-transition
                            class="absolute right-0 z-50 mt-1 w-full max-w-[calc(100vw-2rem)] rounded-lg border border-zinc-200 bg-white shadow-xl sm:w-[500px] lg:w-[600px] dark:border-zinc-700 dark:bg-zinc-900">
                            {{-- Search --}}
                            <div class="p-2">
                                <input type="text" x-model="search" @keydown.escape="open = false"
                                    placeholder="Search position..."
                                    class="w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm outline-none focus:border-blue-500 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                            </div>

                            {{-- Scrollable list --}}
                            <div class="max-h-60 overflow-x-auto overflow-y-auto p-1">
                                <template x-for="p in filtered" :key="p.id">
                                    <button type="button" @click="choose(p.id)"
                                        class="flex w-full items-center gap-2 whitespace-nowrap rounded-md px-3 py-2 text-left text-sm hover:bg-zinc-100 dark:hover:bg-zinc-800"
                                        :class="String(selected) === String(p.id) ?
                                            'bg-blue-50 dark:bg-blue-950' :
                                            ''">
                                        {{-- Company code --}}
                                        <span class="shrink-0 font-semibold" :class="companyColor(p.company)"
                                            x-text="'[' + p.company + ']'"></span>

                                        {{-- Department --}}
                                        <span class="shrink-0 text-blue-600 dark:text-blue-400"
                                            x-text="'[' + p.department + ']'"></span>

                                        {{-- Position --}}
                                        <span class="shrink-0 text-zinc-900 dark:text-white" x-text="p.name"></span>
                                    </button>
                                </template>

                                {{-- Empty results --}}
                                <div x-show="filtered.length === 0" class="p-3 text-center text-sm text-zinc-500">
                                    No positions found.
                                </div>
                            </div>
                        </div>

                        {{-- Validation error --}}
                        @error('position_id')
                            <p class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror
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

                    <x-form.masked-input label="Pag-IBIG (HDMF)" model="pagibig_no" :mask="[4, 4, 4]"
                        :maxdigits="12" placeholder="XXXX-XXXX-XXXX (optional)" />
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
