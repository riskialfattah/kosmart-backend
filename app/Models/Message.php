<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected $table = 'messages';

    const UPDATED_AT = null;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'product_id',
        'message',
    ];

    /**
     * User yang mengirim pesan.
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * User yang menerima pesan.
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Produk yang terkait dengan pesan.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}