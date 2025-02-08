@extends('layouts.web.main')

@section('title', 'Daftar Keranjang')

@section('content')
    <section class="cart-area">
        <div class="container">
            <div class="rows">
                <div class="cart-items">
                    <div class="header">
                        <div class="image">
                            Gambar
                        </div>
                        <div class="name">
                            Nama
                        </div>
                        <div class="price">
                            Harga
                        </div>
                        <div class="info">
                            Info
                        </div>
                    </div>
                    <div class="body">
                        @foreach ($cart->cartItems as $cartItem)
                            <div class="item">
                                <div class="image">
                                    <img src="{{ asset('storage/' . $cartItem->product->image) }}"
                                        alt="{{ $cartItem->product->name }}">
                                </div>
                                <div class="name">
                                    <div class="name-text">
                                        <p>{{ $cartItem->product->name }}</p>
                                        <span
                                            class="text-break mt-3">{{ Str::limit($cartItem->product->description, 125) }}</span>
                                    </div>
                                </div>
                                <div class="info">
                                    <div class="quantity">
                                        <div class="product-pricelist-selector-quantity">
                                            <h6>Jumlah</h6>
                                            <div class="wan-spinner wan-spinner-4">
                                                <input type="text" value="{{ $cartItem->quantity }}" min="1"
                                                    >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-price">
                        <h6>Ringkasan Belanja</h6>
                        <div class="card-price-list d-flex justify-content-between align-items-center">
                            <div class="item">
                                <p>Total: {{ $jumlahItem }} item</p>
                            </div>
                            <div class="price">
                                <p>Rp {{ number_format($totalHarga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="card-price-list d-flex justify-content-between align-items-center">
                            <div class="item">
                                <p>Biaya Pengiriman</p>
                            </div>
                            <div class="price">
                                <p>Rp {{ number_format($biayaPengiriman, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="card-price-list d-flex justify-content-between align-items-center">
                            <div class="item">
                                <p>Pajak</p>
                            </div>
                            <div class="price">
                                <p>Rp {{ number_format($pajak, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="card-price-subtotal d-flex justify-content-between align-items-center">
                            <div class="total-text">
                                <p>Total Harga</p>
                            </div>
                            <div class="total-price">
                                <p>Rp {{ number_format($totalKeseluruhan, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <form action="{{ route('checkout') }}" method="POST" class="d-none">
                            @csrf
                            <input type="hidden" name="jumlah_item" value="{{ $jumlahItem }}">
                            <input type="hidden" name="total_harga" value="{{ $totalHarga }}">
                            <input type="hidden" name="biaya_pengiriman" value="{{ $biayaPengiriman }}">
                            <input type="hidden" name="pajak" value="{{ $pajak }}">
                            <input type="hidden" name="total_keseluruhan" value="{{ $totalKeseluruhan }}">
                            <button class="btn bg-primary" type="submit" style="width: 30%;"
                                @if ($jumlahItem === 0) disabled @endif>
                                Belanja Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
