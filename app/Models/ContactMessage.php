<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'nomor_hp',
        'pesan',
        'status',
        'catatan_admin',
        'ip_address',
    ];

    public function scopeNew($query)
    {
        return $query->where('status', 'baru');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'baru'    => '<span class="badge-new">Baru</span>',
            'dibaca'  => '<span class="badge-read">Dibaca</span>',
            'dibalas' => '<span class="badge-replied">Dibalas</span>',
            default   => $this->status,
        };
    }
}
