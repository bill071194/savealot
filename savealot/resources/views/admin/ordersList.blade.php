@extends('layouts.baseAdmin')

@section('title', 'Save-a-lot Orders')
@section('adminTitle', 'Orders')
@section('activeOrdersList', 'active')
@section('url', '../')


@section('section')
<div class="row">
    {{$orders->links()}}
    @foreach ($orders as $order)
    <div class="col-12 my-3" id="id-{{$order->id}}">
        <div class="card h-100 shadow border-dark rounded-4">
            <div class="card-header text-center">Order ID: {{$order->id}} <br> Placed {{$order->date}}</div>
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
                            @php $item = $inventory->find($transaction->prod_id); @endphp
                            @if (($transaction->order_id) == $order->id)
                                <tr>
                                    <td colspan="3"><img style="width: 1.5rem;" src="{{$transaction->prod_picture}}"> {{$transaction->prod_name}}</td>
                                    <td>${{$transaction->prod_price}}</td>
                                    <td>
                                        <form class="d-none" action="order/{{$transaction->id}}" method="post">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="updateQty" value="-1">
                                            <input type="submit" id="remove-{{$transaction->id}}" class="hidden" value="-">
                                        </form>
                                        @if ($item->prod_quantity > 0)
                                            <form class="d-none" action="order/{{$transaction->id}}" method="post">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="updateQty" value="1">
                                                <input type="submit" id="add-{{$transaction->id}}" class="hidden" value="+">
                                            </form>
                                        @else
                                            <input type="submit" id="add-{{$transaction->id}}" class="hidden d-none" value="max">
                                        @endif
                                        <div class="btn-group d-flex text-center">
                                            <label for="remove-{{$transaction->id}}" class="btn btn-sm btn-outline-danger rounded-start-3 px-1">-</label>
                                            <label for="" class="btn btn-sm btn-outline-secondary px-1">{{$transaction->item_qty}}</label>
                                            @if ($item->prod_quantity > 0)
                                                <label for="add-{{$transaction->id}}" class="btn btn-sm btn-outline-success rounded-end-3 px-1">+</label>
                                            @else
                                                <label for="add-{{$transaction->id}}" class="btn btn-sm btn-outline-secondary rounded-end-3 px-1">+</label>
                                            @endif
                                        </div>
                                    </td>
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
                <div class="d-flex justify-content-center">
                    <form action="order/{{$order->id}}" method="post">
                        @csrf @method('DELETE')
                        <input type="submit" class="btn btn-danger rounded-5 px-3" value="Delete Order">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    {{$orders->links()}}
</div>

@endsection
