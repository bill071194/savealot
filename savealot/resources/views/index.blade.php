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

<div class="container marketing">

    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <br>
        <h2 class="featurette-heading fw-bold lh-1 text-success">Fresh meets affordable. <span class="text-body-secondary">It all starts here.</span></h2>
        <p class="lead">Save-a-lot is an online exclusive grocery shopping experience with freshness and affordability in mind. We strive to 
        provide amazing produce curated from only local farmers and manufacturers. All products are guaranteed to satisfy your cravings while maintaining 
        health and wellness.</p>
      </div>
      <div class="col-md-5">
        <img class="featurette" src="pics/featurette1.png">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <br>
        <h2 class="featurette-heading fw-bold lh-1 text-success">Student-friendly. <span class="text-body-secondary">We understand.</span></h2>
        <p class="lead">Students with verified accounts get an automatic <strong>10% discount</strong> of their total order. The discount is effective indefinitely.
        Save-a-lot strives to assist the future generation of leaders and citizens. Stop worrying about putting food on the table and get those As!</p>
      </div>
      <div class="col-md-5 order-md-1">
        <img class="featurette" src="pics/featurette2.png">
      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div>

@endsection
