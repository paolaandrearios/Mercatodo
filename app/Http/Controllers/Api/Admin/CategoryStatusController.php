<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StatusCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class CategoryStatusController extends Controller
{
    public function update(StatusCategoryRequest $request, Category $category, string $status): JsonResponse
    {
        $data = [
            'status' => $status,
        ];

        if ($category->update($data)) {
            Cache::forget('categories');
            Cache::forget('categories_status');

            return response()->json([
                'message' => __('general.api.category.update_status_success'),
            ]);
        } else {
            return response()->json([
                'message' => __('general.api.category.update_status_error'),
            ]);
        }
    }
}
