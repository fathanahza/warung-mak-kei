<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\VisitorLog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Log visitor
        VisitorLog::create([
            'ip_address' => $request->ip(),
            'halaman'    => '/',
            'user_agent' => $request->userAgent(),
            'referrer'   => $request->headers->get('referer'),
        ]);

        $data = [
            'banners'          => Banner::active()->get(),
            'produk_unggulan'  => Product::featured()->with('category')->take(8)->get(),
            'produk_terlaris'  => Product::bestSeller()->with('category')->take(8)->get(),
            'produk_terbaru'   => Product::active()->with('category')->latest()->take(8)->get(),
            'produk_promo'     => Product::promo()->with('category')->take(4)->get(),
            'categories'       => Category::active()->withCount(['products' => fn($q) => $q->where('is_active', true)])->get(),
            'testimonials'     => Testimonial::active()->take(6)->get(),
            'faqs'             => Faq::active()->take(6)->get(),
        ];

        return view('public.home.index', $data);
    }
}
