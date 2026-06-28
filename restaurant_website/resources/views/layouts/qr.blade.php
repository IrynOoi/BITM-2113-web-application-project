<!-- layouts/qr.blade.php — minimal layout for QR dine-in flow (no navbar/footer) -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Order - Restoran SUP TULANG ZZ')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('styles')
</head>

<body style="padding-bottom: 0;">

    <!-- Minimal top bar — just the logo and table info -->
    <header class="header" style="position: sticky; top: 0; z-index: 999;">
        <div class="header-container">
            <a href="#" class="logo" onclick="return false;" style="cursor: default;">
                <img src="{{ asset('assets/images/Logo.jpeg') }}" alt="Restoran SUP TULANG ZZ Logo" class="logo-img">
                <h1>Restoran SUP TULANG ZZ</h1>
            </a>
        </div>
    </header>

    @yield('content')

    <script>
        window.restaurantAssetBase = @json(asset('assets'));
        window.menuUrl = @json(route('menu'));
    </script>
    @yield('scripts')
</body>

</html>
