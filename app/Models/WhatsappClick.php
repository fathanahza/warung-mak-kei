<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WhatsappClick extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'ip_address',
        'user_agent',
        'sumber',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
