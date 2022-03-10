<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'document_type',
        'document_number',
        'email',
        'phone',
        'address',
        'city',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Relationship one to many

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }
}