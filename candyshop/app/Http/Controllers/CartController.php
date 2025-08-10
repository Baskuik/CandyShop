<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Product toevoegen aan cart
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        // Simpel product, zonder database:
        $productId = 1;
        $productName = 'Snoepje';
        $productPrice = 2.50;

        if(isset($cart[$productId])) {
            $cart[$productId]['aantal']++;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'naam' => $productName,
                'prijs' => $productPrice,
                'aantal' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.show')->with('success', 'Product toegevoegd!');
    }

    // Cart pagina tonen
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // Hoeveelheid updaten
    public function updateQuantity(Request $request, $id)
    {
        $action = $request->input('action');
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($action === 'increment') {
                $cart[$id]['aantal']++;
            } elseif ($action === 'decrement') {
                if ($cart[$id]['aantal'] > 1) {
                    $cart[$id]['aantal']--;
                } else {
                    unset($cart[$id]);
                }
            }
            session()->put('cart', $cart);
            return response()->json([
                'success' => true,
                'aantal' => $cart[$id]['aantal'] ?? 0
            ]);
        }
        return response()->json(['success' => false], 404);
    }

    // Item verwijderen (optioneel)
    public function removeItem($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}
