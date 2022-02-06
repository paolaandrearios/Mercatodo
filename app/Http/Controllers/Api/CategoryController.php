<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\Helper;
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
        return response()->json(['categories' => $this->categoryRepository->get('active')]);
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json(compact('category'));
    }

}
