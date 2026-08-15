{{-- Employee Header --}}
<section class="rounded-2xl border border-zinc-200 bg-white">

    <div class="flex flex-col gap-6 p-6 sm:flex-row sm:items-center sm:p-8">

        {{-- Employee Photo --}}
        <div class="relative shrink-0">

            @if ($profile_photo)
                <img src="{{ Storage::url($profile_photo) }}" alt="{{ $fname }} {{ $lname }}"
                    class="h-32 w-32 rounded-2xl object-cover ring-2 ring-orange-500/20">
            @else
                <div
                    class="flex h-32 w-32 items-center justify-center rounded-2xl
                               bg-zinc-50 text-3xl font-semibold text-zinc-400
                               ring-2 ring-orange-500/20">
                    {{ strtoupper(substr($fname, 0, 1)) }}
                </div>
            @endif

            {{-- Status Indicator --}}
            <span
                class="absolute bottom-2 right-2 h-4 w-4 rounded-full
                           border-2 border-white
                           {{ $statuss === 'Active' ? 'bg-green-500' : 'bg-zinc-400' }}"></span>

        </div>


        {{-- Employee Details --}}
        <div class="min-w-0 flex-1">

            {{-- Name + Status --}}
            <div class="flex flex-wrap items-center gap-3">

                <h1 class="text-2xl font-semibold tracking-tight text-zinc-900 sm:text-3xl">
                    {{ $fname }}
                    {{ $mname ? $mname . ' ' : '' }}
                    {{ $lname }}
                </h1>

                <span
                    class="rounded-full px-3 py-1 text-xs font-medium
                        {{ $statuss === 'Active' ? 'bg-green-50 text-green-700' : 'bg-zinc-100 text-zinc-600' }}">
                    {{ $statuss }}
                </span>

            </div>


            {{-- Position --}}
            <p class="mt-2 text-base font-medium text-orange-600">
                {{ $position }}
            </p>


            {{-- Employee Number --}}
            <p class="mt-1 text-sm text-zinc-500">
                Employee No.
                <span class="font-medium text-zinc-700">
                    {{ $empId }}
                </span>
            </p>


            {{-- Department --}}
            <p class="mt-1 text-sm text-zinc-500">
                {{ $department ?? 'Department not assigned' }}
            </p>

        </div>
        <flux:button wire:click="edit({{ $employee }})" variant="outline" icon="pencil">
            Edit
        </flux:button>
    </div>


</section>
