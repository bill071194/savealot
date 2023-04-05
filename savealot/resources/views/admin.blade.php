@extends('layouts.baseAdmin')

@section('title', 'Admin')
@section('adminTitle', 'Admin')
@section('activeAdmin', 'active')

@section('section')
<canvas class="my-4 w-100" id="myChart" width="1430" height="603" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>

	<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js" integrity="sha384-gdQErvCNWvHQZj6XZM0dNsAoY4v+j5P1XDpNkcM3HJG1Yx04ecqIHk7+4VBOCHOG" crossorigin="anonymous"></script>
<script>
		/* globals Chart:false, feather:false */
(() => {
	'use strict'

	feather.replace({ 'aria-hidden': 'true' })

	// Graphs
	const ctx = document.getElementById('myChart')
	// eslint-disable-next-line no-unused-vars
	const myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: [
				'Sunday',
				'Monday',
				'Tuesday',
				'Wednesday',
				'Thursday',
				'Friday',
				'Saturday'
			],
			datasets: [{
				data: [
					15339,
					21345,
					18483,
					24003,
					23489,
					24092,
					12034
				],
				lineTension: 0,
				backgroundColor: 'transparent',
				borderColor: '#007bff',
				borderWidth: 4,
				pointBackgroundColor: '#007bff'
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
