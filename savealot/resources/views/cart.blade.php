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
                            <td>${{number_format($item->prod_selling_price * session($item->id), 2, '.', ',')}}</td>
                            @php
                                $nextItem = number_format($item->prod_selling_price * session($item->id), 2, '.', '');
                                $subtotal += $nextItem;
                            @endphp
                        </tr>
                    @endif
                @endforeach
            </tbody>
            <tbody class="table-group-divider">
                @isset(Auth::user()->student)
                    @if (Auth::user()->student == 1)
                    <tr>
                        <th colspan="3">Subtotal</th>
                        <th>${{number_format($subtotal, 2)}}</th>
                    </tr>
                    <tr>
                        <td>Student Discount</td>
                        <td colspan="2" class="text-center">-10%</td>
                        <td>(${{number_format($subtotal * (0.1),2)}})</td>
                        @php
                            $total = number_format($subtotal * 0.9, 2, '.', '');
                            session('total', number_format($total,2));
                        @endphp
                    </tr>
                    @else
                        @php
                            $total = number_format($subtotal * 1.0, 2, '.', '');
                            session('total', number_format($total,2));
                        @endphp
                    @endif
                @endisset

            </tbody>
            <tfoot class="table-group-divider">
                <tr class="table-success">
                    <th colspan="3">Total:</th>
                    <th>${{number_format($total, 2)}}</th>
                </tr>
            </tfoot>
        </table>
        <div class="d-flex justify-content-between">
            <form action="/emptyCart" method="post" class="d-flex justify-content-end">
                @csrf
                <input type="submit" class="btn btn-outline-danger rounded-5 px-3" value="Empty Cart">
            </form>
            @auth
                <form action="/cart/checkout" method="post" class="d-flex justify-content-end">
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                    <input type="hidden" name="student" value="{{Auth::user()->student}}">
                    <input type="submit" value="Confirm Purchase" class="btn btn-outline-success rounded-5 px-3">
                </form>
            @endauth
            @guest
            <div>
                <a href="login" class="btn btn-outline-success rounded-5 px-3">Log in</a> or
                <a href="register" class="btn btn-outline-primary rounded-5 px-3">Create an Account</a> to checkout
            </div>
            @endguest
        </div>
    </div>
</div>
@endsection
