<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageService
{
    /**
     * Upload gambar ke storage publik.
     */
    public function upload(
        UploadedFile $file,
        string $folder = 'uploads',
        int $maxWidth = 1200
    ): string {
        // Generate nama file unik
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path     = $folder . '/' . $filename;

        // Simpan ke storage publik
        $file->storeAs($folder, $filename, 'public');

        return $path;
    }

    /**
     * Hapus gambar dari storage.
     */
    public function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Upload banyak gambar.
     *
     * @return string[] array of paths
     */
    public function uploadMany(array $files, string $folder = 'uploads'): array
    {
        $paths = [];
        foreach ($files as $file) {
            if ($file instanceof UploadedFile && $file->isValid()) {
                $paths[] = $this->upload($file, $folder);
            }
        }
        return $paths;
    }
}
