<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="dark:bg-linear-to-b min-h-screen bg-white antialiased dark:from-neutral-950 dark:to-neutral-900">
    <div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">

        <div
            class="flex w-full max-w-sm flex-col gap-2 rounded-lg border bg-white px-4 py-8 shadow-lg dark:border-transparent dark:bg-zinc-800">
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                <span class="w-35 mb-1 flex h-20 items-center justify-center rounded-md">
                    <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                </span>
                <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
            </a>
            {{-- Background only --}}
            <div class="pointer-events-none absolute inset-0 -z-10 bg-cover bg-center bg-no-repeat opacity-50"
                style="background-image: url('{{ asset('storage/backgrounds/wallpaper.png') }}')"></div>

            <div class="mt-4 flex flex-col gap-6">
                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
</body>



</html>
