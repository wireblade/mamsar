<!DOCTYPE html>
<html lang="en" data-appearance="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>
        {{ filled($title ?? null) ? $title : 'Mamsar' }}
    </title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- ADD THIS INSTEAD to hardcode Light mode -->
    <script>
        localStorage.setItem('flux.appearance', 'light');
        document.documentElement.setAttribute('data-appearance', 'light');
        document.documentElement.classList.remove('dark');
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <div class="pointer-events-none fixed inset-0 -z-10 bg-cover bg-center bg-no-repeat opacity-50"
        style="background-image: url('{{ asset('storage/backgrounds/wallpaper.png') }}')"></div>

</head>

<body>

    {{ $slot }}

    @fluxScripts


</body>

</html>
