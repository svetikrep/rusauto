<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'RUSAUTO — купите автомобиль своей мечты')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Unbounded:wght@500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    @stack('styles')
</head>
<body>

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
    <symbol id="i-phone" viewBox="0 0 24 24"><path fill="currentColor" d="M6.62 10.79a15.05 15.05 0 0 0 6.59 6.59l2.2-2.2a1 1 0 0 1 1.01-.24c1.12.37 2.33.57 3.58.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57a1 1 0 0 1-.25 1.02l-2.2 2.2Z"/></symbol>
    <symbol id="i-vk" viewBox="0 0 24 24"><text x="12" y="16.5" text-anchor="middle" font-family="Unbounded, sans-serif" font-weight="700" font-size="12" fill="currentColor">VK</text></symbol>
    <symbol id="i-smile" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"><circle cx="12" cy="12" r="9"/><path d="M8.5 14.5c.9 1.2 2 1.8 3.5 1.8s2.6-.6 3.5-1.8"/><path d="M9 9.5v.5M15 9.5v.5"/></g></symbol>
    <symbol id="i-star" viewBox="0 0 24 24"><path fill="currentColor" d="m12 2 3.100 6.600 7.200.9-5.300 5 1.400 7.200L12 18.100 5.600 21.700 7 14.500l-5.300-5 7.200-.9L12 2Z"/></symbol>
    <symbol id="i-check" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></symbol>
</svg>

@if (session('success') || session('review_success') || session('info') || $errors->any())
    <div class="alert-container" id="alertContainer">
        @if (session('success'))
            <div class="alert alert--success">
                <div>
                    <strong>Успешно!</strong>
                    <div>{{ session('success') }}</div>
                </div>
                <button class="alert__close" onclick="this.parentElement.remove()" aria-label="Закрыть">&times;</button>
            </div>
        @endif

        @if (session('review_success'))
            <div class="alert alert--success">
                <div>
                    <strong>Отзыв опубликован!</strong>
                    <div>{{ session('review_success') }}</div>
                </div>
                <button class="alert__close" onclick="this.parentElement.remove()" aria-label="Закрыть">&times;</button>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert--info">
                <div>{{ session('info') }}</div>
                <button class="alert__close" onclick="this.parentElement.remove()" aria-label="Закрыть">&times;</button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert--error">
                <div>
                    <strong>Ошибка валидации:</strong>
                    <ul style="margin-top: 6px; padding-left: 18px; list-style: disc;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button class="alert__close" onclick="this.parentElement.remove()" aria-label="Закрыть">&times;</button>
            </div>
        @endif
    </div>
@endif

@include('partials.header')

<main>
    @yield('content')
</main>

@include('partials.footer')

<script>
    (function () {
        var header = document.getElementById('header');
        if (header) {
            var burger = header.querySelector('.burger');
            var menu = document.getElementById('menu');

            function setOpen(open) {
                header.classList.toggle('is-open', open);
                burger.setAttribute('aria-expanded', open ? 'true' : 'false');
                burger.setAttribute('aria-label', open ? 'Закрыть меню' : 'Открыть меню');
            }

            if (burger) {
                burger.addEventListener('click', function () {
                    setOpen(!header.classList.contains('is-open'));
                });
            }

            if (menu) {
                menu.addEventListener('click', function (e) {
                    if (e.target.closest('a')) setOpen(false);
                });
            }

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') setOpen(false);
            });

            window.addEventListener('resize', function () {
                if (window.innerWidth > 768) setOpen(false);
            });
        }

        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(el) {
                el.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
                el.style.opacity = '0';
                el.style.transform = 'translateX(100%)';
                setTimeout(function() { el.remove(); }, 500);
            });
        }, 7000);
    })();
</script>

@stack('scripts')

</body>
</html>
