@extends('layouts.baseAdmin')

@section('title', 'Save-a-lot Inventory')
@section('adminTitle', 'Inventory')
@section('activeInventory', 'active')

@section('section')
<h1 class="text-center">{{$item->prod_name}}</h1>
<div class="row g-3 align-items-start" id="items">
    {{-- <div class="col-md-3 d-lg-none"></div> --}}
    <div class="col-12 col-md-6 col-lg-4 col-xxl-3 offset-md-3 offset-lg-0">
        <div class="card h-100 shadow border-dark rounded-4">
            <div class="card-header rounded-top-4" style="background-color: {{$item->prod_color}}"></div>
            <div class="row card-body align-items-center py-1 py-md-2">
                <a class="col-3 col-md-12 text-decoration-none px-0 px-md-3 mb-md-auto">
                    <img class="card-img text-center" src='{{ $item->prod_picture}}'>
                </a>
                    <div class="col-9 col-md-12 px-0 px-md-1 mb-md-auto">
                    <div class="row gap-1 m-auto justify-content-center mt-md-1">
                        @isset($item->prod_selling_price)
                            <div class="col-auto badge rounded-pil text-bg-success">${{$item->prod_selling_price}}</div>
                        @endisset
                        @isset($item->prod_units)
                            <div class="col-auto badge rounded-pil text-bg-secondary">{{$item->prod_units}}</div>
                        @endisset
						@isset($item->prod_size)
						    @if($item->prod_size > 0)
								<div class="col-auto badge rounded-pil text-bg-dark">{{$item->prod_size}}g</div>
                                @isset($item->prod_selling_price)
                                    <div class="col-auto badge rounded-pil text-dark bg-success-subtle">${{number_format($item->prod_selling_price / $item->prod_size * 100, 2)}}/100g</div>
                                @endisset
                            @endif
						@endisset
                    </div>
                        <h5 class="card-title my-0 text-center mt-md-1">{{$item->prod_name}}</h5>
                        <p class="card-text m-0 text-center small mobile mt-md-1">{{$item->prod_description}}</p>
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
                    @if (session("cart-$item->id") != 0)
                        @if (session("cart-$item->id") == 0)
                            <input type="submit" class="btn btn-sm btn-secondary rounded-5 px-3" value="min">
                            @else
                            <form class="" action="shop/{{$item->id}}/removeFromCart" method="post">
                                @csrf
                                <input type="submit" class="btn btn-sm btn-outline-danger rounded-5 px-3" value="-">
                            </form>
                        @endif
                        <a class="btn btn-sm btn-light rounded-5 px-3" href="cart">{{session("cart-$item->id")}} in cart</a>
                    @endif
                    @if ((session("cart-$item->id") < round($item->prod_quantity / 2)) and session("cart-$item->id") < 10)
                        <form class="" action="shop/{{$item->id}}/addToCart" method="post">
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

    <div class="col-12 col-lg-8">
        <div class="">
            <form method="POST" action="inventory-{{$item->id}}">
                @csrf
                <div class="">
                    <div class="">
                        <h1 class="fs-5">Edit Product</h1>
                    </div>
                    <div class="row">

                        <div class="mb-1 mb-sm-3 col-3 col-sm-4">
                            <label for="id">ID</label>
                            <input id="id" type="number" class="form-control rounded-3 @error('id') is-invalid @enderror" name="id" @error('id')
                                value="{{$item->id}}" @else value="{{old('id', $item->id)}}" @enderror aria-describedby="idValidation" disabled>
                            <div id="idValidation" class="invalid-feedback">{{old('id')}} is not a unique id</div>
                        </div>

                        <div class="mb-1 mb-sm-3 col-9 col-sm-8">
                            <label for="prod_name">Name</label>
                            <input id="prod_name" type="text" class="form-control rounded-3 @error('prod_name') is-invalid @enderror" name="prod_name" value="{{old('prod_name',$item->prod_name)}}" aria-describedby="prod_nameValidation" required autofocus>
                            <div id="prod_nameValidation" class="invalid-feedback">Please enter a unique product name</div>
                        </div>

                        <div class="mb-1 mb-sm-3 col-12 col-sm-12">
                            <label for="prod_description">Description</label>
                            <textarea name="prod_description" id="prod_description" rows="3" class="form-control rounded-3">{{old('prod_description',$item->prod_description)}}</textarea>
                        </div>

                        <div class="mb-1 mb-sm-3 col-6 col-sm-6">
                            <label for="prod_purchase_price">Purchase Price</label>
                            <div class="input-group rounded-3 col">
                                <span class="input-group-text">$</span>
                                <input id="prod_purchase_price" type="text" class="form-control" name="prod_purchase_price" value="{{old('prod_purchase_price',$item->prod_purchase_price)}}">
                            </div>
                        </div>

                        <div class="mb-1 mb-sm-3 col-6 col-sm-6">
                            <label for="prod_selling_price">Selling Price</label>
                            <div class="input-group rounded-3 col">
                                <span class="input-group-text">$</span>
                                <input id="prod_selling_price" type="text" class="form-control" name="prod_selling_price" value="{{old('prod_selling_price',$item->prod_selling_price)}}">
                            </div>
                        </div>

                        <div class="mb-1 mb-sm-3 col-6 col-sm-4">
                            <label for="prod_units" class="center">Units<span class="d-none d-sm-inline"> (eg. 5x102g)</span></label>
                            <div class="input-group rounded-3">
                                <input id="prod_units" type="text" class="form-control" name="prod_units" value="{{old('prod_units',$item->prod_units)}}">
                            </div>
                        </div>

                        <div class="mb-1 mb-sm-3 col-6 col-sm-4">
                            <label for="prod_size">Size (grams)</label>
                            <div class="input-group rounded-3">
                                <input id="prod_size" type="number" class="form-control" name="prod_size" max="100000" value="{{old('prod_size',$item->prod_size)}}">
                                <span class="input-group-text">g</span>
                            </div>
                        </div>

                        <div class="mb-1 mb-sm-3 col-4 col-sm-4">
                            <label for="prod_quantity">Quantity</label>
                            <input id="prod_quantity" type="number" class="form-control rounded-3 @error('prod_quantity') is-invalid @enderror" name="prod_quantity" value="{{old('prod_quantity', $item->prod_quantity)}}" aria-describedby="prod_quantityValidation">
                            <div id="prod_quantityValidation" class="invalid-feedback">
                                Please enter a quantity of 0 or higher.
                            </div>
                        </div>

                        <div class="mb-1 mb-sm-3 col-8 col-sm-12">
                            <label for="prod_picture">Picture URL</label>
                            <div class="input-group rounded-3">
                                <input id="prod_picture" type="text" class="form-control" name="prod_picture" maxlength="255" value="{{old('prod_picture',$item->prod_picture)}}">
                            </div>
                        </div>

                        <div class="mb-1 mb-sm-3 col-8 col-sm-8">
                            <label for="picture_upload">Picture Upload</label>
                            <input id="picture_upload" type="file" class="form-control @error('picture_upload') is-invalid @enderror" name="picture_upload" value="{{old('picture_upload')}}" disabled readonly>
                        </div>

                        <div class="mb-1 mb-sm-3 col-4 col-sm-4">
                            <label for="prod_color">Color<span class="d-none d-sm-inline"> selection</span></label>
                            <input style="height: 2.375rem" id="prod_color" type="color" class="form-control" name="prod_color" value="{{old('prod_color', $item->prod_color)}}">
                            <small>{{old('prod_color')}}</small>
                        </div>

                        <div class="mb-1 mb-sm-3 col-4 col-sm-4">
                            <label for="competitor_saveonfoods"><span class="d-inline d-md-none d-lg-inline d-xl-none">SAF</span><span class="d-none d-md-inline d-lg-none d-xl-inline">Save-on-Foods</span><span class="d-none d-sm-inline"> pricing</span></label>
                            <input id="competitor_saveonfoods" type="number" class="form-control rounded-3" name="competitor_saveonfoods" value="{{old('competitor_saveonfoods', $item->competitor_saveonfoods)}}" min="0" max="1000" step="0.01">
                        </div>

                        <div class="mb-1 mb-sm-3 col-4 col-sm-4">
                            <label for="competitor_tnt">T&T<span class="d-none d-sm-inline"> pricing</span></label>
                            <input id="competitor_tnt" type="number" class="form-control rounded-3" name="competitor_tnt" value="{{old('competitor_tnt', $item->competitor_tnt)}}" min="0" max="1000" step="0.01">
                        </div>

                        <div class="mb-1 mb-sm-3 col-4 col-sm-4">
                            <label for="competitor_walmart">Walmart<span class="d-none d-sm-inline"> pricing</span></label>
                            <input id="competitor_walmart" type="number" class="form-control rounded-3" name="competitor_walmart" value="{{old('competitor_walmart', $item->competitor_walmart)}}" min="0" max="1000" step="0.01">
                        </div>

                        <div class="mb-1 mb-sm-3 col-12 col-sm-6">
                            <label for="created_at">Created at</label>
                            <div class="input-group rounded-3">
                                <input id="created_at" type="text" class="form-control" name="created_at-{{$item->id}}" value="{{old('created_at',$item->created_at)}}" disabled readonly>
                            </div>
                        </div>

                        <div class="mb-1 mb-sm-3 col-12 col-sm-6">
                            <label for="updated_at">Updated at</label>
                            <div class="input-group rounded-3">
                                <input id="updated_at" type="text" class="form-control" name="updated_at-{{$item->id}}" value="{{old('updated_at',$item->updated_at)}}" disabled readonly>
                            </div>
                        </div>

                        <input type="submit" id="saveChanges" hidden>
                    </div>
                    <div class="d-flex flex-row-reverse justify-content-start mt-2">
                        <label for="saveChanges" class="btn btn-primary rounded-5 px-3">Save<span class="d-none d-sm-inline"> changes</span></label>
                        <a href="inventory#items" type="button" class="btn btn-secondary rounded-5 px-3 mx-3">Close</a>
                        <div class="flex-grow-1"></div>
                        <button class="btn btn-danger rounded-5 px-3" type="button" data-bs-toggle="modal" data-bs-target="#{{$item->id}}-Modal">Delete</button>
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
