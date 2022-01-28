<?php

namespace App\Rules\Api\Admin;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class NameCategoryRule implements Rule
{
    private $category;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $count = Category::where($attribute, $value)
            ->where('id', '!=', $this->category->id)
            ->count();
        if($count === 0){
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('general.api.category.name_category_rule_message');
    }
}
