@extends('themes.indotoko.layouts.app')

@section('content')
<section class="breadcrumb-section pb-4 pb-md-4 pt-4 pt-md-4">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('products') }} ">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
</section>
<section class="main-content">
    <div class="container">
        <form method="post" action="{{ route('products.store') }}">
          @csrf
          <div class="card mt-5">
            <div class="card-header">
              <h3>New Product</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <div class="alert-title"><h4>Whoops!</h4></div>
                      There are some problems with your input.
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                  </div> 
                @endif

                @if (session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="mb-3">
                  <label class="form-label">SKU</label>
                  <input type="text" class="form-control" name="sku" value="{{ old('sku') }}" placeholder="#SKU">
                </div>
                <div class="mb-3">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control" name="name" value="{{ old('name') }}"  placeholder="Name">
                </div>
                <div class="mb-3">
                  <label class="form-label">Price</label>
                  <input type="text" class="form-control" name="price" value="{{ old('price') }}"  placeholder="Price">
                </div>
                <div class="mb-3">
                  <label class="form-label">Stock</label>
                  <input type="text" class="form-control" name="stock" value="{{ old('stock') }}"  placeholder="Stock">
                </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-primary" type="submit">Create</button>
            </div>
          </div>
        </form>
      </div>
</section>
@endsection