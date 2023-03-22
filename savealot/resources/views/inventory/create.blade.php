@extends('layouts.base2')

@section('title', 'Inventory')
@section('activeInventory', 'active')

@section('main')
<h1>Inventory</h1>
<div class="row row-cols-1 g-3">
	{{-- @foreach ($inventory as $item) --}}

        <div class="col" id="Model" tabindex="-1" aria-labelledby="ModelLabel">
            <div class="modal-dialog">
                <form action="">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="ModelLabel">Edit Product</h1>
                        </div>
                        <div class="modal-body row">
                            <div class="mb-1 mb-sm-3 col-3 col-sm-4">
                                <label for="id-new">ID</label>
                                <input id="id-new" type="number" class="form-control rounded-3" name="id-new" value="new" required>
                            </div>
                            <div class="mb-1 mb-sm-3 col-9 col-sm-8">
                                <label for="id-new">Name</label>
                                <input id="prod_name-new" type="text" class="form-control rounded-3" name="prod_name-new" value="" required>
                            </div>
                            <div class="mb-1 mb-sm-3 col-12 col-sm-12">
                                <label for="prod_description-new">Description</label>
                                <textarea name="prod_description-new" id="prod_description-new" rows="3" class="form-control rounded-3"></textarea>
                            </div>
                            <div class="mb-1 mb-sm-3 col-6 col-sm-6">
                                <label for="prod_purchase_price-new">Purchase Price</label>
                                <div class="input-group rounded-3 col">
                                    <span class="input-group-text">$</span>
                                    <input id="prod_purchase_price-new" type="text" class="form-control" name="prod_purchase_price-new" value="">
                                </div>
                            </div>
                            <div class="mb-1 mb-sm-3 col-6 col-sm-6">
                                <label for="prod_selling_price-new">Selling Price</label>
                                <div class="input-group rounded-3 col">
                                    <span class="input-group-text">$</span>
                                    <input id="prod_selling_price-new" type="text" class="form-control" name="prod_selling_price-new" value="">
                                </div>
                            </div>
                            <div class="mb-1 mb-sm-3 col-6 col-sm-4">
                                <label for="prod_units-new" class="center">Units</label>
                                <div class="input-group rounded-3">
                                    <input id="prod_units-new" type="text" class="form-control" name="prod_units-new" value="">
                                </div>
                            </div>
                            <div class="mb-1 mb-sm-3 col-6 col-sm-4">
                                <label for="prod_size-new">Size</label>
                                <div class="input-group rounded-3">
                                    <input id="prod_size-new" type="number" class="form-control" name="prod_size-new" value="">
                                    <span class="input-group-text">g</span>
                                </div>
                            </div>
                            <div class="mb-1 mb-sm-3 col-4 col-sm-4">
                                <label for="prod_quantity-new">Quantity</label>
                                <div class="input-group rounded-3">
                                    <input id="prod_quantity-new" type="number" class="form-control" name="prod_quantity-new" value="">
                                </div>
                            </div>
                            <div class="mb-1 mb-sm-3 col-8 col-sm-4">
                                <label for="prod_quantity-new">Expiry Date</label>
                                <div class="input-group rounded-3">
                                    <input id="prod_exp_date-new" type="date" class="form-control" name="prod_exp_date-new" value="">
                                </div>
                            </div>
                            <div class="mb-1 mb-sm-3 col-12 col-sm-8">
                                <label for="prod_picture-new">Picture URL</label>
                                <div class="input-group rounded-3">
                                    <input id="prod_picture-new" type="text" class="form-control" name="prod_picture-new" value="">
                                </div>
                            </div>
                            <div class="mb-1 mb-sm-3 col-12 col-sm-6">
                                <label for="created_at-new">Created at</label>
                                <div class="input-group rounded-3">
                                    <input id="created_at-new" type="datetime-local" class="form-control" name="created_at-new" value="" disabled readonly>
                                </div>
                            </div>
                            <div class="mb-1 mb-sm-3 col-12 col-sm-6">
                                <label for="updated_at-new">Updated at</label>
                                <div class="input-group rounded-3">
                                    <input id="updated_at-new" type="datetime-local" class="form-control" name="updated_at-new" value="" disabled readonly>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <a href="../inventory"><button type="button" class="btn btn-secondary mx-3">Close</button></a>
                            <input type="submit" class="btn btn-primary" value="Save changes">
                        </div>
                    </div>
                </form>
            </div>
        </div>

	{{-- @endforeach --}}
</div>
@endsection
