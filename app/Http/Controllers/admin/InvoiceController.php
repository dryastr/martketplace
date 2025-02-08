<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendingOrders = Order::where('status', 'pending')
            ->with('user')
            ->get();

        // dd($pendingOrders);
        return view('admin.invoices.index', compact('pendingOrders'));
    }

    public function confirmPayment(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update(['status' => 'processed']);
        $cart = Cart::where('user_id', $order->user_id)->first();
        if ($cart) {
            $cart->cartItems()->delete();
        }

        return redirect()->route('invoices.index')->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    // Metode untuk menolak pembayaran
    public function rejectPayment(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->update(['status' => 'cancelled']);

        return redirect()->route('invoices.index')->with('success', 'Pembayaran ditolak.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        // Validate and update invoice status
        $invoice->status = 'paid'; // Or your appropriate status
        $invoice->save();

        return redirect()->route('admin.invoices.index')->with('success', 'Payment confirmed successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
