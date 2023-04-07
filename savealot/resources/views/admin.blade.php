@extends('layouts.baseAdmin')

@section('title', 'Admin')
@section('adminTitle', 'Dashboards')
@section('activeAdmin', 'active')

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
    <div class="text-center w-100 fw-bold my-2">New Users</div>
    <canvas class="my-2 w-100" id="usersChart" width="1430" height="603" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
</div>
<div class="row">
    <div class="mb-3 border-bottom">
        <div class="text-center w-100 fw-bold mt-4">Inventory in Stock</div>
        <canvas class="my-4 w-100" id="inventoryQtyChart" width="1430" height="603" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
        {{$inventory->links()}}
    </div>
</div>

<script>
    /* globals Chart:false, feather:false */
(() => {
'use strict'

feather.replace({ 'aria-hidden': 'true' })

// Graphs
const ctx = document.getElementById('inventoryQtyChart')
// eslint-disable-next-line no-unused-vars
const inventoryQtyChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach ($inventory as $item)
                "{{$item->prod_name}}",
            @endforeach
        ],
        datasets: [{
            data: [
                @foreach ($inventory as $item)
                    {{$item->prod_quantity}},
                @endforeach
            ],
            lineTension: 0.25,
            backgroundColor: 'green',
            borderColor: 'grey',
            borderWidth: 4,
            pointBackgroundColor: 'green'
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
})
})()
</script>

<script>
	const usersChart = new Chart(document.getElementById('usersChart'), {
		type: 'line',
		data: {
			labels: [@foreach ($usersGrouped as $userGroup) "{{$userGroup['date']}}", @endforeach],
			datasets: [{
				data: [@foreach ($usersGrouped as $userGroup) {{$userGroup['count']}}, @endforeach],
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
