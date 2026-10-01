<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WantedItem extends Model
{
    protected $table = 'wanted_items';

    protected $fillable = [
        'user_id',
        'title',
        'budget',
        'condition',
        'description',
        'location',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'budget' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}