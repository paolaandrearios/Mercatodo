<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'name',
        'description',
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

}
