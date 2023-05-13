@extends('layouts.base')

@section('title', 'Save-a-lot Order History')
@section('activeOrderHistory', 'active')

@section('main')
<div class="card h-100 shadow border-dark rounded-4">
<div class="card-header h1 text-center">Order History</div>
<div class="card-body px-1 px-sm-3">
    @foreach ($orders as $order)
        <div class="col col-md-10 offset-md-1 mb-3">
            <div class="card h-100 shadow border-dark rounded-4">
                <div class="card-header text-center">Order ID: {{$order->id}} <br> Placed {{$order->dateFull}}</div>
                <div class="card-body p-0 p-sm-3">
                    <table class="table table-light table-striped table-bordered border-dark-subtle table-hover m-0">
                        <thead>
                            <tr class="table-dark align-middle text-center">
                                <th colspan="3">Product</th>
                                <th class="px-0">Price</th>
                                <th class="px-0">Qty</th>
                                <th class="px-0">Total</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @foreach ($transactions as $transaction)
                                @if (($transaction->order_id) == $order->id)
                                    <tr class="align-middle text-center">
                                        <td colspan="3" class="px-0"><img style="width: 1.5rem;" src="{{$transaction->prod_picture}}"> {{$transaction->prod_name}}</td>
                                        <td class="px-0">${{$transaction->prod_price}}</td>
                                        <td class="px-0">{{$transaction->item_qty}}</td>
                                        <td class="px-0">${{$transaction->item_total}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                        <tbody class="table-group-divider">
                            @if ($order->student == 1)
                            <tr class="table-secondary border-dark-subtle align-middle text-center">
                                <th colspan="5" class="px-0">Subtotal</th>
                                <th class="px-0">${{$order->subtotal}}</th>
                            </tr>
                            <tr class="table-info border-dark-subtle align-middle text-center">
                                <td colspan="3" class="px-0">Student Discount</td>
                                <td colspan="2" class="px-0">-10%</td>
                                <td class="px-0">(${{$order->discount}})</td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot class="table-group-divider">
                            <tr class="table-success align-middle text-center">
                                <th colspan="5" class="px-0">Total for order placed <span class="d-lg-none">{{$order->date}}</span><span class="d-none d-lg-inline">{{$order->dateFull}}</span></th>
                                <th class="px-0">${{$order->total}}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer">
                    @auth
                        @if (Auth::user()->admin == true)
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-danger rounded-5 px-3" type="button" data-bs-toggle="modal" data-bs-target="#{{$order->id}}-Modal">Delete</button>
                            <div class="modal fade" id="{{$order->id}}-Modal" tabindex="-1" aria-labelledby="{{$order->id}}ModelLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="{{$order->id}}ModelLabel">Are you sure you want to delete this order?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>Seriously it'll be gone!</h6>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary rounded-5 px-3" data-bs-dismiss="modal">No go back!</button>
                                            <form action="order/{{$order->id}}" method="post">
                                                @csrf @method('DELETE')
                                                <input type="submit" class="btn btn-danger rounded-5 px-3" value="Delete Order">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
@endsection
