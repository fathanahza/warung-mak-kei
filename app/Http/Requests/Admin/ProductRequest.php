<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $productId = $this->route('product')?->id;

        return [
            'nama_produk'    => 'required|string|max:200',
            'category_id'    => 'required|exists:categories,id',
            'harga'          => 'required|numeric|min:0',
            'harga_diskon'   => 'nullable|numeric|min:0|lt:harga',
            'deskripsi'      => 'required|string|min:10',
            'berat'          => 'nullable|string|max:50',
            'isi_produk'     => 'nullable|string|max:100',
            'stok'           => 'required|integer|min:0',
            'gambar_utama'   => $productId ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048' : 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'galeri_gambar'  => 'nullable|array|max:10',
            'galeri_gambar.*'=> 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'link_tokopedia' => 'nullable|url|max:500',
            'link_shopee'    => 'nullable|url|max:500',
            'link_gofood'    => 'nullable|url|max:500',
            'is_featured'    => 'boolean',
            'is_best_seller' => 'boolean',
            'is_active'      => 'boolean',
            'meta_title'     => 'nullable|string|max:100',
            'meta_description'=> 'nullable|string|max:300',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_produk.required'   => 'Nama produk wajib diisi.',
            'category_id.required'   => 'Kategori wajib dipilih.',
            'category_id.exists'     => 'Kategori tidak ditemukan.',
            'harga.required'         => 'Harga wajib diisi.',
            'harga.numeric'          => 'Harga harus berupa angka.',
            'harga_diskon.lt'        => 'Harga diskon harus lebih kecil dari harga normal.',
            'deskripsi.required'     => 'Deskripsi produk wajib diisi.',
            'stok.required'          => 'Stok wajib diisi.',
            'gambar_utama.image'     => 'File gambar utama tidak valid.',
            'gambar_utama.max'       => 'Ukuran gambar utama maksimal 2MB.',
            'galeri_gambar.*.image'  => 'Semua file galeri harus berupa gambar.',
            'galeri_gambar.*.max'    => 'Ukuran setiap gambar galeri maksimal 2MB.',
            'link_tokopedia.url'     => 'Link Tokopedia tidak valid.',
            'link_shopee.url'        => 'Link Shopee tidak valid.',
            'link_gofood.url'        => 'Link GoFood tidak valid.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured'    => $this->boolean('is_featured'),
            'is_best_seller' => $this->boolean('is_best_seller'),
            'is_active'      => $this->boolean('is_active', true),
        ]);
    }
}
