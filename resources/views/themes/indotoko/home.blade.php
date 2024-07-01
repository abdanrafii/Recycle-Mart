@extends('themes.indotoko.layouts.app')
@include('themes.indotoko.shared.slider')
@section('content')

<!-- Popular -->
<section class="popular">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-6">
        <h1>Popular</h1>
      </div>
      <div class="col-6 text-end">
        <a href="{{ route('products.index') }}" class="btn-first">View All</a>
      </div>
    </div>
    <div class="row mt-5">
      @foreach ($products as $product)
      <div class="col-lg-3 col-6">
        <div class="card card-body p-lg-4 p3">
          <a href="{{ shop_product_link($product) }}"><img src=" @if($product->images->count() > 0) {{ asset('img/' . $product->images[0]->image) }} @else https://placehold.co/600x800 @endif" data-src=" https://placehold.co/600x800" alt="" class="img-fluid"></a>
          <h3 class="product-name mt-3">{{ $product->name }}</h3>
          <div class="detail d-flex justify-content-between align-items-center mt-4">
              <p class="price">IDR {{ $product->price }}</p>
              <a href="#" class="btn-cart"><i class="bx bx-cart-alt"></i></a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Latest -->
<section class="latest">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-6">
        <h1>Latest</h1>
      </div>
      <div class="col-6 text-end">
        <a href="{{ route('products.index') }}" class="btn-first">View All</a>
      </div>
    </div>
    <div class="row mt-5">
      @foreach ($popularProducts as $product)
      <div class="col-lg-3 col-6">
        <div class="card card-body p-lg-4 p3">
          <a href="{{ shop_product_link($product) }}"><img src=" @if($product->images->count() > 0) {{ asset('img/' . $product->images[0]->image) }} @else https://placehold.co/600x800 @endif" alt="" class="img-fluid"></a>
          <h3 class="product-name mt-3">{{ $product->name }}</h3>
          <div class="detail d-flex justify-content-between align-items-center mt-4">
              <p class="price">IDR {{ $product->price }}</p>
              <a href="#" class="btn-cart"><i class="bx bx-cart-alt"></i></a>
          </div>
        </div>
      </div>
      @endforeach
      
    </div>
  </div>
</section>


@endsection
