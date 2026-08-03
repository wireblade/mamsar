@props([
    'sidebar' => false,
    'title' => $title ?? 'Laravel Starter Kit',
])

@if ($sidebar)
    <flux:sidebar.brand name="{{ $title }}" {{ $attributes }}>
        <x-slot name="logo"
            class="flex aspect-square size-15 items-center justify-center rounded-md  text-accent-foreground">
            <x-app-logo-icon class="size-5 fill-current text-white dark:text-black" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="{{ $title }}" {{ $attributes }}>
        <x-slot name="logo"
            class="flex aspect-square size-10 items-center justify-center rounded-md text-accent-foreground">
            <x-app-logo-icon class="size-5 fill-current text-white dark:text-black" />
        </x-slot>
    </flux:brand>

    {{-- <flux:brand name="Laravel Starter Kit" {{ $attributes }}>
        <x-slot name="logo"
            class="flex aspect-square size-8 items-center justify-center rounded-md bg-accent-content text-accent-foreground">
            <x-app-logo-icon class="size-5 fill-current text-white dark:text-black" />
        </x-slot>
    </flux:brand> --}}
@endif
