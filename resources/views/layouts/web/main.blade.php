<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('dist/main.css') }}">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .dropdown-menu {
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.5s linear;
            position: absolute;
            top: 100%;
            right: 0;
            z-index: 1000;
        }

        .nav-item.dropdown:hover .dropdown-menu {
            visibility: visible;
            opacity: 1;
        }

        .dropdown-item {
            color: #333;
            padding: 8px 16px;
            display: block;
            clear: both;
            font-weight: 400;
            white-space: nowrap;
            cursor: pointer;
            text-align: inherit;
            text-decoration: none;
        }
    </style>

    @stack('header-styles')

</head>

<body>
    <!-- Header Area Start -->
    <header class="header">
        @include('layouts.web.navbar')
    </header>
    <!-- Header Area End -->

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    {{-- <footer>
        @include('layouts.web.footer')
    </footer> --}}
    <!-- Footer -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"
        integrity="sha512-hwmiiFdCUpXt4q5hR4/TwN9OZ3J51j6z5B0HH/VsjjT9/z0nHf0X0Ndmr54IvNfC7Ier1IzP1N/tfuvCkA3VgQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"
        integrity="sha512-hwmiiFdCUpXt4q5hR4/TwN9OZ3J51j6z5B0HH/VsjjT9/z0nHf0X0Ndmr54IvNfC7Ier1IzP1N/tfuvCkA3VgQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="{{ asset('dist/src/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/src/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/src/scss/vendors/plugin/js/slick.min.js') }}"></script>
    <script src="{{ asset('dist/src/scss/vendors/plugin/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('dist/main.js') }}"></script>


    @stack('footer-scripts')

    <script>
        function openNav() {

            document.getElementById("mySidenav").style.width = "350px";
            $('#overlayy').addClass("active");
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            $('#overlayy').removeClass("active");
        }
    </script>
</body>
