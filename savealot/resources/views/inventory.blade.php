@extends('layouts.base')

@section('title', 'Inventory')
@section('activeInventory', 'active')

@section('main')
<div class="">
    <h1>Inventory <a class="btn btn-outline-success" href="inventory/create">Create</a></h1>
</div>
<div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-4 g-3">
	@foreach ($inventory as $item)
		<div class="col">
			<div class="card h-100 shadow-sm border-success">
				<div class="row card-body">
					<a class="col-4 col-sm-4 col-sm-12 text-decoration-none" href="">
						<img class="card-img text-center" src='{{$item->prod_picture}}'>
					</a>
						<div class="col-8 col-sm-8 col-sm-12">
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
				<div class="card-footer d-flex justify-content-evenly">
					<!-- Button trigger modal -->
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#{{$item->id}}-Modal">Delete</button>
                    <a class="btn btn-primary" href="inventory/{{$item->id}}">Edit</a>
					<div class="modal fade" id="{{$item->id}}-Modal" tabindex="-1" aria-labelledby="{{$item->id}}ModelLabel" aria-hidden="true">
						<div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="{{$item->id}}ModelLabel">Are you sure you want to delete this item?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6>Seriously it'll be gone!</h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No go back!</button>
                                    <form action="inventory/{{$item->id}}/destroy" method="post">
                                        @csrf
                                    <input type="submit" class="btn btn-danger" value="Delete">
                                </form>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
</div>
@endsection
