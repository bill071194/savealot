@extends('layouts.base')

@section('title', 'Save-a-lot Cart')
@section('activeCart', 'active')

@php $subtotal = 0 @endphp

@section('main')
<div class="col-12 mx-auto">
    <div class="card h-100 shadow border-dark">
        <div class="card-header text-center h1">Cart</div>
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
                    @foreach ($inventory as $item)
                        @if (session($item->id) > 0)
                            <tr>
                                <td colspan="3"><img style="width: 1.5rem;" src="{{$item->prod_picture}}"> {{$item->prod_name}}</td>
                                <td>${{$item->prod_selling_price}}</td>
                                <td>
                                    <form class="d-none" action="shop/{{$item->id}}/removeFromCart" method="post">
                                        @csrf
                                        <input type="hidden" name="redirect" value="redirectToCart">
                                        <input type="submit" id="remove-{{$item->id}}" class="hidden" value="-">
                                    </form>
                                    @if (session("$item->id") < $item->prod_quantity)
                                        <form class="d-none" action="shop/{{$item->id}}/addToCart" method="post">
                                            @csrf
                                            <input type="hidden" name="redirect" value="redirectToCart">
                                            <input type="submit" id="add-{{$item->id}}" class="hidden" value="+">
                                        </form>
                                        @else
                                        <input type="submit" id="add-{{$item->id}}" class="hidden d-none" value="max">
                                    @endif
                                    <div class="btn-group d-flex text-center">
                                        <label for="remove-{{$item->id}}" class="btn btn-sm btn-outline-danger rounded-start-3 px-1">-</label>
                                        <label for="" class="btn btn-sm btn-outline-secondary px-1">{{session("$item->id")}}</label>
                                        @if (session("$item->id") < $item->prod_quantity)
                                        <label for="add-{{$item->id}}" class="btn btn-sm btn-outline-success rounded-end-3 px-1">+</label>
                                        @else
                                        <label for="add-{{$item->id}}" class="btn btn-sm btn-outline-secondary rounded-end-3 px-1">+</label>
                                        @endif
                                    </div>
                                </td>
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
                            <th colspan="5">Subtotal</th>
                            <th>${{number_format($subtotal, 2)}}</th>
                        </tr>
                        <tr>
                            <td colspan="3">Student Discount</td>
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
                        <th colspan="5">Total:</th>
                        <th>${{number_format($total, 2)}}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="card-footer">
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
</div>

@endsection
