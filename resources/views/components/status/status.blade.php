@props([
    'mt' => '',
    'is_active' => '',
    'circle' => '',
])


<div>
    @if ($is_active == true)
        <dd class="mt-{{ $mt }}">
            <span
                class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-green-500/10 dark:text-green-400 dark:ring-green-500/20">
                @if ($circle == 'on')
                    <span class="size-1.5 rounded-full bg-green-500"></span>
                @endif
                Active
            </span>
        </dd>
    @else
        <dd class="mt-{{ $mt }}">
            <span
                class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20 dark:bg-red-500/10 dark:text-red-400 dark:ring-red-500/20">
                @if ($circle == 'on')
                    <span class="size-1.5 rounded-full bg-red-500"></span>
                @endif
                Inactive
            </span>
        </dd>
    @endif
</div>
