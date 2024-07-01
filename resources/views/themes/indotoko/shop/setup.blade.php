@extends('themes.indotoko.layouts.app')

@section('content')
<section class="main-content">
    <div class="container">
        <div class="row">
            <aside class="col-lg-3 col-md-4 mb-6 mb-md-0">
                @include('themes.indotoko.products.sidebar', ['categories' => $categories])
            </aside>
            <section class="col-lg-9 col-md-12 products">
                <div class="card mb-4 bg-light border-0 section-header">
                    <div class="card-body p-5">
                        <h2 class="mb-0">Accessories</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="d-lg-flex justify-content-between align-items-center">
                        <div class="mb-3 mb-lg-0">
                            &nbsp;
                        </div>
                        <div class="d-flex mt-2 mt-lg-0">
                            <div class="me-2 flex-grow-1">
                                &nbsp;
                            </div>
                            <div>
                               {!! html()->select('sorting', $sortingOptions, $sortingQuery)->class(['form-select'])->attribute('onchange', 'this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse ($products as $product)
                        @include('themes.indotoko.products.product_box', ['product' => $product])
                    @empty
                        <p>Product empty</p>
                    @endforelse
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        {!! $products->links() !!}
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection