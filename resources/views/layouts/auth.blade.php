<x-layouts::auth.simple :title="$title ?? null">
    <div class="pointer-events-none absolute inset-0 -z-10 bg-cover bg-center bg-no-repeat opacity-50"
        style="background-image: url('{{ asset('storage/backgrounds/wallpaper.png') }}')"></div>
    {{ $slot }}
</x-layouts::auth.simple>
