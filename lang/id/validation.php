<?php

return [
    'required' => ':attribute wajib diisi.',
    'email'    => ':attribute harus berupa alamat email yang valid.',
    'max'      => [
        'string' => ':attribute tidak boleh lebih dari :max karakter.',
        'file'   => ':attribute tidak boleh lebih dari :max kilobyte.',
    ],
    'min'      => [
        'string' => ':attribute minimal :min karakter.',
    ],
    'unique'   => ':attribute sudah digunakan.',
    'image'    => ':attribute harus berupa file gambar.',
    'mimes'    => ':attribute harus berformat: :values.',
    'numeric'  => ':attribute harus berupa angka.',
    'integer'  => ':attribute harus berupa bilangan bulat.',
    'url'      => ':attribute harus berupa URL yang valid.',
    'attributes' => [
        'email'    => 'Email',
        'password' => 'Password',
        'nama'     => 'Nama',
        'pesan'    => 'Pesan',
    ],
];
