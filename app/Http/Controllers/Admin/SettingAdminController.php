<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingAdminController extends Controller
{
    public function __construct(private readonly ImageService $imageService) {}

    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('id')->get()->groupBy('group');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if (!$setting) continue;

            // Handle upload gambar
            if ($setting->tipe === 'image' && $request->hasFile($key)) {
                $file = $request->file($key);
                if ($file->isValid()) {
                    // Hapus gambar lama
                    if ($setting->value) {
                        $this->imageService->delete($setting->value);
                    }
                    $value = $this->imageService->upload($file, 'settings');
                } else {
                    continue;
                }
            }

            Setting::set($key, $value);
        }

        // Clear semua cache settings
        Cache::flush();

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
