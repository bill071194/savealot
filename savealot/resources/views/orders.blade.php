@extends('layouts.baseAdmin')

@section('title', 'Orders')
@section('adminTitle', 'Orders')
@section('activeOrders', 'active')

@section('section')
<div class="row">
    @foreach ($orders as $order)
        <div class="col-12 col-xl-6">
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
