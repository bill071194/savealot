@extends('layouts.base')

@section('title', 'Save-a-lot Order History')
@section('activeOrderHistory', 'active')

@section('main')
<div class="card h-100 shadow border-dark rounded-4">
<div class="card-header h1 text-center">Order History</div>
<div class="card-body">
    @foreach ($orders as $order)
        <div class="col col-md-10 offset-md-1 mb-3">
            <div class="card h-100 shadow border-dark rounded-4">
                <div class="card-header text-center">Order ID: {{$order->id}} <br> Placed {{$order->date}}</div>
                <div class="card-body">
                    <table class="table table-light table-striped table-bordered border-dark-subtle table-hover">
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
                            <tr class="table-secondary border-dark-subtle">
                                <th colspan="5">Subtotal</th>
                                <th>${{$order->subtotal}}</th>
                            </tr>
                            <tr class="table-info border-dark-subtle">
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
                <div class="card-footer">
                    @if (Auth::user()->email == "saladmin@localhost")
                        <div class="d-flex justify-content-center">
                            <form action="order/{{$order->id}}" method="post">
                                @csrf @method('DELETE')
                                <input type="submit" class="btn btn-danger rounded-5 px-3" value="Delete Order">
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
@endsection
