<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"> --}}
	<link rel="stylesheet" href="bootstrap.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="bootstrap.bundle.js"></script>
	{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> --}}
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    <link href="carousel.css" rel="stylesheet">
    <meta name="theme-color" content="#712cf9">


    <style>
        .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
        }

        .featurette {
          width: 100%;
        }

        .steps {
          width:70%;
          margin-top: 3.5rem;
          margin-bottom: 2.5rem;
        }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .lead {
        margin-top: 1em;
        font-size: 1.5em;
        line-height: 1.7em;
      }
      footer .nav-link {
            --bs-nav-link-color: #a3cfbb;
            --bs-nav-link-hover-color: #d1e7dd;
        }

	</style>

    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">
	<script src="/docs/5.3/assets/js/color-modes.js"></script>
</head>

<body class="min-vh-100 d-flex flex-column bg-light bg-gradient">
	<nav class="navbar navbar-expand-md navbar-dark bg-success fixed-top" id="navbarTop">
		<div class="container-fluid align-middle">
			<a class="navbar-brand badge text-bg-light text-success fs-5 rounded-5" href="index">
			    <img src="pics/savealot_full.png" alt="savealot_logo" style="width:140px;height:30px;">
			</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse text-center row flex-row mt-1 mt-md-0 ps-md-2 gap-2" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto col flex-row justify-content-center justify-content-md-start pe-0 gap-2 gap-md-0">
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link @yield('activeHome')" aria-current="page" href="index">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('activeShop')" href="shop">Shop</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @auth
                                {{Auth::user()->name}}
                            @endauth
                            @guest
                                Account
                            @endguest
                        </a>
                        <ul class="dropdown-menu mb-2 text-center">
                            @guest
                                <li><a class="dropdown-item @yield('activeLogin')" href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a></li>
                                <li><a class="dropdown-item @yield('activeRegister')" href="/register"><i class="bi bi-person-add"></i> Register</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endguest
                            <li><a class="dropdown-item @yield('activeCart')" href="/cart"><i class="bi bi-cart"></i> Cart</a></li>
                            @isset(Auth::user()->email)
                                <li><a class="dropdown-item @yield('activeOrderHistory')" href="/orderhistory"><i class="bi bi-receipt"></i> Order History</a></li>
                                @if (Auth::user()->email == "saladmin@localhost")
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item @yield('activeAdmin')" href="/admin"><i class="bi bi-file-earmark-bar-graph"></i> Admin</a></li>
                                @endif
                            @endisset
                            @auth
                                <li><hr class="dropdown-divider"></li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right"></i>
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endauth
                        </ul>
                    </li>
                </ul>
				<form style="flex: 0 300px;" class="col d-flex my-auto px-auto mx-auto" action="/search" method="get" role="search">
                    <input class="form-control me-2 rounded-5 px-3" type="search" name="search" placeholder="Search" aria-label="Search">
                    <input class="btn btn-outline-light rounded-5 px-3" type="submit" value="Search">
				</form>
			</div>
		</div>
	</nav>

	<main style="margin-top: 3.75rem" class="container-fluid flex-grow-1">
		@yield('main')
	</main>

	<footer class="container-fluid p-1 bg-success text-center" data-bs-theme="dark">
	    <div style="margin-top: 0.5rem"></div>
		<img src="pics/savealot_cart.png" alt="savealot_logo" style="width:80px;height:70px;">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          <li class="nav-item">
            <a href="index" class="nav-link px-2">Home</a>
          </li>
          <li class="nav-item">
            <a href="shop" class="nav-link px-2">Shop</a>
          </li>
          <li class="nav-item">
            <a href="cart" class="nav-link px-2">Cart</a>
          </li>
          <li class="nav-item">
            <a href="privacy" class="nav-link px-2">Privacy Policy</a>
          </li>
        </ul>
        <p style="color: #a3cfbb;" class="text-center">© 2023 Save-A-Lot, Inc</p>
	</footer>

    <script>
        const navbarTop = document.getElementById("navbarTop");
        var lastScrollPos = window.pageYOffset;
        window.onscroll = function() {
        var currentScrollPos = window.pageYOffset;
            if (lastScrollPos > currentScrollPos) {
                navbarTop.style.top = "0";
            } else {
                navbarTop.style.top = - currentScrollPos + "px";
            }
            lastScrollPos = currentScrollPos;
        }
    </script>

</body>
</html>
