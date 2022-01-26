<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [''];

     /**
     * @var string[]
     */
    protected $fillable = [
        'sku',
        'name',
        'image',
        'description',
        'price',
        'taxes',
        'category',
        'status',
        'stock',
        'slug',
    ];

    public function isActive(): bool
    {
        return $this->status == 'active';
    }

    //Relación muchos a muchos
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class );
    }

}
