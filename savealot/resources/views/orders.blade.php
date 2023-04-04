@extends('layouts.base')

@section('title', 'Orders')

@section('main')
<div class="container-fluid">
	<div class="row">
		<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
			<div class="position-sticky pt-3 sidebar-sticky">
				<ul class="nav flex-column">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="admin">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home align-text-bottom" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
							Dashboard
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="orders">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file align-text-bottom" aria-hidden="true"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
							Orders
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="inventory">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart align-text-bottom" aria-hidden="true"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
							Inventory
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="users">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-text-bottom" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
							Users
						</a>
					</li>
				</ul>
			</div>
		</nav>

		<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
			<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
				<h1 class="h2">Orders</h1>
				<div class="">
                    @foreach ($orders as $order)
                        <div class="col col-md-10 offset-md-1">
                            <table class="table table-light table-striped table-bordered border-dark-subtle table-hover">
                                <thead>
                                    <tr class="table-dark">
                                        <th colspan="2">Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($transactions as $transaction)
                                        @if (($transaction->order_id) == $order->id)
                                            <tr>
                                                <td class="d-flex justify-content-center p-0"><img src="{{$transaction->prod_picture}}" class="py-auto" height="40"></td>
                                                <td>{{$transaction->prod_name}}</td>
                                                <td>${{$transaction->prod_price}}</td>
                                                <td>{{$transaction->item_qty}}</td>
                                                <td>${{$transaction->item_total}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                                <tbody class="table-group-divider">
                                    @if ($order->student == 1)
                                    <tr>
                                        <th colspan="4">Subtotal</th>
                                        <th>${{$order->subtotal}}</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Student Discount</td>
                                        <td colspan="2" class="text-center">-10%</td>
                                        <td>(${{$order->discount}})</td>
                                    </tr>
                                    @endif
                                </tbody>
                                <tfoot class="table-group-divider">
                                    <tr class="table-success">
                                        <th colspan="4">Total for order placed {{$order->created_at}}</th>
                                        <th>${{$order->total}}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @endforeach
                </div>
			</div>

			<canvas class="my-4 w-100 chartjs-render-monitor" id="myChart" width="1720" height="726" style="display: block; height: 363px; width: 860px;"></canvas>
		</main>
	</div>
</div>

@endsection
