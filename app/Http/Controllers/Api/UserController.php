<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StatusUserRequest;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(User::all());
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $user = User::query()->where('id', $id)->firstOrFail();
        $user->name = $request->name;
        if($user->save()){
            return response()->json([
                'message' => 'Usuario modificado satisfactoriamente'
            ]);
        } else {
            return response()->json([
                'message' => 'El usuario no pudo ser modificado'
            ]);
        }
    }

    /**
     * @param StatusUserRequest $statusUserRequest
     * @return JsonResponse
     */
    public function updateStatus(StatusUserRequest $statusUserRequest): JsonResponse
    {
        $user = User::query()->where('id', $statusUserRequest->id)->firstOrFail();
        $user->status = $statusUserRequest->status;
        if($user->save()){
            return response()->json([
                'message' => 'Usuario modificado satisfactoriamente'
            ]);
        } else {
            return response()->json([
                'message' => 'El usuario no pudo ser modificado'
            ]);
        }
    }
}
