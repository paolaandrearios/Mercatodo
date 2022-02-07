<?php

namespace App\Repositories;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class CategoryRepository
{
    public function get(string $status = null): LengthAwarePaginator
    {
        if (is_null($status)) {
            return Cache::remember('categories_status', Carbon::now()->endOfDay(), function () use ($status) {
                return Category::orderBy('id', 'asc')->paginate(config('general.custom_records_per_page'));
            });
        }

        return Cache::remember('categories', Carbon::now()->endOfDay(), function () use ($status) {
            return Category::orderBy('id', 'asc')->where('status', $status)->paginate(config('general.custom_records_per_page'));
        });
    }
}
