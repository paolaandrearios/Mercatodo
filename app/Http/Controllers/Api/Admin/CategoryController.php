<?php

namespace App\Http\Controllers\Api\Admin;

use App\Actions\Category\StoreCategoryAction;
use App\Actions\Category\UpdateCategoryAction;
use App\Http\Requests\Api\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use App\Http\Controllers\Controller;

use App\Http\Requests\Api\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;


class CategoryController extends Controller
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(): JsonResponse
    {
        return response()->json(['categories' => $this->categoryRepository->get()]);
    }


    public function store(CreateCategoryRequest $request, StoreCategoryAction $storeCategoryAction): JsonResponse
    {
        return response()->json([
            'category' => $storeCategoryAction->execute($request),
            'message' => __('general.api.category.create_status_success'),
        ]);
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json(compact('category'));
    }



    public function update(UpdateCategoryRequest $request, Category $category, UpdateCategoryAction $updateCategoryAction): JsonResponse
    {
        if ($updateCategoryAction->execute($category, $request)) {
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
