@extends('layouts.baseAdmin')

@section('title', 'Admin')
@section('adminTitle', 'Admin')
@section('activeAdmin', 'active')

@section('section')
<div class="row">
    <div class="mb-3 border-bottom">
        <div class="text-center w-100 fw-bold mt-4">Revenue Chart</div>
        <canvas class="my-4 w-100" id="revenueChart" width="1430" height="603" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
    </div>
    <div class="mb-3 border-bottom">
        <div class="text-center w-100 fw-bold mt-4">Inventory in Stock</div>
        <canvas class="my-4 w-100" id="inventoryQtyChart" width="1430" height="603" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
        {{$inventory->links()}}
    </div>
    <div class="mb-3 border-bottom">
        <div class="text-center w-100 fw-bold mt-4">New Users</div>
        <canvas class="my-4 w-100" id="UsersChart" width="1430" height="603" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
    </div>
</div>

<script>
(() => {
	'use strict'

	feather.replace({ 'aria-hidden': 'true' })
    
    var goBackDays = 7;

    var today = new Date();
    var daysSorted = [];
    
    for(var i = 0; i < goBackDays; i++) {
      var newDate = new Date(today.setDate(today.getDate() - 1));
      daysSorted.push(newDate.toISOString().split('T')[0]);
    }
    
    var days = daysSorted.reverse();
    var chartData = {!! json_encode($chartData) !!};

	// Graphs
	const ctx = document.getElementById('revenueChart')
	// eslint-disable-next-line no-unused-vars
	const revenueChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: days,
			datasets: [{
				data: chartData,
				lineTension: 0.25,
				backgroundColor: 'green',
				borderColor: 'green',
				borderWidth: 4,
				pointBackgroundColor: 'white'
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
            backgroundColor: 'grey',
            borderColor: 'black',
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
    /* globals Chart:false, feather:false */
(() => {
'use strict'

feather.replace({ 'aria-hidden': 'true' })

// Graphs
const ctx = document.getElementById('UsersChart')
// eslint-disable-next-line no-unused-vars
const UsersChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach ($users->groupBy('date') as $user)
                "{{$user->first()->date}}",
            @endforeach
        ],
        datasets: [{
            data: [
                @foreach ($users->groupBy('date') as $user)
                    {{number_format($user->count())}},
                @endforeach
            ],
            lineTension: 0.25,
            backgroundColor: 'grey',
            borderColor: 'black',
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


@endsection
