<div>
    @if ($show)
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => { show = false;
            $wire.hideAlert() }, 5000)" x-transition
            class="{{ $type == 'success' ? 'bg-green-600' : 'bg-red-600' }} fixed right-5 top-5 z-50 flex min-w-64 items-start gap-4 rounded-lg p-4 pr-3 text-sm text-white shadow-lg">

            {{-- Alert Message --}}
            <span class="flex-1 pr-2">
                {{ $message }}
            </span>

            {{-- Close Button --}}
            <button type="button" @click="show = false; $wire.hideAlert()"
                class="rounded-md p-0.5 text-white/80 transition hover:bg-white/20 hover:text-white"
                aria-label="Close notification">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>
        </div>
    @endif
</div>
