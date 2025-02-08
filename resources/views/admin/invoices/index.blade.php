@extends('layouts.main')

@section('title', 'Kelola Pembayaran')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Pembayaran Menunggu Konfirmasi</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="pendingPaymentsTable" class="table table-xl">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Jumlah Total</th>
                                        <th>Status</th>
                                        <th>Detail Pesanan</th>
                                        <th>Detail Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendingOrders as $order)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ 'Rp. ' . number_format($order->total, 0, ',', '.') }}</td>
                                            <td>{{ $order->status }}</td>
                                            <td>
                                                ID Pesanan: {{ $order->id }} <br>
                                                Pelanggan: {{ $order->user->name }} <br>
                                                Dibuat pada: {{ $order->created_at }}
                                            </td>
                                            @if ($order->proof_of_payment)
                                                <td>
                                                    <img src="{{ asset('proof_of_payments/' . $order->proof_of_payment) }}"
                                                        alt="Bukti Pembayaran" class="img-fluid" width="70">
                                                </td>
                                            @else
                                                <td>
                                                    <p>Belum ada bukti pembayaran diunggah.</p>
                                                </td>
                                            @endif
                                            <td class="text-nowrap">
                                                <div class="dropdown dropup">
                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                        id="dropdownMenuButton-{{ $order->id }}"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu"
                                                        aria-labelledby="dropdownMenuButton-{{ $order->id }}">
                                                        @if ($order->status === 'pending')
                                                            <li>
                                                                <form
                                                                    action="{{ route('admin.confirmPayment', $order->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Anda yakin ingin mengonfirmasi pembayaran?')">Konfirmasi
                                                                        Pembayaran</button>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <form
                                                                    action="{{ route('admin.rejectPayment', $order->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Anda yakin ingin menolak pembayaran?')">Tolak
                                                                        Pembayaran</button>
                                                                </form>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <p class="dropdown-item">Sudah Dikonfirmasi</p>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </td>

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
