@extends('layouts.baseAdmin')

@section('title', 'Transactions')
@section('adminTitle', 'Transactions')
@section('activeTransactions', 'active')

@section('section')
<div class="mb-4 border-bottom row">
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
    <div class="col-12">
        <div class="text-center w-100 fw-bold my-2">Most Popular Items by Revenue</div>
        <canvas class="my-2 w-100" id="transactionsChart" width="3000" height="2000" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
    </div>
</div>

<div class="row">
    <table class="table table-light table-striped table-bordered border-dark-subtle table-hover">
        <thead class="table-dark">
            <tr>
                <th>Item</th>
                <th>Qty Sold</th>
                <th>Revenue</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach (($transactionsGrouped) as $item)
                <tr>
                    <td><img style="width: 1.5rem;" src="{{$item['prod_picture']}}"> {{$item['prod_name']}}</td>
                    <td>{{$item['qty']}}</td>
                    <td>${{number_format($item['revenue'], 2, '.', ',')}}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="table-success">
                <th>
                    @switch(session('dashboardDates'))
                        @case('last5y') 5 year total @break
                        @case('last30d') 30 day total @break
                        @case('last7d') 7 day total @break
                        @default 12 month total @break
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
</div>

<script>
new Chart(document.getElementById('transactionsChart'), {
		type: 'bar',
		data: {
			labels: [@foreach ($transactionsGrouped as $item) "{!! $item['prod_name'] !!}", @endforeach],
			datasets: [{
                label: "Revenue",
				data: [@foreach ($transactionsGrouped as $item) {{$item['revenue']}}, @endforeach],
                backgroundColor: ['#40845899', '#6DB75799', '#87BD5399', '#F4CE4699'],
                borderColor: '#0009',
				borderWidth: 1,
			},
            {
                label: "Qty sold",
				data: [@foreach ($transactionsGrouped as $item) {{$item['qty']}}, @endforeach],
                backgroundColor: '#0009',
                borderColor: ['#40845899', '#6DB75799', '#87BD5399', '#F4CE4699'],
				borderWidth: 1,
			},
        ]
		},
		options: {
            indexAxis: 'y',
            scales: {
                y: {
                    beginAtZero: true,
                }
            },
			plugins: {
				legend: {
					display: false,
				},
				tooltip: {
					boxPadding: 3,
				}
			}
		}
	});
</script>

@endsection
