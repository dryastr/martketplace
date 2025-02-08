@extends('layouts.main')

@section('title', 'Kelola Pembayaran')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Total Pembelian per Pengguna per Produk</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="totalBillsTable" class="table table-xl">
                                <thead>
                                    <tr>
                                        <th>Nama Pengguna</th>
                                        <th>Email</th>
                                        {{-- <th>Nama Produk</th> --}}
                                        {{-- <th>Total Quantity</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($totalBills as $bill)
                                        <tr>
                                            <td>
                                                {{ $bill->user->name }}
                                            </td>
                                            <td>{{ $bill->user->email }}</td>
                                            {{-- <td>{{ $bill->product->name }}</td> --}}
                                            {{-- <td>{{ $bill->total_quantity }}</td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
