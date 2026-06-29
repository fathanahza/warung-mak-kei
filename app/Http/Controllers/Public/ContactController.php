<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ContactRequest;
use App\Models\ContactMessage;
use App\Models\WhatsappClick;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('public.contact.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:100',
            'email'    => 'required|email|max:100',
            'nomor_hp' => 'nullable|string|max:20',
            'pesan'    => 'required|string|min:10|max:2000',
        ]);

        ContactMessage::create([
            ...$validated,
            'ip_address' => $request->ip(),
        ]);

        return back()->with('success', 'Pesan Anda berhasil terkirim! Kami akan segera menghubungi Anda.');
    }

    public function trackWhatsapp(Request $request)
    {
        WhatsappClick::create([
            'product_id' => null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'sumber'     => $request->input('sumber', 'kontak'),
        ]);

        return response()->json(['success' => true]);
    }
}
