<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
	{{-- <link rel="stylesheet" href="../bootstrap.css"> --}}
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="min-vh-100 d-flex flex-column">
	<nav class="navbar navbar-expand-sm navbar-dark bg-success fixed-top">
		<div class="container-fluid align-middle">
			<a class="navbar-brand badge text-bg-light text-success fs-5 rounded-5" href="index">
			    <img src="pics/savealot_full.png" alt="savealot_logo" style="width:140px;height:30px;">
			</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto">
					<li class="nav-item">
						<a class="nav-link @yield('activeHome')" aria-current="page" href="../index">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link @yield('activeShop')" href="../shop">Shop</a>
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
						<ul class="dropdown-menu mb-2">
                            @auth
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endauth
                            @guest
                                <li><a class="dropdown-item @yield('activeLogin')" href="../login">Login</a></li>
                                <li><a class="dropdown-item @yield('activeRegister')" href="../register">Register</a></li>
                            @endguest
							<li><hr class="dropdown-divider"></li>
							<li><a class="dropdown-item @yield('activeCart')" href="cart">Cart</a></li>
                            @isset(Auth::user()->email)
                                <li><a class="dropdown-item @yield('activeOrderHistory')" href="/orderhistory">Order History</a></li>
                                @if (Auth::user()->email == "saladmin@localhost")
                                    <li><a class="dropdown-item @yield('activeAdmin')" href="../admin">Admin</a></li>
                                    <li><a class="dropdown-item @yield('activeInventory')" href="../inventory">Inventory</a></li>
                                @endif
                            @endisset
						</ul>
					</li>
				</ul>
				<form class="d-flex" action="../search" method="get" role="search">
                    <input class="form-control me-2 rounded-5 px-3" type="search" name="search" placeholder="Search" aria-label="Search">
                    <input class="btn btn-outline-light rounded-5 px-3" type="submit" value="Search">
				</form>
			</div>
		</div>
	</nav>

	<main style="margin-top: 3.5rem" class="container p-3 flex-grow-1">
		@yield('main')
	</main>
	
<footer class="container-fluid p-1 bg-success text-center">
		<div style="margin-top: 0.5rem"></div>
		<img src="pics/savealot_cart.png" alt="savealot_logo" style="width:80px;height:70px;">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          <li class="nav-item">
            <a href="home" class="nav-link px-2 text-body-secondary">Home</a>
          </li>
          <li class="nav-item">
            <a href="shop" class="nav-link px-2 text-body-secondary">Shop</a>
          </li>
          <li class="nav-item">
            <a href="cart" class="nav-link px-2 text-body-secondary">Cart</a>
          </li>
          <li class="nav-item">
            <a href="privacy" class="nav-link px-2 text-body-secondary"
              >Privacy Policy</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link px-2 text-body-secondary">About</a>
          </li>
        </ul>
        <p class="text-center text-body-secondary">© 2023 SaveALot, Inc</p>
    </div>
	</footer>

</body>
</html>
