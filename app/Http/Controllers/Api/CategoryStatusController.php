<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryStatusController extends Controller
{
    public function update(Category $category, string $status): JsonResponse
    {
        $data = [
            'status' => $status
        ];

        if ($category->update($data)) {
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
