<?php

namespace App\Actions\Category;

use App\Helpers\Helper;
use App\Models\Category;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UpdateCategoryAction
{
    private ImageRepository $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function execute(Category $category, Request $request): bool
    {
        $category->name_es = $request->input('name_es');
        $category->name_en = $request->input('name_en');
        $category->type = $request->input('type');
        $category->status = $request->input('status');
        $category->icon = $request->input('icon');

        $category->slug = Helper::generateSlug($category['name_en']);

        if ($request->outstanding_image) {
            $filePath = $this->imageRepository->upload('categories', $request->outstanding_image);
            $category['outstanding_image'] = config('general.custom_image_path') . $filePath;
        }

        Cache::forget('categories');
        Cache::forget('categories_status');

        return $category->save();
    }
}
