<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\ImageService;
use Illuminate\Http\Request;

class TestimonialAdminController extends Controller
{
    public function __construct(private readonly ImageService $imageService) {}

    public function index()
    {
        $testimonials = Testimonial::orderBy('urutan')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:100',
            'asal'          => 'nullable|string|max:100',
            'isi_testimoni' => 'required|string|min:10|max:1000',
            'rating'        => 'required|integer|min:1|max:5',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'urutan'        => 'required|integer|min:0',
            'is_active'     => 'boolean',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $this->imageService->upload($request->file('foto'), 'testimonials');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil ditambahkan!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:100',
            'asal'          => 'nullable|string|max:100',
            'isi_testimoni' => 'required|string|min:10|max:1000',
            'rating'        => 'required|integer|min:1|max:5',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
            'urutan'        => 'required|integer|min:0',
            'is_active'     => 'boolean',
        ]);

        if ($request->hasFile('foto')) {
            $this->imageService->delete($testimonial->foto);
            $validated['foto'] = $this->imageService->upload($request->file('foto'), 'testimonials');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil diperbarui!');
    }

    public function destroy(Testimonial $testimonial)
    {
        $this->imageService->delete($testimonial->foto);
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus!');
    }
}
