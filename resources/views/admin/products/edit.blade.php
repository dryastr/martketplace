@extends('layouts.main')

@section('content')
    <div class="col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Produk</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data" class="form form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name">Nama Produk</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" id="name" class="form-control" name="name"
                                        value="{{ $product->name }}" placeholder="Nama Produk" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="description">Deskripsi</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <textarea id="description" class="form-control" name="description" placeholder="Deskripsi" required>{{ $product->description }}</textarea>
                                </div>

                                <div class="col-md-4">
                                    <label for="price">Harga</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="number" step="0.01" id="price" class="form-control" name="price"
                                        value="{{ $product->price }}" placeholder="Harga" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="stock">Stok</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="number" id="stock" class="form-control" name="stock"
                                        value="{{ $product->stock }}" placeholder="Stok" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="image">Gambar Produk</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="file" id="image" class="form-control" name="image">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                                            width="100" class="mt-2">
                                    @endif
                                </div>

                                <div class="col-sm-12 d-flex justify-content-end mt-5">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
