@extends('layouts.app')

@section('content')
 <div class="album py-5 bg-light">
        <div class="container">
            <div class="">
                <div class="col">
                    <div class="card shadow-sm border-dark">
                        <h4 class="card-header bg-success text-center text-light">Salted Cashews</h4>
                        <a href="salted_cashews.html"><img src="pics/Salted_Cashews.webp" height="225" width="225"></a>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="badge rounded-pil bg-success">$12.99</span>
                                    <span class="badge rounded-pil bg-dark">800g</span>
                                </div>
                                <button type="button" class="btn btn-sm btn-success">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
