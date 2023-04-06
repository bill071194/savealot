@extends('layouts.baseAdmin')

@section('title', 'Save-a-lot Admin')
@section('adminTitle', 'Users')
@section('activeUsers', 'active')

@section('section')
<div class="mb-4 border-bottom">
    <div class="text-center w-100 fw-bold mt-4">New Users</div>
    <canvas class="my-4 w-100" id="UsersChart" width="1430" height="603" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
</div>

<script>
		/* globals Chart:false, feather:false */
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
	const ctx = document.getElementById('UsersChart')
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
	})
})()
</script>
<table class="table table-light table-striped table-bordered border-dark-subtle table-hover m-0">
    <thead>
        <tr class="table-dark">
            <th><span class="d-none d-xl-inline">User</span> ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Student <span class="d-none d-xl-inline">Status</span></th>
            <th>Created <span class="d-none d-lg-inline">at</span></th>
            <th>Updated <span class="d-none d-lg-inline">at</span></th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->student}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->updated_at}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
