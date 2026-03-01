<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $total = array_reduce($cart, function($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return view('cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Produk ditambahkan ke keranjang!',
            'cartCount' => collect($cart)->sum('quantity')
        ]);
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = Session::get('cart');
            if (isset($cart[$request->id])) {
                $cart[$request->id]['quantity'] = $request->quantity;
                Session::put('cart', $cart);
            }
            return response()->json([
                'success' => true,
                'cartCount' => collect($cart)->sum('quantity')
            ]);
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = Session::get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                Session::put('cart', $cart);
            }
            return response()->json([
                'success' => true,
                'cartCount' => collect($cart)->sum('quantity')
            ]);
        }
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $cart = Session::get('cart', []);
        
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang belanja Anda kosong!');
        }

        $total = 0;
        $orderItems = "";
        
        foreach ($cart as $id => $details) {
            $subtotal = $details['price'] * $details['quantity'];
            $total += $subtotal;
            $orderItems .= "- {$details['name']} ({$details['quantity']} x Rp " . number_format($details['price'], 0, ',', '.') . ") = Rp " . number_format($subtotal, 0, ',', '.') . PHP_EOL;
        }

        $message = "Halo Jamu Hj. Nis, saya ingin memesan:" . PHP_EOL . PHP_EOL;
        $message .= "Data Pemesan:" . PHP_EOL;
        $message .= "Nama: " . $request->name . PHP_EOL;
        $message .= "No. HP: " . $request->phone . PHP_EOL;
        $message .= "Alamat: " . $request->address . PHP_EOL . PHP_EOL;
        $message .= "Pesanan Saya:" . PHP_EOL;
        $message .= $orderItems . PHP_EOL;
        $message .= "Total Bayar: *Rp " . number_format($total, 0, ',', '.') . "*" . PHP_EOL . PHP_EOL;
        $message .= "Mohon informasi untuk pembayaran dan pengiriman. Terima kasih.";

        Session::forget('cart');

        $whatsappNumber = "+6281332875057"; // Format with plus to ensure rawurlencode handles it cleanly though API is without plus
        $whatsappUrl = "https://api.whatsapp.com/send?phone=6281332875057&text=" . rawurlencode($message);

        return redirect()->away($whatsappUrl);
    }
}
