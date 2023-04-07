@extends('layouts.baseAdmin')

@section('title', 'Orders')
@section('adminTitle', 'Orders')
@section('activeOrders', 'active')

@section('section')
<div class="mb-4 border-bottom">
    <div class="btn-group w-100 justify-content-center">
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last7d">
            <input type="submit" class="btn rounded-end-0 @if (session('dashboardDates') == 'last7d') btn-primary @else btn-outline-primary @endif" value="Last 7 days">
        </form>
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last30d">
            <input type="submit" class="btn rounded-0 @if (session('dashboardDates') == 'last30d') btn-primary @else btn-outline-primary @endif" value="Last 30 days">
        </form>
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last12m">
            <input type="submit" class="btn rounded-0 @if (session('dashboardDates') == 'last12m') btn-primary @else btn-outline-primary @endif" value="Last 12 months">
        </form>
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last5y">
            <input type="submit" class="btn rounded-start-0 @if (session('dashboardDates') == 'last5y') btn-primary @else btn-outline-primary @endif" value="Last 5 years">
        </form>
    </div>
    <div class="text-center w-100 fw-bold my-2">Revenue Chart</div>
    <canvas class="my-2 w-100" id="revenueChart" width="1430" height="603" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
</div>

<div class="row">
    <table class="table table-light table-striped table-bordered border-dark-subtle table-hover">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Orders</th>
                <th>Revenue</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach (array_reverse($ordersGrouped) as $orderGroup)
                <tr>
                    <td>{{$orderGroup['date']}}</td>
                    <td>{{$orderGroup['count']}}</td>
                    <td>${{number_format($orderGroup['revenue'], 2, '.', ',')}}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="table-success">
                <th>
                    @switch(session('dashboardDates'))
                        @case('last5y')
                            5 year total
                            @break
                        @case('last12m')
                            12 month total
                            @break
                        @case('last30d')
                            30 day total
                            @break
                        @case('last7d')
                            7 day total
                            @break
                        @default
                            30 day total
                            @break
                    @endswitch
                </th>
                @php($totalCount = 0)
                @php($totalRevenue = 0)
                @foreach ($ordersGrouped as $orderGroup)
                    @php($totalCount += $orderGroup['count'])
                    @php($totalRevenue += $orderGroup['revenue'])
                @endforeach
                <th>{{$totalCount}}</th>
                <th>${{number_format($totalRevenue, 2, '.', ',')}}</th>
            </tr>
        </tfoot>
    </table>
    {{-- @foreach ($orders->sortByDesc('id') as $order)
        <div>Order ID: {{$order->id}}</div>
        <div>
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
    @endforeach --}}
</div>

<script>
	const revenueChart = new Chart(document.getElementById('revenueChart'), {
		type: 'line',
		data: {
			labels: [@foreach ($ordersGrouped as $order) "{{$order['date']}}", @endforeach],
			datasets: [{
				data: [@foreach ($ordersGrouped as $order) {{$order['revenue']}}, @endforeach],
				lineTension: 0.25,
				backgroundColor: 'green',
				borderColor: 'green',
				borderWidth: 4,
				pointBackgroundColor: 'yellow'
			}]
		},
		options: {
			plugins: {
				legend: {
					display: false
				},
				tooltip: {
					boxPadding: 3
				}
			}
		}
	});
</script>

@endsection
