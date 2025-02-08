<div class="header-bottom">
    <div class="container">
        <div class="d-none d-lg-block">
            <nav class="menu-area d-flex align-items-center">
                <div class="logo">
                    {{-- <a href="/"><img src="" alt="logo" width="50" /></a>
                    <a href="/">
                        LOGO
                    </a> --}}
                </div>
                <ul class="main-menu d-flex align-items-center">
                    <li><a class="active" href="/">Dashboard</a></li>
                    <li><a href="/#product">Produk</a></li>
                </ul>
                <div class="menu-icon ml-auto">
                    <ul>
                        @php
                            $totalCartItems = auth()->user()
                                ? (auth()->user()->cart
                                    ? auth()->user()->cart->cartItems->count()
                                    : 0)
                                : 0;
                        @endphp
                        @auth
                            <li>
                                <a href="{{ route('cart.show') }}" class="text-decoration-none">
                                    <i class="bi bi-cart"
                                        style="font-size: 20px; text-decoration: none; color: #000; font-weight: 900"></i>
                                    <span class="cart">{{ $totalCartItems }}</span>
                                </a>
                            </li>
                        @endauth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown">
                                <i class="bi bi-person" style="color: #000; font-size:25px"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @guest
                                    <li>
                                        <a class="dropdown-item" href="{{ route('login') }}">
                                            {{ __('Login') }}
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                @endguest
                            </ul>
                        </li>

                    </ul>
                </div>
            </nav>
        </div>
        <!-- Mobile Menu -->
        <aside class="d-lg-none">
            <div id="mySidenav" class="sidenav">
                <div class="close-mobile-menu">
                    <a href="javascript:void(0)" id="menu-close" class="closebtn" onclick="closeNav()">&times;</a>
                </div>
                <li><a href="/">Home</a></li>
                <li><a href="/#product">Product</a></li>
            </div>
            <div class="mobile-nav d-flex align-items-center justify-content-between">
                <div class="logo">
                    <a href="/"><img src="dist/images/logo/logo-pbl.png" width="40" alt="logo" /></a>
                </div>
                <div class="menu-icon ml-auto">
                    <ul>
                        @php
                            $totalCartItems = auth()->user()
                                ? (auth()->user()->cart
                                    ? auth()->user()->cart->cartItems->count()
                                    : 0)
                                : 0;
                        @endphp
                        <li>
                            <a href="{{ route('cart.show') }}" class="text-decoration-none">
                                <i class="bi bi-cart"
                                    style="font-size: 20px; text-decoration: none; color: #000; font-weight: 900"></i>
                                <span class="cart">{{ $totalCartItems }}</span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown">
                                <i class="bi bi-person" style="color: #000; font-size:25px"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @guest
                                    <li>
                                        <a class="dropdown-item" href="{{ route('login') }}">
                                            {{ __('Login') }}
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                @endguest
                            </ul>
                        </li>

                    </ul>
                </div>
                <div class="hamburger-menu">
                    <a style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</a>
                </div>
            </div>
        </aside>
        <!-- Body overlay -->
        <div class="overlay" id="overlayy"></div>
    </div>
</div>
