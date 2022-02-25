<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    /**
     * @var string[]
     */
    protected $fillable = [
        'sku',
        'name_en',
        'description_en',
        'name_es',
        'description_es',
        'price',
        'taxes',
        'status',
        'stock',
        'slug',
    ];

    protected $guarded = [''];

    public function isActive(): bool
    {
        return $this->status == 'active';
    }

    //Relación muchos a muchos
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    //Relationship one to many

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

}
