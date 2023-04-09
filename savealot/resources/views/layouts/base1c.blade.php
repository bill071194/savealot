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
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js" integrity="sha384-gdQErvCNWvHQZj6XZM0dNsAoY4v+j5P1XDpNkcM3HJG1Yx04ecqIHk7+4VBOCHOG" crossorigin="anonymous"></script>
    <style>
        footer .nav-link {
            --bs-nav-link-color: #a3cfbb;
            --bs-nav-link-hover-color: #d1e7dd;
        }
        @@media screen and (max-width: 500px) {
            p.mobile {
                font-size: 2.8vw;
            }
        }
	</style>
</head>
<body class="min-vh-100 d-flex flex-column">
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

	<main style="margin-top: 3.75rem" class="container-xxl p-2 p-sm-3 flex-grow-1">
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
