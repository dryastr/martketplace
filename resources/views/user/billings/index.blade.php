@extends('layouts.web.main')

@section('title', 'Informasi Pembayaran')

@section('content')
    <!-- Billing Info Area Start -->
    <section class="billing-info-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 order-2 order-lg-1">
                    <div class="deliver-info-form">
                        <h6>Informasi Pembayaran</h6>
                        <form action="{{ route('payment.process', $order->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form__div">
                                        <input type="file" name="proof_of_payment" class="form__input" required>
                                        <label for="proof_of_payment" class="form__label">Unggah Bukti Transfer</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex align-items-center justify-content-between bottom flex-wrap">
                                    <a href="{{ route('cart.show') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-chevron-left">
                                            <polyline points="15 18 9 12 15 6"></polyline>
                                        </svg>
                                        Kembali ke Keranjang
                                    </a>
                                    <button class="btn bg-primary mt-0" type="submit">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2">
                    <div class="card-price">
                        <h6>Ringkasan Pembayaran</h6>
                        <div class="card-price-list d-flex justify-content-between align-items-center">
                            <div class="item">
                                <p>Total: {{ $order->orderItems->sum('quantity') }} item</p>
                            </div>
                            <div class="price">
                                <p>Rp
                                    {{ number_format($order->orderItems->sum(fn($item) => $item->price * $item->quantity), 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        <div class="card-price-list d-flex justify-content-between align-items-center">
                            <div class="item">
                                <p>Biaya Pengiriman</p>
                            </div>
                            <div class="price">
                                <p>Rp 50.000</p>
                            </div>
                        </div>
                        <div class="card-price-list d-flex justify-content-between align-items-center">
                            <div class="item">
                                <p>Pajak</p>
                            </div>
                            <div class="price">
                                <p>Rp {{ number_format($order->total * 0.1, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="card-price-subtotal d-flex justify-content-between align-items-center">
                            <div class="total-text">
                                <p>Total Harga</p>
                            </div>
                            <div class="total-price">
                                <p>Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Billing Info Area End -->
@endsection
