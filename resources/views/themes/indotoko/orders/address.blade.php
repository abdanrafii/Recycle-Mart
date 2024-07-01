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
        <form method="post" action="{{ route('orders.address') }}" enctype="multipart/form-data">
          @csrf
          <div class="card">
            <div class="card-header">
              <h3 class="mt-2">Tambah Alamat</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label">Label Alamat</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="label" value="{{ old('name') }}" placeholder="Label Toko" required>
                  @error('label')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label class="form-label">Nama Penerima</label>
                  <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}"  placeholder="Nama" required>
                  @error('first_name')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label class="form-label">Alamat</label>
                  <input type="text" class="form-control" name="address1" value="{{ old('address1') }}"  placeholder="Nama" required>
                  @error('address1')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label class="form-label">No HP</label>
                  <input type="number" class="form-control" name="phone" value="{{ old('phone') }}"  placeholder="Nama" required>
                  @error('phone')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label class="form-label">Kode Kota</label>
                  <input type="number" class="form-control" name="city" value="{{ old('city') }}"  placeholder="Nama" required>
                  @error('city')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label class="form-label">Kode Provinsi</label>
                  <input type="number" class="form-control" name="province" value="{{ old('province') }}"  placeholder="Nama" required>
                  @error('province')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label class="form-label">Kode Pos</label>
                  <input type="number" class="form-control" name="postcode" value="{{ old('postcode') }}"  placeholder="Nama" required>
                  @error('postcode')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-primary my-2" type="submit">Tambah Alamat</button>
            </div>
          </div>
        </form>
      </div>
</section>
@endsection