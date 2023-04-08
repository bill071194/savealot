@extends('layouts.base1c')

@section('title', 'Admin')

@section('main')
<h1 class="h2 text-center">@yield('adminTitle')</h1>
<div class="row flex-column flex-md-row justify-content-evenly border-top py-3 border-bottom">
    @isset(Auth::user()->email)
        @if (Auth::user()->email == "saladmin@localhost")
            <ul class="col nav nav-pills justify-content-center justify-content-md-start p-0 flex-md-column text-center mb-3">
                <li class="nav-item"><a class="nav-link px-1 @yield('activeAdmin')" href="admin"><i class="bi bi-file-earmark-bar-graph"></i> Admin</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @yield('activeOrders') @yield('activeOrdersList')" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="bi bi-receipt-cutoff"></i> Orders</a>
                    <ul class="dropdown-menu text-center">
                        <li><a class="dropdown-item @yield('activeOrders')" href="orders"><i class="bi bi-bar-chart-line"></i> Summary</a></li>
                        <li><a class="dropdown-item @yield('activeOrdersList')" href="ordersList"><i class="bi bi-card-list"></i> All Orders</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle @yield('activeUsers') @yield('activeUsersList')" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="bi bi-people"></i> Users</a>
                    <ul class="dropdown-menu text-center">
                        <li><a class="dropdown-item @yield('activeUsers')" href="users"><i class="bi bi-bar-chart-line"></i> New Users</a></li>
                        <li><a class="dropdown-item @yield('activeUsersList')" href="usersList"><i class="bi bi-card-list"></i> All Users</a></li>
                    </ul>
                </li>
                <li  class="nav-item"><a class="nav-link px-1 @yield('activeTransactions')" href="transactions"><i class="bi bi-upc-scan"></i> Transactions</a></li>
                <li class="nav-item"><a class="nav-link px-1 @yield('activeInventory')" href="inventory"><i class="bi bi-cart4"></i> Inventory</a></li>
            </ul>
            <section class="col-md-10" style="min-height: 50vh;">
                @yield('section')
            </section>
        @else
        <h4 class="text-center">Sorry, you don't have access to this page!</h4>
        @endif
    @else
    <h4 class="text-center">Sorry, you don't have access to this page!</h4>
    @endisset
</div>

@endsection
