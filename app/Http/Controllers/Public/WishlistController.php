<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistIds = session()->get('wishlist', []);
        $products    = Product::active()
            ->whereIn('id', $wishlistIds)
            ->with('category')
            ->get();

        return view('public.products.wishlist', compact('products'));
    }

    public function toggle(Request $request, Product $product)
    {
        $wishlist = session()->get('wishlist', []);

        if (in_array($product->id, $wishlist)) {
            $wishlist = array_filter($wishlist, fn($id) => $id !== $product->id);
            $action   = 'removed';
        } else {
            $wishlist[] = $product->id;
            $action     = 'added';
        }

        session()->put('wishlist', array_values($wishlist));

        return response()->json([
            'action' => $action,
            'count'  => count($wishlist),
        ]);
    }

    public function remove(Request $request, Product $product)
    {
        $wishlist = session()->get('wishlist', []);
        $wishlist = array_filter($wishlist, fn($id) => $id !== $product->id);
        session()->put('wishlist', array_values($wishlist));

        return back()->with('success', 'Produk dihapus dari favorit.');
    }
}
