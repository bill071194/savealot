@extends('layouts.baseAdmin')

@section('title', 'Save-a-lot Admin')
@section('adminTitle', 'Inventory')
@section('activeInventory', 'active')

@section('section')
<div class="mb-4 border-bottom row">
    <div class="col-12 border-bottom">
        <div class="text-center w-100 fw-bold mt-2">Inventory</div>
        <canvas class="mb-2 w-100" id="inventoryChart" width="3000" height="1000" style="display: block; box-sizing: border-box; height: 301px; width: 715px;"></canvas>
    </div>
    {{$inventory->links()}}
</div>
<div class="text-center justify-content-evenly d-flex mt-3 mb-4 flex-wrap gap-3" id="items">
    <a class="btn btn-outline-success rounded-5 px-3" href="inventory-create">Create New Item</a>
    <a class="btn btn-outline-success rounded-5 px-3" href="uploadpicture">Add a Product Image</a>
    <a class="btn btn-outline-success rounded-5 px-3" href="uploadfile">Import CSV File</a>
</div>
<div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-4 g-3">
	@foreach ($inventory as $item)
		<div class="col" id="id-{{$item->id}}">
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
                    <div class="d-flex justify-content-evenly">
                        <div class="d-none">
                            <form action="/inventory/{{$item->id}}/updateQty" method="post">
                                @csrf
                                <input type="hidden" name="updateQty" @if ($item->prod_quantity >= 10) value="-10" @else value="-{{$item->prod_quantity}}" @endif">
                                <input type="submit" id="updateQty(-10)-{{$item->id}}">
                            </form>
                            <form action="inventory/{{$item->id}}/updateQty" method="post">
                                @csrf
                                <input type="hidden" name="updateQty" @if ($item->prod_quantity >= 1) value="-1" @else value="-{{$item->prod_quantity}}" @endif">
                                <input type="submit" id="updateQty(-1)-{{$item->id}}">
                            </form>
                            <form action="inventory/{{$item->id}}/updateQty" method="post">
                                @csrf
                                <input type="hidden" name="updateQty" value="1">
                                <input type="submit" id="updateQty(+1)-{{$item->id}}">
                            </form>
                            <form action="/inventory/{{$item->id}}/updateQty" method="post">
                                @csrf
                                <input type="hidden" name="updateQty" value="10">
                                <input type="submit" id="updateQty(+10)-{{$item->id}}">
                            </form>
                        </div>
                        <div class="btn-group">
                            <label for="updateQty(-10)-{{$item->id}}" class="btn btn-outline-warning">@if ($item->prod_quantity >= 10) -10 @else -{{$item->prod_quantity}} @endif</label>
                            <label for="updateQty(-1)-{{$item->id}}" class="btn btn-outline-warning">@if ($item->prod_quantity >= 1) -1 @else -0 @endif</label>
                            <label for="" class="btn btn-secondary border-0">{{$item->prod_quantity}}</label>
                            <label for="updateQty(+1)-{{$item->id}}" class="btn btn-outline-info">+1</label>
                            <label for="updateQty(+10)-{{$item->id}}" class="btn btn-outline-info">+10</label>
                        </div>
                    </div>
                </div>

                <div class="card-footer p-2">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-sm btn-danger rounded-5 px-3" type="button" data-bs-toggle="modal" data-bs-target="#{{$item->id}}-Modal">Delete</button>
                        <a class="btn btn-sm btn-primary rounded-5 px-3" href="inventory-{{$item->id}}">Edit</a>
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
                                        <button type="button" class="btn btn-secondary rounded-5 px-3" data-bs-dismiss="modal">No go back!</button>
                                        <form action="inventory/{{$item->id}}/destroy" method="post">
                                            @csrf
                                        <input type="submit" class="btn btn-danger rounded-5 px-3" value="Delete">
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	@endforeach
    {{$inventory->links()}}
</div>
<h1 class="text-center mt-1"><a class="btn btn-outline-success rounded-5 px-3" href="inventory-create">Create New Item</a></h1>

<script>
	new Chart(document.getElementById('inventoryChart'), {
		type: 'bar',
		data: {
			labels: [@foreach ($inventory as $item) "{!! $item['prod_name'] !!}", @endforeach],
			datasets: [{
                label: "Qty in stock",
				data: [@foreach ($inventory as $item) {{$item['prod_quantity']}}, @endforeach],
                backgroundColor: [@foreach ($inventory as $item) "{{$item['prod_color']}}cc", @endforeach],
                borderColor: '#000c',
				borderWidth: 1,
			},
        ]
		},
		options: {
            indexAxis: 'y',
            scales: {
                y: {
                    beginAtZero: true,
                }
            },
			plugins: {
				legend: {
					display: false,
				},
				tooltip: {
					boxPadding: 3,
				}
			}
		}
	});
</script>

@endsection
