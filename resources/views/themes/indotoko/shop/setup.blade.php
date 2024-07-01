@extends('themes.indotoko.layouts.app')

@section('content')
<section class="breadcrumb-section pb-4 pb-md-4 pt-4 pt-md-4">
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Shop</li>
            </ol>
        </nav>
    </div>
</section>
<section class="main-content">
    <div class="container">
        <form method="post" action="{{ route('shop.setup') }}" enctype="multipart/form-data">
          @csrf
          <div class="card">
            <div class="card-header">
              <h3>Setup Toko</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label">Nama Toko</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nama Toko" required>
                  @error('name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label class="form-label">Deskripsi</label>
                  <input type="text" class="form-control" name="body" value="{{ old('body') }}"  placeholder="Deskripsi" required>
                  @error('body')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Toko</label>
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    <input class="form-control @error('featured_image') is-invalid @enderror" type="file" id="image" name="featured_image" onchange="previewImage()" required>
                    @error('featured_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-primary my-2" type="submit">Setup Toko</button>
            </div>
          </div>
        </form>
      </div>
</section>

<script>
    function previewImage() {
      const image = document.querySelector("#image");
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);

      oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
      }
    }
</script>
@endsection