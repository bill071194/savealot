@extends('layouts.baseAdmin')

@section('title', 'Users')
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
