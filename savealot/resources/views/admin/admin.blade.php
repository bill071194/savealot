@extends('layouts.baseAdmin')

@section('title', 'Admin')
@section('adminTitle', 'Dashboards')
@section('activeAdmin', 'active')

@section('section')
<div class="mb-4 border-bottom row">
    <div class="btn-group w-100 justify-content-center">
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last7d">
            <input type="submit" id="last7d-sumbit" name="last7d-sumbit" hidden>
        </form>
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last30d">
            <input type="submit" id="last30d-sumbit" name="last30d-sumbit" hidden>
        </form>
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last12m">
            <input type="submit" id="last12m-sumbit" name="last12m-sumbit" hidden>
        </form>
        <form class="" action="" method="get">
            <input type="hidden" name="dashboardDates" value="last5y">
            <input type="submit" id="last5y-sumbit" name="last5y-sumbit" hidden>
        </form>
        <label for="last7d-sumbit" class="btn rounded-start-3 @if (session('dashboardDates') == 'last7d') btn-primary @else btn-outline-primary @endif"><span class="d-none d-sm-inline">Last 7 days</span>7 days</label>
        <label for="last30d-sumbit" class="btn rounded-0 @if (session('dashboardDates') == 'last30d') btn-primary @else btn-outline-primary @endif"><span class="d-none d-sm-inline">Last </span>30 days</label>
        <label for="last12m-sumbit" class="btn rounded-0 @if (session('dashboardDates') == 'last12m') btn-primary @else btn-outline-primary @endif"><span class="d-none d-sm-inline">Last </span>12 months</label>
        <label for="last5y-sumbit" class="btn rounded-end-3 @if (session('dashboardDates') == 'last5y') btn-primary @else btn-outline-primary @endif"><span class="d-none d-sm-inline">Last </span>5 years</label>
    </div>
    <div class="col-12">
        <div class="text-center w-100 fw-bold my-2">Revenue Chart</div>
        <canvas class="my-2 w-100" id="ordersChart" width="3000" height="1000" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
    </div>
    <div class="col-12">
        <div class="text-center w-100 fw-bold my-2">New Users</div>
        <canvas class="my-2 w-100" id="usersChart" width="3000" height="1000" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
    </div>
    <div class="col-12">
        <div class="text-center w-100 fw-bold my-2">Most Popular Items by Revenue</div>
        <canvas class="my-2 w-100" id="transactionsChart" width="3000" height="1000" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
    </div>
    <div class="col-12">
        <div class="text-center w-100 fw-bold my-2">Inventory</div>
        <canvas class="my-2 w-100" id="inventoryChart" width="3000" height="1000" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
    </div>
    {{$inventory->links()}}
</div>

<script>
	new Chart(document.getElementById('ordersChart'), {
		type: 'line',
		data: {
			labels: [@foreach ($ordersGrouped as $order) "{{$order['date']}}", @endforeach],
			datasets: [{
				data: [@foreach ($ordersGrouped as $order) {{$order['revenue']}}, @endforeach],
				lineTension: 0.25,
				backgroundColor: '#19875499',
				borderColor: '#0009',
				borderWidth: 4,
                fill: true,
			}]
		},
		options: {
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

    new Chart(document.getElementById('usersChart'), {
		type: 'line',
		data: {
			labels: [@foreach ($usersGrouped as $userGroup) "{{$userGroup['date']}}", @endforeach],
			datasets: [{
				data: [@foreach ($usersGrouped as $userGroup) {{$userGroup['count']}}, @endforeach],
				lineTension: 0.25,
				backgroundColor: '#0dcaf099',
				borderColor: '#0009',
				borderWidth: 4,
                fill: true,
			}]
		},
		options: {
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

	new Chart(document.getElementById('transactionsChart'), {
		type: 'bar',
		data: {
			labels: [@foreach ($transactionsGrouped as $item) "{!! $item['prod_name'] !!}", @endforeach],
			datasets: [{
                label: "Revenue",
				data: [@foreach ($transactionsGrouped as $item) {{$item['revenue']}}, @endforeach],
                backgroundColor: [@foreach ($inventory as $item) "{{$item['prod_color']}}cc", @endforeach],
                borderColor: '#000c',
				borderWidth: 1,
			},
            {
                label: "Qty sold",
				data: [@foreach ($transactionsGrouped as $item) {{$item['qty']}}, @endforeach],
                backgroundColor: [@foreach ($inventory as $item) "{{$item['prod_color']}}cc", @endforeach],
                borderColor: '#000c',
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

    new Chart(document.getElementById('inventoryChart'), {
		type: 'bar',
		data: {
			labels: [@foreach ($inventory as $item) "{!! $item['prod_name'] !!}", @endforeach],
			datasets: [{
                label: "Qty in stock",
				data: [@foreach ($inventory as $item) {{$item['prod_quantity']}}, @endforeach],
                backgroundColor: [@foreach ($inventory as $item) "{{$item['prod_color']}}cc", @endforeach],
                borderColor: '#000c',
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
