@extends('layouts.base')

@section('title', 'Save-a-lot Shop')
@section('activeShop', 'active')

@section('main')
<div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-4 g-3">
	@foreach ($inventory as $item)
		<div class="col" id="id-{{$item->id}}">
			<div class="card h-100 shadow border-dark rounded-4">
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
	@endforeach
    {{$inventory->links()}}
</div>
@endsection
