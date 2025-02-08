@extends('layouts.web.main')

@section('title', 'Detail Produk')

@section('content')

    <section class="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-5 col-12">
                    <div class="product-slider">
                        <div class="exzoom" id="exzoom">
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                    <li><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-7 col-12">
                    <div class="d-flex align-items-center h-100">
                        <div class="product-pricelist" style="margin-bottom: 5rem">
                            <h2>{{ $product->name }}</h2>
                            <div class="product-pricelist-ratting">
                                <div class="price">
                                    <span>{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <p class="text-break">{{ $product->description }}</p>
                            <form action="{{ route('cart.add-detail') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="product-pricelist-selector">
                                    <div class="product-pricelist-selector-quantity">
                                        <h6>Quantity</h6>
                                        <div class="wan-spinner wan-spinner-4">
                                            <a href="javascript:void(0)" class="minus">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="11.98" height="6.69"
                                                    viewBox="0 0 11.98 6.69">
                                                    <path id="Arrow" d="M1474.286,26.4l5,5,5-5"
                                                        transform="translate(-1473.296 -25.41)" fill="none"
                                                        stroke="#989ba7" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.4" />
                                                </svg>
                                            </a>
                                            <input type="number" id="quantityInput" name="quantity" value="1"
                                                min="1">
                                            <a href="javascript:void(0)" class="plus">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="11.98" height="6.69"
                                                    viewBox="0 0 11.98 6.69">
                                                    <g id="Arrow" transform="translate(10.99 5.7) rotate(180)">
                                                        <path id="Arrow-2" data-name="Arrow" d="M1474.286,26.4l5,5,5-5"
                                                            transform="translate(-1474.286 -26.4)" fill="none"
                                                            stroke="#1a2224" stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.4" />
                                                    </g>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-pricelist-selector-button">
                                    <button type="submit" class="btn cart-bg">
                                        Add to cart
                                        <i class="bi bi-cart" style="font-size: 20px"></i>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection


@push('footer-scripts')
    <script src="{{ asset('dist/src/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/src/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/src/scss/vendors/plugin/js/slick.min.js') }}"></script>
    <script src="{{ asset('dist/src/scss/vendors/plugin/js/jquery.exzoom.js') }}"></script>
    <script src="{{ asset('dist/src/scss/vendors/plugin/js/jquery.nice-select.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantityInput');
            const minusButton = document.querySelector('.wan-spinner .minus');
            const plusButton = document.querySelector('.wan-spinner .plus');

            minusButton.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });

            plusButton.addEventListener('click', function() {
                let currentValue = parseInt(quantityInput.value);
                quantityInput.value = currentValue + 1;
            });
        });
    </script>
@endpush
