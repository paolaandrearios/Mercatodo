<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(User::orderBy('id', 'asc')->paginate(config('general.custom_records_per_page')));
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user->name = $request->name;

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
