<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Mediafy Admin' }}</title>
    @vite('resources/css/app.css')
    
    <!-- Add any additional head content -->
    {{ $head ?? '' }}
</head>
<body class="bg-neutral-8 text-neutral-1">
    {{ $slot }}
</body>
</html>