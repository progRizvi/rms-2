<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        return view('frontend.pages.cart');
    }
    public function addToCart(Request $request)
    {
        $id = $request->food_id;
        $food = Food::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $food->name,
                "quantity" => $request->quantity,
                "price" => $food->price,
                "image" => $food->image,
            ];
        }

        session()->put('cart', $cart);
        return response()->json(['success' => true, "message" => "food added to cart successfully"]);

    }
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return response()->json(['success' => true, "message" => "food updated successfully"]);
        }
    }
    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'food removed successfully');
        }
    }
    public function checkout()
    {
        return view('frontend.pages.checkout');
    }
}
