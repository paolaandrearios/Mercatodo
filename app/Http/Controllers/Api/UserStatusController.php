<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StatusUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserStatusController extends Controller
{
    public function update(StatusUserRequest $statusUserRequest, User $user): JsonResponse
    {
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
