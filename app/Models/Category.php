<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use phpDocumentor\Reflection\Types\True_;

/**
 * Class Category
 * @package App\Models
 * @property string name
 * @method static create(array $params)
 */
class Category extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name_es',
        'name_en',
        'outstanding_image',
        'icon',
        'status',
        'type',
        'slug',
    ];

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status == 'active';
    }

    /**
     * @return bool
     */

    public function isCategory(): bool
    {
        return $this->type == 'category';
    }

    /**
     * @return BelongsToMany
     */
    //Relación muchos a muchos
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

}
