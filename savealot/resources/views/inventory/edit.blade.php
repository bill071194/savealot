@extends('layouts.base2')

@section('title', 'Inventory')
@section('activeInventory', 'active')

@section('main')
<h1>Inventory</h1>
<div class="row g-3">
    <div class="col-md-3 d-lg-none"></div>
    <div class="col-12 col-md-6 col-lg-4 col-xxl-3">
        <div class="card h-100 shadow-sm border-success">
            <div class="row card-body">
                <a class="col-4 col-md-12 text-decoration-none" href="">
                    <img class="card-img text-center" src='../{{$item->prod_picture}}'>
                </a>
                    <div class="col-8 col-md-12">
                        <div class="row gap-1 m-auto">
                            @isset($item->prod_selling_price)
                                <div class="col-auto badge rounded-pil text-bg-success">${{$item->prod_selling_price}}</div>
                            @endisset
                            @isset($item->prod_units)
                                <div class="col-auto badge rounded-pil text-bg-secondary">{{$item->prod_units}}</div>
                            @endisset
                            @isset($item->prod_size)
                                <div class="col-auto badge rounded-pil text-bg-dark">{{$item->prod_size}}g</div>
                                @isset($item->prod_selling_price)
                                    <div class="col-auto badge rounded-pil text-dark bg-success-subtle">${{number_format($item->prod_selling_price / $item->prod_size * 100, 2)}}/100g</div>
                                @endisset
                            @endisset
                        </div>
                        <h4 class="card-title my-0 text-center">{{$item->prod_name}}</h4>
                        <p class="card-text m-0 text-center">
                            {{$item->prod_description}}
                        </p>
                    </div>
            </div>
            <div class="card-footer p-2">
                <div class=" d-flex justify-content-evenly align-items-center">
                    @php
                        if (session()->has("$item->id")) {

                        } else {
                            session(["$item->id" => 0]);
                        }
                    @endphp
                    @if (session("$item->id") != 0)
                        @if (session("$item->id") == 0)
                            <input type="submit" class="btn btn-sm btn-secondary rounded-5 px-3" value="min">
                            @else
                            <form class="" action="shop/{{$item->id}}/removeFromCart" method="post">
                                @csrf
                                <input type="submit" class="btn btn-sm btn-outline-danger rounded-5 px-3" value="-">
                            </form>
                        @endif
                        <a class="btn btn-sm btn-light rounded-5 px-3" href="cart">{{session("$item->id")}} in cart</a>
                    @endif
                    @if (session("$item->id") < $item->prod_quantity)
                        <form class="" action="../shop/{{$item->id}}/addToCart" method="post">
                            @csrf
                            <input type="submit" class="btn btn-sm btn-outline-success rounded-5 px-3" value="+">
                    </form>
                        @else
                        <input type="submit" class="btn btn-sm btn-secondary rounded-5 px-3" value="max">
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 d-lg-none"></div>

    <div class="col-12 col-lg-8 col-xxl-9">
        <div class="">
            <form method="POST" action="edit">
                @csrf
                <div class="">
                    <div class="">
                        <h1 class="fs-5">Edit Product</h1>
                    </div>
                    <div class="row">
                        <div class="mb-1 mb-sm-3 col-3 col-sm-4">
                            <label for="id">ID</label>
                            <input id="id" type="number" class="form-control rounded-3" name="id" value="{{$item->id}}" required>
                        </div>
                        <div class="mb-1 mb-sm-3 col-9 col-sm-8">
                            <label for="prod_name">Name</label>
                            <input id="prod_name" type="text" class="form-control rounded-3" name="prod_name" value="{{$item->prod_name}}" required>
                        </div>
                        <div class="mb-1 mb-sm-3 col-12 col-sm-12">
                            <label for="prod_description">Description</label>
                            <textarea name="prod_description" id="prod_description" rows="3" class="form-control rounded-3">{{$item->prod_description}}</textarea>
                        </div>
                        <div class="mb-1 mb-sm-3 col-6 col-sm-6">
                            <label for="prod_purchase_price">Purchase Price</label>
                            <div class="input-group rounded-3 col">
                                <span class="input-group-text">$</span>
                                <input id="prod_purchase_price" type="text" class="form-control" name="prod_purchase_price" value="{{$item->prod_purchase_price}}">
                            </div>
                        </div>
                        <div class="mb-1 mb-sm-3 col-6 col-sm-6">
                            <label for="prod_selling_price">Selling Price</label>
                            <div class="input-group rounded-3 col">
                                <span class="input-group-text">$</span>
                                <input id="prod_selling_price" type="text" class="form-control" name="prod_selling_price" value="{{$item->prod_selling_price}}">
                            </div>
                        </div>
                        <div class="mb-1 mb-sm-3 col-6 col-sm-4">
                            <label for="prod_units" class="center">Units (eg. 5x102g)</label>
                            <div class="input-group rounded-3">
                                <input id="prod_units" type="text" class="form-control" name="prod_units" value="{{$item->prod_units}}">
                            </div>
                        </div>
                        <div class="mb-1 mb-sm-3 col-6 col-sm-4">
                            <label for="prod_size">Size (grams)</label>
                            <div class="input-group rounded-3">
                                <input id="prod_size" type="number" class="form-control" name="prod_size" value="{{$item->prod_size}}">
                                <span class="input-group-text">g</span>
                            </div>
                        </div>
                        <div class="mb-1 mb-sm-3 col-4 col-sm-4">
                            <label for="prod_quantity">Quantity</label>
                            <div class="input-group rounded-3">
                                <input id="prod_quantity" type="number" class="form-control" name="prod_quantity" value="{{$item->prod_quantity}}">
                            </div>
                        </div>
                        <div class="mb-1 mb-sm-3 col-8 col-sm-4">
                            <label for="prod_quantity">Expiry Date</label>
                            <div class="input-group rounded-3">
                                <input id="prod_exp_date" type="date" class="form-control" name="prod_exp_date" value="{{$item->prod_exp_date}}">
                            </div>
                        </div>
                        <div class="mb-1 mb-sm-3 col-12 col-sm-8">
                            <label for="prod_picture">Picture URL</label>
                            <div class="input-group rounded-3">
                                <input id="prod_picture" type="text" class="form-control" name="prod_picture" value="{{$item->prod_picture}}">
                            </div>
                        </div>
                        <div class="mb-1 mb-sm-3 col-12 col-sm-6">
                            <label for="created_at-{{$item->id}}">Created at</label>
                            <div class="input-group rounded-3">
                                <input id="created_at-{{$item->id}}" type="datetime-local" class="form-control" name="created_at-{{$item->id}}" value="{{$item->created_at}}" disabled readonly>
                            </div>
                        </div>
                        <div class="mb-1 mb-sm-3 col-12 col-sm-6">
                            <label for="updated_at-{{$item->id}}">Updated at</label>
                            <div class="input-group rounded-3">
                                <input id="updated_at-{{$item->id}}" type="datetime-local" class="form-control" name="updated_at-{{$item->id}}" value="{{$item->updated_at}}" disabled readonly>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row-reverse justify-content-start">
                        <input type="submit" class="btn btn-primary rounded-5 px-3" value="Save changes">
                        <a href="../inventory" type="button" class="btn btn-secondary rounded-5 px-3 mx-3">Close</a>
                        <div class="flex-grow-1"></div>
                        <button class="btn btn-sm btn-danger rounded-5 px-3" type="button" data-bs-toggle="modal" data-bs-target="#{{$item->id}}-Modal">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="{{$item->id}}-Modal" tabindex="-1" aria-labelledby="{{$item->id}}-ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{$item->id}}-ModalLabel">Are you sure you want to delete this item?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Seriously it'll be gone!</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-5 px-3" data-bs-dismiss="modal">No go back!</button>
                <form action="../inventory/{{$item->id}}/destroy" method="post">
                    @csrf
                    <input type="submit" class="btn btn-danger rounded-5 px-3" value="Delete">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
