<?php


namespace App\Repositories;


use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository
{
    public function get(string $status = null): LengthAwarePaginator
    {
        if(is_null($status)){
            return Category::orderBy('id', 'asc')->paginate(config('general.custom_records_per_page'));
        }
        return Category::orderBy('id', 'asc')->where('status', $status)->paginate(config('general.custom_records_per_page'));
    }
}
