@extends('layouts.base')

@section('title', 'Shop')
@section('activeShop', 'active')

@section('main')
<div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-4 g-3">
	@foreach ($inventory as $item)
    @if ($item->prod_quantity > 0)
    @if ($item->prod_selling_price > 0)
		<div class="col">
			<div class="card h-100 shadow border-success">
				<div class="row card-body">
					<a class="col-4 col-sm-4 col-md-12 text-decoration-none" href="">
						<img class="card-img text-center" src='{{ $item->prod_picture}}'>
					</a>
						<div class="col-8 col-sm-8 col-md-12">
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
							<h4 class="card-title my-0">{{$item->prod_name}}</h4>
							<p class="card-text m-0">
								{{$item->prod_description}}
							</p>
						</div>
				</div>
				<div class="card-footer d-flex justify-content-evenly align-items-center">
                    @php
                        if (session()->has("$item->id")) {

                        } else {
                            session(["$item->id" => 0]);
                        }
                    @endphp
                    @if (session("$item->id") != 0)
                    <form class="" action="shop/{{$item->id}}/removeFromCart" method="post">
                        @csrf
						<input type="submit" class="btn btn-sm btn-outline-danger" value="-">
					</form>
                    <div class="badge text-bg-light">{{session("$item->id")}}</div>
                    @endif
					<form class="" action="shop/{{$item->id}}/addToCart" method="post">
                        @csrf
						<input type="submit" class="btn btn-sm btn-outline-success" value="+">
					</form>
				</div>
			</div>
		</div>
    @endif
    @endif
	@endforeach
</div>
@endsection
