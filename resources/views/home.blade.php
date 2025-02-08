@extends('layouts.web.main')

@section('title', 'Home')

@section('content')
    <section class="banner-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="banner-area__content">
                        <h2>Premium pengetahuan untuk pikiran premium</h2>
                        <p>Beli buku ilmiah secara eceran dan nikmati akses ke pengetahuan terbaru dan terlengkap pada berbagai bidang, tanpa perlu berlangganan.</p>
                        <a class="btn bg-primary" href="/all-products">Belanja Sekarang</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <div class="banner-area__img">
                        <img src="https://png.pngtree.com/thumb_back/fh260/background/20230521/pngtree-vintage-books-on-wooden-desk-with-a-picture-image_2700506.jpg"
                            alt="banner-img" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="row d-none">
                <div class="col-sm-12">
                    <div class="brand-area">
                        <div class="brand-area-image">
                            <img src="dist/images/brand/01.png" alt="Brand" class="img-fluid">
                        </div>
                        <div class="brand-area-image">
                            <img src="dist/images/brand/02.png" alt="Brand" class="img-fluid">
                        </div>
                        <div class="brand-area-image">
                            <img src="dist/images/brand/03.png" alt="Brand" class="img-fluid">
                        </div>
                        <div class="brand-area-image">
                            <img src="dist/images/brand/04.png" alt="Brand" class="img-fluid">
                        </div>
                        <div class="brand-area-image">
                            <img src="dist/images/brand/02.png" alt="Brand" class="img-fluid">
                        </div>
                        <div class="brand-area-image">
                            <img src="dist/images/brand/05.png" alt="Brand" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="features" id="product">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Produk</h2>
                    </div>
                </div>
            </div>
            <div class="features-wrapper">
                <div class="features-active">
                    @foreach ($products as $product)
                        <div class="product-item">
                            <div class="product-item-image">
                                <a href="{{ route('products-detail.show', $product->id) }}"><img
                                        src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="img-fluid w-100"></a>
                                <div class="cart-icon">
                                    {{-- <button class="addToCartBtn" data-product-id="{{ $product->id }}">
                                        <i class="bi bi-cart fw-bolder" style="position: relative; top: -3px;"></i>
                                    </button> --}}
                                    <a href="#" class="addToCartBtn" data-product-id="{{ $product->id }}">
                                        <i class="bi bi-cart fw-bolder" style="position: relative; top:-3px"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-item-info">
                                <a href="{{ route('products-detail.show', $product->id) }}">{{ $product->name }}</a>
                                <td>{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</td>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="slider-arrows">
                    <div class="prev-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="9.414" height="16.828" viewBox="0 0 9.414 16.828">
                            <path id="Icon_feather-chevron-left" data-name="Icon feather-chevron-left" d="M20.5,23l-7-7,7-7"
                                transform="translate(-12.5 -7.586)" fill="none" stroke="#1a2224" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </div>
                    <div class="next-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="9.414" height="16.828" viewBox="0 0 9.414 16.828">
                            <path id="Icon_feather-chevron-right" data-name="Icon feather-chevron-right"
                                d="M13.5,23l5.25-5.25.438-.437L20.5,16l-7-7" transform="translate(-12.086 -7.586)"
                                fill="none" stroke="#1a2224" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="features-morebutton text-center">
                        <a class="btn bt-glass" href="{{ route('all-products') }}">Lihat Semua Produk</a>
                    </div>
                </div>
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
                                    'Silahkan login terlebih dahulu.'
                                );
                            });
                    }
                });
            });
        });
    </script>
@endpush
