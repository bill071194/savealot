@extends('layouts.base')

@section('title', 'Save-a-lot Cart')
@section('activeCart', 'active')

@php $subtotal = 0; $nextItem = 0; $total = 0; $itemsInCart = 0; @endphp

@section('main')
<div class="col-12 mx-auto">
    <div class="card h-100 shadow border-dark rounded-4">
        <div class="card-header text-center h1">Cart</div>
        @foreach ($inventory as $item)
            @if (session("cart-$item->id") > 0)
                @php
                    $itemsInCart += 1;
                @endphp
            @endif
        @endforeach
        @if ($itemsInCart >= 1)
            <div class="card-body p-0 p-sm-3">
                <table class="table table-light table-striped table-bordered border-dark-subtle table-hover m-0">
                    <thead>
                        <tr class="table-dark align-middle text-center">
                            <th colspan="3" class="px-0">Product</th>
                            <th class="px-0">Price</th>
                            <th class="px-0">Qty</th>
                            <th class="px-0">Total</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($inventory as $item)
                            @if (session("cart-$item->id") > 0)
                                <tr class="align-middle text-center">
                                    <td colspan="3" class="px-0"><img style="width: 1.5rem;" src="{{$item->prod_picture}}"> {{$item->prod_name}}</td>
                                    <td class="px-0">${{$item->prod_selling_price}}</td>
                                    <td class="px-1 px-sm-2">
                                        <form class="d-none" action="shop/{{$item->id}}/removeFromCart" method="post">
                                            @csrf
                                            <input type="hidden" name="redirect" value="redirectToCart">
                                            <input type="submit" id="remove-{{$item->id}}" class="hidden" value="-">
                                        </form>
                                        @if ((session("cart-$item->id") < round($item->prod_quantity / 2)) and session("cart-$item->id") < 10)
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
                                            <label for="" class="btn btn-sm btn-outline-secondary px-1">{{session("cart-$item->id")}}</label>
                                            @if (session("cart-$item->id") < $item->prod_quantity)
                                            <label for="add-{{$item->id}}" class="btn btn-sm btn-outline-success rounded-end-3 px-1">+</label>
                                            @else
                                            <label for="add-{{$item->id}}" class="btn btn-sm btn-outline-secondary rounded-end-3 px-1">+</label>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-0">${{number_format($item->prod_selling_price * session("cart-$item->id"), 2, '.', ',')}}</td>
                                    @php
                                        $nextItem = number_format($item->prod_selling_price * session("cart-$item->id"), 2, '.', '');
                                        $subtotal += $nextItem;
                                    @endphp
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                    <tbody class="table-group-divider">
                        @isset(Auth::user()->student)
                            @if (Auth::user()->student == 1)
                            <tr class="table-secondary align-middle text-center">
                                <th colspan="5" class="px-0">Subtotal</th>
                                <th class="px-0">${{number_format($subtotal, 2)}}</th>
                            </tr>
                            <tr class="table-info align-middle text-center">
                                <td colspan="3" class="px-0">Student Discount</td>
                                <td colspan="2" class="px-0">-10%</td>
                                <td class="px-0">(${{number_format($subtotal * (0.1),2)}})</td>
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
                        <tr class="table-success align-middle text-center">
                            <th colspan="5" class="px-0">Total:</th>
                            <th class="px-0">${{number_format($total, 2)}}</th>
                        </tr>
                    </tfoot>
                </table>
                @if (session('cart-update') == 'true' or true)
                    @foreach ($inventory as $item)
                    @if (session("cart-update-$item->id") == "true")
                        <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                            {{session("cart-update-$item->id-message")}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                    @endif
                    @endforeach

                @endif
            </div>
            <div class="card-footer p-1 px-sm-3 py-sm-2">
                <div class="d-flex justify-content-between">
                    <form action="/emptyCart" method="post" class="d-flex justify-content-end">
                        @csrf
                        <input type="submit" id="emptyCart" name="emptyCart" hidden>
                        <label for="emptyCart" class="btn btn-danger rounded-5 px-3 my-auto">Empty<span class="d-none d-sm-inline"> Cart</span></label>
                    </form>
                    @auth
                        <form action="/cart/checkout" method="post" class="d-flex justify-content-end">
                            @csrf
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <input type="hidden" name="student" value="{{Auth::user()->student}}">
                            <input type="submit" id="confirmPurchase" name="confirmPurchase" hidden>
                            <label for="confirmPurchase" class="btn btn-success rounded-5 px-3" ><span class="d-sm-none">Checkout</span><span class="d-none d-sm-inline">Confirm Purchase</span></label>
                        </form>
                    @endauth
                    @guest
                    <div class="ms-auto text-center my-auto d-md-none">
                        <a href="login" class="btn btn-sm btn-outline-success rounded-5 px-1 py-0">Log in</a> or
                        <a href="register" class="btn btn-sm btn-outline-primary rounded-5 px-1 py-0">Create an Account</a>
                    </div>
                    <div class="ms-auto text-center my-auto d-none d-md-block">
                        <a href="login" class="btn btn-outline-success rounded-5">Log in</a> or
                        <a href="register" class="btn btn-outline-primary rounded-5">Create an Account</a> to checkout
                    </div>
                    @endguest
                </div>
            </div>
        @else
        <div class="card-body">
            <div class="text-center h4">You don't have anything in your cart</div>
            @if (session('cart-update') == 'true' or true)
                @foreach ($inventory as $item)
                    @if (session("cart-update-$item->id") == "true")
                        <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                            {{session("cart-update-$item->id-message")}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="card-footer p-1 px-sm-3 py-sm-2">
            <div class="d-flex justify-content-between flex-wrap gap-2">
                <a href="shop" class="btn btn-success rounded-5 px-3">Go Shopping</a>
                @guest
                <div class="ms-auto text-center my-auto d-md-none">
                    <a href="login" class="btn btn-sm btn-outline-success rounded-5 px-1 py-0">Log in</a> or
                    <a href="register" class="btn btn-sm btn-outline-primary rounded-5 px-1 py-0">Create an Account</a>
                </div>
                <div class="ms-auto text-center my-auto d-none d-md-block">
                    <a href="login" class="btn btn-outline-success rounded-5">Log in</a> or
                    <a href="register" class="btn btn-outline-primary rounded-5">Create an Account</a> to checkout
                </div>
                @endguest
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
