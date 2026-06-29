<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
        ]);

        Newsletter::updateOrCreate(
            ['email'     => $request->email],
            ['is_active' => true]
        );

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Terima kasih sudah berlangganan!']);
        }

        return back()->with('success', 'Terima kasih sudah berlangganan newsletter kami!');
    }
}
