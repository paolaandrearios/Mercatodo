<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class CategoryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = Category::orderBy('id', 'asc')->paginate();
        return response()->json(compact('categories'));
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->all();
        $data['slug'] =  Helper::generateSlug($data['name']);
        $category = Category::create($data);
        return response()->json(compact('category'));
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return Response
     */
    public function show(Category $category): Response
    {
        return response()->json(compact('category'));
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return JsonResponse
     */

    public function update(Request $request, Category $category): JsonResponse
    {
        if ($category->update($request->all())) {
            return response()->json([
                'message' => __('general.api.category.update_status_success'),
            ]);
        } else {
            return response()->json([
                'message' => __('general.api.category.update_status_error'),
            ]);
        }
    }

    public function updateStatus(StatusUserRequest $statusUserRequest): JsonResponse
    {
        $user = User::query()->where('id', $statusUserRequest->id)->firstOrFail();
        $user->status = $statusUserRequest->status;
        if ($user->save()) {
            return response()->json([
                'message' => __('general.api.user.update_status_success'),
            ]);
        } else {
            return response()->json([
                'message' => __('general.api.user.update_status_error'),
            ]);
        }
    }
}
