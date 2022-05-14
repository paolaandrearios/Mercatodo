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
        $user->removeRole($user->role);

        $user->name = $request->name;
        $user->role = $request->role;

        switch ($request->role){
            case 'administrator':
                $user->assignRole('administrator');
                break;
            case 'client':
                $user->assignRole('client');
                break;
            case 'stock_assistant':
                $user->assignRole('stock_assistant');
                break;
            case 'financial_assistant':
                $user->assignRole('financial_assistant');
                break;
            case 'logistic_assistant':
                $user->assignRole('logistic_assistant');
                break;
            case 'marketing_assistant':
                $user->assignRole('marketing_assistant');
                break;
        }

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
