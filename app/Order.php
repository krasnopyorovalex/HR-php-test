<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * @return HasMany
     */
    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route('orders.edit', $this->id);
    }
}
