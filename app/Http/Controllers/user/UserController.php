<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role_id == 2 ) {
            Visitor::create([
                'user_id' => Auth::id(),
                'ip_address' => request()->ip(),
                'visit_time' => now(),
            ]);
        }

        $products = Product::all();

        return view('home', compact('products'));
    }

    public function showAllProducts()
    {
        $products = Product::all();
        return view('user.products.all-product', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('user.products.product-details', compact('product'));
    }

    public function showCart()
    {
        $user = Auth::user();
        $cart = Cart::with('cartItems.product')->where('user_id', $user->id)->firstOrFail();

        $jumlahItem = $cart->cartItems->sum('quantity');
        $totalHarga = $cart->cartItems->sum(function ($cartItem) {
            return $cartItem->quantity * $cartItem->product->price;
        });

        $biayaPengiriman = 50000;
        $pajak = $totalHarga * 0.1;

        $totalKeseluruhan = $totalHarga + $biayaPengiriman + $pajak;

        return view('user.carts.show', compact('cart', 'jumlahItem', 'totalHarga', 'biayaPengiriman', 'pajak', 'totalKeseluruhan'));
    }

    public function addToCartDetail(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);

        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()->route('products-detail.show', $product->id)->with('success_message', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($request->product_id);

        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang']);
    }

    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($id);
        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('cart.show')->with('success', 'Cart updated.');
    }

    public function removeFromCart($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.show')->with('success', 'Product removed from cart.');
    }

    public function clearCart()
    {
        $user = auth()->user();
        $cart = $user->cart;
        $cart->cartItems()->delete();

        return redirect()->route('cart.show')->with('success', 'Cart cleared.');
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();

        // Buat pesanan baru dengan mass assignment
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $request->total_keseluruhan,
            'status' => 'pending',
        ]);

        // Tambahkan item ke pesanan
        $cart = Cart::with('cartItems.product')->where('user_id', $user->id)->firstOrFail();
        foreach ($cart->cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
        }

        // Redirect ke halaman billing
        return redirect()->route('billing.show', $order->id);
    }

    public function showBilling(Order $order)
    {
        return view('user.billings.index', compact('order'));
    }

    public function processPayment(Request $request, Order $order)
    {
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('proof_of_payment')) {
            $imageName = time() . '.' . $request->proof_of_payment->extension();
            $request->proof_of_payment->move(public_path('proof_of_payments'), $imageName);

            $order->update([
                'status' => 'pending',
                'proof_of_payment' => $imageName,
            ]);
        }

        return redirect()->route('home')->with('success', 'Bukti transfer berhasil dikirim. Pesanan Anda sedang diproses.');
    }
}
