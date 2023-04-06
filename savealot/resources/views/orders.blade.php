@extends('layouts.baseAdmin')

@section('title', 'Save-a-lot Admin')
@section('adminTitle', 'Orders')
@section('activeOrders', 'active')

@section('section')
<div class="mb-4 border-bottom">
    <div class="text-center w-100 fw-bold mt-4">Revenue Chart</div>
    <canvas class="my-4 w-100" id="revenueChart" width="1430" height="603" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
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
<div class="row">
    @foreach ($orders->sortByDesc('id') as $order)
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
    @endforeach
</div>
@endsection
