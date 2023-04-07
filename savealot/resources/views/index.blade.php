@extends('layouts.base1b')

@section('title', 'Save-a-lot Home')
@section('activeHome', 'active')

@section('main')
<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-label="Slide 1" aria-current="true"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3" class=""></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="pics/carousel1.png" alt="carousel1" class="center">
        <div class="container">
          <div class="carousel-caption">
            <p><a class="btn btn-lg btn-success" href="/shop">Shop Now</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="pics/carousel2.png" alt="carousel2" class="center">
        <div class="container">
          <div class="carousel-caption text-end">
            <p><a class="btn btn-lg btn-light" href="/register">Register Now</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="pics/carousel3.png" alt="carousel3" class="center">
        <div class="container">
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
</div>

@endsection
