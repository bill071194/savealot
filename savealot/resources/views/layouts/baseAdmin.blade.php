@extends('layouts.base1c')

@section('title', 'Admin')

@section('main')
<h1 class="h2 text-center">@yield('adminTitle')</h1>
<div class="row flex-column flex-md-row justify-content-evenly border-top py-3 border-bottom">
    <nav class="col col-md-2 mb-3 mb-md-0 px-md-2 px-lg-3">
        <ul class="nav flex-row flex-md-column justify-content-between">
            <li class="nav-item">
                <a class="nav-link px-0 @yield('activeAdmin')" aria-current="page" href="admin">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home align-text-bottom" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-0 @yield('activeOrders')" href="orders">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file align-text-bottom" aria-hidden="true"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                    Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-0 @yield('activeInventory')" href="inventory">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart align-text-bottom" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    Inventory
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link px-0 @yield('activeUsers')" href="users">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-text-bottom" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    Users
                </a>
            </li>
        </ul>
    </nav>
    <section class="col-md-10" style="min-height: 50vh;">
        @yield('section')
    </section>
</div>

@endsection
