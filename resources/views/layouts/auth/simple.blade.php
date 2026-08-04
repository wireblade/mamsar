<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
    <div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
        <div class="flex w-full max-w-sm flex-col gap-2 rounded-lg border bg-white shadow-lg px-4 py-8">
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                <span class="flex h-20 w-35 mb-1 items-center justify-center rounded-md">
                    <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                </span>
                <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <div class="flex flex-col gap-6 mt-4">
                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
</body>

<style>
    body {
        font-family: 'Instrument Sans', sans-serif;
        position: relative;
        margin: 0;
        min-height: 100vh;
    }

    body::before {
        content: "";
        position: fixed;
        inset: 0;
        background-image: url('{{ asset('storage/backgrounds/wallpaper.png') }}');
        background-size: cover;
        background-position: center;
        opacity: 0.5;
        /* Adjust from 0.0 to 1.0 */
        z-index: -1;
    }
</style>

</html>
