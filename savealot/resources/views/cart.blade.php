@extends('layouts.base')

@section('title', 'Cart')

<?php
$subtotal = 0;
$nextItem = 0;
$total = 0;
?>
@section('main')
<h1 class="h1 text-center">Cart</h1>
<div class="">
    <div class="col col-md-10 offset-md-1">
        <table class="table table-light table-striped table-bordered border-dark-subtle table-hover">
            <thead>
                <tr class="table-dark">
                    <th>Product</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($inventory as $item)
                    @if (session($item->id) > 0)
                        <tr>
                            <td>{{$item->prod_name}}</td>
                            <td>${{$item->prod_selling_price}}</td>
                            <td>{{session($item->id)}}</td>
                            <td>${{$nextItem = number_format($item->prod_selling_price * session($item->id), 2)}}</td>
                            <?php $subtotal += $nextItem ?>
                        </tr>
                    @endif
                @endforeach
            </tbody>
            <tbody class="table-group-divider">
                <tr>
                    <th colspan="3">Subtotal</th>
                    <th>${{number_format($subtotal, 2)}}</th>
                </tr>
                <tr>
                    <td>Student Discount</td>
                    <td colspan="2" class="text-center">-10%</td>
                    <td>(${{number_format($subtotal * (0.1),2)}})</td>
                    @php
                        $total = $subtotal * 0.9;
                        session('total', number_format($total,2));
                    @endphp
                </tr>
            </tbody>
            <tfoot class="table-group-divider">
                <tr class="table-success">
                    <th colspan="3">Total:</th>
                    <th>${{number_format($total, 2)}}</th>
                </tr>
            </tfoot>
        </table>
        <form action="" class="d-flex justify-content-end">
            <input type="hidden">
            <button class="btn btn-outline-success">Confirm Purchase</button>
        </form>
    </div>
</div>
@endsection
