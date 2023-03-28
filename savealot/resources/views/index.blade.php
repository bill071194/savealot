@extends('layouts.base1b')

@section('title', 'Home')
@section('activeHome', 'active')

@section('main')
<div id="carouselElement" class="container-sm-fluid p-3 d-flex row g-0">
    {{-- <div class="col-sm-1 col-md-2 col-lg-3 col-xl-4"></div> --}}
    <div class="mx-auto carousel carousel-dark slide carousel-fade col-12 col-sm-11 col-md-10 col-lg-9 col-xl-8 col-xxl-6" id="carouselFeatured" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($inventory as $item)
            @if ($item->prod_quantity > 0)
            @if ($item->prod_selling_price > 0)
            @if ($item->prod_picture != "")
                <div class="carousel-item @if ($item->id == 2) active @endif">
                    <div class="col">
                        <div class="card shadow-sm border-success">
                            <div class="row card-body">
                                <a id="pic" class="col-12 col-sm-12 col-md-12 text-decoration-none javascriptStyleThis" href="">
                                    <img class="card-img text-center" src='{{ $item->prod_picture}}'>
                                </a>
                                <div id="description" class="col-12 col-sm-12 col-md-12 javascriptStyleThis">
                                    <div class="row gap-1 m-auto justify-content-center">
                                        @isset($item->prod_selling_price)
                                            <div class="col-auto badge rounded-pil rounded-5 text-bg-success">${{$item->prod_selling_price}}</div>
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
                                        <h4 class="card-title my-0 text-center">{{$item->prod_name}}</h4>
                                        <p class="card-text m-0 text-center">
                                            {{$item->prod_description}}
                                        </p>
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
                                    @if (session("$item->id") != 0)
                                        @if (session("$item->id") == 0)
                                            <input type="submit" class="btn btn-sm btn-secondary rounded-5 px-3" value="min">
                                            @else
                                            <form class="" action="shop/{{$item->id}}/removeFromCart" method="post">
                                                @csrf
                                                <input type="submit" class="btn btn-sm btn-outline-danger rounded-5 px-3" value="-">
                                            </form>
                                        @endif
                                        <a class="btn btn-sm btn-light rounded-5 px-3" href="cart">{{session("$item->id")}} in cart</a>
                                    @endif
                                    @if (session("$item->id") < $item->prod_quantity)
                                        <form class="" action="../shop/{{$item->id}}/addToCart" method="post">
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
                </div>
            @endif
            @endif
            @endif
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselFeatured" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselFeatured" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    {{-- <div class="col-md-3 col-xl-4"></div> --}}
</div>

{{-- <script>
    var carouselElement = document.getElementById('carouselElement');
    var heights = carouselElement.offsetHeight + 56 + (27.188 + 0.812);
    if (heights > window.innerHeight) {
        const aList = document.querySelectorAll('div.row > a.javascriptStyleThis');
        for (let i = 0; i < aList.length; i++) {
            aList[i].style.width = "33.33%";
        }
        const descList = document.querySelectorAll('div.row > div.javascriptStyleThis');
        for (let i = 0; i < descList.length; i++) {
            descList[i].style.width = "66.67%";
        }
    }
</script> --}}
@endsection
