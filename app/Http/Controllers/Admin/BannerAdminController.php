<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Services\ImageService;
use Illuminate\Http\Request;

class BannerAdminController extends Controller
{
    public function __construct(private readonly ImageService $imageService) {}

    public function index()
    {
        $banners = Banner::orderBy('urutan')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'       => 'required|string|max:200',
            'deskripsi'   => 'nullable|string|max:500',
            'gambar'      => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
            'link'        => 'nullable|url|max:500',
            'teks_tombol' => 'nullable|string|max:50',
            'urutan'      => 'required|integer|min:0',
            'is_active'   => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $this->imageService->upload($request->file('gambar'), 'banners');
        }

        Banner::create($validated);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner berhasil ditambahkan!');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'judul'       => 'required|string|max:200',
            'deskripsi'   => 'nullable|string|max:500',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'link'        => 'nullable|url|max:500',
            'teks_tombol' => 'nullable|string|max:50',
            'urutan'      => 'required|integer|min:0',
            'is_active'   => 'boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $this->imageService->delete($banner->gambar);
            $validated['gambar'] = $this->imageService->upload($request->file('gambar'), 'banners');
        }

        $banner->update($validated);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner berhasil diperbarui!');
    }

    public function destroy(Banner $banner)
    {
        $this->imageService->delete($banner->gambar);
        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner berhasil dihapus!');
    }

    public function toggle(Banner $banner)
    {
        $banner->update(['is_active' => !$banner->is_active]);
        $status = $banner->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Banner berhasil {$status}!");
    }
}
