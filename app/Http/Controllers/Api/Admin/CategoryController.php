<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\Api\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Cache\Repository;
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
        return response()->json(['categories' => $this->categoryRepository->get()]);
    }


    public function store(CreateCategoryRequest $request): JsonResponse
    {
        $data = $request->all();
        $data['slug'] =  Helper::generateSlug($data['name_en']);

        $file_name = time().'_'.$request->outstanding_image->getClientOriginalName();
        $file_path = $request->file('outstanding_image')->storeAs('categories', $file_name, 'public');

        $data['outstanding_image'] = '/storage/' . $file_path;

        $category = Category::create($data);

        return response()->json([
            'category' => $category,
            'message' => __('general.api.category.create_status_success'),
        ]);
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json(compact('category'));
    }



    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $data = $request->all();
        $data['slug'] =  Helper::generateSlug($data['name_en']);


        if ($request->outstanding_image) {
            $file_name = time().'_'.$request->outstanding_image->getClientOriginalName();
            $file_path = $request->file('outstanding_image')->storeAs('categories', $file_name, 'public');
            $data['outstanding_image'] = '/storage/' . $file_path;
        }

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
