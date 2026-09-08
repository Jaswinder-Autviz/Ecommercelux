<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Hustler'))</title>
    <meta name="description" content="@yield('meta_description', 'Premium wall posters and modern wall art for considered spaces')">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#e71318',
                        gold: '#C8A96B',
                        luxury: '#111111',
                    }
                }
            }
        }
    </script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- Core CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bundle-dock.css') }}">

    {{-- Page / component CSS pushed from child views --}}
    @stack('styles')
</head>
<body>

    {{-- Header Hero Wrapper: background image from announcement bar through nav --}}
    <div>
        {{-- Header sits on top of background --}}
        <div style="position: relative; z-index: 1;">
            @include('frontend.components.header')
        </div>
    </div>

    <main id="main-content">
        @yield('content')
    </main>

    @include('frontend.components.footer')

    {{-- Customer Login Modal --}}
    @include('frontend.components.customer-login-modal')

    {{-- Floating Bundle Dock --}}
    @include('frontend.components.bundle-dock')

    {{-- Core JS --}}
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/toast.js') }}"></script>
    <script src="{{ asset('assets/js/cart.js') }}"></script>
    <script src="{{ asset('assets/js/wishlist.js') }}"></script>
    <script src="{{ asset('assets/js/bundle-manager.js') }}"></script>

    {{-- Page / component JS pushed from child views --}}
    @stack('scripts')

</body>
</html>
