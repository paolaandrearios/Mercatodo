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
        $categories = Category::all();
        return response()->json(compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
         $category = Category::create($request->all());
         $category->slug = Helper::slugCreate($category->name);
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
        $category = $category->update($request->all());

        if ($category->save()) {
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
