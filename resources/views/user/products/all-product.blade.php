@extends('layouts.web.main')

@section('title', 'Semua Produk')

@section('content')
    <section class="populerproduct">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Daftar Produk</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4 col-sm-6">
                        <div class="product-item">
                            <div class="product-item-image">
                                <a href="{{ route('products-detail.show', $product->id) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="img-fluid">
                                </a>
                                <div class="cart-icon">
                                    <a href="#" class="addToCartBtn" data-product-id="{{ $product->id }}">
                                        <i class="bi bi-cart fw-bolder" style="position: relative; top:-3px"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-item-info">
                                <a href="{{ route('products-detail.show', $product->id) }}">{{ $product->name }}</a>
                                <span>Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                @if ($product->discount)
                                    <del>Rp {{ number_format($product->original_price, 0, ',', '.') }}</del>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('footer-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var addToCartBtns = document.querySelectorAll('.addToCartBtn');
            addToCartBtns.forEach(function(btn) {
                btn.addEventListener('click', function(event) {
                    event.preventDefault(); // Mencegah aksi default
                    var productId = this.getAttribute('data-product-id');
                    if (productId) {
                        fetch("{{ route('cart.add') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({
                                    product_id: productId
                                })
                            })
                            .then(response => {
                                if (response.ok) {
                                    return response.json().then(data => {
                                        alert(data.message ||
                                            'Produk berhasil ditambahkan ke keranjang!'
                                        );
                                    });
                                } else {
                                    return response.json().then(data => {
                                        throw new Error(data.message ||
                                            'Gagal menambahkan produk ke keranjang');
                                    });
                                }
                            })
                            .catch(error => {
                                console.error(error);
                                alert(
                                    'Terjadi kesalahan saat menambahkan produk ke keranjang.'
                                );
                            });
                    }
                });
            });
        });
    </script>
@endpush
