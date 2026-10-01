@props([
    'placeholder' => '',
    'click' => '',
    'icon' => '',
    'route' => '',
    'px' => '4',
    'py' => '2.5',
])

<div>
    @if ($route)
        <a href="{{ @route($route) }}">
    @endif

    <button wire:click="{{ $click }}"
        class="inline-flex items-center justify-center gap-2 rounded-lg bg-orange-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition-all duration-200 hover:bg-orange-700 hover:shadow focus:outline-none focus:ring-2 focus:ring-orange-500/30 focus:ring-offset-2 active:scale-[0.98] disabled:pointer-events-none disabled:opacity-50 dark:bg-orange-600 dark:hover:bg-orange-500 dark:focus:ring-orange-500/40 dark:focus:ring-offset-zinc-900">
        @if ($icon)
            <span class="fa fa-{{ $icon }}"></span>
        @endif
        {{ $placeholder }}
    </button>

    @if ($route)
        </a>
    @endif
</div>
