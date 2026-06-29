<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\VisitorLog;
use App\Models\WhatsappClick;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Daftar semua produk dengan filter & pagination.
     */
    public function index(Request $request)
    {
        // Log visitor
        VisitorLog::create([
            'ip_address' => $request->ip(),
            'halaman'    => '/products',
            'user_agent' => $request->userAgent(),
        ]);

        $query = Product::active()->with('category');

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->kategori));
        }

        // Filter best seller / featured / promo
        if ($request->filled('filter')) {
            match ($request->filter) {
                'terlaris'  => $query->where('is_best_seller', true),
                'unggulan'  => $query->where('is_featured', true),
                'promo'     => $query->whereNotNull('harga_diskon'),
                'stok'      => $query->where('stok', '>', 0),
                default     => null,
            };
        }

        // Search
        if ($request->filled('q')) {
            $query->search($request->q);
        }

        // Sort
        match ($request->sort) {
            'terbaru'      => $query->latest(),
            'termurah'     => $query->orderBy('harga'),
            'termahal'     => $query->orderByDesc('harga'),
            'terlaris'     => $query->orderByDesc('klik_whatsapp'),
            default        => $query->latest(),
        };

        $products   = $query->paginate(12)->withQueryString();
        $categories = Category::active()->get();

        // Produk terbaru dan terlaris untuk sidebar
        $produk_terbaru  = Product::active()->latest()->take(5)->get();
        $produk_terlaris = Product::bestSeller()->take(5)->get();

        return view('public.products.index', compact(
            'products', 'categories', 'produk_terbaru', 'produk_terlaris'
        ));
    }

    /**
     * Detail produk.
     */
    public function show(Request $request, string $slug)
    {
        $product = Product::active()
            ->where('slug', $slug)
            ->with(['category', 'images'])
            ->firstOrFail();

        // Increment views
        $product->increment('total_views');

        // Simpan ke recently viewed (session)
        $recentlyViewed = session()->get('recently_viewed', []);
        $recentlyViewed = array_filter($recentlyViewed, fn($id) => $id !== $product->id);
        array_unshift($recentlyViewed, $product->id);
        session()->put('recently_viewed', array_slice($recentlyViewed, 0, 10));

        // Log visitor
        VisitorLog::create([
            'ip_address' => $request->ip(),
            'halaman'    => "/products/{$slug}",
            'user_agent' => $request->userAgent(),
        ]);

        // Produk terkait (same category)
        $produk_terkait = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)->get();

        // Produk rekomendasi (featured)
        $produk_rekomendasi = Product::featured()
            ->where('id', '!=', $product->id)
            ->take(4)->get();

        // Produk terlaris
        $produk_terlaris = Product::bestSeller()
            ->where('id', '!=', $product->id)
            ->take(4)->get();

        // Wishlist check
        $wishlist  = session()->get('wishlist', []);
        $inWishlist = in_array($product->id, $wishlist);

        return view('public.products.show', compact(
            'product',
            'produk_terkait',
            'produk_rekomendasi',
            'produk_terlaris',
            'inWishlist'
        ));
    }

    /**
     * AJAX realtime search.
     */
    public function search(Request $request)
    {
        $request->validate(['q' => 'required|string|min:2|max:100']);

        $products = Product::active()
            ->search($request->q)
            ->with('category')
            ->take(8)
            ->get()
            ->map(fn($p) => [
                'id'             => $p->id,
                'nama_produk'    => $p->nama_produk,
                'slug'           => $p->slug,
                'harga_format'   => $p->harga_format,
                'gambar_url'     => $p->gambar_utama_url,
                'url'            => $p->url,
                'category_name'  => $p->category?->nama_kategori,
                'is_promo'       => $p->is_promo,
                'harga_diskon_format' => $p->harga_diskon_format,
            ]);

        return response()->json(['products' => $products]);
    }

    /**
     * Catat klik WhatsApp.
     */
    public function trackWhatsapp(Request $request, Product $product)
    {
        // Simpan ke whatsapp_clicks
        WhatsappClick::create([
            'product_id' => $product->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'sumber'     => 'produk',
        ]);

        // Increment counter di produk
        $product->increment('klik_whatsapp');

        return response()->json(['success' => true]);
    }
}
