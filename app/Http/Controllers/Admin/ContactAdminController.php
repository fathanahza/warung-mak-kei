<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $messages = $query->paginate(20)->withQueryString();
        $counts   = [
            'semua'   => ContactMessage::count(),
            'baru'    => ContactMessage::where('status', 'baru')->count(),
            'dibaca'  => ContactMessage::where('status', 'dibaca')->count(),
            'dibalas' => ContactMessage::where('status', 'dibalas')->count(),
        ];

        return view('admin.contacts.index', compact('messages', 'counts'));
    }

    public function show(ContactMessage $contactMessage)
    {
        // Auto-mark as read
        if ($contactMessage->status === 'baru') {
            $contactMessage->update(['status' => 'dibaca']);
        }

        return view('admin.contacts.show', compact('contactMessage'));
    }

    public function updateStatus(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'status'         => 'required|in:baru,dibaca,dibalas',
            'catatan_admin'  => 'nullable|string|max:1000',
        ]);

        $contactMessage->update([
            'status'        => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        return back()->with('success', 'Status pesan diperbarui!');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Pesan berhasil dihapus!');
    }
}
