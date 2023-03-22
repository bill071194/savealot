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
				<div class="card-footer align-right">
					<!-- Button trigger modal -->
                    <a class="btn btn-primary" href="inventory/{{$item->id}}">Edit</a>
					{{-- <div class="modal fade" id="{{$item->id}}Model" tabindex="-1" aria-labelledby="{{$item->id}}ModelLabel" aria-hidden="true">
						<div class="modal-dialog">
                            <form action="">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="{{$item->id}}ModelLabel">Edit Product</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body row">

                                        <div class="mb-1 mb-sm-3 col-3 col-sm-4">
                                            <label for="id-{{$item->id}}">ID</label>
                                            <input id="id-{{$item->id}}" type="number" class="form-control rounded-3" name="id-{{$item->id}}" value="{{$item->id}}" required>
                                        </div>
                                        <div class="mb-1 mb-sm-3 col-9 col-sm-8">
                                            <label for="id-{{$item->id}}">Name</label>
                                            <input id="prod_name-{{$item->id}}" type="text" class="form-control rounded-3" name="prod_name-{{$item->id}}" value="{{$item->prod_name}}" required>
                                        </div>
                                        <div class="mb-1 mb-sm-3 col-12 col-sm-12">
                                            <label for="prod_description-{{$item->id}}">Description</label>
                                            <textarea name="prod_description-{{$item->id}}" id="prod_description-{{$item->id}}" rows="3" class="form-control rounded-3">{{$item->prod_description}}</textarea>
                                        </div>
                                        <div class="mb-1 mb-sm-3 col-6 col-sm-6">
                                            <label for="prod_purchase_price-{{$item->id}}">Purchase Price</label>
                                            <div class="input-group rounded-3 col">
                                                <span class="input-group-text">$</span>
                                                <input id="prod_purchase_price-{{$item->id}}" type="text" class="form-control" name="prod_purchase_price-{{$item->id}}" value="{{$item->prod_purchase_price}}">
                                            </div>
                                        </div>
                                        <div class="mb-1 mb-sm-3 col-6 col-sm-6">
                                            <label for="prod_selling_price-{{$item->id}}">Selling Price</label>
                                            <div class="input-group rounded-3 col">
                                                <span class="input-group-text">$</span>
                                                <input id="prod_selling_price-{{$item->id}}" type="text" class="form-control" name="prod_selling_price-{{$item->id}}" value="{{$item->prod_selling_price}}">
                                            </div>
                                        </div>
                                        <div class="mb-1 mb-sm-3 col-6 col-sm-4">
                                            <label for="prod_units-{{$item->id}}" class="center">Units</label>
                                            <div class="input-group rounded-3">
                                                <input id="prod_units-{{$item->id}}" type="text" class="form-control" name="prod_units-{{$item->id}}" value="{{$item->prod_units}}">
                                            </div>
                                        </div>
                                        <div class="mb-1 mb-sm-3 col-6 col-sm-4">
                                            <label for="prod_size-{{$item->id}}">Size</label>
                                            <div class="input-group rounded-3">
                                                <input id="prod_size-{{$item->id}}" type="number" class="form-control" name="prod_size-{{$item->id}}" value="{{$item->prod_size}}">
                                                <span class="input-group-text">g</span>
                                            </div>
                                        </div>
                                        <div class="mb-1 mb-sm-3 col-4 col-sm-4">
                                            <label for="prod_quantity-{{$item->id}}">Quantity</label>
                                            <div class="input-group rounded-3">
                                                <input id="prod_quantity-{{$item->id}}" type="number" class="form-control" name="prod_quantity-{{$item->id}}" value="{{$item->prod_size}}">
                                            </div>
                                        </div>
                                        <div class="mb-1 mb-sm-3 col-8 col-sm-4">
                                            <label for="prod_quantity-{{$item->id}}">Expiry Date</label>
                                            <div class="input-group rounded-3">
                                                <input id="prod_exp_date-{{$item->id}}" type="date" class="form-control" name="prod_exp_date-{{$item->id}}" value="{{$item->prod_exp_date}}">
                                            </div>
                                        </div>
                                        <div class="mb-1 mb-sm-3 col-12 col-sm-8">
                                            <label for="prod_picture-{{$item->id}}">Picture URL</label>
                                            <div class="input-group rounded-3">
                                                <input id="prod_picture-{{$item->id}}" type="text" class="form-control" name="prod_picture-{{$item->prod_picture}}" value="{{$item->prod_picture}}">
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <input type="submit" class="btn btn-primary" value="Save changes">
                                    </div>
                                </div>
                            </form>
						</div>
					</div> --}}
				</div>
			</div>
		</div>
	@endforeach
</div>
@endsection
