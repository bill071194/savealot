@extends('layouts.baseAdmin')

@section('title', 'Orders')
@section('adminTitle', 'Orders')
@section('activeOrdersList', 'active')

@section('section')

<div class="row">
    {{$orders->links()}}
    @foreach ($orders as $order)
    <div class="col-12 my-3">
        <div class="card h-100 shadow border-dark">
            <div class="card-header text-center">Order ID: {{$order->id}}</div>
            <div class="card-body">
                <table class="table table-light table-striped table-bordered border-dark-subtle table-hover m-0">
                    <thead>
                        <tr class="table-dark">
                            <th colspan="3">Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($transactions as $transaction)
                            @if (($transaction->order_id) == $order->id)
                                <tr>
                                    <td colspan="3"><img style="width: 1.5rem;" src="{{$transaction->prod_picture}}"> {{$transaction->prod_name}}</td>
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
                            <th colspan="5">Subtotal</th>
                            <th>${{$order->subtotal}}</th>
                        </tr>
                        <tr>
                            <td colspan="3">Student Discount</td>
                            <td colspan="2" class="text-center">-10%</td>
                            <td>(${{$order->discount}})</td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot class="table-group-divider">
                        <tr class="table-success">
                            <th colspan="5">Total for order placed {{$order->dateFull}}</th>
                            <th>${{$order->total}}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endforeach
    {{$orders->links()}}
</div>

@endsection
