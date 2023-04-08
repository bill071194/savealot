@extends('layouts.baseAdmin')

@section('title', 'Save-a-lot Inventory')
@section('adminTitle', 'Inventory')
@section('activeInventory', 'active')

@section('section')
<h1>Inventory</h1>
<div class="row row-cols-1 g-3">
	{{-- @foreach ($inventory as $item) --}}

		<div class="col" id="Model" tabindex="-1" aria-labelledby="ModelLabel">
			<div class="modal-dialog">
				<form method="POST" action="inventory-create">
					@csrf
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="ModelLabel">Create Product</h1>
						</div>
						<div class="modal-body row">
							<div class="mb-1 mb-sm-3 col-3 col-sm-4">
								<label for="id">ID</label>
								<input id="id" type="number" class="form-control rounded-3" name="id" value="new" disabled readonly>
							</div>
							<div class="mb-1 mb-sm-3 col-9 col-sm-8">
								<label for="prod_name">Name</label>
								<input id="prod_name" type="text" class="form-control rounded-3 @error('prod_name') is-invalid @enderror" name="prod_name" value="{{old('prod_name')}}" aria-describedby="prod_nameValidation" required>
                                <div id="prod_nameValidation" class="invalid-feedback">Please enter a unique product name</div>
							</div>
							<div class="mb-1 mb-sm-3 col-12 col-sm-12">
								<label for="prod_description">Description</label>
								<textarea name="prod_description" id="prod_description" rows="3" class="form-control rounded-3" maxlength="255">{{old('prod_description')}}</textarea>
							</div>
							<div class="mb-1 mb-sm-3 col-6 col-sm-6">
								<label for="prod_purchase_price">Purchase Price</label>
								<div class="input-group rounded-3 col">
									<span class="input-group-text">$</span>
									<input id="prod_purchase_price" type="number" class="form-control" name="prod_purchase_price" max="1000000" step="0.01" value="{{old('prod_purchase_price')}}">
								</div>
							</div>
							<div class="mb-1 mb-sm-3 col-6 col-sm-6">
								<label for="prod_selling_price">Selling Price</label>
								<div class="input-group col rounded-3">
									<span class="input-group-text">$</span>
									<input id="prod_selling_price" type="number" class="form-control" name="prod_selling_price" max="1000000" step="0.01" value="{{old('prod_selling_price')}}">
								</div>
							</div>
							<div class="mb-1 mb-sm-3 col-6 col-sm-4">
								<label for="prod_units" class="center">Units (eg. 5x102g)</label>
								<div class="input-group rounded-3">
									<input id="prod_units" type="text" class="form-control" name="prod_units" maxlength="255" value="{{old('prod_units')}}">
								</div>
							</div>
							<div class="mb-1 mb-sm-3 rounded-3 col-6 col-sm-4">
								<label for="prod_size">Size (grams)</label>
								<div class="input-group">
									<input id="prod_size" type="number" class="form-control" name="prod_size" max="100000" value="{{old('prod_size')}}">
									<span class="input-group-text">g</span>
								</div>
							</div>

							<div class="mb-1 mb-sm-3 col-4 col-sm-4">
								<label for="prod_quantity">Quantity</label>
                                <input id="prod_quantity" type="number" class="form-control rounded-3 @error('prod_quantity') is-invalid @enderror" name="prod_quantity" value="{{old('prod_quantity', 0)}}" aria-describedby="prod_quantityValidation">
                                <div id="prod_quantityValidation" class="invalid-feedback">
                                    Please enter a quantity of 0 or higher.
                                </div>
							</div>

							<div class="mb-1 mb-sm-3 col-8 col-sm-12">
								<label for="prod_picture">Picture URL</label>
                                <input id="prod_picture" type="text" class="form-control" name="prod_picture" maxlength="255" value="{{old('prod_picture', 'pics/')}}">
							</div>

                            <div class="mb-1 mb-sm-3 col-4 col-sm-4">
                                <label for="competitor_saveonfoods"><span class="d-inline d-md-none d-lg-inline d-xl-none">SAF</span><span class="d-none d-md-inline d-lg-none d-xl-inline">Save-on-Foods</span> pricing</label>
                                <input id="competitor_saveonfoods" type="number" class="form-control rounded-3" name="competitor_saveonfoods" value="{{old('competitor_saveonfoods')}}" min="0" max="1000" step="0.01">
                            </div>

                            <div class="mb-1 mb-sm-3 col-4 col-sm-4">
                                <label for="competitor_tnt">T&T pricing</label>
                                <input id="competitor_tnt" type="number" class="form-control rounded-3" name="competitor_tnt" value="{{old('competitor_tnt')}}" min="0" max="1000" step="0.01">
                            </div>

                            <div class="mb-1 mb-sm-3 col-4 col-sm-4">
                                <label for="competitor_walmart">Walmart pricing</label>
                                <input id="competitor_walmart" type="number" class="form-control rounded-3" name="competitor_walmart" value="{{old('competitor_walmart')}}" min="0" max="1000" step="0.01">
                            </div>

							<div class="mb-1 mb-sm-3 rounded-3 col-12 col-sm-6">
								<label for="created_at-new">Created at</label>
                                <input id="created_at-new" type="datetime-local" class="form-control" name="created_at-new" value="" disabled readonly>
							</div>
							<div class="mb-1 mb-sm-3 rounded-3 col-12 col-sm-6">
								<label for="updated_at-new">Updated at</label>
                                <input id="updated_at-new" type="datetime-local" class="form-control" name="updated_at-new" value="" disabled readonly>
							</div>

						</div>
						<div class="modal-footer">
							<a href="../inventory"><button type="button" class="btn btn-secondary mx-3 rounded-5">Close</button></a>
							<input type="submit" class="btn btn-primary rounded-5" value="Save changes">
						</div>
					</div>
				</form>
			</div>
		</div>

	{{-- @endforeach --}}
</div>
@endsection
