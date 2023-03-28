@extends('layouts.base2')

@section('title', 'Inventory')
@section('activeInventory', 'active')

@section('main')
<h1>Inventory</h1>
<div class="row row-cols-1 g-3">
	{{-- @foreach ($inventory as $item) --}}

        <div class="col" id="Model" tabindex="-1" aria-labelledby="ModelLabel">
            <div class="modal-dialog">
                <form method="POST" action="create">
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
                                <input id="prod_name" type="text" class="form-control rounded-3" name="prod_name" value="" required>
                            </div>
                            <div class="mb-1 mb-sm-3 col-12 col-sm-12">
                                <label for="prod_description">Description</label>
                                <textarea name="prod_description" id="prod_description" rows="3" class="form-control rounded-3"></textarea>
                            </div>
                            <div class="mb-1 mb-sm-3 col-6 col-sm-6">
                                <label for="prod_purchase_price">Purchase Price</label>
                                <div class="input-group rounded-3 col">
                                    <span class="input-group-text">$</span>
                                    <input id="prod_purchase_price" type="text" class="form-control" name="prod_purchase_price" value="">
                                </div>
                            </div>
                            <div class="mb-1 mb-sm-3 col-6 col-sm-6">
                                <label for="prod_selling_price">Selling Price</label>
                                <div class="input-group rounded-3 col">
                                    <span class="input-group-text">$</span>
                                    <input id="prod_selling_price" type="text" class="form-control" name="prod_selling_price" value="">
                                </div>
                            </div>
                            <div class="mb-1 mb-sm-3 col-6 col-sm-4">
                                <label for="prod_units" class="center">Units (eg. 5x102g)</label>
                                <div class="input-group rounded-3">
                                    <input id="prod_units" type="text" class="form-control" name="prod_units" value="">
                                </div>
                            </div>
                            <div class="mb-1 mb-sm-3 col-6 col-sm-4">
                                <label for="prod_size">Size (grams)</label>
                                <div class="input-group rounded-3">
                                    <input id="prod_size" type="number" class="form-control" name="prod_size" value="">
                                    <span class="input-group-text">g</span>
                                </div>
                            </div>
                            <div class="mb-1 mb-sm-3 col-4 col-sm-4">
                                <label for="prod_quantity">Quantity</label>
                                <div class="input-group rounded-3">
                                    <input id="prod_quantity" type="number" class="form-control" name="prod_quantity" value="">
                                </div>
                            </div>
                            <div class="mb-1 mb-sm-3 col-8 col-sm-4">
                                <label for="prod_quantity">Expiry Date</label>
                                <div class="input-group rounded-3">
                                    <input id="prod_exp_date" type="date" class="form-control" name="prod_exp_date" value="">
                                </div>
                            </div>
                            <div class="mb-1 mb-sm-3 col-12 col-sm-8">
                                <label for="prod_picture">Picture URL</label>
                                <div class="input-group rounded-3">
                                    <input id="prod_picture" type="text" class="form-control" name="prod_picture" value="">
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
